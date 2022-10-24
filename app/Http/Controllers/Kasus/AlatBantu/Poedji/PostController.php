<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Poedji;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatPoedji;
use Auth;


define('relasi', []);

class PostController extends Controller
{
	public function create($nomor_kasus,Request $request)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();

		$result = '';

		$scores = 
		array("4","4","4","4","4","4","4","4","4","4","4","4","8","4","4","4","4","4","4","4","4","4","8","8","8","8");

		$score = 0;
		for($i=0;$i<26;$i++)
		{
			$parameter = $request->input('param'.$i);
			if($parameter > 0) 
			{
				$tmp = 1;
				$score += $scores[$i];
			}
			else $tmp = 0;
			
			$result.=$tmp;
			if($i != 25)
				$result.=',';


		}

		$scoring = new AlatPoedji;
		$scoring->kasus_id = $kasus->id;
		$scoring->triwulan = $request->input('triwulan');
		$scoring->result = $result;
		$scoring->score=$score;
		$scoring->created_by = Auth::user()->id;
		$scoring->save();


		$status = 1;
		$message = 'Poedji berhasil dibuat';
		$title = 'Berhasil!';


		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-poedji',$scoring->id);

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

	}

	public function edit(Request $request)
	{
		$result = '';

		$scores = 
		array("4","4","4","4","4","4","4","4","4","4","4","4","8","4","4","4","4","4","4","4","4","4","8","8","8","8");

		$score = 0;
		for($i=0;$i<26;$i++)
		{
			$parameter = $request->input('param'.$i);
			if($parameter > 0) 
			{
				$tmp = 1;
				$score += $scores[$i];
			}
			else $tmp = 0;
			
			$result.=$tmp;
			if($i != 25)
				$result.=',';


		}

		$scoring = AlatPoedji::where('id',$request->input('id'))->first();
		$scoring->triwulan = $request->input('triwulan');
		$scoring->result = $result;
		$scoring->score=$score;
		$scoring->created_by = Auth::user()->id;
		$scoring->save();

		$status = 1;
		$message = 'Poedji berhasil diubah';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);

	}

	public function delete(Request $request)
    {
        $scoring = AlatPoedji::find($request->id);
        $scoringID = $scoring->id;
        $kasusId = $scoring->kasus_id;
        $scoring->delete();

        $status = 1;
        $message = 'Skor Poedji berhasil dihapus!';
        $title = 'Berhasil!';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasusId,'delete','alat-poedji',$scoringID);

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}
