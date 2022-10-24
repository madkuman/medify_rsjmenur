<?php

namespace App\Http\Controllers\Admin\UserControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Hospital\Profesi;
use App\Models\Hospital\Spesialisasi;
use App\Models\Hospital\SubSpesialisasi;
use App\Models\RawatJalan\Dokter;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index()
    {   
        $data['profesi'] = Profesi::all();
        return view('admin.usercontrol.index',$data);
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['pegawai'] = Pegawai::get(['id', 'name', 'nrp']);
        $data['synced_acc'] = (!empty($data['user']->employee_id)) ? Pegawai::where('id', $data['user']->employee_id)->first() : NULL ;
        $data['profesi'] = Profesi::pluck('title','id')->toArray();
        $data['specialty'] = Spesialisasi::where('profession', $data['user']->profesi)->pluck('name','id')->toArray();
        $data['subspecialty'] = SubSpesialisasi::all();
        $data['dokter'] = Dokter::all();
        $data['allow_admin'] = 1;
        return view('admin.usercontrol.edit', $data);
    }

    public function bypassLogin($id)
    {
        $user=User::find($id);
        auth()->login($user);
        return redirect('/home');
    }


}
