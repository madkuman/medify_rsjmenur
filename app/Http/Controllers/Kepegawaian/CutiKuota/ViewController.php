<?php

namespace App\Http\Controllers\Kepegawaian\CutiKuota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MasterCuti;
use App\User;
use Auth;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index()
    {
        $data['pegawai'] = User::select('id','name')->where('id','>',10)->get();
        $data['master_cuti'] = MasterCuti::select('id','nama')->get();
        return view('kepegawaian.cuti.kuota-hr.index.index',$data);
    }

    public function single($user_id)
    {
        $date = Carbon::maxValue();
        $data['user'] = User::find($user_id);
        $data['master_cuti'] = MasterCuti::select('id','nama')->get();
        $data['master_cuti_kuota'] = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getAllMasterCutiKuota($user_id,$date);
        return view('kepegawaian.cuti.kuota-hr.single.index',$data);
    }

    public function singleStaff($user_id)
    {
        $data = [];
        return view('kepegawaian.cuti.kuota-staff.single.index',$data);
    }

    public function indexUser()
    {
        $date = Carbon::maxValue();
        $user_id = Auth::user()->id;
        $data['user'] = User::find($user_id);
        $data['master_cuti'] = MasterCuti::select('id','nama')->get();
        $data['master_cuti_kuota'] = app("App\Http\Controllers\Kepegawaian\CutiKuota\ReadController")->getAllMasterCutiKuota($user_id,$date);
        return view('kepegawaian.cuti.kuota-staff.index.index',$data);
    }
}
