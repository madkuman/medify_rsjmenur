<?php

namespace App\Http\Controllers\Kepegawaian\MasterKuisioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Kuisioner;
use App\Models\Kepegawaian\KuisionerBagian;
use App\Models\Kepegawaian\KuisionerJawaban;
use App\Models\Kepegawaian\KuisionerPertanyaan;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CreateController extends Controller
{
    public function addKuisioner($req)
    {
        $cari = Kuisioner::find($req->kuisionerid);
        if (isset($req->status) && $req->status == '1') $status = 1;
        else $status = 0;

        
        if (empty($cari)) {
            $kuisioner = new Kuisioner();
        }else {
            $kuisioner = $cari;
        }
        
        if (isset($req->publik) && $req->publik == '1') {
            $kuisioner->publik = 1;
            $kuisioner->departemen_id = $req->departemen;
        }
        else {
            $kuisioner->publik = 0;
        }

        $nama = ucwords($req->nama);
        if(strpos($nama, 'Kuisioner') === false){
            $nama = 'Kuisioner '.$nama;
        }   

        $lowertxt = strtolower($nama);
        $oldtxt = ["kuisioner ", " "];
        $newtxt = ["", "-"];

        $slug = str_replace($oldtxt, $newtxt, $lowertxt);

        $kuisioner->nama = $nama;
        $kuisioner->deskripsi = $req->deskripsi;
        $kuisioner->slug = $slug;
        $kuisioner->status_aktif = $status;
        $kuisioner->save();

        return $kuisioner;
    }

    public function addCustomPertanyaan($req)
    {
        $pertanyaan = new KuisionerPertanyaan();
        $jenis = $req->jenis_pertanyaan;
        $bag = $this->addBagian($req->bagian);

        switch ($jenis) {
            case 'puas':
                $val['jenis'] = 'Puas';
                $val['default'] = 'Puas / Tidak Puas';
                break;
            case 'sesuai':
                $val['jenis'] = 'Sesuai';
                $val['default'] = 'Sesuai / Tidak Sesuai';
                break;
            case 'pilgan':
                $val = [];
                $val['jenis'] = 'Pilihan Ganda';
                $huruf = 'a';
                $pertanyaan->bobot = $req->bobot;
                foreach ($req->val_pilihan_ganda as $item) {
                    $val[$huruf] = ucfirst($item);
                    $huruf++;
                }
                break;
            case 'skala':
                $val = [];
                $val['jenis'] = 'Skala';
                $angka = 1;
                $pertanyaan->bobot = $req->bobot;
                foreach ($req->val_skala as $item) {
                    $val[$angka] = ucfirst($item);
                    $angka++;
                }
                break;
            case 'textbox':
                $val['jenis'] = 'Isian Singkat';
                $val['default'] = 'Isian Singkat Teks';
                break;
            case 'textarea':
                $val['jenis'] = 'Isian Uraian';
                $val['default'] = 'Isian Uraian Teks';
                break;
        }
        $val['dibalik'] = 0;
        $pertanyaan->pertanyaan = ucfirst($req->pertanyaan);
        $pertanyaan->bagian_id = $bag->id;
        $pertanyaan->tipe = $jenis;
        $pertanyaan->val_pilihan = json_encode($val);
        $pertanyaan->kuisioner_id = $req->kuisionerid;
        $pertanyaan->save();
        
        //Reset Jawaban
        $rest = KuisionerJawaban::where('kuisioner_id', $req->kuisionerid)->get();
        foreach ($rest as $item) {
            $item->edited = 0;
            $item->save();
        }

        return $pertanyaan;
    }

    public function addBagian($reqbag)
    {
        $bag = KuisionerBagian::find($reqbag);
        if (!$bag) {
            $bag_name = ucwords(strtolower($reqbag));
            $bag = new KuisionerBagian();
            $bag->nama = $bag_name;
            $bag->save();
        }
        return $bag;
    }

    public function moveToCustom()
    {
        $restkuisioner = Kuisioner::whereNull('slug')->get();
        foreach ($restkuisioner as $item) {
            $nama = $item->nama;
            $lowertxt = strtolower($nama);
            $oldtxt = ["kuisioner ", " "];
            $newtxt = ["", "-"];
            $slug = str_replace($oldtxt, $newtxt, $lowertxt);
            $item->slug = $slug;
            $item->save();
        }

        $restpertanyaan = KuisionerPertanyaan::whereNull('val_pilihan')->get();
        foreach ($restpertanyaan as $item) {
            $pernyataan = $item->pernyataan;
            $val['jenis'] = $pernyataan;
            $val['default'] = $pernyataan.' / Tidak '.$pernyataan;
            $item->pertanyaan = ucfirst($item->pertanyaan);
            $item->tipe = strtolower($pernyataan);
            $item->val_pilihan = json_encode($val);
            $item->save();
        }
    }

    public function moveJawabanToCustom()
    {
        $jawaban = KuisionerJawaban::all();
        foreach ($jawaban as $item) {
            $valtemp = json_decode($item->jawaban);
            $val = collect([]);
            $jawab = $item;
            if (!isset($valtemp[0]->tipe)) {
                for ($i=0; $i < count($valtemp); $i++) {
                    $pertanyaanid = $valtemp[$i]->pertanyaan_id;
                    $tipe = 'puas';
                    $keterangan = '';
                    if ($valtemp[$i]->jawaban == 'puas') $valjwb = 'Puas';
                    else if ($valtemp[$i]->jawaban == 'tidak') $valjwb = 'Tidak Puas';
                    $val->push(['pertanyaan_id' => $pertanyaanid,'tipe' => $tipe, 'jawaban' => $valjwb, 'keterangan' => $keterangan]);
                }
                $jawab->jawaban = json_encode($val);
                $jawab->save();
            }
        }
    }

    public function generateKuisionerPublik($kasus)
    {
        $departemen = $kasus->lokasi->lokasi->departemen->id;
        $kuisioner = Kuisioner::where('departemen_id', $departemen)
                    ->where('status_aktif', 1)
                    ->where('publik', 1)
                    ->first();
        if (!is_null($kuisioner)) {
            $check = KuisionerJawaban::where('kasus_id', $kasus->id)->where('kuisioner_id', $kuisioner->id)->first();
            if (!is_null($check)) return null;
            $this->createJawabanPublik($kuisioner->id, $kasus);

            // for loop send item to patient
            $check_all = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->checkAllJawaban($kasus->id);
            $phone = $kasus->pasien->phone;
            foreach ($check_all as $item) {
                $urls = 'https://rsalramelan.com/kuisioner/publik/'.$item->slug;
                $send_wa = $this->sendUrlsWa($urls, $phone, $item);
            }
            return $send_wa;
        }
        return null;
    }

    public function sendUrlsWa($urls, $phone_temp, $jawaban)
    {
        $ori = [" ", "-"];
        $replace = ["", ""];
        $phone = str_replace($ori, $replace, $phone_temp);
        $phone_length = strlen($phone);
        $status = 0;
        // dd($phone_length, $phone);
        if ($phone_length > 9) {
            if ($phone[0] == 0) {
                $phone[0] = "2";
                $phone = "6".$phone;
            }
            else if ($phone[0] == 8) {
                $phone = "62".$phone;
            }
            $data["phone"] = $phone;
            $data["body"] = "Terima Kasih telah berkunjung ke RSAL Dr Ramelan Surabaya.\nDemi meningkatkan kualitas layanan kami terhadap pasien, kami berharap Bapak/Ibu berkenan untuk mengisi kuesioner berikut :\n\n".
                            $urls."\n\nTerima kasih atas waktunya, semoga Bapak/Ibu dan keluarga diberikan kesembuhan.";
            try
            {
                $client = new Client();
                $to_send = [
                    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                    'verify' => false,
                    \GuzzleHttp\RequestOptions::FORM_PARAMS => $data,
                ];

                $res = $client->request('POST', config('app.whatsapp_api'), $to_send);
                $content = json_decode($res->getBody()->getContents());
                if (isset($content->sent) && $content->sent == true) {
                    $jawaban->sent = 1; //for update sent item
                    $jawaban->save();
                }
                $status = 1;
                return $status;
            } catch (\RequestException $e) {
                if ($e->hasResponse()) {
                    echo Psr7\str($e->getResponse());
                }
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            }catch (\Exception $e){
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            }
        }
        return $status;
    }

    public function createJawabanPublik($kuisioner_id, $kasus)
    {
        $encrypted_kasus = Crypt::encryptString($kasus->nomor_kasus.'-'.$kasus->pasien_id);
        $slug = substr($encrypted_kasus, 1, 10);
        $jawaban = new KuisionerJawaban();
        $jawaban->kuisioner_id = $kuisioner_id;
        $jawaban->kasus_id = $kasus->id;
        $jawaban->slug = $slug;
        $jawaban->created_by = Auth::user()->id;
        $jawaban->save();

        return $jawaban;
    }
}