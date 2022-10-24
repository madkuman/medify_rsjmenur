<?php

namespace App\Http\Controllers\LabPK\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Form;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index()
	{
		$data['parameters'] = Form::all();
		$data['header'] = 'monitoring';
        $data['date_range_start_month_default'] = Carbon::today()->subMonth();
        $data['date_range_end_month_default'] = Carbon::today();
		return view('labpk.monitoring.index',$data);
	}
}
