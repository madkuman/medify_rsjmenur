<?php

namespace App\Http\Controllers\Radiology\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;

class ViewController extends Controller
{
	private static $departemen_id = 'radiologi';
	private static $link = "radiologi";

	public function index(Request $req)
	{
		$data['header'] = "pengaturan";
        $data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_id);
		$data['link'] = self::$link;
		return view('radiolog.pengaturan.index',$data);
	}

	public function indexHasil(Request $req)
	{
		$data['header'] = "pengaturan";
        $data['template'] = app('App\Http\Controllers\Radiology\Pengaturan\ReadController')->getAllTemplate();
		$data['link'] = self::$link;
		return view('radiolog.pengaturan.index-hasil',$data);
	}

	public function newHasil(Request $req)
	{
		$data['header'] = "pengaturan";
        $data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_id);
		$data['link'] = self::$link;
		return view('radiolog.pengaturan.new-hasil',$data);
	}

	public function editHasil(Request $req, $generic_id)
	{
		$data['header'] = "pengaturan";
        $data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_id);
        $data['template'] = app('App\Http\Controllers\Radiology\Pengaturan\ReadController')->getTemplateTarifIdByGenericId($generic_id);
		$data['tarif_id'] = $data['template']->pluck('tarif_id')->toArray();
		$data['link'] = self::$link;
		return view('radiolog.pengaturan.edit-hasil',$data);
	}

	public function edit($tarif_id)
	{
		$data['header'] = "pengaturan";
		$data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getSingle($tarif_id);
		$data['biasa'] = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifDetail($tarif_id, 1);
		$data['cito'] = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifDetail($tarif_id, 2);
		return view('radiolog.pengaturan.edit_layanan', $data);
	}

	public function view($tarif_id)
	{
		$data['header'] = "pengaturan";
		$data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getSingle($tarif_id);
		$detail = $this->formatDetail($data['tarif']);
		$data['kelas'] = $detail['list_kelas'];
		$data['detail'] = $detail['detail'];
		return view('radiolog.pengaturan.layanan', $data);
	}

    private function formatDetail($tarif)
    {
    	$data = [];
    	$list_kelas = [];
    	foreach($tarif->tarif as $t){
    		if($t->kelas_id == 0)	{
	    		if(!in_array('Non Kelas', $list_kelas))
	    			array_push($list_kelas, 'Non Kelas');
				$data[$t->tipe->nama]['Non Kelas'] = $t->harga;
    		}
    		else {
	    		if(!in_array($t->kelas->nama, $list_kelas))
	    			array_push($list_kelas, $t->kelas->nama);
				$data[$t->tipe->nama][$t->kelas->nama] = $t->harga;
    		}
    	}
    	return [
    		'detail' => $data,
    		'list_kelas' => $list_kelas
    	];
    }
}