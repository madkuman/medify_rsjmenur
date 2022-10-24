<?php

namespace App\Http\Controllers\Keuangan\Tarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use DB;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            DB::connection('keuangan')->beginTransaction();

            $master = TarifMaster::find($id);
            foreach ($master->tarif as $val) {
                Tarif::find($val->id)->delete();
            }
            $master->delete();

            $data['url'] = 'keuangan/tarif/';
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Tarif berhasil dihapus.';
            DB::connection('keuangan')->commit();
            
        } catch (Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $data['url'] = 'keuangan/tarif/';
            $data['type'] = 'Error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Tarif gagal dihapus.';
            DB::connection('keuangan')->rollback();

        }
        return json_encode($data);
    }
}

