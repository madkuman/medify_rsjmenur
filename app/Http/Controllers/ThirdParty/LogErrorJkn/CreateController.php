<?php

namespace App\Http\Controllers\ThirdParty\LogErrorJkn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\LogErrorJkn;

class CreateController extends Controller
{
    public function create($data)
    {
        $log = new LogErrorJkn();
        $log->kodebooking = $data['kodebooking'];
        $log->response = $data['response'];
        $log->save();
    }
}
