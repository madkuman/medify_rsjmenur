<?php

namespace App\Http\Controllers\Harmat\ListrikMati;

use Auth;
use Illuminate\Http\Request;
use App\Models\Harmat\ListrikMati;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    protected $model; 

    function __construct()
    {
        $this->model = new ListrikMati;
    }

    public function store($request)
    {
        $data = app('App\Http\Controllers\Functions\AjiFunction')->everyRequest($request, $this->model);
        $data['created_by'] = Auth::user()->id;

    	$data = new ListrikMati($data);
                
        $data->save();
    }
}
