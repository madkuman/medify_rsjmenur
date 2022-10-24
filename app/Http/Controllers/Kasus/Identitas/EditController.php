<?php

namespace App\Http\Controllers\Kasus\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;
use Illuminate\Support\Facades\Session;
use DB;
use Bugsnag;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function updateIdentitas(Request $request, $nomorKasus) {

        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
            
            $identitas = Identitas::where('kasus_id', $kasus->id)->first();

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($avatar,'pasien');
                $avatar = $image['file_original'];
                $avatar_thumb = $image['file_thumbnail'];

                $identitas->avatar = $avatar;
                $identitas->avatar_thumb = $avatar_thumb;

                $pasien = Pasien::find($identitas->pasien_id);
                $pasien->photo_ori = $avatar;
                $pasien->photo_thumb = $avatar;
                $pasien->updated_by = Auth::user()->id;
                $pasien->save();
            }


            $identitas->alamat = $request->input('alamat');
            $identitas->status = $request->input('status');
            $identitas->no_identitas = $request->input('no-identitas');
            $identitas->pekerjaan = $request->input('pekerjaan');
            $identitas->no_hp = $request->input('hp');
            $identitas->updated_by = Auth::user()->id;
            $identitas->save();

            $status = 1;
            $message = 'Identitas berhasil diubah!';
            $title = 'Berhasil!';

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'edit','identitas',$identitas->id);

        
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function updateMetodeBayar($nomor_kasus,$pembayaran_utama_id,$pembayaran_tambahan)
    {
        $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
        $editPembayaranUtama = app('App\Http\Controllers\Kasus\Kasus\EditController')
        ->editPasienPembayaran($kasus->id,$pembayaran_utama_id);
        
        $deletePembayaranTambahan = app('App\Http\Controllers\Kasus\PembayaranTambahan\DeleteController')
            ->deleteAll($kasus->id);
        if($pembayaran_tambahan != null && count($pembayaran_tambahan) > 0)
        {   
            $pembayaran_tambahan = array_unique($pembayaran_tambahan);
            foreach($pembayaran_tambahan as $item)
            {
                if($item != $pembayaran_utama_id)
                {
                    app('App\Http\Controllers\Kasus\PembayaranTambahan\CreateController')->create($kasus->id,$item);
                }
            }
        }

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'edit','identitas',$kasus->identitas->id);
    }


    public function updateIdentitasMedis(Request $request, $nomorKasus) {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {

            if(!empty($request->tanggal_tirah_baring_start))
                $tanggal_tirah_baring_start = Carbon::createFromFormat('d-m-Y',$request->tanggal_tirah_baring_start);
            else
                $tanggal_tirah_baring_start = null;

            if(!empty($request->tanggal_tirah_baring_end))
                $tanggal_tirah_baring_end = Carbon::createFromFormat('d-m-Y',$request->tanggal_tirah_baring_end);
            else
                $tanggal_tirah_baring_end = null;

            
            $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
            $identitas = Identitas::where('kasus_id', $kasus->id)->first();
            $identitas->tinggi_badan = $request->input('tinggi_badan');
            $identitas->berat_badan= $request->input('berat_badan');
            $identitas->lingkar_perut = $request->input('lingkar_perut');
            $identitas->tekanan_darah_tensi = $request->input('tekanan_darah_tensi');
            $identitas->nadi = $request->input('nadi');
            $identitas->lingkar_dada = $request->input('lingkar_dada');
            $identitas->warna_kulit = $request->input('warna_kulit');
            $identitas->warna_mata = $request->input('warna_mata');
            $identitas->bentuk_badan = $request->input('bentuk_badan');
            $identitas->golongan_darah = $request->input('golongan_darah');
            $identitas->riwayat_sakit = $request->input('riwayat_sakit');
            $identitas->alergi_obat = $request->input('alergi_obat');
            $identitas->alergi_makanan = $request->input('alergi_makanan');
            $identitas->tanggal_tirah_baring_start = $tanggal_tirah_baring_start;  
            $identitas->tanggal_tirah_baring_end = $tanggal_tirah_baring_end;   
            $identitas->status_fisik = $request['status_fisik'];
            $identitas->status_psiko = $request['status_psikologi'];
            $identitas->status_sosio = $request['status_sosiologi'];
            $identitas->status_spirit = $request['status_spiritual'];        
            $identitas->updated_by = Auth::user()->id;
            $identitas->save();

            $status = 1;
            $message = 'Asesmen awal berhasil diubah!';
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'edit','identitas',$identitas->id);


            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function updateNomorRekamMedis(Request $request, $nomorKasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
            $identitas = Identitas::where('kasus_id', $kasus->id)->first();
            $kasus->pasien_id = $request->input('nomor-rm');
            $identitas->pasien_id = $request->input('nomor-rm');
            $kasus->save();
            $identitas->save();

            $status = 1;
            $message = 'Nomor rekam medis berhasil ditambah!';
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'edit','identitas',$identitas->id);


            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function updateFromRekamMedis(Request $request, $nomorKasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
            $identitas = Identitas::where('kasus_id', $kasus->id)->first();
            $pasien = Pasien::where('id', $identitas->pasien_id)->first();

            //update
            $identitas->nama = $pasien->name;
            $identitas->tempat_lahir = $pasien->place_of_birth;
            $identitas->tanggal_lahir = $pasien->date_of_birth;
            if ($pasien->gender == 1) {
                $identitas->jenis_kelamin = "L";
            }
            else $identitas->jenis_kelamin = "P";
            $identitas->status = $pasien->marriage;
            $identitas->pekerjaan = $pasien->job;
            $identitas->no_hp = $pasien->phone;
            $identitas->no_identitas = $pasien->no_identitas;
            $identitas->alamat = $pasien->address;
            
            if (!empty($pasien->age)) {
                $identitas->umur = $pasien->age;
                $usia_masuk = $pasien->getAgeDayAttribute(Carbon::today()->toDateString());
                $identitas->usia_masuk = $usia_masuk;
            }

            $identitas->save();

            $status = 1;
            $message = 'Nomor rekam medis berhasil ditambah!';
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'edit','identitas',$identitas->id);


            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function updateFromPasien($pasien)
    {
        
        $list_kasus = Kasus::where('pasien_id', $pasien->id)->get();

        //update
        if (!empty($list_kasus)) {
            foreach ($list_kasus as $key => $kasus) {
                $identitas = Identitas::where('kasus_id', $kasus->id)->first();
                $identitas->nama = $pasien->name;
                if ($pasien->gender == 1) {
                    $identitas->jenis_kelamin = "L";
                }
                else $identitas->jenis_kelamin = "P";
                $identitas->tempat_lahir = $pasien->place_of_birth;
                $identitas->tanggal_lahir = $pasien->date_of_birth;
                if (!empty($pasien->age)) {
                    $identitas->umur = $pasien->age;
                    $usia_masuk = $pasien->getAgeDayAttribute(Carbon::today()->toDateString());
                    $identitas->usia_masuk = $usia_masuk;
                }
                $identitas->save();
            }
        }

        return $list_kasus;

    }
}
