<?php

namespace App\Http\Controllers\INACBG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;

class PostController extends Controller
{
    static protected $url;
    static protected $kode_tarif;
    static protected $coder_nik;
    static protected $key;

    public function __construct(){
        self::$url = config('app.inacbg_url');
        self::$kode_tarif = config('app.inacbg_kode_tarif');
        self::$coder_nik = config('app.inacbg_coder_nik');
        self::$key = config('app.inacbg_key');
    }

    public function newClaim($kasus)
    {
        try
        {
            $data['metadata'] = [
                "method" => "new_claim"
            ];
            $data['data'] = [
                'nomor_sep' => $kasus->active_sep->no_sep,
                'nomor_kartu' => $kasus->active_sep->no_bpjs,
                'nomor_rm' => $kasus->pasien->no_rm,
                'nama_pasien' => $kasus->pasien->name,
                'tgl_lahir' => $kasus->pasien->date_of_birth,
                'gender' => $kasus->pasien->gender
            ];
            
            $data = json_encode($data);
            $param = $this->inacbg_encrypt(
                $data,
                self::$key
            );
            $client = new Client();
            $res = $client->request('POST', self::$url, 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::BODY => $param,
                ]
            );
            $content = $res->getBody()->getContents();
            $content = json_decode($this->inacbg_decrypt($content, self::$key));
            return $content;
        } catch (\RequestException $e) {
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            // echo Psr7\str($e);
        }

        return $data;
    }

    public function setClaimData($kasus)
    {
        try
        {
            $data['metadata'] = [
                "method" => "set_claim_data",
                'nomor_sep' => $kasus->active_sep->no_sep,
            ];

            $procedure = $this->setProcedure($kasus->tindakan_icd9);
            $diagnosa = $this->setDiagnosis($kasus->diagnosis);
            if($kasus->TransaksiRawatInap->isNotEmpty())
                $mrs_at = Carbon::parse($kasus->TransaksiRawatInap[0]->waktu_masuk);
            else
                $mrs_at = Carbon::parse($kasus->created_at);

            if(isset($kasus->krs_at)){
                $krs_at = Carbon::parse($kasus->krs_at);
                if($krs_at->lt($mrs_at))
                    $krs_at = $mrs_at->copy()->hour($mrs_at->hour)->minute($mrs_at->minute+5);
            }
            else $krs_at = Carbon::now();

            $lokasi_ranap = \App\Models\Hospital\LokasiDepartemen::where('slug', 'rawat-inap')->first();
            $data['data'] = [
                'nomor_sep' => $kasus->active_sep->no_sep,
                'nomor_kartu' => $kasus->active_sep->no_bpjs,
                'tgl_masuk' => $mrs_at->toDateTimeString(),
                'tgl_pulang' => $krs_at->toDateTimeString(),
                'jenis_rawat' => $kasus->lokasi->lokasi->lokasi_departemen_id == $lokasi_ranap->id ? "1" : "2",
                "kelas_rawat" => $kasus->pasien->pembayaranUtama->kelas_id,
                // "adl_sub_acute"=> "15",
                // "adl_chronic"=> "12",
                // "icu_indikator"=> "1",
                // "icu_los"=> "2",
                // "ventilator_hour"=> "5",
                // "upgrade_class_ind"=> "1",
                // "upgrade_class_class"=> "vip",
                // "upgrade_class_los"=> "5",
                // "add_payment_pct"=> "35",
                // "birth_weight"=> "0",
                // "discharge_status"=> "1",
                // "diagnosa"=> "S71.0#A00.1",
                // "procedure"=> "81.52#88.38",
                "diagnosa" => $diagnosa,      
                "procedure" => $procedure,   //SEMUA GABUNG PAKE #
                // "tarif_rs" => [
                //     "prosedur_non_bedah" => "300000",
                //     "prosedur_bedah" => "20000000",
                //     "konsultasi" => "300000",
                //     "tenaga_ahli" => "200000",
                //     "keperawatan" => "80000",
                //     "penunjang" => "1000000",
                //     "radiologi" => "500000",
                //     "laboratorium" => "600000",
                //     "pelayanan_darah" => "150000",
                //     "rehabilitasi" => "100000",
                //     "kamar" => "6000000",
                //     "rawat_intensif" => "2500000",
                //     "obat" => "100000",
                //     "obat_kronis" => "1000000",
                //     "obat_kemoterapi" => "5000000",
                //     "alkes" => "500000",
                //     "bmhp" => "400000",
                //     "sewa_alat" => "210000"
                // ],
                // "tarif_poli_eks" => "100000",
                // "nama_dokter" => "RUDY, DR",
                "kode_tarif" => self::$kode_tarif,
                "payor_id" => "3",
                "payor_cd" => "JKN",
                "cob_cd" => "0001",
                "coder_nik" => config('app.inacbg_coder_nik')
            ];

            // add discharge status if exist
            if (!empty($kasus->alasan_krs) && !empty($kasus->alasan_krs->inacbg)) {
                $data['data']["discharge_status"] = strval($kasus->alasan_krs->inacbg->kode);
            }

            // add tarif rs if exist
            $tarif_inacbg = \App\Models\Keuangan\TarifKategoriINACBG::all();
            if (count($tarif_inacbg) > 0) {
                // init array tarif_rs
                foreach ($tarif_inacbg as $value) {
                    $data['data']["tarif_rs"][$value->slug] = 0;
                }

                // count for each tagihan detail
                foreach ($kasus->daftar_tagihan as $tagihan) {
                    foreach ($tagihan->detail as $detail) {
                        if (!empty($detail->tarif_id)) {
                            foreach ($tarif_inacbg as $value) {
                                $breakdown = \App\Models\Keuangan\TarifINACBG::where('tarif_id', $detail->tarif_id)->where('tarif_kategori_inacbg_id', $value->id)->first();
                                $data['data']["tarif_rs"][$value->slug] += !empty($breakdown) ? $breakdown->harga * $detail->qty : 0;
                            }
                        }
                        elseif($detail->lokasi->departemen->slug == 'farmasi'){
                            if(isset($data['data']["tarif_rs"]["obat"]))
                                $data['data']["tarif_rs"]["obat"] += $detail->subtotal;
                            else
                                $data['data']["tarif_rs"]["obat"] = $detail->subtotal;
                        }
                    }
                }

                // set value as string
                foreach ($data['data']["tarif_rs"] as $i => $value) {
                    $data['data']["tarif_rs"][$i] = strval($value);
                }
            }
            
            $data = json_encode($data);
            $param = $this->inacbg_encrypt(
                $data,
                self::$key
            );
            $client = new Client();
            $res = $client->request('POST', self::$url, 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::BODY => $param,
                ]
            );
            $content = $res->getBody()->getContents();
            $content = json_decode($this->inacbg_decrypt($content, self::$key));
            return ['res' => $content,
            'payload' => json_encode($data)];
        } catch (\RequestException $e) {
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            // echo Psr7\str($e);
        }

        return $data;
    }

    public function firstGrouper($kasus)
    {
        try
        {
            $data['metadata'] = [
                "method" => "grouper",
                "stage" => "1"
            ];
            $data['data'] = [
                "nomor_sep" => $kasus->active_sep->no_sep,
            ];
            $data = json_encode($data);
            $param = $this->inacbg_encrypt(
                $data,
                self::$key
            );
            $client = new Client();
            $res = $client->request('POST', self::$url, 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::BODY => $param,
                ]
            );
            $content = $res->getBody()->getContents();
            $content = json_decode($this->inacbg_decrypt($content, self::$key));
            return $content;
        } catch (\RequestException $e) {
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            // echo Psr7\str($e);
        }

        return $data;
    }

    public function secondGrouper($req, $kasus)
    {
        try
        {
            $data['metadata'] = [
                "method" => "grouper",
                "stage" => "2"
            ];
            $cmg = $this->formatCMG($req->cmg);
            $data['data'] = [
                "nomor_sep" => $kasus->active_sep->no_sep,
                "special_cmg" => $cmg
            ];
            $data = json_encode($data);
            $param = $this->inacbg_encrypt(
                $data,
                self::$key
            );
            $client = new Client();
            $res = $client->request('POST', self::$url, 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::BODY => $param,
                ]
            );
            $content = $res->getBody()->getContents();
            $content = json_decode($this->inacbg_decrypt($content, self::$key));
            return ['res' => $content,
            'payload' => json_encode($data)];
        } catch (\RequestException $e) {
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            // echo Psr7\str($e);
        }

        return $data;
    }

    public function reedit($kasus)
    {
            $data['metadata'] = [
                "method" => "reedit_claim"
            ];
            $data['data'] = [
                "nomor_sep" => $kasus->sep->no_sep,
            ];
            $data = json_encode($data);
            // dd($data);
            $param = $this->inacbg_encrypt(
                $data,
                self::$key
            );
            $client = new Client();
            $res = $client->request(
                'POST',
                self::$url,
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::BODY => $param,
                ]
            );
            // dd($res, $res->getBody(), $res->getBody()->getContents());
            $content = $res->getBody()->getContents();
            // decrypt dengan fungsi inacbg_decrypt
            $content = json_decode($this->inacbg_decrypt($content, self::$key));
            // dd($content);
            return $content;
        

        return $data;
    }

    public function deleteClaim($kasus)
    {
            $data['metadata'] = [
                "method" => "delete_claim"
            ];
            $data['data'] = [
                'nomor_sep' => $kasus->active_sep->no_sep,
                "coder_nik" => config('app.inacbg_coder_nik'),
            ];
            $data = json_encode($data);
            $param = $this->inacbg_encrypt(
                $data,
                self::$key
            );
            $client = new Client();
            $res = $client->request(
                'POST',
                self::$url,
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::BODY => $param,
                ]
            );
            // dd($res, $res->getBody(), $res->getBody()->getContents());
            $content = $res->getBody()->getContents();
            $content = json_decode($this->inacbg_decrypt($content, self::$key));
            return $content;
        

        return $data;
    }

    public function finalisasiClaim($kasus)
    {
        try
        {
            $data['metadata'] = [
                "method" => "claim_final"
            ];
            $data['data'] = [
                'nomor_sep' => $kasus->active_sep->no_sep,
                "coder_nik" => config('app.inacbg_coder_nik'),
            ];
            $data = json_encode($data);
            $param = $this->inacbg_encrypt($data, self::$key);
            $client = new Client();
            $res = $client->request('POST', self::$url, 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::BODY => $param,
                ]
            );
            // dd($res, $res->getBody(), $res->getBody()->getContents());
            $content = $res->getBody()->getContents();
            // decrypt dengan fungsi inacbg_decrypt
            $content = json_decode($this->inacbg_decrypt($content, self::$key));
            return $content;
        } catch (\RequestException $e) {
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            // echo Psr7\str($e);
        }

        return $data;
    }

    private function formatCMG($cmg)
    {
        $result= '';
            foreach($cmg as $index => $c)
            {
                $result .= $c;
                if(isset($cmg[$index+1]))
                    $result .= '#';
            }
        return $result;
    }

    private function setProcedure($tindakan)
    {
        
        $procedure = $tindakan->pluck('icd9_bpjs.code_icd')->toArray();
        $result = implode('#', $procedure);
        return $result;
    }

    private function setDiagnosis($diagnosis)
    {
        $diagnosis_inacbg = $diagnosis->sortByDesc('utama')->pluck('icd10_bpjs.code_icd')->toArray();
        $result = implode('#', $diagnosis_inacbg);
        return $result;
    }

    function inacbg_encrypt($data, $key) {
        /// make binary representasion of $key
        $key = hex2bin($key);
        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) {
            throw new \Exception("Needs a 256-bit key!");
        }
        /// create initialization vector
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        $iv = random_bytes($iv_size); // dengan catatan dibawah
        /// encrypt
        $encrypted = openssl_encrypt($data,
                                        "aes-256-cbc",
                                        $key,
                                        OPENSSL_RAW_DATA,
                                        $iv 
                                    );
        /// create signature, against padding oracle attacks
        $signature = mb_substr(hash_hmac("sha256",
                                        $encrypted,
                                        $key,
                                        true)
                                ,0,10,"8bit");
        /// combine all, encode, and format
        $encoded = chunk_split(base64_encode($signature.$iv.$encrypted));
        return $encoded;
    }

    // Decryption Function
    function inacbg_decrypt($str, $strkey){
        $first = strpos($str, "\n")+1;
        $last = strrpos($str, "\n")-1;
        $str = substr($str,
            $first,
            strlen($str) - $first - $last);

        /// make binary representation of $key
        $key = hex2bin($strkey);
        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) {
            throw new \Exception("Needs a 256-bit key!");
        }
        /// calculate iv size
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        /// breakdown parts
        $decoded = base64_decode($str);
        $signature = mb_substr($decoded,0,10,"8bit");
        $iv = mb_substr($decoded,10,$iv_size,"8bit");
        $encrypted = mb_substr($decoded,$iv_size+10,NULL,"8bit");
        /// check signature, against padding oracle attack
        $calc_signature = mb_substr(hash_hmac("sha256",
                                                $encrypted,
                                                $key,
                                                true),
                                    0,10,"8bit");
        if(!$this->inacbg_compare($signature,$calc_signature)) {
            return "SIGNATURE_NOT_MATCH"; /// signature doesn't match
        }
        $decrypted = openssl_decrypt($encrypted,
                                        "aes-256-cbc",
                                        $key,
                                        OPENSSL_RAW_DATA,
                                        $iv
                                    );
        return $decrypted;
    }

    /// Compare Function
    function inacbg_compare($a, $b) {
        /// compare individually to prevent timing attacks

        /// compare length
        if (strlen($a) !== strlen($b)) return false;

        /// compare individual
        $result = 0;
        for($i = 0; $i < strlen($a); $i ++) {
        $result |= ord($a[$i]) ^ ord($b[$i]);
        }

        return $result == 0;
    }
}