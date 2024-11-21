<?php

namespace App\Http\Controllers\ThirdParty\BPJS;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function __construct()
    {
        app('debugbar')->disable();
    }

    public function getHeader()
    {
        $cons_id = config('app.bpjs_cons_id');
        $secret = config('app.bpjs_secret');
        $user_key = config('app.bpjs_user_key');
        // dd($cons_id, $secret);
        // Computes the timestamp
        $timestamp = strval(Carbon::now()->setTimezone('UTC')->timestamp);
        date_default_timezone_set('Asia/Jakarta');

        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $cons_id . "&" . $timestamp, $secret, true);

        $encodedSignature = base64_encode($signature);

        $header_array = array(
            'X-cons-id' => $cons_id,
            'X-timestamp' => $timestamp,
            'X-signature' => $encodedSignature,
            'user_key' => $user_key
        );
        return $header_array;
    }

    public function getUrl()
    {
        if (strtolower(config('app.bpjs_stage')) == "production") {
            return "https://apijkn.bpjs-kesehatan.go.id/vclaim-rest";
        } else {
            if (config('app.bpjs_decrypt', false)) {
                // return "https://dvlp.bpjs-kesehatan.go.id/VClaim-rest-1.1";
                return "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev";
            } else {
                return "https://dvlp.bpjs-kesehatan.go.id/VClaim-rest";
            }
        }
    }
    public function getAplicareUrl()
    {
        if (strtolower(config('app.bpjs_stage')) == "production") {
            return "https://apijkn.bpjs-kesehatan.go.id/aplicaresws";
        } else {
            if (config('app.bpjs_decrypt', false)) {
                // return "https://dvlp.bpjs-kesehatan.go.id/VClaim-rest-1.1";
                return "https://apijkn-dev.bpjs-kesehatan.go.id/aplicaresws";
            } else {
                return "https://apijkn-dev.bpjs-kesehatan.go.id/aplicaresws";
            }
        }
    }

    public function getIcareUrl()
    {
        if (strtolower(config('app.bpjs_stage')) == "production") {
            return "https://apijkn.bpjs-kesehatan.go.id/wsihs/api/rs/validate";
        } else {
            if (config('app.bpjs_decrypt', false)) {
                // return "https://dvlp.bpjs-kesehatan.go.id/VClaim-rest-1.1";
                return "https://apijkn-dev.bpjs-kesehatan.go.id/ihs_dev/api/rs/validate";
            } else {
                return "https://apijkn-dev.bpjs-kesehatan.go.id/ihs_dev/api/rs/validate";
            }
        }
    }

    public function getUrlAntrean()
    {
        if (strtolower(config('app.bpjs_stage')) == "production") {
            return "https://apijkn.bpjs-kesehatan.go.id/antreanrs";
        } else {
            if (config('app.bpjs_decrypt', false)) {
                // return "https://dvlp.bpjs-kesehatan.go.id/VClaim-rest-1.1";
                return "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";
            } else {
                return "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";
            }
        }
    }

    public function getUrlApotek()
    {
        if (strtolower(config('app.bpjs_stage')) == "production") {
            return "https://apijkn.bpjs-kesehatan.go.id/apotek-rest";
        } else {
            if (config('app.bpjs_decrypt', false)) {
                // return "https://dvlp.bpjs-kesehatan.go.id/VClaim-rest-1.1";
                return "https://apijkn-dev.bpjs-kesehatan.go.id/apotek-rest-dev";
            } else {
                return "https://apijkn-dev.bpjs-kesehatan.go.id/apotek-rest-dev";
            }
        }
    }

    function stringDecrypt($timestamp, $string)
    {

        $cons_id = config('app.bpjs_cons_id');
        $secret = config('app.bpjs_secret');

        $key = $cons_id . $secret . $timestamp;

        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        $output = $this->decompress($output);
        return $output;
    }

    // function lzstring decompress https://github.com/nullpunkt/lz-string-php
    function decompress($string)
    {

        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }
}
