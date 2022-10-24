<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class KepegawaianController extends Controller
{
    /**
	 * authenticated current user
	 */
    protected $user;

    function __construct(){
    	$this->user = \Auth::user();

    	$this->time = Carbon::now();
    }

	/**
	 * Show 'kepegawaian' dashboard
	 */

	public function index() {

		$status =   app('App\Http\Controllers\Kepegawaian\StatController')->status();
		$gender = app('App\Http\Controllers\Kepegawaian\StatController')->gender();
		// $ages = app('App\Http\Controllers\Kepegawaian\StatController')->ages();
		// $educations = app('App\Http\Controllers\Kepegawaian\StatController')->education();
		$emps_active = app('App\Http\Controllers\Kepegawaian\StatController')->getEmployeesActive();
		$emps_out = app('App\Http\Controllers\Kepegawaian\StatController')->getEmployeesOut();
		$employees = app('App\Http\Controllers\Kepegawaian\StatController')->getActiveEmpsToday()->count();

		return view('highlevel.kepegawaian', compact(
			'status',
			'gender',
			'employees',
			'ages',
			'educations',
			'emps_out',
			'emps_active'
		));
	}
}
