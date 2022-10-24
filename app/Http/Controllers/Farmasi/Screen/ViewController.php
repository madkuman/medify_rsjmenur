<?php

namespace App\Http\Controllers\Farmasi\Screen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ViewController extends Controller
{
    public function index(Request $request, $farmasi)
    {
        try {
            $farm = session('farmasi');
            $data['farmasi'] = $farm;
            $data['screens'] = app('App\Http\Controllers\Farmasi\Screen\ReadController')->getAll();
            $data['jenis_antrians'] = app('App\Http\Controllers\Farmasi\JenisAntrian\ReadController')->getAll();
            $data['jenis_reseps'] = app('App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep\ReadController')->getAll();
            $data['sidebar_active'] = "";

            return view('farmasi.screen.index', $data);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function single(Request $request, $farmasi, $master_screen_slug)
    {
        try {
            $farm = session('farmasi');
            $screen = (new \App\Http\Controllers\Farmasi\Screen\ReadController())->getBySlug($master_screen_slug);
            $data['farmasi'] = $farm;
            $data['screen'] = $screen;

            return view('farmasi.screen.screen',$data);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function settings(Request $request, $farmasi)
    {
        try {
            $farm = session('farmasi');
            $data['farmasi'] = $farm;
            $data['sidebar_active'] = "";

            return view('farmasi.screen.pengaturan.index', $data);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function checkIn()
    {
        return view('farmasi.screen.check-in');
    }

    public function loadDataTable($farm_id, $screen_id)
    {
        try {
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getDataScreen($farm_id, $screen_id);

            return DataTables::of($data)
                ->addColumn('no_antrian', function($data){
                    $no_antrian = $data->nomor_antrian;

                    return $no_antrian;
                })
                ->addColumn('no_rm', function($data){
                    $no_rm = $data->pasien_detail ? $data->pasien_detail->no_rm : '-';

                    return $no_rm;
                })
                ->addColumn('estimasi', function($data){
                    $waktu_estimasi_selesai = date('d-m-Y H:i:s', strtotime($data->waktu_estimasi_selesai));

                    return $waktu_estimasi_selesai;
                })
                ->addColumn('status', function($data){
                    if ($data->status == 0 && $data->status_ditelaah == 1) {
                        $content = '<div class="ribbon ribbon-bookmark ribbon-warning"><div class="ribbon-box">Telaah Resep</div></div>';
                    }
                    else if (!empty($data->dikerjakan_at)) {
                        $content = '<div class="ribbon ribbon-bookmark ribbon-primary"><div class="ribbon-box">Dikerjakan</div></div>';
                    }
                    // else if ($data->status == 1) {
                    //     $content = '<div class="ribbon ribbon-bookmark ribbon-success"><div class="ribbon-box">Siap Penyerahan</div></div>';
                    // }
                    else {
                        $content = '<div class="ribbon ribbon-bookmark ribbon-info"><div class="ribbon-box">Check In</div></div>';
                    }

                    return $content;
                })
                ->escapeColumns([])
                ->make(true);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
