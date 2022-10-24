<?php

namespace App\Http\Controllers\Users\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Spesialisasi;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Hospital\UserProfilePublic;
use App\Models\Hospital\SubSpesialisasi;
use App\User;
use App\Models\RawatJalan\Dokter;

class ViewController extends Controller
{
    public function account(){
    	return view('settings.account');
    }
    public function password(){
    	return view('settings.password');
    }
    public function profession(){
    	$id_profesi = Auth::user()->profesi;
    	$data['specialty'] = Spesialisasi::where('profession', $id_profesi)->pluck('name','id')->toArray();
        $data['subspecialty'] = SubSpesialisasi::all();
    	return view('settings.profession', $data);
    }
     public function publication(){
        $id_user = Auth::user()->id;
        $user = UserProfilePublic::where('users_id', Auth::user()->id)->first();
        return view('settings.publikasi', compact('user'));
    }
    public function sync(){
    	$employee_list = Pegawai::get(['id', 'name']);
    	$synced_acc = Pegawai::where('id', Auth::user()->employee_id)->first();
        $dokter = Dokter::all();
        return view('settings.sync', compact('employee_list', 'synced_acc','dokter'));
    }
    public function sip(){
        return view('settings.sip');
    }
    public function str(){
        return view('settings.str');
    }

    
    public function tandaTangan(){
        return view('settings.tanda-tangan');
    }
    public function perizinanAkses(){
        $user = User::find(Auth::user()->id);
        $data['dokter'] = User::where('profesi',1)->get();
        $user_allow_override = explode(',', $user->user_allow_override);
        $data['user_allow_override_id'] = $user_allow_override;
        return view('settings.perizinan-akses',$data);
    }
}
