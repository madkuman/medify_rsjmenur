<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhan;
use App\Models\Keperawatan\RencanaAsuhanDetail;
use DB;
class EditController extends Controller
{
    public function edit($jenis_id, $diagnosa, $tujuan, $form_drm, $id, $prefix,$durasi_tujuan,$sub_tujuan)
    {

        if($durasi_tujuan == "on") $durasi_tujuan = 1;
        $kep = RencanaAsuhan::findOrFail($id);
        $kep->jenis_id = $jenis_id;
        $kep->diagnosa = $diagnosa;
        $kep->tujuan = $tujuan;
        $kep->durasi_tujuan = $durasi_tujuan;
        $kep->sub_tujuan = $sub_tujuan;
        $kep->form_drm = $form_drm;
        $kep->prefix = is_null($prefix) ? $prefix : 1;
        $kep->save();

        return $kep;
    }

    public function update(Request $request)
    {   
        $db_use = DB::connection('keperawatan');
        $db_use->beginTransaction();
        try {
            $opsi_diagnosa = $request->opsi_diagnosa;
            $opsi_data_penunjang = $request->opsi_data_penunjang;
            $opsi_data_subjektif = $request->opsi_data_subjektif;
            $opsi_data_objektif = $request->opsi_data_objektif;
            $opsi_tujuan = $request->opsi_tujuan;
            $opsi_mandiri = $request->opsi_mandiri;
            $opsi_kolaborasi = $request->opsi_kolaborasi;
            $id = $request->input('id');
            $asuhan = app('App\Http\Controllers\Keperawatan\RencanaAsuhan\EditController')
            ->edit($request->jenis_id,$request->diagnosa,$request->tujuan,$request->form_drm,$request->input('id'), $request->prefix,$request->durasi_tujuan,$request->sub_tujuan);
            
            if(!empty($opsi_diagnosa))
            {   
                $this->updateDetail($opsi_diagnosa,1,$id);
            }
            if(!empty($opsi_data_penunjang))
            {
                $this->updateDetail($opsi_data_penunjang,2,$id);
            }
            if(!empty($opsi_data_subjektif))
            {
                $this->updateDetail($opsi_data_subjektif,3,$id);
            }
            if(!empty($opsi_data_objektif))
            {
                $this->updateDetail($opsi_data_objektif,4,$id);
            }
            if(!empty($opsi_tujuan))
            {
                $this->updateDetail($opsi_tujuan,5,$id);
            }
            if(!empty($opsi_mandiri))
            {
                $this->updateDetail($opsi_mandiri,6,$id);
            }
            if(!empty($opsi_kolaborasi))
            {
                $this->updateDetail($opsi_kolaborasi,7,$id);
            }
            $db_use->commit();

            $message = 'Data Rencana Asuhan Berhasil Diperbaharui!';
            $title = 'Berhasil!';
            $status = 1;

            return redirect('keperawatan/rencana-asuhan/'.$asuhan->id)
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (Exception $e) {
            $db_use->rollBack();
            dd($e);
        }
    }

    private function updateDetail($opsi,$flag,$id)
    {
        foreach($opsi as $key => $value)
        {   
            $detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\ReadController')->getSingle($id,$flag,$key);
            if(!empty($detail)){
                if(!empty($value))
                {   
                    $act = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\EditController')->update($detail,$value);
                }
                else
                {
                    $act = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\DeleteController')->delete($detail);
                }
            }    
            else{
                // if($key = 974) dd($key,$value);
                if(!empty($value)){
                    $kep = new RencanaAsuhanDetail;
                    $kep->rencana_asuhan_id = $id;
                    $kep->jenis_id = $flag;
                    $kep->konten = $value;
                    $kep->save();
                }
            }
        }
    }
}
