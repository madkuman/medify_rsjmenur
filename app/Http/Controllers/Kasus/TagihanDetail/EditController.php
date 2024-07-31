<?php

namespace App\Http\Controllers\Kasus\TagihanDetail;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use Auth;
use DB;
use Bugsnag;

class EditController extends Controller
{
	public function edit($data)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			$id = $data['id'];
			$detail = TagihanDetail::find($id);
			$old_price = $detail->subtotal;
			$new_nominal = $data['unit_price'] * $data['qty'];

			if($data['tagihan_id'])
				$detail->kasus_tagihan_id = $data['tagihan_id'];
			
			$detail->desc = $data['desc'];
			$detail->lokasi_id = $data['lokasi'];
			$detail->subtotal = $data['unit_price'] * $data['qty'];
			$detail->unit_price = $data['unit_price'];
			$detail->qty = $data['qty'];
			// $detail->departemen_id = $data['departemen_id']; -OBSOLETE-
			// $detail->daftar_harga_id = $data['daftar_harga_id']; -OBSOLETE-
			$detail->tarif_id = $data['tarif_id'];
			// $detail->tarif_tipe_id = $data['tarif_tipe_id']; -OBSOLETE-
			$detail->tarif_kelas_id = $data['tarif_kelas'];
			$detail->sep_id = $data['sep_id'];
			$detail->created_by = Auth::user()->id;
            if(!empty($data['created_at'])){
                $detail->created_at =  $data['created_at'];
            }else{
                $detail->created_at = Carbon::now();
            }
			$detail->save();


			//$new_nominal = $new_price - $old_price;

			$tagihan = app('App\Http\Controllers\Kasus\Tagihan\EditController')->edit_bill($detail->kasus_tagihan_id,$new_nominal,$old_price);

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($data['kasus_id'],'edit','tagihan',$detail->id);
			
			
			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $detail;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}

	public function farmasiRetur($id, $jumlah, $kasus_id)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			$detail = TagihanDetail::find($id);
			$old_price = $detail->subtotal;
			$new_nominal = $detail->unit_price * ($detail->qty - $jumlah);
			
			$detail->subtotal = $new_nominal;
			$detail->qty = $detail->qty - $jumlah;
			$detail->save();

			$tagihan = app('App\Http\Controllers\Kasus\Tagihan\EditController')->edit_bill($detail->kasus_tagihan_id,$new_nominal,$old_price);

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus_id,'edit','tagihan',$detail->id);
			
			
			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $detail;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}

    public function pindahkan($request, $type = 'single')
    {
        $tagihan = Tagihan::find($request->tujuan_tagihan);
        if ($type == 'single') {
            $from_detail = TagihanDetail::with('tagihan')->find($request->detail_id);
            if (!empty($tagihan) && empty($tagihan->checkout) && empty($from_detail->tagihan->checkout ?? null)) {
                $tagihan->total_bill += $from_detail->subtotal;
                $tagihan->save();

                $from_tagihan = $from_detail->tagihan;
                $from_tagihan->total_bill -= $from_detail->subtotal;
                $from_tagihan->save();

                $from_detail->kasus_tagihan_id = $tagihan->id;
                $from_detail->save();
                return 1;
            }
        } else {
            $from_tagihan = Tagihan::find($request->tagihan_id);
            if (!empty($tagihan) && empty($tagihan->checkout) && empty($from_tagihan->checkout)) {
                if (!empty($request->detail_selected)) {
                    $detail_builder = TagihanDetail::whereIn('id', $request->detail_selected);
                    $detail_sum = with(clone $detail_builder)->sum('subtotal');
                    $detail_update = with(clone $detail_builder)->update(['kasus_tagihan_id' => $tagihan->id]);

                    $tagihan->total_bill += $detail_sum;
                    $tagihan->save();

                    $from_tagihan->total_bill -= $detail_sum;
                    $from_tagihan->save();

                    return 1;
                }
            }
        }
        return 0;
    }

    public function flagIpwl($id)
    {
        $data = TagihanDetail::find($id);
        if(empty($data->flag_ipwl_at))
        {
            $data->flag_ipwl_at = Carbon::now();
            $data->flag_ipwl_by = Auth::user()->id;
        }
        else
        {
            $data->flag_ipwl_at = null;
            $data->flag_ipwl_by = Auth::user()->id;
        }
        $data->save();
        return $data;
    }
}
