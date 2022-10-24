<?php

namespace App\Http\Controllers\Urikkes\Laporan;

use App\Models\Urikkes\TransaksiDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\Transaksi;
use App\Models\Pasien\TNIPangkat;
use App\Models\Pasien\TNISatker;
use DB;

class ReadController extends Controller
{
    public function getRiwayat($request)
    {
    	$res = $this->filter($request)
    				->join(config('app.db_name').'_patients.tni_pangkat', 'tni_pangkat.id', '=', 'pasien.tni_pangkat_id')
    				->whereNotNull('tni_pangkat.jenjang')
                    ->orderBy(config('app.db_name').'_patients.pasien.tni_satker_id', 'DESC')
                    ->orderBy(config('app.db_name').'_patients.pasien.id', 'ASC')
                    ->orderBy(config('app.db_name').'_urikkes.transaksi.id', 'ASC')
					->get();
    	return $res;
    }

    public function getPasienUmum($request)
    {
        $res = $this->filter($request, TRUE)
                    ->join(config('app.db_name').'_patients.tni_pangkat', 'tni_pangkat.id', '=', 'pasien.tni_pangkat_id')
                    ->whereNotNull('tni_pangkat.jenjang')
                    ->orderBy(config('app.db_name').'_patients.pasien.tni_satker_id', 'DESC')
                    ->orderBy(config('app.db_name').'_patients.pasien.id', 'ASC')
                    ->orderBy(config('app.db_name').'_urikkes.transaksi.id', 'ASC')
                    ->get();
        return $res;
    }

    public function getRekap($request)
    {  	
    	$arr_stakes = array(['I', 'IP'], ['II'], ['IIP'], ['IIIP'], ['III'], ['IV', 'IVP']);
    	$arr_pangkat = array(
    			//jenjang Militer 												total
    			['1'], ['16'], ['17'], ['18'], ['3'], ['4', '5'], ['6', '7'], 	['0'],
    			//jenjang PNS 																total
    			['8'], ['9'], ['10'], ['11'], ['12'], ['13'], ['14'],         	['0'], 		['-1']);

    	$arr_intensif = array(
    					['1', '16', '8', '9'], 
    					['17', '18', '10', '11'],
    					['3', '4', '5', '6', '7', '12', '13', '14']);

    	$all = $this->filter($request)
						->join(config('app.db_name').'_patients.tni_pangkat', 'tni_pangkat.id', '=', 'pasien.tni_pangkat_id');

		$rencana_query = $all->select(DB::raw('count(*) as jumlah'), 'pasien.tni_pangkat_id', 'tni_pangkat.jenjang')
					->groupBy('pasien.tni_pangkat_id')->get();
    	$dilakukan =0;
    	$rencanaHasil = 0;

    	//rencana
    	foreach ($arr_intensif as $key => $intensif) {
    		$hasil_rencana_intensif[$key] = 0;
    		foreach ($rencana_query as $rencana) {
    			if(in_array($rencana->jenjang, $intensif)){
    				$hasil_rencana_intensif[$key] += $rencana->jumlah;
    				$rencanaHasil+=$rencana->jumlah;
    			}
    		}
    	}
    	$data['rencana']=$hasil_rencana_intensif;
    	$data['rencana']['total'] = $rencanaHasil;
		//ngeget yg di lakukan
		$totalDilakukan = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
								0, 0, 0, 0, 0, 0, 0);
    	foreach($arr_stakes as $key => $stakes) {
			$dilakukan_query = (clone $all)
					->select(DB::raw('count(*) as jumlah'), 'pasien.tni_pangkat_id', 'tni_pangkat.jenjang')
					->groupBy('pasien.tni_pangkat_id')
					->hasStakes($stakes)->get();
			$subtotal=0;
			$total=0;
			foreach ($arr_pangkat as $key2 => $pangkat) {
				$hasil[$key2]=0;
				if(in_array('-1', $pangkat)){
					$hasil[$key2] = $total;
					$totalDilakukan[$key2] += $total;
				}elseif(in_array('0', $pangkat)){
					$hasil[$key2] = $subtotal;
					$totalDilakukan[$key2] += $subtotal;
					$subtotal = 0;
				}else{
					foreach ($dilakukan_query as $key3 => $transaksi) {
						if(in_array($transaksi->jenjang, $pangkat)){
							$hasil[$key2] += $transaksi->jumlah;
							$totalDilakukan[$key2] += $transaksi->jumlah;
							$total +=$transaksi->jumlah;
							$dilakukan +=$transaksi->jumlah;
							$subtotal+=$transaksi->jumlah;
						}
					}
				}
			}
			$data['stakes'][$key] = $hasil;
    	}
    	$data['subtotal'] = $totalDilakukan;
    	return $data;
    }
    
    public function getDiskesal(Request $request)
    {
        $res = $this->filter($request)
                    ->with(['kasus.identitas', 'kasus.fisikUrikkes'])
                    ->get();
        return $res;
    }

    public function filter(Request $request, $umum = FALSE)
    {
    	$res = Transaksi::with([ 'kasus.resumeUrikkes', 'kasus.telingaUrikkes',
                                 'kasus.mataUrikkes', 'pasien_detail.tni_satker'])
    					->join(config('app.db_name').'_patients.pasien', 'pasien_id', '=', 'pasien.id')
    					->where('status', 1)
						->where('pasien.is_anggota', 1);

        $date_min = date("Y-m-d H:i:s", strtotime($request->tanggal_min));
        $date_max = date("Y-m-d H:i:s", strtotime($request->tanggal_max."+1 days"));
    	if(!empty($request->tanggal_min)){
    		$res = $res->where('transaksi.created_at', '>=', $date_min);
    	}
    	if(!empty($request->tanggal_max)){
    		$res = $res->where('transaksi.created_at', '<=', $date_max);
    	}

        if ($umum) {
            //BIARIN AJA
        }
    	else if($request->get_by == 'nrp'){
    		// $nrp_min = $request->nrp_min;
    		// $nrp_max = $request->nrp_max;
    		$nrp = explode(',', $request->nrp);

            $res = $res->whereIn('pasien.tni_nrp', $nrp);
    		// if(!empty($nrp_min) && !empty($nrp_max)){
    		// 	$arr = array($nrp_min, $nrp_max);
	    	// 	$res = $res->whereBetween('pasien.tni_nrp', $arr);
    		// }
    		// elseif(empty($nrp_min) && !empty($nrp_max)){
	    	// 	$res = $res->where('pasien.tni_nrp', '<=', $nrp_max);
    		// }
    		// elseif(empty($nrp_max) && !empty($nrp_min)){
	    	// 	$res = $res->where('pasien.tni_nrp', '>=', $nrp_min);
    		// }
    	}
        else if($request->get_by == 'satker-pilihan' || $request->get_by_rekap == 'satker-pilihan')
        {
            $satker = TNISatker::where('cetak',1)->pluck('id')->toArray();
            $res = $res->whereIn('pasien.tni_satker_id',$satker);
        }
        else
        {
    		$satker = $request->satker;
    		$kesatuan = $request->kesatuan;
    		if(!empty($satker)){
                $res = $res->where('pasien.tni_satker_id', $satker);
            }
            if(!empty($kesatuan)){
                $res = $res->where('pasien.tni_kotama_id', $kesatuan);
            }
    	}
        // dd($res->get(), $request);
    	return $res;
    }

    public function getPamenPnsJiwaTreadmill($tanggal_min,$tanggal_max){
        $pangkat_pamen = [42,43,44];
        $pangkat_gol4 = TNIPangkat::where('nama','like','%IV%')->orWhere('nama','like','%iv%')->orWhere('nama','like','%Iv%')->pluck('id')->toArray();

        $pangkat = array_merge($pangkat_gol4,$pangkat_pamen);

        $transaksi = Transaksi::where('status',1)->whereBetween('ordered_at',[$tanggal_min,$tanggal_max])->whereHas('pasien_detail',function ($q) use ($pangkat){
            $q->from(config('app.db_name').'_patients.pasien')->whereIn('tni_pangkat_id',$pangkat);
        })->get();

        return $transaksi;
    }

    
    public function getRekapTransaksi($tanggal_min,$tanggal_max)
    {
        $data = Transaksi::whereBetween('ordered_at',[$tanggal_min,$tanggal_max])->where('status',1)->orderBy('ordered_at')->with(['pasien_detail','dokter','transaksi_detail.paket'])->get();
        return $data;
    }
}
