<?php

namespace App\Http\Controllers\RekamMedis\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis\Transaksi;
use App\Models\Pasien\Pasien;
use DB;
use Auth;

class ReadController extends Controller
{
    public function getMyRM($holder_type,$holder_id)
    {
        //menghasilkan RM mana saja yang dibawa holder_id
        if($holder_type == 1)
        {
            $status = [1,2];
            $myrm = Pasien::whereHas('rm_transaksi', function ($query) use ($holder_id,$status){
                $query->from(config('app.db_name').'_rekam_medis.transaksi')->where('holder_user_id', $holder_id)->whereIn('status',$status);
            })->get();

            //ngirim tapi di konfirmasi ga nerima sama yang nerima
            $myrm_send = Pasien::whereHas('rm_transaksi', function ($query) use ($holder_id,$status){
                $query->from(config('app.db_name').'_rekam_medis.transaksi')->where('sender_confirmed_by', $holder_id)->where('status',-2);
            })->get();
            $myrm = $myrm->merge($myrm_send);
        }
        else
        {
            $myrm = Pasien::whereHas('rm_transaksi', function ($query) use ($holder_id){
                $query->from(config('app.db_name').'_rekam_medis.transaksi')->whereIn('holder_group_id', $holder_id);
            })
            //->orWhereNull('rm_transaksi_id') -> jika yang di RM mau di show
            ->get();
        }

        return $myrm;

    }

    public function isRMHolder($pasien_id)
    {  
        $user_id = Auth::user()->id;
        $my_group = app('App\Http\Controllers\Group\Members\ReadController')->getMyGroup($user_id);

        $myrm = Pasien::whereHas('rm_transaksi', function ($query) use ($my_group,$user_id){
            $query->from(config('app.db_name').'_rekam_medis.transaksi')->whereIn('holder_group_id', $my_group)->orWhere('holder_user_id',$user_id);
        })->get();
        /*

        $groups = $this->getMyRM(2,$my_group);
        $user = $this->getMyRM(1,$user_id);

        $all_rm = $groups->merge($user);
        $all_rm_id = $all_rm->pluck('id');

        $my_rm_array = array();
        foreach($all_rm_id as $item)
        {
            array_push($my_rm_array, $item);
        }
        
        $data = in_array($pasien_id, $my_rm_array);
        */

        $pasien_ids = $myrm->pluck('id')->toArray();

        $data = in_array($pasien_id, $pasien_ids);
        return $data;
    }

    public function getLastTransaksi($no_rm)
    {
        $rm = Pasien::where('no_rm',$no_rm)->first();
        if(!empty($rm->rm_transaksi)) return $rm->rm_transaksi;
        else return 0;
    }

    public function get($id)
    {
        $rekammedis = Transaksi::find($id);
        return $rekammedis;
    }
}
