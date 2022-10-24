<?php

namespace App\Http\Controllers\Harmat\ListrikMati;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Harmat\ListrikMati;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class ReadController extends Controller
{
    protected $model; 

    function __construct()
    {
        $this->model = new ListrikMati;
    }

    public function getData($request = '')
    {   
        $data = $this->model;
        
        $data = app('App\Http\Controllers\Functions\AjiFunction')->whereQuery($request, $data, $this->model)->get();
        
    	return $data;
    }

    public function getEachData($id)
    {
    	$data = ListrikMati::find($id);

    	return $data;
    }

}
