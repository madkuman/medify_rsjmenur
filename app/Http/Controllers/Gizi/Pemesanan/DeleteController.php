<?php

namespace App\Http\Controllers\Gizi\Pemesanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Gizi\DietTambahanPemesanan;
use DB;
use Carbon\Carbon;
use App\Models\Gizi\DietKode;
class DeleteController extends Controller
{
    public function delete($id)
    {
        $pemesanan_detail = PemesananDetail::where('id',$id)->first();
        $pemesanan_detail->delete();
        if(count($pemesanan_detail->pemesanan->pemesanan_detail) == 0){
            $pemesanan=Pemesanan::where('id',$pemesanan_detail->pemesanan_id)->first();
            $pemesanan->delete();
        }

        if($pemesanan_detail)
            return 200;
        else
            return 400;
    }

    public function deleteKasus($id)
    {
        $pemesanan_detail = PemesananDetail::where('id',$id)->first();
        $pemesanan_detail->delete();
        if(count($pemesanan_detail->pemesanan->pemesanan_detail) == 0){
            $pemesanan=Pemesanan::where('id',$pemesanan_detail->pemesanan_id)->first();
            $pemesanan->delete();
        }
    }

    public function deleteFromKrs($kasus_id,$krs_at)
    {
        $pemesanan_detail = PemesananDetail::join('pemesanan','pemesanan.id','=','pemesanan_detail.pemesanan_id')
            ->where('pemesanan.kasus_id',$kasus_id)
            ->where('untuk_tanggal','>',$krs_at)
            ->whereNull('delivered_at');
        if($pemesanan_detail) {
            $pemesanan = with(clone $pemesanan_detail)->pluck('pemesanan_id')->toArray();
            $pemesanan_ids = array_unique($pemesanan);
            $pemesanan_detail_ids = with(clone $pemesanan_detail)->pluck('pemesanan_detail.id')->toArray();
            $pemesanan_detail = PemesananDetail::whereIn('id',$pemesanan_detail_ids)->delete();
            $pemesanan = Pemesanan::whereIn('id', $pemesanan_ids)->whereDoesntHave('pemesanan_detail')->delete();
        }
    }

}
