<?php

namespace App\Http\Controllers\Harmat\ListrikMati;

use Auth;
use Illuminate\Http\Request;
use App\Models\Harmat\ListrikMati;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
	protected $model; 

    function __construct()
    {
        $this->model = new ListrikMati;
    }

	public function update($request, $id)
	{
		$data = app('App\Http\Controllers\Functions\AjiFunction')->everyRequest($request, $this->model);
		$data['updated_by'] = Auth::user()->id;

		ListrikMati::where('id', $id)
		        ->update($data);
	}
    
}
