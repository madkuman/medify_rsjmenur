<?php

namespace App\Http\Controllers\Pasien\PasienWali;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienWali;
use Auth;


class CreateController extends Controller
{
    public function create($human)
    {
        try{
            $wali = new PasienWali;
            $wali->name = $human['name'];
            $wali->gender = $human['gender'];
            $wali->address = $human['address'];
            $wali->city = $human['city'];
            $wali->district = $human['district'];
            $wali->kelurahan = $human['kelurahan'];
            $wali->birthplace = $human['birthplace'];
            $wali->birthdate = $human['birthdate'];
            $wali->phone = $human['phone'];
            $wali->ktp = $human['ktp'];
            $wali->is_anggota = $human['is_anggota'];

            if($human['is_anggota'] == 1)
            {
                $wali->tni_nama = $human['tni_nama_kerabat'];
                $wali->tni_nrp = $human['tni_nrp_kerabat'];
                $wali->tni_keanggotaan_id = $human['tni_keanggotaan_kerabat'];
                $wali->tni_pangkat_id = $human['tni_pangkat_kerabat'];
                $wali->tni_kotama_id = $human['tni_kotama_kerabat'];
                $wali->tni_satker_id = $human['tni_satker_kerabat'];
                $wali->tni_hubungan_type = $human['tni_relative_kerabat'];
            }
            if(!empty(Auth::user()))
                $wali->created_by = Auth::user()->id;
            else
                $wali->created_by = 1;
            $wali->save();
            
            return array(
                'kerabat' => $wali,
                'status' => 1
            );
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }


    }
}
