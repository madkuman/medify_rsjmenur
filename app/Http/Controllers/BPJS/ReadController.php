<?php

namespace App\Http\Controllers\BPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Kasus\BPJSSEPKasus;
use DB;
use DataTables;
use Datetime;

class ReadController extends Controller
{
    public function getAll(Request $req)
    {
        try {
            $tables = BPJSSEP::whereNull('checked_at')->with(['kasus', 'pasien_pembayaran.pasien', 'kasus.pasien', 'kasus.lokasi.lokasi.departemen'])->orderBy('id','desc');
            return Datatables::of($tables)
                    ->addColumn('nama_pasien', function($row){
                        if(!empty($row->pasien_pembayaran))
                            return $row->pasien_pembayaran->pasien->name;
                        else
                            return 'Pasien tidak ditemukan';
                    })
                    ->addColumn('jenis', function($row){
                        if(!empty($row->kasus[0])){
                            $res = '';
                            $begin = true;
                            $lokasi = $row->kasus->unique('lokasi.lokasi.lokasi_departemen_id')->reduce(function($carry, $item){
                                if(!is_null($carry))    $carry .= ', ';
                                return $carry .= $item->lokasi->lokasi->departemen->nama;
                            });
                            return $lokasi;
                        }
                        else
                            return 'SEP Tidak digunakan';
                    })
                    ->editColumn('created_at', function($row){
                        return date('d F Y', strtotime($row['created_at']));
                    })
                    ->editColumn('total_plafon', function($row){
                        return number_format($row['total_plafon']);
                    })
                    ->addColumn('edit', function($row){
                        if(!empty($row->kasus[0]))
                        {
                            return '<button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showEdit(this)" data-bpjs="'.$row['no_bpjs'].'" data-sep="'.$row['no_sep'].'"
                                data-nomor="'.$row->kasus[0]['nomor_kasus'].'" data-plafon="'.$row['total_plafon'].'" data-id="'.$row['id'].'">Edit</button>';
                        }
                        else
                            return '<button type="button" class="btn btn-warning" disabled>SEP Tidak digunakan</button>';
                    })
                    ->addColumn('detail', function($row){
                        return '<button class="btn btn-info" onclick="showKasusModal('.$row->id.');">Detail</button>';
                    })
                     ->addIndexColumn()->escapeColumns([])
                 ->make(true);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    public function getKasus(Request $req)
    {
        $kasus = BPJSSEP::with(['kasus', 'kasus.pasien'])->find($req['id']);

        return json_encode($kasus->kasus);
    }

}