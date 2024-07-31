<?php

namespace App\Http\Controllers\Kasus\TagihanDetail;

use App\Models\Keuangan\Tarif;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\Lokasi;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
	public function create($data, $userId = false)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('keuangan')->beginTransaction();
		try
		{
			$lokasi = Lokasi::where('id',$data['lokasi'])->first();
			if (empty($data['tagihan_id'])) {
				$tagihan = Tagihan::where('kasus_id',$data['kasus_id'])->whereNull('checkout')->first();
				if(empty($tagihan->id))
				{
					$tagihan = app('App\Http\Controllers\Kasus\Tagihan\CreateController')->create($data['kasus_id']);
				}
				$tagihanID = $tagihan->id;

			}
			else {
				$tagihanID = $data['tagihan_id'];
			}

			if(empty($data['sep_id']))
			{
				$tagihan = Tagihan::find($tagihanID);
				$kasus = Kasus::find($tagihan->kasus_id);
				$data['sep_id'] = $kasus->sep_id;
			}

			// dd($data);

			$detail = new TagihanDetail;
			$detail->kasus_tagihan_id = $tagihanID;
			$detail->tarif_id = $data['tarif_id'];
			if(!empty($data['tarif_kelas_id']))
			{
				$detail->tarif_kelas_id = $data['tarif_kelas_id'];
			}
			else
			{
				$detail->tarif_kelas_id = $data['tarif_kelas'] ?? $data['tarif_kelas_id'];
			}
			$detail->tarif_tipe_id = $data['tarif_tipe_id'];
			$detail->desc = $data['desc'];
			$detail->lokasi_id = $data['lokasi'];
			if(!empty($data['kategori_id']))
			{
				$detail->kategori_keuangan_id = $data['kategori_id'];	
			}
			else
			{
				$detail->kategori_keuangan_id = $lokasi->kategori_keuangan_id;
			}
			$detail->subtotal = $data['unit_price'] * $data['qty'];
			$detail->unit_price = $data['unit_price'];
			$detail->qty = $data['qty'];

			$detail->created_by = $userId ? $userId : Auth::user()->id;
			$detail->sep_id = $data['sep_id'];
			if(!empty($data['transaksi_kamar_operasi_id']))
				$detail->transaksi_kamar_operasi_id = $data['transaksi_kamar_operasi_id'];

			if(!empty($data['created_at'])){
			    $detail->created_at =  $data['created_at'];
            }else{
			    $detail->created_at = Carbon::now();
            }
			$detail->save();


			$tagihan = app('App\Http\Controllers\Kasus\Tagihan\EditController')->create_bill($detail->kasus_tagihan_id,$detail->subtotal);

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($data['kasus_id'],'create','tagihan',$detail->id);


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			DB::connection('keuangan')->commit();
			return $detail;

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('keuangan')->rollback();

		}
	}

    public function addRetribusi($data_retribusi, $kasus_id, $is_online = null)
    {
        $kasus = Kasus::find($kasus_id);
        $tarif_ids = explode(',', $data_retribusi);
        $tagihan_id = NULL;
		$user_id    = ($is_online == 1)? 1 : NULL;
        foreach($tarif_ids as $id){
            $tarif = Tarif::find($id);
            $retribusi = $this->reshapeTagihanKasus($tagihan_id,$tarif,$kasus);
            $createDetail = $this->create($retribusi, $user_id);
            $tagihan_id = $createDetail->kasus_tagihan_id;
        }

        $retribusi_kasus = Tagihan::find($tagihan_id);
        return $retribusi_kasus;
    }

    private function reshapeTagihanKasus($tagihan_id, $tarif, $kasus)
    {
        $data['kasus_id'] = $kasus->id;
        $data['tarif_id'] = $tarif->id;
        $data['tarif_tipe_id'] = $tarif->tipe_id;
        $data['tarif_kelas_id'] = $kasus->kelas_id ?? $tarif->kelas->id;
        $data['desc'] = $tarif->master->deskripsi;
        $data['unit_price'] = $tarif->harga;
        $data['qty'] = 1;
        $data['tagihan_id'] = $tagihan_id;
        $data['lokasi'] = $kasus->lokasi->lokasi->id;
        $data['kategori_id'] = $kasus->lokasi->lokasi->kategori_keuangan_id;

        return $data;
    }
}
