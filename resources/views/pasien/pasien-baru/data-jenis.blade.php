<h5 class="uppercase">Jenis Pasien
    <hr>
</h5>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Jenis Pasien</label>

                    @foreach($form['jenis_pasien'] as $item)
                    <div class="custom-control custom-radio mb-5" id="jenis_pembayaran_{{$item->slug}}">
                        <input class="custom-control-input" type="radio" name="jenispasien" 
                        id="type-{{$item->id}}" value="{{$item->id}}" 
                        onchange="changeJenis('{{$item->id}}&&{{$item->slug}}')" @if($item->id == 1) checked @endif>
                        <label class="custom-control-label"  for="type-{{$item->id}}">{{$item->nama}}</label>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="mobile-block col-sm-12 mb-20"></div>
    <div class="col-lg-6 col-sm-12">
        @php $show = 0 @endphp
        @foreach($form['jenis_pasien'] as $item_tipe)
        <div class="row justify-content-center perusahaan-select-container perusahaan-select-{{$item_tipe->id}}-container {{$show}}" @if($show == 1) style="display: none" @endif>
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Asuransi</label>
                    <select name="asuransi" class="form-control js-select2" data-size="5" id="perusahaan-select-{{$item_tipe->id}}" style="width: 100%:" onchange="pembayaranCheck()">
                        @foreach($form['perusahaan'] as $item)
                        @if($item->type == $item_tipe->id)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endif
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
        @if($show == 0) @php $show = 1 @endphp @endif
        @endforeach

        <div class="row justify-content-center nomor-asuransi">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nomor Asuransi <i id="pembayaranLoading" class="fa fa-asterisk fa-spin text-info"></i></label>
                    <input class="form-control mb-5" type="text" id="asuransiNomor" name="nomorasuransi" placeholder="Nomor" autofocus="true" />
                    <div id="textAutoInputBPJS"></div>
                    <div id="textCekNomorAsuransi"></div>
                    <a href="javascript:void(0)" id="notifExistAutoInputBPJS" data-toggle="modal" data-target="#modal-autoinput-pasien" style="display: none">Klik Disini! Kami menemukan data pasien yang sesuai dengan nomor BPJS</a>
                    <label class="notif-bpjs badge badge-danger" style="white-space: break-spaces;"></label>
                    <div class="invalid-feedback">Silahkan isi nomor asuransi pasien</div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Kelas Perawatan</label>
                    <select name="kelas" id="selectKelas" class="form-control js-select2" data-size="2">
                        @foreach($form['kelas'] as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Silahkan isi kelas pasien</div>
                </div>
            </div>
        </div>
    </div>
</div>

<h5 class="uppercase">Kategori Pasien
    <hr>
</h5>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Kategori Pasien</label>
                    <div class="custom-control custom-radio mb-5">
                        <input class="custom-control-input" type="radio" name="kategori_pasien" value="0" id="jiwa">
                        <label class="custom-control-label" for="jiwa">Jiwa</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input class="custom-control-input" type="radio" name="kategori_pasien" value="5" id="fisik">
                        <label class="custom-control-label" for="fisik">Fisik</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>