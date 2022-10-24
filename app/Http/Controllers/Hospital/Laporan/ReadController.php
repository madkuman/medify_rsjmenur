<?php

namespace App\Http\Controllers\Hospital\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Laporan;

class ReadController extends Controller
{
	public function get($slug,$file_name)
	{
		$laporan = Laporan::where('slug',$slug)->where('file_name',$file_name)->first();
		return $laporan;
	}

	public function getAll($slug)
	{
		$laporan = Laporan::where('slug',$slug)->orderBy('file_name','desc')->get();
		return $laporan;
	}

	public function getAllFormed($nama,$slug_prefix)
	{
		$temp = new \stdClass();
		$temp->nama = $nama;
		$temp->slug = slug($nama);
		$temp->files = $this->getAll($slug_prefix.'-'.$temp->slug);
		return $temp;
	}

	public function APIlaporan(Request $request)
	{
		$data = collect();
        if($request->has('slug'))
            $data = $this->getAll($request->slug);

        if($request->has('latest') && $request->latest){
            $data = $data->sortByDesc('created_at')->values();
        }
        #TODO ganti ke datatable serverside
        return json_encode([
            'data' => $data->toArray(),
        ]);
	}
}
