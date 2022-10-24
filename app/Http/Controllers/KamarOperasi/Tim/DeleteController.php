<?php

namespace App\Http\Controllers\KamarOperasi\Tim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Tim;

class DeleteController extends Controller
{
    public function anggota($id)
    {
    	$tim = Tim::find($id);
    	$tim->delete();

    	// $status = 1;
      //   // $message = 'Anggota berhasil dihapus.';
      //   // $title = 'Berhasil!';
      //   //
      //   // return back()
      //   // ->with('message', $message)
      //   // ->with('title',$title)
      //   // ->with('status', $status);
    }
}
