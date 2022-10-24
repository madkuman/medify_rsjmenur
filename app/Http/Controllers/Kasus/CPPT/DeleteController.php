<?php

namespace App\Http\Controllers\Kasus\CPPT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\RuanganVisite;
use App\User;
use MPDF; 
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class DeleteController extends Controller
{
	public function deleteCppt(Request $request)
	{
		$cppt = CPPT::find($request->id);
		if($cppt){
			$kasusId = $cppt->kasus_id;
			$tagihan_detail_id = $cppt->tagihan_detail_id;
			$nomorKasus = Kasus::where('id',$kasusId)->first();
			if(!empty($cppt->tagihanDetail))
			{
				if(empty($cppt->tagihanDetail->tagihan->checkout))
				{	
					$deleteTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\DeleteController')->deleteFromCppt($nomorKasus->nomor_kasus,$tagihan_detail_id);
				}
				else
				{	
					$status = 0;
					$message = 'CPPT telah dicheckout di tagihan!';
					$title = 'Gagal!';
					return redirect('/kasus/'.$nomorKasus->nomor_kasus.'/datamedis#cppt')
					->with('active_nav','cppt')
					->with('message', $message)
					->with('title',$title)
					->with('status', $status);
				}
			}
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'delete','cppt',$cppt->id);
			$cppt->delete();
		}
	}
}