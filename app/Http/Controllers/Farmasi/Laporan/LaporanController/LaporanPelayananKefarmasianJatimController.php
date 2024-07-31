<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use App\Models\Farmasi\TransaksiObat;
use App\Models\Kasus\CPPT;
use App\Models\RawatInap\TempatTidur;
use App\Models\RawatInap\Transaksi as TransaksiRawatInap;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Kasus\AlatBantu;
use DB;

class LaporanPelayananKefarmasianJatimController extends Controller
{
    public function get($request)
    {
        $triwulan = $request->triwulan;
        $tahun = $request->tahun;
        $date_start = Carbon::parse((($triwulan-1)*3+1).'/1/'.$tahun);
        $date_end=$date_start->copy()->addMonth(2)->endOfMonth();

        $data['bed']=$this->getBed();
        $data['transaksi_rajal']=$this->getRajal($date_start,$date_end);
        $data['transaksi_ranap']=$this->getRanap($date_start,$date_end);
        $data['kadep_farmasi']=$this->getKadepFarmasi();
        $data['apoteker']=$this->getApoteker();
        $data['ttk']=$this->getTTK();
        $data['s2_farmasi']=$this->getS2Farmasi();
        $data['pio']=$this->getPIO($date_start,$date_end);
        $data['visite']=$this->getVisite($date_start,$date_end);
        $data['konseling']=$this->getKonseling($date_start,$date_end);
        $data['racikan']=$this->getWaktuPelayanan($date_start,$date_end,'racikan');
        $data['non_racikan']=$this->getWaktuPelayanan($date_start,$date_end,'non-racikan');

        return $data;
    }

    private function getRajal($date_start,$date_end){
        $rajal=TransaksiRawatJalan::whereBetween('waktu_pemeriksaan', [$date_start,$date_end])->count();

        return ceil($rajal/3);
    }

    private function getRanap($date_start,$date_end){
        $ranap=TransaksiRawatInap::whereIn('status', [1,3])
            ->where('is_pindah', 0)
            ->where('waktu_masuk', '<', $date_end)
            ->where(function ($q) use ($date_start, $date_end) {
                $q->whereBetween('waktu_keluar', [$date_start,$date_end])
                    ->orWhereNull('waktu_keluar');
            })->count();
        return ceil($ranap/3);
    }

    private function getBed(){
        $bed=TempatTidur::all()->count();
        return $bed;
    }

    private function getKadepFarmasi(){
        return Farmasi::whereNotNull('kasie')->first()->kasie;
    }

    private function getApoteker(){
        return 10;
    }

    private function getTTK(){
        return 11;
    }

    private function getS2Farmasi(){
        return 3;
    }

    private function getPIO($date_start,$date_end){
        $pio=TransaksiObat::wherebetween('created_at',[$date_start,$date_end])->whereNotNull('paid_at')->count();
        return ceil($pio/3);
    }

    private function getVisite($date_start,$date_end){
        $user_farmasi=User::where('profesi',3)->where('fake_account',0)->pluck('id');
        $visite=CPPT::wherein('created_by',$user_farmasi)
            ->wherebetween('created_at',[$date_start,$date_end])
            ->count();
        return ceil($visite/3);
    }

    private function getKonseling($date_start,$date_end){
        $user_farmasi=User::where('profesi',3)->where('fake_account',0)->pluck('id');
        $user_input =AlatBantu::wherebetween('created_at',[$date_start,$date_end])
        ->where('type','edukasi-pasien')
        ->wherein('created_by',$user_farmasi)
        ->pluck('created_by')->toArray();

        $total_user = count($user_input);

        return ceil($total_user);
    }

    private function getWaktuPelayanan($date_start,$date_end,$jenis_resep){
        if($jenis_resep == 'racikan') $query_jenis_resep = "AND is_racikan = 1";
        elseif($jenis_resep == 'non-racikan') $query_jenis_resep = "AND is_racikan = 0";
        $query ="SELECT AVG(waktu_pelayanan) as respone_time
                FROM(
                    SELECT minute(TIMEDIFF(t.lima_benar_at, t.dikerjakan_at )) AS waktu_pelayanan
                    FROM (
                        SELECT * FROM transaksi_obat 
                        WHERE lima_benar_at IS NOT NULL
                        AND dikerjakan_at IS NOT NULL
                        $query_jenis_resep
                        AND dikerjakan_at between '".$date_start->toDateTimeString()."' AND '".$date_end->toDateTimeString()."'
                        ) AS t 
                    ) AS a";

        $waktu_pelayanan= DB::connection('farmasi')->select($query);
        return round($waktu_pelayanan[0]->respone_time);
    }
}
