<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Exports\Pasien\InvoiceMorbiditas;
use App\Exports\Pasien\InvoiceMorbiditasInap;
use App\Exports\Pasien\InvoiceSepuluhRawatJalan;
use App\Exports\Pasien\InvoiceSepuluhRawatInap;
use App\Exports\Pasien\InvoiceDiagnosisInap;
use App\Exports\Pasien\LaporanDiagnosisJenisPasien;
use App\Exports\Pasien\InvoiceICD10;
use App\Exports\Pasien\InvoiceKunjungan;
use App\Exports\Pasien\InvoicePengunjungPulang;
use App\Exports\Pasien\InvoiceKemoterapiRadioterapi;
use App\Exports\Pasien\InvoiceKematianBayiBalita;
use App\Exports\Pasien\InvoiceSars;
use App\Exports\Pasien\InvoiceBaruLama;
use App\Exports\Pasien\InvoiceWabah;
use App\Exports\Pasien\InvoicePasienJiwa;
use App\Exports\Pasien\InvoiceDiabetesBaru;
use App\Exports\Pasien\InvoicePPI;
use App\Exports\Pasien\InvoiceKankerBaru;
use App\Exports\Pasien\DataPasienRawatInap;
use App\Exports\Pasien\RekapTransaksiRJPembayaran;
use App\Exports\Pasien\IndeksDokter;
use App\Exports\Pasien\IndeksPenyakit;
use App\Exports\Pasien\IndeksKematian;
use App\Exports\Pasien\IndeksTindakan;
use App\Exports\Pasien\LaporanKematian;
use App\Exports\Pasien\IndikatorKinerja;
use App\Exports\Pasien\PasienKRS;
use App\Exports\Pasien\LaporanSepuluhBesarMeninggal;
use App\Exports\Pasien\SurveilansTriageIGD;
use App\Exports\Pasien\LaporanPerawatanTerintegrasi;
use App\Exports\Pasien\LaporanKegiatanRS;
use App\Exports\Pasien\LaporanPenderitaHipertensi_4A;
use App\Exports\Pasien\LaporanPenderitaHipertensi_4B;
use App\Exports\Pasien\LaporanPenderitaHipertensi_4C;
use App\Exports\Pasien\LaporanPenderitaUsia1559;
use App\Exports\Pasien\LaporanPersalinan;
use App\Exports\Pasien\DataPelayananPasienRawatInap;
use App\Exports\Pasien\DataPasienRawatJalan;
use App\Exports\Pasien\LaporanWabahMingguan;
use App\Exports\Pasien\LaporanLahirMati;
use App\Exports\Pasien\LaporanKatarak;
use App\Exports\Pasien\LaporanRujukan;
use App\Exports\Pasien\RekapJumlahKasusUser;
use App\Exports\Pasien\LaporanRincianPasienRawatInap;
use App\Exports\Pasien\LaporanDemografi;
use App\Exports\Pasien\LaporanTBC;
use App\Exports\Pasien\LaporanAktifitasPoliPsikologiExcel;
use App\Exports\Pasien\DataPasienIgd;
use App\Exports\Pasien\DataPasienMcu;



use Response;
use Artisan;
use App\Jobs\QueueGenerateSurveilansPTM;


use App\Http\Controllers\Controller;
use App\Jobs\QueueArtisan;
use App\Models\Keuangan\TTD;
use App\Models\Pasien\Pasien;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DB;
use Bugsnag;
use Auth;
use MPDF;
use DOMPDF;

class PostController extends Controller
{
	static protected $ranap = "rawatinap";
	static protected $ralan = "rawatjalan";

	public function morbiditas(Request $request)
	{
		
		$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\MorbiditasController')->get($request->tujuan,$request->format,$date1,$date2);
		$data['date1'] = $date1;
		$data['date2'] = $date2;

		$filename = 'morbiditas__.'.$request->tujuan.'__'.$date1->format('d-m-Y').'__'.$date2->format('d-m-Y').'.xlsx';

		if($request->format == 'rj'){
			return (new InvoiceMorbiditas($data))->download($filename);
		} else {
			return (new InvoiceMorbiditasInap($data))->download($filename);
		}
	}

	public function sepuluhbesar(Request $request)
	{
		
		$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();

		$filename = '10besar__.'.$request->tujuan.'__'.$date1->format('d-m-Y').'__'.$date2->format('d-m-Y').'.xlsx';

		if($request->format == 'rj'){
			$data = app('App\Http\Controllers\Pasien\Laporan\SepuluhBesarPenyakitController')->getRJ($request->tujuan,$date1,$date2);
			$data['date1'] = $date1;
			$data['date2'] = $date2;
			return (new InvoiceSepuluhRawatJalan($data))->download($filename);
		} else {
			$data = app('App\Http\Controllers\Pasien\Laporan\SepuluhBesarPenyakitController')->getRI($request->tujuan,$date1,$date2);
			$data['date1'] = $date1;
			$data['date2'] = $date2;
			return (new InvoiceSepuluhRawatInap($data))->download($filename);
		}

	}

	public function icd10(Request $request)
	{
		try {
			$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
			$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
			$data['start'] = $date1;
			$data['end'] = $date2;
			$data['tujuan'] = $request->tujuan;
			$data['icd10'] = $request->icd10 ?? 'all';
			$data['trans'] = app('App\Http\Controllers\Pasien\Laporan\ICD10Controller')->get($data);
			$data['start_format'] = $date1->format('d-m-Y');
			$data['end_format'] = $date2->format('d-m-Y');
			$start_format = $date1->format('d-m-Y');
			$end_format = $date2->format('d-m-Y');

			
			return (new InvoiceICD10($data))->download('Laporan_Pasien_ICD10_'.$start_format.' - '.$end_format.'.xlsx');

		} catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	public function diagnosis(Request $request)
	{
		try {
			$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
			$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
			$start_format = $date1->format('d-m-y');
			$end_format = $date2->format('d-m-y');
			$data = app('App\Http\Controllers\Pasien\Laporan\DiagnosisJenisPasienController')->diagnosis($request->tujuan,$date1,$date2);

			$data['start'] = $date1;
			$data['end'] = $date2;

			return (new LaporanDiagnosisJenisPasien($data))->download('DiagnosisBerdasarkanJenisPasien-'.$data['layanan'].'_'.$start_format.' - '.$end_format.'.xlsx');
		} catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	public function sepuluhBesarPenyakitPenyebabMeninggal(Request $request)
	{
		$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\SepuluhBesarPenyakitController')->getMeninggal($date1,$date2);

		$data['date1'] = $date1;
		$data['date2'] = $date2;
		

		return (new LaporanSepuluhBesarMeninggal($data))->download('10_besar_rawat_meninggal.xlsx');
	}

	public function kunjungan(Request $request)
	{
		$data['triwulan'] = $request->triwulan;
		$data['tahun'] = $request->tahun;
		$data['tipe'] = 'kunjungan';
		$data['divisi'] = 'rawatjalan';
		return (new InvoiceKunjungan($data))->download('laporan_kunjungan-triwulan_'.$request->triwulan.'.xlsx');
	}

	public function pengunjungRawatJalanTriwulan(Request $request)
	{
		$data['triwulan'] = $request->triwulan;
		$data['tahun'] = $request->tahun;
		$data['tipe'] = 'pengunjung';
		$data['divisi'] = 'rawatjalan';
		return (new InvoiceKunjungan($data))->download('laporan_pengunjung-triwulan_'.$request->triwulan.'.xlsx');
	}

	public function kunjunganIGDTriwulan(Request $request)
	{
		$data['triwulan'] = $request->triwulan;
		$data['tahun'] = $request->tahun;
		$data['tipe'] = 'kunjungan';
		$data['divisi'] = 'igd';
		return (new InvoiceKunjungan($data))->download('laporan_kunjungan-triwulan_'.$request->triwulan.'.xlsx');
	}

	public function pengunjungIGDTriwulan(Request $request)
	{
		$data['triwulan'] = $request->triwulan;
		$data['tahun'] = $request->tahun;
		$data['tipe'] = 'pengunjung';
		$data['divisi'] = 'igd';
		return (new InvoiceKunjungan($data))->download('laporan_pengunjung-triwulan_'.$request->triwulan.'.xlsx');
	}

	public function pengunjungPulang(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		if($request->lokasi == 0) {
			$lokasi = Lokasi::where('lokasi_departemen_id',1)->pluck('id')->toArray();
			$lokasi_text = Lokasi::where('lokasi_departemen_id',1)->pluck('nama')->toArray();
			$lokasi_text = implode(",",$lokasi_text);
		}
		else {
			$lokasi = [];
			$lokasi[] = $request->lokasi;
			$lokasi_text = Lokasi::find($request->lokasi);
			$lokasi_text = $lokasi_text->nama;
		}
		$status = $request->status;

		$kasus = app('App\Http\Controllers\Pasien\Laporan\PengunjungPulangController')->get($start,$end,$lokasi,$status);
		
		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $kasus;
		$data['status'] = $status;
		$data['lokasi'] = $lokasi;
		$data['lokasi_text'] = $lokasi_text;

		return (new InvoicePengunjungPulang($data))->download('laporan-pengunjung-pulang.xlsx');
	}

	public function kemoterapiRadioterapi(Request $request)
	{
		$start = Carbon::parse($request->date_start)->startOfDay();
		$end = Carbon::parse($request->date_end)->endOfDay();

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = '';

		return (new InvoiceKemoterapiRadioterapi($data))->download('laporan-kemoterapi-radioterapi.xlsx');
	}

	public function kematianBayiBalita(Request $request)
	{
		$start = Carbon::parse($request->date_start)->startOfDay();
		$end = Carbon::parse($request->date_end)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\KematianBayiBalitaController')->get($start,$end);

		$data['start'] = $start;
		$data['end'] = $end;
		$data['data'] = $data;

		return (new InvoiceKematianBayiBalita($data))->download('laporan-kematian-bayi-balita.xlsx');
	}


	public function sars(Request $request)
	{
		$data['data'] = '';
		return (new InvoiceSars($data))->download('laporan-surveilans-aktif-rumah-sakit.xlsx');
	}

	public function baruLama(Request $request)
	{
		$data['data'] = '';
		return (new InvoiceBaruLama($data))->download('laporan-jumlah-kunjungan-baru-lama.xlsx');
	}

	public function wabah(Request $request)
	{
		$data['data'] = '';
		return (new InvoiceWabah($data))->download('laporan-wabah.xlsx');
	}

	public function pasienJiwa(Request $request)
	{
		$data['data'] = '';
		return (new InvoicePasienJiwa($data))->download('laporan-pasien-jiwa.xlsx');
	}

	public function diabetesBulanan(Request $request)
	{   
		$data[] = '';
        $pdf = DOMPDF::loadView('pasien.laporan.diabetes-bulanan',$data)->setPaper('a4', 'landscape');
		return $pdf->stream('Laporan Pelayanan Kesehatan Penerita Diabetes Melitus');
	}

	public function diabetesBaru(Request $request)
	{
		$data['data'] = '';
		return (new InvoiceDiabetesBaru($data))->download('laporan-diabetes-baru.xlsx');
	}

	public function ppi(Request $request)
	{
		$data['data'] = '';
		return (new InvoicePPI($data))->download('laporan-pencegahan-pengendalian-infeksi.xlsx');
	}

	public function kankerBaru(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();

		$data['data'] = app('App\Http\Controllers\Pasien\Laporan\LaporanPenderitaKanker')->get($start,$end);
		$data['start'] = $start;
		$data['end'] = $end;
		return (new InvoiceKankerBaru($data))->download('laporan-daftar-penderita-kanker-baru.xlsx');
	}

	public function RekapTransaksiRJPembayaran(Request $request)
	{

		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$perusahaan = app('App\Http\Controllers\Pasien\Laporan\RekapTransaksiRJPembayaranController')->get($start,$end);
		$data['perusahaan'] = $perusahaan;
		$data['start'] = $start;
		$data['end'] = $end;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		return (new RekapTransaksiRJPembayaran($data))->download('rawat-jalan-riwayat-transaksi_'.$start_format.' - '.$end_format.'.xlsx');
	}

	public function indeksDokter(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$layanan = $request->layanan;
		$dokter = app('App\Http\Controllers\Pasien\Laporan\IndeksDokterController')->get($start,$end,$layanan);
		$data['dokter'] = $dokter;
		$data['start'] = $start;
		$data['end'] = $end;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		return (new IndeksDokter($data))->download('indeks-dokter_'.$start_format.' - '.$end_format.'.xlsx');
	}

	public function indeksPenyakit(Request $request)
	{

		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$layanan = $request->tujuan;
		$diagnosis = app('App\Http\Controllers\Pasien\Laporan\IndeksPenyakitController')->get($start,$end,$layanan);
		$data['diagnosis'] = $diagnosis;
		$data['start'] = $start;
		$data['end'] = $end;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		//return view('pasien.laporan.indeks-penyakit',$data);
		return (new IndeksPenyakit($data))->download('indeks-penyakit'.$start_format.' - '.$end_format.'.xlsx');
	}

	public function indeksKematian(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$layanan = $request->tujuan;
		$kasus = app('App\Http\Controllers\Pasien\Laporan\IndeksKematianController')->get($start,$end,$layanan);
		$data['kasus'] = $kasus;
		$data['start'] = $start;
		$data['end'] = $end;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		//return view('pasien.laporan.indeks-kematian',$data);
		return (new IndeksKematian($data))->download('indeks-kematian'.$start_format.' - '.$end_format.'.xlsx');
	}

	public function indeksTindakan(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$layanan = $request->tujuan;
		$tindakan = app('App\Http\Controllers\Pasien\Laporan\IndeksTindakanController')->get($start,$end,$layanan);
		$data['tindakan'] = $tindakan;
		$data['start'] = $start;
		$data['end'] = $end;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		///return view('pasien.laporan.indeks-tindakan',$data);
		return (new IndeksTindakan($data))->download('indeks-tindakan'.$start_format.' - '.$end_format.'.xlsx');
	}

	public function RMResponseTime(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$transaksi = app('App\Http\Controllers\Pasien\Laporan\RMResponseTimeController')->get($start,$end);
		$data['transaksi'] = $transaksi;
		$data['start'] = $start;
		$data['end'] = $end;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');


		$filename = 'Laporan-RM-Response-Time_'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.rm-response-time',$data);

		return $pdf->stream($filename);
		//return (new IndeksTindakan($data))->download('indeks-tindakan'.$start_format.' - '.$end_format.'.xlsx');
	}

	public function pasienResumeInap(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$transaksi = app('App\Http\Controllers\Pasien\Laporan\PasienResumeInapController')->get($start, $end);
		$data['transaksi'] = $transaksi;
		$data['start'] = $start;
		$data['end'] = $end;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');


		$filename = 'Pasien-Resume-Inap_'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.pasien-resume',$data);

		return $pdf->stream($filename);
	}

	public function laporanKematian(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$tujuan = $request->tujuan;

        $data = app('App\Http\Controllers\Pasien\Laporan\LaporanKematianController')->get($start,$end,$tujuan);

		return (new LaporanKematian($data))->download('laporan-kematian-bulan_'.$start->format('d-m-Y').'__'.$end->format('d-m-Y').'.xlsx');
	}

	public function laporanKRS(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$lokasi = $request->tujuan;

		$data['start'] = $start;
		$data['end'] = $end;
		$data['lokasi'] = $lokasi;

		return (new PasienKRS($data))->download('laporan_KRS.xlsx');
	}

	public function rekapLaporanKunjunganRawatJalan(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$poliklinik = app('App\Http\Controllers\Pasien\Laporan\RekapLaporanKunjunganRawatJalanController')->get($start,$end);
		$data['poliklinik'] = $poliklinik;

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		$filename = 'rekap-laporan-kunjungan-rawat-jalan_'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.rekap-laporan-kunjungan-rawat-jalan',$data);

		return $pdf->stream($filename);
	}

	public function dataPendukungRekapLaporanKunjunganRawatJalan(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$poliklinik = app('App\Http\Controllers\Pasien\Laporan\DataPendukungRekapLaporanKunjunganRawatJalanController')->get($start,$end);
		$data['poliklinik'] = $poliklinik;

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		$filename = 'data-pendukung-rekap-laporan-kunjungan-rawat-jalan_'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.data-pendukung-rekap-laporan-kunjungan-rawat-jalan',$data);

		return $pdf->stream($filename);
	}

	public function dataPelayananBerdasarkanUsiaRawatJalan(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$usia = app('App\Http\Controllers\Pasien\Laporan\DataPelayananBerdasarkanUsiaRawatJalanController')->get($start,$end);
		$data['usia'] = $usia;

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		$filename = 'data-pelayanan-berdasarkan-usia-rawat-jalan_'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.data-pelayanan-berdasarkan-usia-rawat-jalan',$data);

		return $pdf->stream($filename);
	}

	public function sepuluhBesarRawatJalanDiagnosaICD(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$diagnosis = app('App\Http\Controllers\Pasien\Laporan\SepuluhBesarRawatJalanDiagnosaICDController')->get($start,$end);
		$data['diagnosis'] = $diagnosis;

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		$filename = 'data-pelayanan-berdasarkan-usia-rawat-jalan_'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.sepuluh-besar-rawat-jalan-diagnosa-icd',$data);

		return $pdf->stream($filename);
	}
	public function sepuluhBesarRawatJalanDiagnosaICDSetiapPoli(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$poliklinik = app('App\Http\Controllers\Pasien\Laporan\SepuluhBesarRawatJalanDiagnosaICDSetiapPoliController')->get($start,$end);
		$data['poliklinik'] = $poliklinik;

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		$filename = 'data-pelayanan-berdasarkan-usia-rawat-jalan_'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.sepuluh-besar-rawat-jalan-diagnosa-icd-setiap-poli',$data);

		return $pdf->stream($filename);
	}

	public function laporanPopulasi(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$layanan = $request->tujuan;

		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanPopulasiController')->get($start,$end,$layanan);

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		$filename = 'laporan-populasi'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.laporan-populasi',$data);

		return $pdf->stream($filename);
	}

	public function laporanDemografi(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$tujuan = $request->tujuan;
		$kota = $request->kota;
		$icd10 = $request->icd10;
		$usia = $request->usia;
		$jk = $request->jenis_kelamin;

		if(empty($request->icd10) || count($request->icd10) == 0) $icd10 = 'semua';

		$data['data'] = app('App\Http\Controllers\Pasien\Laporan\LaporanDemografiController')
		->get($start,$end,$tujuan,$icd10,$usia,$jk);

		$data_usia=[];
		if($request->usia == 'semua'){
			$data_usia[]='0-14';
			$data_usia[]='15-24';
			$data_usia[]='25-44';
			$data_usia[]='45-64';
			$data_usia[]='>65';
		}else{
			$data_usia[]=$request->usia;
		}

		$data_jenis_kelamin=[];
		if($request->jenis_kelamin == 'semua'){
			$data_jenis_kelamin[]='L';
			$data_jenis_kelamin[]='P';
		}elseif($request->jenis_kelamin==1){
			$data_jenis_kelamin[]='L';
		}elseif($request->jenis_kelamin==2){
			$data_jenis_kelamin[]='P';
		}

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;
		$data['layanan']=$request->layanan;
		$data['usia']=$request->usia;
		$data['data_usia']=$data_usia;
		$data['jenis_kelamin']=$request->jenis_kelamin;
		$data['data_jenis_kelamin']=$data_jenis_kelamin;

		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');

		$filename = 'laporan-demografi'.$start_format.'_'.$end_format.'.xlsx';
		return (new LaporanDemografi($data))->download($filename);
	}

	public function laporanSurveilans(Request $request)
	{
		$start_date = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay()->format('d-m-Y');
		$end_date = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay()->format('d-m-Y');;
        $type = $request->type;

        if ($type == 1) {
            $slug = 'RawatInap';
            $slug2 = 'rawat-inap';
        } else {
            $slug = 'RawatJalan';
            $slug2 = 'rawat-jalan';
        }

        $filename = 'LaporanSurveilansPTM_'.$slug.'_'.$start_date.'_'.$end_date.'.xlsx';
        $path = public_path().'/downloads/laporan/pasien-surveilans-ptm';
        $path_download = url('/').'/downloads/laporan/pasien-surveilans-ptm';
        $check_file = file_exists($path.'/'.$filename);

        if ($check_file) {
        	return redirect($path_download.'/'.$filename);
        } else {
        	$data['start_date'] = $start_date;
        	$data['end_date'] = $end_date;
        	$data['slug'] = $slug2;
        	dispatch(new QueueGenerateSurveilansPTM($data));
        	return abort(201);
        }     
	}

	public function laporanDiabetes(Request $request)
	{	
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanDiabetesMellitus')->get($start,$end);
		
		$pdf = DOMPDF::loadView('pasien.laporan.diabetes',$data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Diabetes.pdf';
		return $pdf->stream($filename);
	}

	public function laporanHipertensi(Request $request)
	{	
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanHipertensi')->get($start,$end);
		
		$pdf = DOMPDF::loadView('pasien.laporan.hipertensi',$data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Hipertensi.pdf';
		return $pdf->stream($filename);
	}

	public function laporanTBC(Request $request)
	{   

		$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanTBC')->get($date1,$date2);
        
		$start_format = $date1->format('d-m-y');
		$end_format = $date2->format('d-m-y');

		$filename = 'laporan-tbc__'.$start_format.'_'.$end_format.'.xlsx';
		return (new LaporanTBC($data))->download($filename);
	}

	public function penyisiranKasusTB(Request $request)
	{   
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');
		
		$data = app('App\Http\Controllers\Pasien\Laporan\PenyisiranKasusTB')->get($start,$end);
		$filename = 'laporan-penyisiran-kasus-tb'.$start_format.'_'.$end_format.'.pdf';
		$pdf = MPDF::loadView('pasien.laporan.laporan-penyisiran-kasus-tb', $data, [], [
			'mode' => 'utf-8',
			'format' => 'A4-L'
		]);
		$filename = 'Laporan_TBC.pdf';
		return $pdf->stream($filename);
	}


	public function surveilansTriageIGD(Request $request)
	{   
		$start = Carbon::parse($request->tbc_date_start)->startOfDay();
		$end = Carbon::parse($request->tbc_date_end)->endOfDay();
		$start_format = $start->format('d-m-y');
		$end_format = $end->format('d-m-y');
		
		$data = app('App\Http\Controllers\Pasien\Laporan\SurveilansTriageIGD')->get($start,$end);
		$filename = 'surveilans-triage-igd'.$start_format.'_'.$end_format;
        	return view('pasien.laporan.surveilans-triage-igd',$data);
		//return (new SurveilansTriageIGD($data))->download($filename.'.xlsx');
	}



	public function laporanKatarak(Request $request)
	{
		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanKatarakController')->get($request);
		$pdf = DOMPDF::loadView('pasien.laporan.katarak',$data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Katarak.pdf';
		return $pdf->stream($filename);
	}

	public function katarak(Request $request)
	{
		$data['data'] = '';
		return (new LaporanKatarak($data))->download('Laporan_Katarak.xlsx');
	}

	public function laporanSTP(Request $request)
	{
		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanSTPController')->get($request);
		$data['jenis_penyakit_A']=array(
			['A00', 'Kolera'],
			['A09', 'Diare'],
			['A09', 'Diare Berdarah'],
			['A01.9', 'Tifus perut klinis'],
			['A01.0', 'Tifus perut widal'],
			['A15.9', 'TBC Paru BTA (+)'],
			['A16.2', 'Tersangka TBC Paru'],
			['A30.0', 'Kusta PB'],
			['A30.9', 'Kusta MB'],
			['B30.9', 'Campak'],
			['A36', 'Difteri'],
			['A37', 'Batuk Rejan'],
			['A34', 'Tetanus'],
			['K75.9', 'Hepatitis Klinis'],
			['B16', 'Hepatitis HBsAg(+)'],
			['B54', 'Malaria Klinis'],
			['B51', 'Malaria Vivax'],
			['B50', 'Malaria Falsiparum'],
			['B52', 'Malaria mix'],
			['A91', 'Demam berdarah dengue']
		);
		$data['jenis_penyakit_B']=array(
			['A90', 'Demam dengue'],
			['J18.9', 'Pneumonia'],
			['A53.9', 'Sifilis'],
			['A54.9', 'Gonorrhea'],
			['A66.9', 'Frambusia'],
			['B74.9', 'Filiarisis'],
			['J11.1', 'Influensa'],
			['G04.9', 'Ensefalitis'],
			['G03.9', 'Meningitis'],
			['I20.9', 'Angina Pektoris'],
			['I21.9', 'Infark Miokard Akut'],
			['I25.2', 'Old Myocardial Infarction'],
			['I10', 'Hipertensi Esensial'],
			['I11.9', 'Hipertensi Heart Disease'],
			['I48', 'Atrial Fibriliation'],
			['I12.9', 'Ginjal Hipertensi'],
			['I13.9', 'Jantung dan Ginjal Hipertensi'],
			['I15.9', 'Hipertensi Sekunder'],
			['E10', 'DM Bergantung Insulin'],
			['E11', 'DM Tak Bergantung Insulin'],
			['E12', 'DM Berhubungan Malnutrisi'],
			['E14', 'DM TYD Lain'],
			['E14.9', 'DM YTT'],
			['C53.9', 'Neoplasma Ganas Servix'],
			['C50.9', 'Neoplasma Ganas Payudara'],
			['C22.9', 'Neoplasma Ganas Hati & Saluran Empedu Intrahepatik'],
			['C34', 'Neoplasma Ganas Bronkus dan Paru']
		);
		$data['jenis_penyakit_C']=array(
			['J44.8', 'Paru Obstruktif Menahun'],
			['V01-99', 'Kecelakaan Lalulintas'],
			['F22', 'Psikosis']
		);
		$data['ttd'] = TTD::find($request->mengetahui);

		$pdf = DOMPDF::loadView('pasien.laporan.stp', $data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_STP.pdf';
		return $pdf->stream($filename);
	}

	public function kematianDinkes(Request $request)
	{	
		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanKematianDinkes')->get($request);
		
		$pdf = DOMPDF::loadView('pasien.laporan.kematian-dinkes',$data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Kematian_Dinas_Kesehatan.pdf';
		return $pdf->stream($filename);
	}

	public function kematianRSAL(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\KematianRSALController')->get($start,$end);

		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;
		
		$pdf = DOMPDF::loadView('pasien.laporan.kematian-rsal',$data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Kematian_Arsip_RSAL.pdf';
		return $pdf->stream($filename);
	}

	public function P2K(Request $request)
	{	
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$data = app('App\Http\Controllers\Pasien\Laporan\LaporanSakitKronis')->get($start,$end);

		$pdf = DOMPDF::loadView('pasien.laporan.p2k',$data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Penderita_Penyakit_Kronis.pdf';
		return $pdf->stream($filename);
	}

	public function ranap(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$items = app('App\Http\Controllers\Pasien\Laporan\DataPasienRawatInap')->get($start,$end);
		$data['data'] = $items;
		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;


		return (new DataPasienRawatInap($data))->download('data_pasien_rawat_inap.xlsx');
	}

	public function lansia(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$items = app('App\Http\Controllers\Pasien\Laporan\LaporanLansia')->get($start,$end);
		$data['data'] = $items;
		$start_format_view = $start->format('d M y');
		$end_format_view = $end->format('d M y');
		$data['start'] = $start_format_view;
		$data['end'] = $end_format_view;

		$pdf = DOMPDF::loadView('pasien.laporan.lansia',$data)->setPaper('a4', 'potrait');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Pasien_Lansia.pdf';
		return $pdf->stream($filename);
	}

	public function indikatorKinerja(Request $request)
	{	
		$data = app('App\Http\Controllers\Pasien\Laporan\KinerjaPelayananRS')->get($request);
		return (new IndikatorKinerja($data))->download('indikator_kinerja.xlsx');
	}

	public function kematianBPJS(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$items = app('App\Http\Controllers\Pasien\Laporan\KematianBPJS')->get($start,$end);
		$data['data'] = $items;
		$data['start'] = $start;
		$data['end'] = $end;

		$pdf = DOMPDF::loadView('pasien.laporan.kematian-bpjs', $data)->setPaper('legal', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$filename = 'Laporan_Kematian_BPJS.pdf';
		return $pdf->stream($filename);
	}


	public function perawatanIntegrasi(Request $request)
	{
		$data['data'] = '';
		return (new LaporanPerawatanTerintegrasi($data))->download('laporan_perawatan_integrasi.xlsx');
	}

	public function kegiatanRS(Request $request)
	{
		$data['data'] = '';
		return (new LaporanKegiatanRS($data))->download('laporan_kegiatan_rs.xlsx');
	}

	public function penderitaHipertensi_4A(Request $request)
	{
		$data['data'] = '';
		return (new LaporanPenderitaHipertensi_4A($data))->download('laporan_penderita_hipertensi.xlsx');
	}

	public function penderitaHipertensi_4B(Request $request)
	{
		$data['data'] = '';
		return (new LaporanPenderitaHipertensi_4B($data))->download('laporan_penderita_hipertensi.xlsx');
	}

	public function penderitaHipertensi_4C(Request $request)
	{
		$data['data'] = '';
		return (new LaporanPenderitaHipertensi_4C($data))->download('laporan_penderita_hipertensi.xlsx');
	}

	public function persalinan(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();

		$result = app('App\Http\Controllers\Pasien\Laporan\PersalinanBulananController')->get($start,$end);
		$data['data'] = $result;
		$data['start'] = $start;
		$data['end'] = $end;
		return (new LaporanPersalinan($data))->download('laporan_persalinan.xlsx');
	}

	public function wabahMingguan(Request $request)
	{
		$data['data'] = '';
		return (new LaporanWabahMingguan($data))->download('laporan_mingguan_wabah.xlsx');
	}

	public function penderitaUsia1559(Request $request)
	{
		$data['data'] = '';
		return (new LaporanPenderitaUsia1559($data))->download('laporan_penderita_usia_15_59.xlsx');
	}

	public function pasienRawatJalan(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$result = app('App\Http\Controllers\Pasien\Laporan\DataPelayananPasien')->get($start,$end, 'Rawat Jalan');
		$data['date_start'] = $result['date_start'];
		$data['date_end'] = $result['date_end'];
		$data['data'] = $result['data'];
		return (new DataPasienRawatJalan($data))->download('data_pasien_rawat_jalan.xlsx');
	}

	public function pasienRawatInap(Request $request)
	{
		$start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$result = app('App\Http\Controllers\Pasien\Laporan\DataPelayananPasien')->get($start,$end, 'Rawat Inap');
		$data['date_start'] = $result['date_start'];
		$data['date_end'] = $result['date_end'];
		$data['data'] = $result['data'];
		return (new DataPelayananPasienRawatInap($data))->download('data_pelayanan_pasien_rawat_inap.xlsx');
	}

	public function rekapJumlahKasusUser(Request $request)
	{

		$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$profesi = $request->profesi;


		$result = app('App\Http\Controllers\Pasien\Laporan\RekapJumlahKasusUser')->get($date1,$date2,$profesi);
		$data['date_start'] = $date1;
		$data['date_end'] = $date2;
		$data['data'] = $result['data'];
		return (new RekapJumlahKasusUser($data))->download('rekap_jumlah_kasus_user.xlsx');
	}

	public function lahirMati(Request $request)
	{
		$data['data'] = '';
		return (new LaporanLahirMati($data))->download('laporan_lahir_mati.xlsx');
	}
	
	public function rincianPasienRanap(Request $req)
	{
        $date1 = Carbon::createFromFormat('d/m/Y', $req->daterange1)->startOfDay();
        $date2 = Carbon::createFromFormat('d/m/Y', $req->daterange2)->endOfDay();
		$result = app('App\Http\Controllers\Pasien\Laporan\RincianPasienRawatInapController')->get($date1,$date2);
		$data['mrs'] = $result['mrs'];
		$data['krs'] = $result['krs'];
		$data['pindahan'] = $result['pindahan'];
        $data['date_start'] = $date1;
        $data['date_end'] = $date2;

		$filename = 'Laporan_Rincian_Pasien_Rawat_Inap.xlsx';
		return (new LaporanRincianPasienRawatInap($data))->download($filename);
	}

	public function rincianHarianPasienDirawat(Request $req)
	{
		// $result = app('App\Http\Controllers\Pasien\Laporan\RincianPasienRawatInapController')->get($req->date);
		// $data['kelas'] = $result['kelas'];
		// $data['result'] = $result['result']['result'];
		// $data['total_kelas'] = $result['result']['total_kelas'];
		// $data['total'] = $result['result']['total'];
		// $data['date'] = $req->date;
		// $data['ttd'] = TTD::find($req->mengetahui);
		// $data['tanggal_ttd'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%B %Y');

		// $pdf = DOMPDF::loadView('pasien.laporan.rincian-harian-pasien-dirawat', $data)->setPaper('legal', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		// $filename = 'Laporan_Rincian_Harian_Pasien_Rawat_Inap.pdf';
		// return $pdf->stream($filename);
		$result = app('App\Http\Controllers\Pasien\Laporan\RincianPasienRawatInapController')->get($req->date);
		$data['mrs'] = $result['mrs'];
		$data['krs'] = $result['krs'];
		$data['pindahan'] = $result['pindahan'];
		$date = Carbon::parse($req->date);
		$data['date'] = $date;

		$filename = 'Laporan_Rincian_Pasien_Rawat_Inap'.$date->format('Y-m-d').'.xlsx';
		return (new LaporanRincianPasienRawatInap($data))->download($filename);
	}

	public function rujukan(Request $request)
	{
		$data['data'] = '';
		return (new LaporanRujukan($data))->download('Laporan_Rujukan_RS.xlsx');
	}

	public function laporanAktifitasPoliPsikologi(Request $request)
	{
		$date1 = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
		$date2 = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
		$result = app('App\Http\Controllers\Pasien\Laporan\LaporanAktifitasPoliPsikologiController')->get($date1,$date2);
		$data['date_start'] = $date1;
		$data['date_end'] = $date2;
		$data['data'] = $result;

		$filename = 'LaporanAktifitasPoliPsikologi__'.$date1->format('d-m-Y').'__'.$date2->format('d-m-Y');

		return (new LaporanAktifitasPoliPsikologiExcel($data))->download($filename.'.xlsx');
	}

    public function kunjunganUnitTindakanTriwulan(Request $request)
    {
        $data['triwulan'] = $request->triwulan;
        $data['tahun'] = $request->tahun;
        $data['tipe'] = 'kunjungan';
        $data['divisi'] = 'unittindakan';
        return (new InvoiceKunjungan($data))->download('laporan_kunjungan-triwulan_'.$request->triwulan.'.xlsx');
    }

    public function dataPasienIgd(Request $request)
    {
        $start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
        $end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
        $result = app('App\Http\Controllers\Pasien\Laporan\DataPelayananPasien')->get($start,$end, 'IGD');
        $data['date_start'] = $result['date_start'];
        $data['date_end'] = $result['date_end'];
        $data['data'] = $result['data'];
        return (new DataPasienIgd($data))->download('data_pasien_igd.xlsx');
    }

    public function dataPasienMCU(Request $request)
    {
        $start = Carbon::createFromFormat('d/m/Y', $request->daterange1)->startOfDay();
        $end = Carbon::createFromFormat('d/m/Y', $request->daterange2)->endOfDay();
        $result = app('App\Http\Controllers\Pasien\Laporan\DataPelayananPasien')->get($start,$end, 'MCU');
        $data['date_start'] = $result['date_start'];
        $data['date_end'] = $result['date_end'];
        $data['data'] = $result['data'];
        return (new DataPasienMcu($data))->download('data_pasien_medical_checkup.xlsx');
    }

	public function sensusRawatInap(Request $request)
	{
		dispatch(new QueueArtisan('pasien:laporan-generate-sensus-rawat-inap',[
			'date' => $request->monthyear
		]));

		return abort(201);
	}

	public function sensusRawatInapRuangan(Request $request)
	{
		dispatch(new QueueArtisan('pasien:laporan-generate-sensus-rawat-inap-ruangan',[
			'date' => $request->monthyear,
			'ruangan' => $request->ruangan
		]));

		return abort(201);
	}
}