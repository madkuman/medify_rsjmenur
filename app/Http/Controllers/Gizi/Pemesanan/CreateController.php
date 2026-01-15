<?php

namespace App\Http\Controllers\Gizi\Pemesanan;

use App\Models\Gizi\DietMenuDetail;
use App\Models\Gizi\JenisMakanan;
use App\Models\Gizi\KategoriPasienDetail;
use App\Models\Gizi\KelasDetail;
use App\Models\Gizi\WaktuMakan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\Menu;
use App\Models\Gizi\DietKode;
use Illuminate\Support\Str;
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function pemesanan($data)
    {
            $pesan = new Pemesanan;
            $pesan->pasien_id = $data['pasien_id'];
            $pesan->kasus_id = $data['kasus_id'];
            $pesan->created_by = Auth::user()->id;
            $pesan->jadwal_pengantaran = Carbon::parse($data['jadwal_pengantaran']);
            $pesan->save();
            $data['pesan']=$pesan;
            $this->detailPemesanan($data);
    }

    private function detailPemesanan($data)
    {
            $waktu_makan=[];
            // if($data['waktu_pagi'] == 1){
            //     array_push($waktu_makan,[1]);
            // }
            // if($data['waktu_siang'] == 1){
            //     array_push($waktu_makan,[2]);
            // }
            // if($data['waktu_sore'] == 1){
            //     array_push($waktu_makan,[3]);
            // }

            // if(empty($waktu_makan)){
            //     $waktu_makan = [1,2,3];
            // }

            // $waktu_makan = array_collapse($waktu_makan);
            // foreach ($waktu_makan as $item){
            //     $jam_waktu_makan = WaktuMakan::find($item)->time;
            $gizi_permintaan_id=[];
            $waktu = WaktuMakan::all();
            foreach($waktu as $index => $item){
                $key = Str::slug($item->nama,'_');
                if( $data[$key] == 1 ) {
                    $waktu_makan[$index] = $item->id;
                    $gizi_permintaan_id[$index] = $data[$key.'_permintaan_id'] ?? null;
                } 
            }

            foreach ($waktu_makan as $index => $item){
                $jam_waktu_makan = WaktuMakan::find($item)->time ?? '';
                $detail = new PemesananDetail;
                $detail->waktu_makan_id = $item;
                $detail->pemesanan_id = $data['pesan']->id;
                $detail->lokasi_id = $data['lokasi_id'];
                $detail->bangsal_id = $data['bangsal_id'];
                $detail->ruangan_id = $data['ruangan_id'];
                $detail->gender = $data['gender'];
                $detail->kelas_id = $data['kelas_id'];
                $detail->jenis_makanan_id = $data['jenis_makanan_id'];
                $detail->makanan_tambahan_ids = json_encode($data['makanan_tambahan_ids']);
                $detail->bentuk_makanan_id = $data['bentuk_makanan_id'];
                $detail->diet_id = $data['diet_id'];
                $detail->gizi_permintaan_id = $gizi_permintaan_id[$index] ?? null;
                $detail->catatan = $data['catatan'];
                $detail->untuk_tanggal = Carbon::parse($data['jadwal_pengantaran'].$jam_waktu_makan);
                $detail->created_by = Auth::user()->id;
                $detail->save();
            }
    }
	
	public function setMutuGizi(Request $request)
	{
		$pemesanan = Pemesanan::where('id', $request->pemesananid)->first();
		$pemesanan->mutu_diet = $request->diet;
		$pemesanan->mutu_sisa = $request->sisa;
		$pemesanan->mutu_created_by=Auth::user()->id;
		$pemesanan->save();

		$status = 1;
		$message = 'Mutu Gizi berhasil diperbarui!';
		$title = 'Berhasil!';

		return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
	}
}
