<?php

namespace App\Http\Controllers\Kepegawaian\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Exports\Kepegawaian\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;

class ViewController extends Controller
{
    public function index()
    {
        $data_search = null;
        $htmlheader_title = 'Kepegawaian | Pegawai';
        $contentheader_title = 'Dashboard';
        $form_data['blood_type'] = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->pegawai()->select('blood_type')->distinct()->pluck('blood_type')->toArray();
        // $pegawai = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')
        //             ->pegawai()
        //             ->with([
        //                 'masterKualifikasi', 
        //                 'masterStatusPegawai', 
        //                 'masterJenisKendaraan', 
        //                 'masterStatusRumah', 
        //                 'masterJenisPegawai', 
        //                 'masterSubkualifikasi',
        //                 'MasterJabatan',
        //                 'masterPendidikan',
        //             ]);
        $form_data['jenis_pegawai'] = app('App\Http\Controllers\Kepegawaian\MasterJenisPegawai\ReadController')->getData()->all();
        $form_data['status_pegawai'] = app('App\Http\Controllers\Kepegawaian\MasterStatusPegawai\ReadController')->getData()->all();
        $form_data['kualifikasi'] = app("App\Http\Controllers\Kepegawaian\MasterKualifikasi\ReadController")->getData()->all();
        $form_data['agama'] = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->agama()->all();		
        $form_data['departemen'] = app("App\Http\Controllers\Kepegawaian\MasterDepartemen\ReadController")->getAllDepartemen();
        $form_data['jabatan'] = app('App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController')->getAllJabatan();		
        $form_data['pangkat'] = app("App\Http\Controllers\Kepegawaian\MasterPangkat\ReadController")->getAllMasterPangkat();
        $form_data['pendidikan'] = app("App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController")->getAllStrata();
        return view('kepegawaian.pegawai.index', compact(
            'htmlheader_title',
            'contentheader_title',
            'form_data',
            'data_search'
        ));
    }

    public function search(Request $request)
    {
        $items = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->getDataSearch($request);
        return response()->json($items);
    }

    public function initDataPegawai(Request $request)
    {
        try {
            $items = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->getData($request);
            echo json_encode($items);
        }catch (Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function download()
    {
        $file= public_path(). "/assets/contoh-format-file/Contoh_file.xlsx";   

        return response()->download($file);
    }

    public function export(Request $request)
    {
        $pegawai = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->export($request);
        return Excel::download(new PegawaiExport($pegawai), 'Daftar_Pegawai.xlsx');
    }
}
