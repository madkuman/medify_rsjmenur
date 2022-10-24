<?php

namespace App\Http\Controllers\Kepegawaian\CorporateGrade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\TandaTangan;

class ViewController extends Controller
{
	public function index()
	{
		return view('kepegawaian.master.corporate-grade.index');
	}

	public function level()
	{
		return view('kepegawaian.master.corporate-grade.components.level.baru');
	}

	public function profesi()
	{
		return view('kepegawaian.master.corporate-grade.components.profesi.index');
	}

	public function profesiBaru()
	{
		return view('kepegawaian.master.corporate-grade.components.profesi.baru');
	}

	public function grade()
	{
		return view('kepegawaian.master.corporate-grade.components.grade.index');
	}

	public function gradeBaru()
	{
		return view('kepegawaian.master.corporate-grade.components.grade.baru');
	}

}
