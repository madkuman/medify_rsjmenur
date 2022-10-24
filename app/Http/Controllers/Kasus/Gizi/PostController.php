<?php

namespace App\Http\Controllers\Kasus\Gizi;

use App\Models\Kasus\Kasus;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function setSisaDiet(Request $request, $nomor_kasus)
	{
		$kasus = Gizi::where('nomor_kasus', $nomor_kasus)->first();
		$kasus->gizi_sisa = $request->sisa;
		$kasus->gizi_diet = $request->diet;
		$kasus->save();


		$status = 1;
        $message = 'Permintaan makanan baru berhasil dibuat!';
        $title = 'Berhasil!';

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
	}
}