@extends('kepegawaian.layouts.main')

@section('title')
    {{ $htmlheader_title }}
@endsection

@section('subtitle')
    {{ $contentheader_title }}
@endsection

@section('content')
    <div class="container">
        <div class="block-content">
            <h4 class="mb-2">{{ $contentheader_title }}</h4>
            @if (empty($is_edit))
                <span>Pastikan tidak ada pegawai yang memiliki identitas yang sama dengan pegawai baru yang akan ditambahkan</span>
            @endif
            <hr>

            @if( empty($is_edit) )
                {!! Form::open(['url' => route('pegawai-baru-post'), 'files' => true, 'class' => 'form form-horizontal', 'role' => 'form', 'id' => 'mainform']) !!}
            @else
                {!! Form::model($item, ['route' => ['pegawai-edit-post', $item->id], 'class' => 'form form-horizontal', 'files' => true, 'role' => 'form', 'id' => 'mainform', 'is_edit' => '1']) !!}
                {{ Form::hidden('act', 'edit') }}
                {{ Form::hidden('edit_id', $item->id) }}
            @endif
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            {{ Form::file('photo', ['id' => 'photo', 'accept' => '.png, .jpg, .jpeg']) }}
                            <label for="photo"></label>
                        </div>
                        <div class="avatar-preview">
                            @if( empty($is_edit) )
                                <div id="imagePreview" style="background-image: url({{ URL::asset('assets/img/avatars/avatar9.jpg') }});">
                                    @else
                                        @php
                                            $url = '/uploads/kepegawaian/profile/';
                                            $path = public_path('/uploads/kepegawaian/profile/');
                                        @endphp
                                        @if (file_exists($path.$item->photo.".png"))
                                            <div id="imagePreview" style="background-image: url({{ URL::to($url.$item->photo.".png") }});">
                                            </div>
                                        @elseif (file_exists($path.$item->photo.".jpg"))
                                            <div id="imagePreview" style="background-image: url({{ URL::to($url.$item->photo.".jpg") }});">
                                            </div>
                                        @elseif (file_exists($path.$item->photo.".jpeg"))
                                            <div id="imagePreview" style="background-image: url({{ URL::to($url.$item->photo.".jpeg") }});">
                                            </div>
                                        @else
                                            <div id="imagePreview" style="background-image: url({{ URL::asset('assets/img/avatars/avatar9.jpg') }});">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <!-- DATA PEGAWAI -->
                    <div class="block rounded @if(!($is_hrd_member))d-none @endif">
                        <div class="block-content">
                            <h4 class="font-w400">DATA PEGAWAI</h4>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('inputName', 'Nama Pegawai', ['class' => (is_required_field('name', $rules) ? ' required-label' : ''),
                                        'title' => (is_required_field('name', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName',
                                        'placeholder' => 'Masukkan Nama Lengkap Pegawai sesuai kartu identitas', 'required'])}}
                                        <div class="invalid-feedback">Silahkan masukkan nama pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputGender', 'Jenis Kelamin', ['class' => (is_required_field('gender', $rules) ? ' required-label' : ''), 'title' => (is_required_field('gender', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>

                                        <select class="form-control js-select2" name="gender" required>
                                            <option value="">- Pilih Jenis Kelamin</option>
                                            <option value="L"
                                                    @if(!empty($item->gender) && $item->gender == 'L')
                                                    selected
                                                    @endif >Laki - laki</option>
                                            <option value="P"
                                                    @if(!empty($item->gender) && $item->gender == 'P')
                                                    selected
                                                    @endif >Perempuan</option  >
                                        </select>
                                        <div class="invalid-feedback">Silahkan masukkan jenis kelamin </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        {{ Form::text('birth_place', null, ['class' => 'form-control', 'id' => 'inputBPlace',
                                        'placeholder' => 'Masukkan Tempat Lahir sesuai kartu identitas'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputBDate', 'Tanggal Lahir', ['class' => (is_required_field('birth_date', $rules) ?
                                        ' required-label' : ''), 'title' => (is_required_field('birth_date', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        <div class="input-group">
                                            <input name="birth_date" type="text" required value="{{$item->birth_date ?? ''}}" class="form-control combodate" id="inputBDate" data-format="YYYY-MM-DD HH:mm:ss" data-template="D MMMM YYYY"> <br>
                                            <div class="invalid-feedback">Silahkan masukkan Tanggal Lahir pegawai </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputNRP', 'NRP', ['class' => (is_required_field('nrp', $rules) ? ' required-label' : ''),
                                        'title' => (is_required_field('nrp', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        {{ Form::text('nrp', null, ['class' => 'form-control', 'id' => 'inputNRP', 'placeholder' => 'Masukkan NRP Pegawai', 'required'])}}
                                        <div class="invalid-feedback">Silahkan masukkan NRP pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="{{(is_required_field('name', $rules) ? ' required-label' : '')}}">Kualifikasi</label> <label class="text-danger"> *</label>

                                        @if (!empty($is_edit) && isset($is_edit))
                                            <select class="form-control js-select2 dynamic" id="kualifikasi" name="kualifikasi" required>
                                                <option value="">- Masukkan kualifikasi -</option>
                                                @foreach($kualifikasi as $kualifikasi_detail)
                                                    @if ($item['kualifikasi'] == $kualifikasi_detail->id)
                                                        <option selected value="{{$item['kualifikasi']}}">{{$item->masterKualifikasi->nama}}</option>
                                                    @else
                                                        <option value="{{$kualifikasi_detail->id}}">{{$kualifikasi_detail->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2 dynamic" id="kualifikasi" name="kualifikasi" required>
                                                <option value="">- Masukkan kualifikasi -</option>
                                                @foreach($kualifikasi as $kualifikasi_detail)
                                                    <option value="{{$kualifikasi_detail->id}}">{{$kualifikasi_detail->nama}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan kualifikasi </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'inputAddress',
                                        'placeholder' => 'Masukkan Alamat sesuai kartu identitas'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>RT/RW</label>
                                        {{ Form::text('rt_rw', null, ['class' => 'form-control', 'id' => 'inputRTRW',
                                        'placeholder' => 'Masukkan RT/RW sesuai kartu identitas'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>Kota/Kabupaten</label>
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2 kota" name="city_id" id="kota">
                                                <option value="" selected >― Pilih Kota/Kabupaten ―</option>
                                                @foreach ($kota as $alamat_kota)
                                                    <option value="{{$alamat_kota->id}}">{{$alamat_kota->nama}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if(!empty($is_edit))
                                            <select class="form-control js-select2" name="city_id" id="kota">
                                                <option value="">― Pilih Kota/Kabupaten ―</option>
                                                @foreach ($kota as $alamat_kota)
                                                    @if ($item->city_id == $alamat_kota->id)
                                                        <option value="{{$item->city_id}}" selected>{{$item->city->nama}}</option>
                                                    @else
                                                        <option value="{{$alamat_kota->id}}">{{$alamat_kota->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="district_id" id="kecamatan">
                                                <option value="" selected>― Pilih Kecamatan ―</option>
                                            </select>
                                        @endif
                                        @if(!empty($is_edit))
                                            <select class="form-control js-select2" name="district_id" id="kecamatan">
                                                <option value="">― Pilih Kecamatan ―</option>
                                                @foreach ($kecamatan as $kec)
                                                    @if ($item->district_id == $kec->id)
                                                        <option value="{{$item->district_id}}" selected>{{$item->district->nama}}</option>
                                                    @else
                                                        <option value="{{$kec->id}}">{{$kec->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Kelurahan</label>
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="kelurahan_id" id="kelurahan">
                                                <option value="">― Pilih Kelurahan ―</option>
                                            </select>
                                        @endif
                                        @if (!empty($is_edit))
                                            <select class="form-control js-select2" name="kelurahan_id" id="kelurahan">
                                                <option value="">― Pilih Kelurahan ―</option>
                                                @foreach ($kelurahan as $kel)
                                                    @if ($item->kelurahan_id == $kel->id)
                                                        <option selected value="{{$item->kelurahan_id}}">{{$item->kelurahan->nama}}</option>
                                                    @else
                                                        <option value="{{$kel->id}}">{{$kel->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label>Subkualifikasi</label>
                                        @if (!empty($is_edit))
                                            <div class="d-none text-center" style="position: absolute" id="loading">
                                                <i class="fa fa-spin fa-spinner fa-2x"></i>
                                            </div>
                                            <div class="" id="sub-none2">
                                                <select class="form-control js-select2 dynamic" name="subkualifikasi" id="option">
                                                    <option value="">― Pilih subkualifikasi ―</option>
                                                    @foreach ($subkualifikasi as $sub)
                                                        @if ($item->subkualifikasi == $sub->id)
                                                            <option selected value="{{$item->subkualifikasi}}">{{$item->masterSubkualifikasi->nama}}</option>
                                                        @else
                                                            <option value="{{$sub->id}}">{{$sub->nama}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-none" id="sub_kualifikasi">
                                                <select class="form-control js-select2 dynamic" name="subkualifikasi" id="option">
                                                    <option disabled value="">- Pilih subkualifikasi -</option>
                                                </select>
                                            </div>
                                        @endif
                                        @if (empty($is_edit))

                                            <div class="d-none" id="sub_kualifikasi">
                                                <select class="form-control js-select2 dynamic" name="subkualifikasi" id="option">
                                                    <option disabled value="">Pilih subkualifikasi</option>
                                                </select>
                                            </div>
                                            <div class="" id="sub-none2">
                                                <select class="form-control js-select2 dynamic" name="subkualifikasi" id="option">
                                                    <option value="">Pilih subkualifikasi</option>
                                                </select>
                                            </div>
                                            <div class="d-none text-center" style="position: absolute" id="loading">
                                                <i class="fa fa-spin fa-spinner fa-2x"></i>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DATA PERSONAL -->
                    <div class="block rounded @if(!($is_hrd_member))  d-none @endif">
                        <div class="block-content">
                            <h4 class="font-w400">DATA PERSONAL</h4>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>KTP</label>
                                        {{ Form::text('identity_card', null, ['class' => 'form-control', 'id' => 'inputID',
                                        'placeholder' => 'Masukkan Nomor KTP sesuai kartu identitas'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor KK</label>
                                        {{ Form::text('family_registers', null, ['class' => 'form-control', 'id' => 'inputKK', 'placeholder' => 'Masukkan Nomor KK sesuai kartu identitas'])}}
                                    </div>

                                    <div class="form-group">
                                        <label for="suku_bangsa">Suku/Bangsa</label>
                                        <input class="form-control" value="{{$item->suku_bangsa ?? ''}}" placeholder="Masukkan suku/bangsa" name="suku_bangsa" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label>Agama</label>
                                        @if (!empty($is_edit) && isset($is_edit))
                                            <select class="form-control js-select2" name="agama_id">
                                                <option value="" >- Masukkan Agama -</option>
                                                @foreach ($agama as $a)
                                                    @if ($item['agama_id'] == $a['id'])
                                                        <option selected value="{{$a['id']}}">{{$a['nama']}}</option>
                                                    @else
                                                        <option value="{{$a['id']}}">{{$a['nama']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="agama">
                                                <option value="">- Masukkan Agama -</option>
                                                @foreach ($agama as $a)
                                                    <option value="{{$a->id}}">{{$a->nama}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan nama pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Golongan Darah</label>
                                        {{ Form::select('blood_type', [
                                        'A' => 'A',
                                        'B' => 'B',
                                        'AB' => 'AB',
                                        'O' => 'O'
                                        ], ($is_edit ? $item->blood_type : null), ['placeholder' => '― Pilih Golongan Darah ―', 'class' => 'form-control js-select2']) }}
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP/Telpon</label>
                                        {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'inputPhone', 'placeholder' => 'Masukkan Nomor HP/Telpon aktif'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputEmail', 'Email', ['class' => 'col-sm-4 control-label'.(is_required_field('email', $rules) ? ' required-label':''), 'title' => (is_required_field('email', $rules) ? 'Required field':'')]) }}
                                        {{ Form::text('email', null, array_merge(['class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'Masukkan alamat email'])) }}
                                    </div>
                                    <div class="form-group">
                                        <label>NPWP</label>
                                        {{ Form::text('npwp', null, ['class' => 'form-control', 'id' => 'inputNPWP', 'placeholder' => 'Masukkan Nomor NPWP'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>SIM A</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" name="sim_a" value="{{$item->sim_a ?? ''}}" placeholder="Masukkan Nomor SIM">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>SIM B1</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" name="sim_b1" value="{{$item->sim_b1 ?? ''}}" placeholder="Masukkan Nomor SIM">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>SIM B2</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" name="sim_b2" value="{{$item->sim_b2 ?? ''}}" placeholder="Masukkan Nomor SIM">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>SIM C</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" name="sim_c" value="{{$item->sim_c ?? ''}}" placeholder="Masukkan Nomor SIM">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>SIM D</label>
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control" name="sim_d" value="{{$item->sim_d ?? ''}}" placeholder="Masukkan Nomor SIM">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Plat Kendaraan</label>
                                        {{ Form::text('license_plate', null, ['class' => 'form-control', 'id' => 'inputPlate', 'placeholder' => 'Masukkan Nomor Plat Kendaraan'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kendaraan</label>
                                        <div class="row">
                                            <div class="col-12">
                                                @if (empty($is_edit))
                                                    <select class="form-control js-select2" name="jenis_kendaraan_id">
                                                        <option value="" selected>- Jenis Kendaraan -</option>
                                                        @foreach ($jenis_kendaraan as $jk)
                                                            <option value="{{$jk->id}}">{{$jk->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @if (!empty($is_edit) && isset($is_edit))
                                                    <select class="form-control js-select2" name="jenis_kendaraan_id" required>
                                                        <option value="">- Masukkan Jenis Kendaraan -</option>
                                                        @foreach ($jenis_kendaraan as $jk)
                                                            @if ($item->jenis_kendaraan_id == $jk->id)
                                                                <option value="{{$item->jenis_kendaraan_id}}" selected>-{{$item->masterJenisKendaraan->nama}}</option>
                                                            @else
                                                                <option value="{{$jk->id}}">{{$jk->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Rekening Bank</label>
                                        <div class="row">
                                            <div class="col-4">
                                                @if (isset($is_edit) && !empty($is_edit))
                                                    <select class="form-control js-select2" name="bank">
                                                        <option value="">- Nama Bank -</option>
                                                        @foreach ($nama_bank as $bk)
                                                            @if ($item->bank == $bk->id)
                                                                <option selected value="{{$item->bank}}">{{$item->masterNamaBank->nama}}</option>
                                                            @else
                                                                <option value="{{$bk->id}}">{{$bk->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @if (empty($is_edit))
                                                    <select class="form-control js-select2" name="bank">
                                                        <option selected value="">- Nama Bank -</option>
                                                        @foreach ($nama_bank as $bk)
                                                            <option value="{{$bk->id}}">{{$bk->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                {{ Form::text('bank_account', null, ['class' => 'form-control', 'id' => 'inputLicenseNum', 'placeholder' => 'Masukkan Nomor Rekening'])}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="atas_nama_bank">Atas Nama Rekening Bank</label>
                                        <input type="text" value="{{$item->atas_nama_bank ?? ''}}" class="form-control" name="nama_rekening_bank" placeholder="Masukkan nama rekening bank yang sesuai">
                                    </div>

                                    <div class="form-group">
                                        <label>Status Rumah</label>
                                        @if (isset($is_edit) && !empty($is_edit))
                                            <select class="form-control js-select2" name="living_type" id="">
                                                <option value="">- Masukkan Status Rumah -</option>
                                                @foreach ($status_rumah as $sr)
                                                    @if ($item->status_rumah_id == $sr->id)
                                                        <option selected value="{{$item['status_rumah_id']}}" >{{$item->masterStatusRumah->status}}</option>
                                                    @else
                                                        <option value="{{$sr['id']}}">{{$sr['status']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="living_type" id="">
                                                <option value="">- Masukkan Status Rumah -</option>
                                                @foreach ($status_rumah as $sr)
                                                    <option value="{{$sr['id']}}">{{$sr['status']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Ukuran Tutup Kepala</label>
                                        {{ Form::text('headgear', null, ['class' => 'form-control', 'id' => 'inputHeadgear', 'placeholder' => 'Masukkan Ukuran Tutup Kepala'])}}
                                    </div>
                                    <div class="form-group">
                                        <label>Ukuran Baju</label>
                                        {{ Form::select('size_chart', [
                                        'XS' => 'XS',
                                        'S' => 'S',
                                        'M' => 'M',
                                        'L' => 'L',
                                        'XL' => 'XL',
                                        'XXL' => 'XXL',
                                        'XXXL' => 'XXXL',
                                        'XXXXL' => 'XXXXL'
                                        ], ($is_edit ? $item->size_chart : null), ['placeholder' => '― Pilih Ukuran Baju ―', 'class' => 'form-control js-select2']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputHeight', 'Tinggi Badan', ['class' => (is_required_field('height', $rules) ? ' required-label' : ''), 'title' => (is_required_field('height', $rules) ? 'Required field' : '')])}}
                                        <div class="form-inline">
                                            {{ Form::text('height', null, ['class' => 'form-control', 'id' => 'inputHeight', 'placeholder' => 'Masukkan Tinggi Badan'])}}
                                            {{ Form::label('inputHeight', 'cm', ['class' => 'align-text-bottom ml-30'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputWeight', 'Berat Badan', ['class' => (is_required_field('weight', $rules) ? ' required-label' : ''), 'title' => (is_required_field('weight', $rules) ? 'Required field' : '')])}}
                                        <div class="form-inline">
                                            {{ Form::text('weight', null, ['class' => 'form-control', 'id' => 'inputWeight', 'placeholder' => 'Masukkan Berat Badan'])}}
                                            {{ Form::label('inputHeight', 'kg', ['class' => 'align-text-bottom ml-30'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputShoes', 'Ukuran Sepatu', ['class' => (is_required_field('shoe_size', $rules) ? ' required-label' : ''), 'title' => (is_required_field('shoe_size', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('shoe_size', null, ['class' => 'form-control', 'id' => 'inputShoes', 'placeholder' => 'Masukkan Ukuran Sepatu dalam satuan EUR'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DATA PERNIKAHAN -->
                    <div class="block rounded @if(!($is_hrd_member))  d-none @endif">
                        <div class="block-content">
                            <h4 class="font-w400">DATA PERNIKAHAN</h4>
                            <hr>
                            <div class="row">
                                <!-- manipulate blade for marriage thingy -->
                                @php
                                    if($is_edit) {
                                    $item->status = $item->total_child = $item->marriage_certificate_number = $item->marriage_date = $item->marriage_place = $item->couple_job = null;
                                    if(!empty($marriage->status))
                                    $item->status = $marriage->status;
                                    if(!empty($marriage->total_child))
                                    $item->total_child = $marriage->total_child;
                                    if(!empty($marriage->marriage_certificate_number))
                                    $item->marriage_certificate_number = $marriage->marriage_certificate_number;
                                    if(!empty($marriage->marriage_date))
                                    $item->marriage_date = $marriage->marriage_date;
                                    if(!empty($marriage->marriage_place))
                                    $item->marriage_place = $marriage->marriage_place;
                                    if(!empty($marriage->couple_job))
                                    $item->couple_job = $marriage->couple_job;
                                  }
                                @endphp
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('inputStatus', 'Status', ['class' => (is_required_field('status', $rules) ? ' required-label' : ''), 'title' => (is_required_field('status', $rules) ? 'Required field' : '')])}}

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusTK" name="status" class="custom-control-input" value="TK"
                                                   @if(!empty($marriage->status) && $marriage->status == 'TK')
                                                   checked
                                                    @endif
                                            >
                                            <label class="custom-control-label" for="statusTK">Belum Menikah</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusK" name="status" class="custom-control-input" value="K"
                                                   @if(!empty($marriage->status) && $marriage->status == 'K')
                                                   checked
                                                    @endif
                                            >
                                            <label class="custom-control-label" for="statusK">Menikah</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusD" name="status" class="custom-control-input" value="D"
                                                   @if(!empty($marriage->status) && $marriage->status == 'D')
                                                   checked
                                                    @endif
                                            >
                                            <label class="custom-control-label" for="statusD">Duda</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="statusJ" name="status" class="custom-control-input" value="J"
                                                   @if(!empty($marriage->status) && $marriage->status == 'J')
                                                   checked
                                                    @endif
                                            >
                                            <label class="custom-control-label" for="statusJ">Janda</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputChild', 'Jumlah Anak', ['class' => (is_required_field('total_child', $rules) ? ' required-label' : ''), 'title' => (is_required_field('total_child', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('total_child', null, ['class' => 'form-control', 'id' => 'inputChild', 'placeholder' => 'Masukkan Jumlah Anak Kandung'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputCertificateNumber', 'Nomor Surat Nikah', ['class' => (is_required_field('marriage_certificate_number', $rules) ? ' required-label' : ''), 'title' => (is_required_field('marriage_certificate_number', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('marriage_certificate_number', null, ['class' => 'form-control', 'id' => 'inputCertificateNumber', 'placeholder' => 'Masukkan Nomor Surat Nikah sesuai dengan buku nikah'])}}
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('inputMDate', 'Tanggal Pernikahan', ['class' => (is_required_field('marriage_date', $rules) ? ' required-label' : ''), 'title' => (is_required_field('marriage_date', $rules) ? 'Required field' : '')])}}
                                        <div class="input-group">
                                            {{ Form::text('marriage_date', null, ['class' => 'form-control combodate', 'id' => 'inputMDate', 'data-format' => 'YYYY-MM-DD HH:mm:ss', 'data-template' => 'D MMMM YYYY'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputMPlace', 'Tempat Pernikahan', ['class' => (is_required_field('marriage_place', $rules) ? ' required-label' : ''), 'title' => (is_required_field('marriage_place', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('marriage_place', null, ['class' => 'form-control', 'id' => 'inputMPlace', 'placeholder' => 'Masukkan Tempat Pernikahan dilakukan'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputCoupleJob', 'Pekerjaan Pasangan', ['class' => (is_required_field('couple_job', $rules) ? ' required-label' : ''), 'title' => (is_required_field('couple_job', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('couple_job', null, ['class' => 'form-control', 'id' => 'inputCoupleJob', 'placeholder' => 'Masukkan Pekerjaan Suami/Istri'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DATA KESEHATAN -->
                    <div class="block rounded">
                        <div class="block-content">
                            <h4 class="font-w400">DATA KESEHATAN</h4>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-6">

                                    <div class="form-group">
                                        <label for="faskes_asuransi_id">Perusahaan Asuransi</label>
                                        @if (!empty($is_edit))
                                            <select name="faskes_asuransi_id" class="form-control js-select2">
                                                <option value="">- Masukkan perusahaan asuransi -</option>
                                                @foreach ($asuransi as $as)
                                                    @if ($item->faskes_asuransi_id == $as->id)
                                                        <option selected value="{{$item->faskes_asuransi_i}}">{{$item->masterFaskesAsuransi->nama}}</option>
                                                    @else
                                                        <option value="{{$as->id}}">{{$as->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select name="faskes_asuransi_id" class="form-control js-select2">
                                                <option value="">- Masukkan perusahaan asuransi -</option>
                                                @foreach ($asuransi as $as)
                                                    <option value="{{$as->id}}">{{$as->nama}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputBPJS', 'Nomor Asuransi', ['class' => (is_required_field('bpjs', $rules) ? ' required-label' : ''), 'title' => (is_required_field('bpjs', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('bpjs', null, ['class' => 'form-control', 'id' => 'inputBPJS', 'placeholder' => 'Masukkan Nomor Asuransi'])}}
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('inputClass', 'Kelas Pelayanan', ['class' => (is_required_field('class', $rules) ? ' required-label' : ''), 'title' => (is_required_field('class', $rules) ? 'Required field' : '')])}}
                                        {{ Form::select('class', [
                                        'Kelas 1' => 'Kelas 1',
                                        'Kelas 2' => 'Kelas 2',
                                        'Kelas 3' => 'Kelas 3',
                                        ], ($is_edit ? $item->class : null), ['placeholder' => '― Pilih Kelas Pelayanan ―', 'class' => 'form-control js-select2']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputFaskes', 'Faskes', ['class' => (is_required_field('faskes', $rules) ? ' required-label' : ''), 'title' => (is_required_field('faskes', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('faskes', null, ['class' => 'form-control', 'id' => 'inputFaskes', 'placeholder' => 'Masukkan Nama Faskes'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DATA KEPEGAWAIAN -->
                    <div class="block rounded @if(!$is_hrd_member)  d-none @endif">
                        <div class="block-content">
                            <h4 class="font-w400">DATA KONTRAK KERJA</h4>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('inputOStatus', 'Jenis Pegawai', ['class' => (is_required_field('official_status', $rules) ? ' required-label' : ''), 'title' => (is_required_field('official_status', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        @if (isset($is_edit) && !empty($is_edit))
                                            <select class="form-control js-select2" name="jenis_pegawai_id" required>
                                                <option value="">- Pilih Jenis Pegawai</option>
                                                @foreach ($jenis_pegawai as $jp)
                                                    @if ($item['jenis_pegawai_id'] == $jp['id'])
                                                        <option value="{{$item['jenis_pegawai_id']}}" selected>{{$item->masterJenisPegawai->nama}}</option>
                                                    @else
                                                        <option value="{{$jp['id']}}">{{$jp['nama']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="jenis_pegawai_id" required>
                                                <option value="" selected >- Pilih Jenis Pegawai -</option>
                                                @foreach ($jenis_pegawai as $jp)
                                                    <option value="{{$jp['id']}}">{{$jp['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan jenis pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputOStatus', 'Jabatan Pegawai', ['class' => (is_required_field('official_jabatan', $rules) ? ' required-label' : ''), 'title' => (is_required_field('official_jabatan', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        @if (!empty($is_edit))
                                            <select class="form-control js-select2" name="jabatan_id" required>
                                                <option value="">- Pilih Jabatan Pegawai -</option>
                                                @foreach ($jabatan_pegawai as $jp)
                                                    @if ($item->jabatan_id == $jp->id)
                                                        <option value="{{$item->jabatan_id}}" selected>{{$item->MasterJabatan->nama}}</option>
                                                    @else
                                                        <option value="{{$jp->id}}">{{$jp->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="jabatan_id" required>
                                                <option value="" selected >- Pilih Jabatan Pegawai -</option>
                                                @foreach ($jabatan_pegawai as $jp)
                                                    <option value="{{$jp['id']}}">{{$jp['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan jabatan pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputOStatus', 'Pendidikan Pegawai')}}<label class="text-danger"> *</label>
                                        @if (!empty($is_edit))
                                            <select class="form-control js-select2" name="pendidikan_gelar_id" required>
                                                <option value="">- Pilih Pendidikan Pegawai -</option>
                                                @foreach ($pendidikan as $pp)
                                                    @if ($item->pendidikan_gelar_id == $pp->id)
                                                        <option value="{{$item->pendidikan_gelar_id}}" selected>{{$item->masterGelar->nama}}</option>
                                                    @else
                                                        <option value="{{$pp->id}}">{{$pp->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="pendidikan_gelar_id" required>
                                                <option value="" selected >- Pilih Pendidikan Pegawai -</option>
                                                @foreach ($pendidikan as $pp)
                                                    <option value="{{$pp['id']}}">{{$pp['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan pendidikan pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputKategoriPegawai', 'Kategori Pegawai', ['class' => (is_required_field('kategori_pegawai', $rules) ? ' required-label' : ''), 'title' => (is_required_field('kategori_pegawai', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        @if (isset($is_edit) && !empty($is_edit))
                                            <select class="form-control js-select2" name="kategori_pegawai_id" required>
                                                <option value="">- Pilih Kategori Pegawai</option>
                                                @foreach ($kategori_pegawai as $kp)
                                                    @if ($item['kategori_pegawai_id'] == $kp['id'])
                                                        <option value="{{$item['kategori_pegawai_id']}}" selected>{{$item->masterKategoriPegawai->nama}}</option>
                                                    @else
                                                        <option value="{{$kp['id']}}">{{$kp['nama']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="kategori_pegawai_id" required>
                                                <option value="" selected >- Pilih Kategori Pegawai -</option>
                                                @foreach ($kategori_pegawai as $kp)
                                                    <option value="{{$kp['id']}}">{{$kp['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan kategori pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputGolonganPegawai', 'Golongan Pegawai', ['class' => (is_required_field('golongan_pegawai', $rules) ? ' required-label' : ''), 'title' => (is_required_field('golongan_pegawai', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        @if (isset($is_edit) && !empty($is_edit))
                                            <select class="form-control js-select2" name="golongan_pegawai_id" required>
                                                <option value="">- Pilih Golongan Pegawai</option>
                                                @foreach ($golongan_pegawai as $gp)
                                                    @if ($item['golongan_pegawai_id'] == $gp['id'])
                                                        <option value="{{$item['golongan_pegawai_id']}}" selected>{{$item->masterGolonganPegawai->nama}}</option>
                                                    @else
                                                        <option value="{{$gp['id']}}">{{$gp['nama']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="golongan_pegawai_id" required>
                                                <option value="" selected >- Pilih Golongan Pegawai -</option>
                                                @foreach ($golongan_pegawai as $gp)
                                                    <option value="{{$gp['id']}}">{{$gp['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan golongan pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputOStatus', 'Beban Kerja', ['class' => (is_required_field('official_beban_kerja', $rules) ? ' required-label' : ''), 'title' => (is_required_field('official_beban_kerja', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        @if (!empty($is_edit))
                                            <select class="form-control js-select2" name="beban_kerja_id" required>
                                                <option value="">- Pilih Beban Kerja -</option>
                                                @foreach ($beban_kerja as $bk)
                                                    @if ($item->beban_kerja_id == $bk->id)
                                                        <option value="{{$item->beban_kerja_id}}" selected>{{$item->MasterBebanKerja->nama}}</option>
                                                    @else
                                                        <option value="{{$bk->id}}">{{$bk->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="beban_kerja_id" required>
                                                <option value="" selected >- Pilih Beban Kerja -</option>
                                                @foreach ($beban_kerja as $bk)
                                                    <option value="{{$bk['id']}}">{{$bk['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan beban kerja </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputOStatus', 'Resiko Kerja', ['class' => (is_required_field('official_resiko_kerja', $rules) ? ' required-label' : ''), 'title' => (is_required_field('official_resiko_kerja', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        @if (!empty($is_edit))
                                            <select class="form-control js-select2" name="resiko_kerja_id" required>
                                                <option value="">- Pilih Resiko Kerja -</option>
                                                @foreach ($resiko_kerja as $bk)
                                                    @if ($item->resiko_kerja_id == $bk->id)
                                                        <option value="{{$item->resiko_kerja_id}}" selected>{{$item->MasterResikoKerja->nama}}</option>
                                                    @else
                                                        <option value="{{$bk->id}}">{{$bk->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="resiko_kerja_id" required>
                                                <option value="" selected >- Pilih Resiko Kerja -</option>
                                                @foreach ($resiko_kerja as $bk)
                                                    <option value="{{$bk['id']}}">{{$bk['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan resiko kerja </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputOStatus', 'Tim Pembagi Jasa')}}
                                        @if (!empty($is_edit))
                                            <select class="form-control js-select2" name="tim_pembagi_jasa_id">
                                                <option value="">- Pilih Tim Pembagi Jasa -</option>
                                                @foreach ($tim_pembagi_jasa as $bk)
                                                    @if ($item->tim_pembagi_jasa_id == $bk->id)
                                                        <option value="{{$item->tim_pembagi_jasa_id}}" selected>{{$item->MasterTimPembagiJasa->nama}}</option>
                                                    @else
                                                        <option value="{{$bk->id}}">{{$bk->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="tim_pembagi_jasa_id" required>
                                                <option value="" selected >- Pilih Tim Pembagi Jasa -</option>
                                                @foreach ($tim_pembagi_jasa as $bk)
                                                    <option value="{{$bk['id']}}">{{$bk['nama']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="invalid-feedback">Silahkan masukkan tim pembagi jasa </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('inputSPHL', 'Nomor Surat Tugas Masuk', ['class' => (is_required_field('phl_status', $rules) ? ' required-label' : ''), 'title' => (is_required_field('phl_status', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('phl_status', null, ['class' => 'form-control', 'id' => 'inputSPHL', 'placeholder' => 'Masukkan Nomor Surat Tugas Masuk'])}}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('inputSprintOut', 'Nomor Surat Tugas Keluar', ['class' => (is_required_field('sprin_out_number', $rules) ? ' required-label' : ''), 'title' => (is_required_field('sprin_out_number', $rules) ? 'Required field' : '')])}}
                                        {{ Form::text('sprin_out_number', null, ['class' => 'form-control', 'id' => 'inputSprintOut', 'placeholder' => 'Masukkan Nomor Surat Tugas Keluar'])}}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('inputSAktif', 'Status Aktif', ['class' => (is_required_field('status_aktif', $rules) ? ' required-label' : ''), 'title' => (is_required_field('status_aktif', $rules) ? 'Required field' : '')])}}
                                        <label class="text-danger"> *</label>

                                        @if (empty($is_edit))
                                            <select class="form-control js-select2" name="status_pegawai_id" required>
                                                <option value="" selected>- Pilih Status Pegawai -</option>
                                                @foreach ($status_pegawai as $status)
                                                    <option value="{{$status->id}}">{{$status->status}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if(!empty($is_edit))
                                            <select class="form-control js-select2" name="status_pegawai_id" required>
                                                <option value="">- Pilih Status Pegawai -</option>
                                                @foreach ($status_pegawai as $status)
                                                    @if ($item->status_pegawai_id == $status->id)
                                                        <option selected value="{{$item->status_pegawai_id}}">{{$item->masterStatusPegawai->status}}</option>
                                                    @else
                                                        <option value="{{$status->id}}">{{$status->status}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif

                                        <div class="invalid-feedback">Silahkan pilih status aktif pegawai </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputTMT', 'Tanggal Masuk', ['class' => (is_required_field('tmt', $rules) ? ' required-label' : ''), 'title' => (is_required_field('tmt', $rules) ? 'Required field' : '')])}} <label class="text-danger"> *</label>
                                        <div class="input-group">
                                            <input type="text" name="tmt" required value="{{$item->tmt ?? ''}}" class="form-control combodate-maxyear" data-format="YYYY-MM-DD HH:mm:ss" data-template="D MMMM YYYY"> <br>
                                            <div class="invalid-feedback">Silahkan masukkan Tanggal Masuk pegawai </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inputTMT', 'Tanggal Keluar', ['class' => (is_required_field('tmt', $rules) ? ' required-label' : ''), 'title' => (is_required_field('tmt', $rules) ? 'Required field' : '')])}}
                                        <div class="input-group">
                                            <input name="tmt_out" type="text" value="{{$item->tmt_out ?? ''}}" class="form-control combodate-maxyear" data-format="YYYY-MM-DD HH:mm:ss" data-template="D MMMM YYYY">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @include('kepegawaian.pegawai.form-content.profesi') --}}
                </div>

                <div class="col-12">
                    <div class="form-group row justify-content-center">
                        @if (empty($is_edit))
                            <button type="submit" class="btn btn-primary btn-submit btn-click-animate" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Simpan</button>
                        @endif
                        @if (!empty($is_edit))
                            <button type="submit" class="btn btn-primary btn-submit btn-click-animate" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Update</button>
                        @endif

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        @endsection

        @push('footer-script')
            <script>
                $(document).ready(function(){
                    $('body').on("change", "#kota",function(){
                        let kota = $(this).val();
                        $.ajax({
                            url: "{{route('list-kecamatan')}}",
                            type: 'get',
                            data: {
                                kota,
                            },
                            success: function(datas){
                                $('#kecamatan').html('');
                                $('#kecamatan').append(`<option value="">― Pilih Kecamatan ―</option>`);
                                $('#kelurahan').html('');
                                $('#kelurahan').append(`<option value="">― Pilih Kelurahan ―</option>`);
                                $.each(datas, function(key,data){
                                    $('#kecamatan').append(`
                    <option value="${data.id}">${data.nama}</option>
                `);
                                });
                            }
                        });
                    });
                })

                $(document).ready(function(){
                    $('body').on("change", "#kecamatan",function(){
                        let kecamatan = $(this).val();
                        $.ajax({
                            url: "{{route('list-kelurahan')}}",
                            type: 'get',
                            data: {
                                kecamatan,
                            },
                            success: function(datas){
                                $('#kelurahan').html('');
                                $('#kelurahan').append(`<option value="">― Pilih Kelurahan ―</option>`);
                                $.each(datas, function(key,data){
                                    $('#kelurahan').append(`
                    <option value="${data.id}">${data.nama}</option>
                `);
                                });
                            }
                        });
                    });
                })

                $(document).ready(function(){
                    $('.btn-spin').hide();
                })

                $(document).on("click",".btn-delete", function () {
                    $('.btn-spin').show();
                })

                $(document).on("click",".btn-batal", function () {
                    $('.btn-spin').hide();
                })

                var kualifikasi_id = null;

                $('#kualifikasi').change(function(){
                    kualifikasi_id = $(this).val();
                    $('#sub-none1').addClass('d-none');
                    $('#sub-none2').addClass('d-none');
                    searchSubkualifikasi();
                });

                function searchSubkualifikasi() {
                    var url = '{{route("pegawai-search")}}';
                    $.ajax({
                        url: url,
                        type: "GET",
                        data: {
                            kualifikasi_id,
                        },
                        beforeSend:function() {
                            $('#loading').removeClass('d-none');
                            $('#sub_kualifikasi').addClass('d-none');
                        },
                        success: function(datas){
                            $('#sub_kualifikasi').html(`
            <div>
							<select class="form-control js-select2 dynamic" name="subkualifikasi" id="data_subkualifikasi">
								<option value="">― Pilih subkualifikasi ―</option>
							</select>
						</div>
          `);
                            $.each(datas, function(key,data){
                                $('#data_subkualifikasi').append(`
              <option value="${data.id}">${data.nama}</option>      
            `);
                            });
                            $('#loading').addClass('d-none');
                            $('#sub_kualifikasi').removeClass('d-none');
                        }
                    });
                }

                // onReady closure-scope
                (function($){
                    // Ready!

                    var name = 'Data pegawai';

                    //save confirmation
                    saveAlert(1, '#mainform','', name, 'mainform');

                    combodateFirst('.combodate');
                    combodateFirst('.combodate-maxyear',2100);
                    $('.js-select2').select2();
                    $('.format_date').datepicker({format: "yyyy-mm-dd",autoclose:false}).datepicker('setDate', new Date());

                    //upload photo
                    $(document).on('change', '.btn-file :file', function() {
                        var input = $(this),
                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                        input.trigger('fileselect', [label]);
                    });

                    function readURL(input,target) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $(target).attr('style', "background-image: url(" + e.target.result + ");");
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }


                    function readURL2(input, param,title) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $(param).attr('src', e.target.result);
                                $(title).val(input.value.split("\\").pop());
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#photo").change(function(){
                        readURL(this, '#imagePreview');
                    });
                    $("#img-str-input").change(function(){
                        readURL2(this, '#img-str-preview','#file-name-str');
                    });
                    $("#img-sip-input").change(function(){
                        readURL2(this, '#img-sip-preview','#file-name-sip');
                    });
                    $("#img-ppa-1-input").change(function(){
                        readURL2(this, '#img-ppa-1-preview','#file-name-ppa-1');
                    });
                    $("#img-ppa-2-input").change(function(){
                        readURL2(this, '#img-ppa-2-preview','#file-name-ppa-2');
                    });
                    $("#img-ppa-3-input").change(function(){
                        readURL2(this, '#img-ppa-3-preview','#file-name-ppa-3');
                    });
                    //upload photo end

                    $(function(){
                        let $form = $('form#mainform'),
                            is_edit = ($form.attr('is_edit') == 1),
                            photo = $form.find('#photo'),
                            cityId = null,
                            ignite_select2 = function(){}
                        ;

                        $('.js-select2.dynamic').select2({
                            tags: true
                        });

                        ignite_select2 = function(){
                            let mapItems = {
                                religion: {
                                    fn: formatReligion,
                                    mt: 'getReligions'
                                },
                                city: {
                                    fn: formatCity,
                                    mt: 'getCities'
                                },
                                district: {
                                    fn: formatDistrcit,
                                    mt: 'getDistricts'
                                }
                            };

                            $form.find('.select2-ajax').each(function(){
                                let $me = $(this),
                                    item_rpp = 10,
                                    s2 = $me.data('s2'),
                                    MI = ('undefined' != typeof mapItems[s2] ? mapItems[s2] : null)
                                value = null
                                ;

                                if(!MI)
                                    return true;

                                // Select2 has been rendered
                                if($me.data('select2'))
                                    return true;

                                if(is_edit) {
                                    value = $me.data('edit');

                                    if( 'undefined' != typeof value && value )
                                        $me.append('<option value="'+value.id+'" selected="selected">'+value.name+'</option>');
                                }

                                $me
                                    .select2({
                                        ajax: {
                                            url: AJAX_URL+'?act=ajax&mt='+MI.mt,
                                            dataType: 'json',
                                            delay: 250,
                                            data: function(params) {
                                                let data_ = {};

                                                data_ = {
                                                    q: params.term,
                                                    rpp: item_rpp,
                                                    id: cityId,
                                                    page: params.page||1
                                                };

                                                return data_;
                                            },
                                            processResults: function(data, params) {
                                                let dataparams = (data.params ? data.params : {}),
                                                    total_item = data.total||0
                                                ;

                                                params.page = dataparams.page||1;

                                                return {
                                                    results: (data.items && data.items.length ? data.items : []),
                                                    pagination: {
                                                        more: (params.page * item_rpp) < total_item
                                                    }
                                                };
                                            },
                                            cache: !1
                                        },
                                        escapeMarkup: function(markup) { return markup; },
                                        minimumInputLength: 0,
                                        templateResult: MI.fn,
                                        templateSelection: formatRepoSelection
                                    })
                                    .on('change.select2', function(e){
                                        if(s2 == 'city')
                                            cityId = $me.val();
                                    });

                                if(s2 == 'city')
                                    cityId = $me.val();
                            });

                            function formatReligion(item) {
                                if(item.loading) return item.text;

                                let markup = ""
                                    +"<div class='select2-result-religion clearfix'>"
                                    +"<div class='select2-result-religion__full'>" + item.name + "</div>"
                                    +"</div>"
                                ;

                                return markup;
                            }

                            function formatDistrcit(item) {
                                if(item.loading) return item.text;

                                let markup = ""
                                    +"<div class='select2-result-district clearfix'>"
                                    +"<div class='select2-result-district__full'>" + item.name + "</div>"
                                    +"</div>"
                                ;

                                return markup;
                            }

                            function formatCity(item) {
                                if(item.loading) return item.text;

                                let markup = ""
                                    +"<div class='select2-result-city clearfix'>"
                                    +"<div class='select2-result-city__full'>" + item.name + "</div>"
                                    +"</div>"
                                ;

                                return markup;
                            }

                            function formatRepoSelection(item) {
                                return item.name || item.text;
                            }
                        };

                        ignite_select2();
                    });
                })(window.$||window.jQuery||jQuery);


            </script>
    @endpush