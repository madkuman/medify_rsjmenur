<?php

namespace App\Http\Controllers\Kasus\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Form;
use App\Models\Urikkes\LabPKForm;

class ReadController extends Controller
{
    public function getForm($sidebar_id)
    {
    	$form = Form::whereHas('sidebar', function($q) use($sidebar_id){
    		$q->where('sidebar.id', $sidebar_id);
    	})->get();
    	return $form;
    }

    public function getLab($sidebar_id)
    {
    	$form = LabPKForm::whereHas('sidebar', function($q) use($sidebar_id){
    		$q->from(config('app.db_name').'_kasus.sidebar')->where('sidebar.id', $sidebar_id);
    	})->get();
    	return $form;
    }


}
