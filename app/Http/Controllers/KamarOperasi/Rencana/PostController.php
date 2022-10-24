<?php

namespace App\Http\Controllers\KamarOperasi\Rencana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Rencana;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\Distribusi;
use App\Models\KamarOperasi\Pemakaian;
use App\Models\Farmasi\Resep;
use App\Models\CSSD\Transaksi as CSSDTransaksi;
use DB;

class PostController extends Controller
{
	public function ajaxRencanaAdd(Request $request)
	{
		$deskripsi = $request->input('deskripsi');
		$trans_id = $request->input('id');

		$transaksi = Transaksi::find($trans_id);
		$transaksi->deskripsi_rencana = $deskripsi;
		$transaksi->save();

		return 'Edit sukses';
	}

	public function rencanaAddEdit(Request $request)
	{
		$deskripsi = $request->input('deskripsi');
		$trans_id = $request->input('id');

		$transaksi = Transaksi::find($trans_id);
		$transaksi->deskripsi_rencana = $deskripsi;
		$transaksi->save();

		$message = 'Rencana Operasi Berhasil Diperbaharui.';
		$title = 'Berhasil!';
		$status = 1;

		return redirect('kamaroperasi/pelaksanaan/'.$request->input('id'))
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function rencanaObat(Request $request)
	{
		$obats = $request->input('obat');
		$jumlah = $request->input('jumlah');
		$operasi_id = $request->input('operasi_id');

		foreach ($obats as $i => $obat)
		{
			$rencana = new Rencana;
			$rencana->operasi_id = $operasi_id;
			$rencana->item_id = $obat;
			$rencana->jumlah = $jumlah[$i];
			$rencana->save();
		}

		$message = 'Rencana Alat/Obat Berhasil Diperbaharui.';
		$title = 'Berhasil!';
		$status = 1;

		return redirect('kamaroperasi/pelaksanaan/'.$operasi_id)
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function submitRencana(Request $request)
	{

		/*
		SISTEM AKAN MEMBUAT 2 REQUEST
		1. Transaksi di Farmasi Bedah Sentral //revisi jadi ke farmasi tujuan, nama variabel tidak diubah
		2. Permintaan di CSSD
		*/
		// dd($request);
		$transaksi = Transaksi::findOrFail($request->input('id'));
		$connection = DB::connection('kamaroperasi');
		$connection_farmasi = DB::connection('farmasi');
		$connection_cssd = DB::connection('cssd');

		$connection->beginTransaction();
		$connection_farmasi->beginTransaction();
		$connection_cssd->beginTransaction();
		try {

        		$item_deleted = Rencana::where('operasi_id', $request->input('id'))->delete();

			if($transaksi->transaksi_obat)
			{
				$trans_obat = $transaksi->transaksi_obat;
				$resep = Resep::where('transaksi_id', $trans_obat->id)->first();
				foreach ($resep->resep_detail as $detail)
				{
					$detail->delete();
				}
				$resep->delete();
				$trans_obat->delete();
			}

			if($transaksi->permintaan_alat_id)
			{
				CSSDTransaksi::find($transaksi->permintaan_alat_id)->delete();
			}

			$nama_obat = json_decode($request->input('nama_obat'));
			if($alkes = $request->input('alkes_rencana'))
				$alkes_jumlah = array_filter($request->input('alkes_jumlah_rencana'));
			else
			{
				$alkes = [];
				$alkes_jumlah = [];
			}

			if($matkes = $request->input('matkes_rencana'))
				$matkes_jumlah = array_filter($request->input('matkes_jumlah_rencana'));
			else
			{
				$matkes = [];
				$matkes_jumlah = [];
			}

			if($obat = $request->input('obat_rencana'))
				$obat_jumlah = array_filter($request->input('obat_jumlah_rencana'));
			else
			{
				$obat = [];
				$obat_jumlah = [];
			}

			if($implan = $request->input('implan_rencana'))
				$implan_jumlah = array_filter($request->input('implan_jumlah_rencana'));
			else
			{
				$implan = [];
				$implan_jumlah = [];
			}

			$id_obat = [];
			$jumlah = [];
			$tipe_obat = [];
			$aturan = [];

			if(is_array($alkes))
			{
				foreach ($alkes as $i => $item)
				{
					if($item && array_key_exists($i, $alkes_jumlah) && $alkes_jumlah[$i] != 0)
					{
						$rencana = new Rencana;
						$rencana->jenis = 'alkes';
						$rencana->operasi_id = $transaksi->id;
						$rencana->item_id = $item;
						$rencana->jumlah = $alkes_jumlah[$i];
						$rencana->save();
					}
				}
			}

			if(is_array($matkes))
			{
				foreach ($matkes as $i => $item)
				{
					if($item && array_key_exists($i, $matkes_jumlah) && $matkes_jumlah[$i] != 0)
					{
						$rencana = new Rencana;
						$rencana->jenis = 'matkes';
						$rencana->operasi_id = $transaksi->id;
						$rencana->item_id = $item;
						$rencana->jumlah = $matkes_jumlah[$i];
						$rencana->save();

						$id_obat[] = $item;
						$jumlah[] = $rencana->jumlah;
						$tipe_obat[] = 'Matkes';
              				$aturan[] = null; //selalu null
					}
				}
			}

			if(is_array($obat))
			{
				foreach ($obat as $i => $item)
				{
					if($item && array_key_exists($i, $obat_jumlah) && $obat_jumlah[$i] != 0)
					{
						$rencana = new Rencana;
						$rencana->jenis = 'obat';
						$rencana->operasi_id = $transaksi->id;
						$rencana->item_id = $item;
						$rencana->jumlah = $obat_jumlah[$i];
						$rencana->save();

						$id_obat[] = $item;
						$jumlah[] = $rencana->jumlah;
						$tipe_obat[] = 'Obat';
              				$aturan[] = null; //selalu null
					}
				}
			}

			if(is_array($implan))
			{
				foreach ($implan as $i => $item)
				{
					if($item && array_key_exists($i, $implan_jumlah) && $implan_jumlah[$i] != 0)
					{
						$rencana = new Rencana;
						$rencana->jenis = 'implan';
						$rencana->operasi_id = $transaksi->id;
						$rencana->item_id = $item;
						$rencana->jumlah = $implan_jumlah[$i];
						$rencana->save();

						$id_obat[] = $item;
						$jumlah[] = $rencana->jumlah;
						$tipe_obat[] = 'Implan';
              				$aturan[] = null; //selalu null
					}
				}
			}

			//--------------------KIRIM TRANSAKSI KE DEPO BEDAH SENTRAL------------------// update kirim ke farmasi yang dituju

			// $depo_bedah_sentral = Farmasi::where('slug', 'depo-bedah-sentral')->first();
			$depo_bedah_sentral = Farmasi::where('id',$request->farmasi_tujuan)->first();
			$additional_data = [
				'nama-apotek' => $depo_bedah_sentral->id,
				'pasien' => $transaksi->pasien_id,
				'metode_pembayaran' => $transaksi->kasus_id ? $transaksi->kasus->pasien_pembayaran_id : null,
				'kasus_id' => $transaksi->kasus_id,
				'resep_id' => 0,
				'sep_id' => $transaksi->kasus_id ? $transaksi->kasus->sep_id : null,
				'id-obat' => array_merge($matkes, $obat, $implan),
				'nama-obat' => $nama_obat,
				'status' => -1, //kode status untuk yang model rencana obat
				'jumlah-obat' => array_merge($matkes_jumlah, $obat_jumlah, $implan_jumlah),
				'tipe-obat' => $tipe_obat,
				'aturan-obat' => $aturan,
				'no_redirect' => true
			];

			$request->request->add($additional_data);

			$transaksi_obat = app('App\Http\Controllers\Farmasi\Transaksi\CreateController')->create($request);
			$transaksi->transaksi_obat_id = $transaksi_obat->id;
			$transaksi->save();
			//--------------------KIRIM PERMINTAAN KE CSSD------------------//

			$data_cssd['type'] = 1; //1 UNTUK PERMINTAAN 2 UNTUK PENGEMBALIAN
			$data_cssd['ok_transaksi_id'] = $request->id; //ID TRANSAKSI KAMAR OPERASI
			$data_cssd['keterangan'] = 'Permintaan Melalui Rencana Kamar Operasi'; // KETERANGAN ISI SENDIRI BIASANYA SI PERMINTAAN MELALUI KAMAR OPERASI

			$data_cssd_detail['alkes_id'] = $request->alkes_rencana; //ARRAY ID_ALKES DARI DB CSSD TABEL ALKES
			$data_cssd_detail['alkes_jumlah'] = $request->alkes_jumlah_rencana; //JUMLAH UNTUK MASING MASING ALKES

			$cssd =	 app('App\Http\Controllers\CSSD\Transaksi\PostController')->ApiTransaksiBaru($data_cssd,$data_cssd_detail);

			// $transaksi->permintaan_alat_id = $cssd->id;
			$transaksi->save();

			$connection->commit();
			$connection_cssd->commit();
			$connection_farmasi->commit();

			$message = 'Rencana Operasi Berhasil Diperbaharui.';
			$title = 'Berhasil!';
			$status = 1;

			return redirect('kamaroperasi/pelaksanaan/'.$transaksi->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (\Exception $e) {
			$connection->rollback();
			$connection_cssd->rollback();
			$connection_farmasi->rollback();
			
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$message = 'An error occured.';
			$title = 'Error';
			$status = -1;

			return redirect('kamaroperasi/pelaksanaan/'.$transaksi->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}
