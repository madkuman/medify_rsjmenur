<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimenKategori;
use Auth;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$form = MikrobiologiSpesimenKategori::find($id);
		$form->created_by = Auth::user()->id;		
		$form->save();

		$form->delete();

		return 1;
	}
}
