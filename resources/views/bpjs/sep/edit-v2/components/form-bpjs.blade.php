@php
    $kelas = $sep->kelas_rawat;
    $kelas = explode(' ', $kelas);
    $kelas = end($kelas);
@endphp
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
    <input type="hidden" name="jenisRawat" value="{{$sep->jenis_pelayanan}}">
</div>
<div class="form-group" id="poliWrapper">
    <label>Poli</label>
    <select class="js-select2 form-control" name="poli" data-placeholder="Pilih Poli" id="poliSelect" style="width: 100%;" @if($sep->jenis_pelayanan == 1) disabled=""  readonly="" @endif>
        <option value="{{$sep->poli_tujuan}}">{{ $sep->poli_tujuan_nama }}</option>
    </select>
</div>

<div class="form-group">
    <label>Kelas</label>
    <input type="text" class="form-control" readonly value="{{$sep->kelas_rawat}}">
    <input type="hidden" class="form-control" readonly name="kelas_hak" value="{{$sep->kelas_rawat}}">
</div>
<div class="form-group">
    <label>Naik Kelas</label>
    <select class="js-select2 form-control" name="kelas" data-placeholder="Pilih Kelas" id="kelasSelect" style="width: 100%;">
        @foreach (config('const.kelas_rawat_naik') as $key => $item)
            @php
                $selected = '';
                if($item == $kelas)
                    $selected = 'selected';
            @endphp
            <option value="{{ $key }}" {{ $selected }} >{{$item}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Pembiayaan*</label>
    <select class="js-select2 form-control" name="pembiayaan" style="width: 100%;" disabled="">
        @foreach (config('const.pembiayaan') as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Penanggung Jawab*</label>
    <input type="text" class="form-control" name="penanggung_jawab" readonly>
</div>
<div class="form-group">
    <label>Tujuan Kunjungan*</label>
    <select class="js-select2 form-control" name="tujuan_kunjungan" style="width: 100%;">
        @foreach (config('const.tujuan_kunjungan') as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>DPJP</label>
    <select class="js-select2 form-control" name="dpjp" data-placeholder="Pilih DPJP" id="dpjpSelect" readonly="" disabled="">
        <option value="{{$sep->user_dpjp->bpjs_kode_dpjp ?? '-'}}" selected="">{{$sep->user_dpjp->name ?? '-'}}</option>
    </select>
</div>

<div class="form-group">
    <label>Tanggal SEP</label>
    @php
        ($tgl_sep = implode('-', array_reverse(explode('-', $sep->tgl_sep))))
    @endphp
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
    <div class="col-4">
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="is_eksekutif" @if($sep->poli_eksekutif == 1) checked="" @endif>
                <span class="css-control-indicator"></span> Pelayanan Eksekutif
            </label>
        </div>
    </div>
    <div class="col-4">  
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="cob" @if($sep->cob == 1) checked="" @endif>
                <span class="css-control-indicator"></span> COB
            </label>
        </div>  
    </div>
    <div class="col-4"> 
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="katarak" @if($sep->katarak == 1) checked="" @endif>
                <span class="css-control-indicator"></span> Katarak
            </label>
        </div>   
    </div>
    <div class="col-lg-12 col-12">   
        <div class="form-group">
            <label>Jaminan Laka </label>
            <select class="form-control" name="laka" id="laka">
                @foreach (config('const.laka_lantas') as $key => $item)
                    @php
                        $selected = '';
                        if($sep->jaminan_lakalantas == $key)
                            $selected = 'selected';
                    @endphp
                    <option value="{{$key}}" {{ $selected }} > {{ $item }} </option>
                @endforeach
            </select>
        </div> 
    </div>
</div>

@push('js')
    <script>
         $(document).on('change', '#kelasSelect', function(){
           
            // console.log($(this).prop('checked'))
            var kelas_hak = `{{$kelas}}`
            var text_string = $(this).select2('data')[0]['text'];
            kelas_hak = parseInt(kelas_hak)
            var text = parseInt(text_string)
            console.log(kelas_hak, text, text_string, )
            if(kelas_hak > text || $.inArray(text_string, ["VIP","VVIP"]) != -1){
                // console.log('naik')
                $('[name="pembiayaan"]').prop('disabled', false)
                $('[name="penanggung_jawab"]').val($('[name="pembiayaan"]').select2('data')[0].text);
            }else{
                console.log($('[name="pembiayaan"]').select2('data')[0].text)
                $('[name="pembiayaan"]').val('1').trigger('change');
                $('[name="pembiayaan"]').prop('disabled', true)
            }  
            $('[name="penanggung_jawab"]').val($('[name="pembiayaan"]').select2('data')[0].text);
        })

        $(document).on('change', '[name="pembiayaan"]', function(){
            // console.log($(this).select2('data'))
            var text_vall = $(this).select2('data')[0].text
            // console.log(vall)
            // if(vall == 1){
                $('[name="penanggung_jawab"]').val(text_vall)
            // }
        })
    </script>
@endpush