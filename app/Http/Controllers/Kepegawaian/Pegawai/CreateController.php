<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Marriage;
use App\Models\Kepegawaian\Photo;
use Auth;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;

class CreateController extends Controller
{
    public function create($request)
    {
        $postdata = $request->toArray();

        $new_item = new Pegawai;
        $new_item->name = (!empty($postdata['name']) ? $postdata['name'] : '');
        $new_item->faskes_asuransi_id = (!empty($postdata['faskes_asuransi_id']) ? $postdata['faskes_asuransi_id'] : null);
        $new_item->atas_nama_bank = (!empty($postdata['nama_rekening_bank']) ? $postdata['nama_rekening_bank'] : '');
        $new_item->suku_bangsa = (!empty($postdata['suku_bangsa']) ? $postdata['suku_bangsa'] : '');
        $new_item->gender = (!empty($postdata['gender']) ? $postdata['gender'] : '');
        $new_item->birth_place = (!empty($postdata['birth_place']) ? $postdata['birth_place'] : '');
        $new_item->birth_date = (!empty($postdata['birth_date']) ? date('Y-m-d', strtotime($postdata['birth_date'])) : null);
        $new_item->nrp = (!empty($postdata['nrp']) ? $postdata['nrp'] : '');
        $new_item->address = (!empty($postdata['address']) ? $postdata['address'] : '');
        $new_item->rt_rw = (!empty($postdata['rt_rw']) ? $postdata['rt_rw'] : '');
        $new_item->city_id = (!empty($postdata['city_id']) ? $postdata['city_id'] : null);
        $new_item->district_id = (!empty($postdata['district_id']) ? $postdata['district_id'] : null);
        $new_item->kelurahan_id = (!empty($postdata['kelurahan_id']) ? $postdata['kelurahan_id'] : null);
        $new_item->identity_card = (!empty($postdata['identity_card']) ? $postdata['identity_card'] : '');
        $new_item->family_registers = (!empty($postdata['family_registers']) ? $postdata['family_registers'] : '');
        $new_item->agama_id = (!empty($postdata['agama_id']) ? $postdata['agama_id'] : null);
        $new_item->phone = (!empty($postdata['phone']) ? $postdata['phone'] : '');
        $new_item->email = (!empty($postdata['email']) ? $postdata['email'] : '');
        $new_item->npwp = (!empty($postdata['npwp']) ? $postdata['npwp'] : '');
        $new_item->sim_a = (!empty($postdata['sim_a']) ? $postdata['sim_a'] : '');
        $new_item->sim_b1 = (!empty($postdata['sim_b1']) ? $postdata['sim_b1'] : '');
        $new_item->sim_b2 = (!empty($postdata['sim_b2']) ? $postdata['sim_b2'] : '');
        $new_item->sim_c = (!empty($postdata['sim_c']) ? $postdata['sim_c'] : '');
        $new_item->sim_d = (!empty($postdata['sim_d']) ? $postdata['sim_d'] : '');
        // $new_item->driver_license = (!empty($postdata['driver_license']) ? $postdata['driver_license'] : '');
        // $new_item->driver_license_number = (!empty($postdata['driver_license_number']) ? $postdata['driver_license_number'] : '');
        $new_item->license_plate = (!empty($postdata['license_plate']) ? $postdata['license_plate'] : '');
        $new_item->bank = (!empty($postdata['bank']) ? $postdata['bank'] : null);
        $new_item->bank_account = (!empty($postdata['bank_account']) ? $postdata['bank_account'] : '');
        $new_item->status_rumah_id = (!empty($postdata['living_type']) ? $postdata['living_type'] : null);
        $new_item->headgear = (!empty($postdata['headgear']) ? $postdata['headgear'] : '');
        $new_item->size_chart = (!empty($postdata['size_chart']) ? $postdata['size_chart'] : '');
        $new_item->height = (!empty($postdata['height']) ? $postdata['height'] : '');
        $new_item->weight = (!empty($postdata['weight']) ? $postdata['weight'] : '');
        $new_item->shoe_size = (!empty($postdata['shoe_size']) ? $postdata['shoe_size'] : '');
        $new_item->bpjs = (!empty($postdata['bpjs']) ? $postdata['bpjs'] : '');
        $new_item->faskes = (!empty($postdata['faskes']) ? $postdata['faskes'] : '');
        $new_item->class = (!empty($postdata['class']) ? $postdata['class'] : '');
        $new_item->blood_type = (!empty($postdata['blood_type']) ? $postdata['blood_type'] : '');
        $new_item->jenis_pegawai_id = (!empty($postdata['jenis_pegawai_id']) ? $postdata['jenis_pegawai_id'] : null);
        $new_item->kategori_pegawai_id = (!empty($postdata['kategori_pegawai_id']) ? $postdata['kategori_pegawai_id'] : null);
        $new_item->golongan_pegawai_id = (!empty($postdata['golongan_pegawai_id']) ? $postdata['golongan_pegawai_id'] : null);
        $new_item->resiko_kerja_id = (!empty($postdata['resiko_kerja_id']) ? $postdata['resiko_kerja_id'] : null);
        $new_item->beban_kerja_id = (!empty($postdata['beban_kerja_id']) ? $postdata['beban_kerja_id'] : null);
        $new_item->tim_pembagi_jasa_id = (!empty($postdata['tim_pembagi_jasa_id']) ? $postdata['tim_pembagi_jasa_id'] : null);
        $new_item->pendidikan_gelar_id = (!empty($postdata['pendidikan_gelar_id']) ? $postdata['pendidikan_gelar_id'] : null);
        $new_item->tmt = (!empty($postdata['tmt']) ? date('Y-m-d', strtotime($postdata['tmt'])) : '');
        $new_item->tmt_pa_pns = (!empty($postdata['tmt_pa_pns']) ? date('Y-m-d', strtotime($postdata['tmt_pa_pns'])) : '');
        $new_item->tmt_fiktif = (!empty($postdata['tmt_fiktif']) ? date('Y-m-d', strtotime($postdata['tmt_fiktif'])) : '');
        $new_item->tmt_kesatuan = (!empty($postdata['tmt_kesatuan']) ? date('Y-m-d', strtotime($postdata['tmt_kesatuan'])) : '');
        $new_item->phl_status = (!empty($postdata['phl_status']) ? $postdata['phl_status'] : null);
        $new_item->status_pegawai_id = (!empty($postdata['status_pegawai_id']) ? $postdata['status_pegawai_id'] : null);
        $new_item->tmt_out = (!empty($postdata['tmt_out']) ? date('Y-m-d', strtotime($postdata['tmt_out'])) : '');
        $new_item->sprin_out_number = (!empty($postdata['sprin_out_number']) ? $postdata['sprin_out_number'] : '');
        // $new_item->sip = (!empty($postdata['sip']) ? $postdata['sip'] : '');
        // $new_item->sip_expired_at = (!empty($postdata['sip_expired_at']) ? $postdata['sip_expired_at'] : '');
        // $new_item->str = (!empty($postdata['str']) ? $postdata['str'] : '');
        // $new_item->str_expired_at = (!empty($postdata['str_expired_at']) ? $postdata['str_expired_at'] : '');
        $new_item->kualifikasi = (!empty($postdata['kualifikasi']) ? $postdata['kualifikasi'] : '');
        $new_item->jenis_kendaraan_id = (!empty($postdata['jenis_kendaraan_id']) ? $postdata['jenis_kendaraan_id'] : null);
        $new_item->subkualifikasi = (!empty($postdata['subkualifikasi']) ? $postdata['subkualifikasi'] : null);
        // $new_item->ppa_1 = (!empty($postdata['ppa_1']) ? $postdata['ppa_1'] : '');
        // $new_item->ppa_2 = (!empty($postdata['ppa_2']) ? $postdata['ppa_2'] : '');
        // $new_item->ppa_3 = (!empty($postdata['ppa_3']) ? $postdata['ppa_3'] : '');

        $new_item->created_by = Auth::user()->id;

        $new_item->signed = 0;

        if (isset($postdata['photo']))
            $new_item->photo = self::uploadPhoto($postdata['photo']);
        if(isset($postdata['file_sip'])){
            if(count($postdata['file_sip']) > 1)
                $new_item->sip_file = $this->compressFile($postdata['file_sip'], 'sip', $new_item->id);
            else
                $new_item->sip_file = self::uploadPhoto($postdata['file_sip'][0]).'.'.$postdata['file_sip'][0]->getClientOriginalExtension();
        }
        if(isset($postdata['file_str'])){
            if(count($postdata['file_str']) > 1)
                $new_item->str_file = $this->compressFile($postdata['file_str'], 'str', $new_item->id);
            else
                $new_item->str_file = self::uploadPhoto($postdata['file_str'][0]).'.'.$postdata['file_str'][0]->getClientOriginalExtension();
        }
        if(isset($postdata['file_ppa_1'])){
            if(count($postdata['file_ppa_1']) > 1)
                $new_item->ppa_1_file = $this->compressFile($postdata['file_ppa_1'], 'ppa_1', $new_item->id);
            else
                $new_item->ppa_1_file = self::uploadPhoto($postdata['file_ppa_1'][0]).'.'.$postdata['file_ppa_1'][0]->getClientOriginalExtension();
        }
        if(isset($postdata['file_ppa_2'])){
            if(count($postdata['file_ppa_2']) > 1)
                $new_item->ppa_2_file = $this->compressFile($postdata['file_ppa_2'], 'ppa_2', $new_item->id);
            else
                $new_item->ppa_2_file = self::uploadPhoto($postdata['file_ppa_2'][0]).'.'.$postdata['file_ppa_2'][0]->getClientOriginalExtension();
        }
        if(isset($postdata['file_ppa_3'])){
            if(count($postdata['file_ppa_3']) > 1)
                $new_item->ppa_3_file = $this->compressFile($postdata['file_ppa_3'], 'ppa_3', $new_item->id);
            else
                $new_item->ppa_3_file = self::uploadPhoto($postdata['file_ppa_3'][0]).'.'.$postdata['file_ppa_3'][0]->getClientOriginalExtension();
        }

        $ret_save = $new_item->save();

        $item_status = new Marriage;
        $item_status->employee_id = $new_item->id;
        $item_status->status = (!empty($postdata['status']) ? $postdata['status'] : '');
        $item_status->total_child = (!empty($postdata['total_child']) ? $postdata['total_child'] : null);
        $item_status->marriage_certificate_number = (!empty($postdata['marriage_certificate_number']) ? $postdata['marriage_certificate_number'] : '');
        $item_status->marriage_date = (!empty($postdata['marriage_date']) ? date('Y-m-d', strtotime($postdata['marriage_date'])) : null);
        $item_status->marriage_place = (!empty($postdata['marriage_place']) ? $postdata['marriage_place'] : '');
        $item_status->couple_job = (!empty($postdata['couple_job']) ? $postdata['couple_job'] : '');
        $item_status->save();
        
        return $ret_save;
    }
    private function uploadPhoto($file_) {
        $item = new Photo;
        $item->filename = $file_->getClientOriginalName();
        $item->mime = $file_->getClientMimeType();
        $item->path = hash('sha256', time());
        $item->size = $file_->getClientSize();
        $item->extension = $file_->getClientOriginalExtension();
        $item->save();
    
        if($file_) {
            $filename = (string)$item->id.'.'.$file_->getClientOriginalExtension();
            $destination_path = public_path('/uploads/kepegawaian/profile');
            $file_->move($destination_path, $filename);
            $item->save();
        }
    
        return $item->id;
    }

    public function import($request)
    {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = $file->getClientOriginalName();
 
		// import data
		$excel = Excel::import(new PegawaiImport,$request->file('file'));
        return $excel;
    }
}
