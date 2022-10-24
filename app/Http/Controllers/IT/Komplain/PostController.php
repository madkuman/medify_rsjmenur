<?php

namespace App\Http\Controllers\IT\Komplain;

use DB;
use Bugsnag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PostController extends Controller
{
	public function create(Request $request)
	{
        $tgl_komplain = $request->tgl_komplain ?? Carbon::now()->format('d-m-Y');
        $jam_komplain = $request->jam_komplain ?? Carbon::now()->format('H');
        $menit_komplain = $request->menit_komplain ?? Carbon::now()->format('i');
        $format_komplain = $tgl_komplain.' '.$jam_komplain.':'.$menit_komplain;
        $data['waktu_komplain'] = Carbon::createFromFormat('d-m-Y H:i',$format_komplain);
        $data['lokasi'] = $request->lokasi;
        $data['pesan'] = $request->pesan;
        $data['image'] = $request->file('image');;

		DB::connection('it')->beginTransaction();
        try
        {
            app('App\Http\Controllers\IT\Komplain\CreateController')->store($data);

            $status = 1;
            $message = 'Input Berhasil';
            $title = 'Berhasil!';

            DB::connection('it')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('it')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }
        
        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
    
    public function respon(Request $request, $id)
    {
        $tgl_respon = $request->tgl_respon ?? Carbon::now()->format('d-m-Y');
        $jam_respon = $request->jam_respon ?? Carbon::now()->format('H');
        $menit_respon = $request->menit_respon ?? Carbon::now()->format('i');

        $format_respon = $tgl_respon.' '.$jam_respon.':'.$menit_respon;


        $data['waktu_respon'] = Carbon::createFromFormat('d-m-Y H:i',$format_respon);
        $data['jenis_komplain_id'] = $request->jenis_komplain_id;
        $data['catatan']           = $request->catatan;
        $data['respon']            = $request->respon;
        $data['teknisi']           = $request->teknisi;

        DB::connection('it')->beginTransaction();
        try
        {
            app('App\Http\Controllers\IT\Komplain\UpdateController')->update($data, $id);

            $status = 1;
            $message = 'Update Berhasil';
            $title = 'Berhasil!';

            DB::connection('it')->commit();
             return redirect('it')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('it')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
             return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
       
    }

	public function edit(Request $request, $id)
	{
        $tgl_komplain = date('Y-m-d', strtotime($request->tgl_komplain));
        $jam_komplain = $request->jam_komplain.":".$request->menit_komplain;
        $jam_respon = $request->jam_respon.":".$request->menit_respon;

        $request->merge([
                        'tgl_komplain' => $tgl_komplain,
                        'jam_komplain' => $jam_komplain,
                        'jam_respon' => $jam_respon
                        ]);
        
		DB::connection('it')->beginTransaction();
        try
        {
            app('App\Http\Controllers\IT\Komplain\UpdateController')->update($request->all(), $id);

            $status = 1;
            $message = 'Update Berhasil';
            $title = 'Berhasil!';

            DB::connection('it')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('it')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
	}

	public function delete(Request $request)
	{
        $id = $request->id;
		DB::connection('it')->beginTransaction();
        try
        {
            app('App\Http\Controllers\IT\Komplain\DeleteController')->delete($id);

            $status = 1;
            $message = 'Delete Berhasil';
            $title = 'Berhasil!';

            DB::connection('it')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('it')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
	}
}
