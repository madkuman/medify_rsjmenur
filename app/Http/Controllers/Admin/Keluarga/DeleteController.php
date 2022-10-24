<?php

namespace App\Http\Controllers\Admin\Keluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisHubunganKeluarga;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$keluarga = JenisHubunganKeluarga::where('id',$id)->first();
		$keluarga->delete();
		return;
	}
}