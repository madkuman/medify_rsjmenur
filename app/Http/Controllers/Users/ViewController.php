<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\UserPendidikan;
use App\Models\Hospital\UserPelatihan;
use App\Models\Hospital\UserKarya;
use App\Models\Hospital\UserSkill;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Kasus;
use App\Models\Kepegawaian\Position;
use App\Models\Kepegawaian\Mposition;
use App\Models\Kepegawaian\Education;
use App\Models\Kepegawaian\Training;
use App\User;

class ViewController extends Controller
{
    public function profile($id){
    	$kolab = Kolaborator::where('user_id', $id)->where('invitation', '=', '1')->pluck('kasus_id')->all();
        $kasus = Kasus::whereIn('id', $kolab)->get();

        $user = User::where('id', $id)->first();

    	$data['user'] = User::with('employee')->where('id', $id)->first();
    	$data['userpend'] = UserPendidikan::where('users_id', $id)->orderBy('tahun_masuk', 'asc')->get();
    	$data['userpel'] = UserPelatihan::where('users_id', $id)->orderBy('tahun', 'asc')->get();
    	$data['userkar'] = UserKarya::where('users_id', $id)->orderBy('tahun', 'asc')->get();
    	$data['userskill'] = UserSkill::where('users_id', $id)->get();
    	$data['userkasus'] = $kasus;
        $data['userpraktek'] = DokterJadwal::where('dokter_id', $user->dokter_id)->groupBy('poliklinik_id')->get();
        $data['userjadwal'] = DokterJadwal::where('dokter_id', $user->dokter_id)->orderBy('poliklinik_id', 'asc')->orderBy('hari_order', 'asc')->get();
    	$data['poliklinik'] = Poliklinik::pluck('name','id')->toArray();
    	$data['randomuser'] = User::inRandomOrder()->take(5)->get();
    	return view('profile.index', $data);
    }

    public function getPendidikan(){
    	$id_pegawai = Auth::user()->employee_id;
		$pendidikan = Education::where('employee_id', $id_pegawai)->orderBy('tmt', 'asc')->get();
		return json_encode($pendidikan);
    }

    public function getPelatihan(){
    	$id_pegawai = Auth::user()->employee_id;
		$pelatihan = Training::where('employee_id', $id_pegawai)->orderBy('period', 'desc')->get();
		return json_encode($pelatihan);
    }
}
