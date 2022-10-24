<?php

namespace App\Http\Controllers\Esakip\Dashboard;

use App\Models\Esakip\Dokumen;
use App\Models\Esakip\Kategori;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function edit($request)
    {
        $esakip = Dokumen::find($request->id);
        if (!empty($request->file)) {

            $format = $request->file->getClientOriginalExtension();
            if (($format == 'jpg') || ($format == 'png') || ($format == 'jpeg') || ($format == 'gif') || ($format == 'pdf') || ($format == 'svg') || ($format == 'mp4') || ($format == 'mkv') || ($format == 'pptx')) {
                $kategori_nama  = Kategori::find($esakip->kategori_id)->nama;
                $user_nama = User::find($esakip->user_id)->name;
                $now = Carbon::now()->format('YmdHis');
                $esakip->type = $request->file->getClientOriginalExtension();
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
