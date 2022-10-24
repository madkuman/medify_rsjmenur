<?php

namespace App\Http\Controllers\IGD\Antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Antrian;
use App\Models\IGD\AntrianLevel;
use App\Models\IGD\AntrianLoket;
use Carbon\Carbon;

class ViewController extends Controller
{
    	public function mesin()
    	{
    		$data['level'] = AntrianLevel::all();
    		return view('igd.antrian.mesin.index',$data);
    	}
    	
    	public function screen()
    	{
    		$data['level'] = AntrianLevel::all();
    		return view('igd.antrian.screen.index',$data);
    	}

    	public function button()
    	{
    		$data['loket'] = AntrianLoket::all();
    		return view('igd.antrian.button.index',$data);
    	}

        public function list()
        {
            $data['antrian'] = Antrian::with('level')->where('created_at', '>',Carbon::now()->subHours(24)->toDateTimeString())->whereNull('called_button_at')->paginate();
            return view('igd.antrian.list.index', $data);
        }

        public function getAntrianIGDLeft()
        {
            $data['p1'] = Antrian::where('antrian_level_id',1)->whereNull('called_button_at')->count();
            $data['p2'] = Antrian::where('antrian_level_id',2)->whereNull('called_button_at')->count();
            $data['p3'] = Antrian::where('antrian_level_id',3)->whereNull('called_button_at')->count();

            return json_encode($data);
        }

}
