<div class="form-group row">
    <label class="col-5">Asal Rujukan</label>
    <label class="col-7">Jenis Rawat</label>
    <div class="col-5">
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input" type="radio" name="asalRujukan" id="asalRujukanFktp" value="1" checked="">
            <label class="custom-control-label" for="asalRujukanFktp">FKTP</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input" type="radio" name="asalRujukan" id="asalRujukanRS" value="2">
            <label class="custom-control-label" for="asalRujukanRS">RS</label>
        </div>
    </div>
    <div class="col-7">
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input" type="radio" name="jenisRawat" id="jenisRawatJalan" value="2" checked="">
            <label class="custom-control-label" for="jenisRawatJalan">Rawat Jalan</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input" type="radio" name="jenisRawat" id="jenisRawatInap" value="1">
            <label class="custom-control-label" for="jenisRawatInap">Rawat Inap</label>
        </div>
    </div>
</div>
<div class="form-group" id="poliWrapper">
    <label>Poli</label>
    <select class="js-select2 form-control" name="poli" data-placeholder="Pilih Poli" id="poliSelect" style="width: 100%;">
        <option value=""></option>
    </select>
</div>

<div class="form-group">
    <label>Kelas</label>
    <select class="js-select2 form-control" name="kelas" data-placeholder="Pilih Kelas" id="kelasSelect" style="width: 100%;">
        <option value=""></option>
        <option value="1">Kelas I</option>
        <option value="2">Kelas II</option>
        <option value="3">Kelas III</option>
    </select>
</div>
<div class="form-group">
    <label>
        DPJP 
        <i class="fa fa-asterisk fa-spin text-info" id="poli-loading" style="display: none;"></i>
    </label>
    @if(!isset($sep_same_rujuk))
    <select class="js-select2 form-control" name="dpjp" data-placeholder="Pilih DPJP" id="dpjpSelect" style="width: 100%;">
        <option value=""></option>
        @foreach($dpjp as $item)
        <option value="{{$item->bpjs_kode_dpjp}}">{{$item->name}}</option>
        @endforeach
    </select>
    @else
    <select class="js-select2 form-control" name="dpjp" data-placeholder="Pilih DPJP" id="dpjpSelect" readonly="" disabled="" style="width: 100%;">
        <option value="{{$sep->user_dpjp->bpjs_kode_dpjp}}" selected="">{{$sep->user_dpjp->name}}</option>
    </select>
    @endif
</div>

<div class="form-group">
    <label>Nomor SKDP</label>
    <div class="input-group">
        <input type="text" class="form-control" id="skdp_sep" name="skdp_sep" autocomplete="off" required="" placeholder="Nomor SKDP">
        <div class="input-group-append">
            <button type="button" class="btn btn-secondary" id="rand_skdp"><i class="fa fa-random"></i></button>
        </div>
    </div>
</div>

<div class="form-group">
    <label>Tanggal SEP</label>
    <input type="text" class="js-datepicker form-control" id="tanggal_sep" name="tanggal_sep" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" placeholder="dd-mm-yyyy">
</div>

<div class="form-group">
    <label>
        Diagnosis Awal
        <i class="fa fa-asterisk fa-spin text-info" id="diagnosis-loading" style="display: none;"></i>
    </label>
    <select class="js-select2 form-control" name="diagnosis" data-placeholder="Pilih Diagnosis" id="diagnosisSelect" style="width: 100%;">
        <option value=""></option>
    </select>
</div>

<div class="form-group">
    <label>Catatan</label>
    <input type="text" class="form-control" id="bpjs_catatan" name="bpjs_catatan" placeholder="Catatan">
</div>
<div class="row">
    <div class="col-lg-6 col-12">
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="is_eksekutif">
                <span class="css-control-indicator"></span> Pelayanan Eksekutif
            </label>
        </div>
    </div>
    <div class="col-lg-6 col-12">  
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="cob">
                <span class="css-control-indicator"></span> COB
            </label>
        </div>  
    </div>
    <div class="col-lg-6 col-12"> 
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="katarak">
                <span class="css-control-indicator"></span> Katarak
            </label>
        </div>   
    </div>
    <div class="col-lg-6 col-12">   
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox"  id="laka_wrap">
                <input type="checkbox" class="css-control-input" id="laka" name="laka">
                <span class="css-control-indicator"></span> Jaminan Laka
            </label>
        </div> 
    </div>
</div>