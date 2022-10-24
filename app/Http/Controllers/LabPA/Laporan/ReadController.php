<?php

namespace App\Http\Controllers\LabPA\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPA\TransactionDetail;
use App\Models\LabPA\Transaction;
use DB;
use App\Models\LabPA\LaporanMaster;
use App\Models\Keuangan\Tarif;
use Carbon\Carbon;
use App\Exports\LabPA\InvoiceDiagnosis;
use App\Exports\LabPA\InvoiceRekapPasien;

class ReadController extends Controller
{
	private $departmentCode = 8;


	public function getMaster($slug)
	{
		return LaporanMaster::where('slug', $slug)->first();
	}

	public function getMutuKetepatan($start, $end, $target)
	{
		$master = LaporanMaster::where('slug', 'mutu-ketepatan')->first();
		$master = json_decode($master->konten);
		foreach($master->ketepatan as $m)
		{
			if($m->header == $target)
			{
				$detail = $m->id;
				break;
			}
		}
		$transaksi = Transaction::whereBetween(DB::raw('DATE(created_at)'), array($start, $end))
						->whereNotNull('verified_at')
						->HasTarifDetail($detail, $start, $end)->with('pasien', 'kasus')->get();
		return $transaksi;
	}
}