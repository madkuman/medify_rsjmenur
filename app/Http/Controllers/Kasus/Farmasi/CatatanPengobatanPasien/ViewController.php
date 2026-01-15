<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\CatatanPengobatanPasien;
use App\Models\Kasus\CatatanPengobatanPasienDetail;
use Carbon\Carbon;
use DB;
use MPDF;
use DOMPDF;

class ViewController extends Controller
{
	public function print($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();


		$data = $this->getData($kasus);
		$data['kasus'] = $kasus;

		$pdf = MPDF::loadView('kasus.farmasi.pengobatan-components.print', $data, [], [
			'mode' => 'utf-8',
			'format' => 'A4'
		]);
		$filename = $kasus->pasien->no_rm . '-pemberian-obat-pasien-' . $kasus->id . '.pdf';

		return $pdf->stream($filename);
	}

	public function cetakRiwayatPemberianObat(Request $request, $nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$data['data'] = [];
		$data['carbon_tanggal'] = $carbon_tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
		$data['format'] = $request->format ?? 'dengan_telaah_obat';
		$list_pemberian_obat = [];

		$eager = [
			'farmasi_resep_detail.resep.transaksi.transaksi_obat_telaah_obat_penyiapan',
			'farmasi_resep_detail.resep.transaksi.transaksi_obat_telaah_obat_pengemasan',
			'farmasi_resep_detail.resep.transaksi.transaksi_obat_telaah_obat_penyerahan',
			'farmasi_resep_detail.resep.transaksi.transaksi_obat_telaah_obat_penerimaan_perawat',
			'details' => function ($query) use ($carbon_tanggal) {
				$query->whereBetween('pemberian_at', [$carbon_tanggal->copy()->startOfDay(), $carbon_tanggal->copy()->endOfDay()]);
			}
		];
		$catatan_pengobatan_pasien = CatatanPengobatanPasien::with($eager)
			->where('kasus_id', $kasus->id)
			->whereHas('details', function ($query) use ($carbon_tanggal) {
				$query->whereBetween('pemberian_at', [$carbon_tanggal->copy()->startOfDay(), $carbon_tanggal->copy()->endOfDay()]);
			})
			->get();
		foreach ($catatan_pengobatan_pasien as $item) {
			$item_pemberian_obat['catatan_pengobatan_pasien'] = $item;
			$item_pemberian_obat['total_obat'] = $item->farmasi_resep_detail->sum('jumlah');

			$item_pemberian_obat['aturan_pakai_1'] = [
				'catatan_pengobatan_pasien_detail' => null,
				'resep_detail' => [],
			];
			$item_pemberian_obat['aturan_pakai_2'] = [
				'catatan_pengobatan_pasien_detail' => null,
				'resep_detail' => [],
			];
			$item_pemberian_obat['aturan_pakai_3'] = [
				'catatan_pengobatan_pasien_detail' => null,
				'resep_detail' => [],
			];
			$item_pemberian_obat['aturan_pakai_4'] = [
				'catatan_pengobatan_pasien_detail' => null,
				'resep_detail' => [],
			];
			$item_pemberian_obat['aturan_pakai_5'] = [
				'catatan_pengobatan_pasien_detail' => null,
				'resep_detail' => [],
			];
			foreach ($item->details as $detail) {
				$jam = $detail->pemberian_at->format('H');
				$aturan_pakai = '';
				if ($jam <= 7) {
					$aturan_pakai = "5";
				} else if ($jam >= 21) {
					$aturan_pakai = "4";
				} else if ($jam >= 19) {
					$aturan_pakai = "3";
				} else if ($jam >= 13) {
					$aturan_pakai = "2";
				} else if ($jam >= 7) {
					$aturan_pakai = "1";
				}
				$item_pemberian_obat['aturan_pakai_' . $aturan_pakai]['catatan_pengobatan_pasien_detail'] = $detail;
				$item_pemberian_obat['aturan_pakai_' . $aturan_pakai]['resep_detail'][] = $item->farmasi_resep_detail->where('id', $detail->farmasi_resep_detail_id)->first();
			}
			$list_pemberian_obat[] = $item_pemberian_obat;
		}
		$data['list_pemberian_obat'] = $list_pemberian_obat;
		$pdf = DOMPDF::loadView('kasus.farmasi.printout.cetak-riwayat-pemberian-obat', $data)->setPaper('legal', 'landscape');
		return $pdf->stream('cetak riwayat pemberian obat.pdf');
	}

	public function getData($kasus)
	{
		$obat = CatatanPengobatanPasien::with('details')->where('kasus_id', $kasus->id)->orderBy('id', 'desc')->get();

		$data_pemberian = [];
		$data_obat = [];

		foreach ($obat as $obat_item) {
			$last_date = '';
			$data_obat[$obat_item->id] = $obat_item;
			foreach ($obat_item->details as $pemberian) {
				$current_date = date('d-m-Y', strtotime($pemberian->pemberian_at));
				if ($last_date != $current_date) {
					$i = 1;
					$last_date = $current_date;
				}
				$data_pemberian[$obat_item->id][$current_date][$i++] = date('H:i', strtotime($pemberian->pemberian_at));;
			}
		}
		$data['data'] = $data_pemberian;
		$data['obat'] = $data_obat;

		return $data;
	}
}
