<?php

namespace App\Http\Controllers\Kasus\Asesmen\MonitoringTransfusiDarah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\MonitoringTransfusiDarah;
use DB;

class ReadController extends Controller
{
    public function all(){
    	return MonitoringTransfusiDarah::all();
    }
}