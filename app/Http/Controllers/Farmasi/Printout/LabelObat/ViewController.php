<?php

namespace App\Http\Controllers\Farmasi\Printout\LabelObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\TransaksiObat;
use Carbon\Carbon;
use DOMPDF;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function labelObatDispensingAseptik(Request $request, $farmasi, $slug)
    {
        $farmasi = session('farmasi');
		$data['farmasi'] = $farmasi;
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
        $data['transaksi'] = $transaksi;

        $pdf = DOMPDF::loadView('farmasi.transaksi.printout-label-obat.dispensing-aseptik', $data)->setPaper([0, 0, 150, 212.4], 'landscape');
		return $pdf->stream('label-obat-dispensing-aseptik.pdf');
    }

    public function labelObatTpn(Request $request, $farmasi, $slug)
    {
        $farmasi = session('farmasi');
		$data['farmasi'] = $farmasi;
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
        $data['transaksi'] = $transaksi;

        $pdf = DOMPDF::loadView('farmasi.transaksi.printout-label-obat.tpn', $data)->setPaper([0, 0, 150, 212.4], 'landscape');
		return $pdf->stream('label-obat-tpn.pdf');
    }

    public function labelObatRawatJalan(Request $request, $farmasi, $slug)
    {
        $farmasi = session('farmasi');
		$data['farmasi'] = $farmasi;
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
        $data['transaksi'] = $transaksi;
        $type = 'rajal';
        $data['exp_dates'] = $this->getExpDate($transaksi, $transaksi->final_detail->resep_detail, $type);

        $pdf = DOMPDF::loadView('farmasi.transaksi.printout-label-obat.rawat-jalan', $data)->setPaper([0, 0, 150, 212.4], 'landscape');
		return $pdf->stream('label-obat-rawat-jalan.pdf');
    }

    public function labelObatUddOdddRawatInap(Request $request, $farmasi, $slug)
    {
        $items_rows_raw = $request->items_rows;

        $temp_arr = [];
        $temp_arr[] = $items_rows_raw;
        $items_rows_raw = $temp_arr; 

        $items_rows = explode("],[", $items_rows_raw[0]);

        $new_items = [];
        foreach ($items_rows as $key => $item) {
            $temp_item = trim($item, "[");
            $temp_item = trim($temp_item, "]");
            
            $temp_item = explode(",", $temp_item);
            $temp_item_copy = $temp_item;
            array_shift($temp_item_copy);

            $new_items[] = [$temp_item[0], $temp_item_copy];
        }

        $farmasi = session('farmasi');
		$data['farmasi'] = $farmasi;
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
        $data['transaksi'] = $transaksi;
        

        if ($request->label_type == 'udd') {
            $resep_detail = [];
            foreach ($new_items as $key_items => $items) {
                foreach ($items[1] as $key_item => $item_jam_aturan_pakai) {
                    foreach ($transaksi->final_detail->resep_detail as $i => $detail) {
                        if ($detail->id == $items[0]) {
                            $resep_detail[] = [$detail, $item_jam_aturan_pakai];          
                        }
                    }
                }
            }

            $data['resep_detail'] = $resep_detail;
            $type = 'udd';
            $data['exp_dates'] = $this->getExpDate($transaksi, $resep_detail, $type);

            $pdf = DOMPDF::loadView('farmasi.transaksi.printout-label-obat.udd-rawat-inap', $data)->setPaper([0, 0, 150, 212.4], 'landscape');
            return $pdf->stream('label-obat-udd-rawat-inap.pdf');

        } else if($request->label_type == 'oddd') {
            $jam_aturan_pakai = [];
            foreach ($new_items as $key => $items) {
                foreach ($items[1] as $key_item => $item_jam_aturan_pakai) {
                    $jam_aturan_pakai[] = $item_jam_aturan_pakai;
                }
            }
            $jam_aturan_pakai = array_unique($jam_aturan_pakai);

            $item_jam_aturan_1 = ['07.00'];
            $item_jam_aturan_2 = ['13.00'];
            $item_jam_aturan_3 = ['19.00'];
            $item_jam_aturan_4 = ['24.00'];
            $item_jam_aturan_5 = ['22.00'];
            $resep_detail = [];

            foreach ($new_items as $key_items => $items) {
                foreach ($items[1] as $key_item => $item_jam_aturan_pakai) {
                    foreach ($transaksi->final_detail->resep_detail as $i => $detail) {
                        if ($detail->id == $items[0]) {
                            if ($item_jam_aturan_pakai == '07.00') {
                                $item_jam_aturan_1[] = $detail;
                            } else if ($item_jam_aturan_pakai == '13.00') {
                                $item_jam_aturan_2[] = $detail;
                            } else if ($item_jam_aturan_pakai == '19.00') {
                                $item_jam_aturan_3[] = $detail;
                            } else if ($item_jam_aturan_pakai == '24.00') {
                                $item_jam_aturan_4[] = $detail;
                            } else if ($item_jam_aturan_pakai == '22.00') {
                                $item_jam_aturan_5[] = $detail;
                            }
                        }
                    }
                }
            }


            if (in_array($item_jam_aturan_1[0], $jam_aturan_pakai)) {
                $temp = $item_jam_aturan_1;
                array_shift($temp);
                $resep_detail[] = [$item_jam_aturan_1[0], $temp];
            }
            if (in_array($item_jam_aturan_2[0], $jam_aturan_pakai)) {
                $temp = $item_jam_aturan_2;
                array_shift($temp);
                $resep_detail[] = [$item_jam_aturan_2[0], $temp];
            }
            if (in_array($item_jam_aturan_3[0], $jam_aturan_pakai)) {
                $temp = $item_jam_aturan_3;
                array_shift($temp);
                $resep_detail[] = [$item_jam_aturan_3[0], $temp];
            }
            if (in_array($item_jam_aturan_4[0], $jam_aturan_pakai)) {
                $temp = $item_jam_aturan_4;
                array_shift($temp);
                $resep_detail[] = [$item_jam_aturan_4[0], $temp];
            }
            if (in_array($item_jam_aturan_5[0], $jam_aturan_pakai)) {
                $temp = $item_jam_aturan_5;
                array_shift($temp);
                $resep_detail[] = [$item_jam_aturan_5[0], $temp];
            }

            $data['resep_detail'] = $resep_detail;
            $data['exp_dates'] = $this->getExpDate($transaksi, ($resep_detail[0][1] ?? []));

            $pdf = DOMPDF::loadView('farmasi.transaksi.printout-label-obat.oddd-rawat-inap', $data)->setPaper([0, 0, 150, 212.4], 'landscape');
		    return $pdf->stream('label-obat-oddd-rawat-inap.pdf');
        }
    }

    private function getExpDate($transaksi = null, $resep_detail, $type = null)
    {
        /**
         * Jika obat non-racikan ambilkan dari ED pada master obat
         * Jika obat racikan ambilkan {tanggal diracik} + {setingan pada farmasi (90 hari)} ➝ data nya ambil dari pengaturan di farmasi (beyond use date), tanggal diracik ambilkan dari tanggal konfirmasi obat
         * 
         * Cara mengecek apakah resep detail itu termasuk racikan/bukan bisa cek kolom "tipe" di resep_detail, kalau 1 mk racikan, kalau 0 bukan racikan.
         * Untuk ambil ED obatnya dari log transaksi > items > kadaluarsa.
        */

        $exp_dates = [];
        if (count($resep_detail) <= 0) return $exp_dates;
        foreach ($resep_detail as $detail) {

            if ($type == 'udd') {
                $detail = $detail[0];
            }

            if ($detail->tipe == 0) { # non racikan
                if (!empty($detail->log[0]->detail_item->kadaluarsa)) {
                    $exp_date = date('d/m/y', strtotime($detail->log[0]->detail_item->kadaluarsa)); # ambil log pertama
                    $exp_dates[] = $exp_date;
                } else {
                    $exp_dates[] = '-';
                }

            } else if ($detail->tipe == 1) { # racikan

                if (!empty($transaksi->final_detail->konfirmasi_permintaan_at)) { # harus sudah di konfirmasi terlebih dahulu
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->final_detail->konfirmasi_permintaan_at);
                    $daysToAdd = 0;
                    if (!empty($detail->tipe_racikan->beyond_use_date)) {
                        $daysToAdd = $detail->tipe_racikan->beyond_use_date ?? 0;
                    }
                    $date = $date->addDays($daysToAdd);

                    $exp_date = date('d/m/y', strtotime($date));
                    $exp_dates[] = $exp_date;

                } else {
                    $exp_dates[] = '-';
                }

            } else {
                $exp_dates[] = '-';
            }
            
        }

        return $exp_dates;
    }


}
