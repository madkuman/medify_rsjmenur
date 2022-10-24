<?php

namespace App\Http\Controllers\LabPK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifTipe;
use App\Models\Hospital\Kelas;
use App\Models\Pasien\Pasien;
use App\Models\LabPK\Transaksi;
use Carbon\Carbon;
use File;
use Auth;
use DateTime;
use Image;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Bugsnag;

class ImportController extends Controller
{
	protected static $dept = 6;
	protected static $parent = 194;

	public function importTarif()
	{
		$lis_file = fopen(public_path('dataset/mappingLIS.csv'), 'r');
		$first = true;
		$lis_map = [];
		while(($line = fgetcsv($lis_file)) !== FALSE) {
			if($first)	$first = false;
			else 	$lis_map[trim($line[0])] = $line[1];
		}
		fclose($lis_file);

		$list_kelas = [1, 6, 7, 8, 9, 10, 4, 5];
		$tarif_file = fopen(public_path('dataset/tarif_labpk.csv'), 'r');
		$first = true;

		try {
			DB::connection('keuangan')->beginTransaction();
			$skip = 0;
			$inserted = false;
			while(($line = fgetcsv($tarif_file)) !== FALSE) {
				if($first)	$first = false;
				else if($skip > 0)	$skip--;
				else 	{
					$deskripsi = trim($line[1]);
					$kategori = trim($line[0]);
					$tipe_id = $line[3];
					$harga = $line[4];
					$cek_deskripsi = TarifMaster::where('deskripsi', $deskripsi)->first();
					if(is_null($cek_deskripsi)){
						$cek_kategori = TarifKategori::where('nama', $kategori)->where('departemen_id', self::$dept)->first();
						if(is_null($cek_kategori)){
							$new_kategori = new TarifKategori;
							$new_kategori->nama = $kategori;
							$new_kategori->departemen_id = self::$dept;
							$new_kategori->parent_id = self::$parent;
							$new_kategori->save();
						}
						$new_tarif = new TarifMaster;
						$new_tarif->deskripsi = $deskripsi;
						$new_tarif->kategori_id = $new_kategori->id;
						if(isset($lis_map[$deskripsi]))	$new_tarif->lis_id = $lis_map[$deskripsi];
						$new_tarif->save();
					}
					echo $deskripsi.'</br>';
					foreach ($list_kelas as $key => $value) {
						$new_td = new Tarif;
						$new_td->tarif_master_id = $new_tarif->id;
						$new_td->tipe_id = $tipe_id;
						$new_td->kelas_id = $value;
						$new_td->harga = $harga;
						$new_td->save();
					}
					$skip = 6;
				}
			}
			fclose($tarif_file);
			DB::connection('keuangan')->commit();

		} catch (\Exception $e) {
			DB::connection('keuangan')->rollback();
			dd($e);
		}
	}

	public function exportTransaction()
	{
		$transaksi = Transaksi::with(['pasien', 'detail'])->get();

		$data[0] = ['transaksi_id', 'pasien_id', 'no_rm', 'nama_pasien', 'keterangan', 'created_at', 'tarif_tipe', 'lokasi', 'detail_test'];

		foreach($transaksi as $t){
			$details = '';
			// dd($t);
			foreach($t->detail as $key => $d){
				$details .= $d->tarif->deskripsi;
				if(isset($t->detail[$key]))
					$details .= ' - ';
			}
			$temp = [$t->id, $t->pasien_id, $t->pasien->no_rm, $t->pasien->name, $t->keterangan, $t->created_at->toDateTimeString(), $t->tipe(), $t->asal->nama, $details];
			array_push($data, $temp);
		}

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="data_transaksi.csv"');



		// very simple to increment with i++ if looping through a database result 

		$fp = fopen('php://output', 'wb');
		foreach ($data as $line) {
		    // though CSV stands for "comma separated value"
		    // in many countries (including France) separator is ";"
		    fputcsv($fp, $line, ',');
		}
		fclose($fp);
	}

	public function import()
	{
		DB::connection('keuangan')->beginTransaction();
		try {
			$tarifmaster = TarifMaster::whereHas('kategori', function($q){
				$q->where('departemen_id', 8);
			})->get();
			$tarif_kelas = Kelas::get();
			$tipe = TarifTipe::get();
			$un_kelas = Kelas::whereIn('id', [2, 3])->get();
			foreach ($tarifmaster as $t) {
				echo $t->deskripsi.'</br>';
				flush();
				$tarif = Tarif::where('tarif_master_id', $t->id)->where('tipe_id', 1)->first();
				$error = $t;
				$harga_cito = $tarif->harga + ($tarif->harga * 0.25);
				foreach($tipe as $tp){
					if($tp->id == 1) {
						foreach($un_kelas as $k){
							$new_tarif = new Tarif;
							$new_tarif->tarif_master_id = $t->id;
							$new_tarif->tipe_id = $tp->id;
							$new_tarif->kelas_id = $k->id;
							$new_tarif->harga = $tarif->harga;
							$new_tarif->kelas_temp = $k->nama;
							$new_tarif->tipe_temp = $tp->nama;
							$new_tarif->deskripsi_temp = $t->deskripsi;
							$new_tarif->save();
						}
					} else if($tp->id == 2) {
						foreach($tarif_kelas as $k){
							$new_tarif = new Tarif;
							$new_tarif->tarif_master_id = $t->id;
							$new_tarif->tipe_id = $tp->id;
							$new_tarif->kelas_id = $k->id;
							$new_tarif->harga = $tarif->harga;
							$new_tarif->kelas_temp = $k->nama;
							$new_tarif->tipe_temp = $tp->nama;
							$new_tarif->deskripsi_temp = $t->deskripsi;
							$new_tarif->save();
						}
					}
				}			
			}
			DB::connection('keuangan')->commit();	
		} catch (\Exception $e) {
			DB::connection('keuangan')->rollback();
			dd($error, $e->getMessage());
		}
	}

	public function exportPasien()
	{
		$pasien = Pasien::orderBy('created_at')->take(10)->get();

		$data[0] = ['id', 'no_rm', 'name', 'sex', 'place_of_birth', 'date_of_birth', 'address', 'phone', 'job', 'is_anggota', 
		'tni_nrp', 'city', 'kecamatan', 'kelurahan', 'tni_keanggotaan', 'tni_pangkat', 'tni_kotama', 'tni_satker', 'created_at'];

		foreach($pasien as $patient){
	        $temp = [
	            "id" => (string)$patient->id,
	            "no_rm" => (string)$patient->no_rm,
	            "name" => $patient->name,
	            "sex" => ($patient->gender == 1) ? "M" : "F",
	            "place_of_birth" => $patient->place_of_birth,
	            "date_of_birth" => $patient->date_of_birth,
	            "address" => $patient->address,
	            "phone" => $patient->phone,
	            "job" => $patient->job,
	            "is_anggota" => $patient->is_anggota,
	            "tni_nrp" => $patient->tni_nrp,
	            "city" => $patient->alamat_kota["name"],
	            "kecamatan" => $patient->alamat_kecamatan["name"],
	            "kelurahan" => $patient->alamat_kelurahan["name"],
	            "tni_keanggotaan" => $patient->tni_keanggotaan ? $patient->tni_keanggotaan["nama"] : "",
	            "tni_pangkat" => $patient->tni_pangkat ? $patient->tni_pangkat["nama"] : "",
	            "tni_kotama" => $patient->tni_kotama ? $patient->tni_kotama["nama"] : "",
	            "tni_satker" => $patient->tni_satker ? $patient->tni_satker["nama"] : ""];
			array_push($data, $temp);
		}

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="data_pasien.csv"');

		// very simple to increment with i++ if looping through a database result 

		$fp = fopen('php://output', 'wb');
		foreach ($data as $line) {
		    // though CSV stands for "comma separated value"
		    // in many countries (including France) separator is ";"
		    fputcsv($fp, $line, ',');
		}
		fclose($fp);
	}

    public function ImportLISTarif(Request $req)
    {
    	try {
	        DB::connection('keuangan')->beginTransaction();
	        $fp = fopen(public_path('master_labpk.csv'), 'r');
			$flag = 0;
			while (($line = fgetcsv($fp)) !== FALSE) {
				if($flag > 0){
					$tarif = TarifMaster::find($line[0]);
					$tarif->deskripsi = $line[1];
					$tarif->lis_id = $line[2];
					$tarif->save();
				}
				$flag++;
			}
			fclose($fp);
			DB::connection('keuangan')->commit();
    	} catch (\Exception $e) {
    		DB::connection('keuangan')->rollBack();
    		dd($e);
    	}
	}
}