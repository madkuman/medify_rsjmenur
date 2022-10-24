<?php

namespace App\Http\Controllers\Kasus\Tagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tagihan;
use App\Http\Controllers\Kasus\Tagihan\ReadController as TagihanRead;
use App\Http\Controllers\Kasus\Tagihan\CreateController as TagihanCreate;
use App\Models\Keuangan\TarifTipe;
use DOMPDF;
use MPDF;

define('relasi', ['lokasi.lokasi', 'admin', 'identitas', 'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'myRole', 'myRoleWithoutEnd']);

class ViewController extends Controller
{
	protected $tagihanRead;

	public function __construct(TagihanRead $tagihanRead, TagihanCreate $tagihanCreate)
	{
		$this->tagihanRead = $tagihanRead;
        $this->tagihanCreate = $tagihanCreate;
	}

    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $tagihan = $this->tagihanRead->get($kasus->id);
        if(!$tagihan)
        {
            $tagihan = $this->tagihanCreate->create($kasus->id);
        }

        $split_piutang = 0;
        $bpjssep = $kasus->bpjs_without_eager;
        foreach ($bpjssep as $value) {
            if($value->sisa_plafon<0) {
                $split_piutang = 1;
                break;
            };
        }

        $data['tipe_tarif'] = TarifTipe::all();
        $data['tagihans'] = $tagihan;
        $data['kasus'] = $kasus;
        $data['kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getAll();
        $data['default_kasir'] = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getDefaultKasir();
        $data['bpjssep'] = $bpjssep;
        $data['split'] = $split_piutang;
        $data['sidebar_active'] = 'tagihan';
        $data['active_nav'] = 'tagihan';
        $log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($kasus->id,'view','tagihan',null);
        return view('kasus.tagihan.index',$data);
    }

    public function print($nomor_kasus,$tagihan_id)
    { 
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $tagihan = Tagihan::where('kasus_id',$kasus->id)->orderBy('created_at', 'desc')->get();;
        if(count($tagihan) == 0)
        {
            $tagihan = $this->tagihanCreate->create($kasus->id);
        }
        $tagihan = $this->tagihanRead->getId($tagihan_id);
        $data['tagihan'] = $tagihan;
        if($tagihan->kasus_id != $kasus->id) abort(404);
        $data['kasus'] = $kasus;
        // $pdf = DOMPDF::loadView('kasus.tagihan.print',$data)->setPaper('a4');
        $pdf = MPDF::loadView('kasus.tagihan.print',$data, [], [
            'format' => 'a4'
        ]);
        return $pdf->stream('Print_Tagihan.pdf');
        // return view('kasus.tagihan.print',$data);
    }
}
