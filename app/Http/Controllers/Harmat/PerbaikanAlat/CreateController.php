<?php

namespace App\Http\Controllers\Harmat\PerbaikanAlat;

use Auth;
use Illuminate\Http\Request;
use App\Models\Harmat\PerbaikanAlat;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    protected $model; 

    function __construct()
    {
        $this->model = new PerbaikanAlat;
    }

    public function store($request)
    {
        $data = app('App\Http\Controllers\Functions\AjiFunction')->everyRequest($request, $this->model);
        $data['created_by'] = Auth::user()->id;

        $data = new PerbaikanAlat($data);
                
        $data->save();
    }
}
