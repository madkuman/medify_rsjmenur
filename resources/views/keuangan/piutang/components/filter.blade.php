
<div class="col-4">
    <label>Asal</label>
    <select class="js-select2 form-control" id="asal_dropdown" style="width: 100%;">
        <option value="all" selected>Semua</option>
        <option value="{{$rawat_inap}}">Rawat Inap</option>
        <option value="{{$rawat_jalan}}">Rawat Jalan</option>
    </select>
</div>
<div class="col-4">
    <label>Lokasi</label>
    <select class="js-select2 form-control" id="filter_lokasi" style="width: 100%;">
        <option value="all" selected>Semua</option>
    </select>
</div>
<div class="col-3">
    <label>Perusahaan</label>
    <select class="js-select2 form-control" multiple id="perusahaan_dropdown" name="perusahaan_id" style="width: 100%;">
        <option value="all" selected>Semua</option>
        @foreach($perusahaan as $item)
        <option value="{{$item->id}}">{{$item->nama}}</option>
        @endforeach
    </select>
</div>
<div class="col-3">
    <label>Tanggal</label>
    <select class="js-select2 form-control" id="kategori_date" name="kategori_date" style="width: 100%;">
        <option value="1" selected>All Date</option>
        <option value="2">By Date</option>
    </select>
</div>
<div class="col-2" id="by-date-start" style="display:none">
    <label for="example-datepicker1">Tanggal Start</label>
    <input type="text" class="js-datepicker form-control" id="tanggaltransaksi_start" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="" autocomplete="off">
</div>
<div class="col-2" id="by-date-end" style="display: none">
    <label>Tanggal End</label>
    <input type="text" class="js-datepicker form-control" id="tanggaltransaksi_end" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd MM yyyy" placeholder="Masukkan Tanggal" value="" autocomplete="off">

</div>