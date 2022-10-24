<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenAwalPasienTerminal\PengkajianAwalPasienTerminal;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PengkajianAwalPasienTerminal::all();
    }
}