<?php

namespace App\Http\Controllers\KamarOperasi\Tim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Tim;
use App\Models\KamarOperasi\Rencana;
use App\Models\KamarOperasi\Transaksi;

class ReadController extends Controller
{
    public function ajaxGetTim(Request $request)
    {
      $tim = Tim::with(['detail' => function($q){
              $q->select(['id', 'name']);
            }])
            ->with(['role' => function($q){
              $q->select(['id', 'nama']);
            }])
            ->where('operasi_id', $request->input('id'))
            ->select(['operasi_id', 'role_id', 'user_id'])->get();
      return response()->json($tim);
    }
}
