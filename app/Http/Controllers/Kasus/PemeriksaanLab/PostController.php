<?php

namespace App\Http\Controllers\Kasus\PemeriksaanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kasus\Kasus;
class PostController extends Controller
{
    public function create(Request $request, $nomorKasus)
    {
        //dd($request,$nomorKasus);
        $kasus = Kasus::where('nomor_kasus',$nomorKasus)->first();
        $data = $request->all();
        $data['kasus_id'] = $kasus->id;
        //dd($data);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            if(!empty($data['darah_id']))
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\EditController')->edit($data);
            }
            else
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\CreateController')->create($data);   
            }

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Hasil Cek Darah Lengkap Berhasil Dicatat!';
            $title = 'Berhasil!';

            return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }
        catch (\Exception $e) 
        {           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();            
        }
    }

    public function createUrine(Request $request, $nomorKasus)
    {
        //dd($request,$nomorKasus);
        $kasus = Kasus::where('nomor_kasus',$nomorKasus)->first();
        $data = $request->all();
        $data['kasus_id'] = $kasus->id;
        //dd($data);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            if(!empty($data['urine_id']))
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\EditController')->editUrine($data);
            }
            else
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\CreateController')->createUrine($data);  
            }

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Hasil Cek Urine Berhasil Dicatat!';
            $title = 'Berhasil!';

            return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#urine')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }
        catch (\Exception $e) 
        {           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();            
        }
    }

    public function createImun(Request $request, $nomorKasus)
    {
        //dd($request,$nomorKasus);
        $kasus = Kasus::where('nomor_kasus',$nomorKasus)->first();
        $data = $request->all();
        $data['kasus_id'] = $kasus->id;
        //dd($data);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            if(!empty($data['imun_id']))
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\EditController')->editImun($data);
            }
            else
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\CreateController')->createImun($data);   
            }

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Hasil Cek Immunologi Berhasil Dicatat!';
            $title = 'Berhasil!';

            return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#imun')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }
        catch (\Exception $e) 
        {           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();            
        }
    }

    public function createSmear(Request $request, $nomorKasus)
    {
        //dd($request,$nomorKasus);
        $kasus = Kasus::where('nomor_kasus',$nomorKasus)->first();
        $data = $request->all();
        $data['kasus_id'] = $kasus->id;
        //dd($data);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            if(!empty($data['smear_id']))
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\EditController')->editSmear($data);
            }
            else
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\CreateController')->createSmear($data);   
            }

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Hasil Cek PAP SMEAR Berhasil Dicatat!';
            $title = 'Berhasil!';

            return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#smear')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }
        catch (\Exception $e) 
        {           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();            
        }
    }

    public function createFeces(Request $request, $nomorKasus)
    {
        //dd($request,$nomorKasus);
        $kasus = Kasus::where('nomor_kasus',$nomorKasus)->first();
        $data = $request->all();
        $data['kasus_id'] = $kasus->id;
        //dd($data);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            if(!empty($data['feces_id']))
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\EditController')->editFeces($data);
            }
            else
            {
                $result = app('App\Http\Controllers\Kasus\PemeriksaanLab\CreateController')->createFeces($data);   
            }

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

            $status = 1;
            $message = 'Hasil Cek Feces Berhasil Dicatat!';
            $title = 'Berhasil!';

            return redirect('/kasus/'.$nomorKasus.'/pemeriksaanlab#feces')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }
        catch (\Exception $e) 
        {           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();            
        }
    }

}
