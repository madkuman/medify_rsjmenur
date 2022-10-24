<?php

namespace App\Http\Controllers\AlatMedis;

use App\Http\Controllers\Controller;
use App\Models\AlatMedis\ItemsTemplate;
use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use Storage;
use DB;




class EditController extends Controller
{
    public function editItemsTemplate($request,$id)
    {
    try
    {
        if($itemtemplate = ItemsTemplate::find($id)) {
        DB::connection('alat_medis')->beginTransaction();
            $itemtemplate->name = $request->input('name');
            $itemtemplate->merk = $request->input('merk');
            $itemtemplate->model = $request->input('model');
            $itemtemplate->slug = str_slug($itemtemplate->name . '-' . $itemtemplate->merk . '-' . $itemtemplate->model);
            $itemtemplate->description = $request->input('description');
            $itemtemplate->created_by = Auth::user()->id;

            if ($request->file('link_gambar')) {
                $source_img = $request->file('link_gambar');

                $nama_file = str_replace(' ', '-', $itemtemplate->id . $itemtemplate->name);
                $path = "uploads/alat-medis/original/";
                $pathThumbnail = "uploads/alat-medis/thumbnail/";
                if (!file_exists($path) && !is_dir($path)) {
                    mkdir($path);
                }
                if (!file_exists($pathThumbnail) && !is_dir($pathThumbnail)) {
                    mkdir($pathThumbnail);
                }

                $image = \Image::make($source_img);
                $width = $image->width();
                $height = $image->height();
                if ($height < 1000) {
                    File::put(public_path($path . $nama_file . "." . $source_img->clientExtension()), (string)$image->encode());
                } else {
                    $pembagi = $height / 1000;
                    $image = \Image::make($source_img);
                    $image->resize($width / $pembagi, $height / $pembagi);
                    File::put(public_path($path . $nama_file . "." . $source_img->clientExtension()), (string)$image->encode());
                }

                if ($height < 300) {
                    File::put(public_path($pathThumbnail . $nama_file . "." . $source_img->clientExtension()), (string)$image->encode());
                } else {
                    $pembagi = $height / 300;
                    $image = \Image::make($source_img);
                    $image->resize($width / $pembagi, $height / $pembagi);
                    File::put(public_path($pathThumbnail . $nama_file . "." . $source_img->clientExtension()), (string)$image->encode());
                }
                $itemtemplate->image_ori = $path . $nama_file . "." . $source_img->clientExtension();
                $itemtemplate->image_thumb = $path . $nama_file . "." . $source_img->clientExtension();
                $itemtemplate->save();
            }
            $itemtemplate->save();
            DB::connection('alat_medis')->commit();
            Session::flash('success', "Edit Item Template Success");
            return $itemtemplate;
        }else{
            DB::connection('alat_medis')->rollback();
            Session::flash('danger', "Edit Item Template Failed");
        }
    }catch(\Exception $e)
    {
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        DB::connection('alat_medis')->rollback();
        if(config('app.debug'))

            return FALSE;
    }
    }
}
