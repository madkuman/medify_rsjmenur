<?php

namespace App\Http\Controllers\IT\Komplain;

use Auth;
use Carbon\Carbon;
use App\Models\IT\Komplain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReadController extends Controller
{
    protected $model; 

    function __construct()
    {
        $this->model = new Komplain;
    }

    public function getData($request = '')
    {   
        $tgl_komplain_start = Carbon::parse($request['tgl_komplain_start'])->startOfDay();
        $tgl_komplain_end = Carbon::parse($request['tgl_komplain_end'])->endOfDay();

        $data = Komplain::with(['teknisinya', 'jenisKomplain'])->whereBetween('waktu_komplain',[$tgl_komplain_start,$tgl_komplain_end]);
        
    	return $data;
    }

    public function getEachData($id)
    {
    	$data = Komplain::with(['teknisinya'])->find($id);

    	return $data;
    }
}
