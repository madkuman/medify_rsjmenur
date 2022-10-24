<?php

namespace App\Http\Controllers\KamarOperasi\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\KamarOperasi\Ruangan;

class ReadController extends Controller
{
    public function getAll()
	{
		$items = Ruangan::all();
		return $items;
	}

	public function getSingle($id)
	{
		$items = Ruangan::find($id);
		return $items;
	}

  public function ajaxSearchRuangan(Request $request)
  {
    $term = trim($request->search);
    if (empty($term))
    {
        return response()->json([]);
    }

    $result = Ruangan::select(['id', 'name as text'])->where('name', 'like', "%{$term}%")->get();
    return response()->json($result);
  }
}
