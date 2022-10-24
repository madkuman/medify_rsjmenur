<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Pasien\AlamatProvinsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi as TransaksiIGD;
use App\Models\RawatInap\Transaksi as TransaksiRI;
use App\Models\RawatJalan\Transaksi as TransaksiRJ;
use App\Models\Kasus\Kasus;
use DB;

class LaporanDemografiController extends Controller
{
	public function get($start,$end,$layanan,$icd10,$usia,$jk)
	{
		$permission = $this->getPermission($layanan);
		
		if($usia=='0-14'){
		    $usia_min=0;
		    $usia_max=(15*365-1);
        }else if ($usia=='15-24'){
		    $usia_min=(15*365);
		    $usia_max=(25*365-1);
        }else if ($usia=='25-44'){
		    $usia_min=(25*365);
		    $usia_max=(45*365-1);
        }else if ($usia=='45-64'){
		    $usia_min=(45*365);
		    $usia_max=(65*365-1);
        }else if($usia=='>65'){
		    $usia_min=(65*365);
		    $usia_max=(1000*365-1);
        }else if($usia=='semua'){
		    $usia_min=0;
		    $usia_max=(1000*365-1);
        }

		if($jk=='semua'){
		    $jenis_kelamin=array(1,2);
        }elseif ($jk==1){
		    $jenis_kelamin=array(1);
        }elseif ($jk==2){
		    $jenis_kelamin=array(2);
        }

		$kasus_id = [];
		if($permission['igd']) $kasus_id = $this->getIGD($start,$end,$usia_min,$usia_max,$jenis_kelamin,$kasus_id);
		if($permission['ri']) $kasus_id = $this->getRI($start,$end,$usia_min,$usia_max,$jenis_kelamin,$kasus_id);
		if($permission['rj']) $kasus_id = $this->getRJ($start,$end,$usia_min,$usia_max,$jenis_kelamin,$kasus_id);

		$kasus_id = array_unique($kasus_id);

		$pasien_id=Kasus::wherein('id',$kasus_id)->distinct('pasien_id')->pluck('pasien_id')->toArray();

		if($icd10=='semua'){
            $with=['kota'=>function($query){
                $query->orderBy('nama');
            },'kota.kecamatan'=>function($query){
                $query->orderBy('nama');
            },'kota.kecamatan.pasien'=>function($query) use ($pasien_id){
                $query->select('id','district','gender')
                    ->wherein('id',$pasien_id);
            },'kota.kecamatan.pasien.kasus'=>function($query) use ($kasus_id,$icd10){
                $query->select('id','pasien_id')
                    ->wherein('id',$kasus_id);
            }];
        }else{
            $with=['kota'=>function($query){
                $query->orderBy('nama');
            },'kota.kecamatan'=>function($query){
                $query->orderBy('nama');
            },'kota.kecamatan.pasien'=>function($query) use ($pasien_id){
                $query->select('id','district','gender')
                    ->wherein('id',$pasien_id);
            },'kota.kecamatan.pasien.kasus'=>function($query) use ($kasus_id,$icd10){
                $query->select('id','pasien_id')
                    ->wherein('id',$kasus_id)
                    ->whereHas('diagnosis',function($q) use ($icd10){
                        $q->wherein('icd_10',$icd10);
                    });
            }];
        }

        $relasi_transaksi_igd=['kota.kecamatan.pasien.kasus.TransaksiIGD' => function($query){
            $query->select('id','kasus_id','usia_masuk');
        }];
        $relasi_transaksi_rawat_jalan=['kota.kecamatan.pasien.kasus.TransaksiRawatJalan' => function($query){
            $query->select('id','kasus_id','usia_masuk');
        }];
        $relasi_transaksi_rawat_inap=['kota.kecamatan.pasien.kasus.TransaksiRawatInap' => function($query){
            $query->select('id','kasus_id','usia_masuk');
        }];
        if($layanan=='igd'){
            $with=array_merge($with,$relasi_transaksi_igd);
        }elseif($layanan=='rj'){
            $with=array_merge($with,$relasi_transaksi_rawat_jalan);
        }elseif ($layanan=='ri'){
            $with=array_merge($with,$relasi_transaksi_rawat_inap);
        }else{
            $with=array_merge($with,$relasi_transaksi_igd);
            $with=array_merge($with,$relasi_transaksi_rawat_jalan);
            $with=array_merge($with,$relasi_transaksi_rawat_inap);
        }

        $data=AlamatProvinsi::with($with)->orderBy('nama')->get();
		return $data;
	}

	private function getPermission($layanan)
	{
		$permission['igd'] = $permission['rj'] = $permission['ri'] = 0;
		if($layanan == 'igd') $permission['igd'] = 1;
		elseif($layanan == 'rj') $permission['rj'] = 1;
		elseif($layanan == 'ri') $permission['ri'] = 1;
		else{
			$permission['igd'] = $permission['rj'] = $permission['ri'] = 1;
		}
		return $permission;

	}

	private function getIGD($start,$end,$usia_min,$usia_max,$jenis_kelamin,$kasus_id)
    {
		$transaksi = TransaksiIGD::whereBetween('waktu_masuk',[$start,$end])->whereBetween('usia_masuk',[$usia_min,$usia_max])->whereNotNull('pasien_id')->whereHas('pasien',function($q) use ($jenis_kelamin){
			$q->from(config('app.db_name').'_patients.pasien')->wherein('gender',$jenis_kelamin)->where('city','!=',0)->where('district','!=',0);
		})->pluck('kasus_id')->toArray();
		if(count($transaksi)>0) $kasus_id=array_merge($kasus_id,$transaksi);

		return $kasus_id;
	}

	private function getRJ($start,$end,$usia_min,$usia_max,$jenis_kelamin,$kasus_id)
	{
		$transaksi = TransaksiRJ::whereBetween('waktu_masuk',[$start,$end])->whereBetween('usia_masuk',[$usia_min,$usia_max])->where('status','>',0)->whereHas('pasien',function($q) use ($jenis_kelamin){
			$q->from(config('app.db_name').'_patients.pasien')->wherein('gender',$jenis_kelamin)->where('city','!=',0)->where('district','!=',0);
		})->pluck('kasus_id')->toArray();
        if(count($transaksi)>0) $kasus_id=array_merge($kasus_id,$transaksi);

		return $kasus_id;
	}

	private function getRI($start,$end,$usia_min,$usia_max,$jenis_kelamin,$kasus_id)
	{
		$transaksi = TransaksiRI::whereBetween('waktu_masuk',[$start,$end])->whereBetween('usia_masuk',[$usia_min,$usia_max])->where('status',1)->whereHas('pasien',function($q) use ($jenis_kelamin){
			$q->from(config('app.db_name').'_patients.pasien')->wherein('gender',$jenis_kelamin)->where('city','!=',0)->where('district','!=',0);
		})->pluck('kasus_id')->toArray();
        if(count($transaksi)>0) $kasus_id=array_merge($kasus_id,$transaksi);

		return $kasus_id;
	}
}
