<?php

namespace App\Http\Controllers\LabPK\FormTarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\FormTarif;

class DeleteController extends Controller
{
	public function delete($id)
	{
		FormTarif::where('id',$id)->delete();
		return ;
	}
}
