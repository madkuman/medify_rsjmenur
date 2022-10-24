<?php

namespace App\Http\Controllers\Keuangan\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use DB;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        try {
            DB::connection('keuangan')->beginTransaction();
            $id = $request->id;
            $this->deleteAct($id);
            DB::connection('keuangan')->commit();


            $data['url'] = 'keuangan/piutang/';
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Piutang berhasil dihapus.';
            return json_encode($data);
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();     
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi Piutang Gagal Dihapus : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            return json_encode($data);
        }

    }

    public function deleteAct($id,$checkOtherModule = 1)
    {
        $piutang = Piutang::find($id);

        if($checkOtherModule){
            if($piutang->kasus_tagihan_id != null){
                dd('call_kasus_tagihan_update');
                //hilangkan status telah checkout
            }
        }

        $details = PiutangDetail::where('piutang_id',$piutang->id)->get();
        foreach($details as $item)
        {
            $temp = PiutangDetail::find($item->id);
            $temp->delete();
        }
        $piutang->delete();

    }

    public function deleteKasusTagihan($kasus_tagihan_id)
    {
        $piutang = Piutang::where('kasus_tagihan_id',$kasus_tagihan_id)->delete();
        return 1;
    }

    public function reviveData($piutang_id)
    {
        $piutang = Piutang::where('id',$piutang_id)->withTrashed()->first();
        $deleted_at = $piutang->deleted_at;
        $piutang->deleted_at = null;
        $piutang->save();

        $details = PiutangDetail::where('piutang_id',$piutang->id)->where('deleted_at',$deleted_at)->withTrashed()->get();
        foreach($details as $item)
        {
            $temp = PiutangDetail::where('id',$item->id)->withTrashed()->first();
            $temp->deleted_at = null;
            $temp->save();
        }
        return $piutang->id;
    }
}

