<?php

namespace App\Http\Controllers\Admin\SirsCaraBayar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$pendidikan = app('App\Http\Controllers\Admin\SirsCaraBayar\ReadController')->getById($id);
		$pendidikan->delete();
		return;
	} 
}
