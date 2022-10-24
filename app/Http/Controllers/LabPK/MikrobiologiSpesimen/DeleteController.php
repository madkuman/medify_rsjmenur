<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimen;
use Auth;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$form = MikrobiologiSpesimen::find($id);
		$form->created_by = Auth::user()->id;		
		$form->save();

		$form->delete();

		return 1;
	}
}
