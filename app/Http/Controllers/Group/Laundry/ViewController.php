<?php

namespace App\Http\Controllers\Group\Laundry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\User;
use App\Models\Laundry\Transaksi;
use App\Models\Laundry\PenanggungJawab;
use carbon\Carbon;

class ViewController extends Controller
{
    public function index($slug){
    	$user = User::find(Auth::user()->id);

    	if($user->hasAnyRole(['group-admin', 'group-member'])){
    		$data['group'] = Grup::where('slug', $slug)->first();
	    	$data['members'] = UserGroup::where('group_id', $data['group']->id)->get();
	    	$data['has_joined'] = $data['members']->where('users_id', Auth::user()->id)->first();

            $data['transactions'] = Transaksi::where('group_id', $data['group']->id)->where('status_id', '!=', 5)->get();
            foreach ($data['transactions'] as $key) {
              $penanggung = PenanggungJawab::where('transaksi_id',$key->id)->first();

              $key->nama_status = $key->getStatus->nama;
              $key->group_name = $key->getGroupName->name;
              $key->waktu_diserahkan = $key->created_at->formatLocalized('%d %B %Y , %H:%M');
              if (!empty($penanggung->waktu_penerima)) {
                $key->waktu_diterima = \Carbon\Carbon::parse($penanggung->waktu_penerima)->formatLocalized('%d %B %Y , %H:%M');
              } else {
                $key->waktu_diterima = '';
              }
              $key->nama_penerima = $penanggung->penerima_pencucian;
              if (!empty($penanggung->waktu_menyerahkan)) {
                $key->waktu_dikembalikan = \Carbon\Carbon::parse($penanggung->waktu_menyerahkan)->formatLocalized('%d %B %Y , %H:%M');
              } else {
                $key->waktu_dikembalikan = '';
              }
            }

	    	return view('group.laundry', $data);
    	}
    	else{
    		abort(404);
    	}
    }
}
