<?php

namespace App\Http\Controllers\RawatInap\Pengaturan\Bangsal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Foto;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Tarif;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
    public function new(Request $request)
    {
        DB::connection('rawatinap')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('keuangan')->beginTransaction();
        try
        {
            $name = $request->name;
            $intensif = $request->intensif;
            $bayi = $request->bayi;
            $jenisTarif = $request->jenis_tarif;
            $deskripsi = $request->deskripsi;

            $bangsal = new Bangsal;
            $bangsal->nama = $name;
            $bangsal->intensif = $intensif;
            $bangsal->bayi = $bayi;
            $bangsal->deskripsi = $deskripsi;
            $bangsal->save();

            $name = 'Bangsal '.$bangsal->nama;
            $modul_url = 'rawatinap/bangsal/'.$bangsal->id;

            $slug = 'rawat-inap';
            $kategori_keuangan = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->createBySlugName($slug,$name);     

            $group = app('App\Http\Controllers\Group\CreateController')->create($name, $modul_url, 1);

            $bangsal->group_id = $group->id;
            $bangsal->kategori_keuangan_id = $kategori_keuangan->id;
            $bangsal->save();

            
            $status = 1;
            $message = 'Bangsal Berhasil di Buat.';
            $title = 'Berhasil!';


            DB::connection('mysql')->commit();
            DB::connection('rawatinap')->commit();
            DB::connection('keuangan')->commit();

            return redirect('rawatinap/pengaturan/bangsal/'.$bangsal->id)
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
           app('App\Http\Controllers\Error\Handler')->bugsnag($e);

           DB::connection('mysql')->rollback();
           DB::connection('rawatinap')->rollback();
           DB::connection('keuangan')->rollback();

            $status = -1;
            $message = 'Bangsal Gagal di Buat.';
            $title = 'Gagal!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function delete(Request $request)
    {
        DB::connection('mysql')->beginTransaction();
        DB::connection('keuangan')->beginTransaction();
        DB::connection('rawatinap')->beginTransaction();
        try
        {
            $bangsal_id = $request->bangsal_id;

            $bangsal = Bangsal::find($bangsal_id);

            foreach($bangsal->ruangan as $ruang)
            {
                $group = app('App\Http\Controllers\RawatInap\Pengaturan\Ruangan\PostController')->actDelete($ruang->id);
            }            
            
            app('App\Http\Controllers\Group\Settings\DeleteController')->delete($bangsal->group_id);

            app('App\Http\Controllers\Keuangan\Kategori\DeleteController')->delete($bangsal->kategori_keuangan_id);
            $bangsal->delete();
           

            $status = 1;
            $message = 'Bangsal Berhasil di Hapus.';
            $title = 'Berhasil!';

            DB::connection('mysql')->commit();
            DB::connection('keuangan')->commit();
            DB::connection('rawatinap')->commit();
            return redirect('rawatinap/pengaturan/bangsal')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('mysql')->rollback();
            DB::connection('keuangan')->rollback();
            DB::connection('rawatinap')->rollback();

            $status = -1;
            $message = 'Bangsal Gagal di Hapus.';
            $title = 'Gagal!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        
        }
    }

    public function edit(Request $request)
    {
        DB::connection('mysql')->beginTransaction();
        DB::connection('rawatinap')->beginTransaction();
        DB::connection('keuangan')->beginTransaction();
        try
        {
            $name = $request->name;
            $bangsal_id = $request->bangsal_id;
            $intensif = $request->intensif;
            $tarif_master_id = $request->tarif_master_id;
            $bayi = $request->bayi;
            $deskripsi = $request->deskripsi;
            $tipe = 1;

            $bangsal = Bangsal::find($bangsal_id);
            $bangsal->nama = $name;
            $bangsal->intensif = $intensif;
            $bangsal->tarif_master_id = $tarif_master_id;
            $bangsal->bayi = $bayi;
            $bangsal->deskripsi = $deskripsi;
            $bangsal->save();
            $group_status = app('App\Http\Controllers\Group\Settings\EditController')->editAPI($bangsal->group_id, $name, $deskripsi);
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                foreach ($foto as $item) {
                    $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($item,'rawatinap');
                    $foto = $image['file_original'];
                    $foto_thumb = $image['file_thumbnail'];

                    $insert_foto = app('App\Http\Controllers\RawatInap\Pengaturan\Foto\CreateController')->new($bangsal_id,$tipe,$foto,$foto_thumb);
                }
            
            }

            if ($request->is_hitung_statistik != null) {
                app('App\Http\Controllers\RawatInap\TempatTidur\EditController')->setHitungStatistikByBangsal($bangsal->id, $request->is_hitung_statistik);
            }

            app('App\Http\Controllers\Keuangan\Kategori\EditController')->editNama($bangsal->kategori_keuangan_id,$name);
            $this->editruangan($bangsal_id,$intensif,$bayi, $tarif_master_id);

            $status = 1;
            $message = 'Data Bangsal Berhasil di Ubah.';
            $title = 'Berhasil!';

        
            DB::connection('mysql')->commit();
            DB::connection('rawatinap')->commit();
            DB::connection('keuangan')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
           
           app('App\Http\Controllers\Error\Handler')->bugsnag($e);

           DB::connection('mysql')->rollback();
           DB::connection('rawatinap')->rollback();
           DB::connection('keuangan')->rollback();

           $status = -1;
           $message = 'Bangsal Gagal di Ubah.';
           $title = 'Gagal!';

           return back()
           ->with('message', $message)
           ->with('title',$title)
           ->with('status', $status);
        }

    }

    public function editruangan($id,$intensif,$bayi, $tarif_master_id)
    {
        $ruangan = Ruangan::where('bangsal_id',$id)->get();
       
        foreach ($ruangan as $item) 
        {
           $kelas = Kelas::find($item->kelas);
           $tarif_kelas = $kelas->id;
           $tarif = Tarif::where('tarif_master_id',$tarif_master_id)->where('kelas_id',$tarif_kelas)->first();

            $item->intensif = $intensif;
            $item->bayi = $bayi;
            if($tarif)
                $item->tarif_id = $tarif->id;
            $item->save();
            

            $lokasi_name = $item->bangsal->nama.' - '.$item->nama;
            $lokasi = app('App\Http\Controllers\Hospital\Lokasi\EditController')->editWithoutKeuangan($item->lokasi_id,$lokasi_name);
        }
    }
}
