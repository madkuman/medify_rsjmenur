<?php

namespace App\Http\Controllers\LabPA\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPA\LaporanMaster;
use App\Models\Keuangan\TarifMaster;
use DB;
use Bugsnag;
use App\Jobs\QueueArtisan;
use Carbon\Carbon;

class PostController extends Controller
{

	public function dataDiagnosaPasienBulanan(Request $request)
	{
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpa:laporan-diagnosa-pasien-bulanan',$data));
        return abort(201);
	}

	public function rekapJumlahPasienBulanan(Request $request)
	{
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpa:laporan-rekap-jumlah-pasien-bulanan',$data));
        return abort(201);
	}
}