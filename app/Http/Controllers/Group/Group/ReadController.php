<?php

namespace App\Http\Controllers\Group\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Grup;

class ReadController extends Controller
{
    	public function search(Request $request)
    	{
            $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
    		$groups = Grup::search($keyword)->get();

    		return json_encode($groups);
    	}

    	public function getRMGroupId()
    	{
    		$rm_id = Grup::where('is_group_rm',1)->first();
    		return $rm_id->id;
    	}

        public function getRMGroupSlug($slug)
        {
            $grup = Grup::where('slug',$slug)->first();
            return $grup;
        }
}
