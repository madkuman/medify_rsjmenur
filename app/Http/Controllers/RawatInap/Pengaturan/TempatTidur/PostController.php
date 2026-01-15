<?php

namespace App\Http\Controllers\RawatInap\Pengaturan\TempatTidur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\Bangsal;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function new(Request $request)
	{
        DB::connection('rawatinap')->beginTransaction();
        try
        {
    		$name = $request->name;
    		$ruangan_id = $request->ruangan_id;

    		$bed = new TempatTidur;
    		$bed->nama = $name;
    		$bed->ruangan_id = $ruangan_id;
    		$bed->save();

    		$status = 1;
    		$message = 'Tempat Tidur Berhasil di Tambahkan.';
    		$title = 'Berhasil!';

            $ruangan = Ruangan::find($bed->ruangan_id);
            $tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
            $kapasitas = $ruangan->count_bed;

            if(!empty($ruangan->kelas_applicare && config("app.bpjs_enable"))){
                $data['kelas_applicare'] = $ruangan->kelas_applicare;
                $data['kode_ruang'] = $ruangan->kode_ruang;
                $data['nama_ruang'] = $ruangan->bangsal->nama.' - '.$ruangan->nama;
                $data['tersedia'] = $tersedia;
                $data['kapasitas'] = $kapasitas;
                if (config('app.sirs_enable')) {
                    $res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\EditController')->editRuangan($data);
                    if(($res_applicare->metadata->code ?? '0') != 1){
    
                        DB::connection('mysql')->rollBack();
                        DB::connection('rawatinap')->rollBack();
                        $status = -1;
                        $message = $res_applicare->metadata->message;
                        $title = 'Gagal Membuat Tempat Tidur';
                        return back()
                        ->with('message', $message)
                        ->with('title',$title)
                        ->with('status', $status);
                    }
                }
            }

    		
            DB::connection('rawatinap')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatinap')->rollback();
            
        }

	}

	public function delete(Request $request)
	{
        DB::connection('rawatinap')->beginTransaction();
        try
        {
    		$bed_id = $request->bed_id;

            $bed = TempatTidur::find($bed_id);
            $ruangan = Ruangan::find($bed->ruangan_id);

            $bed->delete();
            
            $tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
            $kapasitas = $ruangan->count_bed;

            if(!empty($ruangan->kelas_applicare && config("app.bpjs_enable"))){
                $data['kelas_applicare'] = $ruangan->kelas_applicare;
                $data['kode_ruang'] = $ruangan->kode_ruang;
                $data['nama_ruang'] = $ruangan->bangsal->nama.' - '.$ruangan->nama;
                $data['tersedia'] = $tersedia;
                $data['kapasitas'] = $kapasitas;
                $res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\EditController')->editRuangan($data);
                if(($res_applicare->metadata->code ?? 0) != 1){

                    DB::connection('mysql')->rollBack();
                    DB::connection('rawatinap')->rollBack();
                    $status = -1;
                    $message = $res_applicare->metadata->message ?? 'Gagal Edit Ruangan Aplicare';
                    $title = 'Gagal Membuat Bangsal';
                    return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
                }
            }

    		$status = 1;
    		$message = 'Tempat Tidur Berhasil di Hapus.';
    		$title = 'Berhasil!';


    		
            DB::connection('rawatinap')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatinap')->rollback();
            
        }
	}

    public function actDelete($bed_id)
    {
            $bed = TempatTidur::find($bed_id);
            $bed->delete();
    }

	public function edit(Request $request)
	{
        DB::connection('rawatinap')->beginTransaction();
        try
        {
    		$name = $request->name;
    		$bed_id = $request->bed_id;
    		$bed = TempatTidur::find($bed_id);
    		$bed->nama = $name;
    		$bed->save();

            if ($request->is_hitung_statistik != null) {
                app('App\Http\Controllers\RawatInap\TempatTidur\EditController')->setHitungStatistik($bed->id, $request->is_hitung_statistik);
            }

    		$status = 1;
    		$message = 'Tempat Tidur Berhasil di Ubah.';
    		$title = 'Berhasil!';

    		
            DB::connection('rawatinap')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatinap')->rollback();
            
        }
	}
}
