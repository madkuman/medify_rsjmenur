<?php

namespace App\Http\Controllers\Farmasi\AturanHarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\AturanHarga;
use Illuminate\Support\Facades\DB;

class ReadController extends Controller
{
    # jangan ganti urutan parameter, biar seperti di generic
    public function filterAturan($farmasi_id, $perusahaan_id = null, $transaksi = null, $jenis_pasien = null, $lokasi_departemen_id = null)
    {
        if (!isset($perusahaan_id)) {
            $default_perusahaan_tipe = getTunaiPerusahaanTipe() ?? 0;
            $perusahaan_id = $default_perusahaan_tipe;
        }

        $query = AturanHarga::where('farmasi_id', $farmasi_id);
        $query->orderBy('aturan_harga.id', 'asc');
        return $query->get();
    }

    public function findAturan($aturan_harga, $harga, $kategori_ids = false)
    {
        $callback_sorter = function ($item) {
            return ($item->perusahaan_tipe_id != 0 ? 100 : 0);
        };
        
        $selected_aturan_harga = null;
        if(count($aturan_harga) != 0){
            $aturan_harga_farmasi = $aturan_harga->sortByDesc($callback_sorter)->values();
            foreach ($aturan_harga_farmasi as $key => $value) {
                if($harga >= $value->harga_min && $harga <= $value->harga_max){
                    $selected_aturan_harga = $value;
                    break;
                }
            }
        }
        return $selected_aturan_harga;
    }
}