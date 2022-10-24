<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Grup;
use Auth;
use App\Models\Hospital\UserGroup;

class CreateController extends Controller
{
	public function create($name, $modul_url, $official = 0)
	{
		$grup = new Grup;
		$grup->name = $name;
		$grup->official = $official; //panggil fungsi dengan $official = 1 untuk membuat official group
		$grup->url = $modul_url;
		$grup->created_by = Auth::user()->id;
		$grup->icons = 'fa fa-users';
		$grup->icons_img = '009-hospital-bed.png';

		// CREATE SLUG (OBSOLETE)
		// $slug = preg_replace('~[^\pL\d]+~u', '-', $name);
		// $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
		// $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
		// $slug = trim($slug, '-'); // trim
		// $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
		// $slug = strtolower($slug); // lowercase
		// $metal_slug = $slug;
		// $i = 1;
		// while(!is_null(Grup::where("slug",$slug)->first())){
		// 	$i++;
		// 	$slug = $metal_slug."_".$i;
		// }

		$grup->slug = $this->createSlug($name);
		$grup->save();

		$new_member = app('App\Http\Controllers\Group\Members\CreateController')->createAPI($grup->id, Auth::user()->id, 1, 1);

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
