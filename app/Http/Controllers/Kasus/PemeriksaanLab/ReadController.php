<?php

namespace App\Http\Controllers\Kasus\PemeriksaanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DarahLengkap;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Urine;
use App\Models\Kasus\Immunologi;
use App\Models\Kasus\PapSmear;
use App\Models\Kasus\Feces;

class ReadController extends Controller
{
    public function getAll($kasus_id)
    {
    	$darah = DarahLengkap::where('kasus_id',$kasus_id)
    			->orderBy('created_at','desc')->get();
    	return $darah;
    }
    public function getLast($kasus_id)
    {
        $darah = DarahLengkap::where('kasus_id',$kasus_id)
                ->orderBy('id','desc')->first();
        return $darah;
    }
    public function single($id)
    {	
    	$darah = DarahLengkap::where('id',$id)->first();
    	//dd(json_decode($darah));
    	return json_encode($darah);
    }
    public function getAllUrine($kasus_id)
    {
    	$urine = Urine::where('kasus_id',$kasus_id)
    			->orderBy('created_at','desc')->get();
    	return $urine;
    }
    public function getLastUrine($kasus_id)
    {
        $urine = Urine::where('kasus_id',$kasus_id)
                ->orderBy('id','desc')->first();
        return $urine;
    }
    public function urineSingle($id)
    {
    	$urine = Urine::where('id',$id)->first();
    	return json_encode($urine);
    }
    public function getAllImun($kasus_id)
    {
    	$fisik = Immunologi::where('kasus_id',$kasus_id)
    			->orderBy('created_at','desc')->get();
    	return $fisik;
    }
    public function getLastImun($kasus_id)
    {
        $fisik = Immunologi::where('kasus_id',$kasus_id)
                ->orderBy('id','desc')->first();
        return $fisik;
    }
    public function imunSingle($id)
    {
    	$fisik = Immunologi::where('id',$id)->first();
    	return json_encode($fisik);
    }
    public function getAllSmear($kasus_id)
    {
        $smear = PapSmear::where('kasus_id',$kasus_id)
                ->orderBy('created_at','desc')->get();
        return $smear;
    }
    public function getLastSmear($kasus_id)
    {
        $smear = PapSmear::where('kasus_id',$kasus_id)
                ->orderBy('id','desc')->first();
        return $smear;
    }
    public function smearSingle($id)
    {
        $smear = PapSmear::where('id',$id)->first();
        return json_encode($smear);
    }
    public function getAllFeces($kasus_id)
    {
        $feces = Feces::where('kasus_id',$kasus_id)
                ->orderBy('created_at','desc')->get();
        return $feces;
    }
    public function getLastFeces($kasus_id)
    {
        $feces = Feces::where('kasus_id',$kasus_id)
                ->orderBy('id','desc')->first();
        return $feces;
    }
    public function fecesSingle($id)
    {
        $feces = Feces::where('id',$id)->first();
        return json_encode($feces);
    }
}
