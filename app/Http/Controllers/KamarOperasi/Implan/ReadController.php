<?php

namespace App\Http\Controllers\KamarOperasi\Implan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Implan;
use DB;

class ReadController extends Controller
{
  public function ajaxSearchImplan(Request $request)
  {
    $term = trim($request->search);
    if (empty($term))
    {
        return response()->json([]);
    }

    $implan = Implan::select('id', 'nama as text')->where('nama', 'like', "%{$term}%")->get()->toArray();
    return response()->json($implan);
  }
}
