<?php

namespace App\Http\Controllers\Kasus\CPPT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\RuanganVisite;
use App\User;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function editCPPT(Request $request, $jenis = null)
	{

        $discharge_planning = null;

        if($request->discharge_enable == 1)
        {
            $discharge_planning = new \stdClass();
            $discharge_planning->discharge_umur = $request->discharge_umur == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_mobilitas = $request->discharge_mobilitas == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_perawatan = $request->discharge_perawatan == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_bantuan = $request->discharge_bantuan == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_perawatan_diri = $request->discharge_perawatan_diri == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_obat = $request->discharge_obat == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_diet = $request->discharge_diet == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_luka = $request->discharge_luka == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_latihan = $request->discharge_latihan == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_tenaga_khusus = $request->discharge_tenaga_khusus == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_medis = $request->discharge_medis == 'dicentang' ? 1 : 0;
            $discharge_planning->discharge_fisik = $request->discharge_fisik == 'dicentang' ? 1 : 0;
            $discharge_planning = json_encode($discharge_planning);
        }

        
		$cppt = CPPT::find($request->id);
        $cppt->preventif = ($request->preventif == 'dicentang') ? 1 : 0;
        $cppt->kuratif = ($request->kuratif == 'dicentang') ? 1 : 0;
        $cppt->rehab = ($request->rehab == 'dicentang') ? 1 : 0;
        $cppt->paliatif = ($request->paliatif == 'dicentang') ? 1 : 0;

        $cppt->subjective = $request->subjective;
		$cppt->objective = $request->objective;
		$cppt->assessment = $request->assessment;
		$cppt->plan = $request->plan;
		$cppt->ppa = $request->ppa;
        $cppt->prioritas = $request->input('prioritas');
        $cppt->perkiraan_hari_rawat = $request->input('perkiraan_hari_rawat');
		$cppt->updated_by = Auth::user()->id;
        $cppt->discharge_planning = $discharge_planning;

		$cppt->save();
		
        
		$kasusId = $cppt->kasus_id;
		$nomorKasus = Kasus::where('id',$kasusId)->first();

        app('App\Http\Controllers\Kasus\Diagnosis\PostController')->fromCPPTtoDiagnosis($kasusId,$cppt->assessment);

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasusId,'edit','cppt',$cppt->id);
	}

	public function overrideCPPT($nomor_kasus, Request $request)
	{
		$nomorKasus = $nomor_kasus;
        $kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();
        //dd($kasusId);
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();

		$cppt = CPPT::find($request->id);
		$cppt->created_by = Auth::user()->id;
		$cppt->save();

		$status = 1;
		$message = 'CPPT berhasil di override!';
		$title = 'Berhasil!';

		$nomorKasus = Kasus::where('id',$cppt->kasus_id)->first();
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($cppt->kasus->id,'edit','cppt',$cppt->id);

		if(!empty($cppt->tagihan_detail_id))
		{
			$deleteTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\DeleteController')->deleteFromCppt($nomor_kasus,$cppt->tagihan_detail_id);
			//dd("abcd");
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'delete','cppt',$cppt->id);
		}

		if($kasus->lokasi->lokasi->departemen->id == 3 && Auth::user()->profesi == 1)
        {
            $ruangan = Ruangan::where('lokasi_id',$kasus->lokasi->lokasi->id)->first();
           
            $user = User::find(Auth::user()->id);
            if(!empty($user->subspecialty))
            {
                $visite = $this->getVisite($ruangan->id,3);
            }
            else if(!empty($user->specialty))
            {
                $visite = $this->getVisite($ruangan->id,2);
            }
            else
            {
                $visite = $this->getVisite($ruangan->id,1);
            }
            if(empty($visite))
            {
                DB::connection('kasus')->rollback();
                $status = -1;
                $message = 'CPPT gagal dibuat! Harga Visite Belum dimasukkan';
                $title = 'Gagal!';

                return redirect('/kasus/'.$nomorKasus.'/datamedis#cppt')
                ->with('message', $message)
                ->with('active_nav','cppt')
                ->with('title',$title)
                ->with('status', $status);
            }
            else $unit_price = $visite->tarif->harga;
            
            $data['tarif_id'] = $visite->tarif_id;
            $data['tarif_tipe_id'] = 1;
            $data['tarif_kelas'] = $kasus->kelas->nama;
            $data['kasus_id'] = $kasus->id;
            $data['desc'] = $visite->tarif->master->deskripsi.' - '.Auth::user()->name;
            $data['unit_price'] = $unit_price;
            $data['qty'] = 1;
            $data['lokasi'] = $kasus->lokasi->lokasi->id;
            $data['daftar_harga_id'] = 0;
            $data['sep_id'] = $kasus->sep_id;
            $data['departemen_id'] = 3;
            $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
            $cppt->tagihan_detail_id = $createDetail->id;
            $cppt->save();
        }
	}

	public function APIVerifikasi($nomor_kasus,$cppt_id)
	{
		$cppt = CPPT::find($cppt_id);
		$cppt->timestamps = false;
		$cppt->verified_by = Auth::user()->id;
		$cppt->verified_at = Carbon::now();
		$cppt->save();

		$return['verified_by'] = $cppt->verifier->name;
		$return['verified_at'] = $cppt->verified_at->format('d F Y, H:i');

		return json_encode($return);
	}

    public function APIVerifikasiNers($nomor_kasus,$cppt_id)
    {
        $cppt = CPPT::find($cppt_id);
        $cppt->timestamps = false;
        $cppt->verified_ners_by = Auth::user()->id;
        $cppt->verified_ners_at = Carbon::now();
        $cppt->save();

        $return['verified_by'] = $cppt->verifikatorNers->name;
        $return['verified_at'] = $cppt->verified_ners_at->format('d F Y, H:i');

        return json_encode($return);
    }

    private function getVisite($ruangan_id,$flag)
    {
        $visite = RuanganVisite::where('ruangan_id',$ruangan_id)->where('jenis_dokter',$flag)->first();
        return $visite;
    }

    public function reviewCPPT(Request $request)
    {
        $cppt = CPPT::find($request->id);
        $cppt->timestamps = false;
        $cppt->review = $request->review;
        $cppt->review_by = Auth::user()->id;
        $cppt->review_at = Carbon::now();
        $cppt->save();
    }
}
