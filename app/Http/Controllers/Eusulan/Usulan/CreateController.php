<?php

namespace App\Http\Controllers\Eusulan\Usulan;

use App\Models\Eusulan\Dokumen;
use App\Models\Eusulan\LogUsulan;
use App\Models\Eusulan\Unit;
use App\Models\Eusulan\Usulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $usulan = new Usulan();
        $usulan->tahun = $request->tahun;
        $usulan->nama = $request->nama;
        $usulan->unit_id = $request->unit_id;
        $usulan->deskripsi = $request->deskripsi;
        $usulan->indikator = $request->indikator;
        $usulan->target = $request->target;
        $usulan->tanggal_usulan = Carbon::parse( $request->tanggal_usulan);
        $usulan->created_by = Auth::user()->id;
        $usulan->save();

        if(!empty($request->barang)){
            foreach ($request->barang as $index => $item) {
                $log_usulan = new LogUsulan();
                $log_usulan->usulan_id = $usulan->id;
                $log_usulan->akun_rekening_id = $request->akun_rekening[$index];
                $log_usulan->barang_id = $item;
                $log_usulan->jumlah = $request->jumlah[$index];
                $log_usulan->harga = $request->harga[$index];
                $log_usulan->satuan = $request->satuan[$index];
                $log_usulan->link = $request->link[$index];
                $log_usulan->link2 = $request->link2[$index];
                $log_usulan->link3 = $request->link3[$index];
                $log_usulan->justifikasi = $request->justifikasi[$index];
                $log_usulan->kegiatan = $request->kegiatan[$index];
                $log_usulan->spesifikasi = $request->spesifikasi[$index];
                $log_usulan->penting = isset($request->penting[$index]) ? 1 : 0;
                if($request->file('log_usulan_file')[$index] ?? false)
                {
                    $file = app('App\Http\Controllers\Functions\ImageUploader')->upload($request->file('log_usulan_file')[$index],'e-usulan');
                    $dokumen = $this->createDokumen($file);
                    $log_usulan->dokumen_id = $dokumen->id;
                }
                $log_usulan->created_by = Auth::user()->id;
                $log_usulan->save();
            }
        }
    }

    public function createDokumen($file)
    {
        $dokumen = new Dokumen();
        $dokumen->title = $file['name_original'];
        $dokumen->type = $file['ext'];
        $dokumen->path = $file['file_original'];
        $dokumen->save();
        return $dokumen;
    }
}
