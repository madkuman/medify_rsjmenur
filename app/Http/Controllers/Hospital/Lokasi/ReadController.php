<?php

namespace App\Http\Controllers\Hospital\Lokasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\LokasiDepartemen;
use App\Models\RawatInap\Bangsal;

class ReadController extends Controller
{
    public function getLokasi()
    {
    	$locs = Lokasi::all();
    	return $locs;
    }

    public function getSingleLokasi($lokasi_id)
    {
    	$loc = Lokasi::where('id',$lokasi_id)->withTrashed()->first();
    	return $loc;
    }

    public function getSingleLokasiSlug($slug)
    {
        $loc = Lokasi::where('slug',$slug)->first();
        return $loc;
    }

    public function searchLokasi(Request $request)
    {
        $keyword = $request->keyword;
        
        $data = lokasi::where('nama', 'like', '%'.$keyword.'%')->get();
        
        $lokasi = [];
        foreach($data as $each_data)
        {
            $temp['id'] = $each_data->nama;
            $temp['text'] = $each_data->nama;
            array_push($lokasi, $temp);
        }

        return response()->json($lokasi);    
    }

    public function getLokasiDepartmenWithLokasi(Request $request){

        $data = LokasiDepartemen::with('lokasi');

        $data = app('App\Http\Controllers\Functions\AjiFunction')->whereQuery($request->all(), $data, new LokasiDepartemen)->get();
        
        return response()->json($data);    
    }

    public function getAllDepartemen()
    {
        $lokasi = LokasiDepartemen::all();
        return $lokasi;
    }

    public function getDepartemenBySlug($slug)
    {
        $dept = LokasiDepartemen::where('slug', $slug)->first();
        return $dept;
    }

    public function getLokasiByDepartemenSlug($slug){

        $dept = LokasiDepartemen::where('slug',$slug)->first();
        $lokasi = Lokasi::where('lokasi_departemen_id',$dept->id)->get();
        
        return $lokasi;
    }

    public function getLokasibyDepartemenBeauty($slugs)
    {
        /*Untuk Select2 atau select filter*/
        $lokasi_array = [];
        foreach($slugs as $slug)
        {
            $departemen = LokasiDepartemen::where('slug',$slug)->first();
            if($slug == 'rawat-inap')
            {
                $bangsal = Bangsal::all();
                foreach($bangsal as $item)
                {
                    $temp = new \stdClass();
                    $id =  $item->ruangan->pluck('lokasi_id')->toArray();
                    $temp->id = implode(",", $id);
                    $temp->nama = $item->nama;
                    $lokasi_array[] = $temp;
                }
            }
            elseif($slug == 'igd')
            {
                $temp = new \stdClass();
                $id =  Lokasi::where('lokasi_departemen_id',$departemen->id)->pluck('id')->toArray();
                $temp->id = implode(",", $id);
                $temp->nama = 'IGD';
                $lokasi_array[] = $temp;
            }
            else
            {
                $lokasi = Lokasi::where('lokasi_departemen_id',$departemen->id)->select('id','nama')->get();
                foreach($lokasi as $item_lokasi)
                {
                    $temp = new \stdClass();
                    $temp->id = $item_lokasi->id;
                    $temp->nama = $item_lokasi->nama;
                    $lokasi_array[] = $temp;
                }

            }
        }

        return $lokasi_array;
    }

    public function formBeautyLokasiToId($arrays)
    {
        $data = [];
        foreach($arrays as $item)
        {
            $ids = explode(",", $item->id);
            $data = array_merge($data, $ids);
        }

        return $data;
    }
}
