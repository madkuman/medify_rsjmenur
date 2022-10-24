<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormTransferInternalRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormTransferInternalRumahSakit;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return FormTransferInternalRumahSakit::all();
    }
}