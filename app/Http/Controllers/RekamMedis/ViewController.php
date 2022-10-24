<?php

namespace App\Http\Controllers\RekamMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\RekamMedis\Transaksi;

class ViewController extends Controller
{
    public function cariRM()
    {
        return view('rekammedis.cari');
    }


    public function single($no_rm)
    {
        $rm = Pasien::where('no_rm',$no_rm)->first();
        $transaksi = Transaksi::where('pasien_id',$rm->id)->orderBy('created_at','desc')->get();
        $data['rm'] = $rm;
        $data['transaksi'] = $transaksi;
        return view('rekammedis.single',$data);
    }

    public function fileTidakDiRM()
    {
        $rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
        $rm_id = $rm_group->id;

        //rm yang tidak dibawa oleh rekam medis
        $rm1 = Pasien::whereHas('rm_transaksi', function ($query) use ($rm_id){
            $query->from(config('app.db_name').'_rekam_medis.transaksi')->where('holder_group_id','!=', $rm_id);
        })->get();

        //rm yang katanya dibalikin ke rekam medis
        $rm2 = Pasien::whereHas('rm_transaksi', function ($query) use ($rm_id){
            $query->from(config('app.db_name').'_rekam_medis.transaksi')->where('holder_group_id', $rm_id)->whereIn('status',[-2,-1,0,1]);
        })->get();

        $rm1 = $rm1->merge($rm2);

        $data['rm'] = $rm1;
        return view('rekammedis.file-tidak-di-rm.index',$data);
    }
}
