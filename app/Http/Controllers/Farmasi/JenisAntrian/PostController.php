<?php

namespace App\Http\Controllers\Farmasi\JenisAntrian;

use App\Models\Farmasi\JenisAntrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function save(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        try {
            $farm = session('farmasi');
            $id = $request->id;

            if($request->hasFile('sound')){

                $file = $request->file('sound');
                $file_name = explode(' ',($file->getClientOriginalName()));
                $file_name = implode('-', $file_name);
                $path = JenisAntrian::$path_sound;

                if (!file_exists($path) && !is_dir($path)) {
                    mkdir($path, 0777, true);
                }

                $path_with_name = $path . '/' . $file_name;
                $full_path = public_path() . '/'.$path;
                $file->move($full_path, $file_name);

                $request->merge([
                    'sound_path' => $path_with_name
                ]);
            }

            if ($id != 0) {
                app('App\Http\Controllers\Farmasi\JenisAntrian\EditController')->edit($request);

                $message = "Berhasil mengubah jenis antrian";
            } else {
                app('App\Http\Controllers\Farmasi\JenisAntrian\CreateController')->create($request);

                $message = "Berhasil menambah jenis antrian baru";
            }

            DB::connection('farmasi')->commit();

            $status = 1;            
            $title = 'Berhasil!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/jenis-antrian')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);

        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menyimpan jenis antrian";
            $title = 'Gagal!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/jenis-antrian')
            ->with('status', -1)
            ->with('message', $message)
            ->with('title', $title);            
        }
    }

    public function delete(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        try {
            $farm = session('farmasi');
            
            app('App\Http\Controllers\Farmasi\JenisAntrian\DeleteController')->delete($request);

            DB::connection('farmasi')->commit();

            $status = 1;            
            $message = "Berhasil menghapus jenis antrian";
            $title = 'Berhasil!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/jenis-antrian')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);

        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menghapus jenis antrian";
            $title = 'Gagal!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/jenis-antrian')
            ->with('status', -1)
            ->with('message', $message)
            ->with('title', $title);
        }
    }
}
