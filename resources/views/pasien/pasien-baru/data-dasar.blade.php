<h5 class="uppercase">Data Dasar Pasien
    <hr>
</h5>

<div class="row justify-content-center ">
    <div class="col-md-4 rm_biasa">
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type="file" id="avatar" name="avatar" accept=".png, .jpg, .jpeg" value="" />
                <label for="avatar"></label>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview_avatar" style="background-image: url({{url('assets/img/placeholder.jpg')}});">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-6 col-sm-12">

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Jenis Kartu Identitas</label>
                    <select name="kelas" id="selectKartuIdentitas" class="form-control mb-5 js-select2" data-size="2" onchange="nomorCheck()" data-placeholder="pilih jenis kartu identitas">
                        <option></option>
                        @foreach($form['kartu_identitas'] as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                   
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">No Identitas <i id="identitasLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <input class="form-control rm_laborat" type="text" name="" id="noIdentitas" placeholder="Nomor Identitas" required="required" onblur="nomorCheck()"/>
                     <div id="textAutoInputNIK"></div>
                     <div id="textCekNomorIdentitas"></div>
                    <a href="javascript:void(0)" id="notifExistAutoInputNIK" data-toggle="modal" data-target="#modal-autoinput-pasien" style="display: none">Klik Disini! Kami menemukan data pasien yang sesuai dengan nomor NIK</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nama Lengkap <i id="namaLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <input class="form-control rm_laborat" type="text" name="name" id="namaPasien" placeholder="Ketik nama lengkap sesuai kartu identitas" required="required"/>
                    <div class="invalid-feedback">Nama ini sudah digunakan atau data nama pasien kosong</div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Jenis Kelamin</label>
                    @foreach($form['kelamin'] as $item)
                    <div class="custom-control custom-radio mb-5">
                        <input class="custom-control-input" type="radio" id="gender-{{$item->id}}" name="gender"  value="{{$item->id}}" onchange="changeGender({{$item->id}})">
                        <label class="custom-control-label" for="gender-{{$item->id}}">{{$item->nama}}</label>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Status Pernikahan</label>


                    @foreach($form['pernikahan'] as $item)

                    <div class="custom-control custom-radio mb-5">
                        <input class="custom-control-input" type="radio" name="marriage" id="marriage-{{$item->id}}" value="{{$item->id}}"
                         onchange="changeMarriage({{$item->id}})"
                         >
                        <label class="custom-control-label" for="marriage-{{$item->id}}">{{$item->nama}}</label>
                    </div>

                    @endforeach


                </div>
            </div>
        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Tempat Lahir</label>
                    <input class="form-control" type="text" name="birthplace" placeholder="Ketik tempat lahir sesuai kartu identitas" required="required"/>
                    <div class="invalid-feedback">Silahkan isi data tempat lahir pasien</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Tanggal Lahir</label>
                    <div class="form-inline">
                        <div class="input-group">
                            <input class="form-control rm_laborat" type="text" id="tanggal-lahir" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="birthdate" required="required" value="0000-00-00">  
                            <br>
                            <div class="invalid-feedback">Silahkan isi tanggal lahir pasien</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nama Ayah</label>
                    <input class="form-control" type="text" name="nama_ayah" placeholder="Ketik nama ayah" value="-" id="nama_ayah">
                </div>
            </div>
        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nama Ibu</label>
                    <input class="form-control" type="text" name="nama_ibu" placeholder="Ketik nama ibu" value="-" id="nama_ibu">
                </div>
            </div>
        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nama Istri</label>
                    <input class="form-control" type="text" name="nama_istri" placeholder="Ketik nama istri" value="-" id="nama_istri">
                </div>
            </div>
        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nama Suami</label>
                    <input class="form-control" type="text" name="nama_suami" placeholder="Ketik nama suami" value="-" id="nama_suami">
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-sm-12">

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Alamat KTP</label>
                    <input class="form-control rm_laborat" type="text" name="address" placeholder="Ketik alamat sesuai kartu identitas" required="required"/>
                    <div class="invalid-feedback">Silahkan isi data alamat pasien</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Alamat Domisili</label>
                    <input class="form-control rm_laborat" type="text" name="address_domisili" placeholder="Ketik alamat domisili saat ini" required="required"/>
                    <div class="invalid-feedback">Silahkan isi data alamat domisili</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center rm_biasa"> 
            <div class="col-md-12 ">
                <div class="form-group row">
                    <label class="col-12" for="example-select2">Kota/Kabupaten</label>
                    <div class="col-lg-12">
                        <select class="js-select2 form-control" id="kotaSelect2" name="city" style="width: 100%;" data-placeholder="Pilih kota/kabupaten" required="required">

                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 kecamatanInvalid">
                <div class="form-group">
                    <label class="control-label">Kecamatan <i id="kecamatanLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <select name="district" class="form-control js-select2" style="width: 100%;" data-placeholder="Pilih Kecamatan" id="kecamatanSelect2" required="required">
                    </select>
                    <div class="invalid-feedback">Silahkan pilih kecamatan pasien </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 kelurahanInvalid">
                <div class="form-group">
                    <label class="control-label">Kelurahan <i id="kelurahanLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <select name="kelurahan" class="form-control js-select2" style="width: 100%;" data-placeholder="Pilih Kelurahan" id="kelurahanSelect2" required="required">
                    </select>
                    <div class="invalid-feedback">Silahkan pilih kelurahan pasien </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">No Telp</label>
                    <input class="form-control" type="number" name="phone" placeholder="HP/Nomor Rumah" required="required"/>
                    <div class="invalid-feedback">Silahkan isi data nomor telepon/HP pasien</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Pekerjaan</label>
                    <select name="occupation" id="selectPekerjaan" class="form-control" style="width: 100%;" data-size="2">
                        <option value="">Pilih pekerjaan</option>
                        @foreach($form['jenis_pekerjaan'] as $item)
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Silahkan pilih pekerjaan pasien </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Agama</label>
                    <select name="kelas" id="selectAgama" class="form-control js-select2" style="width: 100%;" data-size="2">
                        <option value="">Pilih Agama</option>
                        @foreach($form['agama'] as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Pendidikan</label>
                    <select name="kelas" id="selectPendidikan" class="form-control js-select2" style="width: 100%;" data-size="2">
                        <option value="">Pilih Pendidikan</option>
                        @foreach($form['pendidikan'] as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {{-- <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Bahasa</label>
                    <input type="text" name="bahasa" class="form-control" placeholder="Ketik bahasa" id="bahasa" required="">
                    <div class="invalid-feedback">Silahkan isi bahasa pasien</div>
                </div>
            </div>
        </div> --}}
        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Suku</label>
                    <input type="text" name="suku" class="form-control" placeholder="Ketik suku" id="suku" required="">
                    <div class="invalid-feedback">Silahkan isi suku pasien</div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center rm_biasa">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Alergi</label>
                    <input type="text" name="alergi" class="form-control" placeholder="Ketik alergi" id="alergi" required="">
                    <div class="invalid-feedback">Silahkan isi alergi</div>
                </div>
            </div>
        </div>

    </div>
    @if(config('app.is_military'))
    <div class="col-12 pt-20 rm_biasa">
        <label class="css-control css-control-primary css-checkbox">
            <input type="checkbox" class="css-control-input" id="anggota-trigger">
            <span class="css-control-indicator"></span> Pasien adalah Anggota
        </label>
    </div>
    @endif

</div>
@if(config('app.is_military'))
<hr>
<div class="row rm_biasa" id="formAnggota">
    <div class="col-lg-6 col-sm-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">NRP/NIP</label>
                    <input class="form-control enabledisable" type="text" name="nrp" id="tniNrp" placeholder="NRP / NIP Anggota" />
                    <div class="invalid-feedback">Silahkan isi data NRP/NIP keanggotaan pasien</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Keanggotaan</label>
                    <select name="kelas" id="selectKeanggotaan" class="form-control js-select2 enabledisable emptiable-dasar" style="width: 100%;" data-size="2" data-placeholder="Pilih Keanggotaan">
                        <option></option>
                        @foreach($form['tni_keanggotaan'] as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Pangkat <i id="pangkatLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <select name="kelas" id="selectPangkat" class="form-control js-select2 enabledisable emptiable-dasar" style="width: 100%;" data-size="2" data-placeholder="Pilih Pangkat">
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Singkat Pangkat</label>
                    <input class="form-control enabledisable emptiable-dasar" name="tni_pangkat_singkat" id="TNIsingkatPangkat" value="-">
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-sm-12">

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Kotama</label>
                    <select name="kelas" id="selectKotama" class="form-control js-select2 enabledisable emptiable-dasar" style="width: 100%;" data-size="2" data-placeholder="Pilih Kotama">
                        <option></option>
                        @foreach($form['tni_kotama'] as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Satker <i id="satkerLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <select name="kelas" id="selectSatker" class="form-control js-select2 enabledisable emptiable-dasar" style="width: 100%;" data-size="2" data-placeholder="Pilih Satker">
                        <option></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Korps</label>
                    <select name="kelas" id="selectKorps" class="form-control js-select2 enabledisable emptiable-dasar" style="width: 100%;" data-size="2" data-placeholder="Pilih Korps">
                        <option></option>
                        @foreach($form['tni_korps'] as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Jabatan</label>
                    <input class="form-control enabledisable emptiable-dasar" name="kelas" id="jabatanTNI" value="-">
                </div>
            </div>
        </div>

    </div>


</div>
@endif