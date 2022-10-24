<?php

namespace App\Http\Controllers\Pasien\Antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RujukLuar;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PengaturanLoket;
use App\Models\Pasien\MesinAntrianPasien;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Dokter;
use App\Models\Pasien\PasienPembayaran;
use App\User;
use Carbon\Carbon;
use Auth;
use Log;

class CreateController extends Controller
{
    protected static $path_generate = 'assets/img/rawatjalan-tv/sound/antrian-pasien/';
    protected static $jenis_pasien = [
        'pasien_lama' => 1,
        'pasien_baru' => 2,
        'pasien_tunai' => 3,
        'pasien_tni' => 4,
        'pasien_pamen_pati' => 5,
        'pasien_tni_gagal_auto_sep' => 6
    ];

    public function create($request)
    {
        $path = 'assets/img/rawatjalan-tv/sound/';
        $date_now = Carbon::today()->toDateString();
        $pasien_pembayaran_id = $request->pembayaran ?? Null;
        if (!empty($request->pasien_baru)) {
            $antrian_query = MesinAntrianPasien::whereDate('created_at', '=', $date_now);
            $antrian_count = with(clone $antrian_query)->count();
            $loket = PengaturanLoket::where('jenis_pasien', self::$jenis_pasien['pasien_baru'])->get();
            
            $first_loket = $loket->first();
            if ($antrian_count == 0) {
                $nama_loket = substr($first_loket->nama_loket, 6);

                $antrian = new MesinAntrianPasien;
                $antrian->loket_id = $first_loket->id;
                $antrian->jenis_pasien = self::$jenis_pasien['pasien_baru'];
                $antrian->jumlah_antrian = 1;
                $antrian->dokter_id = $request->dokter;
                $antrian->id_jadwal = $request->id_jadwal;
                $antrian->save();

                $audio[] = file_get_contents($path.'antrian.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                $audio[] = file_get_contents($path.'nomor.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                $audio[] = file_get_contents($path.'1.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                $audio[] = file_get_contents($path.'menuju.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                $audio[] = file_get_contents($path.'loket.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                $audio[] = file_get_contents($path.$nama_loket.'.mp3');

                $nama_file = $first_loket->id.'-1.mp3';

                if (!file_exists(self::$path_generate) && !is_dir(self::$path_generate)) {
                    mkdir(self::$path_generate, 0777, true);
                }
                $merge_audio = app('App\Http\Controllers\Functions\AudioCombine')->makeAudio(self::$path_generate, $nama_file, $audio);
            }else{
                $antrian_last = with(clone $antrian_query)->whereIn('loket_id', $loket->pluck('id'))->latest()->first();

                $id_loket = $first_loket->id ?? 0;
                $nama_loket = $first_loket->nama_loket ?? '';
                if (!empty($antrian_last)) {
                    foreach ($loket as $key => $item) {
                        if ($antrian_last->loket_id == $item->id) {
                            if (empty($loket[$key+1])) {
                                    $id_loket = $first_loket->id;
                                    $nama_loket = $first_loket->nama_loket;
                                break;
                            } else {
                                $id_loket = $loket[$key+1]->id;
                                $nama_loket = $loket[$key+1]->nama_loket;
                                break;
                            }
                        }
                        continue;
                    }
                }
                
                $total_antrian = with(clone $antrian_query)->where('loket_id', $id_loket)->count();
                $nomor_antrian = $total_antrian + 1;
                
                $ar_nomor = str_split($nomor_antrian);
                $nama_loket = substr($nama_loket, 5);

                $antrian = new MesinAntrianPasien;
                $antrian->loket_id = $id_loket;
                $antrian->jenis_pasien = self::$jenis_pasien['pasien_baru'];
                $antrian->jumlah_antrian = $nomor_antrian;
                $antrian->save();

                $audio[] = file_get_contents($path.'antrian.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                $audio[] = file_get_contents($path.'nomor.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                if ($nomor_antrian > 20) {
                    foreach ($ar_nomor as $key => $item) {
                        $audio[] = file_get_contents($path.$item.'.mp3');
                        $audio[] = file_get_contents($path.'-.mp3');
                    }
                }else {
                    $audio[] = file_get_contents($path.$nomor_antrian.'.mp3');
                    $audio[] = file_get_contents($path.'-.mp3');
                }
                $audio[] = file_get_contents($path.'menuju.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                $audio[] = file_get_contents($path.'loket.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
                if (file_exists($path.$nama_loket)) {
                    $audio[] = file_get_contents($path.$nama_loket.'.mp3');
                }
                //$audio[] = file_get_contents($path.$nama_loket.'.mp3');

                $nama_file = $id_loket.'-'.$antrian->jumlah_antrian.'.mp3';

                if (!file_exists(self::$path_generate) && !is_dir(self::$path_generate)) {
                    mkdir(self::$path_generate, 0777, true);
                }
                $merge_audio = app('App\Http\Controllers\Functions\AudioCombine')->makeAudio(self::$path_generate, $nama_file, $audio);
            }
        }else {
            $pasien = Pasien::where('no_rm', $request->no_rm)->first();
            $dokter = Dokter::where('id', $request->dokter)->first();
            $poliklinik = Poliklinik::where('id', $request->poliklinik)->first();
            //dd($poliklinik,$request->poliklinik);
            $loket = PengaturanLoket::where('nama_loket', $request->loket)->first();
    
            $antrian = new MesinAntrianPasien;
            $antrian->no_rm = $request->no_rm ?? Null;
            $failed_auto_sep = (bool) $request->failed_auto_sep;
            if ($request->no_rm) {
                $jenis_jenjang = $pasien->tni_pangkat->jenis_jenjang->id ?? null;
                $pembayaran = PasienPembayaran::find($pasien_pembayaran_id)->perusahaan->type;
                if ($pembayaran == 4) {
                    $antrian->jenis_pasien = self::$jenis_pasien['pasien_tunai'];
                } elseif ($pembayaran == 1){
                    if (isset($jenis_jenjang) || !empty($pasien->wali->is_anggota)) {
                        if ($failed_auto_sep){
                            $antrian->jenis_pasien = self::$jenis_pasien['pasien_tni_gagal_auto_sep'];
                            //Pasien TNI
                        } elseif ($jenis_jenjang == 1 || $jenis_jenjang == 2) { /* pangkat TNI dengna id 1 atau 2 */
                            $antrian->jenis_pasien = self::$jenis_pasien['pasien_pamen_pati'];
                            // pamen
                        } else{
                            $antrian->jenis_pasien = self::$jenis_pasien['pasien_tni']; /* pangkat TNI dengna selain id 1 atau 2 */
                            // pasien keluarga tni
                        }
                    }else{
                        $antrian->jenis_pasien = self::$jenis_pasien['pasien_lama'];
                        // pasien lama
                    }
                }else{
                    $antrian->jenis_pasien = self::$jenis_pasien['pasien_lama'];
                    // pasien lama
                }
            }else{
                $antrian->jenis_pasien = 0;
            }
            $antrian->loket_id = $loket->id;
            $antrian->poliklinik_id = $poliklinik->id;
            $antrian->dokter_id = $dokter->id;
            $antrian->id_jadwal = $request->id_jadwal;
            $antrian->jumlah_antrian = $request->antrian;
            $antrian->save();
            $antrian->loket_nama = $loket->nama_loket;

            $nama_loket = substr($loket->nama_loket,7);
            $ar_nomor = str_split($request->antrian);

            $audio[] = file_get_contents($path.'antrian.mp3');
            $audio[] = file_get_contents($path.'-.mp3');
            $audio[] = file_get_contents($path.'nomor.mp3');
            $audio[] = file_get_contents($path.'-.mp3');
            if ($request->antrian > 20) {
                foreach ($ar_nomor as $key => $item) {
                    $audio[] = file_get_contents($path.$item.'.mp3');
                    $audio[] = file_get_contents($path.'-.mp3');
                }
            }else {
                $audio[] = file_get_contents($path.$request->antrian.'.mp3');
                $audio[] = file_get_contents($path.'-.mp3');
            }
            $audio[] = file_get_contents($path.'-.mp3');
            $audio[] = file_get_contents($path.'menuju.mp3');
            $audio[] = file_get_contents($path.'-.mp3');
            $audio[] = file_get_contents($path.'loket.mp3');
            $audio[] = file_get_contents($path.'-.mp3');
            $audio[] = file_get_contents($path.$nama_loket.'.mp3');

            $nama_file = $loket->id.'-'.$request->antrian.'.mp3';

            if (!file_exists(self::$path_generate) && !is_dir(self::$path_generate)) {
                mkdir(self::$path_generate, 0777, true);
            }
            $merge_audio = app('App\Http\Controllers\Functions\AudioCombine')->makeAudio(self::$path_generate, $nama_file, $audio);
        }

        // ? create transaksi rawat jalan 
        if (empty($request->pasien_baru)) {
            $request_data = new \Illuminate\Http\Request();
            $request_data->replace([
                'is_video' => 0,
                'mesin_antrian_id' => $antrian->id,
                'pasien_id' => $pasien->id ?? null,
                'pasien_data' => $pasien ?? null,
                'bayar_id' => $pasien_pembayaran_id,
                'dokter_id' => $request->dokter ?? null,
                'dokter_jadwal_id' => $request->id_jadwal ?? null,
                'layanan' => 1,
                'poliklinik_id' => $request->poliklinik ?? null,
                'konfirmasi_at' => null,
                'konfirmasi_by' => null,
                'rujuk_id' => null
            ]);
            $data = app('App\Http\Controllers\Pasien\Pasien\PostController')->APIPendaftaranPasien($request_data);
        }

        // Untuk membersihkan file lama > 2 hari
        foreach (glob(self::$path_generate."*") as $file) {
            if (filemtime($file) < time() - 172800) { // 2 hari
                unlink($file);
            }
        }

        return $antrian;
    }

    public function edit($id, $update_data)
    {
        $antrian = MesinAntrianPasien::where('id', $id)->update($update_data);
        return $antrian;
    }
}
