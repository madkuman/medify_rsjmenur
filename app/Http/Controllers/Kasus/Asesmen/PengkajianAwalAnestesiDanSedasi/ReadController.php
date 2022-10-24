<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalAnestesiDanSedasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianAwalAnestesiDanSedasi;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PengkajianAwalAnestesiDanSedasi::all();
    }
}