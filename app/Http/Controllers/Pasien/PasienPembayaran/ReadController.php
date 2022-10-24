<?php

namespace App\Http\Controllers\Pasien\PasienPembayaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use DB;

class ReadController extends Controller
{
	public function get($id)
	{
		$pembayaran = PasienPembayaran::with(['perusahaan.tipe','kelas'])->where('id', $id)->first();
        $this->checkToAbort($pembayaran);
        $pembayaran = $pembayaran->toArray();
		return $pembayaran;
	}
	public function getAllTipe()
	{
		$pembayaran = PembayaranPerusahaanType::with('perusahaan')->get();
		return $pembayaran;
	}
	public function getAllPerusahaan()
	{
		$pembayaran = PembayaranPerusahaan::with('tipe')->get();
		return $pembayaran;
	}
	public function getSingle($id)
	{
		$pembayaran = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('id', $id)->first();
        $this->checkToAbort($pembayaran);
		return $pembayaran;
	}
	public function single($id)
	{
		$pembayaran = PasienPembayaran::with(['perusahaan','perusahaan.tipe','kelas'])->where('id', $id)->first();
		return $pembayaran;
	}

	public function getGroupLaporan()
	{
		$tipe = PembayaranPerusahaanType::all();
		foreach ($tipe as $key => $item_tipe) {
			$perusahaan_ids[] = PembayaranPerusahaan::where('type',$item_tipe->id)->pluck('id')->toArray();
		}

		return $perusahaan_ids;
	}

	public function getPerusahaanArray()
	{
		$perusahaan_ids = [];
		$perusahaan = PembayaranPerusahaan::all();
		foreach ($perusahaan as $key => $item) {
			$temp[0] = $item->id;
			$perusahaan_ids[] = $temp;
		}
		return $perusahaan_ids;
	}

	public function getGroupLaporanMerge()
	{
		$grup = $this->getGroupLaporan();
		$grup_merged = [];
		foreach($grup as $item)
		{
			$grup_merged = array_merge($grup_merged,$item);
		}

		return $grup_merged;
	}

	public function getJenisTunaiFromPasien($pasien_id)
	{
		$query = PasienPembayaran::where('pasien_id',$pasien_id)->where('perusahaan_id',80)->first();
		return $query;
	}



    public function pembayaranGetShort($id)
    {
        $query = '
        SELECT 
            pembayaran_perusahaan.`nama`,
            pembayaran_perusahaan.`type`
        FROM 
            `'.config('app.db_name').'_patients`.`pasien_pembayaran`, 
            `'.config('app.db_name').'_patients`.`pembayaran_perusahaan`, 
            `'.config('app.db_name').'_patients`.`pembayaran_perusahaan_tipe`
        WHERE pasien_pembayaran.id = '.$id.'
        AND pasien_pembayaran.`perusahaan_id` = pembayaran_perusahaan.`id`
        AND pembayaran_perusahaan.`type` = pembayaran_perusahaan_tipe.`id`
        ';

        $data = DB::connection('patients')->select($query);
        return $data[0];
    }

    public function getPerusahaanByTipe($tipe_id)
    {
        $perusahaan = PembayaranPerusahaan::whereIn('type',$tipe_id)->get();
        return $perusahaan;
    }

    public function getNoAsuransi($no_asuransi)
    {
        $pasien = PasienPembayaran::where('no_asuransi', $no_asuransi)->first();
        return $pasien;
    }
}
?>