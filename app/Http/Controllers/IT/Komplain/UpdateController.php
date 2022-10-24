<?php

namespace App\Http\Controllers\IT\Komplain;

use Auth;
use App\Models\IT\Komplain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    protected $model; 

    function __construct()
    {
        $this->model = new Komplain;
    }

	public function update($data, $id)
	{
    	$komp = Komplain::where('id', $id)->first();
        $komp->waktu_respon = $data['waktu_respon'];
        $komp->jenis_komplain_id = $data['jenis_komplain_id'];
        $komp->teknisi = $data['teknisi'];
        $komp->catatan = $data['catatan'];
        $komp->respon = $data['respon'];
                
        $komp->save();
	}
}
