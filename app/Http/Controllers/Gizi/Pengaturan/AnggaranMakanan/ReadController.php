<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakanan;

use App\Models\Gizi\AnggaranMakanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class ReadController extends Controller
{
    public function getDataTable()
    {
        $data = AnggaranMakanan::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jenis_makanan',function ($data){
                $return = '';
                $jenis_makanan = json_decode($data->jenis_makanan_nama);
                foreach ($jenis_makanan as $value)
                {
                    $return .= '<span class="badge badge-success ml-5">'.$value.'</span>';
                }
                return $return;
            })
            ->addColumn('kelas',function ($data){
                $return = '';
                $kelas = json_decode($data->kelas_nama);
                foreach ($kelas as $value)
                {
                    $return .= '<span class="badge badge-success ml-5">'.$value.'</span>';
                }
                return $return;
            })
            ->addColumn('bangsal',function ($data){
                $return = '';
                $bangsal = json_decode($data->bangsal_nama);
                foreach ($bangsal as $value)
                {
                    $return .= '<span class="badge badge-success ml-5">'.$value.'</span>';
                }
                return $return;
            })
            ->addColumn('aksi', function ($data) {
                return '<a href="'.url('/gizi/pengaturan/anggaran-makanan/'.$data->id).'" class="btn btn-info">Lihat</a>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function single($id)
    {
        $anggaran_makanan = AnggaranMakanan::where('id',$id)->first();
        return $anggaran_makanan;
    }

    public function getAll()
    {
        $angggaran_makanan = AnggaranMakanan::all();
        return $angggaran_makanan;
    }
}
