<?php

namespace App\Http\Controllers\IGD\Antrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\AntrianLevel;
use App\Models\IGD\Antrian;
use Carbon\Carbon;

class PostController extends Controller
{
    	public function requestNomorAntrian($level_id)
    	{
    		$start = Carbon::today()->startOfDay();
    		$end = Carbon::today()->endOfDay();
    		$antrian_level = AntrianLevel::find($level_id);
    		$total_antrian = Antrian::where('antrian_level_id',$level_id)->whereBetween('created_at',[$start,$end])->count();
    		$new_number = $total_antrian + 1;
    		$new_number = str_pad($new_number, 3, "0", STR_PAD_LEFT);

    		$antrian = new Antrian;
    		$antrian->nomor_antrian = $antrian_level->kode.$new_number;
    		$antrian->antrian_level_id = $level_id;
    		$antrian->save();

    		$return['nomor_antrian'] = $antrian->nomor_antrian;
    		$return['level_prioritas'] = $antrian_level->nama;

    		return json_encode($return);
    	}

    	public function screenUpdateNomorAntrian()
    	{
    		$antrian_level = AntrianLevel::orderBy('level','asc')->get();
    		foreach($antrian_level as $level)
    		{

    			$current_antrian = Antrian::where('antrian_level_id',$level->id)->whereNotNull('called_button_at')->whereNull('called_screen_at')->first();
    			if(!empty($current_antrian))
    			{
    				$current_antrian->called_screen_at = Carbon::now();
    				$current_antrian->save();

    				$return['status'] = 1;
    				$return['loket_id'] = $current_antrian->loket_id;
    				$return['loket_nama'] = $current_antrian->loket->nama;
    				$return['nomor_antrian'] = $current_antrian->nomor_antrian;
    				return json_encode($return);
    			}
    		}
    		$return['status'] = 0;
    		return json_encode($return);
    	}

    	public function buttonCallNextAntrian($loket_id)
    	{
    		$antrian_level = AntrianLevel::orderBy('level','asc')->get();
    		foreach($antrian_level as $level)
    		{
    			$current_antrian = Antrian::where('antrian_level_id',$level->id)->whereNull('called_button_at')->first();
    			if(!empty($current_antrian))
    			{
    				$current_antrian->loket_id = $loket_id;
    				$current_antrian->called_button_at = Carbon::now();
    				$current_antrian->save();

    				$return['status'] = 1;
    				return json_encode($return);
    			}
    		}
		$return['status'] = 0;
		return json_encode($return);

    	}


        public function callAntrian($loket_id, $nomor_antrian)
        {
            $antrian = Antrian::where('nomor_antrian', $nomor_antrian)->whereNull('called_button_at')->orderBy('id','desc')->first();
            if(!empty($antrian))
            {
                $antrian->loket_id = $loket_id;
                $antrian->called_button_at = Carbon::now();
                $antrian->save();

                $return['status'] = 1;
                return json_encode($return);
            }
            $return['status'] = 0;
            return json_encode($return);
        }
}
