<?php

namespace App\Http\Controllers\Kasus\Asesmen\Abcabc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Abcabc;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$abcabc = Abcabc::find($req->id);
    	
        $abcabc->tes = $req->tes;
        $abcabc->updated_by = Auth::user()->id;
    	$abcabc->save();
    }
}