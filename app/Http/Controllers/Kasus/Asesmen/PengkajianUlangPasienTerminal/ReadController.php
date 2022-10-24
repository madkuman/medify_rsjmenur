<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianUlangPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianUlangPasienTerminal\PengkajianUlangPasienTerminal;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PengkajianUlangPasienTerminal::all();
    }
}