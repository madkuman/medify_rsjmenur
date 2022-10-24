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

class ViewController extends Controller
{
	

	public function printCPPT($nomor_kasus, $id)
	{
		
        \Blade::setEchoFormat('nl2br(e(%s))');
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$cppt = CPPT::find($id);
		$kasusId = $cppt->kasus_id;
		$data['cppt'] = $cppt;
		$data['kasus'] = $kasus;
		if($kasus->id != $cppt->kasus_id)
		{
			return abort(404);
		}
		else
		{

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'print','cppt',$cppt->id);

			$pdf = MPDF::loadView('kasus.datamedis.content.cppt.print', $data, [], [
				'mode' => 'utf-8',
				'format' => 'A5'
			]);
			$filename = $kasus->judul_kasus.'-cppt.pdf';

			return $pdf->stream($filename);

		}
	}

	public function printRAPT($nomor_kasus, $id)
	{
		
        \Blade::setEchoFormat('nl2br(e(%s))');
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$cppt = CPPT::find($id);
		$kasusId = $cppt->kasus_id;
		$data['cppt'] = $cppt;
		$data['kasus'] = $kasus;
		if($kasus->id != $cppt->kasus_id)
		{
			return abort(404);
		}
		else
		{

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'print','cppt',$cppt->id);

			$pdf = MPDF::loadView('kasus.datamedis.content.cppt.print-rapt', $data, [], [
				'mode' => 'utf-8',
				'format' => 'A5'
			]);
			$filename = $kasus->judul_kasus.'-cppt.pdf';

			return $pdf->stream($filename);

		}
	}

	public function printCPPTAll($nomor_kasus,Request $request)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		if($request->ids){
            $cppt = CPPT::whereIn('id',explode('%amp',$request->ids))->get();
        }else{
		    $cppt = CPPT::where('kasus_id',$kasus->id)->get();
        }
		$kasusId = $kasus->id;
		

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasusId,'print','cppt','0');

		$data['kasus'] = $kasus;
		$data['cppt'] = $cppt;

		$pdf = MPDF::loadView('kasus.datamedis.content.cppt.print-all', $data, [], [
			'mode' => 'utf-8',
			'format' => 'A4'
		]);
		$pdf->autoPageBreak = true;
		$filename = $kasus->judul_kasus.'-cppt.pdf';

		//return view('kasus.datamedis.content.cppt.print-all', $data);

		return $pdf->stream($filename);
	}


}