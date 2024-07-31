<?php

namespace App\Http\Controllers\Farmasi\AturanEmbalase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\TipeObat;

class ReadController extends Controller
{
    public function hitungEmbalase($farmasi, $tipe_perusahaan_id, $detail_obat)
    {
        $detail_obat = (object) $detail_obat;
        $tipe_racikan_id = $detail_obat->tipe_racikan_id ?? null;
        $tipe_obat = $detail_obat->tipe ?? 'generik';
        $jumlah_obat = $detail_obat->jumlah ?? 0;
        $count_racikan = count($detail_obat->racikan ?? []);
        $satuan = $detail_obat->satuan ?? '';

        if (is_integer($farmasi)) {
            $farmasi = Farmasi::find($farmasi);
        }
        $selected_embalase = $this->selectAturanEmbalase($farmasi, $tipe_perusahaan_id, $tipe_obat == 'racikan' ? $satuan : null, $tipe_racikan_id);
        

        if ($selected_embalase == null) return 0;

        $embalase = $selected_embalase->harga;
        if ($selected_embalase->jenis_embalase == 'per-jumlah-obat') {
            $embalase = $embalase * $jumlah_obat;
        }

        return $embalase;
    }

    public function selectAturanEmbalase($farmasi, $tipe_perusahaan_id, $satuan = null, $tipe_racikan_id = null)
    {
        if (is_integer($farmasi)) {
            $farmasi = Farmasi::find($farmasi);
        }
        if ($tipe_perusahaan_id == -1) {
            $tipe_perusahaan_id = 0;
        }
        $aturan_embalase = $farmasi->aturan_embalase;
        $aturan_embalase = $aturan_embalase->filter(function ($item) use ($tipe_perusahaan_id, $tipe_racikan_id) { 
            if (!($tipe_perusahaan_id == 0 || $item->perusahaan_tipe_id == 0 || $item->perusahaan_tipe_id == $tipe_perusahaan_id)) {
                return false;
            }
            if (!($tipe_racikan_id == null || $item->tipe_racikan_id == null || $item->tipe_racikan_id == $tipe_racikan_id)) {
                return false;
            }
            return true;
        });
        return $aturan_embalase->first();
    }
}
