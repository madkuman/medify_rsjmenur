
<div id="form_laka" @if($sep->jaminan_lakalantas != 1) style="display: none;" @endif>
    <hr>
    <h5>Data Kecelakaan Laka</h5>
    <div class="form-group">
        <label class="css-control css-control-primary css-checkbox"  id="suplesi_wrap">
            <input type="checkbox" class="css-control-input" id="suplesi" @if($sep->suplesi == 1) checked="" @endif>
            <span class="css-control-indicator"></span> Suplesi
        </label>
    </div> 
    <div class="form-group" id="sep_suplesi_wrap">
        <label>Nomor SEP Suplesi</label>
        <input type="text" class="suplesi form-control" id="sep_suplesi" name="sep_suplesi" placeholder="Nomor SEP Suplesi"
        @if($sep->suplesi == 1)
        value="{{$sep->no_suplesi}}"
        @else
        readonly="" disabled=""
        @endif
        >
    </div>
    <div class="form-group">
        <label>Pihak Penjamin</label>
        <select class="laka form-control js-select2" name="penjamin_laka" multiple="multiple" id="penjamin_laka" style="width: 100%;" data-placeholder="Pihak Penjamin">
            @php($penjamin = explode(',', $sep->penjamin_laka))
            <option value=""></option>
            <option value="1" @if(in_array(1, $penjamin)) selected="" @endif>PT Jasa Raharja</option>
            <option value="2" @if(in_array(2, $penjamin)) selected="" @endif>BPJS Ketenagakerjaan</option>
            <option value="3" @if(in_array(3, $penjamin)) selected="" @endif>PT Taspen</option>
            <option value="4" @if(in_array(4, $penjamin)) selected="" @endif>PT ASABRI</option>
        </select>
    </div>
    <div class="form-group">
        @php($tgl_laka = implode('-', array_reverse(explode('-', $sep->tgl_kejadian))))
        <label for="tanggal_laka">Tanggal Kejadian Laka</label>
        <input type="text" class="laka js-datepicker form-control js-datepicker-enabled" id="tanggal_laka" name="tanggal_laka" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="dd-mm-yyyy" value="{{$tgl_laka}}">
    </div>
    <div class="form-group">
        <label>Provinsi Kejadian Laka</label>
        <select class="laka form-control js-select2" name="provinsi_laka" id="provinsi_laka" style="width:100%;" data-placeholder="Provinsi Laka">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group">
        <label>Kabupaten/Kota Kejadian Laka</label>
        <select class="laka form-control js-select2" name="kota_laka" id="kota_laka" style="width:100%;" data-placeholder="Kabupaten/Kota Laka">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group">
        <label>Kecamatan Kejadian Laka</label>
        <select class="laka form-control js-select2" name="kecamatan_laka" id="kecamatan_laka" style="width: 100%;" data-placeholder="Kecamatan Laka">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group">
        <label>Keterangan Kecelakaan</label>
        <input type="text" class="suplesi form-control" id="keterangan_laka" name="keterangan_laka" placeholder="Keterangan Kecelakaan" 
        @if($sep->keterangan_penjamin != null || $sep->keterangan_penjamin != 0)
        value="{{$sep->keterangan_penjamin }}"
        @endif
        >
    </div>
</div>