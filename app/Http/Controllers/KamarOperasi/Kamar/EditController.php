<?php

namespace App\Http\Controllers\KamarOperasi\Kamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Ruangan;
use Carbon\Carbon;
use DB;

class EditController extends Controller
{
  public function update(Request $request)
  {
    DB::connection('kamaroperasi')->beginTransaction();
    DB::connection('mysql')->beginTransaction();
    try {
        $exist = $this->checkNamaKamar($request->input('kategori'), $request->input('name'));
        if ($exist && $exist != $request->input('id'))
        {
            $message = 'Nama Kamar "'.$request->input('name').'" Sudah Ada!';
            $title = 'Gagal!';
            $status = -1;

            return redirect('kamaroperasi/kamar/edit/'.$request->input('id'))
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }

        $kamar = Ruangan::findOrFail($request->input('id'));
        $kamar->name = $request->input('name');
        $kamar->farmasi_id = $request->input('farmasi');
        $kamar->kategori = $request->input('kategori');
        $kamar->ronde = $request->input('ronde');
        $logo = $request->file('logo');
        if ($logo) {
            $cleaned_name = preg_replace("/[^0-9a-zA-Z]/", "", $kamar->name);
            $filename = $cleaned_name.'.'.$logo->getClientOriginalExtension();
            $dir = public_path('/uploads/kamaroperasi/logo_ruangan');
            $logo->move($dir, $filename);
            $kamar->image_thumb = '/uploads/kamaroperasi/logo_ruangan/'.$filename;
        }
        $kamar->save();
        $name ='Kamar Operasi - '.$kamar->name;
        $lokasi = app('App\Http\Controllers\Hospital\Lokasi\EditController')->edit($kamar->lokasi_id,$name);

        $message = 'Data Kamar Berhasil Diperbaharui!';
        $title = 'Berhasil!';
        $status = 1;

        DB::connection('kamaroperasi')->commit();
        DB::connection('mysql')->commit();

        return redirect('kamaroperasi/kamar')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);

    } catch (\Exception $e) {
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        DB::connection('kamaroperasi')->rollback();
        DB::connection('mysql')->rollback();

        $message = $e;
        $title = 'Error!';
        $status = -1;

        return redirect('kamaroperasi/kamar')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}

public function checkNamaKamar($kategori, $nama)
{
    $kamar = Ruangan::where('kategori', $kategori)->where('name', $nama)->first();
    if($kamar)
      return $kamar->id;
  else return 0;
}

public function destroy($id)
{
    $kamar = Ruangan::findOrFail($id);

    $lokasi = app('App\Http\Controllers\Hospital\Lokasi\DeleteController')->delete($kamar->lokasi_id);
            
    $kamar->delete();

    $message = 'Data Kamar Berhasil Dihapus!';
    $title = 'Berhasil!';
    $status = 1;

    return redirect('kamaroperasi/kamar')
    ->with('message', $message)
    ->with('title',$title)
    ->with('status', $status);
}
}
