<?php

namespace App\Http\Controllers\ThirdParty\LogJkn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\LogTaskJknId;

class CreateController extends Controller
{
    public function create($data)
    {
        $log = new LogTaskJknId();
        $log->kodebooking = $data['kodebooking'];
        $log->task_id = $data['task_id'];
        $log->waktu = $data['waktu'];
        $log->response = $data['response'];
        $log->save();
    }
}
