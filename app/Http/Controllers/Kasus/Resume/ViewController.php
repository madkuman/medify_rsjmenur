<?php

namespace App\Http\Controllers\Kasus\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\PemeriksaanAwal;
use App\Models\Kasus\EvaluasiKlinis;
use App\Models\Kasus\Resume;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Resep;
use App\Models\RawatJalan\Poliklinik;
use MPDF;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$resume = Resume::where('kasus_id',$kasus->id)->orderBy('created_at','desc')->first();
		$data['sidebar_active'] = 'pengaturan';
		$data['diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->fetchAllDiagnosis($nomor_kasus);
		$data['kasus'] = $kasus;
		$data['nomor_kasus'] = $nomor_kasus;
		$data['resume'] = $resume;
		$data['sidebar_active'] = 'resume';
		$data['active_nav'] = 'ringkasan_pasien_pulang';
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
        	->create($kasus->id,'view','pengaturan',null);
		return view('kasus.resume.index',$data);
	}

	public function histori($nomor_kasus)
	{
		$pasien_id = Kasus::where('nomor_kasus',$nomor_kasus)->pluck('pasien_id')->first();
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$kasus_id = Kasus::where('pasien_id',$pasien_id)->pluck('id')->toArray();
		$resume = Resume::whereIn('kasus_id',$kasus_id)->orderBy('created_at','desc')->get();
		$data['nomor_kasus'] = $nomor_kasus;
		$data['resume'] = $resume;
		$data['kasus'] = $kasus;
		// dd($resume);
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
        	->create($kasus->id,'view','histori',null);
		return view('kasus.resume.histori-resume',$data);
	}

	public function create($nomor_kasus)
	{
		$poli = Poliklinik::all();
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$diag_utama = Diagnosis::where('kasus_id',$kasus->id)->where('type','utama')->first();
		$diag_tambahan = Diagnosis::where('kasus_id',$kasus->id)->where('type','!=','utama')->get();
		$tindakan_kep = Tindakan::where('kasus_id',$kasus->id)->whereNull('icd_9')->get();
		$kasus_sebelumnya = Kasus::whereNotIn('nomor_kasus',[$nomor_kasus])->where('pasien_id',$kasus->pasien_id)->with('diagnosis')->get();
		if(!empty($kasus_sebelumnya)){
			$riwayat=null;
			foreach ($kasus_sebelumnya as $item) {
				if (count($item->diagnosis)>0) {
					$new_diag = Diagnosis::where('kasus_id',$item->id)->get();
					if (!empty($new_diag)) {
						if (empty($riwayat)) {
							$riwayat = $new_diag;
						}
						else 
						{
							foreach($new_diag as $item)
							{
								$riwayat->push($item);
							}
						}
					}
					else $riwayat=null;
				}
			}
		}
		else{
			$riwayat = NULL;
		}
		$alasan_rawat = PemeriksaanAwal::where('nomor_kasus',$nomor_kasus)->get();
		$tindakan_icd9 = Tindakan::where('kasus_id',$kasus->id)->whereNotNull('icd_9')->get();
		$resep = Resep::where('kasus_id',$kasus->id)->get();
		$evaluasi = EvaluasiKlinis::where('nomor_kasus',$nomor_kasus)->orderBy('created_at','desc')->first();

		$data['sidebar_active'] = 'pengaturan';
		$data['kasus'] = $kasus;
		$data['nomor_kasus'] = $nomor_kasus;
		$data['diagnosis_utama'] = $diag_utama;
		$data['diagnosis_tambahan'] = $diag_tambahan;
		$data['tindakan_kep'] = $tindakan_kep;
		$data['riwayat'] = $riwayat;
		$data['alasan_rawat'] = $alasan_rawat;
		$data['tindakan_icd9'] = $tindakan_icd9;
		$data['resep'] = $resep;
		$data['evaluasi'] = $evaluasi;
		$data['poli'] = $poli;
		$data['sidebar_active'] = 'resume';
		//dd($kasus_sebelumnya);
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
        	->create($kasus->id,'view','pengaturan',null);
		return view('kasus.resume.create',$data);
	}

	public function edit($nomor_kasus,$id)
	{
		$poli = Poliklinik::all();

		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$resume = Resume::find($id);
		$data['kasus'] = $kasus;
		$data['nomor_kasus'] = $nomor_kasus;
		$data['resume'] = $resume;
		$data['poli'] = $poli;
		$data['sidebar_active'] = 'resume';
		
		return view('kasus.resume.edit',$data);
	}

	public function printresume($nomor_kasus,$id)
    {
        \Blade::setEchoFormat('nl2br(e(%s))');
    	$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$resume = Resume::find($id);
		$masuk = Carbon::createFromFormat('Y-m-d H:i:s', ($kasus->mrs_at ?? $kasus->created_at));
		if (!empty($kasus->krs_at)) {
			$keluar = Carbon::createFromFormat('Y-m-d H:i:s', $kasus->krs_at);
		} else $keluar = null;
        $data['kasus'] = $kasus;
        $data['resume'] = $resume;
        $data['now'] = Carbon::now();
        if (empty($keluar)) {
        	$data['durasi'] = '-';
        } else $data['durasi'] = $masuk->diffInDays($keluar);
        $data['dpjp'] = Kolaborator::where('kasus_id',$kasus->id)->where('admin',1)->first();
        $pdf = MPDF::loadView('kasus.resume.print', $data);
        $filename = $kasus->pasien->name.'-resume.pdf';
        return $pdf->stream($filename);
    }

    public function buktiPelayanan($nomor_kasus)
    {
    	\Blade::setEchoFormat('nl2br(e(%s))');
		$kasus = Kasus::with('operasiTransaksi', 'diagnosis.icd10', 'tindakan_icd9.icd9', 'pasien', 'verifikasiKoderKasus','kolaborator_admin')->where('nomor_kasus',$nomor_kasus)->first();
        $resume = Resume::where('kasus_id', $kasus->id)->first();
		$data['kasus'] = $kasus;
		$data['resume'] = $resume;
		
        // return view('kasus.resume.print-pelayanan-ranap', $data);
        $pdf = MPDF::loadView('kasus.resume.print-pelayanan-ranap', $data);
        $filename = $kasus->pasien->name.'-bukti-pelayanan.pdf';
        return $pdf->stream($filename);
    }
}
