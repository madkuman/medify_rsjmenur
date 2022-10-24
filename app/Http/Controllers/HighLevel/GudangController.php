<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\Farmasi;
use Illuminate\Support\Facades\DB;
use App\Models\Farmasi\Pengadaan;
use App\Models\Farmasi\Supplier;
use Carbon\Carbon;

class GudangController extends Controller
{
    public function index()
	{
		return view('highlevel.gudang');
	}

    public function getData($type)
    {

        $gudang = Farmasi::where('jenis',4)->first();

        $yearly_end = Carbon::now()->endOfMonth();
        $yearly_start = Carbon::now()->subYear()->startOfMonth();
        $farmasi_id = [];
        $farmasi_id[] = $gudang->id;
        $farmasi_id = Farmasi::pluck('id')->toArray();

        if($type == 'distribusi'){
            $data = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getStatistikNilaiDistribusiPerBulan($farmasi_id,-1,$yearly_start->copy(),$yearly_end->copy());
        }
        elseif($type == 'pengadaan'){
            $data = app('App\Http\Controllers\Farmasi\Pengadaan\ReadController')->getStatistikNilaiPengadaanPerBulan($farmasi_id,$yearly_start->copy(),$yearly_end->copy());
        }
        elseif($type == 'kekayaan'){
            $data = app('App\Http\Controllers\Farmasi\Items\ReadController')->getStatistikKekayaanPerBulan($farmasi_id,$yearly_start->copy(),$yearly_end->copy());
        }

        return json_encode($data);
    }
}
