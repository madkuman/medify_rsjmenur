<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Keuangan\Perusahaan;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\Tarif;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\Kasus;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\Resep;
use App\Models\Farmasi\ResepDetail;
use App\Models\KamarOperasi\PeranTim;
use App\User;
use App\Exports\Keuangan\ExcelRemunerasiPrintLaporanKinerja;

class RemunerasiController extends Controller
{
	public function laporanKinerjaBerdasarkanTagihan(Request $request)
	{

        ini_set('max_execution_time', 300);
        ini_set('memory_limit','2048M');
		$sumber_data = $request->sumber_data;
		$start = Carbon::createFromFormat('d-m-Y', $request->tanggal_awal)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->tanggal_akhir)->endOfDay();

		$start_format = Carbon::createFromFormat('d-m-Y', $request->tanggal_awal)->format('d F Y');
		$end_format = Carbon::createFromFormat('d-m-Y', $request->tanggal_akhir)->format('d F Y');

		$lokasi_id = $request->lokasi_id;
		$user_id = $request->user_id;
		$perusahaan_id = $request->perusahaan_id;

		if($lokasi_id == 0) $lokasi_ids = Lokasi::get()->pluck('id')->toArray();
		else $lokasi_ids = explode(",", $lokasi_id);

		if($user_id == 0) $user_ids = User::get()->pluck('id')->toArray();
		else $user_ids = [$user_id];

		if($perusahaan_id == 0) $perusahaan_ids = Perusahaan::get()->pluck('id')->toArray();
		else $perusahaan_ids = [$perusahaan_id];

		$tarif_kategori_forbidden = [3]; //tarif ranap kaya misal ruangan ranap
		$tarif_master_id_forbidden = TarifMaster::whereIn('kategori_id',$tarif_kategori_forbidden)->pluck('id')->toArray();
		$tarif_id_exclusions = Tarif::where('tarif_master_id',$tarif_master_id_forbidden)->pluck('id')->toArray();

		if($sumber_data == 'pemasukan')
		{
			$pemasukan_piutang = Pemasukan::whereBetween('created_at',[$start,$end])->whereIn('perusahaan_id',$perusahaan_ids)->pluck('piutang_id')->toArray();

			$kasus_tagihan_id = Piutang::whereIn('id',$pemasukan_piutang)->whereNotNull('kasus_tagihan_id')->pluck('kasus_tagihan_id')->toArray();

			$details = TagihanDetail::whereIn('kasus_tagihan_id',$kasus_tagihan_id)->whereIn('created_by',$user_ids)->whereNotIn('tarif_id',$tarif_id_exclusions)->whereIn('lokasi_id',$lokasi_ids)->with('creator','lokasi.departemen','tagihan.kasus.pasien.tni_pangkat','tagihan.kasus.pembayaran.perusahaan.perusahaan_keuangan','tagihan.kasus.pembayaran.perusahaan.tipe','tagihan.kasus.sep', 'tagihan.kasus.admin.user')->get();
		}
		elseif($sumber_data == 'piutang')
		{
			$kasus_tagihan_id = Piutang::whereBetween('created_at',[$start,$end])->whereIn('perusahaan_id',$perusahaan_ids)->whereNotNull('kasus_tagihan_id')->pluck('kasus_tagihan_id')->toArray();

			$details = TagihanDetail::whereIn('kasus_tagihan_id',$kasus_tagihan_id)->whereIn('created_by',$user_ids)->whereNotIn('tarif_id',$kasus_tagihan_id)->whereIn('lokasi_id',$lokasi_ids)->with('creator','lokasi.departemen','tagihan.kasus.pasien.tni_pangkat','tagihan.kasus.pembayaran.perusahaan.perusahaan_keuangan','tagihan.kasus.pembayaran.perusahaan.tipe','tagihan.kasus.sep', 'tagihan.kasus.admin.user')->get();
		}
		elseif($sumber_data == 'pemasukan-retribusi')
		{
			$pemasukan_ids = Pemasukan::whereBetween('created_at',[$start,$end])->where('judul','LIKE','%Retribusi%')->whereIn('perusahaan_id',$perusahaan_ids)->pluck('id')->toArray();

			$details = PemasukanDetail::whereIn('pemasukan_id',$pemasukan_ids)->with('creator','lokasi.departemen','pemasukan.pasien','pemasukan.pasienPembayaran.perusahaan.perusahaan_keuangan','pemasukan.pasienPembayaran.perusahaan.tipe','pemasukan.pasienPembayaran.kelas')->get();
		}
		elseif($sumber_data == 'farmasi')
		{
			$resep_ids = TransaksiObat::whereBetween('paid_at',[$start,$end])->pluck('resep_final')->toArray();

			$details = ResepDetail::whereIn('resep_id',$resep_ids)->with('resep.transaksi.paidBy','resep.transaksi.owner_detail','resep.transaksi.pasien_detail','resep.transaksi.pembayaran_detail.perusahaan.perusahaan_keuangan','resep.transaksi.pembayaran_detail.perusahaan.tipe','resep.transaksi.kasus.kelas','resep.transaksi.kasus.admin.user')->get();
		}
		else
		{
			$kasus = Kasus::whereBetween('created_at',[$start,$end])->pluck('id')->toArray();

			$kasus_tagihan_id = Tagihan::whereIn('kasus_id',$kasus)->pluck('id')->toArray();

			$details = TagihanDetail::whereIn('kasus_tagihan_id',$kasus_tagihan_id)->whereIn('created_by',$user_ids)->whereIn('lokasi_id',$lokasi_ids)->with('creator','lokasi.departemen','tagihan.kasus.pasien.tni_pangkat','tagihan.kasus.pembayaran.perusahaan.perusahaan_keuangan','tagihan.kasus.pembayaran.perusahaan.tipe', 'tagihan.kasus.sep', 'tagihan.kasus.admin.user','operasi.tim','tagihan.kasus.kelas','operasi.tim.detail')->get();
		}
		$data['start'] = $start;
		$data['end'] = $end;
		$data['sumber_data'] = $sumber_data;
		$data['peran_tim_ok'] = PeranTim::all();
		$data['data'] = $details;
		$data['tarif_id_exclusions'] = $tarif_id_exclusions;

		return (new ExcelRemunerasiPrintLaporanKinerja($data))->download('Remunerasi_Laporan_Kinerja'.$start_format.'-'.$end_format.'.xlsx');

		/*
        if($data['sumber_data'] == 'pemasukan-retribusi')
            return view('keuangan.laporan.remunerasi.laporan-kinerja-pemasukan-retribusi',$data);
        if($data['sumber_data'] == 'farmasi')
            return view('keuangan.laporan.remunerasi.laporan-kinerja-farmasi',$data);      
        else
            return view('keuangan.laporan.remunerasi.laporan-kinerja-tagihan',$data);
		*/

	}
}
