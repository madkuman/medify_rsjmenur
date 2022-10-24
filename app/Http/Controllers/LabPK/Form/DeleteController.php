<?php

namespace App\Http\Controllers\LabPK\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Form;
use App\Models\LabPK\FormDetail;
use Auth;

class DeleteController extends Controller
{
	public function deleteDetail($ids)
	{
		if(empty($ids) || count($ids) == 0) return;
		FormDetail::whereIn('id',$ids)->delete();
		return ;
	}

	public function delete($id)
	{
		Form::where('id',$id)->delete();
		FormDetail::where('form_id',$id)->delete();
		return ;
	}
}
