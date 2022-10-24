<?php

namespace App\Http\Controllers\UnitTindakan\UnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UnitTindakan\UnitTindakan\ReadController;
use App\Models\UnitTindakan\Transaksi;
use App\Models\Keuangan\TarifTipe;
use Carbon\Carbon;
use Auth;

class ViewController extends Controller
{
	public function __construct(){
		$this->readController = new ReadController;
	}

	public function index()
	{
		$data['lokasi'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasi();
		$data['poli'] = json_decode(app('App\Http\Controllers\RawatJalan\Poliklinik\ReadController')->getAll())->data;
		$data['tindakan'] = $this->readController->get();
		return view('unit-tindakan.index', $data);
	}

	public function dashboard($slug)
	{
		$data['tindakan'] = $this->readController->getBySlug($slug);
		$data['tarif_tipe'] = TarifTipe::get();
		$data['pharmacies'] = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();	
		$data['user'] = Auth::user();	
		$data['tipe_obat'] = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
		$data['aturan'] = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();
		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
		
		return view('unit-tindakan.dashboard.index', $data);
	}

	public function histori(Request $request, $slug)
	{
        $date_start = $request->get('date_start');
        $date_end = $request->get('date_end');

		$tindakan = $this->readController->getBySlug($slug);
		$data['tindakan'] = $tindakan;

        $date_start_default = Carbon::today()->format('d-m-Y');
        $date_end_default = Carbon::today()->format('d-m-Y');

		if(empty($date_end) && empty($date_start)){
			return redirect('unit-tindakan/'.$slug.'/histori?date_start='.$date_start_default.'&date_end='.$date_end_default);
		}

		$date_start_format = Carbon::createFromFormat('d-m-Y', $date_start)->startOfDay();
        $date_end_format = Carbon::createFromFormat('d-m-Y', $date_end)->endOfDay();

        $data['histori'] =  Transaksi::where('unit_tindakan_id', $tindakan->id)->whereBetween('created_at',[$date_start_format,$date_end_format])->where('flag', 1)->get();

        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
		return view('unit-tindakan.histori.index', $data);
	}

	public function pengaturan($slug)
	{
		$data['lokasi'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasi();
		$data['tindakan'] = $this->readController->getBySlug($slug);
		$data['poli'] = json_decode(app('App\Http\Controllers\RawatJalan\Poliklinik\ReadController')->getAll())->data;
		return view('unit-tindakan.pengaturan.index', $data);
	}
}