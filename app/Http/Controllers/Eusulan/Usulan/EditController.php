<?php

namespace App\Http\Controllers\Eusulan\Usulan;

use App\Imports\DefaultImporter;
use App\Models\Eusulan\AkunBarang;
use App\Models\Eusulan\AkunRekening;
use App\Models\Eusulan\Barang;
use App\Models\Eusulan\Dokumen;
use App\Models\Eusulan\LogUsulan;
use App\Models\Eusulan\Usulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class EditController extends Controller
{
    public function edit($id,$request)
    {
        $usulan = Usulan::find($id);
        if($usulan) {
            $usulan->tahun = $request->tahun;
            $usulan->nama = $request->nama;
            $usulan->unit_id = $request->unit_id;
            $usulan->deskripsi = $request->deskripsi;
            $usulan->indikator = $request->indikator;
            $usulan->target = $request->target;
            $usulan->tanggal_usulan = Carbon::parse($request->tanggal_usulan);
            $usulan->updated_by = Auth::user()->id;
            $usulan->save();

            if(isset($request->log_usulan_file_exclude))
            {
                $exclude = array_filter($request->log_usulan_file_exclude);
                if(!empty($exclude)){
                    $log_usulan = LogUsulan::where('usulan_id',$usulan->id)->where('status',1)->whereIn('dokumen_id',$exclude)->get();
                    foreach ($log_usulan as $row)
                    {
                        $row->dokumen_id = null;
                        $row->save();
                    }
                }
            }

            if (!empty($request->log_id)) {
                $exclude = array_values(array_diff($usulan->detail->pluck('id')->toArray(),$request->log_id));
                $delete_exclude = LogUsulan::whereIn('id',$exclude)->where('status',1)->delete();
                foreach ($request->log_id as $index => $item) {
                    if($item !=0) {
                        $log_usulan = LogUsulan::find($item);
                    }else{
                        $log_usulan = new LogUsulan();
                    }
                    if($log_usulan) {
                        $log_usulan->usulan_id = $usulan->id;
                        $log_usulan->akun_rekening_id = $request->akun_rekening[$index];
                        $log_usulan->barang_id = $request->barang[$index];
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
                        $log_usulan->updated_by = Auth::user()->id;
                        if($request->file('log_usulan_file')[$index] ?? false)
                        {
                            $file = app('App\Http\Controllers\Functions\ImageUploader')->upload($request->file('log_usulan_file')[$index],'e-usulan');
                            $dokumen = $this->createDokumen($file);
                            $log_usulan->dokumen_id = $dokumen->id;
                        }
                        $log_usulan->save();
                    }
                }
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

    public function editLegalitasAtasan($id,$request)
    {
        $usulan = Usulan::find($id);
        if($usulan) {
            if(isset($request->usulan_file_exclude))
            {
                $exclude = array_filter($request->usulan_file_exclude);
                if(!empty($exclude)){
                    $dokumen_ids = array_values(array_diff(json_decode($usulan->dokumen_ids),$exclude));
                }
                else{
                    $dokumen_ids = json_decode($usulan->dokumen_ids);
                }
            }else{
                $dokumen_ids = json_decode($usulan->dokumen_ids) ?? [];
            }

            if ($request->hasFile('usulan_file')) {
                foreach ($request->file('usulan_file') as $item)
                {
                    $file = app('App\Http\Controllers\Functions\ImageUploader')->upload($item,'e-usulan');
                    $dokumen = $this->createDokumen($file);
                    $dokumen_ids[] = $dokumen->id;

                }
            }
            $usulan->dokumen_ids = json_encode($dokumen_ids);
            $usulan->user_atasan_id = Auth::user()->id;
            $usulan->save();
        }
    }

    public function toggleEdit($id)
    {
        $usulan = Usulan::find($id);
        if ($usulan->allow_edit == 1) {
            $usulan->allow_edit = 0;
        } else {
            $usulan->allow_edit = 1;
        }
        $usulan->save();

        return $usulan->allow_edit;
    }

    public function import($id,$request)
    {
        $this->validate($request, [
            'import' => 'required|mimes:csv,xls,xlsx'
        ]);
        $old_delete  = LogUsulan::where('usulan_id',$id)->where('status',0)->delete();
        $data = Excel::toArray(new DefaultImporter, $request->file('import'))[0];
        $log_usulan = [];
        foreach($data as $index => $item) {
            if ($index == 0) continue;
            $penting = $item[2] == 1 ? $item[2] : 0;
            $kegiatan = $item[3];
            $jumlah = $item[4];
            $satuan = $item[5];
            $harga = $item[6];
            $link = $item[7];
            $link2 = $item[8];
            $link3 = $item[9];
            $spesifikasi = $item[10];
            $justifikasi = $item[11];

            $akun_rekening = AkunRekening::where('nama',$item[0])->orWhere('kode',$item[0])->first();
            $barang = Barang::where('nama',$item[1])->orWhere('kode',$item[1])->first();
            $keterangan = [];
            $barang_nama = null;
            $akun_rekening_nama = null;
            $status = 1;

            if(is_null($akun_rekening)){
                $akun_rekening_id = null;
                $akun_rekening_nama = $item[0];
                $keterangan[] = 'Akun Rekening Tidak Ditemukan';
            }else{
                $akun_rekening_id = $akun_rekening->id;
            }

            if(is_null($barang)){
                $barang_id = null;
                $barang_nama = $item[1];
                $keterangan[] = 'Barang Tidak Ditemukan';
            }else{
                $barang_id = $barang->id;
            }

            if(!is_null($barang) && !is_null($akun_rekening)){
                $akun_barang = AkunBarang::where('barang_id',$barang->id)->where('akun_rekening_id',$akun_rekening->id)->first();
                if(is_null($akun_barang)){
                    $keterangan[] = 'Akun rekening dengan barang tidak sesuai';
                    $barang_id = null;
                    $akun_rekening_id = null;
                    $barang_nama = $item[1];
                    $akun_rekening_nama = $item[0];
                    $status = 0;
                }
            }else{
                $barang_id = null;
                $akun_rekening_id = null;
                $barang_nama = $item[1];
                $akun_rekening_nama = $item[0];
                $keterangan[] = 'Akun rekening dengan barang tidak sesuai';
                $status = 0;
            }

            $keterangan = implode(',',$keterangan);

            $new_log = array(
                'usulan_id' => $id,
                'akun_rekening_id' => $akun_rekening_id,
                'barang_id' => $barang_id,
                'penting' => $penting,
                'kegiatan' => $kegiatan,
                'jumlah' => $jumlah,
                'satuan' => $satuan,
                'harga' => $harga,
                'link' => $link,
                'link2' => $link2,
                'link3' => $link3,
                'spesifikasi' => $spesifikasi,
                'justifikasi' => $justifikasi,
                'updated_by' => Auth::user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'keterangan' => $keterangan,
                'barang_nama' => $barang_nama,
                'akun_rekening_nama' => $akun_rekening_nama,
                'status' => $status,
            );

            $log_usulan[]=$new_log;
        }

        foreach(array_chunk($log_usulan, 1000) as $chunked){
            $insert = LogUsulan::insert($chunked);
        }
    }
}
