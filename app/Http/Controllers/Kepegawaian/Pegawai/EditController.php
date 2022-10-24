<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeValidationRequest;

use App\Models\Kepegawaian\MasterKualifikasi;
use App\Models\Kepegawaian\MasterSubkualifikasi;
use App\Models\Pasien\AlamatKota;
use App\Models\Kepegawaian\MasterNamaBank;
use App\Models\Kepegawaian\Photo;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Kepegawaian\Marriage;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MasterStatusRumah;
use App\Models\Kepegawaian\MasterJenisPegawai;
use App\Models\Kepegawaian\MasterStatusPegawai;
use Auth;

class EditController extends Controller
{
    public function edit($id, $request) {

        $item = Pegawai::with([	
            'marriages' => function($q) {
                $q->orderBy('marriage_date', 'desc')->first();
            }
        ])->find($id);
        $marriage = Marriage::where('employee_id', $item->id)->orderBy('marriage_date', 'desc')->first();
        if(empty($marriage)) $marriage = new Marriage;
    
        $data = [];
        $postdata = $request->toArray();
    
        if(empty($postdata)) {
            if(empty($item)){
                $data['route_name'] = 'pegawai';
    
                return self::notFound($data);
            }
            else {
    // track required field to style it blade
                $rules = (new EmployeeValidationRequest())->rules();
                if(!empty($rules))
                    $data['_rules'] = $rules;
    
                $data['htmlheader_title'] = 'Kepegawaian | Edit Pegawai';
                $data['contentheader_title'] = 'Edit Pegawai, #'.$item->id;
    
                return self::form($item, $data);
            }
        }
        else {
            $ret = [
                'msg' => '',
                'error' => null
            ];

    
            $item->name = (!empty($postdata['name']) ? $postdata['name'] : '');
            $item->faskes_asuransi_id = (!empty($postdata['faskes_asuransi_id']) ? $postdata['faskes_asuransi_id'] : null);
            $item->atas_nama_bank = (!empty($postdata['nama_rekening_bank']) ? $postdata['nama_rekening_bank'] : '');
            $item->suku_bangsa = (!empty($postdata['suku_bangsa']) ? $postdata['suku_bangsa'] : '');
            $item->gender = (!empty($postdata['gender']) ? $postdata['gender'] : '');
            $item->birth_place = (!empty($postdata['birth_place']) ? $postdata['birth_place'] : '');
            $item->birth_date = (!empty($postdata['birth_date']) ? date('Y-m-d', strtotime($postdata['birth_date'])) : null);
            $item->nrp = (!empty($postdata['nrp']) ? $postdata['nrp'] : '');
            $item->address = (!empty($postdata['address']) ? $postdata['address'] : '');
            $item->rt_rw = (!empty($postdata['rt_rw']) ? $postdata['rt_rw'] : '');
            $item->city_id = (!empty($postdata['city_id']) ? $postdata['city_id'] : null);
            $item->district_id = (!empty($postdata['district_id']) ? $postdata['district_id'] : null);
            $item->kelurahan_id = (!empty($postdata['kelurahan_id']) ? $postdata['kelurahan_id'] : null);
            $item->identity_card = (!empty($postdata['identity_card']) ? $postdata['identity_card'] : '');
            $item->family_registers = (!empty($postdata['family_registers']) ? $postdata['family_registers'] : '');
            $item->agama_id = (!empty($postdata['agama_id']) ? $postdata['agama_id'] : null);
            $item->phone = (!empty($postdata['phone']) ? $postdata['phone'] : '');
            $item->email = (!empty($postdata['email']) ? $postdata['email'] : '');
            $item->npwp = (!empty($postdata['npwp']) ? $postdata['npwp'] : '');
            $item->sim_a = (!empty($postdata['sim_a']) ? $postdata['sim_a'] : '');
            $item->sim_b1 = (!empty($postdata['sim_b1']) ? $postdata['sim_b1'] : '');
            $item->sim_b2 = (!empty($postdata['sim_b2']) ? $postdata['sim_b2'] : '');
            $item->sim_c = (!empty($postdata['sim_c']) ? $postdata['sim_c'] : '');
            $item->sim_d = (!empty($postdata['sim_d']) ? $postdata['sim_d'] : '');
            // $item->driver_license = (!empty($postdata['driver_license']) ? $postdata['driver_license'] : '');
            // $item->driver_license_number = (!empty($postdata['driver_license_number']) ? $postdata['driver_license_number'] : '');
            $item->license_plate = (!empty($postdata['license_plate']) ? $postdata['license_plate'] : '');
            $item->bank = (!empty($postdata['bank']) ? $postdata['bank'] : null);
            $item->bank_account = (!empty($postdata['bank_account']) ? $postdata['bank_account'] : '');
            $item->status_rumah_id = (!empty($postdata['living_type']) ? $postdata['living_type'] : null);
            $item->headgear = (!empty($postdata['headgear']) ? $postdata['headgear'] : '');
            $item->size_chart = (!empty($postdata['size_chart']) ? $postdata['size_chart'] : '');
            $item->height = (!empty($postdata['height']) ? $postdata['height'] : '');
            $item->weight = (!empty($postdata['weight']) ? $postdata['weight'] : '');
            $item->shoe_size = (!empty($postdata['shoe_size']) ? $postdata['shoe_size'] : '');
            $item->bpjs = (!empty($postdata['bpjs']) ? $postdata['bpjs'] : '');
            $item->faskes = (!empty($postdata['faskes']) ? $postdata['faskes'] : '');
            $item->class = (!empty($postdata['class']) ? $postdata['class'] : '');
            $item->blood_type = (!empty($postdata['blood_type']) ? $postdata['blood_type'] : '');
            $item->jenis_pegawai_id = (!empty($postdata['jenis_pegawai_id']) ? $postdata['jenis_pegawai_id'] : null);
            $item->kategori_pegawai_id = (!empty($postdata['kategori_pegawai_id']) ? $postdata['kategori_pegawai_id'] : null);
            $item->golongan_pegawai_id = (!empty($postdata['golongan_pegawai_id']) ? $postdata['golongan_pegawai_id'] : null);
            $item->tim_pembagi_jasa_id = (!empty($postdata['tim_pembagi_jasa_id']) ? $postdata['tim_pembagi_jasa_id'] : null);
            $item->pendidikan_gelar_id = (!empty($postdata['pendidikan_gelar_id']) ? $postdata['pendidikan_gelar_id'] : null);
            $item->tmt = (!empty($postdata['tmt']) ? date('Y-m-d', strtotime($postdata['tmt'])) : '');
            $item->tmt_pa_pns = (!empty($postdata['tmt_pa_pns']) ? date('Y-m-d', strtotime($postdata['tmt_pa_pns'])) : '');
            $item->tmt_fiktif = (!empty($postdata['tmt_fiktif']) ? date('Y-m-d', strtotime($postdata['tmt_fiktif'])) : '');
            $item->tmt_kesatuan = (!empty($postdata['tmt_kesatuan']) ? date('Y-m-d', strtotime($postdata['tmt_kesatuan'])) : '');
            $item->phl_status = (!empty($postdata['phl_status']) ? $postdata['phl_status'] : null);
            $item->status_pegawai_id = (!empty($postdata['status_pegawai_id']) ? $postdata['status_pegawai_id'] : null);
            $item->tmt_out = (!empty($postdata['tmt_out']) ? date('Y-m-d', strtotime($postdata['tmt_out'])) : '');
            $item->sprin_out_number = (!empty($postdata['sprin_out_number']) ? $postdata['sprin_out_number'] : '');
            $item->kualifikasi = (!empty($postdata['kualifikasi']) ? $postdata['kualifikasi'] : '');
            $item->jenis_kendaraan_id = (!empty($postdata['jenis_kendaraan_id']) ? $postdata['jenis_kendaraan_id'] : null);
            $item->subkualifikasi = (!empty($postdata['subkualifikasi']) ? $postdata['subkualifikasi'] : null);
            $item->pangkat_id = (!empty($postdata['pangkat_id']) ? $postdata['pangkat_id'] : null);
            $item->resiko_kerja_id = (!empty($postdata['resiko_kerja_id']) ? $postdata['resiko_kerja_id'] : null);
            $item->beban_kerja_id = (!empty($postdata['beban_kerja_id']) ? $postdata['beban_kerja_id'] : null);
            $item->jabatan_id = (!empty($postdata['jabatan_id']) ? $postdata['jabatan_id'] : null);
            $item->created_by = Auth::user()->id;
   
            $item->signed = 0;
          
            if(isset($postdata['photo']))
                $item->photo = self::uploadPhoto($postdata['photo'], $item);
            // if(isset($postdata['file_sip'])){
            //     if(count($postdata['file_sip']) > 1)
            //         $item->sip_file = $this->compressFile($postdata['file_sip'], 'sip', $item->id);
            //     else
            //         $item->sip_file = self::uploadPhoto($postdata['file_sip'][0]).'.'.$postdata['file_sip'][0]->getClientOriginalExtension();
            // }
            // if(isset($postdata['file_str'])){
            //     if(count($postdata['file_str']) > 1)
            //         $item->str_file = $this->compressFile($postdata['file_str'], 'str', $item->id);
            //     else
            //         $item->str_file = self::uploadPhoto($postdata['file_str'][0]).'.'.$postdata['file_str'][0]->getClientOriginalExtension();
            // }
            // if(isset($postdata['file_ppa_1'])){
            //     if(count($postdata['file_ppa_1']) > 1)
            //         $item->ppa_1_file = $this->compressFile($postdata['file_ppa_1'], 'ppa_1', $item->id);
            //     else
            //         $item->ppa_1_file = self::uploadPhoto($postdata['file_ppa_1'][0]).'.'.$postdata['file_ppa_1'][0]->getClientOriginalExtension();
            // }
            // if(isset($postdata['file_ppa_2'])){
            //     if(count($postdata['file_ppa_2']) > 1)
            //         $item->ppa_2_file = $this->compressFile($postdata['file_ppa_2'], 'ppa_2', $item->id);
            //     else
            //         $item->ppa_2_file = self::uploadPhoto($postdata['file_ppa_2'][0]).'.'.$postdata['file_ppa_2'][0]->getClientOriginalExtension();
            // }
            // if(isset($postdata['file_ppa_3'])){
            //     if(count($postdata['file_ppa_3']) > 1)
            //         $item->ppa_3_file = $this->compressFile($postdata['file_ppa_3'], 'ppa_3', $item->id);
            //     else
            //         $item->ppa_3_file = self::uploadPhoto($postdata['file_ppa_3'][0]).'.'.$postdata['file_ppa_3'][0]->getClientOriginalExtension();
            // }
    
            $ret_update = $item->update();

            $marriage->status = (!empty($postdata['status']) ? $postdata['status'] : '');
            $marriage->total_child = (!empty($postdata['total_child']) ? $postdata['total_child'] : null);
            $marriage->marriage_certificate_number = (!empty($postdata['marriage_certificate_number']) ? $postdata['marriage_certificate_number'] : '');
            $marriage->marriage_date = (!empty($postdata['marriage_date']) ? date('Y-m-d', strtotime($postdata['marriage_date'])) : null);
            $marriage->marriage_place = (!empty($postdata['marriage_place']) ? $postdata['marriage_place'] : '');
            $marriage->couple_job = (!empty($postdata['couple_job']) ? $postdata['couple_job'] : '');
            $marriage->save();

            return $ret_update;
        }
        
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
}
