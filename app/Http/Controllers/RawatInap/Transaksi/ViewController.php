<?php

namespace App\Http\Controllers\RawatInap\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Transaksi;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\Kelas;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\TempatTidur;
use DOMPDF;
use DNS1D;
use DB;

class ViewController extends Controller
{
    public function pendaftaran()
    {
        $transaksi = Transaksi::with(['creator', 'kasus', 'pasien'])->where('status',0)->where('is_pindah',0)->orderBy('id', 'desc')->get();
        $data['transaksi'] = $transaksi;
        $data['routeFlag'] = 1;
        $data['link'] = "transaksi/pendaftaran/permintaan";
        return view('rawatinap.transaksi.pendaftaran',$data);
    }


    public function printBoardingPass($id) // print boarding pass
    {
        $transaksi = Transaksi::find($id);
        $created_at = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($transaksi->created_at,'%d %B %Y, %H:%M');
        $barcode = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($transaksi->pasien->no_rm, "C128",3,30) . '" alt="barcode"   />';
        $pdf = DOMPDF::loadView('rawatinap.transaksi.pendaftaran.boarding-pass', ['transaksi' => $transaksi,'created_at' => $created_at, 'barcode' => $barcode]);
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->stream('Print Boarding Pass.pdf');
    }

    public function pendaftaranPasien()
    {
        $data['routeFlag'] = 1;
        $data['link'] = "transaksi/pendaftaran/permintaan";
        return view('rawatinap.transaksi.pendaftaran.pasien',$data);
    }


    public function pendaftaranRuangan(Request $request)
    {
        $data['routeFlag'] = 1;
        $data['link'] = "transaksi/pendaftaran/permintaan";
        $data['transaksi'] = $request->get('transaksi_id');
        $transaksi = Transaksi::find($data['transaksi']);
        if(empty($transaksi->id)) abort(404);

        $pasien = Pasien::find($transaksi->pasien_id);
        $kasus = Kasus::with(['pembayaran','pembayaran.kelas'])->where('id',$transaksi->kasus_id)->first();
        $data['kasus'] = $kasus;
        $data['pasien'] = $pasien;


        if(!empty($request->get('nomor_kasus')))
        {
            $data['nomor_kasus'] = $request->get('nomor_kasus');
        }
        else
        {
            $data['nomor_kasus'] = null;
        }
        if($transaksi->is_pindah == 0 && $transaksi->is_bayar_changed == 0) 
        {
            $data['metode'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($transaksi->pasien_id);
            $data['kasus'] = Kasus::find($transaksi->kasus_id);
            return view('rawatinap.transaksi.pendaftaran.ganti-metode-bayar',$data);
        }
        // if($transaksi->is_intensif)
        //    $query = Bangsal::where('intensif',1);
        // else
        //    $query = Bangsal::whereNull('intensif')->orWhere('intensif',0);
        $query = "select * from bangsal b 
        left join (select r.bangsal_id, count(1) as bed_kosong from ruangan r, tempat_tidur t where t.ruangan_id = r.id and t.transaksi_id is null and t.booking_id is null and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r1
        on r1.bangsal_id = b.id
        left join (select r.bangsal_id, count(1) as bed_total from ruangan r, tempat_tidur t where t.ruangan_id = r.id and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r2
        on r2.bangsal_id = b.id
        left join (select r.bangsal_id, count(1) as pasien_total from ruangan r, tempat_tidur t where t.ruangan_id = r.id and t.transaksi_id is not null and r.deleted_at is null and t.deleted_at is null group by r.bangsal_id) r3
        on r3.bangsal_id = b.id where b.deleted_at is null;";
        $data['bangsal'] = DB::connection('rawatinap')->select($query);

        $data['kelas'] = Kelas::where('rawat_inap',1)->get();
        $data['is_intensif'] = $transaksi->is_intensif;
        $data['is_bayi'] = $transaksi->is_bayi;

        return view('rawatinap.transaksi.pendaftaran.ruangan',$data);

    }



    public function histori()
    {
        $data['bangsal'] = Bangsal::all();
        return view('rawatinap.histori.index',$data);
    }


    public function print(Request $request)
    {
        // dd('here');
        $transaksi_id = $request->get('transaksi_id');
        $transaksi = Transaksi::find($transaksi_id);
        $data['bed'] = TempatTidur::find($request->get('bed_id'));
        // dd($transaksi->tempat_tidur_id);
        $data['pasien'] = Pasien::find($transaksi->pasien_id);
        $data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%e %B %Y');
        $filename = 'Persetujuan Rawat Inap #'.$transaksi_id;
        $pdf = DOMPDF::loadView('rawatinap.transaksi.pendaftaran.print', $data, [])->setPaper('a4', 'potrait');
        return $pdf->stream($filename);
    }

    public function print2()
    {
        $pdf = DOMPDF::loadView('amik-titip.laporan-jumlah-hari-perawatan')->setPaper('a4', 'landscape');
        return $pdf->stream('AAA');   
    }

}
