<?php

namespace App\Http\Controllers\Kepegawaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\User;

class ReadController extends Controller
{
    public function loadTable(Request $request)
    {
    	$query = User::all();
    	return DataTables::of($query)
            ->toJson();
    }
}
