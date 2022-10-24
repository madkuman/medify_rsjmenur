<?php

namespace App\Http\Controllers\Harmat\PerbaikanAlat;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Harmat\PerbaikanAlat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class ReadController extends Controller
{
    protected $model; 

    function __construct()
    {
        $this->model = new PerbaikanAlat;
    }
    
    public function getData($request = '')
    {

        $data = $this->model;
        
    	$data = app('App\Http\Controllers\Functions\AjiFunction')->whereQuery($request, $data, $this->model)->get();
    	
    	return $data;
    }

    public function getEachData($id)
    {
    	$data = PerbaikanAlat::find($id);

    	return $data;
    }

}
