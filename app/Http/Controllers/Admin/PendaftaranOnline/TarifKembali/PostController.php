<?php

namespace App\Http\Controllers\Admin\PendaftaranOnline\TarifKembali;

use App\Models\Hospital\MasterTarifKembali;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class PostController extends Controller
{
    public function add(Request $request)
    {
        try{

            DB::connection('mysql')->beginTransaction();
            $master_tarif_kembali = new MasterTarifKembali();
            $master_tarif_kembali->tarif_master_id = $request->tarif_master_id;
            $master_tarif_kembali->created_by = Auth::user()->id;
            $master_tarif_kembali->save();
            DB::connection('mysql')->commit();
            return redirect('admin/pendaftaran-online/tarif-kembali')
                ->with('message', 'Data Berhasil Ditambahkan')
                ->with('title','Berhasil!')
                ->with('status', 1);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('mysql')->rollBack();
            return redirect('admin/pendaftaran-online-tarif-kembali')
                ->with('message', 'Data Gagal Ditambahkan')
                ->with('title','Gagal!')
                ->with('status', -1);
        }
    }

    public function delete($id)
    {
        try{

            DB::connection('mysql')->beginTransaction();
            $master_tarif_kembali = MasterTarifKembali::where('id',$id)->first();
            $master_tarif_kembali->deleted_by = Auth::user()->id;
            $master_tarif_kembali->save();
            $master_tarif_kembali->delete();
            DB::connection('mysql')->commit();
            return json_encode($master_tarif_kembali);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('mysql')->rollBack();
            return false;
        }
    }
}
