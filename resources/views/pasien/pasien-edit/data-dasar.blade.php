
<div class="row justify-content-center ">
    <div class="col-md-4 ">
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type="file" class="read-file-upload" id="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
                <label for="avatar"></label>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview_avatar" style="background-image: url({{url($pasien['identitas']->photo_thumb)}});">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h4 class="mb-0">Data Pasien</h4>
        <hr> 
        <div class="row">
            <div class="col-lg-6 col-12">

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">No RM</label>
                            <input class="form-control" type="text" name="" id="no_rm" placeholder="Nomor RM" value="{{$pasien['identitas']->no_rm}}" readonly="">
                            {{-- <small>Pastikan tidak terdapat pasien dengan nomor RM yang sama</small> --}}
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Jenis Kartu Identitas</label>
                            <select name="kelas" id="selectKartuIdentitas" class="form-control" data-size="2" onchange="nomorCheck()">
                                @foreach($form['kartu_identitas'] as $item)
                                @if($pasien['identitas']->jenis_kartu_identitas_id == $item->id)
                                <option value="{{$item->id}}" selected="selected">{{$item->nama}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">No Identitas <i id="identitasLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <input class="form-control" type="text" name="" id="noIdentitas" placeholder="Nomor Identitas" value="{{$pasien['identitas']->no_identitas}}" onblur="nomorCheck()" />
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Nama Lengkap</label>
                            <input class="form-control" type="text" name="name" placeholder="Ketik nama lengkap sesuai kartu identitas" value="{{$pasien['identitas']->name}}" />
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Jenis Kelamin</label>

                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="gender" id="gender-1" value="1" onchange="changeGender(1)" 
                                @if($pasien['identitas']->gender == 1) checked @endif
                                > 
                                <label class="custom-control-label" for="gender-1">Laki Laki</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" id="gender-2" name="gender" value="2" onchange="changeGender(2)"
                                @if($pasien['identitas']->gender == 2) checked @endif>
                                <label class="custom-control-label" for="gender-2">Perempuan</label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Status Pernikahan</label>


                            @foreach($form['pernikahan'] as $item)

                            <div class="custom-control custom-radio mb-5">
                                <input class="custom-control-input" type="radio" name="marriage" id="marriage-{{$item->id}}" value="{{$item->id}}" onchange="changeMarriage({{$item->id}})" @if($pasien['identitas']->marriage == $item->id) checked @endif>
                                <label class="custom-control-label" for="marriage-{{$item->id}}">{{$item->nama}}</label>
                            </div>

                            @endforeach


                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Tempat Lahir</label>
                            <input class="form-control" type="text" name="birthplace" placeholder="Ketik tempat lahir sesuai kartu identitas" value="{{$pasien['identitas']->place_of_birth}}"/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Tanggal Lahir</label>
                            <div class="form-inline">
                                <div class="input-group">
                                    <input class="form-control" type="text" id="tanggal-lahir" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="birthdate" value="{{$pasien['identitas']->date_of_birth}}">  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Nama Ayah</label>
                            <input class="form-control" type="text" name="nama_ayah" placeholder="Ketik nama ayah" value="{{$pasien['identitas']->nama_ayah ?? '-'}}" id="nama_ayah">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Nama Ibu</label>
                            <input class="form-control" type="text" name="nama_ibu" placeholder="Ketik nama ibu" value="{{$pasien['identitas']->nama_ibu ?? '-'}}" id="nama_ibu">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Nama Istri</label>
                            <input class="form-control" type="text" name="nama_istri" placeholder="Ketik nama istri" value="{{$pasien['identitas']->nama_istri ?? '-'}}" id="nama_istri">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Nama Suami</label>
                            <input class="form-control" type="text" name="nama_suami" placeholder="Ketik nama suami" value="{{$pasien['identitas']->nama_suami ?? '-'}}" id="nama_suami">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-12">

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Alamat KTP</label>
                            <input class="form-control" type="text" name="address" placeholder="Ketik alamat sesuai kartu identitas" value="{{$pasien['identitas']->address}}" />
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Alamat Domisili</label>
                            <input class="form-control" type="text" name="address_domisili" placeholder="Ketik alamat domisili saat ini" value="{{$pasien['identitas']->address_domisili}}"/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group row">
                            <label class="col-12" for="example-select2">Kota/Kabupaten</label>
                            <div class="col-lg-12">
                                <select class="js-select2 form-control" id="kotaSelect2" name="city" style="width: 100%;" data-placeholder="Pilih kota/kabupaten">

                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Kecamatan <i id="kecamatanLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <select name="district" class="form-control js-select2" data-placeholder="Pilih Kecamatan" id="kecamatanSelect2" style="width: 100%;">
                            </select>
                        </div>

                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Kelurahan <i id="kelurahanLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                            <select name="kelurahan" class="form-control js-select2" style="width: 100%;" data-placeholder="Pilih Kelurahan" id="kelurahanSelect2">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">No Telp</label>
                            <input class="form-control" type="number" name="phone" placeholder="HP/Nomor Rumah" value="{{filter_var(($pasien['identitas']->phone ?? '') , FILTER_SANITIZE_NUMBER_INT)}}" />
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Pekerjaan</label>
                            <select name="occupation" id="selectPekerjaan" class="form-control" style="width: 100%;" data-size="2">
                                @if($pasien['identitas']->job)
                                <option value="{{$pasien['identitas']->job}}" selected="selected">{{$pasien['identitas']->job}}</option>
                                @endif 
                                @foreach($form['jenis_pekerjaan'] as $item)
                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Agama</label>
                            <select name="kelas" id="selectAgama" class="form-control js-select2" style="width: 100%;" data-size="2">
                                @foreach($form['agama'] as $item)
                                @if($pasien['identitas']->agama_id == $item->id)
                                <option value="{{$item->id}}" selected="selected">{{$item->nama}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Pendidikan</label>
                            <select name="kelas" id="selectPendidikan" class="form-control js-select2" style="width: 100%;" data-size="2">
                                @foreach($form['pendidikan'] as $item)
                                @if($pasien['identitas']->pendidikan_id == $item->id)
                                <option value="{{$item->id}}" selected="selected">{{$item->nama}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Suku</label>
                            <input type="text" name="suku" class="form-control" id="suku" required="" value="{{$pasien['identitas']->suku}}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label class="control-label">Alergi</label>
                            <input type="text" name="alergi" class="form-control" placeholder="Ketik alergi" id="alergi" value="{{$pasien['identitas']->alergi}}">
                        </div>
                    </div>
                </div>
            </div>
            @if(config('app.is_military'))
            <div class="col-12 pt-20">
                <label class="css-control css-control-primary css-checkbox">
                    <input type="checkbox" class="css-control-input" id="anggota-trigger">
                    <span class="css-control-indicator"></span> Pasien adalah Anggota
                </label>
            </div>
            @endif
        </div>

        @if(config('app.is_military'))
        <div class="row">
            <div class="col-12">
                <hr>
                {{-- <h4 class="mb-0">Perubahan Data Keanggotaan</h4> --}}

                <div class="row" id="formAnggota">
                    <div class="col-lg-6 col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">NRP/NIP</label>
                                    <input class="form-control enabledisable" type="text" name="nrp" id="tniNrp" placeholder="NRP / NIP Anggota" value="{{$pasien['identitas']->tni_nrp}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Keanggotaan</label>
                                    <select name="kelas" id="selectKeanggotaan" class="form-control js-select2 enabledisable emptiable-dasar" data-size="2" style="width: 100%;" data-placeholder="Pilih Keanggotaan">
                                        <option></option>
                                        @foreach($form['tni_keanggotaan'] as $item)
                                        @if($pasien['identitas']->tni_keanggotaan_id == $item->id)
                                        <option value="{{$item->id}}" selected="selected">{{$item->nama}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Pangkat <i id="pangkatLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                                    <select name="kelas" id="selectPangkat" class="form-control js-select2 enabledisable emptiable-dasar" data-size="2" style="width: 100%;" data-placeholder="Pilih Pangkat">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Singkat Pangkat</label>
                                    <input class="form-control enabledisable emptiable-dasar" name="tni_pangkat_singkat" id="TNIsingkatPangkat" value="{{$pasien['identitas']->tni_pangkat_singkat}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">

                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Kotama</label>
                                    <select name="kelas" id="selectKotama" class="form-control js-select2 enabledisable emptiable-dasar" data-size="2" style="width: 100%;" data-placeholder="Pilih Kotama">
                                        <option></option>
                                        @foreach($form['tni_kotama'] as $item)
                                        @if($pasien['identitas']->tni_kotama_id == $item->id)
                                        <option value="{{$item->id}}" selected="selected">{{$item->nama}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Satker <i id="satkerLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                                    <select name="kelas" id="selectSatker" class="form-control js-select2 enabledisable emptiable-dasar" data-size="2" style="width: 100%;" data-placeholder="Pilih Satker">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Korps</label>
                                    <select name="kelas" id="selectKorps" class="form-control js-select2 enabledisable emptiable-dasar" style="width: 100%;" data-size="2" data-placeholder="Pilih Kotama">
                                        <option></option>
                                        @foreach($form['tni_korps'] as $item)
                                        @if($pasien['identitas']->tni_korps_id == $item->id)
                                        <option value="{{$item->id}}" selected="selected">{{$item->nama}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Jabatan</label>
                                    <input class="form-control enabledisable emptiable-dasar" name="kelas" id="jabatanTNI" value="{{$pasien['identitas']->tni_jabatan}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        @endif
        
    </div>
</div>
