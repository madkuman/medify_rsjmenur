<?php

namespace App\Http\Controllers\Esakip\Dashboard;

use App\Models\Esakip\Dokumen;
use App\Models\Esakip\Kategori;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $esakip = new Dokumen();
        $esakip->tahun = $request->tahun;
        $esakip->user_id = isset($request->user_id) ? $request->user_id : Auth::user()->id;
        $esakip->kategori_id = $request->kategori_id;
        $esakip->created_by = Auth::user()->id;
        $esakip->counter = $request->counter ?? null;
        $esakip->save();

        if (!empty($request->file)) {

            $format = $request->file->getClientOriginalExtension();
            if (($format == 'jpg') || ($format == 'png') || ($format == 'jpeg') || ($format == 'gif') || ($format == 'pdf') || ($format == 'svg') || ($format == 'mp4') || ($format == 'mkv') || ($format == 'pptx')) {
                $kategori_nama  = Kategori::find($esakip->kategori_id)->nama;
                $user_nama = User::find($esakip->user_id)->name;
                $now = Carbon::now()->format('YmdHis');
                $esakip->type = $request->file->getClientOriginalExtension();
                if(isset($request->counter) && !empty($request->counter)) $esakip->title = $kategori_nama.' '.$request->counter;
                else $esakip->title = $kategori_nama;
                $filename = $user_nama.'_'.$kategori_nama.'_'.$esakip->tahun.'_'.$esakip->id;
                $filename = $filename.'_'.$now.'.'.$esakip->type;
                $path= '/uploads/esakip';
                $destination_path = public_path($path);
                if (!is_dir($destination_path)) {
                    mkdir($destination_path, 0777, true);
                }
                $request->file->move($destination_path, $filename);
                $esakip->path = $path.'/'.$filename;
                $esakip->save();
            }else {
                return error;
            }

        }

    }
}
