<?php

namespace App\Http\Controllers\Kasus\TagihanDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\Kasus;
use Auth;
use DB;

class DeleteController extends Controller
{
    public function deleteFromCppt($nomor_kasus,$tagihan_detail_id)
    {
    	$tagihan = TagihanDetail::where('id',$tagihan_detail_id)->first();
    	if($tagihan) {
            $kasus = Tagihan::find($tagihan->kasus_tagihan_id);
            $kasusId = $kasus->kasus_id;
            $tagihanId = $tagihan->id;
            $new_nominal = $tagihan->subtotal;

            $minus = app('App\Http\Controllers\Kasus\Tagihan\EditController')->delete_bill($tagihan->kasus_tagihan_id, $new_nominal);
            $tagihan->delete();

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasusId, 'delete', 'tagihan', $tagihanId);
        }
        return $minus;
    }
}
