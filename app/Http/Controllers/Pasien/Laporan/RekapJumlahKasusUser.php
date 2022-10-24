<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Kasus\Kolaborator;
use Carbon\Carbon;
use DB;

class RekapJumlahKasusUser extends Controller
{

	private function cmp($a, $b) {
		return strcmp($a->nama, $b->nama);
	}

	public function get($date_start,$date_end,$profesi)
	{
		$user = User::where('profesi',$profesi)->where('fake_account',0)->pluck('id')->toArray();
		$kolaborator = Kolaborator::select('user_id', DB::raw('count(*) as total'))->whereIn('user_id',$user)->whereHas('kasus', function($query) use ($date_start,$date_end){
			$query->whereBetween('created_at',[$date_start,$date_end]);
		})
		->with('user')->groupBy('user_id')->get();

		$kolabs = [];
		foreach ($kolaborator as $key => $item) {
			$temp = new \stdClass();
			$temp->nama = $item->user->name;
			$temp->total = $item->total;
			array_push($kolabs, $temp);
		}

		$kolabs = collect($kolabs)->sortBy('nama');

		$result['data'] = $kolabs;
		$result['date_start'] = $date_start;
		$result['date_end'] = $date_end;

		return $result;

	}

}
