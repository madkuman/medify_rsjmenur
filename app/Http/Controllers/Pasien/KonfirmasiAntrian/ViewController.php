<?php

namespace App\Http\Controllers\Pasien\KonfirmasiAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PengaturanLoket;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\RawatJalan\AntrianLevel;
use DataTables;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        $loket = PengaturanLoket::all();
        $data['loket'] = $loket;
        return view('pasien.halaman-konfirmasi.index', $data);
    }

    public function getData(Request $request)
    {
        $data = app('App\Http\Controllers\Pasien\KonfirmasiAntrian\ReadController')->getAntrian($request);

        return DataTables::of($data)
						->addColumn('no_rm', function ($data) {
                            return $data->no_rm ?? '-';
						})
						->addColumn('nama_pasien', function ($data) {
                            if ($data->no_rm) {
                                $pasien = Pasien::where('no_rm', $data->no_rm)->first();
                                return $pasien->name ?? '-';
                            }else{
                                return '-';
                            }
						})
						->addColumn('poliklinik', function ($data) {
                            if ($data->poliklinik_id) {
                                return $data->poliklinik->name;
                            }else{
                                return '-';
                            }
						})
						->addColumn('dokter', function ($data) {
                            if ($data->dokter) {
                                return $data->dokter->name;
                            }else{
                                return '-';
                            }
                        })
                        ->addColumn('antrian', function ($data) {
                            return $data->jumlah_antrian ?? '-';
						})
                        ->addColumn('aksi', function ($data) {
                            $button = '';
                            if (empty($data->konfirmasi_by) && empty($data->cancel_by)) {
                                if ($data->no_rm) {
                                    $pasien = Pasien::where('no_rm', $data->no_rm)->first();
                                    $button .= '<a href="'.url("pasien").'/'.$pasien->id.'/pendaftaran/'.$data->id.'" class="btn btn-md min-width-125 btn-primary">Konfirmasi</a><br>';
                                }else {
                                    $button .= '<a href="'.url("pasien/baru").'?pasien_antrian_id='.$data->id.'" class="btn btn-md min-width-125 btn-primary">Konfirmasi</a><br>';
                                }

                                $button .= '<button class="btn btn-danger min-width-125 mt-5 btn-batalkan" onclick="confirmSwalBatalkan('.$data->id.')">Batalkan</button>';
                                $button .= '<button class="js-notify btn btn-success min-width-125 mt-5 button-call-antrian" data-loket="'.$data->loket_id.'" data-antrian="'.$data->jumlah_antrian.'"><i class="fa fa-bullhorn"></i></button>';
                                $button .= '<audio id="player"></audio>';
                            } else if (!empty($data->cancel_by)) {
                                $button .= '<button class="btn min-width-125 btn-atl-warning" disable>Pasien telah dibatalkan</button>';
                            } else {
                                $button .= '<button class="btn min-width-125 btn-atl-warning" disable>Pasien sudah diverifikasi</button>';
                            }
                            return $button;
                        })
					    ->escapeColumns([])
                        ->make(true);
    }

    public function halamanKonfirmasi($id)
    {
        $mesin_antrian = app('App\Http\Controllers\Pasien\KonfirmasiAntrian\ReadController')->mesinAntrianFind($id);
        
        // $pasien = app('App\Http\Controllers\Pasien\KonfirmasiAntrian\ReadController')->konfirmasiPasien($mesin_antrian->pasien->id);
        // $transaksi = Transaksi::with('pasien', 'kasus.lokasi.lokasi.poliklinik', 'poliklinik', 'dokter', 'pasien_pembayaran.jenis')->find($id);
        $today_start = Carbon::now()->startOfDay();
        $today_end = $today_start->copy()->endOfDay();
        $kasus_masih_ranap = Kasus::where('tipe_ri', 1)
                                ->where('pasien_id', $mesin_antrian['pasien']->id)
                                ->whereNull('krs_at')->get();
        $kasus_krs_today = Kasus::where('tipe_ri', 1)
                                ->where('pasien_id', $mesin_antrian['pasien']->id)
                                ->whereBetween('krs_at', [$today_start, $today_end])->get();
    
        $data['metode'] = app('App\Http\Controllers\Pasien\KonfirmasiAntrian\ReadController')->metodePembayaran($mesin_antrian['pasien']->id);
        $data['pasien'] = $mesin_antrian['pasien'];
        $data['antrian'] = $mesin_antrian['antrian'];
        $data['jadwal'] = $mesin_antrian['jadwal'];
        $data['kasus_masih_ranap'] = $kasus_masih_ranap;
        $data['kasus_krs_today'] = $kasus_krs_today;
        $data['poli_level'] = AntrianLevel::all()->sortBy('level');
        $data['antrian_level'] = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getLevelPasien($data['pasien'], $data['pasien']->pembayaranUtama->id ?? null);
        $data['sep'] = json_decode(app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNomorPasien($mesin_antrian['pasien']->id));

        return view('pasien.halaman-konfirmasi.halaman-konfirmasi', $data);
    }
}
