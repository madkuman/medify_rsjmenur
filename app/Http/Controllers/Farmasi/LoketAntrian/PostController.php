<?php

namespace App\Http\Controllers\Farmasi\LoketAntrian;

use App\Models\Farmasi\LoketAntrian;
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
                $path = LoketAntrian::$path_sound;

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
                app('App\Http\Controllers\Farmasi\LoketAntrian\EditController')->edit($request);

                $message = "Berhasil mengubah loket antrian";
            } else {
                app('App\Http\Controllers\Farmasi\LoketAntrian\CreateController')->create($request);

                $message = "Berhasil menambah loket antrian baru";
            }

            DB::connection('farmasi')->commit();

            $status = 1;            
            $title = 'Berhasil!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/loket-antrian')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);

        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menyimpan loket antrian";
            $title = 'Gagal!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/loket-antrian')
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
            
            app('App\Http\Controllers\Farmasi\LoketAntrian\DeleteController')->delete($request);

            DB::connection('farmasi')->commit();

            $status = 1;            
            $message = "Berhasil menghapus loket antrian";
            $title = 'Berhasil!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/loket-antrian')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);

        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menghapus loket antrian";
            $title = 'Gagal!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/loket-antrian')
            ->with('status', -1)
            ->with('message', $message)
            ->with('title', $title);
        }
    }
}
