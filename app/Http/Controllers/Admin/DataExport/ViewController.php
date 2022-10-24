<?php

namespace App\Http\Controllers\Admin\DataExport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\DataExport\ExportDefault;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\Tarif;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\Farmasi\ItemsTemplate;
use DB;

class ViewController extends Controller
{
	protected $tarif_kategori_data;
	protected $tarif_kategori_current_row;

	public function pasien(Request $request)
	{
		$start = $request->start ?? 0;
		$end = $request->end ?? 10000;

		$query = "SELECT MAX(total) as max
					FROM (
					SELECT COUNT(1) AS total
					FROM `pasien_pembayaran`
					GROUP BY pasien_id) table1";

		$total = DB::connection('patients')->select($query);
		$data['max_pembayaran'] = $total[0]->max;

		$data['pasien'] = Pasien::where('id','>=',$start)->where('id','<=',$end)->with('jenis_identitas','jk','pernikahan','alamat_kota','alamat_kecamatan','alamat_kelurahan','agama','pendidikan','tni_keanggotaan','tni_kotama','tni_pangkat','tni_satker','tni_korps','wali','wali.jk','wali.tni_keanggotaan','wali.tni_kotama','wali.tni_pangkat','wali.tni_satker','wali.tni_hubungan','jenis_hubungan_keluarga','pembayaran.perusahaan','pembayaran.kelas')->get();


		$data['blade'] = 'pasien';

		$filename = 'data-pasien-'.$start.'-'.$end.'.xlsx';
		return (new ExportDefault($data))->download($filename);

	}
	public function tarifKategori(Request $request)
	{
		$tarif_kategori = TarifKategori::where('parent_id',0)->with('children.children.children.children.children.children.children.children.children.children.children')->get();
		
		$this->tarif_kategori_current_row = 1;

		foreach ($tarif_kategori as $key => $item) {
			$this->nestedTarifKategori(1,$item);
		}

		$data['tarif_kategori'] = $this->tarif_kategori_data;
		$data['blade'] = 'tarif_kategori';

		$filename = 'data-tarif-kategori.xlsx';
		return (new ExportDefault($data))->download($filename);

	}

	private function nestedTarifKategori($layer,$tarif_kategori)
	{
		for($i=0;$i<=$layer;$i++)
		{
			$this->tarif_kategori_data[$this->tarif_kategori_current_row][$i] = '';
		}
		$this->tarif_kategori_data[$this->tarif_kategori_current_row][0] = $tarif_kategori->slug;
		$this->tarif_kategori_data[$this->tarif_kategori_current_row][$layer] = $tarif_kategori->nama;
		$this->tarif_kategori_current_row += 1;
		$layer = $layer+1;

		if(count($tarif_kategori->children) > 0)
		{
			foreach($tarif_kategori->children as $child)
			{
				$this->nestedTarifKategori($layer,$child);
			}
		}
		else
		{
			return;
		}
	}

	public function tarif(Request $request)
	{
		$data['tarif'] = Tarif::with('master.kategori','kelas','tipe')->orderBy('tarif_master_id')->orderBy('kelas_id')->get();
		$data['blade'] = 'tarif';

		$filename = 'tarif.xlsx';
		return (new ExportDefault($data))->download($filename);

	}

	public function dokterPoliklinik(Request $request)
	{
		$data['jadwal'] = DokterJadwal::with('poli','dokter')->get();
		$data['blade'] = 'dokter-poliklinik';

		$filename = 'dokter-poliklinik.xlsx';
		return (new ExportDefault($data))->download($filename);

	}

	public function farmasiObat(Request $request)
	{
		$data['obat'] = ItemsTemplate::with('kategori_item.detail_kategori')->get();
		$data['blade'] = 'farmasi-obat';

		$filename = 'farmasi-obat.xlsx';
		return (new ExportDefault($data))->download($filename);
	}
}
