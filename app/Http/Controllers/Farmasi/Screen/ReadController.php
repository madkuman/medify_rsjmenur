<?php

namespace App\Http\Controllers\Farmasi\Screen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ScreenAntrian;
use Yajra\DataTables\DataTables;

class ReadController extends Controller
{
    public function getAll()
    {
        return ScreenAntrian::all();
    }

    public function getBySlug($slug)
    {
        $screen = ScreenAntrian::where('slug',$slug)->first();
        return $screen;
    }
}
