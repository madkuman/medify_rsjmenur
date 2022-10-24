<?php

namespace App\Http\Controllers\BPJS\AutoSEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi as TransaksiRJ;
use App\Models\RawatJalan\Transaksi as TransaksiRI;
use App\Models\RawatJalan\Dokter;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\PoliklinikBpjs;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Hospital\Kelas;
use App\Models\Kasus\BPJSSEPAutoReport;
use Carbon\Carbon;
use Auth;

class CreateController extends Controller
{
    public function generate($layanan_type,$pasien_id,$pasien_pembayaran_id,$poliklinik_id, $dokter_id = 0,$debug = 0)
    {
        /*
        ERROR BPJS DOKTER
        1. GET LAST KUNJUNGAN RAWAT JALAN DENGAN PASIEN PEMBAYARAN ID ITU
        2. GET POLIKLINIK
        3. GET DOKTER DENGAN POLIKLINIK ITU

        ERROR BPJS RUJUKAN HABIS
        ERROR BPJS
        */

        $cons_id = config('app.bpjs_cons_id');
        $secret = config('app.bpjs_secret');
        $ppk = config('app.bpjs_ppk');
        $bpjs_stage = config('app.bpjs_stage');

        /*GET DOKTER*/
        $dokter = Dokter::find($dokter_id);
        $kode_dpjp = [($dokter->bpjs_kode_dpjp ?? 0)];
        if ($kode_dpjp[0] == 0 || $dokter_id == 0) {
            $kode_dpjp_1 = $this->getDokter($pasien_pembayaran_id);
            $kode_dpjp_2 = $this->getDokterPoli($poliklinik_id);

            foreach($kode_dpjp_1 as $delete_val)
            {
                if (($key = array_search($delete_val, $kode_dpjp_2)) !== false) {
                    unset($kode_dpjp_2[$key]);
                }
            }
            $kode_dpjp12 = array_merge($kode_dpjp_1,$kode_dpjp_2);

            $kode_dpjp_3 = $this->getDokterRandom();

            foreach($kode_dpjp12 as $delete_val)
            {
                if (($key = array_search($delete_val, $kode_dpjp_3)) !== false) {
                    unset($kode_dpjp_3[$key]);
                }
            }
            $kode_dpjp = array_merge($kode_dpjp12,$kode_dpjp_3);
        }

        $total_dokter = count($kode_dpjp);
        $count_dokter = 0;

        $bpjs_auto_id = $this->createAutoSEP($layanan_type,$pasien_id,$pasien_pembayaran_id,$poliklinik_id,$count_dokter.'/'.$total_dokter);

        $tgl_sep = Carbon::today()->toDateString();
        $tgl_rujukan = Carbon::today()->toDateString();
        $tgl_kejadian = Carbon::today()->toDateString();
        $bpjs_jenis_pelayanan = 2;
        $bpjs_kelas_rawat = 3;
        $bpjs_nomor_kartu = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->single($pasien_pembayaran_id)->no_asuransi;
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($pasien_id);
        $poli = app('App\Http\Controllers\RawatJalan\Poliklinik\ReadController')->get($poliklinik_id);

        /*CHECK APAKAH PASIEN PUNYA RUJUKAN */

        $rujukan_data = app('App\Http\Controllers\BPJS\API\Rujukan\ReadController')->getRujukanKartuDo($bpjs_nomor_kartu,false);

        if(count($rujukan_data->response->rujukan) == 0)
        {
            $this->updateAutoSEPData($bpjs_auto_id,$rujukan_data->metaData->code, $rujukan_data,$count_dokter.'/'.$total_dokter);
            $res['status'] = 201;
            $res['message'] = 'Tidak ditemukan rujukan';
            return json_encode($res);
        }
        $rujukan = $rujukan_data->response->rujukan[0];
        $skdp = $this->getSKDP();

        $bpjs_no_mr = $pasien->no_rm;
        $is_try_again = 1;
        $try_count = 0;

        while($is_try_again){
            if($debug) echo "Start ".$try_count."--";
            $data = [
                'medify_cons_id'		=> $cons_id,
                'bpjs_stage'			=> $bpjs_stage,
                'medify_secret' 		=> $secret,
                'no_kartu' 				=> $bpjs_nomor_kartu,
                'tgl_sep' 				=> $tgl_sep,
                'ppk_pelayanan' 		=> $ppk,
                'jenis_pelayanan' 		=> $bpjs_jenis_pelayanan,
                'kelas_rawat' 			=> $bpjs_kelas_rawat,
                'no_mr' 				=> $bpjs_no_mr,
                'pasien_id' 			=> $pasien->id,
                'asal_rujukan' 			=> $rujukan->tipe_perujuk,
                'tgl_rujukan' 			=> $rujukan->tglKunjungan,
                'no_rujukan' 			=> $rujukan->noKunjungan,
                'ppk_rujukan' 			=> $rujukan->provPerujuk->kode,
                'nama_ppk_rujukan'		=> $rujukan->provPerujuk->nama,
                'catatan' 				=> '-',
                'diag_awal' 			=> $rujukan->diagnosa->kode,
                'poli_tujuan' 			=> $poli->bpjs_id,
                'poli_eksekutif' 		=> 0,
                'cob' 					=> 0,
                'katarak' 				=> 0,
                'jaminan_lakalantas'	=> 0,
                'penjamin' 				=> 0,
                'tgl_kejadian' 			=> $tgl_kejadian,
                'keterangan_penjamin'	=> '-',
                'suplesi' 				=> 0,
                'no_sep_suplesi' 		=> 0,
                'prov_laka' 			=> 0,
                'kab_laka' 				=> 0,
                'kc_laka' 				=> 0,
                'no_skdp' 				=> $skdp,
                'kode_dpjp' 			=> $kode_dpjp[$count_dokter++],
                'no_telp' 				=> (Auth::user()->phone ?? '081262227177'),
                'user' 					=> (Auth::user()->id ?? 1)
            ];

            $result = $this->sendData($data,$pasien_pembayaran_id,$try_count++);

            if($result->metaData->code == 201){
                if($debug) echo "Error 201--";
                if($result->metaData->type == 'dokter-invalid'){
                    if($count_dokter == count($kode_dpjp)) {
                        $is_try_again = 0;
                    }
                    else {
                        $is_try_again = 1;
                    }
                    if($debug) echo "dokter-invalid--";
                }
                else{
                    $is_try_again = 0;
                    if($debug) echo "unknown-error--";
                }
            }
            elseif($result->metaData->code == 200) {
                $is_try_again = 0;
                if($debug) echo "success--";
            }
            else {
                $is_try_again = 0;
                if($debug) echo "unknown result metadata--";
            }

            if($debug)
            {
                if($is_try_again) echo "Try Again--";
                else echo "Not Trying Again--";
            }

            if($debug) echo "--Finish \n";
            $this->updateAutoSEPData($bpjs_auto_id,$result->metaData->code, $result,$count_dokter.'/'.$total_dokter);
        }
        $res['status'] = $result->metaData->code;
        $res['message'] = $result->metaData->message;
        $res['result'] = $result;
        $this->updateAutoSEPData($bpjs_auto_id,$result->metaData->code, $result,$count_dokter.'/'.$total_dokter);

        return json_encode($res);
    }

    private function sendData($data,$pasien_pembayaran_id,$try_count)
    {
        if(config('app.bpjs_enable', false)){
            $result =  app('App\Http\Controllers\BPJS\API\Sep\CreateController')->create($data);
            if($result->metaData->code == 200){
                app('App\Http\Controllers\BPJS\SEP\CreateController')->create($data, $result->response->sep->noSep);
            }
            else
            {
                $result = $this->errorHandler($result,$data,$pasien_pembayaran_id,$try_count);

            }
        }
        else{
            $result= 'Nomor SEP tidak dibuat - '. ($sep+1) .' (Tidak terkoneksi BPJS)';
        }
        return $result;
    }

    private function getDokter($pasien_pembayaran_id)
    {
        /*
        1. GET HISTORI PELAYANAN DARI BPJS
        2. GET KUNJUNGAN TERAKHIR POLINYA
        3. GET POLI DENGAN KODE POLI BPJS TERSEBUT
        4. GET DOKTER YANG PUNYA JADWAL DI POLI TERSEBUT
        */
        $array = [];
        $tanggal_start = Carbon::now()->subMonths(6)->format("Y-m-d");
        $tanggal_end = Carbon::now()->format("Y-m-d");
        $pasien_pembayaran = PasienPembayaran::find($pasien_pembayaran_id);
        $histori_pelayanan = app('App\Http\Controllers\BPJS\Monitoring\HistoriPelayananPeserta\ReadController')->getData($pasien_pembayaran->no_asuransi,$tanggal_start,$tanggal_end);
        $histori_pelayanan = json_decode($histori_pelayanan);
        $code = $histori_pelayanan->metaData->code ?? 0;
        if($code == 200)
        {
            // GET LAST POLI
            foreach($histori_pelayanan->response->histori as $histori)
            {
                $sep = $histori->noSep;
                $kode_ppk = substr($sep, 0, 8);
                if($kode_ppk == config('app.bpjs_ppk'))
                {
                    $last_pelayanan = $histori;
                    break;
                }
            }
            $last_poli = $last_pelayanan->poli;
            $poliklinik_bpjs = PoliklinikBpjs::where('nama',$last_poli)->first();
            if(empty($poliklinik_bpjs->id)) return $array;

            $poliklinik = Poliklinik::where('bpjs_id',$poliklinik_bpjs->kode)->first();
            if(empty($poliklinik->id)) return $array;


            $dokter_id = DokterJadwal::where('poliklinik_id',$poliklinik->id)->pluck('dokter_id')->toArray();
            if(count($dokter_id) == 0) return $array;

            $dokter_id = array_unique($dokter_id);

            $dokter = Dokter::whereIn('id',$dokter_id)->get();
            if(count($dokter) > 0){
                $min = 0;
                $max = count($dokter)-1;
                $index = rand($min,$max);
                array_push($array, $dokter[$index]->bpjs_kode_dpjp);
            }
            $array = array_unique($array);
            return $array;

        }
        else
        {
            return $array;
        }
    }

    private function getDokterPoli($poliklinik_id)
    {
        $array = [];
        $dokter_id = DokterJadwal::where('poliklinik_id',$poliklinik_id)->pluck('dokter_id')->toArray();
        $dokter = Dokter::whereIn('id',$dokter_id)->get();
        if(count($dokter) > 0){
            $min = 0;
            $max = count($dokter)-1;
            $index = rand($min,$max);
            array_push($array, $dokter[$index]->bpjs_kode_dpjp);
        }
        $array = array_unique($array);
        return $array;
    }

    private function getDokterRandom()
    {
        $dokter = Dokter::whereNotNull('bpjs_kode_dpjp')->orderBy('bpjs_kode_dpjp')->pluck('bpjs_kode_dpjp')->toArray();
        $dokter = array_unique($dokter);
        return $dokter;
    }

    private function getSKDP()
    {
        return rand(0,999999);
    }

    private function errorHandler($result,$data,$pasien_pembayaran_id,$try_count)
    {
        $message = $result->metaData->message;
        $try_count++;
        if($try_count > 5)
        {
            if($message == 'No.Rujukan Harus Diisi No.SEP Pasca Rawat Inap RS Setempat')
            {
                $metaData = new \stdClass();
                $metaData->code = '201';
                $metaData->message = 'No SEP Rawat Inap tidak ditemukan atau tidak valid';
                $metaData->type = 'sep-rawat-inap-invalid';

                $result = new \stdClass();
                $result->metaData = $metaData;
            }
        }
        else
        {
            if($message == 'Asal rujukan Harus Diisi 2 (Rujukan Dari RS), karena pasien dari pasca rawat inap ')
            {
                $data['asal_rujukan'] = 2;
                $result = $this->sendData($data,$pasien_pembayaran_id,$try_count);
            }
            else if($message == 'Kode PPK.Rujukan Tidak Sesuai')
            {
                $data['ppk_rujukan'] = config('app.bpjs_ppk');
                $data['nama_ppk_rujukan'] = config('app.bpjs_ppk_nama');
                $result = $this->sendData($data,$pasien_pembayaran_id,$try_count);
            }
            else if($message == 'No.Rujukan Harus Diisi No.SEP Pasca Rawat Inap RS Setempat')
            {

                $tanggal_start = Carbon::now()->subMonths(6)->format("Y-m-d");
                $tanggal_end = Carbon::now()->format("Y-m-d");
                $pasien_pembayaran = PasienPembayaran::find($pasien_pembayaran_id);
                $histori_pelayanan = app('App\Http\Controllers\BPJS\Monitoring\HistoriPelayananPeserta\ReadController')->getData($pasien_pembayaran->no_asuransi,$tanggal_start,$tanggal_end);
                $histori_pelayanan = json_decode($histori_pelayanan);

                $code = $histori_pelayanan->metaData->code ?? 0;
                if($code == 200)
                {
                    foreach($histori_pelayanan->response->histori as $histori)
                    {
                        $sep = $histori->noSep;
                        $kode_ppk = substr($sep, 0, 8);
                        if($histori->jnsPelayanan == 1 && $kode_ppk == config('app.bpjs_ppk'))
                        {
                            $last_sep = $histori;
                            break;
                        }
                    }

                    $data['no_rujukan'] = $last_sep->noSep;
                    $data['tgl_rujukan'] = $last_sep->tglSep;
                    $data['ppk_rujukan'] = config('app.bpjs_ppk');
                    $data['nama_ppk_rujukan'] = config('app.bpjs_ppk_nama');
                }


                $result = $this->sendData($data,$pasien_pembayaran_id,$try_count);
            }
            else if($message == 'Dokter DPJP Tidak Ada atau masa berlaku SIP sudah habis atau cek DPJP Spesialis/Subspesialis sebelumnya')
            {
                $result->metaData->message = 'Error Tidak Diketahui. Gunakan SEP Manual. Pesan BPJS : '.$result->metaData->message;
                $result->metaData->type = 'dokter-invalid';
            }
            else
            {
                $result->metaData->message = 'Error Tidak Diketahui. Gunakan SEP Manual. Pesan BPJS : '.$result->metaData->message;
                $result->metaData->type = 'other-invalid';
            }
        }
        return $result;
    }


    public function createAutoSEP($layanan_type,$pasien_id,$pasien_pembayaran_id,$poliklinik_id,$count_dokter)
    {
        $auto = new BPJSSEPAutoReport;
        $auto->layanan_type = $layanan_type;
        $auto->pasien_id = $pasien_id;
        $auto->pasien_pembayaran_id = $pasien_pembayaran_id;
        $auto->poliklinik_id = $poliklinik_id;
        $auto->count_dokter = $count_dokter;
        $auto->created_by = Auth::user()->id ?? 1;
        $auto->save();

        return $auto->id;
    }

    public function updateAutoSEPData($id,$code_result,$result,$count_dokter)
    {
        $auto = BPJSSEPAutoReport::find($id);
        $auto->code_result = $code_result;
        $auto->result = serialize($result);
        $auto->count_dokter = $count_dokter;
        if(!empty($result->metaData)){
            if($result->metaData->code == 200 && !empty($result->response))
            {
                if(!empty($result->response->sep))
                    $auto->no_sep = $result->response->sep->noSep;
            }
        }
        $auto->save();

    }

    public function generateDokter($pasien_pembayaran_id)
    {
        /*
        ERROR BPJS DOKTER
        1. GET LAST KUNJUNGAN RAWAT JALAN DENGAN PASIEN PEMBAYARAN ID ITU
        2. GET POLIKLINIK
        3. GET DOKTER DENGAN POLIKLINIK ITU

        ERROR BPJS RUJUKAN HABIS
        ERROR BPJS
            */

        $transaksis = TransaksiRJ::where('pasien_pembayaran_id',$pasien_pembayaran_id)->orderBy('id')->get();
        foreach($transaksis as $transaksi)
        {
            $poliklinik_id = $transaksi->poliklinik_id;
            $dokter = Dokter::where('poliklinik_id',$poliklinik_id)->get();
            return json_encode($dokter);
        }

        $all_dokter = Dokter::all();
        return json_encode($all_dokter);
    }

}
