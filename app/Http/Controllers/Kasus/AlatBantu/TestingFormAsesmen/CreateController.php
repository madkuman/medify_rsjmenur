<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TestingFormAsesmen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TestingFormAsesmen;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$testing_form_asesmen = new TestingFormAsesmen;
    	
        $testing_form_asesmen->teks = $req->teks;
        $testing_form_asesmen->angka = $req->angka;
        $testing_form_asesmen->text_area = $req->text_area;
        if(!empty($req->tanggal)){        
            $testing_form_asesmen->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        } else {
            $testing_form_asesmen->tanggal = null;
        }
        $testing_form_asesmen->waktu = $req->waktu;
        $testing_form_asesmen->select = $req->select;
        $testing_form_asesmen->radio = $req->radio;
        $testing_form_asesmen->checkbox_checkbox_1 = $req->checkbox_checkbox_1;
        $testing_form_asesmen->checkbox_checkbox_1 = $req->checkbox_checkbox_1;
    	$testing_form_asesmen->created_by = Auth::user()->id;
    	$testing_form_asesmen->kasus_id = $kasus_id;
    	$testing_form_asesmen->save();
    }
}