<?php

namespace App\Http\Controllers\INACBG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\HasilINACBG;
use Carbon\Carbon;
use Auth;
use GuzzleHttp\Client;
use DB;

class CreateController extends Controller
{

    public function create($result, $kasus_id, $payload)
    {
        $hasil = new HasilINACBG;
        $hasil->kasus_id = $kasus_id;
        $hasil->payload = json_encode($result);
        if(isset($result->special_cmg_option))
            $hasil->special_cmg = json_encode($result->special_cmg_option);
        $hasil->payload_sent = $payload;
        $hasil->created_by = Auth::user()->id;
        $hasil->save();
        return $hasil;
    }
}