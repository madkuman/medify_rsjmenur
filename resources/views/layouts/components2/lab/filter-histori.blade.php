<div class="row">
    <div class="col-lg-4 col-12 mb-20">
        {{Form::label('nama_pasien', 'Nama Pasien')}}
        <input type="text" name="nama_pasien" id="namaPasien" placeholder="Nama Pasien" class="form-control">
    </div>
    <div class="col-lg-2 col-12 mb-20">
        {{Form::label('rm_pasien', 'Nomor RM')}}
        <input type="numeric" name="rm_pasien" id="rmPasien" placeholder="Nomor RM Pasien" class="form-control">
    </div>
    <div class="col-lg-2 col-12 mb-20">
        {{ Form::label('jenisPasien', 'Jenis Pasien')}}
        <select class="js-select2 form-control requireForm" id="jenisPasien" name="jenis_pasien" style="width: 100%;" data-placeholder="Choose one..">
            <option value="none">Semua</option>
            @foreach($pembayaran as $row)
                <option value="{{$row->id}}">{{$row->nama}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-2 col-12 mb-20">
        <label for="example-select2">Asal Layanan</label>
        <select class="js-select2 form-control" id="asalRuang" name="asal_ruang" style="width: 100%;" required="required">
            <option value="" selected="">Semua</option>
            <option value="none">Tanpa Kasus</option>
            <option value="1">IGD</option>
            <option value="2">Rawat Jalan</option>
            <option value="3">Rawat Inap</option>
        </select>
    </div>
    <div class="col-lg-2 col-12 mb-20">
        {{ Form::label('status', 'Status')}}
        <select class="js-select2 form-control requireForm" id="status" name="status" style="width: 100%;">
            <option value="">Semua</option>
            <option value="batal">Batal</option>
            <option value="belum_verifikasi">Belum Verifikasi</option>
            <option value="sudah_verifikasi">Terverifikasi</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-12 mb-20">
        <label>Jenis Layanan</label>
        <select class="js-example-basic-multiple form-control js-select2" id="jenisPemeriksaan" name="pemeriksaan[]" multiple="multiple" data-placeholder="Pilih Layanan" style="width: 100%;">
            @foreach($pemeriksaan as $item)
                <option value="{{$item->id}}">{{$item->deskripsi}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4 col-12 mb-20">
        {{ Form::label('tanggal', 'Pilih Tanggal')}}
        <div class="input-daterange input-group" data-date-format="yyyy-mm-dd" data-week-start="1" data-autoclose="true" data-today-highlight="true">
            <input type="text" class="form-control" id="tanggalMulai" name="example-daterange1" placeholder="From" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true">
            <div class="input-group-prepend input-group-append">
                <span class="input-group-text font-w600">to</span>
            </div>
            <input type="text" class="form-control" id="tanggalAkhir" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true">
        </div>    
    </div>
    @if($link == "radiologi")
        <div class="col-lg-2 col-12 mb-20">
            {{ Form::label('cito', 'Jenis Transaksi')}}
            <select class="js-select2 form-control" id="tipeTransaksi" name="cito" style="width: 100%;">
                <option value="" selected="">Semua</option>            
                @foreach($tipe as $t)
                <option value="{{$t->id}}">{{$t->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-12 mb-20">
            {{ Form::label('tarif', 'Kategori Layanan')}}
            <select class="js-select2 form-control" id="jenisLayanan" name="cito" style="width: 100%;">
                <option value="" selected="">Semua</option>            
                <option value="mri">MRI</option>
                <option value="ct scan">CT Scan</option>
                <option value="usg">USG</option>
                <option value="konvensional">Konvensional</option>
            </select>
        </div>
    @else
        <div class="col-lg-4 col-12 mb-20">
            {{ Form::label('cito', 'Jenis Transaksi')}}
            <select class="js-select2 form-control" id="tipeTransaksi" name="cito" style="width: 100%;">
                <option value="" selected="">Semua</option>            
                @foreach($tipe as $t)
                <option value="{{$t->id}}">{{$t->nama}}</option>
                @endforeach
            </select>
        </div>    
    @endif
</div>
<div class="row gutters-tiny">
    <div class="col-10 full-only"></div>
    <div class="col">
        <div class="form-group">
            <button class="btn btn-secondary fileDownload" type="button" id="downloadBtn" style="width: 100%; margin-top: 20px;">Download
            </button>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <button class="btn btn-primary" type="button" id="searchBtn" style="width: 100%; margin-top: 20px;">Cari
            </button>
        </div>
    </div>
</div>