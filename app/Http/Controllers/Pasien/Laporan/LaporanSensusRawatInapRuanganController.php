<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;

class LaporanSensusRawatInapRuanganController extends Controller
{
    public function get($date, $ruangan)
    {
        $period = CarbonPeriod::create($date->firstOfMonth()->format('Y-m-d'), $date->endOfMonth()->format('Y-m-d'));
        $nama_ruangan = Bangsal::find($ruangan);
        $nama_ruangan = $nama_ruangan->nama ?? '';
        $ruangan_id = Ruangan::where('bangsal_id', $ruangan)->pluck('id')->toArray();
        $tt = TempatTidur::whereIn('ruangan_id', $ruangan_id)->pluck('id')->toArray();
        $jum_tt = count($tt);
        $ttString = implode(',', $tt);

        $data_laporan = [];

        $data_laporan['jum_tt']["total"] = $jum_tt;
        $data_laporan['ruangan']["nama"] = $nama_ruangan;

        foreach ($period as $key => $date) {
            $tanggal = $date->format('Y-m-d');
            $total_1 = 0;
            $total_2 = 0;
            $total_3 = 0;

            //query jumlah awal
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                and DATE(trx_ri.waktu_masuk) < '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_awal"] = $data[0]->total;            

            //query jumlah POLI
            $query = "
                SELECT COUNT(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        AND trx_ri_2.is_pindah = 0
                        AND DATE(trx_ri_2.waktu_masuk) = '".$tanggal."'
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                AND kasus.tipe_rj = 1
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_poli"] = $data[0]->total;
            $total_1 += $data_laporan[$tanggal]["jumlah_poli"];

            //query jumlah IGD
            $query = "
                SELECT COUNT(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        AND trx_ri_2.is_pindah = 0
                        AND DATE(trx_ri_2.waktu_masuk) = '".$tanggal."'
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                AND kasus.tipe_igd = 1
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_igd"] = $data[0]->total;
            $total_1 += $data_laporan[$tanggal]["jumlah_igd"];

            //query jumlah pindahan
            $query = "
                SELECT COUNT(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        AND trx_ri_2.is_pindah = 1
                        AND DATE(trx_ri_2.waktu_masuk) = '".$tanggal."'
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_pindahan"] = $data[0]->total;
            $total_1 += $data_laporan[$tanggal]["jumlah_pindahan"];

            $data_laporan[$tanggal]["total_1"] = $total_1;

            //query jumlah Sembuh Sosial
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND kasus.krs_alasan = 'Selesai Pelayanan'
                AND kasus.krs_status = 'Sembuh'
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_ss"] = $data[0]->total;
            $total_2 += $data_laporan[$tanggal]["jumlah_ss"];

            //query jumlah Pulang Paksa
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND kasus.krs_alasan = 'Pulang Paksa'
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_pulang_paksa"] = $data[0]->total;
            $total_2 += $data_laporan[$tanggal]["jumlah_pulang_paksa"];
            $total_3 += $data_laporan[$tanggal]["jumlah_pulang_paksa"];

             //query jumlah Pindah RS lain
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND kasus.krs_alasan = 'Rujuk Rumah Sakit Lain'
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_pindah_rs"] = $data[0]->total;
            $total_2 += $data_laporan[$tanggal]["jumlah_pindah_rs"];
            $total_3 += $data_laporan[$tanggal]["jumlah_pindah_rs"];

            //query jumlah Drop
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND kasus.krs_alasan = 'Pulang Dropping'
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_drop"] = $data[0]->total;
            $total_2 += $data_laporan[$tanggal]["jumlah_drop"];
            $total_3 += $data_laporan[$tanggal]["jumlah_drop"];

            //query jumlah Lari
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND kasus.krs_alasan = 'Melarikan Diri'
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_lari"] = $data[0]->total;
            $total_2 += $data_laporan[$tanggal]["jumlah_lari"];
            $total_3 += $data_laporan[$tanggal]["jumlah_lari"];

            //query jumlah meninggal < 48 jam
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND kasus.krs_status = 'Meninggal'
                AND kasus.lama_perawatan < 2
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_mati_kurang_48"] = $data[0]->total;
            $total_2 += $data_laporan[$tanggal]["jumlah_mati_kurang_48"];
            $total_3 += $data_laporan[$tanggal]["jumlah_mati_kurang_48"];

            //query jumlah meninggal > 48 jam
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND kasus.krs_status = 'Meninggal'
                AND kasus.lama_perawatan > 2
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_mati_lebih_48"] = $data[0]->total;
            $total_2 += $data_laporan[$tanggal]["jumlah_mati_lebih_48"];
            $total_3 += $data_laporan[$tanggal]["jumlah_mati_lebih_48"];

            $data_laporan[$tanggal]["total_2"] = $total_2;

            $data_laporan[$tanggal]["total_3"] = $total_3;

            //query jumlah mrs sama krs
            $query = "
                SELECT COUNT(1) AS total
                FROM medify_rsjmenur_kasus.kasus kasus
                WHERE kasus.tipe_ri = 1
                AND DATE(kasus.krs_at) = '".$tanggal."'
                AND DATE(kasus.mrs_at) = DATE(kasus.krs_at)
            ";

            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_mrs_sama_krs"] = $data[0]->total;

            //query pasien masih di rawat
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_masih_dirawat"] = $data[0]->total;

            //query pasien kelas vip a
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND kasus.kelas_id = 4
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_vip_a"] = $data[0]->total;

            
            //query pasien kelas vip b
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND kasus.kelas_id = 5
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_vip_b"] = $data[0]->total;

            
            //query pasien kelas vip c
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND kasus.kelas_id = 6
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_vip_c"] = $data[0]->total;

            
            //query pasien kelas vip D
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND kasus.kelas_id = 7
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_vip_d"] = $data[0]->total;

            
            //query pasien kelas 1
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND kasus.kelas_id = 1
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_kelas_1"] = $data[0]->total;

            //query pasien kelas 2
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND kasus.kelas_id = 2
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_kelas_2"] = $data[0]->total;

            //query pasien kelas 3
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND kasus.kelas_id = 3
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_kelas_3"] = $data[0]->total;

            //query pasien umum
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                INNER JOIN medify_rsjmenur_patients.pasien_pembayaran pasien_pembayaran ON kasus.pasien_pembayaran_id = pasien_pembayaran.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND pasien_pembayaran.perusahaan_id = 6
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_umum"] = $data[0]->total;

            //query pasien non PBI
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                INNER JOIN medify_rsjmenur_patients.pasien_pembayaran pasien_pembayaran ON kasus.pasien_pembayaran_id = pasien_pembayaran.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND pasien_pembayaran.perusahaan_id = 1
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_non_pbi"] = $data[0]->total;

            //query pasien PBI
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                INNER JOIN medify_rsjmenur_patients.pasien_pembayaran pasien_pembayaran ON kasus.pasien_pembayaran_id = pasien_pembayaran.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND pasien_pembayaran.perusahaan_id IN (2,11)
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_PBI"] = $data[0]->total;

            //query pasien SKM / SPM
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                INNER JOIN medify_rsjmenur_patients.pasien_pembayaran pasien_pembayaran ON kasus.pasien_pembayaran_id = pasien_pembayaran.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND pasien_pembayaran.perusahaan_id = 8
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_skm"] = $data[0]->total;

            //query pasien JKD
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                INNER JOIN medify_rsjmenur_patients.pasien_pembayaran pasien_pembayaran ON kasus.pasien_pembayaran_id = pasien_pembayaran.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND pasien_pembayaran.perusahaan_id IN (3,4,5)
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_jkd"] = $data[0]->total;

            //query pasien sehati
            $query = "
                SELECT count(1) as total
                FROM medify_rsjmenur_kasus.kasus kasus
                INNER JOIN 
                (
                    SELECT * FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_1
                    WHERE trx_ri_1.id IN (
                        SELECT MAX(id) FROM medify_rsjmenur_rawat_inap.transaksi trx_ri_2
                        WHERE trx_ri_2.deleted_at IS NULL
                        AND trx_ri_2.status NOT IN (0,-1)
                        GROUP BY trx_ri_2.kasus_id
                    )	
                ) ri ON kasus.id = ri.kasus_id
                INNER JOIN medify_rsjmenur_rawat_inap.transaksi trx_ri ON ri.id = trx_ri.id
                INNER JOIN medify_rsjmenur_patients.pasien_pembayaran pasien_pembayaran ON kasus.pasien_pembayaran_id = pasien_pembayaran.id
                WHERE kasus.tipe_ri = 1
                and kasus.krs_at IS NULL
                AND pasien_pembayaran.perusahaan_id = 7
                and DATE(trx_ri.waktu_masuk) <= '".$tanggal."'
                AND trx_ri.tempat_tidur_id IN (".$ttString.")
            ";
            $data = DB::select(DB::raw($query));

            $data_laporan[$tanggal]["jumlah_sehati"] = $data[0]->total;
        }

        $return['period'] = $period;
        $return['data_laporan'] = $data_laporan;

        return $return;
    }
}
