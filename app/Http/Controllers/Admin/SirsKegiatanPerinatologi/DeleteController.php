<?php

namespace App\Http\Controllers\Admin\SirsKegiatanPerinatologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$pendidikan = app('App\Http\Controllers\Admin\SirsKegiatanPerinatologi\ReadController')->getById($id);
		$pendidikan->delete();
		return;
	} 
}
