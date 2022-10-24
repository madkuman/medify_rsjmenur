<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianPraInduksiAnestesiDanSedasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianPraInduksiAnestesiDanSedasi;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return PengkajianPraInduksiAnestesiDanSedasi::all();
    }
}