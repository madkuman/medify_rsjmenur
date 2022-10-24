<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Agama;
use App\Models\Kepegawaian\MasterKualifikasi;
use App\Models\Kepegawaian\MasterJenisPegawai;
use App\Models\Kepegawaian\MasterStatusPegawai;
use App\Models\Kepegawaian\MasterJabatan;
use App\Models\Kepegawaian\MasterDepartemen;
use Carbon\Carbon;
use DateTime;

class PegawaiImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $kualifikasi = MasterKualifikasi::all();
        $jenis_pegawai = MasterJenisPegawai::all();
        $status_pegawai = MasterStatusPegawai::all();
        $jabatan = MasterJabatan::all();
        $agama = Agama::all();
        $data = [];
        foreach ($collection as $key => $row) {
            if ($key >= 2) {
                $genders = Null;
                switch($row[7]){
                    case 'Perempuan':
                        $genders = 'P';
                        break;
                    case 'Laki - laki':
                        $genders = 'L';
                        break;
                    case 'L':
                        $genders = 'L';
                        break;
                    case 'P':
                        $genders = 'P';
                        break;
                    default:
                        break;
                }

                if (empty($kualifikasi->where('nama', $row[11])->toArray())) {
                    $kualifikasi_new = new MasterKualifikasi;
                    $kualifikasi_new->nama = $row[11];
                    $kualifikasi_new->save();
                    $kualifikasi[] = $kualifikasi_new;
                }

                if (empty($jenis_pegawai->where('nama', $row[5])->toArray())) {
                    $jenis_pegawai_new = new MasterJenisPegawai;
                    $jenis_pegawai_new->nama = $row[5];
                    $jenis_pegawai_new->save();
                    $jenis_pegawai[] = $jenis_pegawai_new;
                }

                if (empty($status_pegawai->where('status', $row[6])->toArray())) {
                    $status_pegawai_new = new MasterStatusPegawai;
                    $status_pegawai_new->status = $row[6];
                    $status_pegawai_new->save();
                    $status_pegawai[] = $status_pegawai_new;
                }

                if (empty($agama->where('nama', $row[9])->toArray())) {
                    $agama_new = new Agama;
                    $agama_new->nama = $row[9];
                    $agama_new->save();
                    $agama[] = $agama_new;
                }

                if (empty($jabatan->where('nama', $row[3])->toArray())) {
                    $jabatan_new = new MasterJabatan;
                    $jabatan_new->nama = $row[3];
                    $jabatan_new->save();
                    $jabatan[] = $jabatan_new;
                }

                $kual = $kualifikasi->firstWhere('nama', $row[11]);
                $id_kualifikasi = (int)$kual->id;
                $jp = $jenis_pegawai->firstWhere('nama', $row[5]);
                $id_jp = (int)$jp->id;
                $sp = $status_pegawai->firstWhere('status', $row[6]);
                $id_sp = (int)$sp->id;
                $ag = $agama->firstWhere('nama', $row[9]);
                $id_agama = (int)$ag->id;
                $jab = $jabatan->firstWhere('nama', $row[3]);
                $id_jabatan = (int)$jab->id;
                $tanggal_lahir = ($row[8] - 25569) * 86400;
                $tmt = ($row[12] - 25569) * 86400;
                $tmt_out = ($row[13] - 25569) * 86400;

                if (empty($row[3])) {
                    array_push($data, [
                        'name' => $row[1],
                        'gender' => $genders,
                        'nrp' => $row[2],
                        'pangkat_id' => $row[4],
                        'jenis_pegawai_id' => $id_jp,
                        'status_pegawai_id' => $id_sp,
                        'kualifikasi' => $id_kualifikasi,
                        'agama_id' => $id_agama,
                        'birth_date' => gmdate('Y-m-d', $tanggal_lahir),
                        'tmt' => gmdate('Y-m-d', $tmt),
                        'tmt_out' => gmdate('Y-m-d', $tmt_out),
                        'address' => $row[10]
                    ]);
                }else {
                    array_push($data, [
                        'name' => $row[1],
                        'gender' => $genders,
                        'nrp' => $row[2],
                        'pangkat_id' => $row[4],
                        'jenis_pegawai_id' => $id_jp,
                        'status_pegawai_id' => $id_sp,
                        'kualifikasi' => $id_kualifikasi,
                        'jabatan_id' => $id_jabatan,
                        'agama_id' => $id_agama,
                        'birth_date' => gmdate('Y-m-d', $tanggal_lahir),
                        'tmt' => gmdate('Y-m-d', $tmt),
                        'tmt_out' => gmdate('Y-m-d', $tmt_out),
                        'address' => $row[10]
                    ]);
                    
                }
            }
        }
        $pegawai = Pegawai::insert($data);
    }
}
