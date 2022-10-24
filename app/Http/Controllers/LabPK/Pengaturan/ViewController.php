<?php

namespace App\Http\Controllers\LabPK\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Tarif;

class ViewController extends Controller
{
	private static $departemen_id = 'lab-pk';
	private static $link = "labpk";

	public function index(Request $req)
	{
		$data['header'] = "pengaturan";
		$data['link'] = self::$link;
		return view('labpk.pengaturan.index',$data);
	}

    public function indexLayanan(Request $req)
    {
        $data['header'] = "pengaturan";
        $data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_id);
        $data['link'] = self::$link;
        return view('labpk.pengaturan.layanan-index',$data);
    }

	public function view($tarif_id)
	{
		$data['header'] = "pengaturan";
		$data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getSingle($tarif_id);
		$detail = $this->formatDetail($data['tarif']);
		$data['kelas'] = $detail['list_kelas'];
		$data['detail'] = $detail['detail'];
		return view('labpk.pengaturan.layanan', $data);
	}

	public function editForm(Request $req, $id)
    {
        $data['header'] = "pengaturan";
		$data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getSingle($id);
        $data['forms'] = app('App\Http\Controllers\LabPK\Layanan\ReadController')->getForms($id);
        return view('labpk.pengaturan.edit_form', $data);
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
    			if(!empty($t->kelas)){
    				if(!in_array($t->kelas->nama, $list_kelas))
    					array_push($list_kelas, $t->kelas->nama);
    				$data[$t->tipe->nama][$t->kelas->nama] = $t->harga;
    			}
    		}
    	}
    	return [
    		'detail' => $data,
    		'list_kelas' => $list_kelas
    	];
    }
}