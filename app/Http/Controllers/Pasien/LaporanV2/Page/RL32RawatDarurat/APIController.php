<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL32RawatDarurat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\DTD;
use App\Models\Hospital\MasterStatusPulang;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Bangsal;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
        $transaksi_igd      = app(\App\Http\Controllers\IGD\Transaksi\ReadController::class)->getTransaksiByYear($request);
        // dd($transaksi_igd);
        $kasus_ids = $transaksi_igd->pluck('kasus_id')->toArray();
        $set_request_kasus = (object)[
            'kasus_ids' => $kasus_ids
        ];
        $eager_kasus = [
            'diagnosisUtama'
        ];
        // dd($set_request_kasus);
        $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->getKasusKRSInId($set_request_kasus, $eager_kasus);
        $diagnosis = $kasus->map(function($query){
            return $query->diagnosisUtama;
        });
        // dd($kasus, $diagnosis->groupBy('icd_10'));
        $total = $diagnosis->groupBy('icd_10')->count();
        return json_encode([
            'status' => 200,
            'data' => $total,
        ]);
    }

    public function getData(Request $request)
    {
        // dd($request->all());
        $array_data = $request->array_data ?? [];
        $take = $request->data_per_fetch;
        $skip = $request->data_fetched ?? null;
        $request = $request->merge([
            'take' => $take,
            'skip' => $skip
        ]);
        $eager = [
            'kasus.diagnosisTambahanBpjs'
        ];
        $transaksi_igd      = app(\App\Http\Controllers\IGD\Transaksi\ReadController::class)->getTransaksiByYear($request, $eager);
        // dd($transaksi_igd);
        $kasus_ids = $transaksi_igd->pluck('kasus_id')->toArray();
        // dd($kasus_ids);
        $set_request_kasus = (object)[
            'kasus_ids' => $kasus_ids
        ];
        $eager_kasus = [
            'diagnosisUtama.icd10',
            'alasan_krs.inacbg',
            'TransaksiIGD',
            'pasien',
            'sirsLayananKhusus',
        ];
        $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->getKasusKRSInId($set_request_kasus, $eager_kasus);
        // dd($set_request_kasus, $kasus);
        $index           = $request->data_fetched;
        $jenis_pelayanan     = '';
        $arr_jenis_pelayanan = $request->arr_jenis_pelayanan ?? [];
        $arr_index           = [];
        // dd($kasus);
        foreach ($kasus as $key => $value){
            // if($value->krs_alasan == 3)
            //     dd($value->krs_at, $value->alasan_krs, $value->pasien->death_at); 
            $transaksi_igd = end($value->TransaksiIGD)[0];
            // dd($transaksi_igd);
            $jenis_pelayanan = $value->sirsLayananKhusus->nama ?? 'IGD';
            $total_pasien_rujukan[$jenis_pelayanan]            = $array_data[$jenis_pelayanan]['total_pasien_rujukan'] ?? 0;
            $total_pasien_non_rujukan[$jenis_pelayanan]        = $array_data[$jenis_pelayanan]['total_pasien_non_rujukan'] ?? 0;
            $tindak_lanjut_pelayanan_dirawat[$jenis_pelayanan] = $array_data[$jenis_pelayanan]['tindak_lanjut_pelayanan_dirawat'] ?? 0;
            $tindak_lanjut_pelayanan_dirujuk[$jenis_pelayanan] = $array_data[$jenis_pelayanan]['tindak_lanjut_pelayanan_dirujuk'] ?? 0;
            $tindak_lanjut_pelayanan_pulang[$jenis_pelayanan]  = $array_data[$jenis_pelayanan]['tindak_lanjut_pelayanan_pulang'] ?? 0;
            $mati_di_igd[$jenis_pelayanan]                     = $array_data[$jenis_pelayanan]['mati_di_igd'] ?? 0;
            $doa[$jenis_pelayanan]                             = $array_data[$jenis_pelayanan]['doa'] ?? 0;
            if(!in_array($jenis_pelayanan, $arr_jenis_pelayanan)){
                array_push($arr_jenis_pelayanan, $jenis_pelayanan);
                $index++;
                $array_data[$jenis_pelayanan]['no'] = $index;
            }

            if(!empty($value->asal_rujukan_id) || $value->asal_rujukan_id != 0)
                $total_pasien_rujukan[$jenis_pelayanan]++;
            else
                $total_pasien_non_rujukan[$jenis_pelayanan]++;
                
            if(($value->alasan_krs->slug ?? '-') == 'dirawat')
                $tindak_lanjut_pelayanan_dirawat[$jenis_pelayanan]++;
                
            if(($value->alasan_krs->slug ?? '-') == 'dirujuk')
                $tindak_lanjut_pelayanan_dirujuk[$jenis_pelayanan]++;

            if(($value->alasan_krs->slug ?? '-') == 'selesai-pelayanan'){

                if($value->alasan_krs->inacbg->nama == 'Meninggal'){
    
                    $masuk_igd = Carbon::parse($transaksi_igd->waktu_masuk)->format('Y-m-d H:i:s');
                    $death_at  = Carbon::parse($value->pasien->death_at)->format('Y-m-d H:i:s');
                    if($death_at <= $masuk_igd )
                        $doa[$jenis_pelayanan]++;
                    else
                        $mati_di_igd[$jenis_pelayanan]++;
                }else{
                    $tindak_lanjut_pelayanan_pulang[$jenis_pelayanan]++;
                }
            }

            // dd($request->all(), $arr_index, $jenis_pelayanan, $arr_jenis_pelayanan);
            $array_data[$jenis_pelayanan] = [
                'kode_provinsi'                   => null,
                'kab_kota'                        => null,
                'kode_rs'                         => null, 
                'nama_rs'                         => config('app.name'),
                'tahun'                           => $request->tahun_transaksi,
                'no'                              => $array_data[$jenis_pelayanan]['no'],
                'jenis_pelayanan'                 => $jenis_pelayanan,
                'total_pasien_rujukan'            => $total_pasien_rujukan[$jenis_pelayanan] ?? 0,
                'total_pasien_non_rujukan'        => $total_pasien_non_rujukan[$jenis_pelayanan] ?? 0,
                'tindak_lanjut_pelayanan_dirawat' => $tindak_lanjut_pelayanan_dirawat[$jenis_pelayanan] ?? 0,
                'tindak_lanjut_pelayanan_dirujuk' => $tindak_lanjut_pelayanan_dirujuk[$jenis_pelayanan] ?? 0,
                'tindak_lanjut_pelayanan_pulang'  => $tindak_lanjut_pelayanan_pulang[$jenis_pelayanan] ?? 0,
                'mati_di_igd'                     => $mati_di_igd[$jenis_pelayanan] ?? 0,
                'doa'                             => $doa[$jenis_pelayanan] ?? 0,
            ];
            # buat ngecek
            // echo 'kode_provinsi : '                  .null.'<br>';
            // echo 'kab_kota : '                       .null.'<br>';
            // echo 'kode_rs : '                        .null.'<br>';
            // echo 'nama_rs : '                        .config('app.name').'<br>';
            // echo 'tahun : '                          .$request->tahun_transaksi.'<br>';
            // echo 'no : '                             .$arr_index[$jenis_pelayanan].'<br>';
            // echo 'jenis_pelayanan : '                .$jenis_pelayanan.'<br>';
            // echo 'total_pasien_rujukan : '           .($total_pasien_rujukan[$jenis_pelayanan] ?? 0).'<br>';
            // echo 'total_pasien_non_rujukan : '       .($total_pasien_non_rujukan[$jenis_pelayanan] ?? 0).'<br>';
            // echo 'tindak_lanjut_pelayanan_dirawat : '.($tindak_lanjut_pelayanan_dirawat[$jenis_pelayanan] ?? 0).'<br>';
            // echo 'tindak_lanjut_pelayanan_dirujuk : '.($tindak_lanjut_pelayanan_dirujuk[$jenis_pelayanan] ?? 0).'<br>';
            // echo 'tindak_lanjut_pelayanan_pulang : ' .($tindak_lanjut_pelayanan_pulang[$jenis_pelayanan] ?? 0).'<br>';
            // echo 'mati_di_igd : '                    .($mati_di_igd[$jenis_pelayanan] ?? 0).'<br>';
            // echo 'doa : '                            .($doa[$jenis_pelayanan] ?? 0).'<br>';
            // echo '<hr>';
        }
        // dd($array_data);
        
		return json_encode([
			'status' => 200,
			'data'   => $array_data,
            'arr_jenis_pelayanan' => $arr_jenis_pelayanan,

		]);



    }
}
