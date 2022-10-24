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
<div class="form-group">
    <label>Nomor SKDP</label>
    <div class="input-group skdp-sep">
        <select class="form-control js-select2-multiple" name="skdp_sep" id="skdp_sep">
            <option value="">-</option>
        </select>
    </div>
</div>
<div class="form-group hide">
    <label>Nomor Rujukan</label>
    <input type="text" class="form-control no-rujukan" >
</div>

<div class="form-group" id="poliWrapper">
    <label>Poli</label>
    <select class="js-select2 form-control" name="poli" data-placeholder="Pilih Poli" id="poliSelect" style="width: 100%;">
        <option value=""></option>
    </select>
</div>

<div class="form-group">
    <label>Tanggal Rujukan</label>
    <input type="text" class="js-datepicker form-control tanggal-rujukan"  data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" placeholder="dd-mm-yyyy">
</div>

<div class="form-group">
    <label>Faskes Rujukan</label>
    <input type="text" class="form-control faskes-rujukan" >
</div>
<div class="form-group">
    <label>Hak Kelas</label>
    <input type="text" class="hak-kelas form-control" readonly>
</div>
<div class="form-group">
    <label>Naik Kelas</label>
    <select class="js-select2 form-control" name="kelas" data-placeholder="Pilih Kelas" id="kelasSelect" style="width: 100%;">
        @foreach (config('const.kelas_rawat_naik') as $key => $item)
            @php
                $selected = '';
                if($item == 3)
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
    <label>Flag Prosedur*</label>
    <select class="js-select2 form-control" name="flag_procedure" style="width: 100%;">
        <option value=""> Tanpa Flag Procedure </option>
        @foreach (config('const.flag_procedure') as $key=> $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Kode Penunjang*</label>
    <select class="js-select2 form-control" name="kode_penunjang" style="width: 100%;">
        <option value=""> Tanpa Kode Penunjang </option>
        @foreach (config('const.kode_penunjang') as $key=> $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Asesmen Pelayanan*</label>
    <select class="js-select2 form-control" name="asesment_pelayanan" style="width: 100%;">
        <option value="">Tanpa Asesment Pelayanan</option>
        @foreach (config('const.asesment_pelayanan') as $key=> $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
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
    <div class="col-lg-4 col-12">
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="is_eksekutif">
                <span class="css-control-indicator"></span> Pelayanan Eksekutif
            </label>
        </div>
    </div>
    <div class="col-lg-4 col-12">  
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="cob">
                <span class="css-control-indicator"></span> COB
            </label>
        </div>  
    </div>
    <div class="col-lg-4 col-12"> 
        <div class="form-group">
            <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input" id="katarak">
                <span class="css-control-indicator"></span> Katarak
            </label>
        </div>   
    </div>
    <div class="col-lg-12 col-12">   
        <div class="form-group">
            <label>Jaminan Laka </label>
            <select class="form-control" name="laka" id="laka">
                @foreach (config('const.laka_lantas') as $key => $item)
                    <option value="{{$key}}"> {{ $item }} </option>
                @endforeach
            </select>
        </div> 
    </div>
</div>

@push('js')
    <script>
        $(document).on('change', '#kelasSelect', function(){
           
            // console.log($(this).prop('checked'))
            var kelas_hak = $('#preview_pasien_kelas_bpjs').text();
            var text_string = $(this).select2('data')[0]['text'];
            kelas_hak = parseInt(kelas_hak)
            var text = parseInt(text_string)
            console.log(kelas_hak, text, text_string, )
            if(kelas_hak > text || $.inArray(text_string, ["VIP","VVIP"]) != -1){
                // console.log('naik')
                $('[name="pembiayaan"]').prop('disabled', false)
                // $('[name="penanggung_jawab"]').prop('readonly', false)
                // $('[name="penanggung_jawab"]').val()
            }else{
                console.log($('[name="pembiayaan"]').select2('data')[0].text)
                $('[name="pembiayaan"]').val('1').trigger('change');
                $('[name="pembiayaan"]').prop('disabled', true)
                // $('[name="penanggung_jawab"]').prop('readonly', true)
            }
            $('[name="penanggung_jawab"]').val($('[name="pembiayaan"]').select2('data')[0].text);
            
        })

        $(document).on('change', '[name="pembiayaan"]', function(){
            var text_vall = $(this).select2('data')[0].text
            // console.log(vall)
            // if(vall == 1){
                $('[name="penanggung_jawab"]').val(text_vall)
            // }
        })

        $(document).on('change', '[name="tujuan_kunjungan"]', function(){
            var vall = $(this).val()
            // console.log(vall)
            if(vall != 0){
                // $('[name="kode_penunjang"]').prop('disabled', false)
                // $('[name="flag_procedure"]').prop('disabled', false)
            }else{
                // $('[name="kode_penunjang"]').prop('disabled', true)
                // $('[name="flag_procedure"]').prop('disabled', true)
                $('[name="kode_penunjang"]').val('').trigger('change')
                $('[name="flag_procedure"]').val('').trigger('change')
                
            }
            
            if(vall == 2 || vall == 0){
                // $('[name="asesment_pelayanan"]').prop('disabled', false)
            }else{
                $('[name="asesment_pelayanan"]').val('').trigger('change')
                // $('[name="asesment_pelayanan"]').prop('disabled', true)
            }
        })
        $(`[name="tujuan_kunjungan"]`).trigger('change')
    </script>
@endpush