<?php

namespace App\Http\Controllers\Radiology\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\Transaction;
use App\Models\Radiology\Photo;
use DB;
use Bugsnag;
use DateTime;
use Auth;
use Carbon\Carbon;

class DeleteController extends Controller
{
    public function cancelTransaction(Request $req, $slug)
    {
        $transaction = Transaction::where('slug', $slug)->first();
    	if(!$transaction)
    		return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    	try {
            DB::connection('radiology')->beginTransaction();
            $transaction->alasan_batal = $req['alasan_batal'];
            $transaction->status = -1;
            $transaction->result_created_at = Carbon::now();
            $transaction->result_created_by = Auth::user()->id;
            foreach ($transaction->detail as $detail){
                if($detail->tagihan_detail_id){
                app('App\Http\Controllers\Kasus\TagihanDetail\DeleteController')->deleteFromCppt(null,$detail->tagihan_detail_id);
                }
            }
            if($transaction->piutang_id){
                app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteAct($transaction->piutang_id);
            }
    		if($transaction->save() && empty($req->dariKasus)){
                DB::connection('radiology')->commit();
    			return redirect('radiologi')->with('success', 'Berhasil Menghapus Transaksi');
            }
            else if($transaction->save() && !empty($req->dariKasus))
            {
                DB::connection('radiology')->commit();
                return back()->with('success', 'Berhasil Menghapus Transaksi');   
            }
            DB::connection('radiology')->rollback();
			return redirect()->back()->with('error', 'Gagal Menghapus Transaksi');
    	} catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('radiology')->rollback();
			return redirect()->back()->with('error', 'Gagal Menghapus Transaksi');
    	}
    }
    public function cancelKrs($kasus,$alasan)
    {
        $transaction = Transaction::where('kasus_id',$kasus)
        ->where('status',0)->get();
        
        foreach ($transaction as $t) 
        {
            $t->alasan_batal = $alasan;
            $t->status = -1;
            $t->result_created_at = Carbon::now();
            $t->result_created_by = Auth::user()->id;
            $t->save();
        }
        return 1;
    }

    public function deletePenunjang(Request $req){
        try {
            DB::connection('radiology')->beginTransaction();
            DB::connection('kasus')->beginTransaction();
            $folder = public_path();
            $photo = Photo::find($req['id']);
            if(!is_null($photo->penunjang_id)){
                $penunjang_id = $photo->penunjang_id;
                if(!is_null($photo->penunjang))
                    app('App\Http\Controllers\Kasus\Penunjang\DeleteController')->delete($penunjang_id);
            }
            if(file_exists($folder.'/'.$photo->path)) //DEVELOPMENT NEEDS
                unlink($folder.'/'.$photo->path);
            if($photo->delete()){
                DB::connection('radiology')->commit();
                DB::connection('kasus')->commit();                
                return redirect()->back();
            }
        } catch (Exception $e) {
            DB::connection('radiology')->rollback();
            DB::connection('kasus')->rollback();
            if(config('app.debug'))
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect()->back();
        }
    }
}