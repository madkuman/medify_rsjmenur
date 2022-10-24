<?php

namespace App\Http\Controllers\CSSD\AlkesSatuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\AlkesSatuan;
use App\Models\CSSD\AlkesSatuanLog;

class EditController extends Controller
{
    public function editOkTransaksiIDbySlug($slugs,$ok_transaksi_id,$transaksi_id)
    {
        if(count($slugs) > 0)
        {
            foreach($slugs as $slug)
            {
                $satuan = AlkesSatuan::where('slug',$slug)->first();
                $satuan->ok_transaksi_id = $ok_transaksi_id;
                $satuan->jumlah_pemakaian = $satuan->jumlah_pemakaian + 1;
                $satuan->save();

                $transaksi = app('App\Http\Controllers\CSSD\AlkesSatuanLog\CreateController')->createSingle($transaksi_id,$satuan->id);
            }
        }

        return 1;
    }

    public function editNullOkTransaksiIDbySlug($slugs)
    {
        foreach($slugs as $slug)
        {
            $satuan = AlkesSatuan::where('slug',$slug)->first();
            $satuan->ok_transaksi_id = null;
            $satuan->save();


        }

        return 1;
    }



    public function deleteKirimanAlkes($transaksi_id, $alkes_id)
    {
        foreach($alkes_id as $id)
        {
            $satuan = AlkesSatuan::find($id);
            if(!empty($satuan->jumlah_pemakaian))
            {
                $satuan->jumlah_pemakaian = $satuan->jumlah_pemakaian - 1;
                $satuan->ok_transaksi_id = null;
                $satuan->save();

                $transaksi = app('App\Http\Controllers\CSSD\AlkesSatuanLog\DeleteController')->delete($transaksi_id,$id);
            }
        }

        return 1;
    }

    public function revertOkTransaksiIDtoLastLog($transaksi_id,$alkes_satuan_id)
    {
        foreach($alkes_satuan_id as $id)
        {
            $log = AlkesSatuanLog::where('alkes_satuan_id',$id)->orderBy('id','desc')->first();
            if(!empty($log->transaksi->ok_transaksi_id))
            {
                $satuan = AlkesSatuan::find($id);
                $satuan->ok_transaksi_id = $log->transaksi->ok_transaksi_id;
                $satuan->save();
            }
        }
    }
}
