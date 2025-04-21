<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeMcuHaji;

use App\User;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\VitalSign;
use MPDF;

class ViewController extends Controller
{
	public function __construct()
	{
		$this->asesmen_title = 'Resume MCU Haji';
		$this->asesmen_namespace = 'App\Http\Controllers\Kasus\Asesmen\ResumeMcuHaji';
		$this->asesmen_slug = 'resume-mcu-haji';
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
		//Vital-Sign
		$vital_sign = VitalSign::where('kasus_id', $data['kasus']->id)->orderBy('created_at', 'desc')->first();
		$data['vital_sign'] = optional($vital_sign);
		//AMT
		$amt = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'abbreviated-mental-test')->orderBy('created_at', 'desc')->first();
		$data['amt'] = json_decode(optional($amt)->val);
		//Barthel
		$barthel = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'barthel-index')->orderBy('created_at', 'desc')->first();
		$data['barthel'] = json_decode(optional($barthel)->val);
		//SRQ
		$srq = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'self-reporting-questionnaire')->orderBy('created_at', 'desc')->first();
		$data['srq'] = json_decode(optional($srq)->val);
		//Identitas
		$identitas = Identitas::where('kasus_id', $data['kasus']->id)->get();
		$data['identitas'] = optional($identitas);

		return view('kasus.asesmen.' . $this->asesmen_slug . '.view', $data);
	}

	public function create($nomor_kasus)
	{
		$data = $this->buildData($nomor_kasus);
		$data['slug'] = $this->asesmen_slug;
		$data['action'] = 'create';
		$user = User::select('id', 'name', 'profesi')->get();
		$data['dokter'] = $user->where('profesi', 1);
		$data['psikolog'] = $user->where('profesi', 4);

		//Vital-Sign
		$vital_sign = VitalSign::where('kasus_id', $data['kasus']->id)->orderBy('created_at', 'desc')->first();
		$data['vital_sign'] = optional($vital_sign);
		//AMT
		$amt = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'abbreviated-mental-test')->orderBy('created_at', 'desc')->first();
		$data['amt'] = json_decode(optional($amt)->val);
		//Barthel
		$barthel = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'barthel-index')->orderBy('created_at', 'desc')->first();
		$data['barthel'] = json_decode(optional($barthel)->val);
		//SRQ
		$srq = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'self-reporting-questionnaire')->orderBy('created_at', 'desc')->first();
		$data['srq'] = json_decode(optional($srq)->val);
		//Identitas
		$identitas = Identitas::where('kasus_id', $data['kasus']->id)->get();
		$data['identitas'] = optional($identitas);

		return view('kasus.asesmen.' . $this->asesmen_slug . '.form', $data);
	}

	public function edit($nomor_kasus, $hasil_id)
	{
		$data = $this->buildData($nomor_kasus);
		$data['slug'] = $this->asesmen_slug;
		$data['action'] = 'edit';
		$data['hasil'] = AlatBantu::find($hasil_id);
		$data['hasil_data'] = json_decode($data['hasil']->val);
		//Vital-Sign
		$vital_sign = VitalSign::where('kasus_id', $data['kasus']->id)->orderBy('created_at', 'desc')->first();
		$data['vital_sign'] = optional($vital_sign);
		//AMT
		$amt = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'abbreviated-mental-test')->orderBy('created_at', 'desc')->first();
		$data['amt'] = json_decode(optional($amt)->val);
		//Barthel
		$barthel = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'barthel-index')->orderBy('created_at', 'desc')->first();
		$data['barthel'] = json_decode(optional($barthel)->val);
		//SRQ
		$srq = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'self-reporting-questionnaire')->orderBy('created_at', 'desc')->first();
		$data['srq'] = json_decode(optional($srq)->val);
		//Identitas
		$identitas = Identitas::where('kasus_id', $data['kasus']->id)->get();
		$data['identitas'] = optional($identitas);

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

		//SRQ
		$srq = AlatBantu::where('kasus_id', $data['kasus']->id)->where('type', 'self-reporting-questionnaire')->orderBy('created_at', 'desc')->first();
		$data['srq'] = json_decode(optional($srq)->val);

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
