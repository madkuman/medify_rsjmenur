<?php

namespace App\Http\Controllers\Radiology\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\TemplateHasil;
use Bugsnag;

class ReadController extends Controller
{
	private $departmentCode = 8;

	public function getAllTemplate()
	{
		return TemplateHasil::get();
	}

	public function getTemplateTarifIdByGenericId($generic_id)
	{
		return TemplateHasil::where('generic_id', $generic_id)->get();
	}
}