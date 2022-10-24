<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhan;
use App\Models\Keperawatan\RencanaAsuhanDetail;
use App\Models\Keperawatan\JenisRencanaAsuhan;
use App\Models\Keperawatan\JenisRencanaAsuhanDetail;

class ViewController extends Controller
{
    	public function index(Request $request)
    	{
            $jenis = $request->jenis;
            if(!empty($jenis) && $jenis != 0) $asuhan = RencanaAsuhan::where('jenis_id',$jenis)->get();
            else $asuhan = RencanaAsuhan::all();

            $jenis = JenisRencanaAsuhan::all();
            $data['jenis'] = $jenis;
    		$data['asuhan'] = $asuhan;
    		return view('keperawatan.index',$data);
    	}

    	public function create()
    	{
    		$jenis = JenisRencanaAsuhan::all();
    		$data['jenis'] = $jenis;
    		return view('keperawatan.create',$data);
    	}

    	public function single($id)
    	{
    		$asuhan = RencanaAsuhan::find($id);
    		$data['asuhan'] = $asuhan;
    		return view('keperawatan.single',$data);

		}
		
		public function edit($id)
		{
		  $data['asuhan'] = RencanaAsuhan::findOrFail($id);
		  $data ['diagnosa'] = RencanaAsuhanDetail::where('rencana_asuhan_id', $id)->where('jenis_id', 1)->get();
		  $data ['penunjang'] = RencanaAsuhanDetail::where('rencana_asuhan_id', $id)->where('jenis_id', 2)->get();
		  $data ['subjektif'] = RencanaAsuhanDetail::where('rencana_asuhan_id', $id)->where('jenis_id', 3)->get();
		  $data ['objektif'] = RencanaAsuhanDetail::where('rencana_asuhan_id', $id)->where('jenis_id', 4)->get();
		  $data ['kriteriahasil'] = RencanaAsuhanDetail::where('rencana_asuhan_id', $id)->where('jenis_id', 5)->get();
		  $data ['mandiri'] = RencanaAsuhanDetail::where('rencana_asuhan_id', $id)->where('jenis_id', 6)->get();
		  $data ['kolaborasi'] = RencanaAsuhanDetail::where('rencana_asuhan_id', $id)->where('jenis_id', 7)->get();
		  $data ['jenis'] = JenisRencanaAsuhan::all();
		  $data ['jenisdetail'] = JenisRencanaAsuhanDetail::all();
		  return view('keperawatan.edit', $data);
		}

        public function APIsingle($id)
        {
            $asuhan = RencanaAsuhan::find($id);
            $data['asuhan'] = $asuhan;
            return view('keperawatan.api-single',$data);

        }
}
