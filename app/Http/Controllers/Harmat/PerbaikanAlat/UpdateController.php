<?php

namespace App\Http\Controllers\Harmat\PerbaikanAlat;

use Auth;
use Illuminate\Http\Request;
use App\Models\Harmat\PerbaikanAlat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class UpdateController extends Controller
{
	protected $model; 

    function __construct()
    {
        $this->model = new PerbaikanAlat;
    }
	
    public function update($request, $id)
	{	
		$data = app('App\Http\Controllers\Functions\AjiFunction')->everyRequest($request, $this->model);
		$data['updated_by'] = Auth::user()->id;

		PerbaikanAlat::where('id', $id)
		        ->update($data);
	}
}
