<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\Log;
use App\Models\ThirdParty\UserBpjsMobile;

class CreateController extends Controller
{
    public function saveToken($data)
    {
        $cek_token = UserBpjsMobile::where('created_by', $data['created_by'])->first();

        /** jika tokennya belum ada dicreate */
        if (empty($cek_token)) {

            $cek_token = new UserBpjsMobile;
        }

        $cek_token->token = $data['token'];
        $cek_token->created_by = $data['created_by'];
        $cek_token->save();

        return $cek_token;
    }

    public function createLog($data)
    {
        $create = new Log;
        $create->jenis_request = $data['jenis_request'];
        $create->url           = $data['url'];
        $create->param         = $data['param'];
        $create->response      = $data['response'];
        $create->created_by    = $data['created_by'];
        $create->save();
        return $create;
    }
}
