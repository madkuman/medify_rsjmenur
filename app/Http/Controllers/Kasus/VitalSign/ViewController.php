<?php

namespace App\Http\Controllers\Kasus\VitalSign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MPDF;
use DOMPDF;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\VitalSign;
use App\Models\Kasus\Tindakan;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function print($nomor_kasus)
	{   
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->with('pasien','identitas')->first();
		$all_kasus = Kasus::where('pasien_id', $kasus->pasien->id)->pluck('id');
		$data['ttv'] = new \Illuminate\Database\Eloquent\Collection;
		foreach ($all_kasus as $semua_kasus) {
            $temp = VitalSign::where('kasus_id',$semua_kasus)->with('creator')->get();
            $data['ttv'] = $data['ttv']->merge($temp);
        }
        $data['ttv'] = $data['ttv']->sortByDesc('created_at');
		// $data['ttv'] = VitalSign::where('kasus_id',$kasus->id)->with('creator')->orderBy('created_at','asc')->get();

		$data['tindakan'] = Tindakan::where('kasus_id',$kasus->id)->whereNull('icd_9')->get();
		$data['kasus'] = $kasus;
		$pdf = MPDF::loadView('kasus.datamedis.content.vital.print', $data, [], [
			'mode' => 'utf-8',
			'format' => 'Legal-L'
		]);

		$tanggal = Carbon::now()->format('y_m_d');

		return $pdf->stream('Print TTV - '.$kasus->pasien->name.' - '.$tanggal);
	}

	public function printObservasi($nomor_kasus)
	{   
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->with('pasien','identitas')->first();
		$all_kasus = Kasus::where('pasien_id', $kasus->pasien->id)->pluck('id');
		$ttv = new \Illuminate\Database\Eloquent\Collection;
		foreach ($all_kasus as $semua_kasus) {
            $temp = VitalSign::where('kasus_id',$semua_kasus)->with('creator')->get();
            $ttv = $ttv->merge($temp);
        }
        $ttv = $ttv->sortBy('created_at');
		// $data['ttv'] = VitalSign::where('kasus_id',$kasus->id)->with('creator')->orderBy('created_at','asc')->get();

		$data['tindakan'] = Tindakan::where('kasus_id',$kasus->id)->whereNull('icd_9')->get();
		$data['ttv'] = $ttv;
		$data['kasus'] = $kasus;
		
		$all_masuk = 0;
        $all_keluar = 0;
		foreach ($ttv as $item) {
            $all_masuk += $item->cairan_infus;
            $all_masuk += $item->cairan_per_os;
            $all_keluar += $item->produksi_urine;
            $all_keluar += $item->cairan_lain;
        }
        $balans = $all_masuk - $all_keluar;

		$data['balans'] = $balans;
		$data['all_masuk'] = $all_masuk;
		$data['all_keluar'] = $all_keluar;
		
		$tanggal = Carbon::now()->format('y_m_d');
		$pdf = DOMPDF::loadView("kasus.datamedis.content.vital.print-observasi", $data);
		return $pdf->stream('Lembar Observasi - '.$kasus->pasien->name.' - '.$tanggal);
	}
}
