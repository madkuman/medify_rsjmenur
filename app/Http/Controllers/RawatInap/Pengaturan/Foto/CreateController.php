<?php

namespace App\Http\Controllers\RawatInap\Pengaturan\Foto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Foto;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function new($bangsal_id,$tipe,$foto,$foto_thumb)
    {
        DB::connection('rawatinap')->beginTransaction();
        try
        {
            $data = new Foto;
            $data->tipe = $tipe;
            $data->tipe_item_id = $bangsal_id;
            $data->foto_ori = $foto;
            $data->foto_thumb = $foto_thumb;
            $data->created_by = Auth::user()->id;
            $data->save();

            
            DB::connection('rawatinap')->commit();
            return $data;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatinap')->rollback();
            
        }
    }
}
