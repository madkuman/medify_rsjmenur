<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS\Antrean;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use App\Models\RawatJalan\DokterJadwal;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;

class ReadController extends Controller
{
    public function getTransactionByJadwal($data, $poli_id, $dokter_id)
    {
        $ordered_start = Carbon::parse($data['tanggalperiksa']);
		$ordered_end = Carbon::parse($data['tanggalperiksa'])->endOfDay();

        $jam_praktek = explode("-", $data['jampraktek']);
        $jam['buka'] = $jam_praktek[0].":00";
        $jam['tutup'] = $jam_praktek[1].":00";

        $transactions = Transaksi::with(['dokter', 'dokter_jadwal','pasien_pembayaran.perusahaan.tipe'])
                        ->whereHas('dokter_jadwal', function(Builder $query) use ($jam){
                            $query->whereBetween('jam_buka', [$jam['buka'], $jam['tutup']])
                            ->orWhereBetween('jam_tutup', [$jam['buka'], $jam['tutup']]);
                        })
                        ->where('poliklinik_id', $poli_id)
                        ->where('dokter_id', $dokter_id)
                        ->whereNotNull('dokter_jadwal_id')
                        ->where('status', '!=', -1)
                        ->whereBetween('ordered_at', [$ordered_start, $ordered_end])
                        ->get();
        
        return $transactions;
    }

    public function getTransactionLastAntrian($data, $poli_id)
    {
        $ordered_start = Carbon::parse($data['tanggalperiksa']);
		$ordered_end = Carbon::parse($data['tanggalperiksa'])->endOfDay();

        $transaction = Transaksi::where('poliklinik_id', $poli_id)
                        ->whereBetween('ordered_at', [$ordered_start, $ordered_end])
                        ->orderBy('created_at', 'desc')
                        ->first();
        
        return $transaction;
    }

	public function getTransaksiWithPoliDokter($id)
	{
		$antrian = Transaksi::whereDate('ordered_at', Carbon::today()->toDateString())
                    ->with(['dokter', 'poliklinik'])
                    ->where('id', $id)
					->where('status', '!=' ,-1)
					->first();

                    return $antrian;
	}

    public function getAntrian($poli_id)
    {
        $antrian = Transaksi::whereDate('ordered_at', '=', Carbon::today()->toDateString())
                    ->where('poliklinik_id', $poli_id)
                    ->where('status', 0)
                    ->get();

        return $antrian;
    }

	public function getAntrianTerpanggil($poli_id)
	{
		$antrian = Transaksi::whereDate('ordered_at', '=', Carbon::today()->toDateString())
					->whereNotNull('waktu_pemeriksaan')
                    ->where('poliklinik_id', $poli_id)
					->orderBy('waktu_pemeriksaan', 'desc')
					->first();

		return $antrian;
	}

    public function cekAntrian($id)
    {
        $antrian = Transaksi::where('id', $id)
                    ->where('status', '!=' ,-1)
                    ->first();

        return $antrian;
    }

    public function getDataAntrian($jam_buka, $jam_tutup, $tanggal, $poli_id, $dokter_id)
    {
        $hari_order = Carbon::parse($tanggal)->dayOfWeek;

        $dokter_jadwal = DokterJadwal::
                        where(function(Builder $query) use ($jam_buka, $jam_tutup){
                            $query->whereBetween('jam_buka', [$jam_buka, $jam_tutup])
                            ->orWhereBetween('jam_tutup', [$jam_buka, $jam_tutup]);
                        })
                        ->where('poliklinik_id', $poli_id)
                        ->where('dokter_id', $dokter_id)
                        ->where('hari_order', $hari_order)
                        ->first();
        $transaksi_all = Transaksi::with('pasien_pembayaran.perusahaan.tipe')
                        ->where('dokter_jadwal_id', $dokter_jadwal->id)
                        ->whereDate('ordered_at', $tanggal)
                        // ->select(DB::raw('count(1) as antrian'))
                        ->get();
        $transaksi_all_poli = Transaksi::with('pasien_pembayaran.perusahaan.tipe')
            ->where('poliklinik_id', $poli_id)
            ->whereDate('ordered_at', $tanggal)
            ->get();
        $transaksi_bpjs = $transaksi_all->where('pasien_pembayaran.perusahaan.tipe.slug', 'bpjs');

        $sisa_jkn = $dokter_jadwal->kuota_bpjs_online > $transaksi_bpjs->count() ? 
                    $dokter_jadwal->kuota_bpjs_online - $transaksi_bpjs->count() : 0;

        $sisa_all = $dokter_jadwal->kuota_all_online > $transaksi_all->count() ?
                    $dokter_jadwal->kuota_all_online - $transaksi_all->count() : 0;
        
        $last_antrian_terpanggil = $transaksi_all_poli->where('konfirmasi_at', '!=', null)->last()->id ?? 0;
        $last_antrian = $transaksi_all_poli->where('id', '<=', $last_antrian_terpanggil)->count();
        
        return [
            'kuota_jkn_online' => $dokter_jadwal->kuota_bpjs_online,
            'kuota_all_online' => $dokter_jadwal->kuota_all_online,
            'sisa_jkn_online' => $sisa_jkn,
            'sisa_all_online' => $sisa_all,
            'antrian_jkn' => $transaksi_bpjs->count(),
            'antrian_all' => $transaksi_all_poli->count(),
            'last_antrian' => $last_antrian
        ];
    }

}
