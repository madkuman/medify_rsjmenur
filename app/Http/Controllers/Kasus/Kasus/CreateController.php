<?php

namespace App\Http\Controllers\Kasus\Kasus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Lokasi;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\BPJSSEP;
use App\Models\Hospital\TransaksiMasuk;
use App\User;
use App\Models\Pasien\PasienPembayaran;
use Auth;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\RawatInap\Transaksi as TransaksiInap;
use App\Models\IGD\Transaksi as TransaksiIGD;
use App\Models\Hospital\UserGroup;
use Bugsnag;
use Carbon\Carbon;

class CreateController extends Controller
{
	public function createKasus($judul_kasus,$pasien,$location,$transaksi_lokal_id,$kelas,$bayar_id,$nomor_sep,$id_ibu=null, $asal_rujukan_id=null)
	{
		
		$id = 0;

		$kasus = New Kasus;
		$kasus->judul_kasus = $judul_kasus;
		$kasus->created_by = $id;

		$kasus->asal_rujukan_id = $asal_rujukan_id ?? null;

		if (!empty($pasien->id)) {
			$kasus->pasien_id = $pasien->id;
		}
		$kasus->kelas_id = $kelas;
		$kasus->pasien_pembayaran_id = $bayar_id;
		if($id_ibu != null)
		{
			$kasus->kasus_id_ibu = $id_ibu;
		}
		$kasus->sep_id = $nomor_sep; // bisa kosong
		$kasus->save();
		$nomor_kasus = $this->generateNomorKasus($kasus->id);
		$kasus->nomor_kasus = $nomor_kasus;
		$kasus->created_at = Carbon::now();
		$kasus->save();


		if ($bayar_id!=null) {
			$pasien_pembayaran = PasienPembayaran::find($bayar_id);
		}
		else {
			$pasien_pembayaran = null;
		}
		$lokasi = $this->insertLokasi($kasus->id,$location);
		if($transaksi_lokal_id != null)
		{
			$collaborator = $this->beCollaborator($kasus->id,$transaksi_lokal_id); //bisa kosong
		}
		$identitas = $this->insertIdentitas($kasus->id,$pasien, $pasien_pembayaran);
		$tagihan = $this->insertTagihan($kasus->id);
		if (!empty($pasien_pembayaran)) {
			// dd($kasus->lokasi);
			$total_plafon = 0;
			if(!empty($kasus->lokasi->lokasi))
			{
				if ($kasus->lokasi->lokasi->departemen->id == 2)
					if($transaksi_lokal_id != null)
					{
						$total_plafon = $this->getPoliPlafon($transaksi_lokal_id); //bisa kosong
					}	
			}
			else
				$total_plafon = 0;

			if($pasien_pembayaran->perusahaan->tipe->id == 1)
			{
				$request = new \Illuminate\Http\Request();
				$request['custom_sep'] = $nomor_sep;
				$request['total_plafon'] = $total_plafon;
				$kasus=app('App\Http\Controllers\Kasus\Identitas\PostController')->editSEPKasus($request,$kasus->nomor_kasus);
			}

			# CREATE ENCOUNTER SATUSEHAT
			if (config('medify.third-party.satusehat.on', 0)) {
				$encounter_data = new Request([
					'kasus_id' => $kasus->id
				]);
				$encounter = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController)->saveByKasus($encounter_data);
			}
		}
		return $kasus;
	}

	public function setCreateKasus($request){
		$id = 0;

		$judul_kasus        = $request->judul_kasus ?? null;
		$pasien             = $request->pasien ?? null;
		$location           = $request->location ?? null;
		$transaksi_lokal_id = $request->transaksi_lokal_id ?? null;
		$kelas              = $request->kelas ?? null;
		$bayar_id           = $request->bayar_id ?? null;
		$nomor_sep          = $request->nomor_sep ?? null;
		$id_ibu             = $request->id_ibu ?? null;

		$kasus = New Kasus;
		$kasus->judul_kasus = $judul_kasus;
		$kasus->created_by = $id;

		$kasus->asal_rujukan_id = $request->asal_rujukan_id ?? null;
		
		if (!empty($pasien->id)) {
			$kasus->pasien_id = $pasien->id;
		}
		$kasus->kelas_id = $kelas;
		$kasus->pasien_pembayaran_id = $bayar_id;
		if($id_ibu != null)
		{
			$kasus->kasus_id_ibu = $id_ibu;
		}
		$kasus->sep_id = $nomor_sep; // bisa kosong
		$kasus->save();
		$nomor_kasus = $this->generateNomorKasus($kasus->id);
		$kasus->nomor_kasus              = $nomor_kasus;
		$kasus->created_at               = Carbon::now();
		$kasus->sirs_pelayanan_khusus_id = $request->sirs_pelayanan_khusus_id;
		$kasus->save();


		if ($bayar_id!=null) {
			$pasien_pembayaran = PasienPembayaran::find($bayar_id);
		}
		else {
			$pasien_pembayaran = null;
		}
		$lokasi = $this->insertLokasi($kasus->id,$location);
		if($transaksi_lokal_id != null)
		{
			$collaborator = $this->beCollaborator($kasus->id,$transaksi_lokal_id); //bisa kosong
		}
		$identitas = $this->insertIdentitas($kasus->id,$pasien, $pasien_pembayaran);
		$tagihan = $this->insertTagihan($kasus->id);
		if (!empty($pasien_pembayaran)) {
			// dd($kasus->lokasi);
			$total_plafon = 0;
			if(!empty($kasus->lokasi->lokasi))
			{
				if ($kasus->lokasi->lokasi->departemen->id == 2)
					if($transaksi_lokal_id != null)
					{
						$total_plafon = $this->getPoliPlafon($transaksi_lokal_id); //bisa kosong
					}	
			}
			else
				$total_plafon = 0;

			if($pasien_pembayaran->perusahaan->tipe->id == 1)
			{
				$request = new \Illuminate\Http\Request();
				$request['custom_sep'] = $nomor_sep;
				$request['total_plafon'] = $total_plafon;
				app('App\Http\Controllers\Kasus\Identitas\PostController')->editSEPKasus($request,$kasus->nomor_kasus);
			}
		}
		return $kasus;
	}

	private function generateNomorKasus($id)
	{
		$last_kasus = 10000000000+$id;
		$slug_kasus = 'med'.substr($last_kasus, 1);

		return $slug_kasus;
	}

	private function beCollaborator($kasus_id,$transaksi_lokal_id){

		$id = Auth::user()->id;
		$id_user = $id;
		$user = User::find($id);
		$profesi = $user->profesi;

		if($profesi == 1) $role = '2';
		elseif($profesi == 2) $role = '6';
		elseif($profesi == 3) $role = '10';
		elseif($profesi == 4) $role = '13';
		elseif($profesi == 5) $role = '17';
		elseif($profesi == 8) $role = '4';
		elseif($profesi == 12) $role = '15';
		elseif($profesi == 16) $role = '14';
		elseif($profesi == 19) $role = '18';
		elseif($profesi == 20) $role = '11';
		else $role = '0';

		$data = new Kolaborator;
		$data->kasus_id = $kasus_id;
		$data->user_id = $id_user;
		$data->admin = 0;
		$data->invitation = 1;
		$data->created_by = Auth::user()->id;
		$data->save();

		$kasus = Kasus::find($kasus_id);
		//undangan perawat
		if ($kasus->lokasi->lokasi_departemen_id == 2) {
			//rawatjalan
			$undangan = $this->undangPerawatJalan($kasus_id,$transaksi_lokal_id);
		}
		elseif ($kasus->lokasi->lokasi_departemen_id == 1) {
			//igd	
			$undangan = $this->undangPerawatIGD($kasus_id,$transaksi_lokal_id);
		}

	}

	public function undangPerawatJalan($kasus_id,$transaksi_lokal_id)
	{
		$kasus = Kasus::find($kasus_id);
		$kolaborator = Kolaborator::where('kasus_id',$kasus_id)->pluck('user_id')->toArray();
		$transaksi = TransaksiRawatJalan::with('poliklinik')->find($transaksi_lokal_id);
		$group_id = $transaksi->poliklinik->group_id;
		$member = UserGroup::where('group_id',$group_id)->get();
		if (!empty($member)) {
			foreach ($member as $item) {
				$user = User::find($item->users_id);
				if(!empty($user->profesi)){
					if($user->profesi=='2' && !in_array($user->id, $kolaborator)){
						$data = new Kolaborator;
						$data->kasus_id = $kasus_id;
						$data->user_id = $item->users_id;
						$data->admin = 0;
						$data->invitation = 0;
						$data->created_by = Auth::user()->id;
						$data->save();

						$notif = app('App\Http\Controllers\Users\Notification\CreateController')->create($user->id, Auth::user()->id, Auth::user()->name.' mengundang anda pada Kasus', 'kasus/'.$kasus->nomor_kasus);
					}
				}						
			}
		}
	}

	public function undangPerawatInap($kasus_id,$transaksi_lokal_id)
	{
		$kasus = Kasus::find($kasus_id);
		$kolaborator = Kolaborator::where('kasus_id',$kasus_id)->pluck('user_id')->toArray();
		$transaksi = TransaksiInap::with('tempat_tidur.ruangan.bangsal')->find($transaksi_lokal_id);
		$group_id = $transaksi->tempat_tidur->ruangan->bangsal->group_id;
		$member = UserGroup::where('group_id',$group_id)->get();
		if (!empty($member)) {
			foreach ($member as $item) {
				$user = User::find($item->users_id);
				if($user->profesi=='2' && !in_array($user->id, $kolaborator)){
					$data = new Kolaborator;
					$data->kasus_id = $kasus_id;
					$data->user_id = $item->users_id;
					$data->admin = 0;
					$data->invitation = 0;
					$data->created_by = Auth::user()->id;
					$data->save();

					$notif = app('App\Http\Controllers\Users\Notification\CreateController')->create($user->id, Auth::user()->id, Auth::user()->name.' mengundang anda pada Kasus', 'kasus/'.$kasus->nomor_kasus);
				}						
			}
		}
	}

	public function undangPerawatIGD($kasus_id,$transaksi_lokal_id)
	{
		$kasus = Kasus::find($kasus_id);
		$kolaborator = Kolaborator::where('kasus_id',$kasus_id)->pluck('user_id')->toArray();
		$transaksi = TransaksiIGD::with('ruangan')->find($transaksi_lokal_id);
		$group_id = $transaksi->ruangan->group_id;
		$member = UserGroup::where('group_id',$group_id)->get();
		if (!empty($member)) {
			foreach ($member as $item) {
				$user = User::find($item->users_id);
				if(!isset($user))
					continue;
				if($user->profesi=='2' && !in_array($user->id, $kolaborator)){
					$data = new Kolaborator;
					$data->kasus_id = $kasus_id;
					$data->user_id = $item->users_id;
					$data->admin = 0;
					$data->invitation = 0;
					$data->created_by = Auth::user()->id;
					$data->save();

					$notif = app('App\Http\Controllers\Users\Notification\CreateController')->create($user->id, Auth::user()->id, Auth::user()->name.' mengundang anda pada Kasus', 'kasus/'.$kasus->nomor_kasus);
				}						
			}
		}
	}

	public function insertLokasi($kasus_id,$lokasi){

		$data = new Lokasi;
		$data->kasus_id = $kasus_id;
		$data->lokasi_id = $lokasi;
		$data->created_by = Auth::user()->id;
		$data->save();

		return 1;
	}

	private function insertIdentitas($kasus_id,$patient,$pasien_pembayaran)
	{
		$id_user = Auth::user()->id;
		if($patient->gender == 1) $gender = 'L';
		else $gender = 'P';
		$data = new Identitas;
		$data->nama = $patient->name;
		$data->jenis_kelamin = $gender;
		$data->alamat = $patient->address;
		$data->pekerjaan = $patient->job;
		$data->tempat_lahir = $patient->place_of_birth;
		$data->tanggal_lahir = $patient->date_of_birth;
		$data->no_hp = $patient->phone;
		$data->kasus_id = $kasus_id;
		if (!empty($patient->id)) {
			$data->pasien_id = $patient->id;
		}
		$data->avatar_thumb = $patient->photo_thumb;
		$data->avatar_small = $patient->photo_thumb;
		$data->avatar = $patient->photo_ori;
		if (!empty($patient->umur)) {
			$data->umur = $patient->umur;
		}
		if (!empty($pasien_pembayaran)) {
			$data->asuransi = $pasien_pembayaran->perusahaan->nama;
			$data->no_asuransi = $pasien_pembayaran->no_asuransi;
		}

		$data->status = $patient->marriage;
		$data->no_identitas = $patient->no_identitas;
		$data->updated_by = $id_user;
		if (!empty($patient->asal_rujukan)) {
			$data->asal_rujukan = $patient->asal_rujukan;
		}
		if (!empty($patient->age)) {
			$data->umur = $patient->age;
			$usia_masuk = $patient->getAgeDayAttribute(Carbon::today()->toDateString());
			$data->usia_masuk = $usia_masuk;
		}
		
		$data->save();

	}

	private function insertTagihan($kasus_id)
	{

		$tagihan = new Tagihan;
		$tagihan->kasus_id = $kasus_id;
		$tagihan->total_bill = 0;
		$tagihan->total_paid =0;
		$tagihan->is_paid = 0;
		$tagihan->created_by = Auth::user()->id;
		$tagihan->save();

		return 1;
	}

	private function getPoliPlafon($transaksi_lokal_id)
	{
		$transaksi_rj = TransaksiRawatJalan::with('poliklinik')->find($transaksi_lokal_id);
		return $transaksi_rj->poliklinik->plafon_sep;
	}
}
