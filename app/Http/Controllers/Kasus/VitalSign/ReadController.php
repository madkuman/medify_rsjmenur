<?php

namespace App\Http\Controllers\Kasus\VitalSign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\VitalSign;

class ReadController extends Controller
{
    	public function fetchAllVitals($kasus_id)
    	{
    		$vitals = VitalSign::with(['creator', 'updater'])->where('kasus_id',$kasus_id)->OrderBy('created_at','desc')->with('creator','updater')->get();
            
    		return $vitals;
    	}

    	public function fetchOne($nomor_kasus,$id)
    	{
    		$vitals = VitalSign::where('id',$id)->first();
    		return json_encode($vitals);
    	}

        public function fetchAllVitalsGraphic($kasus_id)
        {
            $data['temperatur'] = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->pluck('temperatur')->toArray();
            $data['nadi'] = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->pluck('nadi')->toArray();
            $data['pernapasan'] = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->pluck('pernapasan')->toArray();
            $data['sistol'] = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->pluck('sistol')->toArray();
            $data['diastol'] = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->pluck('diastol')->toArray();
            $data['skala_nyeri'] = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->pluck('skala_nyeri')->toArray();
            $data['spo2'] = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->pluck('spo2')->toArray();
            $urine = VitalSign::where('kasus_id',$kasus_id)->OrderBy('created_at','asc')->select('produksi_urine', 'created_at')->get();
            
           
            return $data;
        }
        public function fetchLatestVital($kasus_id, $limit)
        {
            $vitals = VitalSign::with(['creator', 'updater'])->where('kasus_id',$kasus_id)->OrderBy('created_at','desc')->take($limit)->get();
            
            return $vitals;
        }
}
