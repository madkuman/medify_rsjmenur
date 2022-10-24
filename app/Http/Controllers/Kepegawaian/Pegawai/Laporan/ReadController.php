<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Legalitas\Kredensial;
use App\Models\Kepegawaian\Legalitas\Evkin;
use App\Models\Kepegawaian\Legalitas\SIP;
use App\Models\Kepegawaian\Legalitas\STR;
use App\Models\Kepegawaian\Legalitas\SKK;
use MPDF;
use DOMPDF;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function laporanKeluarMasuk(Request $request){

		\Blade::setEchoFormat('nl2br(e(%s))');
		ini_set("pcre.backtrack_limit", "5000000");
		$date1 = Carbon::parse($request->input('bulan_tahun'))->startOfMonth();
		$date2 = Carbon::parse($request->input('bulan_tahun'))->endOfMonth();
		$start = Carbon::parse($request->bulan_tahun)->startOfMonth();
        $start = $start->format('Y-m-d');
        $jenis = $request->jenis_pegawai;
		$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,'%B %Y');

		$pegawai_masuk = Pegawai::whereBetween('tmt',[$date1,$date2])
                        ->with([
                            'MasterJabatan',
                            'masterPangkat',
                            'masterJenisPegawai'
                        ])
                        ->orderBy('tmt','asc');
		if($jenis != "semua") $pegawai_masuk->where('jenis_pegawai_id', $jenis);
		$data['pegawai_masuk'] = $pegawai_masuk->get();

		$pegawai_keluar = Pegawai::where('jenis_pegawai_id', $jenis)->whereBetween('tmt_out',[$date1,$date2])
                        ->with([
                            'MasterJabatan',
                            'masterPangkat',
                            'masterJenisPegawai'
                        ])
                        ->orderBy('tmt_out','asc');
        if($jenis != "semua") $pegawai_keluar->where('jenis_pegawai_id', $jenis);
		$data['pegawai_keluar'] = $pegawai_keluar->get();

		$pdf = DOMPDF::loadView('kepegawaian.laporan.hasil.laporan-keluar-masuk.index', $data)->setPaper('tabloid', 'landscape');
		$filename = 'Laporan-Keluar-Masuk-Pegawai.pdf';
		return $pdf->stream($filename);
    }
    
    public function laporanLegalitas(Request $request)
	{
        
		\Blade::setEchoFormat('nl2br(e(%s))');
		ini_set("pcre.backtrack_limit", "5000000");
		$jenis = $request->nama;
		$start = Carbon::parse($request->start_date)->format('Y-m-d');
		$end   = Carbon::parse($request->end_date)->format('Y-m-d');

		if($jenis == "all"){
			$str = $this->getExpiredSTR($start, $end);
			$sip = $this->getExpiredSIP($start, $end);
			$skk = $this->getExpiredSKK($start, $end);
			$evkin = $this->getExpiredEvkin($start, $end);
			$kredensial = $this->getExpiredKredensial($start, $end);
			$pegawai = collect($str)->merge($sip)->merge($skk)->merge($evkin)->merge($kredensial);
		} else {
			if($jenis == "str") $pegawai = $this->getExpiredSTR($start, $end);
			if($jenis == "sip") $pegawai = $this->getExpiredSIP($start, $end);
			if($jenis == "skk") $pegawai = $this->getExpiredSKK($start, $end);
			if($jenis == "evkin") $pegawai = $this->getExpiredEvkin($start, $end);
			if($jenis == "kredensial") $pegawai = $this->getExpiredKredensial($start, $end);
		}

		$data['pegawai'] = $pegawai;
		$data['jenis'] = $request->nama;
		$data['tanggal'] = [$start, $end];

		$pdf = DOMPDF::loadView('kepegawaian.laporan.hasil.laporan-legalitas.index',$data);
		$filename = 'Laporan_Legalitas_Expired';
		
		return $pdf->stream($filename);
    }
    
    public function laporanResumePegawai(Request $req){
        
        $data['item'] = Pegawai::where('id', $req->pegawai)
            ->with([
                'MasterJabatan',
				'masterKualifikasi',
				'masterSubKualifikasi',
                'masterPangkat',
                'masterJenisPegawai'
            ])->first();

        $pdf = DOMPDF::loadView('kepegawaian.laporan.hasil.profile-pegawai.resume', $data);
        $filename = 'Laporan-Resume-Pegawai.pdf';
        return $pdf->stream($filename);
    }

	function getExpiredSIP($start, $end){
		$pegawai = SIP::whereBetween('tanggal',[$start,$end])
			->get();
		return $pegawai;
	}

	function getExpiredSTR($start, $end){
		$pegawai = STR::whereBetween('tanggal',[$start,$end])
			->get();
		return $pegawai;
	}

    function getExpiredSKK($start, $end){
		$pegawai = SKK::whereBetween('tanggal',[$start,$end])
			->get();
		return $pegawai;
	}

	function getExpiredEvkin($start, $end){
		$pegawai = Evkin::whereBetween('tanggal',[$start,$end])->with(['pegawai.masterPangkat', 'pegawai.masterJabatan'])
			->get();
		return $pegawai;
    }
    function getExpiredKredensial($start, $end){
		$pegawai = Kredensial::whereBetween('tanggal',[$start,$end])->with(['pegawai.masterPangkat', 'pegawai.masterJabatan'])
			->get();
		return $pegawai;
	}
}
