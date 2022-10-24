<?php

namespace App\Http\Controllers\LabPK\LayananKategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\LayananKategori;

class ReadController extends Controller
{
	public function getAll()
	{
		$layanan = LayananKategori::all();
		return $layanan;
	}
}
