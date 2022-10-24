<?php

namespace App\Http\Controllers\Admin\HakAkses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterHakAkses;
use App\Models\Hospital\HakAksesUsers;
use App\User;
use Yajra\DataTables\DataTables;

class ReadController extends Controller
{

	public function getUserAkses()
	{
		$admin = User::with('hak_akses.master_akses')->has('hak_akses');
		return $admin;
	}

	public function hakAksesData()
	{
		$query = $this->getUserAkses();
		return DataTables::of($query)
		->addColumn('hak_akses', function(User $user){
			$list_akses = [];
			foreach($user->hak_akses as $item){
				$list_akses[] = $item->master_akses->slug;
			}
			return $list_akses;
		})	
		->toJson();
	}

	public function getBySlug($slug)
	{
		$admin = MasterHakAkses::where('slug',$slug)->first();
		return $admin;
	}
    
}
