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


class CreateController extends Controller
{

    public function createVideo($id){
        $openTokAPI = new OpenTok(config('app.opentok_api_key'), config('app.opentok_api_secret'));
        $session = $openTokAPI->createSession(array('mediaMode' => MediaMode::ROUTED));
        $session_token = $session->getSessionId();
        $video = new Video;
        $video->transaksi_id = $id;
        $video->session_token = $session_token;
        $video->created_by = Auth::user()->id;
        $video->is_on = 1;
        $video->save();

        return $session_token;
    }

    // public function createVideoDetail($request){
    //     //tambahkan sebuah kolom pada tabel video_detail untuk mengetahui mana yg request!
    //     $video_detail = new VideoDetail();
    //     $video_detail->video_id = $request->video_id;
    //     $video_detail->created_by = Auth::user()->id;
    //     $video_detail->save();
    // }

    public function createVideoWithoutSession($id,$durasi = null){
        //$openTokAPI = new OpenTok(env("OPENTOK_API_KEY","46895714"), env("OPENTOK_API_SECRET","ec519e5533af9ca29fe35f2cca41712316a297a1"));
        //$session = $openTokAPI->createSession(array('mediaMode' => MediaMode::ROUTED));
        //$session_token = $session->getSessionId();
        $video = new Video;
        $video->transaksi_id = $id;
        $video->durasi = $durasi;
        $video->durasi_tersedia = $durasi;
        //$video->session_token = $session_token;
        //$video->created_by = Auth::user()->id;
        //$video->is_on = 1;
        $video->save();

        return $video;
    }
}