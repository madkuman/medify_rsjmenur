<?php

namespace App\Http\Controllers\GettingStarted;

use App\Models\Hospital\Profesi;
use App\Models\Hospital\Spesialisasi;
use App\Models\Hospital\SubSpesialisasi;
use App\Models\Hospital\Grup;
use App\Models\Hospital\RecommendedGroup;
use App\Models\Kepegawaian\Pegawai;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Dokter;

class ViewController extends Controller
{
    	public function profesi()
    	{   		
    		$data['profesi'] = Profesi::pluck('title','id')->toArray();
            $data['subspecialty'] = SubSpesialisasi::all();
    		return view('getting-started.profesi', $data);
    	}

    	public function getSpesialisasi($input){
    		$spesialisasi = Spesialisasi::where('profession', $input)->pluck('name','id')->toArray();
    		return json_encode($spesialisasi);
    	}
    	
    	public function grup(){
            $recommended = json_decode($this->recList());
    		$data['grup'] = Grup::whereNotIn('id', $recommended)->get();
            $data['rec_grup'] = Grup::whereIn('id', $recommended)->get();
    		return view('getting-started.grup', $data);
    	}
        
        public function syncKepegawaian(){
            $data['pegawai'] = Pegawai::get(['id', 'name','nrp']);
            return view('getting-started.sync-kepegawaian',$data);
        }

    	public function recList(){
    		$id_profesi = Auth::user()->profesi;
    		$rec_list = RecommendedGroup::where('profesi_id', $id_profesi)->pluck('group_id')->toArray();
    		return json_encode($rec_list);
    	}

    	public function avatar()
    	{   		
    		return view('getting-started.avatar');
    	}

        public function emailOfficial()
        {
            return view('getting-started.email-resmi');
        }

        public function noSIPSTR()
        {
            return view('getting-started.sip-str');
        }

        public function DPJP()
        {
            $data['dokter'] = Dokter::all();
            return view('getting-started.integrasi-dpjp',$data);
        }
}
