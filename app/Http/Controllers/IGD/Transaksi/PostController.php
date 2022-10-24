<?php

namespace App\Http\Controllers\IGD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi;
use App\Models\IGD\Ruangan;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\TransaksiMasuk as GlobalTransaksiMasuk;
use App\Models\Hospital\TransaksiMasukDetail as GlobalTransaksiMasukDetail;
use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\Kasus\TagihanDetail;
use Carbon\Carbon;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
    

    public function rujukRuang(Request $request)
    {
        DB::connection('igd')->beginTransaction();
        DB::connection('rekammedis')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('kasir')->beginTransaction();
        try
        {
            $pasien_id = $request->input('pasien_id');
            $ruangan_id = $request->input('ruangan_id');
            $kasus_id=$request->input('kasus_id');


            $transaksi_old = Transaksi::where('kasus_id',$kasus_id)->orderBy('id','desc')->first();
            

            $transaksi_old->ruangan_id = $ruangan_id;
            $transaksi_old->save();
            
            $transaksi_rm = $this->permintaanRekamMedis($transaksi_old);
            $transaksi_old->rm_transaksi_id= $transaksi_rm->id;
            $transaksi_old->save();

            # TODO byepass pindah ruangan gizi
            // app('App\Http\Controllers\Gizi\Pemesanan\PostController')->pindahRuangan($kasus_id,$ruangan_id);
            $kasus = Kasus::find($kasus_id);
            
            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'create','administrasi-igd-pindah',$transaksi_old->id);


            $status = 1;
            $message = 'Pasien berhasil didaftarkan ke dalam ruangan.';
            $title = 'Berhasil!';

        
            DB::connection('igd')->commit();
            DB::connection('rekammedis')->commit();
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('kasir')->commit();
            return redirect('igd/ruangan/'.$ruangan_id)
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('igd')->rollback();
            DB::connection('rekammedis')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            DB::connection('kasir')->rollback();
            
        }
    }

    private function permintaanRekamMedis($transaksi)
    {
        $holder_group_id = $transaksi->ruangan->group_id;
        $lokasi = $transaksi->ruangan->lokasi->nama;

        $data_rm = [];
        $data_rm['pasien_id'] = $transaksi->pasien_id;
        $data_rm['status'] = 1; //konfirm pengiriman
        $data_rm['holder_type'] = 2; //group
        $data_rm['holder_user_id'] = null;
        $data_rm['holder_group_id'] = $holder_group_id;
        $data_rm['holder_keterangan'] = null;

        $data_rm['tujuan_id'] = 1; //Pelayanan pasien
        $data_rm['lokasi'] = $lokasi;
        $data_rm['jenis'] = 2;//transfer

        $data_rm['sender_confirmed_at'] = Carbon::now();
        $data_rm['sender_confirmed_by'] = Auth::user()->id;
        $data_rm['sender_keterangan'] = null;

        $rm_trans = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data_rm);
        return $rm_trans;
    }

    
    public function konfirmasiFile($transaksi_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->konfirmasiPenerimaan($transaksi->rm_transaksi_id);
        $status = 1;
        $message = $data['message'];
        $title = 'Berhasil!';

        return back()
        ->with('message', $message)
        ->with('active_nav','cppt')
        ->with('title',$title)
        ->with('status', $status);
        return back();
    }

    
    public function updatePengisian($transaksi_id,$nomor_kasus) //update updated_at transaksi igd. lalu redirect ke kasus
    {
        DB::connection('igd')->beginTransaction();
        try 
        {   
            $update = app('App\Http\Controllers\IGD\Transaksi\EditController')->updateWaktuEntry($transaksi_id);
            DB::connection('igd')->commit();
            return redirect('kasus/'.$nomor_kasus);
        } 
        catch (Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('igd')->rollback();  
        }
    }
}
