<?php

namespace App\Http\Controllers\KamarOperasi\Matkes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Matkes;
use DB;

class ReadController extends Controller
{
  public function ajaxSearchMatkes(Request $request)
  {
    $term = trim($request->search);
    if (empty($term))
    {
        return response()->json([]);
    }

    $matkes = Matkes::select('id', 'nama as text')->where('nama', 'like', "%{$term}%")->get()->toArray();
    return response()->json($matkes);
  }
}
