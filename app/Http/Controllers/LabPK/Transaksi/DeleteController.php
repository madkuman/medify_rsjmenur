<?php

namespace App\Http\Controllers\LabPK\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\Dokumen;
use Bugsnag;
use Carbon\Carbon;
use DateTime;
use DB;
use Auth;

class DeleteController extends Controller
{
    public function cancelTransaksi(Request $req, $slug)
    {
        $transaction = Transaksi::where('slug', $slug)->first();
    	if(!$transaction)
    		return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    	try {
            DB::connection('lab_pk')->beginTransaction();
            $transaction->alasan_batal = $req['alasan_batal'];
    		$transaction->status = -1;
            $transaction->result_created_at = Carbon::now();
            $transaction->result_created_by = Auth::user()->id;
            
            $backup_transaction = $transaction;
            $backup_detail = $transaction->detail;
            foreach ($transaction->detail as $detail){
                if($detail->tagihan_detail_id){
                    app('App\Http\Controllers\Kasus\TagihanDetail\DeleteController')->deleteFromCppt(null,$detail->tagihan_detail_id);
                }
            }

            if($transaction->piutang_id){
                app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteAct($transaction->piutang_id);
            }

            $transaction->save();
            if(config('app.lis_enable')){
                $data = app('App\Http\Controllers\LabPK\LIS\PostController')->cancelOrder($backup_transaction, $backup_detail);
            }
            DB::connection('lab_pk')->commit();

            if(empty($req->dariKasus))
    			return redirect('labpk')->with('success', 'Berhasil Menghapus Transaksi');
            else
                return back()->with('success', 'Berhasil Menghapus Transaksi');

    	} catch (\Exception $e) {
            DB::connection('lab_pk')->rollback();
            if(config('app.debug'))
                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect()->back()->with('error', 'Gagal Menghapus Transaksi');
    	}
    }
    public function cancelKrs($kasus,$alasan)
    {
        $transaction = Transaksi::where('kasus_id',$kasus)
                                ->where('status',0)->get();
        try {
            DB::connection('lab_pk')->beginTransaction();
            foreach ($transaction as $t) 
            {
                $t->alasan_batal = $alasan;
                $t->status = -1;
                $t->result_created_at = Carbon::now();
                $t->result_created_by = Auth::user()->id;
                $t->save();
            }
            DB::connection('lab_pk')->commit();
            return;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('lab_pk')->rollback();
            return redirect()->back()->with('error', 'Gagal Menghapus Transaksi');
        }   
    }

    public function deletePenunjang(Request $req){
        try {
            $folder = public_path();
            $penunjang = Dokumen::find($req['id']);
            if(!is_null($penunjang->penunjang_id)){
                $penunjang_id = $photo->penunjang_id;
                if(!is_null($photo->penunjang))
                    app('App\Http\Controllers\Kasus\Penunjang\DeleteController')->delete($penunjang_id);
            }
            if(file_exists($folder.'/'.$penunjang->path)) //DEVELOPMENT NEEDS
                unlink($folder.'/'.$penunjang->path);
            if($penunjang->delete())
                return redirect()->back();
        } catch (Exception $e) {
            if(config('app.debug'))
                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect()->back();
        }
    }
}