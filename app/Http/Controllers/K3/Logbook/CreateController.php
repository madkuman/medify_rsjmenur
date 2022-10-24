<?php

namespace App\Http\Controllers\K3\Logbook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\K3\Logbook;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    public function create(Request $req)
    {
        DB::connection('k3')->beginTransaction();
        try
        {
            $logbook = new Logbook();
            $logbook->nama_pegawai = $req->pegawai;
            $logbook->status_pegawai = $req->status_pegawai;
            $logbook->letak_cedera = $req->letakcedera;
            $logbook->lokasi = $req->lokasi;
            $logbook->tanggal_kejadian = Carbon::createFromFormat('d/m/Y', $req->tanggal);
            $logbook->kronologi = $req->kronologi;
            $logbook->fatality = $req->fatality;

            $logbook->created_by = Auth::user()->id;
            $logbook->save();

            $status = 1;
			$message = 'Kecelakaan K3 berhasil ditambahkan.';
			$title = 'Berhasil!';
    		
        	DB::connection('k3')->commit();
            return redirect('k3/laporkan-k3')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('k3')->rollback();
        }
    }
}