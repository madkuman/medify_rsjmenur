<?php

namespace App\Http\Controllers\Kasus\Farmasi\FormulirPelayananObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Kasus\Kasus;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    function index(Request $request, $nomor_kasus)
    {    
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

		$transaksi = TransaksiObat::with([])
			->where('kasus_id', $kasus->id)
			->whereHas('ori_detail', function ($query) {
				$query->select(DB::raw(1))
					->whereIn('kategori_resep', ['tpn', 'dispensing_aseptik']);
			})
			->get();
		
		$data['kasus'] = $kasus;
		$data['transaksi'] = $transaksi;
		$data['sidebar_active'] = 'farmasi';
		$data['active_nav'] = 'formulir-pelayanan-obat';

		return view('kasus.farmasi.formulir-pelayanan-obat',$data);
    }

    function printFormulir(Request $request, $nomor_kasus, $transaksi_id)
    {
        $transaksi = TransaksiObat::find($transaksi_id);
        if ($transaksi->ori_detail->kategori_resep == 'dispensing_aseptik') {
            return app(\App\Http\Controllers\Farmasi\Transaksi\ViewController::class)->formulirPermintaanDispensingAseptik($transaksi->owner_detail->slug, $transaksi->slug); 
        } else if ($transaksi->ori_detail->kategori_resep == 'tpn') {
            return app(\App\Http\Controllers\Farmasi\Transaksi\ViewController::class)->formulirPermintaanTpn($transaksi->owner_detail->slug, $transaksi->slug);
        } else {
            return abort(404);
        }
    }
}
