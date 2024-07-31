<?php

namespace App\Http\Controllers\Kasus\Asesmen\IdentifikasiBayi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DOMPDF;

class ViewController extends Controller
{
    protected $route;
    protected $jenis;
    protected $asesmen;
    
    public function __construct()
    {
        $this->route = "identitikasi-bayi";
        $this->jenis = "Identifikasi Bayi";
        $this->asesmen = new ReadController();
    }

    public function index($nomor_kasus)
    {
        
        $kasus = $this->asesmen->kasus($nomor_kasus);
        $data['kasus'] = $kasus;
        $data_asesmen = $this->asesmen->getDataByRoute($this->route, $kasus->id)->each->setAppends(['json_val']);

        $data["data_bagan_neuromuskular"] = $this->asesmen->data_bagan_neuromuskular;
        $data["data_bagan_ballard"] = $this->asesmen->data_bagan_ballard;
        $data["data_asesmen"] = $data_asesmen;
        $data["sidebar_active"] = "alat";

        return view('kasus.asesmen.identitikasi-bayi.index', $data);
    }

    public function print($nomor_kasus, $id){
        $kasus = $this->asesmen->kasus($nomor_kasus);
        $data_asesmen = $this->asesmen->getDataById($id)->setAppends(['json_val']);

        $data['kasus'] = $kasus;
        $data["data_bagan_neuromuskular"] = $this->asesmen->data_bagan_neuromuskular;
        $data["data_bagan_ballard"] = $this->asesmen->data_bagan_ballard;
        $data['data_asesmen'] = $data_asesmen;
        
        set_time_limit(500);
        $pdf = DOMPDF::loadView('kasus.asesmen.identitikasi-bayi.print', $data);
        return $pdf->stream('print.pdf');
    }
}