<?php

namespace App\Http\Controllers\Admin\StatusPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterStatusPulang;
use App\Models\Hospital\MasterStatusPulangSlug;

class ViewController extends Controller
{
    public function index(Request $request)
	{
		$data['status_pulang'] = MasterStatusPulang::get();
		return view('admin.status-pulang.index', $data);
	}

	public function create()
	{
		$data['slugs'] = MasterStatusPulangSlug::get();
		return view('admin.status-pulang.create', $data);
	}

	public function edit($id)
	{
		$data['status_pulang'] = MasterStatusPulang::find($id);
		$data['slugs'] = MasterStatusPulangSlug::get();
		return view('admin.status-pulang.edit', $data);
	}
}
