<?php

namespace App\Http\Controllers\Admin\ThirdParty\RsOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Online\Informasi;
use DB;

class PostController extends Controller
{

	public function update($slug, $content = null)
	{
		try {
			DB::beginTransaction();      

			$cms = Informasi::where('slug',$slug)->first();
			$cms->content = $content;
			$cms->save();
			DB::commit();

			return true;

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			return false;
		}
	}
}
