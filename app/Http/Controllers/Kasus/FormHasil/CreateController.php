<?php

namespace App\Http\Controllers\Kasus\FormHasil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormHasil;
use Auth;

class CreateController extends Controller
{
	public function create($kasus_id,$form_id,$hasil)
	{
		$form_hasil = new FormHasil;
		$form_hasil->kasus_id = $kasus_id;
		$form_hasil->form_id = $form_id;
		$form_hasil->hasil = $hasil;
		$form_hasil->created_by = Auth::user()->id;
		$form_hasil->save();

		return $form_hasil;
	}
}
