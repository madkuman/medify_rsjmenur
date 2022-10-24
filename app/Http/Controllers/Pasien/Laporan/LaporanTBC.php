<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Diagnosis;
use App\Models\Keuangan\TarifMaster;

class LaporanTBC extends Controller
{
    public function get($start,$end)
    {
    	$data['bulan'] = $start->copy()->format('m');
    	$data['tahun'] = $start->copy()->format('Y');
        $data['date_start'] = $start->copy()->format('d-m-Y');
        $data['date_end'] = $end->copy()->format('d-m-Y');
        $tarif_hba1c = TarifMaster::where('deskripsi','like','HbA1C')->first()->id;
    	$query = ICD10::where('code_icd','like','%A15%')
    					->orWhere('code_icd','like','%A16%')
                        ->orWhere('code_icd','like','%A17%')
                        ->orWhere('code_icd','like','%A18%')
                        ->orWhere('code_icd','like','%A19%')
    					->select('id')
    					->get();
    	$penyakit = $query->toArray();
    	$kasus = Kasus::whereBetween('created_at', [$start, $end])
                    ->whereHas('diagnosis', function($q) use ($penyakit){
                        $q->whereIn('icd_10',$penyakit);
                    })->with('pasien.alamat_kota','pasien.alamat_kecamatan','identitas','penunjang_labpk.detail')->get();

        foreach($kasus as $item)
        {
            $tarif = [];
            foreach($item->penunjang_labpk as $item_lab)
            {   
                foreach($item_lab->detail as $item_lab_detail)
                {
                    $tarif[] = $item_lab_detail->tarif_id;
                }
            }
            if(in_array($tarif_hba1c, $tarif)) $item->hba1c = 1;
            else $item->hba1c = 0;
        }

        $data['tbc'] = $kasus;

    	return $data;
    }
}
