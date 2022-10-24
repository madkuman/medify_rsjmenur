<?php

namespace App\Http\Controllers\AlatMedis;

use App\Http\Controllers\Controller;
use App\Models\AlatMedis\ItemsTemplate;
use App\Models\AlatMedis\Items;
use Illuminate\Http\Request;
use Auth;
use Session;
use File;
use Storage;
use DB;


class CreateController extends Controller
{
    public function createItemsTemplate(Request $request)
    {
        try {
            DB::connection('alat_medis')->beginTransaction();
            $itemtemplate = New ItemsTemplate();
            $itemtemplate->name = $request->input('name');
            $itemtemplate->merk = $request->input('merk');
            $itemtemplate->model = $request->input('model');
            $itemtemplate->slug = str_slug($itemtemplate->name . '-' . $itemtemplate->merk . '-' . $itemtemplate->model);
            $itemtemplate->description = $request->input('description');
            $itemtemplate->created_by = Auth::user()->id;
            $itemtemplate->save();
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
                $itemtemplate->image_thumb = $pathThumbnail . $nama_file . "." . $source_img->clientExtension();
                $itemtemplate->save();
            }
            DB::connection('alat_medis')->commit();
            Session::flash('success', "Add Item Template Success");
            return $itemtemplate;
        }catch(\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('alat_medis')->rollback();
            if(config('app.debug'))

                return FALSE;
        }
    }
    public function createItems($request,$id_items)
    {
        if ($items = ItemsTemplate::find($id_items)) {
            for ($i = 0; $i < $request->input('jumlah'); $i++) {
                $items = New Items();
                $last_index=count(Items::where('items_template_id',$id_items)->get());
                $items->no_items = $last_index+1;
                $items->items_template_id = $id_items;
                $items->created_by = Auth::user()->id;
                $items->save();
            }
            Session::flash('success', "Add Items Success");
        }
        else{
            Session::flash('danger', "Item Template Tidak Ada");
        }
        return $items;
    }
}
