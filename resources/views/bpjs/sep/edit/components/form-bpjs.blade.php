<div class="form-group row">
    <label class="col-12">Jenis Rawat</label>
    <div class="col-12">
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input" type="radio" name="jenisRawat" id="jenisRawatJalan" value="2" disabled=""
            @if($sep->jenis_pelayanan == 2) checked="" @endif>
            <label class="custom-control-label" for="jenisRawatJalan">Rawat Jalan</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input" type="radio" name="jenisRawat" id="jenisRawatInap" value="1" disabled=""
            @if($sep->jenis_pelayanan == 1) checked="" @endif>
            <label class="custom-control-label" for="jenisRawatInap">Rawat Inap</label>
        </div>
    </div>
</div>
<div class="form-group" id="poliWrapper">
    <label>Poli</label>
    <select class="js-select2 form-control" name="poli" data-placeholder="Pilih Poli" id="poliSelect" @if($sep->jenis_pelayanan == 1) disabled=""  readonly="" @endif>
        <option value=""></option>
        @foreach($poli as $poliklinik)
        <option value="{{$poliklinik->bpjs_id}}" 
            @if(isset($sep->poli_tujuan) && $poliklinik->bpjs_id == $sep->poli_tujuan)
            selected="" 
            @endif>
            {{$poliklinik->name}}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Kelas</label>
    <select class="js-select2 form-control" name="kelas" data-placeholder="Pilih Kelas" id="kelasSelect">
        <option value=""></option>
        <option value="1" @if($sep->kelas_rawat == 1) selected="" @endif>Kelas I</option>
        <option value="2" @if($sep->kelas_rawat == 2) selected="" @endif>Kelas II</option>
        <option value="3" @if($sep->kelas_rawat == 3) selected="" @endif>Kelas III</option>
    </select>
</div>

<div class="form-group">
    <label>DPJP</label>
    <select class="js-select2 form-control" name="dpjp" data-placeholder="Pilih DPJP" id="dpjpSelect" readonly="" disabled="">
        <option value="{{$sep->user_dpjp->dokter->bpjs_kode_dpjp ?? '-'}}" selected="">{{$sep->user_dpjp->name ?? '-'}}</option>
    </select>
</div>

<div class="form-group">
    <label>Tanggal SEP</label>
    @php($tgl_sep = implode('-', array_reverse(explode('-', $sep->tgl_sep))))
    <input type="text" class="js-datepicker form-control js-datepicker-enabled" id="tanggal_sep" name="tanggal_sep" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" placeholder="dd-mm-yyyy" value="{{$tgl_sep}}">
</div>

<div class="form-group">
    <label>Diagnosis Awal</label>
    <select class="js-select2 form-control" name="diagnosis" data-placeholder="Pilih Diagnosis" id="diagnosisSelect">
        <option value="{{$sep->diagnosis->code_icd ?? ''}}">{{$sep->diagnosis->code_icd  ?? ''}}
        {{$sep->diagnosis->long_desc ?? ''}}</option>
    </select>
</div>

<div class="form-group">
    <label>Catatan</label>
    <input type="text" class="form-control" id="bpjs_catatan" name="bpjs_catatan" placeholder="Catatan" value="{{$sep->catatan}}">
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="is_eksekutif" @if($sep->poli_eksekutif == 1) checked="" @endif>
                <span class="css-control-indicator"></span> Pelayanan Eksekutif
            </label>
        </div>
    </div>
    <div class="col-6">  
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="cob" @if($sep->cob == 1) checked="" @endif>
                <span class="css-control-indicator"></span> COB
            </label>
        </div>  
    </div>
    <div class="col-6"> 
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="katarak" @if($sep->katarak == 1) checked="" @endif>
                <span class="css-control-indicator"></span> Katarak
            </label>
        </div>   
    </div>
    <div class="col-6">   
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox"  id="laka_wrap">
                <input type="checkbox" class="css-control-input" id="laka" name="laka" @if($sep->jaminan_lakalantas == 1) checked="" @endif>
                <span class="css-control-indicator"></span> Jaminan Laka
            </label>
        </div> 
    </div>
</div>