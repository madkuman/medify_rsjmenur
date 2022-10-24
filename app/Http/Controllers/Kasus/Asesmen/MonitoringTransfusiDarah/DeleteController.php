<?php

namespace App\Http\Controllers\Kasus\Asesmen\MonitoringTransfusiDarah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\MonitoringTransfusiDarah;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $monitoring_transfusi_darah = MonitoringTransfusiDarah::find($id);
        if($monitoring_transfusi_darah)
            $monitoring_transfusi_darah->delete();
    }
}