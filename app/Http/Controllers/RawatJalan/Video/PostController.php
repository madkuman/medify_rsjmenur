<?php

namespace App\Http\Controllers\RawatJalan\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Video;
use App\Models\RawatJalan\VideoDetail;
use OpenTok\OpenTok;
use OpenTok\Role;
use OpenTok\MediaMode;
use Auth;
use Carbon\Carbon;
use File;
use DB;
use Illuminate\Support\Facades\Crypt;


class PostController extends Controller
{

    public function connect($video){
        //$video = Video::where("transaksi_id",$id)->first();
        // if($video){
        //     if($video->is_on == 0){
        //         return response()->json(['failure'=>'Video belum dibuat oleh Moderator']);
        //     }
        //     else if($video->is_connected == 1){
        //         return response()->json(['failure'=>'Sudah ada yang join']);
        //     }
        //     else if($video->is_connecting == 1){
        //         return response()->json(['failure'=>'Sudah ada yang antri']);
        //     }
        // }
        // else{
        //     //return response()->json(['failure'=>'Video belum dibuat oleh moderator']);
        //     $video = app('App\Http\Controllers\RawatJalan\Video\CreateController')->createVideoWithoutSession($id);
        // }
        // if($video->is_on == 0){
        //     return response()->json(['failure'=>'Video belum dibuat oleh Moderator']);
        // }
        // if($video->is_connected == 1){
        //     
        //     abort(404);
        // }
        // else if($video->is_connecting == 1){
        //     
        //     abort(404);
        // }
        $video->is_connecting = 1;
        $video->is_declined = 0;
        $video->save();

        return $video;
    }

    //if accepted by mod
    public function accepted(Request $request){
        //note : jika diperlukan siapa yang join, perlu video_detail
        // $video_detail = new VideoDetail();
        // $video_detail->video_id = $request->video_id;
        // $video_detail->created_by = Auth::user()->id;
        // $video_detail->save();
        //app('App\Http\Controllers\RawatJalan\Video\CreateController')->createVideoDetail($request);

        $video = Video::where("id",$request->video_id)->first();
        $video->is_connecting = 0;
        $video->is_declined = 0;
        $video->is_connected = 1;
        $video->save();
    }

    //if declined by mod
    public function declined(Request $request){

        $video = Video::where("id",$request->video_id)->first();
        $video->is_connecting = 0;
        $video->is_declined = 1;
        $video->save();
    }

    public function off(Request $request){
        $video = Video::where("transaksi_id",$request->transaksi_id)->first();
        $video->is_on = 0;
        $video->is_connected = 0;
        $video->is_connecting = 0;
        $video->is_declined = 0;
        if($request->has('durasi_tersedia') && !empty($request->durasi_tersedia)) $video->durasi_tersedia = $request->durasi_tersedia;
        $video->save();
    }

    public function disconnect(Request $request){
        $video = Video::where("transaksi_id",$request->transaksi_id)->first();
        $video->is_connected = 0;
        $video->is_declined = 0;
        if($request->has('durasi_tersedia') && !empty($request->durasi_tersedia)) $video->durasi_tersedia = $request->durasi_tersedia;
        $video->save();
    }

    public function puboff(Request $request){
        $video = Video::where("transaksi_id",$request->transaksi_id)->first();
        //$video->is_connected = 0;
        if($request->from == "waiting")
            $video->is_connecting = 0;
        if($request->from == "pub")
            $video->is_connected = 0;
        //$video->is_declined = 0;
        if($request->has('durasi_tersedia') && !empty($request->durasi_tersedia)) $video->durasi_tersedia = $request->durasi_tersedia;
        $video->save();
    }

    public function end(Request $request){

        try {
            DB::connection('rawatjalan')->beginTransaction();
            $video = Video::where("transaksi_id",$request->transaksi_id)->first();
            $video->is_ended = 1;
            $video->is_connected = 0;
            $video->is_declined = 0;
            $video->save();
            $status = 1;
            $message = 'Video Call berhasil di end session';
            $title = 'Berhasil!';

            DB::connection('rawatjalan')->commit();
            return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }catch(\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            $status = -1;
            $message = 'Video Call gagal di end session';
            $title = 'Gagal!';

            return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }
    }

    public function restore(Request $request){

        try {
            DB::connection('rawatjalan')->beginTransaction();
            $video = Video::where("transaksi_id",$request->transaksi_id)->first();
            $video->is_ended = 0;
            $video->save();

            $status = 1;
            $message = 'Video Call berhasil di restore';
            $title = 'Berhasil!';

            DB::connection('rawatjalan')->commit();
            return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }catch(\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            $status = -1;
            $message = 'Video Call gagal di restore';
            $title = 'Gagal!';

            return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        }
    }

    public function penunjang(Request $request){
        app('debugbar')->disable();
        ini_set("upload_max_filesize","4M");
        try {
            DB::connection('rawatjalan')->beginTransaction();
            $video = Video::where("transaksi_id",$request->transaksi_id)->first();
            if(isset($request->keluhan) && !empty($request->keluhan)){
                $videodetail = VideoDetail::where("video_id",$video->id)->where('jenis',"keluhan")->first();
                if($videodetail){
                    $videodetail->delete();
                }
                $videodetail = New VideoDetail();
                $videodetail->video_id = $video->id;
                $videodetail->jenis = "keluhan";
                $videodetail->text = $request->keluhan;
                $videodetail->transaksi_id = $request->transaksi_id;
                $videodetail->save();
            }
            if (!empty($request->link_gambar)) {
                // $videodetail_query = VideoDetail::where("video_id", $video->id)->where('jenis', "image");
                // $videodetail_locations = with(clone $videodetail_query)->pluck('location');
                // $videodetail_thumbs_locations = with(clone $videodetail_query)->pluck('thumb_location');
                // foreach ($videodetail_locations as $item) {
                //     if (!empty($item) && file_exists(public_path($item))) {
                //         unlink(public_path($item));
                //     }
                // }
                // foreach ($videodetail_thumbs_locations as $item) {
                //     if (!empty($item) && file_exists(public_path($item))) {
                //         unlink(public_path($item));
                //     }
                // }
                // $videodetail_remove = with(clone $videodetail_query)->delete();

                foreach($request->link_gambar as $index => $item) {
                    $encryptedTime = Crypt::encryptString(str_replace(' ', '', Carbon::now()->toDateTimeString()));
                    $encryptedId = Crypt::encryptString($video->id.$index);

                    $videodetail = New VideoDetail();
                    $videodetail->transaksi_id = $request->transaksi_id;
                    $videodetail->video_id = $video->id;
                    $videodetail->jenis = "image";
                    
                    $source_img = explode('.', $item);
                    $ext_file = end($source_img);
                    $nama_file = substr($encryptedId, 0, 5).substr($encryptedTime, 0, 15).'.'.$ext_file;

                    if (!file_exists($item)) continue;

                    $path = "uploads/telekonsultasi/penunjang/";
                    if (!file_exists($path))
                        mkdir($path, 0775, true);

                    if (!file_exists($path."_300x300"))
                        mkdir($path."_300x300", 0775, true);

                    $image = \Image::make(fopen($item, 'r'));
                    $image->resize(300, 300);
                    File::put(public_path($path."_300x300".DIRECTORY_SEPARATOR.$nama_file), (string) $image->encode());
                    
                    $image = File::move($item, public_path($path.$nama_file));
                    
                    $videodetail->location = $path.$nama_file;
                    $videodetail->thumb_location = $path."_300x300".DIRECTORY_SEPARATOR.$nama_file;
                    $videodetail->save();
                }
            }

            if (!empty($request->link_video)){
                // $videodetail_query = VideoDetail::where("video_id", $video->id)->where('jenis', "video");
                // $videodetail_locations = with(clone $videodetail_query)->pluck('location');
                // foreach ($videodetail_locations as $item) {
                //     if (!empty($item) && file_exists(public_path($item))) {
                //         unlink(public_path($item));
                //     }
                // }
                // $videodetail_remove = with(clone $videodetail_query)->delete();

                foreach($request->link_video as $index => $item) {
                    $encryptedTime = Crypt::encryptString(str_replace(' ', '', Carbon::now()->toDateTimeString()));
                    $encryptedId = Crypt::encryptString($video->id.$index);

                    $videodetail = New VideoDetail();
                    $videodetail->transaksi_id = $request->transaksi_id;
                    $videodetail->video_id = $video->id;
                    $videodetail->jenis = "video";
                    
                    $source_img = explode('.', $item);
                    $ext_file = end($source_img);
                    $nama_file = substr($encryptedId, 0, 5).substr($encryptedTime, 0, 15).'.'.$ext_file;

                    if (!file_exists($item)) continue;

                    $path = "uploads/telekonsultasi/penunjang/";
                    if (!file_exists($path))
                        mkdir($path, 0775, true);

                    $image = File::move($item, public_path($path.$nama_file));
                    
                    $videodetail->location = $path.$nama_file;
                    $videodetail->thumb_location = "assets/img/video-placeholder.png";
                    $videodetail->save();
                }
            }

            if (!empty($request->link_audio)){
                // $videodetail_query = VideoDetail::where("video_id", $video->id)->where('jenis', "audio");
                // $videodetail_locations = with(clone $videodetail_query)->pluck('location');
                // foreach ($videodetail_locations as $item) {
                //     if (!empty($item) && file_exists(public_path($item))) {
                //         unlink(public_path($item));
                //     }
                // }
                // $videodetail_remove = with(clone $videodetail_query)->delete();

                foreach($request->link_audio as $index => $item) {
                    $encryptedTime = Crypt::encryptString(str_replace(' ', '', Carbon::now()->toDateTimeString()));
                    $encryptedId = Crypt::encryptString($video->id.$index);

                    $videodetail = New VideoDetail();
                    $videodetail->transaksi_id = $request->transaksi_id;
                    $videodetail->video_id = $video->id;
                    $videodetail->jenis = "audio";
                    
                    $source_img = explode('.', $item);
                    $ext_file = end($source_img);
                    $nama_file = substr($encryptedId, 0, 5).substr($encryptedTime, 0, 15).'.'.$ext_file;

                    if (!file_exists($item)) continue;

                    $path = "uploads/telekonsultasi/penunjang/";
                    if (!file_exists($path))
                        mkdir($path, 0775, true);

                    $image = File::move($item, public_path($path.$nama_file));
                    
                    $videodetail->location = $path.$nama_file;
                    $videodetail->thumb_location = "assets/img/audio-placeholder.png";
                    $videodetail->save();
                }
            }
            DB::connection('rawatjalan')->commit();
            return response()->json([
                'code' => 200,
                'message' => "Success",
                'response' => "Success save video penunjang"
            ], 200);
        }catch(\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            return response()->json([
                'code' => 500,
                'message' => "Error",
                'response' => "System error"
            ], 500);
        }
    }
}