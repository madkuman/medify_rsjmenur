<?php

namespace App\Http\Controllers\RawatInap\Bangsal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Transaksi;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\TNIKotama;
use App\Models\Pasien\TNISatker;
use App\Models\Pasien\TNIKeanggotaan;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use MPDF;
use DOMPDF;
use DB;

//define('RELASI_CARI', ['pasien', 'pasien.alamat_kecamatan', 'pasien.alamat_kelurahan', 'pasien.alamat_kota', 'pasien.alamat_kota.provinsi', 'kasus', 'kasus.pembayaran.perusahaan', 'pasien.tni_kotama', 'pasien.tni_satker', 'tempat_tidur', 'tempat_tidur.ruangan.bangsal']);
define('RELASI_CARI', ['pasien', 'pasien.alamat_kecamatan', 'pasien.alamat_kelurahan', 'pasien.alamat_kota', 'pasien.alamat_kota.provinsi', 'kasus','kasus.diagnosisUtama.icd10', 'kasus.pembayaran.perusahaan', 'kasus.admin.user', 'pasien.tni_kotama', 'pasien.tni_pangkat', 'pasien.tni_satker', 'tempat_tidur', 'tempat_tidur.ruangan.bangsal']);

class ViewController extends Controller
{
    public function index()
    {
        $query = "select * from bangsal b 
        left join (select r.bangsal_id, count(1) as bed_kosong from ruangan r, tempat_tidur t where t.ruangan_id = r.id and t.transaksi_id is null and t.booking_id is null and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r1
        on r1.bangsal_id = b.id
        left join (select r.bangsal_id, count(1) as bed_total from ruangan r, tempat_tidur t where t.ruangan_id = r.id and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r2
        on r2.bangsal_id = b.id
        left join (select r.bangsal_id, count(1) as pasien_total from ruangan r, tempat_tidur t where t.ruangan_id = r.id and t.transaksi_id is not null and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r3
        on r3.bangsal_id = b.id where b.deleted_at is null;";
        $bangsals = DB::connection('rawatinap')->select($query);
        $data['bangsals'] = $bangsals;
        $data['routeFlag'] = 2;
        $data['link'] = "bangsal";
        return view('rawatinap.bangsal.index',$data);
    }

    public function single($id)
    {
        $bangsals = Bangsal::with('ruangan', 'ruangan.bed', 'ruangan.bed.booking', 'ruangan.bed.booking.pasien', 'ruangan.bed.transaksi', 'ruangan.bed.transaksi.pasien',
            'ruangan.bed.transaksi.kasus', 'ruangan.bed.transaksi.kasus.admin.user','ruangan.bed.transaksi.rm_transaksi','ruangan.bed.booking.rm_transaksi')->find($id);
        $data['bangsal'] = $bangsals;
        $data['routeFlag'] = 2;
        $data['link'] = "bangsal/single";
        return view('rawatinap.bangsal.single',$data);
    }

    public function getCariData($request)
    {
        $tipe_pembayaran = $request->get('tipe_pembayaran');

        $tni_kotama = $request->get('tni_kotama');
        $tni_satker = $request->get('tni_satker');
        $tni_keanggotaan = $request->get('tni_keanggotaan');

        if ($tipe_pembayaran == "all" || $tipe_pembayaran == "null") {
            $tipe_pembayaran = NULL;
        }
        if ($tni_kotama == "all" || $tni_kotama == "null") {
            $tni_kotama = NULL;
            $data['tni_kotama'] = "all";
        }
        if ($tni_satker == "all" || $tni_satker == "null") {
            $tni_satker = NULL;
            $data['tni_satker'] = "all";
        }

        if ($tni_keanggotaan == "all" || $tni_keanggotaan == NULL) {
            $data['keanggotaan_id'] = "all";
            $tni_keanggotaan = NULL;
        }

        if($tipe_pembayaran != NULL){
            $tipe_pembayaran = explode(',', $tipe_pembayaran);
            $cari_pembayaran = $tipe_pembayaran;
        }

        if ($tipe_pembayaran == NULL && $tni_kotama == NULL && $tni_satker == NULL && $tni_keanggotaan == NULL) {
            $transaksi = Transaksi::whereIn('status', [1, 2])->whereNotNull('tempat_tidur_id')->whereNull('waktu_keluar')->with(RELASI_CARI)->get();
            $data['tipe_pembayaran'] = "all";
            $data['pembayaran_id'][] = "all";
            $data['kotama_id'] = "all";
            $data['keanggotaan_id'] = "all";
            $data['satker_id'] = 0;
        }
        else {
            if ($tipe_pembayaran == NULL) {
                $data['tipe_pembayaran'] = "all";
// $pasien = Pasien::where('tni_satker_id', $tni_satker)->pluck('id')->toArray();
// $tni_satker = TNISatker::find($tni_satker);
                $transaksi = Transaksi::whereIn('status', [1, 2])->whereNotNull('tempat_tidur_id')->whereNull('waktu_keluar')
                ->with(RELASI_CARI)->get();
                if ($tni_kotama == "umum") {
                    $transaksi = $transaksi->filter(function($item){
                        return $item->pasien['tni_kotama_id'] == NULL || $item->pasien['tni_kotama_id'] == 0;
                    });
                    $data['kotama_id'] = "umum";
                    $data['satker_id'] = 0;
                }
                elseif ($tni_kotama == "tni") {
                    $transaksi = $transaksi->filter(function($item){
                        return $item->pasien['tni_kotama_id'] != NULL && $item->pasien['tni_kotama_id'] != 0;
                    });
                    $data['kotama_id'] = "tni";
                    $data['satker_id'] = 0;
                }
                else {
                    if ($tni_satker == NULL) {
                        $transaksi = $transaksi->filter(function($item) use($tni_kotama){
                            return $item->pasien['tni_kotama_id'] == $tni_kotama;
                        });
                        $data['satker_id'] = "all";
                        $data['tni_satker'] = TNISatker::where('kotama_id', $tni_kotama)->get();
                    } else {
                        $transaksi = $transaksi->filter(function($item) use($tni_satker){
                            return $item->pasien['tni_satker_id'] == $tni_satker;
                        });
                        $data['satker_id'] = $tni_satker;
                        $data['tni_satker'] = TNISatker::where('kotama_id', $tni_kotama)->get();
                    }
                    $data['kotama_id'] = $tni_kotama;
                }

// $transaksi = $transaksi->whereIn('pasien_id', $pasien)->get();

                $data['pembayaran_id'] = "all";
            }
            elseif ($tni_kotama == NULL) {
                $data['tni_kotama'] = "all";
                $transaksi = Transaksi::whereIn('status', [1, 2])->whereNotNull('tempat_tidur_id')->whereNull('waktu_keluar')
                ->with(RELASI_CARI)->get();
                $transaksi = $transaksi->filter(function($item) use($tipe_pembayaran){
                    return in_array($item->kasus->pembayaran['perusahaan_id'], $tipe_pembayaran);
                });
                $data['pembayaran_id'] = $tipe_pembayaran;
                $data['kotama_id'] = "all";
                $data['satker_id'] = 0;
            }
            elseif ($tni_satker == NULL) {
                $data['tni_satker'] = "all";
                $transaksi = Transaksi::whereIn('status', [1, 2])->whereNotNull('tempat_tidur_id')->whereNull('waktu_keluar')
                ->with(RELASI_CARI)->get();
                $transaksi = $transaksi->filter(function($item) use($tipe_pembayaran){
                    return in_array($item->kasus->pembayaran['perusahaan_id'], $tipe_pembayaran);
                });
                if ($tni_kotama == "umum") {
                    $transaksi = $transaksi->filter(function($item){
                        return $item->pasien['tni_kotama_id'] == NULL || $item->pasien['tni_kotama_id'] == 0;
                    });
                    $data['kotama_id'] = "umum";
                }
                elseif ($tni_kotama == "tni") {
                    $transaksi = $transaksi->filter(function($item){
                        return $item->pasien['tni_kotama_id'] != NULL && $item->pasien['tni_kotama_id'] != 0;
                    });
                    $data['kotama_id'] = "tni";
                }
                else {
                    $transaksi = $transaksi->filter(function($item) use($tni_kotama){
                        return $item->pasien['tni_kotama_id'] == $tni_kotama;
                    });
                    $data['kotama_id'] = $tni_kotama;
                }
                $data['pembayaran_id'] = $tipe_pembayaran;
                $data['tni_satker'] = TNISatker::where('kotama_id', $tni_kotama)->get();
                $data['satker_id'] = "all";
            }
            else {
                $transaksi = Transaksi::whereIn('status', [1, 2])->whereNotNull('tempat_tidur_id')->whereNull('waktu_keluar')
                ->with(RELASI_CARI)->get();
                $transaksi = $transaksi->filter(function($item) use($tipe_pembayaran, $tni_satker){
                    return in_array($item->kasus->pembayaran['perusahaan_id'], $tipe_pembayaran) && $item->pasien['tni_satker_id'] == $tni_satker;
                });
// $pasien = array_intersect($pasien_satker, $pasien_pembayaran);
                $tni_satker = TNISatker::find($tni_satker);
// $transaksi = Transaksi::where('status', 1)->whereNotNull('tempat_tidur_id')->whereNull('waktu_keluar');
// $transaksi = $transaksi->whereIn('pasien_id', $pasien)->paginate(1000);

                $data['pembayaran_id'] = $cari_pembayaran;
                $data['kotama_id'] = $tni_satker->kotama->id;
                $data['satker_id'] = $tni_satker->id;
                $data['tni_satker'] = TNISatker::where('kotama_id', $tni_satker->kotama->id)->get();
            }
            if($tni_keanggotaan != NULL){
                $transaksi = $transaksi->filter(function($item) use($tni_keanggotaan){
                    return $item->pasien['tni_keanggotaan_id'] == $tni_keanggotaan;
                });
                $data['keanggotaan_id'] = $tni_keanggotaan;
            }
        }
        $data['transaksi'] = $transaksi;
        $data['tipe_pembayaran'] = PembayaranPerusahaan::all();
        $data['tni_kotama'] = TNIKotama::all();
        $data['tni_keanggotaan'] = TNIKeanggotaan::all();
        return $data;
    }

    public function cari(Request $request)
    {
        $data = $this->getCariData($request);
        $data['routeFlag'] = 2;
        $data['link'] = "bangsal";    
        return view('rawatinap.cari',$data);
    }

    public function download(Request $request)
    {
        $tipe_pembayaran = $request->get('tipe_pembayaran');
        $tni_satker = $request->get('tni_satker');
        $tni_kotama = $request->get('tni_kotama');
        $result = $this->getCariData($request);
        $data['pasien'] = $result['transaksi'];
        $data['routeFlag'] = 2;
        $data['link'] = "bangsal";
        $data['tni_satker'] = $tni_satker;
        $data['tipe_pembayaran'] = $tipe_pembayaran;
        $filename = 'Daftar Pasien Rawat Inap.pdf';
//$pdf = DOMPDF::loadView('rawatinap.download', $data, [])->setPaper('a4', 'landscape');

        $pdf = MPDF::loadView('rawatinap.download', $data, [], [
            'mode' => 'utf-8',
            'format' => 'A4-L'
        ]);

        return $pdf->stream($filename);
    }




    public function screenTV()
    {
        $data['bangsals'] = app('App\Http\Controllers\RawatInap\Bangsal\ReadController')->getKetersediaanRawatInap();
        return view('rawatinap.info.screen.index',$data);
    }

    public function infoBangsal(Request $request)
    {
        $data['bangsals'] = app('App\Http\Controllers\RawatInap\Bangsal\ReadController')->getBangsalKelasApplicare();
        $data['routeFlag'] = 2;
        $data['link'] = "bangsal";
        return view('rawatinap.info.index',$data);
    }
}
