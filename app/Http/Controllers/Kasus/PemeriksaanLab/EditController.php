<?php

namespace App\Http\Controllers\Kasus\PemeriksaanLab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\DarahLengkap;
use App\Models\Kasus\Urine;
use App\Models\Kasus\Immunologi;
use App\Models\Kasus\PapSmear;
use App\Models\Kasus\Feces;
use Auth;

class EditController extends Controller
{
    public function edit($data)
    {
        $darah = DarahLengkap::where('id',$data['darah_id'])->first();
        $darah->kasus_id = $data['kasus_id'];
        $darah->kolesterol_total = $data['kolesterol_total'];
        $darah->hdl = $data['hdl'];
        $darah->ldl = $data['ldl'];
        $darah->triglyceride = $data['triglyceride'];
        $darah->glukosa_acak = $data['glukosa_acak'];
        $darah->hba_1c = $data['hba_1c'];
        $darah->glukosa_2_jam_pp = $data['glukosa_2jam'];
        $darah->glukosa_puasa = $data['glukosa_puasa'];
        $darah->sgot = $data['sgot'];
        $darah->sgpt = $data['sgpt'];
        $darah->bilirubin_direk = $data['bilirubin_direk'];
        $darah->bilirubin_indirek = $data['bilirubin_indirek'];
        $darah->bilirubin_total = $data['bilirubin_total'];
        $darah->alkali_fosfatase = $data['alkali_fosfatase'];
        $darah->gamma_gt = $data['gamma_gt'];
        $darah->total_protein = $data['total_protein'];
        $darah->albumin = $data['albumin'];
        $darah->globulin = $data['globulin'];
        $darah->ureum_bun = $data['ureum_bun'];
        $darah->kreatinin = $data['kreatinin'];
        $darah->asam_urat = $data['asam_urat'];
        $darah->hemoglobin = $data['hemoglobin'];
        $darah->led = $data['led'];
        $darah->eritrosit = $data['eritrosit'];
        $darah->leukosit = $data['leukosit'];
        //$darah->hct = $data['hct'];
        $darah->trombosit = $data['trombosit'];
        $darah->mcv = $data['mcv'];
        $darah->mch = $data['mch'];
        $darah->mchc = $data['mchc'];
        $darah->retikulosit = $data['retikulosit'];
        $darah->diff_eosinofil = $data['diff_eosinofil'];
        $darah->diff_basofil = $data['diff_basofil'];
        $darah->diff_stab = $data['diff_stab'];
        $darah->diff_segmen = $data['diff_segmen'];
        $darah->diff_limposit = $data['diff_limposit'];
        $darah->diff_monosit = $data['diff_monosit'];
        $darah->updated_by = Auth::user()->id;
        $darah->hematokrit = $data['hematokrit'];
        $darah->cholinnesterase = $data['cholinnesterase'];
        $darah->na = $data['na'];
        $darah->k = $data['k'];
        $darah->cl = $data['cl'];
        $darah->ca = $data['ca'];
        $darah->pendarahan = $data['pendarahan'];
        $darah->pembekuan = $data['pembekuan'];
        $darah->psa_eclia = $data['psa_eclia'];
        $darah->pt = $data['pt'];
        $darah->save();
        //dd($darah);
        return $darah;
    }
    public function editUrine($data)
    {
        $urine = Urine::where('id',$data['urine_id'])->first();
        $urine->kasus_id = $data['kasus_id'];
        $urine->tes_kehamilan = $data['tes_kehamilan'];
        $urine->morphin = $data['morphin'];
        $urine->metamphetamine = $data['metamphetamine'];
        $urine->amphetamine = $data['amphetamine'];
        $urine->diazepam = $data['diazepam'];
        $urine->ganja = $data['ganja'];
        $urine->leuko = $data['leuko'];
        $urine->eritrosit = $data['eritrosit'];
        $urine->epitel = $data['epitel'];
        $urine->bakteri = $data['bakteri'];
        $urine->cylinder = $data['cylinder'];
        $urine->kristal = $data['kristal'];
        $urine->candida = $data['candida'];
        $urine->warna = $data['warna'];
        $urine->berat_jenis = $data['berat_jenis'];
        $urine->ph = $data['ph'];
        $urine->protein = $data['protein'];
        $urine->reduksi = $data['reduksi'];
        $urine->reduksi_2_jpp = $data['reduksi_2_jpp'];
        $urine->urobilinogen = $data['urobilinogen'];
        $urine->bilirubin = $data['bilirubin'];
        $urine->keton = $data['keton'];
        $urine->nitrit = $data['nitrit'];
        $urine->leukosit = $data['leukosit'];
        $urine->urobilirubin = $data['urobilirubin'];
        $urine->updated_by = Auth::user()->id;
        $urine->save();
        //dd($urine);
        return $urine;
    }
    public function editImun($data)
    {
        $imun = Immunologi::where('id',$data['imun_id'])->first();
        $imun->kasus_id = $data['kasus_id'];
        $imun->hbs_ag = $data['hbs_ag'];
        $imun->anti_hiv = $data['anti_hiv'];
        $imun->vdrl = $data['vdrl'];
        $imun->anti_hcv = $data['anti_hcv'];
        $imun->ict_malaria = $data['ict_malaria'];
        $imun->coomb_test = $data['coomb_test'];
        $imun->hb_eag = $data['hb_eag'];
        $imun->updated_by = Auth::user()->id;
        $imun->save();
        //dd($urine);
        return $imun;
    }
    public function editSmear($data)
    {
        $smear = PapSmear::where('id',$data['smear_id'])->first();
        $smear->pap_smear = $data['pap_smear'];
        $smear->kasus_id = $data['kasus_id'];
        $smear->updated_by = Auth::user()->id;
        $smear->save();
        //dd($urine);
        return $smear;
    }
    public function editFeces($data)
    {   
        //dd($data);
        $feces = Feces::where('id',$data['feces_id'])->first();
        $feces->kasus_id = $data['kasus_id'];
        $feces->warna = $data['warna'];
        $feces->konsistensi = $data['konsistensi'];
        $feces->bau = $data['bau'];
        $feces->lendir = $data['lendir'];
        $feces->darah = $data['darah'];
        $feces->lekosit = $data['lekosit'];
        $feces->eritrosit = $data['eritrosit'];
        $feces->amoeba = $data['amoeba'];
        $feces->kista = $data['kista'];
        $feces->telur_cacing = $data['telur_cacing'];
        $feces->protein = $data['protein'];
        $feces->lemak = $data['lemak'];
        $feces->karbohidrat = $data['karbohidrat'];
        $feces->serat = $data['serat'];
        $feces->amylum = $data['amylum'];
        $feces->bakteri = $data['bakteri'];
        $feces->benzidin_test = $data['benzidin_test'];
        $feces->updated_by = Auth::user()->id;
        $feces->save();
        
        //dd($urine);
        return $feces;
    }
}
