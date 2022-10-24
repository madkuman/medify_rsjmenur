<?php

namespace App\Http\Controllers\Kasus\Log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Log;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Kolaborator;
use App\User;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    	public function create($kasus_id,$type,$tab,$data_id)
    	{
            DB::connection('kasus')->beginTransaction();
            DB::connection('mysql')->beginTransaction();
            try
            {
        		if(Auth::check())
        		{
        			$created_by = Auth::user()->id;
        		}
        		else $created_by = 0;

        		$log = new Log;
        		$log->kasus_id = $kasus_id;
        		$log->type = $type;
        		$log->tab = $tab;
        		$log->data_id = $data_id;
        		$log->created_by = $created_by;
        		$log->save();

                if($type == 'create') $type_string = 'menambahkan';
                elseif($type == 'edit') $type_string = 'mengubah';
                elseif($type == 'delete') $type_string = 'menghapus';
                elseif($type == 'close') $type_string = 'menutup';
                else $type_string = '';



                if($tab == 'cppt') {
                    $tab_string = 'CPPT';
                    $tab_url ='datamedis#cppt';
                }
                
                elseif($tab == 'diagnosis') {
                    $tab_string = 'Diagnosis';
                    $tab_url ='datamedis#diagnosis';
                }

                elseif($tab == 'tindakan') {
                    $tab_string = 'Tindakan';
                    $tab_url ='datamedis#tindakan';
                }

                elseif($tab == 'identitas') {
                    $tab_string = 'Identitas';
                    $tab_url ='datamedis#identitas';
                }
                
                elseif($tab == 'lokasi') {
                    $tab_string = 'Lokasi';
                    $tab_url ='datamedis#lokasi';
                }

                elseif($tab == 'resep') {
                    $tab_string = 'Resep';
                    $tab_url ='datamedis#resep';
                }

                elseif($tab == 'gizi') {
                    $tab_string = 'Gizi';
                    $tab_url ='datamedis#gizi';
                }

                elseif($tab == 'penunjang-radiologi') {
                    $tab_string = 'Hasil Radiologi';
                    $tab_url ='penunjang#galeri';
                }

                elseif($tab == 'penunjang-labpk') {
                    $tab_string = 'Hasil Lab';
                    $tab_url ='penunjang#galeri';
                }

                elseif($tab == 'permintaan-operasi') {
                    $tab_url='operasi';
                    $tab_string = 'Permintaan Operasi';
                }

                elseif($tab == 'tagihan') {
                    $tab_url='tagihan';
                    $tab_string = 'Tagihan';
                }

                elseif($tab == 'alat-mews') {
                    $tab_url='alat-bantu/mews';
                    $tab_string = 'Alat Mews';
                }

                elseif($tab == 'alat-poedji') {
                    $tab_url='alat-bantu/poedji';
                    $tab_string = 'Alat Poedji';
                }

                elseif($tab == 'alat-Pengkajian IGD') {
                    $tab_url='alat-bantu/pengkajian-igd';
                    $tab_string = 'Asesmen Pengkajian IGD';
                }

                elseif($tab == 'alat-Resume Pulang') {
                    $tab_url='alat-bantu/resume-pulang';
                    $tab_string = 'Asesmen Resume Pulang';
                }

                elseif($tab == 'alat-Fungsional') {
                    $tab_url='alat-bantu/fungsional';
                    $tab_string = 'Asesmen Pengkajian Umum Fungsional';
                }

                elseif($tab == 'alat-Pengkajian Awal Ranap Medikal Bedah') {
                    $tab_url='alat-bantu/pengkajian-ranap-medikal';
                    $tab_string = 'Asesmen Pengkajian Awal Ranap - Medikal Bedah';
                }

                elseif($tab == 'alat-Monitoring Ventilator') {
                    $tab_url='alat-bantu/monitoring-ventilator';
                    $tab_string = 'Asesmen Monitoring Ventilator';
                }

                elseif($tab == 'alat-Surveilans Infeksi Luka Pre Ops') {
                    $tab_url='alat-bantu/surveilans';
                    $tab_string = 'Asesmen Surveilans Infeksi Luka Pre Ops';
                }

                elseif($tab == 'alat-Surveilans Infeksi Luka Post Ops') {
                    $tab_url='alat-bantu/surveilans';
                    $tab_string = 'Asesmen Surveilans Infeksi Luka Post Ops';
                }

                elseif($tab == 'alat-Kemoterapi') {
                    $tab_url='alat-bantu/kemoterapi';
                    $tab_string = 'Asesmen Kemoterapi';
                }

                elseif($tab == 'alat-Pengkajian Kemoterapi') {
                    $tab_url='alat-bantu/pengkajian-kemoterapi';
                    $tab_string = 'Asesmen Pengkajian Kemoterapi';
                }

                elseif($tab == 'alat-Observasi') {
                    $tab_url='alat-bantu/observasi';
                    $tab_string = 'Asesmen Observasi';
                }
                
                elseif($tab == 'alat-Pra bedah') {
                    $tab_url='alat-bantu/pra-bedah';
                    $tab_string = 'Asesmen Pra Bedah';
                }

                elseif($tab == 'kasus') {
                    $tab_url='';
                    $tab_string = 'Kasus';
                }

                elseif($tab == 'administrasi') {
                    $tab_url='administrasi';
                    $tab_string = 'Administrasi';
                }

                elseif($tab == 'alat-bantu') {
                    $tab_url='alat-bantu';
                    $tab_string = 'Alat Bantu';
                }

                elseif($tab == 'bpjs') {
                    $tab_url='bpjs';
                    $tab_string = 'BPJS';
                }

                elseif($tab == 'histori') {
                    $tab_url='histori';
                    $tab_string = 'Histori';
                }

                elseif($tab == 'datamedis') {
                    $tab_url='datamedis';
                    $tab_string = 'Data Medis';
                }

                elseif($tab == 'keperawatan') {
                    $tab_url='keperawatan';
                    $tab_string = 'Keperawatan';
                }

                elseif($tab == 'kolaborator') {
                    $tab_url='kolaborator';
                    $tab_string = 'Kolaborator';
                }

                elseif($tab == 'operasi') {
                    $tab_url='operasi';
                    $tab_string = 'Operasi';
                }

                elseif($tab == 'alat-medis') {
                    $tab_url='alat-medis';
                    $tab_string = 'Alat Medis';
                }

                elseif($tab == 'pengaturan') {
                    $tab_url='pengaturan';
                    $tab_string = 'Pengaturan';
                }

                elseif($tab == 'penunjang') {
                    $tab_url='penunjang';
                    $tab_string = 'Penunjang';
                }

                elseif($tab == 'kolaborator') {
                    $tab_url='kolaborator';
                    $tab_string = 'Kolaborator';
                }

                elseif($tab == 'bpjs-sep') {
                    $tab_url='bpjs';
                    $tab_string = 'SEP untuk BPJS';
                }

                elseif($tab == 'resume') {
                    $tab_url='pengaturan';
                    $tab_string = 'Resume';
                }

                elseif($tab == 'administrasi-rawatinap-daftar') 
                {
                    $type_string = 'mendaftarkan ke';
                    $tab_url='administrasi';
                    $tab_string = 'Rawat Inap';
                    $icon = 'fa-file-text';
                }

                elseif($tab == 'administrasi-igd-pindah') 
                {
                    $type_string = 'Pindah Ruang';
                    $tab_url='administrasi';
                    $tab_string = 'IGD';
                    $icon = 'fa-file-text';
                }

                elseif($tab == 'administrasi-rawatinap-pindah') 
                {
                    $type_string = 'Pindah Ruang';
                    $tab_url='administrasi';
                    $tab_string = 'Rawat Inap';
                    $icon = 'fa-file-text';
                }

                elseif($tab == 'administrasi-rawatjalan-daftar') 
                {
                    $type_string = 'mendaftarkan ke';
                    $tab_url='administrasi';
                    $tab_string = 'Rawat Jalan';
                    $icon = 'fa-file-text';
                }

                elseif($tab == 'administrasi-igd-daftar') 
                {
                    $type_string = 'mendaftarkan ke';
                    $tab_url='administrasi';
                    $tab_string = 'IGD';
                    $icon = 'fa-file-text';
                }

                elseif($tab == 'administrasi-rawatinap-masuk') 
                {
                    $type_string = 'memasuki kamar di';
                    $tab_url='administrasi';
                    $tab_string = 'Rawat Inap';
                    $icon = 'fa-file-text';
                }
                elseif($tab == 'administrasi-jenazah-daftar') 
                {
                    $type_string = 'mendaftarkan permintaan jemput ke';
                    $tab_url='administrasi';
                    $tab_string = 'Kamar Jenazah';
                    $icon = 'fa-file-text';
                }
                elseif($tab == 'administrasi-unit-tindakan') 
                {
                    $type_string = 'mendaftarkan permintaan Unit Tindakan';
                    $tab_url='administrasi';
                    $tab_string = 'Unit Tindakan';
                    $icon = 'fa-file-text';
                }
                else
                {
                    $tab = '';
                    $tab_url='';
                    $tab_string = '';
                }

                if ($type!='view') {
                    $kolaborator = Kolaborator::where('kasus_id',$kasus_id)->where('invitation',1)->get();
                    $user = User::find($created_by);
                    $kasus = Kasus::find($kasus_id);
                    foreach ($kolaborator as $item) {
                        if($item->user_id != Auth::user()->id)
                            $notif = app('App\Http\Controllers\Users\Notification\CreateController')->create($item->user_id, $user->id, $user->name.' '.$type_string.' '.$tab_string.' pada Kasus', 'kasus/'.$kasus->nomor_kasus.'/'.$tab_url);
                    }
                }
        		
                DB::connection('kasus')->commit();
                DB::connection('mysql')->commit();
                return $log;

            } catch (\Exception $e) {
               
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);

                DB::connection('kasus')->rollback();
                DB::connection('mysql')->rollback();
                
            }
    	}
}
