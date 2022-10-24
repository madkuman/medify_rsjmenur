<?php

namespace App\Http\Controllers\Farmasi\Consis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FarmasiConsis\TransaksiDetail;
use App\Models\FarmasiConsis\Obat;
use App\Models\FarmasiConsis\Transaksi;

class CreateController extends Controller
{

    //$data ini dari transaksi obat farmasi
    public function createTransaksi($data)
    {
    	if(!is_object($data))
    		$data = (object) $data;
    	$transaksi = new Transaksi;
    	$transaksi->transaksi_id = $data->id;
    	$transaksi->counter_id = $data->loket_id;
    	$transaksi->mrn = $data->pasien_no_rm;
    	$transaksi->nama = $data->pasien_nama;
    	$transaksi->umur = $data->pasien_umur;
    	$transaksi->alamat = $data->pasien_alamat;
    	$transaksi->jns_kelamin = $data->pasien_gender;
    	$transaksi->save();
    }

    //$data ini dari item_template gudang
    public function createObat($data)
    {
    	if(!is_object($data))
    		$data = (object) $data;
    	$obat = Obat::where('hobat_id', $data->id)->first();
    	
    	if(empty($obat))
    		$obat = new Obat;
    	$obat->hobat_id = $data->id;
    	$obat->nama_obat = $data->nama;
    	$obat->dosage_form = $data->satuan;
    	$obat->package_unit = $data->kelompok;
    	$obat->barcode_id = $data->kode;
    	$obat->save();
    }

    public function createTransaksiDetail($data)
    {
    	if(!is_object($data))
    		$data = (object) $data;
    	$detail = new TransaksiDetail;
    	$detail->transaksi_id = $data->transaksi_id;
    	$detail->obat_id = $data->obat_id;
    	$detail->qty = $data->qty;
    	$detail->save();
    }
}
