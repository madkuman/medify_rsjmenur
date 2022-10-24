<?php

namespace App\Http\Controllers\Kasus\ToDo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kasus\Kasus;


class PostController extends Controller
{
    	public function new($nomorKasus, Request $request)
    	{
    		$desc = $request->desc;
    		$creator = Auth::user()->id;
        	$kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();


    		$todo = app('App\Http\Controllers\Kasus\ToDo\CreateController')
    		->create($desc,Auth::user()->id,0,$kasusId);

    		$status = 1;
    		$message = 'To Do baru berhasil dibuat!';
    		$title = 'Berhasil!';


    		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
    		->create($kasusId,'create','todo',$todo->id,$kasusId);

    		return back()
    		->with('message', $message)
    		->with('title',$title)
    		->with('status', $status);


    	}
}
