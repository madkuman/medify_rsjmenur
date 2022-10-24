<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Hospital\MasterStatusPulang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use App\Models\KamarJenazah\Permintaan;

class LaporanKematianDinkes extends Controller
{
    /*public function get($request)
    {
    	//dd($request);
    	$start = Carbon::parse($request->kematianDinkes_date_start)->format('d-m-Y');
    	$end = Carbon::parse($request->kematianDinkes_date_end)->format('d-m-Y');
    	//dd($start,$end);
    	$data['bulan'] = $request->kematianDinkes_bulan;
    	$data['tahun'] = $request->kematianDinkes_tahun;
    	$pasien = Pasien::whereBetween('death_at',[$start,$end])->get();
    	//dd($pasien);
    	$data['mrs'] = [];
    	$data['umur'] = [];
    	$data['sex'] = [];
    	$data['kode_penyakit_awal'] = [];
    	$data['kode_penyakit_akhir'] = [];
    	$data['diagnosa_masuk'] = [];
    	$data['diagnosa_meninggal'] = [];
    	$data['tanggal_meninggal'] = [];
    	if(count($pasien) > 0)
    	{
    		foreach ($pasien as $item) 
    		{	
    			$kasus_awal = Kasus::where('pasien_id',$item->id)->orderBy('created_at','ASC')->first();
    			$kasus_akhir = Kasus::where('pasien_id',$item->id)->orderBy('created_at','DESC')->first();
    			//dd($kasus_akhir,$kasus_awal);
    			array_push($data['mrs'], $kasus_awal->created_at->format('d-m-Y'));
    			array_push($data['tanggal_meninggal'], $item->death_at);
    			array_push($data['umur'], $item->age);
    			array_push($data['sex'], $item->JenisKelamin);
    			if(count($kasus_awal->diagnosis) > 0)
    			{
    				if(!empty($kasus_awal->diagnosisUtama))
	    			{	
	    				//dd("abc");
	    				array_push($data['kode_penyakit_awal'], $kasus_awal->diagnosisUtama->icd10->code_icd);
	    				array_push($data['diagnosa_masuk'], $kasus_awal->diagnosisUtama->icd10->long_desc);	
	    			}
	    			else
	    			{
	    				$diagnosis = $kasus_awal->diagnosisTambahan;
	    				array_push($data['kode_penyakit_awal'], $diagnosis[0]->icd10->code_icd);
	    				array_push($data['diagnosa_masuk'], $diagnosis[0]->icd10->long_desc);
	    			}	
    			}
    			else
    			{
    				array_push($data['kode_penyakit_awal'], '-');
    				array_push($data['diagnosa_masuk'], '-');
    			}
    			if(count($kasus_akhir->diagnosis) > 0)
    			{
    				if(!empty($kasus_akhir->diagnosisUtama))
	    			{	
	    				//dd("abc");
	    				array_push($data['kode_penyakit_akhir'], $kasus_akhir->diagnosisUtama->icd10->code_icd);
	    				array_push($data['diagnosa_meninggal'], $kasus_akhir->diagnosisUtama->icd10->long_desc);	
	    			}
	    			else
	    			{
	    				$diagnosis = $kasus_akhir->diagnosisTambahan;
	    				array_push($data['kode_penyakit_akhir'], $diagnosis[0]->icd10->code_icd);
	    				array_push($data['diagnosa_meninggal'], $diagnosis[0]->icd10->long_desc);
	    			}	
    			}
    			else
    			{
    				array_push($data['kode_penyakit_akhir'], '-');
    				array_push($data['diagnosa_meninggal'], '-');
    			}    			
    		}
    	}
    	return $data;
    }*/

    public function get($request)
    {   
        $start = Carbon::parse($request->kematianDinkes_date_start)->startOfDay();
        $end = Carbon::parse($request->kematianDinkes_date_end)->endOfDay();
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        //dd($start,$end);
        $data = [];
        $data['bulan'] = $request->kematianDinkes_bulan;
        $data['tahun'] = $request->kematianDinkes_tahun;
        $data['data'] = [];
        $kasus = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->orderBy('krs_at','asc')->with('pasien')->get();
        //dd($kasus);
        foreach($kasus as $item)
        {
            $pasien = Pasien::where('id',$item->pasien_id)->first();
            $temp = [];
            $temp['nama'] = $pasien->name;
            $temp['no_rm'] = $pasien->no_rm;
            $temp['usia'] = $pasien->age;
            $temp['gender'] = $pasien->jenis_kelamin_lp;
            $temp['alamat'] = $pasien->address;
            $temp['mrs'] = $item->created_at->format('d-m-Y');
            $temp['krs'] = $item->krs_at->format('d-m-Y');
            $dx = $this->getDiagnosa($item->id);
            $temp['diagnosa_masuk'] = $dx['masuk'];
            $temp['diagnosa_meninggal'] = $dx['meninggal'];
            $temp['keterangan'] = $dx['keterangan'];
            array_push($data['data'], $temp);
        }
        //$return['data'] = $data;
        return $data;
    }

    private function getDiagnosaICD($ids)
    {
        $icd = ICD10::whereIn('id',$ids)->get();
        return $icd;
    }

    private function getDiagnosaMasuk($kasus_id)
    {
        $diagnosa = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
        $icd = $this->getDiagnosaICD($diagnosa);
        $items = $icd->pluck('long_desc')->toArray();
        $items = implode(", ",$items);
        return $items;
    }

    private function getDiagnosaMati($kasus_id)
    {
        $permintaan = Permintaan::where('kasus_id',$kasus_id)->first();
        if(!empty($permintaan)) $diagnosa_meninggal = $permintaan->detail_kematian;
        else $diagnosa_meninggal = '-';

        return $diagnosa_meninggal;
    }

    private function getDiagnosaMasukICD($kasus_id)
    {
        $diagnosa = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
        $icd = $this->getDiagnosaICD($diagnosa);
        $items = $icd->pluck('code_icd')->toArray();
        $items = implode(", ",$items);
        return $items;
    }

    
    private function getDiagnosa($kasus_id)
    {
        $diagnosa = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
        $icd = ICD10::whereIn('id',$diagnosa)->get();
        $dx['masuk'] = $icd->pluck('long_desc')->toArray();
        $dx['keterangan'] = $icd->pluck('code_icd')->toArray();

        $diagnosa_utama = Diagnosis::where('kasus_id',$kasus_id)->where('utama',1)->pluck('icd_10');
        $icd = ICD10::whereIn('id',$diagnosa_utama)->get();
        $dx['meninggal'] = $icd->pluck('long_desc')->toArray();

        $dx['masuk'] = implode(", ",$dx['masuk']);
        $dx['keterangan'] = implode(", ",$dx['keterangan']);
        $dx['meninggal'] = implode(", ",$dx['meninggal']);
        return $dx;
    }
}
