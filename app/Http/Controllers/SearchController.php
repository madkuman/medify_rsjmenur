<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital\Grup;
use App\User;

class SearchController extends Controller
{
    private function getResult($search_keyword)
	{
        $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $search_keyword);
		$keyword = strlen($keyword) > 15 ? substr($keyword,0,15) : $keyword;

		if(!empty($keyword))
		{
			$groups = Grup::search($keyword)->take(6)->get();
			$data['groups'] = $groups;

			$users = User::search($keyword)->with('profesi_detail')->take(6)->get();
			$data['users'] = $users;
		}
		else
		{
			$data['groups'] = [];
			$data['users'] = [];
		}

		return $data;
	}

	public function ajaxSearch(Request $request)
	{
		$keyword = $request->get('keyword');
		$result = $this->getResult($keyword);

		return json_encode($result);
	}

	public function search(Request $request)
	{
		$data['keyword'] = $request->get('keyword');
		$data['result'] = $this->getResult($data['keyword']);

		return view('search.index', $data);
	}

	public function searchUser(Request $request)
	{
		$keyword = $request->get('keyword');
		$users = User::search($keyword)->with('profesi_detail')->take(10)->get();

		return json_encode($users);
	}
}
