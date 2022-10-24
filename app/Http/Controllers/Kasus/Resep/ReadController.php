<?php

namespace App\Http\Controllers\Kasus\Resep;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Resep;
use App\Models\Kasus\ICD10;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse\Items;
use App\Models\Pasien\Pasien;

class ReadController extends Controller
{
    public function fetchAllResep($nomorKasus) {

        $kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();

        $resep = Resep::where('kasus_id', $kasusId)->with(['resepDetail','transaksi_farmasi.owner_detail'])->orderBy('created_at','desc')->get();
        return $resep;
    }
    public function fetchResepKasus($kasus_id) {
        $resep = Resep::where('kasus_id', $kasus_id)->with(['resepDetail','transaksi_farmasi.owner_detail','doctor'])->orderBy('created_at','desc')->get();
        return $resep;
    }

    public function search(Request $request)
    {
    		$apotek_id = $request->apotek_id;
            $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
    		$items = Items::search($keyword)->paginate(10);
    		return json_encode($items);
    }
    public function get($nomor_kasus,$id) {
        $resep = Resep::where('id',$id)->with(['resepDetail.racikan_detail','transaksi_farmasi.ori_detail','transaksi_farmasi.final_detail.resep_detail', 'transaksi_farmasi.owner_detail'])->first();
        return json_encode($resep);
    }

    public function historiResep($nomor_kasus)
    {   
        $pasien_id = Kasus::where('nomor_kasus',$nomor_kasus)->pluck('pasien_id')->first();
        $pasien = Pasien::find($pasien_id);
        $all_kasus = Kasus::where('pasien_id',$pasien_id)->pluck('id')->toArray();
        $resep = Resep::whereIn('kasus_id', $all_kasus)->with(['resepDetail','transaksi_farmasi.ori_detail','transaksi_farmasi.owner_detail','kasus'])->orderBy('kasus_id','desc')->get();
        // dd($resep);
        $data['reseps'] = [];
        $data['pasien'] = $pasien;
        foreach ($resep as $value) 
        {   
            if(empty($data['reseps'][$value->kasus_id]))
            {
                $data['reseps'][$value->kasus_id] = [];
                array_push($data['reseps'][$value->kasus_id],$value);   
            }
            else
            {
                array_push($data['reseps'][$value->kasus_id],$value);
            }
        }
        // dd($data);
        return view('kasus.datamedis.content.resep.histori',$data);
    }
}
