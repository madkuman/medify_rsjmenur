<?php

namespace App\Http\Controllers\Pasien\PengaturanLoket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class ViewController extends Controller
{
    public function index()
    {
        return view('pasien.pengaturan-loket.index');
    }

    public function update($id)
    {
        $data_edit = app('App\Http\Controllers\Pasien\PengaturanLoket\ReadController')->getEdit($id);

        return response()->json($data_edit);
    }

    public function getLoket(Request $request)
    {
        $data = app('App\Http\Controllers\Pasien\PengaturanLoket\ReadController')->getLoket();

        return DataTables::of($data)
    					->addColumn('nama_loket', function ($data) {
                            return ($data->nama_loket ?? '-');
						})
						->addColumn('jenis_pasien', function ($data) {
                            if ($data->jenis_pasien == null) {
                                return '-';
                            }else {
                                if ($data->jenis_pasien == 1) {
                                    return 'Pasien Lama';
                                }
                                if ($data->jenis_pasien == 2) {
                                    return 'Pasien Baru';
                                }
                                if ($data->jenis_pasien == 3) {
                                    return 'Pasien Tunai';
                                }
                                if ($data->jenis_pasien == 4) {
                                    return 'Pasien TNI/Pasien Keluarga';
                                }
                                if ($data->jenis_pasien == 5) {
                                    return 'Pamen/Pati TNI';
                                }
                                if ($data->jenis_pasien == 6) {
                                    return 'Pasien TNI';
                                }
                            }
						})
                        ->addColumn('aksi', function ($data) {
                            $button = '<a href="#modal_edit" data-toggle="modal" id="btn_edit" data-url="'.url("pasien/pengaturan-loket/update").'/'.$data->id.'" class="btn btn-md btn-primary">Edit</a>
                            <a href="#deletemodal" data-toggle="modal" id="btn_delete" data-url="'.url("pasien/pengaturan-loket/hapus").'/'.$data->id.'" data-nama="'.$data->nama_loket.'" class="btn btn-md btn-danger">Delete</a>            
                            ';
                            // $button += `<a href="'.url("pasien/daftar-online/update").'/'.$data->id.'" class="btn btn-md btn-danger">Delete</a>`;
                            return $button;
                        })
                        
					    ->escapeColumns([])
                        ->make(true);
    }

    public function cekAntrian(Request $request)
    {
        $data = app('App\Http\Controllers\Pasien\PengaturanLoket\ReadController')->cekAntrian($request);
        return response()->json($data);
    }

    public function cekKunjunganPoli(Request $request)
    {
        $poliklinik_id = $request->poliklinik_id;
        $pasien_id = $request->pasien_id;
        $check_kronis = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->checkKunjunganKronis($poliklinik_id, $pasien_id);
        return response()->json($check_kronis);
    }
}
