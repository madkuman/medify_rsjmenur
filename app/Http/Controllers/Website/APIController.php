<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Kolaborator;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;
use Carbon\Carbon;
use App\Models\Hospital\Spesialisasi;
use App\Models\Hospital\Kelas;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;


class APIController extends Controller
{
	public function dokterIndex(Request $request)
	{
		$dokters = [];
        $keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
		$specialty = $request->get("spesialis");
		$limit = 8;

		if(!empty($keyword))
		{
			$users = User::search($keyword)->select('id')->get()->map(function ($user) {
				return $user->id;
			});
			if(empty($specialty))
				$users = User::where('profesi',1)->whereIn('id',$users)->whereHas('user_profile_public_settings', function($q){
					$q->where('allow_publish',1);
				})->paginate($limit);
			else
				$users = User::where('profesi',1)->where('specialty',$specialty)->whereIn('id',$users)->whereHas('user_profile_public_settings', function($q){
					$q->where('allow_publish',1);
				})->paginate($limit);
		}
		else
		{
			if(empty($specialty))
				$users = User::where('profesi',1)->whereHas('user_profile_public_settings', function($q){
					$q->where('allow_publish',1);
				})->paginate($limit);
			else
				$users = User::where('profesi',1)->where('specialty',$specialty)->whereHas('user_profile_public_settings', function($q){
					$q->where('allow_publish',1);
				})->paginate($limit);
		}


		foreach($users as $user)
		{
			if(!empty($user->user_profile_public_settings->id))
			{

				if($user->user_profile_public_settings->allow_publish)
				{
					$dokter = new \stdClass();
					$dokter->nama = $user->name;
					$dokter->spesialis = $this->getUserSpesialis($user);
					$dokter->slug = $user->slug;
					$dokter->avatar = url("").'/'.$user->avatar_thumb;
					$dokters[] = $dokter;

				}
			}
		}
		$data["total"] = $users->total();
		$data["limit"] = $limit;
		$data["dokter"] = $dokters;
		return json_encode($data);
	}

	public function dokterSingle($slug)
	{
		$user = User::where('slug',$slug)->first();
		if(empty($user)) return json_encode('404');
		
		if(!empty($user->user_profile_public_settings->id))
		{

			if($user->user_profile_public_settings->allow_publish)
			{
				$dokter = new \stdClass();
				$dokter->nama = $user->name;
				$dokter->spesialis = $this->getUserSpesialis($user);
				$dokter->tentang = $user->about_me;
				$dokter->email = $user->email_official;
				$dokter->avatar = url("").'/'.$user->avatar_thumb;

				if($user->user_profile_public_settings->allow_pendidikan)
					$dokter->pendidikan = $user->pendidikan;

				if($user->user_profile_public_settings->allow_pelatihan)
					$dokter->pelatihan = $user->pelatihan;

				if($user->user_profile_public_settings->allow_karya)
					$dokter->karya = $user->karya;

				if($user->user_profile_public_settings->allow_skill)
					$dokter->skill = $user->skill;

				if($user->user_profile_public_settings->allow_jadwal)
					$dokter->jadwal = $this->getJadwal($user->jadwal);

				if($user->user_profile_public_settings->allow_kasus)
					$dokter->kasus = $this->getKasus($user->id);
				return json_encode($dokter);
			}
			else
			{
				return json_encode('404');
			}
		}
		return json_encode('404');
		
	}

	public function getSpesialis()
	{
		$spesialis = Spesialisasi::where('profession',1)->select(['id','name'])->get();
		return json_encode($spesialis);
	}

	private function updateSlug()
	{
		$user = User::all();
		foreach($user as $item)
		{
			$item->slug = $this->generateSlug($item->name);
			$item->save();
		}

	}

	

	private function getKasus($id)
	{
		$kolab = Kolaborator::where('user_id', $id)->pluck('kasus_id')->all();
		return Kasus::whereIn('id', $kolab)->select('judul_kasus')->get();
	}

	private function getJadwal($jadwals)
	{
		$jadwal_array = [];
		foreach($jadwals as $jadwal)
		{
			$object = new \stdClass();
			$object->poli = $jadwal->poli->name;
			$object->hari = $jadwal->hari;
			$object->hari_order = $jadwal->hari_order;
			$object->jam_buka = $jadwal->jam_buka;
			$object->jam_tutup = $jadwal->jam_tutup;
			$jadwal_array[] = $object;
		}
		return $jadwal_array;
	}

	private function getUserSpesialis($user)
	{
		if(empty($user->specialty)) $spesialis = 'Dokter';
		else $spesialis = $user->specialty_detail->name;
		return $spesialis;
	}

	public function getPoliAntrian()
	{
		$items = Poliklinik::with([
               'transaksi' => function($query){
                   	$query->whereIn('status',['1','2'])->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('updated_at','desc')->get();
               },
               'last_antrian' => function($query2){
               		$query2->orderBy('ordered_at','desc')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->get();
               }
           ])->get();

		foreach($items as $item)
		{
			if(!empty($item->last_antrian[0]->nomor_antrian))
				$item->total_antrian = $item->last_antrian[0]->nomor_antrian;
			else
				$item->total_antrian = 0;

			
			if(!empty($item->transaksi[0]->nomor_antrian))
				$item->last_antrian = $item->transaksi[0]->nomor_antrian;
			else
				$item->last_antrian = 0;

		}

		$subset = $items->map(function ($user) {
			return $user->only(['name', 'last_antrian', 'image_thumb','total_antrian']);
		});
		return json_encode($subset);
	}

	public function getKetersediaanBed()
	{
		$kelas = Kelas::where('rawat_inap',1)->get();
		$class_array = [];
		foreach($kelas as $item_kelas)
		{
			$ruangan_id = Ruangan::where('kelas',$item_kelas->id)->pluck('id')->toArray();
			$tempat_tidur_kosong = TempatTidur::whereIn('ruangan_id',$ruangan_id)->whereNull('transaksi_id')->whereNull('booking_id')->count();
			$tempat_tidur_total = TempatTidur::whereIn('ruangan_id',$ruangan_id)->count();
			$temp = new \StdClass();
			$temp->kelas = $item_kelas->nama;
			$temp->total_kosong = $tempat_tidur_kosong;
			$temp->total_kapasitas = $tempat_tidur_total;
			$class_array[] = $temp;
		}
		return json_encode($class_array);
	}

	public function getKetersediaanBedKelasApplicare()
	{
		$bangsals = app('App\Http\Controllers\RawatInap\Bangsal\ReadController')->getBangsalKelasApplicare();

		return json_encode($bangsals);
	}

    public function getKetersediaanRawatInap()
    {
        $bangsals = app('App\Http\Controllers\RawatInap\Bangsal\ReadController')->getKetersediaanRawatInap();

        return json_encode($bangsals);
    }
}
