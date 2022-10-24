<?php

namespace App\Http\Controllers\Admin\Kasus\InformedConsent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\InformedConsent;

class DeleteController extends Controller
{
	public function delete($id)
	{
		$agama = InformedConsent::where('id',$id)->first();
		$agama->delete();
		return;
	}    
}
