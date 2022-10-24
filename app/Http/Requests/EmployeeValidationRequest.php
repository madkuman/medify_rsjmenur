<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class EmployeeValidationRequest extends Request
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    $request = \Request::all();
    $id = $this->id;

    $rules = [
      'name' => 'required',
      'gender' => 'required',
      'birth_date' => 'required',
      'birth_place' => 'required',
      'religion_id' => 'required',
      'nrp' => 'required',
      'address' => 'required',
      'city_id' => 'required',
      'district_id' => 'required',
    ];
    
    return $rules;
  }

  public function attributes() {
    return [
      'name' => 'Nama pegawai',
      'gender' => 'Jenis Kelamin pegawai',
      'birth_date' => 'Tanggal Lahir pegawai',
      'birth_place' => 'Tempat Lahit pegawai',
      'religion_id' => 'Agama pegawai',
      'nrp' => 'NRP pegawai',
      'address' => 'Alamat pegawai',
      'city_id' => 'Kota pegawai',
      'district_id' => 'Kecamatan pegawai',
    ];
  }

  public function messages() {
    return [
      'name.required' => 'Nama pegawai tidak boleh kosong',
      'gender.required' => 'Jenis Kelamin pegawai tidak boleh kosong',
      'birth_date.required' => 'Tanggal Lahir pegawai tidak boleh kosong',
      'birth_place.required' => 'Tempat Lahit pegawai tidak boleh kosong',
      'religion_id.required' => 'Agama pegawai tidak boleh kosong',
      'nrp.required' => 'NRP pegawai tidak boleh kosong',
      'address.required' => 'Alamat pegawai tidak boleh kosong',
      'rt_rw.required' => 'RT/RW pegawai tidak boleh kosong',
      'city_id.required' => 'Kota pegawai tidak boleh kosong',
      'district_id.required' => 'Kecamatan pegawai tidak boleh kosong',
      'identity_card.required' => 'NO KTP pegawai tidak boleh kosong',
      'family_registers.required' => 'NO KK pegawai tidak boleh kosong',
      'phone.required' => 'NO HP pegawai tidak boleh kosong',
    ];
  }
}
