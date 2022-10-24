<?php

namespace App\Http\Controllers\Kasus\Penunjang;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Penunjang;
use App\Models\Kasus\PenunjangKomentar;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;
use Auth;

class CreateController extends Controller
{
	public function createData($file_url,$title,$caption,$kasus_id,$file_type,$type,$permintaan_id, $thumbnail=null)
	{
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
    		$penunjang = new Penunjang;
    		$penunjang->judul = $title;
    		$penunjang->caption = $caption;
    		$penunjang->kasus_id = $kasus_id;
    		$penunjang->file = $file_url;
    		$penunjang->file_primary = $file_url;
    		$penunjang->file_thumb = is_null($thumbnail) ? $file_url : $thumbnail;
    		$penunjang->type = $type;
    		$penunjang->file_type = $file_type;
    		$penunjang->penunjang_permintaan_id = $permintaan_id;
            $penunjang->created_by = Auth::user()->id;
    		$penunjang->save();

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $penunjang;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}

    public function new(Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $tujuan_permintaan = $request->input('tujuan_permintaan');
            $request->merge(['services' => $request->input('layanan'), 'kasus_lokasi' => $request->input('asal_ruang'), 'pasien_id' => $request->input('pasien')]);
            $kasus = Kasus::find($request->kasus_id);
            $request->merge([
                'pasien_pembayaran_id' => $kasus->pembayaran->id,
                'tanggal_periksa' => !is_null($request->tanggal_periksa) ? Carbon::createFromFormat('d-m-Y',$request->tanggal_periksa) : null
            ]);


            if ($tujuan_permintaan==1) {
                $new_radiologi = app('App\Http\Controllers\Radiology\Transaction\CreateController')->APICreate($request);
                if($new_radiologi) {
                    $new_transaksi = app('App\Http\Controllers\Kasus\PenunjangPermintaan\CreateController')->radiologi($request, $new_radiologi);
                }else{
                    return back()->with('message', 'Gagal membuat permintaan baru')
                    ->with('title','Gagal')
                    ->with('status', '-1');
                }
            }
            else if($tujuan_permintaan==2) {
                $new_labpa = app('App\Http\Controllers\LabPA\Transaction\CreateController')->APICreate($request);
                if($new_labpa) {
                    $new_transaksi = app('App\Http\Controllers\Kasus\PenunjangPermintaan\CreateController')->labpa($request, $new_labpa);
                }else{
                    return back()->with('message', 'Gagal membuat permintaan baru')
                    ->with('title','Gagal')
                    ->with('status', '-1');
                }
            }
            else if($tujuan_permintaan==3) {
                $new_labpk = app('App\Http\Controllers\LabPK\Transaksi\CreateController')->APICreate($request);
                if($new_labpk instanceof \Illuminate\Database\Eloquent\Model) {
                    $new_transaksi = app('App\Http\Controllers\Kasus\PenunjangPermintaan\CreateController')->labpk($request, $new_labpk);
                }else{
                    return back()->with('message', 'Gagal membuat permintaan pada LIS')
                    ->with('title','Gagal')
                    ->with('status', '-1');
                }
            }

            if(!is_null($kasus->urikkes_penunjang_baru))
                app('App\Http\Controllers\Urikkes\Transaksi\CreateController')->updateStatusPenunjang($kasus->urikkes_penunjang_baru->id);
            $status = 1;
            $message = 'Permintaan baru berhasil dibuat!';
            $title = 'Berhasil!';
        

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect(url('kasus').'/'.$kasus->nomor_kasus.'/penunjang#permintaan')->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            return back()->with('message', 'Gagal membuat permintaan baru')
                ->with('title','Gagal')
                ->with('status', '-1');
        }
    }

    public function insertKomentar($penunjang_id, $comment)
    {
        try {
            $new_comment = new PenunjangKomentar;
            $new_comment->penunjang_id = $penunjang_id;
            $new_comment->konten = $comment;
            $new_comment->created_by = Auth::user()->id;
            $new_comment->save();
            return $new_comment;
        } catch (Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;                    
        }
    }
}
