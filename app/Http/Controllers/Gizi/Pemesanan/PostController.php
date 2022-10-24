<?php

namespace App\Http\Controllers\Gizi\Pemesanan;

use App\Models\Hospital\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Pemesanan;
use App\Models\Kasus\Kasus;
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class PostController extends Controller
{

    public function addPemesanan(Request $request)
    {
        DB::connection('gizi')->beginTransaction();
        try {

            $date1 = $request->input('daterange1');
            $date2 = $request->input('daterange2');

            if ($request->input('waktu_pagi')) {
                $data['waktu_pagi'] = 1;
            } else {
                $data['waktu_pagi'] = 0;
            }

            if ($request->input('waktu_siang')) {
                $data['waktu_siang'] = 1;
            } else {
                $data['waktu_siang'] = 0;
            }

            if ($request->input('waktu_sore')) {
                $data['waktu_sore'] = 1;
            } else {
                $data['waktu_sore'] = 0;
            }

            $kasus = Kasus::find($request->input('kasus_id'));
            $data['pembayaran_perusahaan_id'] = $kasus->pembayaran->perusahaan_id;
            $data['lokasi_id'] = $kasus->lokasi->lokasi->id;
            $data['gender'] = $kasus->pasien->gender;
            if(isset($kasus->lokasi->lokasi->ruangan->bangsal)){
                $data['bangsal_id'] = $kasus->lokasi->lokasi->ruangan->bangsal->id;
                $data['ruangan_id'] = $kasus->lokasi->lokasi->ruangan->id;
                $data['kelas_id'] = $kasus->lokasi->lokasi->ruangan->kelas;
            }else{
                $status = -1;
                $message = 'Pemesanan gagal di buat. Pemesanan diet hanya untuk kasus rawat inap';
                $title = 'Gagal!';
                return redirect()->back()
                    ->with('status', $status)
                    ->with('message', $message)
                    ->with('title', $title);
            }
            $data['catatan'] = $request->input('catatan');
            $data['pasien_id'] = $request->input('pasien');
            $data['kasus_id'] = $request->input('kasus_id');
            $data['diet_id'] = $request->input('diet');
            $data['jenis_makanan_id'] = $request->input('jenis_makanan_id');
            $data['makanan_tambahan_ids'] = $request->input('makanan_tambahan_ids');

            $date1 = explode("/", $date1);
            $temp = $date1[0];
            $date1[0] = $date1[2];
            $date1[2] = $temp;
            $date1 = implode("-", $date1);
            $date2 = explode("/", $date2);
            $temp = $date2[0];
            $date2[0] = $date2[2];
            $date2[2] = $temp;
            $date2 = implode("-", $date2);

            $period = CarbonPeriod::create($date1, $date2);
            foreach ($period as $key) {
                $data['jadwal_pengantaran'] = Carbon::parse($key)->format('Y-m-d');
                app('App\Http\Controllers\Gizi\Pemesanan\CreateController')->pemesanan($data);
            }

            DB::connection('gizi')->commit();
            $status = 1;
            $message = 'Pemesanan berhasil di buat.';
            $title = 'Berhasil!';
            return redirect('gizi/pemesanan/')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            DB::connection('gizi')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Pemesanan gagal di buat.';
            $title = 'Gagal!';
            return redirect()->back()
                ->with('status', $status)
                ->with('message', $message)
                ->with('title', $title);
        }
    }

    public function edit(Request $request)
    {
        DB::connection('gizi')->beginTransaction();
        try{
            $data['pemesanan_detail_id']=$request->pemesanan_detail_id;
            $data['diet_id'] = $request->input('diet_id');
            $data['jenis_makanan_id'] = $request->input('jenis_makanan_id');
            $data['makanan_tambahan_ids'] = $request->input('makanan_tambahan_ids');
            $data['catatan'] = $request->input('catatan');

            app('App\Http\Controllers\Gizi\Pemesanan\EditController')->edit($data);
            DB::connection('gizi')->commit();
            $status = 1;
            $message = 'Edit Berhasil';
            $title = 'Berhasil!';
        }catch (\Exception $e) {
            DB::connection('gizi')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }

    public function delete(Request $request)
    {
        DB::connection('gizi')->beginTransaction();
        try{
            app('App\Http\Controllers\Gizi\Pemesanan\DeleteController')->deleteKasus($request->pemesanan_detail_id);
            DB::connection('gizi')->commit();
            $status = 1;
            $message = 'Hapus Berhasil';
            $title = 'Berhasil!';
        }catch (\Exception $e) {
            DB::connection('gizi')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }

    public function batal(Request $request)
    {
      //dd($request);
      $counter = 0;
      $data['jumlah'] = $request->input('jumlah');
      $data['id'] = $request->input('id');
      $data['makan_pagi'] = $request->input('waktu_pagi');
      $data['makan_siang'] = $request->input('waktu_siang');
      $data['makan_sore'] = $request->input('waktu_sore');
      $data['snack_pagi'] = $request->input('snack_pagi');
      $data['snack_sore'] = $request->input('snack_sore');
      //dd($data);
      
      DB::connection('gizi')->beginTransaction();
      try
      {
        $counter = $counter + app('App\Http\Controllers\Gizi\Pemesanan\EditController')->pembatalan($data['id'],$data['makan_pagi']);
        $counter = $counter + app('App\Http\Controllers\Gizi\Pemesanan\EditController')->pembatalan($data['id'],$data['makan_siang']);
        $counter = $counter + app('App\Http\Controllers\Gizi\Pemesanan\EditController')->pembatalan($data['id'],$data['makan_sore']);
        $counter = $counter + app('App\Http\Controllers\Gizi\Pemesanan\EditController')->pembatalan($data['id'],$data['snack_pagi']);
        $counter = $counter + app('App\Http\Controllers\Gizi\Pemesanan\EditController')->pembatalan($data['id'],$data['snack_sore']);

        //dd($counter);
        if($counter == $data['jumlah'])
        {
          $pemesanan = Pemesanan::where('id',$data['id'])->first();
          $pemesanan->delete();

          DB::connection('gizi')->commit();

          return redirect('/gizi/pemesanan/')
                              ->with('message','Pesanan berhasil dihapus')
                              ->with('status', 1)
                              ->with('title', 'Sukses');
        }

        else
        {
          DB::connection('gizi')->commit();

          return redirect('/gizi/pemesanan/'.$data['id'].'')
                              ->with('message','Pesanan berhasil dibatalkan')
                              ->with('status', 1)
                              ->with('title', 'Sukses');
        }
      }

      catch(\Exception $e)
      {
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        DB::connection('gizi')->rollback();
      }
    }
    public function pindahRuangan($kasus,$lokasi_id)
    {
        $lokasi = Lokasi::find($lokasi_id);
        $data['kasus_id'] = $kasus;
        $data['lokasi_id'] = $lokasi_id;
        $data['bangsal_id'] = $lokasi->ruangan->bangsal->id ?? null;

        if(empty($data['bangsal_id'])){
            return;
        }
        try
        {
          DB::connection('gizi')->beginTransaction();
          app('App\Http\Controllers\Gizi\Pemesanan\EditController')->editRuangan($data);
          DB::connection('gizi')->commit();
          return;  
        }
        catch(\Exception $e)
        {
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          DB::connection('gizi')->rollback();
        }
    }
}
