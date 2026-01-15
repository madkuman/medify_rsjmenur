<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi;

use App\User;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;
use MPDF;
use DOMPDF;

class ViewController extends Controller
{
	public function __construct()
	{
		$this->asesmen_title = 'Asesmen Awal Keperawatan Neonatologi';
		$this->asesmen_namespace = 'App\Http\Controllers\Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi';
		$this->asesmen_slug = 'asesmen-awal-keperawatan-medis-neonatologi';
	}

	public function index($nomor_kasus)
	{
		$data = $this->buildData($nomor_kasus);
		$data['hasil'] = AlatBantu::where('type', $this->asesmen_slug)->where('kasus_id', $data['kasus']->id)->orderBy('created_at', 'desc')->get();
		$data['slug'] = $this->asesmen_slug;
		$data['sidebar_active'] = 'alat';
		return view('kasus.asesmen.' . $this->asesmen_slug . '.index', $data);
	}

	public function single($nomor_kasus, $hasil_id)
	{
		$data = $this->buildData($nomor_kasus);
		$data['slug'] = $this->asesmen_slug;
		$data['action'] = 'view';
		$data['hasil'] = AlatBantu::find($hasil_id);
		$data['hasil_data'] = json_decode($data['hasil']->val);

		return view('kasus.asesmen.' . $this->asesmen_slug . '.view', $data);
	}

	public function create($nomor_kasus)
	{
		$data = $this->buildData($nomor_kasus);
		$data['slug'] = $this->asesmen_slug;
		$data['action'] = 'create';

		return view('kasus.asesmen.' . $this->asesmen_slug . '.form', $data);
	}

	public function edit($nomor_kasus, $hasil_id)
	{
		$data = $this->buildData($nomor_kasus);
		$data['slug'] = $this->asesmen_slug;
		$data['action'] = 'edit';
		$data['hasil'] = AlatBantu::find($hasil_id);
		$data['hasil_data'] = json_decode($data['hasil']->val);

		return view('kasus.asesmen.' . $this->asesmen_slug . '.form', $data);
	}

	public function print($nomor_kasus, $hasil_id)
	{
		$data = $this->buildData($nomor_kasus);
		$data['slug'] = $this->asesmen_slug;
		$data['action'] = 'view';
		$data['print'] = 'print';
		$data['hasil'] = AlatBantu::find($hasil_id);
		$data['hasil_data'] = json_decode($data['hasil']->val);

		$pdf = MPDF::loadView('kasus.asesmen.' . $this->asesmen_slug . '.print', $data);
		return $pdf->stream('text-page.pdf');
	}

	public function buildData($nomor_kasus)
	{
		$data['kasus'] = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$data['form'] = (object)[
			'nama_show' => $this->asesmen_title,
			'slug' => $this->asesmen_slug,
		];
		$data['sidebar_active'] = 'alat';
		return $data;
	}
}
