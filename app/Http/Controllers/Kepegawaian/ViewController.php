<?php

namespace App\Http\Controllers\Kepegawaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Hospital\Profesi;
use App\Models\Hospital\Spesialisasi;
use App\Models\Hospital\SubSpesialisasi;

class ViewController extends Controller
{
	protected $itemPerPage = 15;
	protected $user;
	
	function __construct(){
		$this->user = \Auth::user();
	}

  public function userControl()
  {
    // $data = User::all();
    $htmlheader_title = 'Kepegawaian | User Control';
    $contentheader_title = 'User Control';
    $cekPrefix = 'user-control';
    return view('kepegawaian.user.index',compact(
      'cekPrefix',
      'htmlheader_title',
      'contentheader_title'));
  }

  public function edit($id)
  {
    $data['user'] = User::find($id);
    $data['pegawai'] = Pegawai::get(['id', 'name', 'nrp']);
    $data['synced_acc'] = (!empty($data['user']->employee_id)) ? Pegawai::where('id', $data['user']->employee_id)->first() : NULL ;
    $data['profesi'] = Profesi::pluck('title','id')->toArray();
    $data['specialty'] = Spesialisasi::where('profession', $data['user']->profesi)->pluck('name','id')->toArray();
    $data['subspecialty'] = SubSpesialisasi::all();
    $data['origin'] = "Kepegawaian";
    return view('kepegawaian.user.edit', $data);
  }

  public function hasilKuisioner(Request $req)
  {
    $htmlheader_title = 'Kepegawaian | Hasil Kuisioner';
    $contentheader_title = 'Hasil Kuisioner';
    $cekPrefix = 'hasil-kuisioner';
    $nama = "Kuisioner";
    $id = 0;
    $total = 0;
    $hasil_puas = 0;
    $hasil_tidak = 0;
    $persen_puas = 0;
    $persen_tidak = 0;
    $kepuasan = null;
    
    $kuisionerlist = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisioner();
    
    if (!empty($req->namafilter)) {
      $kuisioner = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisionerByNama($req->namafilter);
    } else {
      $kuisioner = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getKuisionerByStatus();
    }

    if (!empty($kuisioner)) {
      $id = $kuisioner->id;
      $nama = $kuisioner->nama;
      $hasil = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getHasilKepuasan($id);
      $total = $hasil['total'];
      if ($total > 0) {
        $kepuasan = app('App\Http\Controllers\Kepegawaian\MasterKuisioner\ReadController')->getPersenKepuasan($id);
        $hasil_puas = $hasil['hasil_puas'];
        $hasil_tidak = $hasil['hasil_tidak'];
        $persen_puas = round(($hasil_puas/$total)*100,2);
        $persen_tidak = round(($hasil_tidak/$total)*100,2);
      }
    }

    return view('kepegawaian.hasil-kuisioner.index',compact(
      'cekPrefix',
      'htmlheader_title',
      'contentheader_title',
      'kepuasan',
      'kuisioner',
      'kuisionerlist',
      'id',
      'nama',
      'total',
      'hasil_puas',
      'hasil_tidak',
      'persen_puas',
      'persen_tidak'));
  }
}