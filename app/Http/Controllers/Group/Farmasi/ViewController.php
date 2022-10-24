<?php

namespace App\Http\Controllers\Group\Farmasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;
use App\User;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Farmasi;

class ViewController extends Controller
{
    public function index(Request $request, $slug){
    	$user = User::find(Auth::user()->id);

    	if($user->hasAnyRole(['group-admin', 'group-member'])){
    		$data['group'] = Grup::with('farmasi')->where('slug', $slug)->first();
	    	$data['members'] = UserGroup::where('group_id', $data['group']->id)->get();
	    	$data['has_joined'] = $data['members']->where('users_id', Auth::user()->id)->first();
    		// dd($data['group']->url);

	    	if($data['group']->farmasi === NULL){
	    		if (strpos($data['group']->url, 'rawatjalan/poliklinik') !== false) {
	    			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->create($data['group']->name.' - Farmasi', 2, 56);
	    		} else if(strpos($data['group']->url, 'rawatinap/bangsal') !== false) {
	    			if (strpos($data['group']->name, 'Pav') !== false) {
	    				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->create($data['group']->name.' - Farmasi', 3, 59);
	    			} else {
	    				$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->create($data['group']->name.' - Farmasi', 3, 60);
	    			}
	    		}else if(strpos($data['group']->url, 'unit-tindakan/') !== false) {
	    			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->create($data['group']->name.' - Farmasi', 4, 62);
	    		}
	    		if ($lokasi) {
	    			$lokasi_id = $lokasi->id;
	    		}else{
	    			$lokasi_id = null;
	    		}
    			$farmasiGroup = app('App\Http\Controllers\Group\Farmasi\CreateController')->create($data['group']->name, $data['group']->slug, $data['group']->id, $lokasi_id);
		    	$data['group'] = Grup::with('farmasi')->where('slug', $slug)->first();
	    	}

	    	$data['stok_obat'] = ItemsFarmasi::where('farmasi_id', $data['group']->farmasi->id)->latest('updated_at')->limit(5)->get();
		    $data['distribusi'] = Distribusi::where('farmasi_id', $data['group']->farmasi->id)->whereIn('status', [0, 1])->get();

	    	return view('group.farmasi', $data);
    	}
    	else{
    		abort(404);
    	}
    }
}
