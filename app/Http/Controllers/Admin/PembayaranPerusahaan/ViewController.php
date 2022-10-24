<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Keuangan\Perusahaan;
use App\Models\Hospital\MasterSIRSCaraBayar;

class ViewController extends Controller
{
    public function index()
    {
        return view('admin.pembayaran-perusahaan.index');
    }

    public function getData(Request $request)
    {
        $draw = $request->input('draw');
        $keyword = $request->input('search.value');
        $length = $request->input('length');
        $start = $request->input('start');

        $filtered = PembayaranPerusahaan::whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"')
                        ->orWhereHas("tipe", function ($q) use ($keyword) {
                            $q->whereRaw('LOWER(nama) LIKE "%' . $keyword . '%"');
                        });

        $recordsTotal = PembayaranPerusahaan::count();
        $recordsFiltered = $filtered->count();
        $records = $filtered->take($length)->skip($start)->get();
        $data = [];

        foreach ($records as $record) {
            array_push($data, [
                'id' => $record->id,
                'nama' => $record->nama,
                'tipe' => isset($record->tipe) ? $record->tipe->nama : null,
            ]);
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        $tipe_list = PembayaranPerusahaanType::all();
        $perusahaan_keuangan = Perusahaan::all();
        $cara_bayar = MasterSIRSCaraBayar::get();

        return view('admin.pembayaran-perusahaan.create', [
            'tipe_list' => $tipe_list,
            'perusahaan_keuangan' => $perusahaan_keuangan,
            'cara_bayar' => $cara_bayar,
        ]);
    }

    public function edit($id)
    {
        $data = PembayaranPerusahaan::find($id);
        $tipe_list = PembayaranPerusahaanType::all();
        $perusahaan_keuangan = Perusahaan::all();
        $cara_bayar = MasterSIRSCaraBayar::get();

        return view('admin.pembayaran-perusahaan.create', [
            'data' => $data,
            'tipe_list' => $tipe_list,
            'perusahaan_keuangan' => $perusahaan_keuangan,
            'cara_bayar' => $cara_bayar,
        ]);
    }
}
