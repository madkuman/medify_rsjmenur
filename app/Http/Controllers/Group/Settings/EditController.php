<?php

namespace App\Http\Controllers\Group\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;

class EditController extends Controller
{
    public function edit(Request $request){
    	try {
			DB::connection('mysql')->beginTransaction();
			$grup = Grup::find($request->id);
			$grup->slug = ($grup->name != $request->name) ? $this->createSlug($request->name) : $grup->slug ;
	    	$grup->name = $request->name;
	    	$grup->description = $request->description;
	    	if ($request->hasFile('avatar')) {
				$avatar = $request->file('avatar');
				$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($avatar,'grup');
				$avatar = $image['file_original'];
				$avatar_thumb = $image['file_thumbnail'];
				$grup->photo_ori = $avatar;
	    		$grup->photo_thumb = $avatar_thumb;
			}
			if ($request->hasFile('banner')) {
				$banner = $request->file('banner');
				$image = app('App\Http\Controllers\Functions\ImageUploader')->upload($banner,'banner');
				$banner = $image['file_original'];
				$grup->banner = $banner;
			}
			$grup->save();

			$status = 1;
			$message = 'Berhasil mengedit grup';
			$title = 'Berhasil!';
			DB::connection('mysql')->commit();
			
		} catch (Exception $e) {
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
    }

    public function editAPI($id, $nama, $deskripsi)
    {
    	try {
			DB::connection('mysql')->beginTransaction();
			$grup = Grup::find($id);
			$grup->slug = ($grup->name != $nama) ? $this->createSlug($nama) : $grup->slug ;
	    	$grup->name = $nama;
	    	$grup->description = $deskripsi;
	    	
			$grup->save();

			$status = 1;
			DB::connection('mysql')->commit();
			
		} catch (Exception $e) {

			$status = -1;
			DB::connection('mysql')->rollback();
			Bugsnag::notifyException($e);
		}
		return $status;
    }

    public function editFromUnitTindakan($nama, $url_old, $url_new)
    {
		$grup = Grup::where('url', $url_old)->first();
		$grup->slug = ($grup->name != "Unit Tindakan ".$nama) ? $this->createSlug("Unit Tindakan ".$nama) : $grup->slug ;
		$grup->url = $url_new;
    	$grup->name = "Unit Tindakan ".$nama;
    	
		$grup->save();
		return $grup;
    }

    private function createSlug($nama)
	{
		$slug = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $nama));
		$slug = str_replace(' ', '-', $slug);

		if(is_null(Grup::where('slug', $slug)->first()))
			return $slug;
		$num = 1;
		while(1) {
			$new_slug = $slug.'-'.$num;
			if(is_null(Grup::where('slug', $new_slug)->first()))
				return $new_slug;
			$num++;
		}
	}
}
