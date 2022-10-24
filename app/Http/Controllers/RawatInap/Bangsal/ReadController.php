<?php

namespace App\Http\Controllers\RawatInap\Bangsal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\Models\Hospital\Kelas;
use DB;

class ReadController extends Controller
{
	public function APIAdminInfo($id)
	{
		$bangsal = Bangsal::find($id);
		$ruangan = Ruangan::where('bangsal_id',$id)->get();
		$data['bangsal'] = $bangsal;
		$data['ruangan'] = $ruangan;
		return view('rawatinap.admin.bangsal.info',$data);
	}
	

	public function allBangsal()
	{
		$items = Bangsal::all();
		return $items;
	}

	public function getBangsalKelasApplicare()
	{
		$query = "
        SELECT
            bedtotal.kelas,
            bedtotal.bed_total,
            bedkosong.bed_kosong,
            pasientotal.pasien_total,
            pasienbooking.pasien_booking
        FROM
        (
            SELECT
                ruangan.kelas,
                COUNT(1) AS bed_total
            FROM ruangan
            JOIN tempat_tidur
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND ruangan.id = tempat_tidur.ruangan_id
            GROUP BY ruangan.kelas
        ) bedtotal
        LEFT JOIN
        (
            SELECT
                ruangan.kelas,
                COUNT(1) AS bed_kosong
            FROM ruangan
            JOIN tempat_tidur
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND tempat_tidur.transaksi_id IS NULL
                AND tempat_tidur.booking_id IS NULL
                AND ruangan.id = tempat_tidur.ruangan_id
            GROUP BY ruangan.kelas
        ) bedkosong ON bedtotal.kelas = bedkosong.kelas
        LEFT JOIN
        (
            SELECT
                ruangan.kelas,
                COUNT(1) AS pasien_total
            FROM ruangan
            JOIN tempat_tidur
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND tempat_tidur.transaksi_id IS NOT NULL
                AND ruangan.id = tempat_tidur.ruangan_id
            GROUP BY ruangan.kelas
        ) pasientotal ON bedtotal.kelas = pasientotal.kelas
        LEFT JOIN
        (
            SELECT
                ruangan.kelas,
                COUNT(1) AS pasien_booking
            FROM ruangan
            JOIN tempat_tidur
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND tempat_tidur.booking_id IS NOT NULL
                AND ruangan.id = tempat_tidur.ruangan_id
            GROUP BY ruangan.kelas
        ) pasienbooking ON bedtotal.kelas = pasienbooking.kelas;
        ";
        $bangsals = DB::connection('rawatinap')->select($query);
        foreach ($bangsals as $key => $value) {
            $value = $this->getKelasNama($value);
        }

        return $bangsals;
	}

    private function getKelasNama($item)
    {
        $item->kelas_nama = Kelas::find($item->kelas)->nama;
    }

    private function getKelasApplicareNama($item)
    {
        if ($item->kelas_applicare == 'HCU') {
            $item->kelas_nama = 'HCU';
        } else if ($item->kelas_applicare == 'ICU') {
            $item->kelas_nama = 'ICU';
        } else if ($item->kelas_applicare == 'ISO') {
            $item->kelas_nama = 'Isolasi';
        } else if ($item->kelas_applicare == 'KL1') {
            $item->kelas_nama = 'Kelas I';
        } else if ($item->kelas_applicare == 'KL2') {
            $item->kelas_nama = 'Kelas II';
        } else if ($item->kelas_applicare == 'KL3') {
            $item->kelas_nama = 'Kelas III';
        } else if ($item->kelas_applicare == 'NIC') {
            $item->kelas_nama = 'NICU';
        } else if ($item->kelas_applicare == 'ICC') {
            $item->kelas_nama = 'ICCU';
        } else if ($item->kelas_applicare == 'PIC') {
            $item->kelas_nama = 'PICU';
        } else if ($item->kelas_applicare == 'VIP') {
            $item->kelas_nama = 'VIP';
        } else if ($item->kelas_applicare == 'SAL') {
            $item->kelas_nama = 'Bersalin';
        } else if ($item->kelas_applicare == 'VVP') {
            $item->kelas_nama = 'VVIP';
        } else if ($item->kelas_applicare == 'IGD') {
            $item->kelas_nama = 'IGD';
        } else if ($item->kelas_applicare == 'UGD') {
            $item->kelas_nama = 'UGD';
        } else if ($item->kelas_applicare == 'UTA') {
            $item->kelas_nama = 'Utama';
        }
        
        return $item;
    }

    public function getKetersediaanRawatInap()
    {
        $query = "
        SELECT
            bedtotal.bangsal_id,
            bedtotal.kelas,
            bedtotal.bed_total,
            bedkosong.bed_kosong,
            pasientotal.pasien_total,
            pasienbooking.pasien_booking
        FROM
        (
            SELECT
                ruangan.bangsal_id,
                ruangan.kelas,
                COUNT(1) AS bed_total
            FROM ruangan
            JOIN tempat_tidur
            JOIN bangsal
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND bangsal.deleted_at IS NULL
                AND ruangan.id = tempat_tidur.ruangan_id
                AND ruangan.bangsal_id = bangsal.id
            GROUP BY ruangan.bangsal_id, ruangan.kelas
        ) bedtotal
        LEFT JOIN
        (
            SELECT
                ruangan.bangsal_id,
                ruangan.kelas,
                COUNT(1) AS bed_kosong
            FROM ruangan
            JOIN tempat_tidur
            JOIN bangsal
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND bangsal.deleted_at IS NULL
                AND tempat_tidur.transaksi_id IS NULL
                AND tempat_tidur.booking_id IS NULL
                AND ruangan.id = tempat_tidur.ruangan_id
                AND ruangan.bangsal_id = bangsal.id
            GROUP BY ruangan.bangsal_id, ruangan.kelas
        ) bedkosong ON bedtotal.kelas = bedkosong.kelas AND bedtotal.bangsal_id = bedkosong.bangsal_id
        LEFT JOIN
        (
            SELECT
                ruangan.bangsal_id,
                ruangan.kelas,
                COUNT(1) AS pasien_total
            FROM ruangan
            JOIN tempat_tidur
            JOIN bangsal
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND bangsal.deleted_at IS NULL
                AND tempat_tidur.transaksi_id IS NOT NULL
                AND ruangan.id = tempat_tidur.ruangan_id
                AND ruangan.bangsal_id = bangsal.id
            GROUP BY ruangan.bangsal_id, ruangan.kelas
        ) pasientotal ON bedtotal.kelas = pasientotal.kelas AND bedtotal.bangsal_id = pasientotal.bangsal_id
        LEFT JOIN
        (
            SELECT
                ruangan.bangsal_id,
                ruangan.kelas,
                COUNT(1) AS pasien_booking
            FROM ruangan
            JOIN tempat_tidur
            JOIN bangsal
            WHERE 
                kelas IS NOT NULL
                AND ruangan.deleted_at IS NULL
                AND tempat_tidur.deleted_at IS NULL
                AND bangsal.deleted_at IS NULL
                AND tempat_tidur.booking_id IS NOT NULL
                AND ruangan.id = tempat_tidur.ruangan_id
                AND ruangan.bangsal_id = bangsal.id
            GROUP BY ruangan.bangsal_id, ruangan.kelas
        ) pasienbooking ON bedtotal.kelas = pasienbooking.kelas AND bedtotal.bangsal_id = pasienbooking.bangsal_id
        ORDER BY bedtotal.bangsal_id, bedtotal.kelas;" ;
        $content = DB::connection('rawatinap')->select($query);

        $bangsal = Bangsal::all()->pluck('nama');
        $kelas = Kelas::all()->pluck('nama');
        foreach ($bangsal as $b) {
            foreach ($kelas as $k) {
                $tabel_hasil[$b][$k]['total'] = null;
                $tabel_hasil[$b][$k]['isi'] = null;
                $tabel_hasil[$b][$k]['kosong'] = null;
            }
        }

        foreach ($content as $key => $value) {
            $value = $this->getNamaKelasDanBangsal($value);
        }

        foreach ($content as $key => $value) {
            $tabel_hasil[$value->data_bangsal->nama][$value->data_kelas->nama]['total'] = $value->bed_total;
            $tabel_hasil[$value->data_bangsal->nama][$value->data_kelas->nama]['kosong'] = $value->bed_kosong;
            $tabel_hasil[$value->data_bangsal->nama][$value->data_kelas->nama]['isi'] = $value->pasien_total;
            $tabel_hasil[$value->data_bangsal->nama][$value->data_kelas->nama]['nama_bangsal'] = $value->data_bangsal->nama;
            $tabel_hasil[$value->data_bangsal->nama][$value->data_kelas->nama]['nama_kelas'] = $value->data_kelas->nama;
            $tabel_hasil[$value->data_bangsal->nama][$value->data_kelas->nama]['bangsal_id'] = $value->data_bangsal->id;
            $tabel_hasil[$value->data_bangsal->nama][$value->data_kelas->nama]['kelas_id'] = $value->data_kelas->id;
        }
        return $tabel_hasil;
    }

    private function getNamaKelasDanBangsal($item)
    {
        $item->data_kelas = Kelas::find($item->kelas);
        $item->data_bangsal = Bangsal::find($item->bangsal_id);
    }
}
