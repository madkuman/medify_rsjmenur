<?php

namespace App\Http\Controllers\ThirdParty\BPJS\JKN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RequestController extends Controller
{
    public function getHeader()
    {
        $cons_id = config('medify.third-party.jkn_online.cons_id');
        $secret = config('medify.third-party.jkn_online.cons_pwd');
        $user_key = config('medify.third-party.jkn_online.user_key');
        // Computes the timestamp
        $timestamp = strval(Carbon::now()->setTimezone('UTC')->timestamp);
        Carbon::now()->setTimezone('Asia/Jakarta');
        date_default_timezone_set('Asia/Jakarta');
        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $cons_id.'&'.$timestamp, $secret, true);

        $encodedSignature = base64_encode($signature);

        $header_array = array(
            'X-cons-id' => $cons_id,
            'X-timestamp' => $timestamp,
            'X-signature' => $encodedSignature,
            'user_key' => $user_key,
        );
        return $header_array;
    }

    public function getUrl()
    {
        return config('medify.third-party.jkn_online.url');
    }

    function stringDecrypt($timestamp, $string){
        $cons_id = config('medify.third-party.jkn_online.cons_id');
        $cons_pwd = config('medify.third-party.jkn_online.cons_pwd');
        $key = $cons_id.$cons_pwd.$timestamp;

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
    function decompress($string){
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }

    public function getKey()
    {
        $cons_id = config('medify.third-party.jkn_online.cons_id');
        $cons_pwd = config('medify.third-party.jkn_online.cons_pwd');
        $timestamp = strval(Carbon::now()->setTimezone('UTC')->timestamp);
        Carbon::now()->setTimezone('Asia/Jakarta');
        $key = $cons_id.$cons_pwd.$timestamp;

        return $key;
    }
}
