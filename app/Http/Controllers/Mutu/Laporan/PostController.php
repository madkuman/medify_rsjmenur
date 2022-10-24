<?php

namespace App\Http\Controllers\Mutu\Laporan;

use App\Exports\Mutu\InvoiceAsesmenPraBedah;
use App\Models\Hospital\Lokasi;
use App\Models\IGD\Transaksi;
use App\Models\IGD\Triage;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Tindakan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatHandHygiene;
use App\Exports\Mutu\InvoiceIAD;
use App\Exports\Mutu\InvoiceIADSurveilans;
use App\Exports\Mutu\InvoiceISK;
use App\Exports\Mutu\InvoiceISKSurveilans;
use App\Exports\Mutu\InvoiceIDO;
use App\Exports\Mutu\InvoiceIDOSurveilans;
use App\Exports\Mutu\InvoiceVAP;
use App\Exports\Mutu\InvoiceVAPSurveilans;
use App\Exports\Mutu\InvoiceCuciTangan;
use App\Exports\Mutu\InvoiceKejadianJatuh;
use App\Exports\Mutu\InvoiceKejadianHAP;
use App\Exports\Mutu\InvoiceKejadianPlebitis;
use App\Exports\Mutu\InvoiceKejadianDekubitus;
use App\Exports\Mutu\InvoiceKepatuhanSepsis;
use App\Exports\Mutu\InvoiceWaktuTunggu;
use App\Exports\Mutu\InvoiceJamBuka;
use App\Exports\Mutu\InvoiceKepatuhanIdentifikasi;
use App\Exports\Mutu\InvoiceKematianPasien48;
use App\Exports\Mutu\InvoiceKepatuhanVisite;
use App\Exports\Mutu\InvoiceCPPTDanDPJP;
use App\Exports\Mutu\InvoiceMata;
use App\Exports\Mutu\InvoiceIGD;
use App\Exports\Mutu\InvoiceGigiMulut;
use App\Exports\Mutu\InvoiceGizi;
use App\Exports\Mutu\InvoiceK3;
use App\Exports\Mutu\InvoiceRehabmed;
use App\Exports\Mutu\InvoiceLabPA;
use App\Exports\Mutu\InvoiceKematianPasienIgd24;
use App\Exports\Mutu\InvoiceGoldar;
use App\Exports\Mutu\InvoiceBakteri;
use App\Exports\Mutu\InvoiceEvaluasiKegiatanPengendalian;
use App\Exports\Mutu\InvoiceHumasKomplain;
use App\Exports\Mutu\InvoiceIdentifikasiResiko;
use App\Exports\Mutu\InvoiceRadiologiFilm;
use App\Exports\Mutu\InvoiceRadiologiUSG;
use App\Exports\Mutu\InvoiceRadiologiKonvensional;
use App\Exports\Mutu\InvoiceTHTCWD;
use App\Exports\Mutu\InvoiceTHTLaring;
use App\Exports\Mutu\InvoiceTHTSeptoplasti;
use App\Exports\Mutu\InvoiceTHTSinusitis;
use App\Exports\Mutu\InvoiceIT;
use App\Exports\Mutu\InvoiceKegiatanPengendalian;
use App\Exports\Mutu\InvoiceKesesuaianBedah;
use App\Exports\Mutu\InvoiceLabPKSPM;
use App\Exports\Mutu\InvoiceListrikMati;
use App\Exports\Mutu\InvoicePerbaikanAlat;
use App\Exports\Mutu\InvoiceRadiologiSPM;
use App\Models\Humas\Komplain;
use App\Models\K3\Logbook;
use App\Models\KamarOperasi\Pasca;
use App\Exports\Mutu\LaporanPDJantung;
use App\Exports\Mutu\LaporanSteroid;
use App\Exports\Mutu\LaporanCouter;
use App\Exports\Mutu\LaporanDermatits;
use App\Exports\Mutu\LaporanKuisionerPenilaian;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\LaporanRekapHarian;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatKejadianJatuh;
use App\Models\Kasus\AlatBantu;
use Carbon\Carbon;
use App\Models\Kepegawaian\Kuisioner;
use App\Models\Kepegawaian\KuisionerJawaban;
use DOMPDF;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;

class PostController extends Controller
{

	public function iad(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$bsi = AlatBantu::where('type', 'bsi-audit')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		} else {
			$lokasi_text = 'Semua';
			$bsi = AlatBantu::where('type', 'bsi-audit')->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['bsi'] = $bsi;
		return (new InvoiceIAD($data))->download('Laporan_Audit_IAD.xlsx');
	}

	public function isk(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$isk = AlatBantu::where('type', 'isk-audit')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		} else {
			$lokasi_text = 'Semua';
			$isk = AlatBantu::where('type', 'isk-audit')->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['isk'] = $isk;
		return (new InvoiceISK($data))->download('Laporan_Audit_ISK.xlsx');
	}

	public function ido(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$ido = AlatBantu::where('type', 'ido-audit')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		} else {
			$lokasi_text = 'Semua';
			$ido = AlatBantu::where('type', 'ido-audit')->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['ido'] = $ido;

		return (new InvoiceIDO($data))->download('Laporan_Audit_IDO.xlsx');
	}

	public function vap(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$vap = AlatBantu::where('type', 'vap-audit')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		} else {
			$lokasi_text = 'Semua';
			$vap = AlatBantu::where('type', 'vap-audit')->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['vap'] = $vap;


		return (new InvoiceVAP($data))->download('Laporan_Audit_VAP.xlsx');
	}

	public function iadSurveilans(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$bsi = AlatBantu::where('type', 'master-bsi')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		} else {
			$lokasi_text = 'Semua';
			$bsi = AlatBantu::where('type', 'master-bsi')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['bsi'] = $bsi;
		return (new InvoiceIADSurveilans($data))->download('Laporan_Surveilans_IAD.xlsx');
	}

	public function iskSurveilans(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$bsi = AlatBantu::where('type', 'master-isk')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		} else {
			$lokasi_text = 'Semua';
			$bsi = AlatBantu::where('type', 'master-isk')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['bsi'] = $bsi;
		return (new InvoiceISKSurveilans($data))->download('Laporan_Surveilans_ISK.xlsx');
	}

	public function vapSurveilans(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$bsi = AlatBantu::where('type', 'master-vap')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		} else {
			$lokasi_text = 'Semua';
			$bsi = AlatBantu::where('type', 'master-vap')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['bsi'] = $bsi;
		return (new InvoiceVAPSurveilans($data))->download('Laporan_Surveilans_VAP.xlsx');
	}


	public function idoSurveilans(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$ido = AlatBantu::where('type', 'Surveilans Infeksi Luka Post Ops')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		} else {
			$lokasi_text = 'Semua';
			$ido = AlatBantu::where('type', 'Surveilans Infeksi Luka Post Ops')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','children')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['ido'] = $ido;
		return (new InvoiceIDOSurveilans($data))->download('Laporan_Surveilans_IDO.xlsx');
	}


	public function cuciTangan(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		$hh = AlatHandHygiene::where('user_id', $req->user)->whereBetween('created_at', [$start, $end])->get();
		$user = User::find($req->user);

		$data['start'] = $start;
		$data['end'] = $end;
		$data['hh'] = $hh;
		$data['user'] = $user;

		return (new InvoiceCuciTangan($data))->download('Laporan_Kepatuhan_Cuci_Tangan.xlsx');

		// $pdf = DOMPDF::loadView('mutu.laporan.cuci-tangan',$data)->setPaper('a4', 'landscape');
		// return $pdf->stream('rekap-cuci-tangan-'.$user->name.'.pdf');
	}

	public function kejadianJatuh(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$result_data = AlatKejadianJatuh::whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		} else {
			$lokasi_text = 'Semua';
			$result_data = AlatKejadianJatuh::whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		}
		
		$data['ranap_transaksi'] = app('App\Http\Controllers\RawatInap\Transaksi\ReadController')->countTransaksiInap($start,$end);
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;

		return (new InvoiceKejadianJatuh($data))->download('Laporan_Kejadian_Jatuh.xlsx');
	}

	public function kejadianHAP(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$result_data = AlatBantu::where('type', 'hap')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','sister_kasus')->get();
		} else {
			$lokasi_text = 'Semua';
			$result_data = AlatBantu::where('type', 'hap')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','kasus.identitas','sister_kasus')->get();
		}
		$result_data = $result_data->groupBy('kasus_id');
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceKejadianHAP($data))->download('Laporan_Kejadian_HAP.xlsx');
	}

	public function kejadianPlebitis(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$result_data = AlatBantu::where('type', 'master-plebitis')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','sister_kasus')->get();
		} else {
			$lokasi_text = 'Semua';
			$result_data = AlatBantu::where('type', 'master-plebitis')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','sister_kasus')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceKejadianPlebitis($data))->download('Laporan_Kejadian_Plebitis.xlsx');
	}

	public function kejadianDekubitus(Request $req)
	{

		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$result_data = AlatBantu::where('type', 'surveilans-dekubitus')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','sister_kasus','jumlah_tirah_baring')->get();
		} else {
			$lokasi_text = 'Semua';
			$result_data = AlatBantu::where('type', 'surveilans-dekubitus')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','sister_kasus','jumlah_tirah_baring')->get();
		}
		$result_data = $result_data->groupBy('kasus_id');
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;

		return (new InvoiceKejadianDekubitus($data))->download('Laporan_Kejadian_Dekubitus.xlsx');
	}

	public function kepatuhanSepsis(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$result_data = AlatBantu::where('type', 'sepsis')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien','sister_kasus','jumlah_tirah_baring')->groupBy('kasus_id')->get();
		} else {
			$lokasi_text = 'Semua';
			$result_data = AlatBantu::where('type', 'sepsis')->whereBetween('created_at', [$start, $end])->with('kasus.pasien','sister_kasus','jumlah_tirah_baring')->groupBy('kasus_id')->get();
		}

		$data['ranap_transaksi'] = app('App\Http\Controllers\RawatInap\Transaksi\ReadController')->countTransaksiInap($start,$end);
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceKepatuhanSepsis($data))->download('Laporan_Kepatuhan_Sepsis.xlsx');
	}

	public function waktuTunggu(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$dates = $this->splitDate($start, $end, 'd');
		$poliklinik = Poliklinik::all();
		$result_data = [];
		foreach ($dates as $date) {
			$data_today = LaporanRekapHarian::where('type','waktu-tunggu')->whereDate('tanggal_rekap',$date->start)->get();
			if(count($data_today) > 0 ) {
				foreach($data_today as $item_today){
					$value_data = json_decode($item_today->data);
					$result_data[$date->format_kategori][$item_today->poliklinik_id]['average'] = $value_data->average;
					$result_data[$date->format_kategori][$item_today->poliklinik_id]['total'] = $value_data->total;
				}
			}
			else{
				$result_data[$date->format_kategori] = [];
			}
		}

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		$data['dates'] = $dates;
		$data['poliklinik'] = $poliklinik;
		return (new InvoiceWaktuTunggu($data))->download('Laporan_Waktu_Tunggu_Rawat_Jalan.xlsx');
	}

	public function jamBuka(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$dates = $this->splitDate($start, $end, 'd');
		$poliklinik = Poliklinik::all();
		$result_data = [];
		foreach ($dates as $date) {
			$data_today = LaporanRekapHarian::where('type','jam-buka')->whereDate('tanggal_rekap',$date->start)->get();
			if(count($data_today) > 0 ) {
				foreach($data_today as $item_today){
					$value_data = json_decode($item_today->data);
					$result_data[$date->format_kategori][$item_today->poliklinik_id]['waktu_buka'] = Carbon::parse($value_data->waktu_buka->date);
					$result_data[$date->format_kategori][$item_today->poliklinik_id]['selisih_waktu'] = $value_data->selisih_waktu;

				}
			}
			else{
				$result_data[$date->format_kategori] = [];
			}
		}
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		$data['dates'] = $dates;
		$data['poliklinik'] = $poliklinik;

		return (new InvoiceJamBuka($data))->download('Laporan_Jam_Buka_Pelayanan.xlsx');
	}

	public function kepatuhanIdentifikasi(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];
			$lokasi_id = explode(',', $lokasi[1]);
			$result_data = AlatBantu::where('type', 'identifikasi-pasien')->whereIn('lokasi_id', $lokasi_id)->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		} else {
			$lokasi_text = 'Semua';
			$result_data = AlatBantu::where('type', 'identifikasi-pasien')->whereBetween('created_at', [$start, $end])->with('kasus.pasien')->get();
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceKepatuhanIdentifikasi($data))->download('Laporan_Kepatuhan_Identifikasi_Pasien.xlsx');
	}

	public function kematianPasien48(Request $req)
	{
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 300);
        $start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
        $end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
        $kasus = Kasus::where('krs_status','Meninggal')
            ->whereBetween('krs_at', [$start, $end])
            ->with(
                [
                    'pasien',
                    'diagnosis.icd10',
                    'lokasi.lokasi',
                    'rawat_inap_transaksi_first:id,kasus_id,created_at'
                ]
            )
            ->get()->sortBy('lokasi.lokasi.id');

        foreach($kasus as $key => $item)
        {
            if(!empty($item->rawat_inap_transaksi_first)){
                $waktu_masuk = Carbon::parse($item->rawat_inap_transaksi_first->created_at);
            }
            else{
                unset($kasus[$key]);
                continue;
            }

            $batas_waktu = $waktu_masuk->copy()->addDays(2);

            if(!empty($item->pasien->death_at)) $pasien_mati = Carbon::parse($item->pasien->death_at);
            else {
                unset($kasus[$key]);
                continue;
            }

            if($batas_waktu->gt($pasien_mati)) $item->kurang_dari_48 = 1;
            else $item->kurang_dari_48 = 0;
            $item->waktu_mrs = $waktu_masuk;
        }

        $data['start'] = $start;
        $data['end'] = $end;
        $data['data'] = $kasus;

        return (new InvoiceKematianPasien48($data))->download('Laporan_Kematian_Pasien_48_Jam.xlsx');
	}

	public function kepatuhanVisite(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		if ($req->lokasi != 'all') {
			$lokasi = explode('||', $req->lokasi);
			$lokasi_text = $lokasi[0];

			$lokasi_text = 'Semua';
			$query = "
				SELECT tagihan_detail.id FROM tagihan_detail, cppt
				WHERE cppt.tagihan_detail_id = tagihan_detail.id
				AND cppt.created_at BETWEEN '".$start->toDateTimeString()."' AND '".$end->toDateTimeString()."'
				AND lokasi_id IN (".$lokasi[1].");
			";
			$data = DB::connection('kasus')->select($query);
		} else {
			$lokasi_text = 'Semua';
			$query = "
				SELECT tagihan_detail.id FROM tagihan_detail, cppt
				WHERE cppt.tagihan_detail_id = tagihan_detail.id
				AND cppt.created_at BETWEEN '".$start->toDateTimeString()."' AND '".$end->toDateTimeString()."'
			";
			$data = DB::connection('kasus')->select($query);
		}
		$ids = array_column($data, 'id');
		$result_data = TagihanDetail::whereIn('id',$ids)->with('tagihan.kasus.pasien','creator','lokasi')->get();
		foreach($result_data as $item)
		{
			$batas_waktu = $item->created_at->copy()->startOfDay()->addHours(14);
			if($batas_waktu->gt($item->created_at)) $item->is_tepat_waktu = 1;
			else $item->is_tepat_waktu = 0;
		}
		$data['lokasi'] = $lokasi_text;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceKepatuhanVisite($data))->download('Laporan_Kepatuhan_Jam_Visite.xlsx');
	}

    public function penilaianCPPTKehadiranDPJP(Request $req)
    {
        $start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
        $end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
        if ($req->lokasi != 'all') {
            $lokasi = explode('||', $req->lokasi);
            $lokasi_text = $lokasi[0];
            $lokasi_id = explode(',', $lokasi[1]);
            $cppt=CPPT::wherehas('kasus.lokasi.lokasi', function ($query) use ($lokasi_id) {
                $query->where('id',$lokasi_id);
            })->whereBetween('created_at', [$start, $end])->with(['creator','kasus.lokasi.lokasi'])->get();
            } else {
            $lokasi_text = 'Semua';
            $cppt=CPPT::whereBetween('created_at', [$start, $end])->with(['creator','kasus.lokasi.lokasi'])->get();
        }
        $data['lokasi'] = $lokasi_text;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['cppt'] = $cppt;
        // return (new InvoiceCPPTDanDPJP($data))->download('Evaluasi_Penilaian_CPPT_dan_Kehadiran_DPJP.xlsx');

        $pdf = DOMPDF::loadView('mutu.laporan.penilaian-cppt-dan-kehadiran-dpjp', $data)->setPaper('a4');
   		return $pdf->stream('laporan.pdf');
    }

    public function mata(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		$icd10mata=['H44.0','H52.2'];
		$mata=Diagnosis::wherehas('icd10',function($query)use($icd10mata){
            $query->wherein('code_icd',$icd10mata);
		})->whereBetween('created_at', [$start, $end])->with(['creator','kasus','kasus.pasien','kasus.lokasi.lokasi','icd10'])->get();
		$data['start'] = $start;
		$data['end'] = $end;
		$data['jumlah'] = count($mata);
		$data['data'] = $mata;

		return (new InvoiceMata($data))->download('Laporan_Audit_Mata.xlsx');
	}

	public function igd(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$igd=Kasus::whereBetween('datangigd_at', [$start, $end])->with('pasien')->get();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $igd;

		return (new InvoiceIGD($data))->download('Laporan_Audit_IGD.xlsx');
	}

	public function it(Request $req)
	{
		$start = date('Y-m-d', strtotime($req->date_start));
		$end = date('Y-m-d', strtotime($req->date_end));

		$request['tgl_komplain_start'] = $start;
		$request['tgl_komplain_end']   = $end;

		$result_data = app('App\Http\Controllers\IT\Komplain\ReadController')->getData($request);

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceIT($data))->download('Laporan_Komplain_IT.xlsx');
	}
	public function gizi(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = "";

		return (new InvoiceGizi($data))->download('Laporan_Mutu_Gizi.xlsx');
	}

	public function k3(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		$k3 = Logbook::whereBetween('tanggal_kejadian', array($start,$end))->with('users','employees')->get()->sortByDesc('tanggal_kejadian');
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $k3;

		return (new InvoiceK3($data))->download('Laporan_Keamanan_Keselamatan_dan_Kecelakaan_Kerja.xlsx');
	}

	public function kuisionerPenilaian(Request $req)
	{
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 300);
		$data['nama'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisioner($req->kuisioner_id)->nama;
		$data['data'] = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisionerPenilaian($req->kuisioner_id);
		$data['title'] = strtoupper($data['nama']);
		$namafile = str_replace(' ', '_', $data['nama']);
		return (new LaporanKuisionerPenilaian($data))->download('Hasil_Penilaian_'.$namafile.'.xlsx');
	}

	public function rehabmed(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

        if ($req->lokasi != 'all') {
            $lokasi = explode('||', $req->lokasi);
            $lokasi_text = $lokasi[0];
            $lokasi_id = explode(',', $lokasi[1]);
            $tindakan=Tindakan::wherehas('kasus.lokasi.lokasi', function ($query) use ($lokasi_id) {
                $query->where('id',$lokasi_id);
            })->whereBetween('created_at', [$start, $end])->where('kesalahan_tindakan',1)->groupby('kasus_id')->orderby('created_at')->with(['kasus.pasien','kasus.lokasi.lokasi'])->get();
        } else {
            $lokasi_text = 'Semua';
            $tindakan=Tindakan::whereBetween('created_at', [$start, $end])->where('kesalahan_tindakan',1)->groupby('kasus_id')->orderby('created_at')->with(['kasus.pasien','kasus.lokasi.lokasi'])->get();
        }

        $data['lokasi'] = $lokasi_text;

		$data['start'] = $start;
		$data['end'] = $end;
        $data['jumlah'] = count($tindakan);
		$data['data'] = $tindakan;

		return (new InvoiceRehabmed($data))->download('Laporan_Kesalahan_Tindakan.xlsx');
	}

	public function labpa(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start);
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end);

		$data['start'] = $start;
		$data['end'] = $end;
		$data['target'] = $req->target;
		$data['result'] = app('App\Http\Controllers\LabPA\Laporan\ReadController')->getMutuKetepatan($start, $end, $req->target);

		return (new InvoiceLabPA($data))->download('Laporan_Ketepatan_Pelayanan_Lab_PA.xlsx');
	}

	public function humasKomplain(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		$result_data = Komplain::whereBetween('komplain_tanggal', array($start,$end))->get()->sortByDesc('komplain_tanggal');

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceHumasKomplain($data))->download('Laporan_Humas_Komplain.xlsx');
	}

	public function listrikMati(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$request['mati_at_start'] = $start;
		$request['mati_at_end']   = $end;

		$result_data = app('App\Http\Controllers\Harmat\ListrikMati\ReadController')->getData($request);

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceListrikMati($data))->download('Laporan_Listrik_Mati.xlsx');
	}

	public function perbaikanAlat(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$request['tgl_laporan_start'] = $start;
		$request['tgl_laporan_end']   = $end;

		$result_data = app('App\Http\Controllers\Harmat\PerbaikanAlat\ReadController')->getData($request);

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoicePerbaikanAlat($data))->download('Laporan_Perbaikan_Alat.xlsx');
	}

	public function splitDate($tanggal_awal, $tanggal_akhir, $tipe_waktu)
	{
		$date_result = [];
		if ($tipe_waktu == 'm') {
			$tanggal_awal = $tanggal_awal->startOfMonth();
			$tanggal_akhir = $tanggal_akhir->endOfMonth();
			$current_awal = $tanggal_awal->copy()->startOfDay();
			$current_akhir = $tanggal_awal->copy()->endOfMonth();

			$count = 1;
			$count_max = 24;
			while ($current_akhir <= $tanggal_akhir) {
				$temp = new \stdClass();
				$temp->start = $current_awal->copy();
				$temp->end = $current_akhir->copy();
				$temp->format_kategori = $current_awal->copy()->format('M');
				array_push($date_result, $temp);

				$current_awal->addMonth()->startOfMonth();
				$current_akhir = $current_awal->copy()->endOfMonth();
				if ($count_max == $count++) break;
			}
		} elseif ($tipe_waktu == 'w') {
			$tanggal_awal = $tanggal_awal->startOfWeek();
			$tanggal_akhir = $tanggal_akhir->endOfWeek();
			$current_awal = $tanggal_awal->copy();
			$current_akhir = $tanggal_awal->copy()->endOfWeek();
			$count = 1;
			$count_max = 24;
			while ($current_akhir <= $tanggal_akhir) {
				$temp = new \stdClass();
				$temp->start = $current_awal->copy();
				$temp->end = $current_akhir->copy();
				$temp->format_kategori = $current_awal->copy()->format('d-M');
				array_push($date_result, $temp);

				$current_awal->addWeek()->startOfWeek();
				$current_akhir = $current_awal->copy()->endOfWeek();
				if ($count_max == $count++) break;
			}
		} elseif ($tipe_waktu == 'd') {
			$current_awal = $tanggal_awal->copy();
			$current_akhir = $tanggal_awal->copy()->endOfDay();
			$count = 1;
			$count_max = 24;
			while ($current_akhir <= $tanggal_akhir) {
				$temp = new \stdClass();
				$temp->start = $current_awal->copy();
				$temp->end = $current_akhir->copy();
				$temp->format_kategori = $current_awal->copy()->format('d-M');
				array_push($date_result, $temp);

				$current_awal->addDay()->startOfDay();
				$current_akhir = $current_awal->copy()->endOfDay();
				if ($count_max == $count++) break;
			}
		}
		return $date_result;
	}

	public function labpkGoldar(Request $req)
	{
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 300);

	    $start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['result'] = app('App\Http\Controllers\LabPK\Laporan\ReadController')->getMutuGolonganDarah($start, $end);
		return (new InvoiceGoldar($data))->download('Laporan_Mutu_Golongan Darah.xlsx');
	}

    public function kematianPasienIgd24(Request $req)
    {
        $start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
        $end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
        $result_data = Transaksi::wherehas('kasus', function ($query) use($start,$end){
            $query->from(config('app.db_name').'_kasus.kasus');
            $query->where('krs_status','=','Meninggal')->wherebetween('krs_at', [$start, $end]);
        })->with('kasus','kasus.pasien')->get();
        foreach($result_data as $item)
        {
            $score=app('App\Http\Controllers\IGD\Triage\ViewController')->getTriage($item->kasus_id);
            if(!empty($score)){
                $item->kasus->score=$score;
            }
            else $item->kasus->score=null;
            if(!empty($item->kasus->datangigd_at)){
                $datangigd_at = $item->kasus->datangigd_at;
            }
            else $datangigd_at = $item->kasus->created_at;
            $batas_waktu = $datangigd_at->copy()->addDays(1);

            if(!empty($item->kasus->pasien->death_at)&&$item->kasus->pasien->death_at!='0000-00-00 00:00:00') $pasien_mati = Carbon::parse($item->kasus->pasien->death_at);
            else $pasien_mati = $item->kasus->krs_at;

            if($batas_waktu->gt($pasien_mati)) $item->kasus->kurang_dari_24 = 1;
            else $item->kasus->kurang_dari_24 = 0;
            $item->kasus->datangigd_at = $datangigd_at;
            $item->kasus->krs_at = $pasien_mati;
        }

        $data['start'] = $start;
        $data['end'] = $end;
        $data['data'] = $result_data;

        return (new InvoiceKematianPasienIgd24($data))->download('Laporan_Kematian_Pasien_Igd_24_Jam.xlsx');
    }

 	public function labpkBakteri(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['bakteri'] = $req->bakteri;
		$data['result'] = app('App\Http\Controllers\LabPK\Laporan\ReadController')->getMutuBakteri($start, $end, $req->bakteri);
		return (new InvoiceBakteri($data))->download('Laporan_Mutu_Bakteri.xlsx');
	}

 	public function radiologiFilm(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['bakteri'] = $req->bakteri;
		$data['result'] = app('App\Http\Controllers\Radiology\Laporan\ReadController')->getMutuFilm($start, $end);
		return (new InvoiceRadiologiFilm($data))->download('Laporan_Mutu_Film_Radiologi.xlsx');
	}

 	public function radiologiKetepatanUSG(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['bakteri'] = $req->bakteri;
		$data['result'] = app('App\Http\Controllers\Radiology\Laporan\ReadController')->getMutuKetepatan($start, $end, 'usg');
		return (new InvoiceRadiologiUSG($data))->download('Laporan_Mutu_Ketepatan_USG_Radiologi.xlsx');
	}

 	public function radiologiKetepatanKonvensional(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['bakteri'] = $req->bakteri;
		$data['result'] = app('App\Http\Controllers\Radiology\Laporan\ReadController')->getMutuKetepatan($start, $end, 'konvensional');
		return (new InvoiceRadiologiKonvensional($data))->download('Laporan_Mutu_Ketepatan_Konvensional_Radiologi.xlsx');
	}

	public function kesesuaianBedah(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		$result_data = Pasca::with('transaksi')->whereBetween('tanggal_operasi', array($start,$end))->get()->sortByDesc('tanggal_operasi');

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceKesesuaianBedah($data))->download('Laporan_Kesesuaian_Diagnosis_Bedah.xlsx');
	}

	public function kesesuaianAsesmenPraBedah(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		$result_data = Pasca::with(['transaksi','prabedah'=> function ($query) {
			$query->where('type', '=', 'Pra-Bedah');
		}])->whereBetween('tanggal_operasi', array($start,$end))->get()->sortByDesc('tanggal_operasi');
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $result_data;
		return (new InvoiceAsesmenPraBedah($data))->download('Laporan_Kesesuaian_Asesmen_Pra_Bedah.xlsx');
	}

 	public function gilutKetepatan(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['jenis'] = $req->jenis;
		if($req->jenis == 'Cabut Gigi Salah')
			$data['kolom'] = 'cabut_gigi_salah';
		else if($req->jenis == 'Trauma Bur Gigi')
			$data['kolom'] = 'trauma_bur_gigi';
		$data['result'] = app('App\Http\Controllers\Kasus\Identitas\ReadController')->getMutuKetepatan($start, $end, $data['jenis']);
		return (new InvoiceGigiMulut($data))->download('Laporan_Mutu_Ketepatan_Gigi_Mulut.xlsx');
	}

	public function jantungPD(Request $request)
	{
		$data['data'] = '';
		return (new LaporanPDJantung($data))->download('Laporan_PD_Jantung.xlsx');
	}

	public function steroid(Request $request)
	{
		$data['data'] = '';
		return (new LaporanSteroid($data))->download('Laporan_Steroid_Kulit_Kelamin.xlsx');
	}

	public function couter(Request $request)
	{
		$data['data'] = '';
		return (new LaporanCouter($data))->download('Laporan_Couter_Kulit_Kelamin.xlsx');
	}

	public function dermatits(Request $request)
	{
		$data['data'] = '';
		return (new LaporanDermatits($data))->download('Laporan_Dermatits_Kulit_Kelamin.xlsx');
	}

 	public function thtCWD(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;

		$data['result'] = app('App\Http\Controllers\Kasus\Identitas\ReadController')->getMutuCWD($start, $end);
		return (new InvoiceTHTCWD($data))->download('Laporan_Mutu_THT_CWD.xlsx');
	}

 	public function thtLaring(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;

		$data['result'] = app('App\Http\Controllers\Kasus\Identitas\ReadController')->getMutuLaring($start, $end);
		return (new InvoiceTHTLaring($data))->download('Laporan_Mutu_THT_Laring.xlsx');
	}

 	public function thtSeptoplasti(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;

		$data['result'] = app('App\Http\Controllers\Kasus\Identitas\ReadController')->getMutuSeptoplasti($start, $end);
		return (new InvoiceTHTSeptoplasti($data))->download('Laporan_Mutu_THT_Septoplasti.xlsx');
	}

 	public function thtSinusitis(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;

		$result = app('App\Http\Controllers\Kasus\Identitas\ReadController')->getMutuSinusitis($start, $end);
		$data['result'] = $result['result'];
		$data['kasus_benar'] = $result['kasus_benar'];
		return (new InvoiceTHTSinusitis($data))->download('Laporan_Mutu_THT_Sinusitis.xlsx');
	}

	public function insidenK3(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();
		$k3 = \App\Models\K3\Logbook::whereBetween('tanggal_kejadian', array($start, $end))->with('users')->get()->sortByDesc('tanggal_kejadian');
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $k3;

		return (new InvoiceK3($data))->download('Laporan_Insiden_'.indonesian_date($start).'- '.indonesian_date($end).'.xlsx');
	}

	public function radiologiSPM(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['bakteri'] = $req->bakteri;
		$data['result'] = app('App\Http\Controllers\Radiology\Laporan\ReadController')->getMutuKetepatan($start, $end);
		return (new InvoiceRadiologiSPM($data))->download('Laporan_Mutu_SPM_Radiologi.xlsx');
	}

	public function labPKSPM(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['bakteri'] = $req->bakteri;
		$data['result'] = app('App\Http\Controllers\LabPK\Laporan\ReadController')->getMutuKetepatan($start, $end);
		return (new InvoiceLabPKSPM($data))->download('Laporan_Mutu_SPM_LabPK.xlsx');
	}

	public function identifikasiResiko(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['bagian'] = $req->penanggung_jawab;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['result'] = app('App\Http\Controllers\Mutu\Audit\ReadController')->identifikasiResikoLaporan($start, $end, $req);
		return (new InvoiceIdentifikasiResiko($data))->download('Laporan_Mutu_Identifikasi_Resiko.xlsx');
	}

	public function kegiatanPengendalian(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['bagian'] = $req->penanggung_jawab;
		$data['start'] = $start;
		$data['end'] = $end;
		$data['result'] = app('App\Http\Controllers\Mutu\Audit\ReadController')->kegiatanPengendalianLaporan($start, $end, $req);
		return (new InvoiceKegiatanPengendalian($data))->download('Laporan_Mutu_Kegiatan_Pengendalian.xlsx');
	}

	public function evaluasiKegiatanPengendalian(Request $req)
	{
		$start = Carbon::createFromFormat('d/m/Y', $req->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $req->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['result'] = app('App\Http\Controllers\Mutu\Audit\ReadController')->evaluasiKegiatanPengendalianLaporan($start, $end, $req);
		return (new InvoiceEvaluasiKegiatanPengendalian($data))->download('Laporan_Mutu_Evaluasi_Kegiatan_Pengendalian.xlsx');
	}
}