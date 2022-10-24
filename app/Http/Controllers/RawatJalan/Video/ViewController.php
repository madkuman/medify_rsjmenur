<?php

namespace App\Http\Controllers\RawatJalan\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Video;
use App\Models\RawatJalan\Transaksi;
use OpenTok\OpenTok;
use OpenTok\Role;
use OpenTok\MediaMode;
use Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ViewController extends Controller
{
    //moderator role
    public function mod($id) 
    {
        $openTokAPI = new OpenTok(config('app.opentok_api_key'), config('app.opentok_api_secret'));

    	$video=Video::where("transaksi_id",$id)->first();
    	if($video){
            if($video->is_ended){
                abort(404);
            }
            if(isset($video->session_token) && !empty($video->session_token)){
                $session_token = $video->session_token;
            }
            else{
                $openTokAPI = new OpenTok(config('app.opentok_api_key'), config('app.opentok_api_secret'));
                $session = $openTokAPI->createSession(array('mediaMode' => MediaMode::ROUTED));
                $session_token = $session->getSessionId();
                $video->session_token = $session_token;
                $video->created_by = Auth::user()->id;
            }
    		
            $video->is_on = 1;
            $video->save();
    	}
    	else
    	{
            $transaksi = Transaksi::where('id',$id)->first();
            if(!isset($transaksi)){
                abort(404);
            }
            else if($transaksi->is_video != 1){
                abort(404);
            }
            $session_token = app('App\Http\Controllers\RawatJalan\Video\CreateController')->createVideo($id);
    	}
        $opentok_token = $openTokAPI->generateToken($session_token,array(
            'role'       => Role::MODERATOR,
        ));

        return view('rawatjalan.video.index', [
             'session_token' => $session_token,
             'opentok_token' => $opentok_token,
             'role'          => "mod",
             'id'            => $id
        ]);
    }
//publisher role
    public function pub($id) 
    {
        $openTokAPI = new OpenTok(config('app.opentok_api_key'), config('app.opentok_api_secret'));
        $video=Video::where("transaksi_id",$id)->first();
        if($video){
            if($video->is_ended){
                abort(404);
            }
            if($video->is_on == 0)
            {
                return redirect('rawatjalan/videowaiting/'.$id);
            }
            else if($video->is_connecting == 1){
                abort(404);
            }
            $session_token = $video->session_token;
        }
        else
        {
            abort(404);
        }
        $opentok_token = $openTokAPI->generateToken($session_token,array(
            'role'       => Role::PUBLISHER,
        ));
        $video->is_declined = 0;
        $video->save();

        return view('rawatjalan.video.index', [
             'session_token' => $session_token,
             'opentok_token' => $opentok_token,
             'role'          => "pub",
             'id'            => $id
        ]);
    }

    public function waiting($id){
        $video=Video::where("transaksi_id",$id)->first();
        if(!isset($video)){
            abort(404);
        }
        $video = app('App\Http\Controllers\RawatJalan\Video\PostController')->connect($video);
        return view('rawatjalan.video.waiting',[
            'id'            => $id
        ]);
    }

    public function penunjang($id){
        $video=Video::where("transaksi_id",$id)->first();
        if(!isset($video)){
            abort(404);
        }
        return view('rawatjalan.video.penunjang',[
            'id'            => $id
        ]);
    }
}