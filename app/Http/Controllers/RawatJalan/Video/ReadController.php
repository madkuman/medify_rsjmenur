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
use Symfony\Component\HttpFoundation\StreamedResponse;


class ReadController extends Controller
{
    public function modNotif($id){
        $req = $this->getConnected($id);
        if($req){
            $data = "retry: 61000\ndata: " . json_encode($req) . "\n\n";
        }
        else{
            $data = "retry: 1000\ndata: " . json_encode($req) . "\n\n";
        }
        //$data = "data: " . json_encode($req) . "\n\n";
        return response($data)
        ->withHeaders([
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
        ]);
    } 

    public function waitNotif($id){
        // $video = Video::where("transaksi_id",$id)->first();
        // $video_id = $video->id;
        $req = $this->getAccepted($id);
        if($req){}
        else{
            $req = $this->getDeclined($id);
        }
        if($req){
            $data = "retry: 61000\ndata: " . json_encode($req) . "\n\n";
        }
        else{
            $data = "retry: 1000\ndata: " . json_encode($req) . "\n\n";
        }    
        //$data = "data: " . json_encode($req) . "\n\n";
        if(isset($req) && !empty($req)){
            if($req->is_declined){
                $req->is_declined = 0;
                $req->save();
            }
        }
        return response($data)
        ->withHeaders([
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
        ]);
    }

    public function getConnected($id){
        $video = Video::where("transaksi_id",$id)->where("is_connecting",1)->first();
        return $video;
    }

    public function getAccepted($id){
        // $video_detail = VideoDetail::where("video_id",$id)->first();
        // return $video_detail;
        $video = Video::where("transaksi_id",$id)->where("is_connected",1)->first();
        return $video;
    }

    public function getDeclined($id){
        // $video_detail = VideoDetail::where("video_id",$id)->first();
        // return $video_detail;
        $video = Video::where("transaksi_id",$id)->where("is_declined",1)->first();
        return $video;
    }
}