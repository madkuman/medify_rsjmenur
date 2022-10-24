<?php

namespace App\Http\Controllers\Admin\UserControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\User;

class ReadController extends Controller
{
    public function loadTable(Request $request)
    {
    	$query = User::query();
    	if($request->profesi != 'all')
        	$query->where('profesi',$request->profesi);

        if($request->special == 'tanpa-dokter')
        	$query->whereNull('dokter_id');
        if($request->special == 'tanpa-pegawai')
        	$query->whereNull('employee_id');
        if($request->special == 'admin-1')
        	$query->where('admin',1);


        if($request->status != 'all'){
        	if($request->status == 1){
        		$query->where('flag',1);
        	}
        	elseif($request->status == 0){
        		$query->where(function($q){
        			$q->whereNull('flag')->orWhere('flag',0);
        		});
        	}
        }

        $query->with('profesi_detail', 'specialty_detail','dokter');

        return DataTables::of($query)
            ->toJson();
    }

    
}
