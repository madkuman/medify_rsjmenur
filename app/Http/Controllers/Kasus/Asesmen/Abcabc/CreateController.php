<?php

namespace App\Http\Controllers\Kasus\Asesmen\Abcabc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Abcabc;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$abcabc = new Abcabc;
    	
        $abcabc->tes = $req->tes;
    	$abcabc->created_by = Auth::user()->id;
    	$abcabc->kasus_id = $kasus_id;
    	$abcabc->save();
    }
}