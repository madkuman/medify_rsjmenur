<?php

namespace App\Http\Controllers\Keuangan\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Perusahaan;
use Yajra\DataTables\DataTables;

class ReadController extends Controller
{
    public function get()
    {
        $perusahaan = Perusahaan::all();
        return json_encode($perusahaan);
    }

    public function getIndex(Request $request)
    {
        $perusahaan = Perusahaan::all();
    	return DataTables::of($perusahaan)
    		->addIndexColumn()
            ->toJson();
    }

    public function getPengeluaran()
    {
        $perusahaan = Perusahaan::where('type', 2)->get();
        return json_encode($perusahaan);
    }

    public function searchSelect2(Request $request)
    {
        $keyword = $request->keyword;
        $perusahaan = Perusahaan::where('nama','LIKE','%'.$keyword.'%')->paginate(20);

        return $perusahaan;
    }
}
