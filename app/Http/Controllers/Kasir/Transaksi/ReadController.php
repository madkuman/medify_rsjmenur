<?php

namespace App\Http\Controllers\Kasir\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Kategori;
use Yajra\DataTables\DataTables;
use DB;
use Carbon\Carbon;

define('relasi_kasir', ['pasien', 'lokasi']);

class ReadController extends Controller
{
    public function getHistory(Request $request)
    {
        $tanggal_start = $request->start_date;
        $tanggal_end = $request->end_date;

        if(!empty($tanggal_start)) $tanggal_min = Carbon::createFromFormat('d M Y H', $tanggal_start.' 0')->toDateTimeString();
        else $tanggal_min = Carbon::minValue();

        if(!empty($tanggal_end)) $tanggal_max = Carbon::createFromFormat('d M Y H', $tanggal_end.' 24')->toDateTimeString();
        else $tanggal_max = Carbon::maxValue();

        $id = $request->id; // ONLY USED WHEN CASHIER ID IS NECESSARY
        $filter = $request->filter;
        if($filter == 'unpaid')
            $query = Piutang::with(relasi_kasir)->whereRaw('total_paid < total')->whereBetween('tanggal_transaksi',[$tanggal_min,$tanggal_max]);
        else if($filter == 'paid')
            $query = Piutang::with(relasi_kasir)->whereRaw('total_paid >= total')->whereBetween('tanggal_transaksi',[$tanggal_min,$tanggal_max]);

        return DataTables::of($query)
            ->addColumn('pasien', function($query){
                if(!empty($query->pasien)){
                    $content = '<div>'.$query->pasien->name.'&nbsp;<br>&nbsp;<span class="badge badge-pill badge-primary">No. RM : '.$query->pasien->no_rm.'</span></div>';
                    $return = '<td data-search="'.$query->pasien->name.' '.$query->pasien->no_rm.'">'.$content.'</td>';
                    return $return;
                }
                else{
                    return '<td data-search=""><div>(pasien missing)</div></td>';
                }
            })
            ->addColumn('lokasi', function ($query) {
                if(!empty($query->lokasi)){
                    $lokasi = str_limit($query->lokasi->nama);
                    return '<td data-search="'.$lokasi.'"><div>'.$lokasi.'</div></td>';
                }
                else{
                    return '<td data-search=""><div>-</div></td>';
                }
            })
            ->filterColumn('pasien', function ($query, $keyword) {
                $query->whereHas('pasien', function ($subquery) use ($keyword) {
                    $subquery->from(config('app.db_name') . '_patients.pasien')->where('name', 'LIKE', "%$keyword%")
                        ->orWhere('no_rm', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('lokasi', function ($query, $keyword) {
                $query->whereHas('lokasi', function ($subquery) use ($keyword) {
                    $subquery->from(config('app.db_name') . '.lokasi')->where('nama', 'LIKE', "%$keyword%");
                });
            })
            ->rawColumns(['lokasi', 'pasien'])
            ->make(true);
    }

    public function getPasienPembayaran(Request $request){
        $id = $request->id;
        $pembayaran = PasienPembayaran::with(['perusahaan','perusahaan.tipe','perusahaan.perusahaan_keuangan','kelas'])->where('pasien_id', $id)->get()->toArray();
        return json_encode($pembayaran);
    }
    public function getPasienPembayaranTunai(Request $request)
    {
        $id = $request->id;
        $pembayaran = PasienPembayaran::with(['perusahaan','perusahaan.tipe','perusahaan.perusahaan_keuangan','kelas'])
            ->where('pasien_id', $id)
            ->where('jenis_pembayaran',1)
            ->get()->toArray();
        return json_encode($pembayaran);   
    }
    public function getLokasi()
    {
        $lokasi = Lokasi::with('kategori_keuangan')->get()->toArray();
        return json_encode($lokasi);
    }

    public function getKategori()
    {
        $kategori = Kategori::all();
        return json_encode($kategori);
    }

    public function getLokasiKategoriId(Request $request)
    {
        $id = $request->lokasi_id;
        $lokasi = Lokasi::find($id);
        return json_encode($lokasi);
    }

    public function getTotalToday($filter,$kasir_id)
    {
        $min = Carbon::today()->startOfDay();
        $max = Carbon::today()->endOfDay();

        if($filter == 'paid') $piutang = Piutang::where('kasir_id',$kasir_id)->whereBetween('tanggal_transaksi',[$min,$max])->sum('total_paid');
        else if($filter == 'unpaid') $piutang = Piutang::where('kasir_id',$kasir_id)->whereBetween('tanggal_transaksi',[$min,$max])->whereRaw('total_paid < total')->sum('total');
        else if($filter == 'all') $piutang = Piutang::where('kasir_id',$kasir_id)->whereBetween('tanggal_transaksi',[$min,$max])->sum('total');

        return $piutang;
    }
}
