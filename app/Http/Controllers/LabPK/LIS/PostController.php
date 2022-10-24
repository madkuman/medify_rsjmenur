<?php

namespace App\Http\Controllers\LabPK\LIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\TransaksiDetail;
use App\Models\LabPK\Dokumen;
use App\Models\LabPK\Result;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use File;
use Auth;
use DateTime;
use Image;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Bugsnag;

class PostController extends Controller
{
    protected static $lis_url;

    public function __construct(){
        self::$lis_url = config('app.lis_url');
    }

    public function order($transaksi)
    {
        $data['Order'] = [
            "Patient_id" => (string)$transaksi->pasien->no_rm,
            "No.Ref" => (string)$transaksi->id,
            "Note" => "",
            "No.Lab" => "",
            "diagnosis" => isset($transaksi->kasus->diagnosisUtama->icd10->long_desc) ? substr($transaksi->kasus->diagnosisUtama->icd10->long_desc, 0, 75) : "",
            "Doctor_id" => (string)$transaksi->created_by,
            "Nama_doctor" => $transaksi->creator->name,
            "insurance_id" => (string)$transaksi->pembayaran->perusahaan_id,
            "Name_insurance" => $transaksi->pembayaran->perusahaan->nama,
            "origin_id" => (string)$transaksi->lokasi_id,
            "Name_origins" => $transaksi->asal->nama,
            "priority_id" => (string)$transaksi->class,
            "Name_priority" => $transaksi->kelas->nama,
            "service_id" => (string)$transaksi->asal->lokasi_departemen_id,
            "name_service" => $transaksi->asal->departemen->nama,
            "order_date" => $transaksi->created_at->toDateTimeString(),
            "dateofcreation" => $transaksi->created_at->toDateTimeString(),
            "Lastmodification" => "",
            "User_creation" => $transaksi->creator->name
        ];

        $detailArray = [];
        foreach($transaksi->detail as $detail){
            if(!is_null($detail->tarif->lis_id)){
                $temp["TEST_ID"] = (string)$detail->tarif->lis_id;
                $temp["NAME_TEST"] = $detail->tarif->deskripsi;
                array_push($detailArray, $temp);
            }
        }
        $data["TEST"] = $detailArray;
        $patient = $transaksi->pasien;
        
        $data["Patient"] = [
            "patient_id" => (string)$patient->no_rm,
            "name" => $patient->name,
            "dob" => $patient->date_of_birth,
            "gender_id" => ($transaksi->kasus->identitas->jenis_kelamin == 'L') ? (string) 1 : (string) 2,
            "SEX" => ($transaksi->kasus->identitas->jenis_kelamin == 'L') ? "LAKI-LAKI" : "PEREMPUAN",
            "address" => $patient->address,
            "data0" => $transaksi->kasus->active_sep->no_sep ?? "",
            "data1" => $transaksi->kasus->active_sep->tgl_sep ?? "",
            "data2" => "",
            "dateofcreation" => $patient->created_at->format('Y-m-d'),
            "lastmodification" => $patient->updated_at->format('Y-m-d'),
            "lastmodifiedby_id" => ""
        ];

        try
        {
            $client = new Client();
            $res = $client->request('POST', self::$lis_url.'/LisWS/Web/serviceData/Order', 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::JSON => $data,
                ]
            );
            $content = json_decode($res->getBody()->getContents());
            return ['result' => $content,
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

    public function updatePasien($pasien)
    {

        $data['patient'] = [
            'id' => (string)$pasien->id,
            'no_rm' => (string)$pasien->no_rm,
            'name' => $pasien->name,
            'place_of_birth' => $pasien->place_of_birth,
            'date_of_birth' => $pasien->date_of_birth,
            'phone' => $pasien->phone,
            'job' => $pasien->job,
            'sex' => $pasien->gender == 1 ? 'M' : 'F',
            'address' => $pasien->address,
            'city' => $pasien->alamat_kota->name,
            'kecamatan' => $pasien->alamat_kecamatan->name,
            'kelurahan' => $pasien->alamat_kelurahan->nama,
            'is_anggota' => $pasien->is_anggota,
            'tni_nrp' => $pasien->tni_nrp,
            'tni_keanggotaan'   => !is_null($pasien->tni_keanggotaan) ? $pasien->tni_keanggotaan->nama : '',
            'tni_pangkat'   =>  !is_null($pasien->tni_pangkat) ? $pasien->tni_pangkat->nama : '',
            'tni_kotama'    =>  !is_null($pasien->tni_kotama) ? $pasien->tni_kotama->nama : '',
            'tni_satker'    =>  !is_null($pasien->tni_satker) ? $pasien->tni_satker->nama : ''
        ];

        try
        {
            $client = new Client();
            $res = $client->request('POST', self::$lis_url.'/LisWS/Web/serviceData/UpdatePatient', 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::JSON => $data,
                ]
            );
            $content = json_decode($res->getBody()->getContents());
            // dd($content, $data);
            return $content;
        } catch (RequestException $e) {
            // echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }catch (\Exception $e){
            return FALSE;
            // app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            // echo Psr7\str($e);
        }

        return $data;
    }
 
    public function cancelOrder($transaksi, $detail)
    {
        $data['transaksi'] = [
            'id' => $transaksi->id,
            'pasien_id' => (string)$transaksi->pasien_id,
            'order_no' => $transaksi->order_no
        ];

        $transaksi_detail = [];
        foreach($detail as $d){
            array_push($transaksi_detail, [
                'tarif_id' => $d->tarif->lis_id,
                'tarif_text' => $d->tarif->deskripsi,
                'qty' => $d->qty
            ]);
        }
        $data['transaksi_detail'] = $transaksi_detail;

        try
        {
            $client = new Client();
            $res = $client->request('POST', self::$lis_url.'/LisWS/Web/serviceData/CancelOrder', 
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    \GuzzleHttp\RequestOptions::JSON => $data,
                ]
            );
            $content = json_decode($res->getBody()->getContents());
            // dd($content, $data);
            return $content;
        } catch (RequestException $e) {
            // echo Psr7\str($e->getRequest());
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
}