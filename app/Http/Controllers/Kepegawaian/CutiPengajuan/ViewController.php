<?php

namespace App\Http\Controllers\Kepegawaian\CutiPengajuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MasterCuti;
use App\Models\Kepegawaian\MasterCutiAlasan;
use App\Models\Kepegawaian\CutiPengajuan;
use Carbon\Carbon;
use App\User;
use Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['pegawai'] = User::select('id','name')->where('id','>',10)->get();
        return view('kepegawaian.cuti.pengajuan-cuti-hr.index.index',$data);
    }

    public function indexUser()
    {
        return view('kepegawaian.cuti.pengajuan-cuti-staff.index.index');
    }

    public function formNew()
    {
        $data['master_cuti'] = MasterCuti::select('id','nama')->get();
        $data['master_cuti_alasan'] = MasterCutiAlasan::select('id','nama')->get();
        $data['cuti'] = [];
        $data['method'] = 'new';
        return view('kepegawaian.cuti.pengajuan-cuti-staff.form.index',$data);
    }

    public function formEdit($id)
    {
        $cuti = CutiPengajuan::where('id',$id)->with('master_cuti','master_cuti_alasan')->first();
        if(Auth::user()->id != $cuti->created_by && Auth::user()->admin == 0) 
        {
            abort(404);
        }
        $data['master_cuti'] = MasterCuti::select('id','nama')->get();
        $data['master_cuti_alasan'] = MasterCutiAlasan::select('id','nama')->get();

        $data['cuti'] = $cuti;
        $data['method'] = 'edit';

        return view('kepegawaian.cuti.pengajuan-cuti-staff.form.index',$data);
    }

    public function formSingleStaff($id)
    {
        $cuti = CutiPengajuan::where('id',$id)->with('master_cuti','master_cuti_alasan','creator')->first();
        if(Auth::user()->id != $cuti->created_by && Auth::user()->admin == 0) 
        {
            abort(404);
        }

        $date_start = Carbon::createFromFormat("Y-m-d",$cuti->date_start);
        $date_end = Carbon::createFromFormat("Y-m-d",$cuti->date_end);
        $cuti_tanggal = app("App\Http\Controllers\Kepegawaian\CutiPengajuan\APIController")->getHariCuti($date_start,$date_end);

        $cuti_sisa = $this->getSisaCuti($cuti->created_by,[$cuti->master_cuti_id],$cuti->created_at);

        $data['cuti'] = $cuti;
        $data['cuti_tanggal'] = $cuti_tanggal;
        $data['cuti_sisa'] = $cuti_sisa;
        return view('kepegawaian.cuti.pengajuan-cuti-staff.single.index',$data);

    }

    public function formSingle($id)
    {
        $cuti = CutiPengajuan::where('id',$id)->with('master_cuti','master_cuti_alasan','creator')->first();
        if(Auth::user()->id != $cuti->created_by && Auth::user()->admin == 0)
        {
            abort(404);
        }

        $date_start = Carbon::createFromFormat("Y-m-d",$cuti->date_start);
        $date_end = Carbon::createFromFormat("Y-m-d",$cuti->date_end);
        $cuti_tanggal = app("App\Http\Controllers\Kepegawaian\CutiPengajuan\APIController")->getHariCuti($date_start,$date_end);

        $cuti_sisa = $this->getSisaCuti($cuti->created_by,[$cuti->master_cuti_id],$cuti->created_at);

        $data['cuti'] = $cuti;
        $data['cuti_tanggal'] = $cuti_tanggal;
        $data['cuti_sisa'] = $cuti_sisa;
        return view('kepegawaian.cuti.pengajuan-cuti-hr.single.index',$data);

    }

    private function getSisaCuti($user_id,$master_cuti_ids,$tanggal)
    {
        $tanggal = $tanggal->copy()->endOfDay();
        $kuota = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getKuotaBefore($user_id,$master_cuti_ids,$tanggal);
        return $kuota;
    }
}
