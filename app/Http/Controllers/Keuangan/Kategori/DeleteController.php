<?php

namespace App\Http\Controllers\Keuangan\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use DB;
use BugSnag;

class DeleteController extends Controller
{
    public function delete($id)
    {
		$kategori = Kategori::where('id',$id)->first();
		if(!empty($kategori)) $kategori->delete();
		return;
    }
}
