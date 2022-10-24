<?php

namespace App\Http\Controllers\Gizi\Pemesanan;

use App\Models\Gizi\DietMenuDetail;
use App\Models\RawatInap\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\Menu;
use App\Models\Gizi\DietKode;
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class EditController extends Controller
{
   public function edit($data)
   {
       $pemesanan_detail = PemesananDetail::where('id',$data['pemesanan_detail_id'])->first();
       $pemesanan_detail->jenis_makanan_id = $data['jenis_makanan_id'];
       $pemesanan_detail->makanan_tambahan_ids = json_encode($data['makanan_tambahan_ids']);
       $pemesanan_detail->diet_id = $data['diet_id'];
       $pemesanan_detail->catatan = $data['catatan'];
       $pemesanan_detail->save();
   }

    public function pembatalan($id,$waktu)
    {
    	//dd($data);
    	//dd($id,$waktu);
    	if(!empty($waktu))
    	{
    		$batal = PemesananDetail::where('pemesanan_id',$id)
    						->where('waktu_makan_id',$waktu)->get();
    		//dd($batal);
    		foreach ($batal as $item) 
    		{	
    			$item->delete();
    		}
    		return 1;	
    	}
    	else
    	{
    		return 0;
    	}
    }

    public function editRuangan($data)
    {
    	$start = Carbon::now();

    	$pemesanan_ids = Pemesanan::where('kasus_id',$data['kasus_id'])->get()->pluck('id');

    	if(!empty($pemesanan_ids)){
            $pemesanan_detail = PemesananDetail::whereIn('pemesanan_id',$pemesanan_ids)
                ->where('untuk_tanggal','>',$start)
                ->update(array('lokasi_id' => $data['lokasi_id'],'bangsal_id' => $data['bangsal_id']));
        }

    	return;
    }

}