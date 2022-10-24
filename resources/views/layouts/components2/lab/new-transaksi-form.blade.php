{{ Form::open(['url' => $link.'/transaksi/new', 'method' => 'POST', 'id' => 'permintaanForm'])}}
<div class="form-group">
    {{ Form::label('pasien', 'Nama Pasien')}}
    <select class="form-control" id="pasien" name="pasien" style="width: 100%;" data-placeholder="Choose one..">
    </select>
    <p class="text-danger teksWarning" id="pasienWarn" style="display: none; margin-bottom: 8px;"></p>
</div>
@if($link == 'radiologi')
<div class="form-group">
    <label>Lokasi</label>
    <select class="js-select2 form-control requireForm" name="poliklinik" style="width: 100%;" required>
        <option value="">Pilih lokasi</option>
        @foreach($poli as $p)
        <option value="{{$p->id}}">{{$p->nama}}</option>
        @endforeach
    </select>
</div>        
@endif
<div class="form-group">
    {{ Form::label('tipe_layanan', 'Jenis Layanan')}}                                        
    <br>
    @foreach($tipe as $t)
    <label class="css-control css-control-primary css-radio">
        <input type="radio" class="css-control-input tipe-layanan" name="tipe_layanan" onchange="changeForm()" value="{{$t->id}}">
        <span class="css-control-indicator"></span>{{$t->nama}}
    </label>
    @endforeach
    <span class="text-danger hide">Anda harus mengisi input ini</span>
</div>
<div class="form-group">
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" type="checkbox" name="tanpa_kasus" id="tanpa-kasus">
        <label class="custom-control-label" for="tanpa-kasus">Tanpa Kasus</label>
    </div>
</div>
<div id="rs-dokter" style="display: none;" class="row">
    <div class="form-group col-4">
        <label>Rumah Sakit</label>
        <input type="text" name="nama_rs" class="form-control">
    </div>     
    <div class="form-group col-4">
        <label>Dokter</label>
        <select class="form-control" id="select_dokter" style="width: 100%;" name="nama_dokter">
            @foreach($dokter as $d)
            <option value="{{$d->name}}" @if($user->id==$d->id) selected @endif>{{$d->name}}</option>
            @endforeach
        </select>
        <small>Ketikkan atau cari nama dokter</small>
    </div>
    @if($link == 'labpk')
        <div class="form-group col-4">
            <label>Dokter Perujuk</label>
            <input type="text" name="dokter_perujuk" class="form-control">
        </div>
    @endif
</div>
<hr><br>
<input type="hidden" id="tujuanPermintaan" data-dept="{{$departemen}}" value="1">
<div class="row">
    <div class="col-8" id="asal-kasus">
        <div class="form-group">
            {{ Form::label('asal_ruang', 'Asal Kasus')}}
            <select class="js-select2 form-control" name="kasus_id" id="kasus_dropdown" style="width: 100%;" data-placeholder="Choose one..">
                <option value="">Pilih Asal Kasus</option>
            </select>
            <p class="text-danger teksWarning" id="kasusWarn" style="display: none; margin-bottom: 8px;"></p>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group ">
            <label>Kelas Transaksi</label>
            <select class="form-control" style="width: 100%;" name="kelas_pasien" id="kelasInput">
                @foreach($kelas as $k)
                <option value="{{$k->id}}">{{$k->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-4">
        {{ Form::label('sep_num', 'Nomor Kartu BPJS')}}
        <input type="text" class="form-control" name="no_bpjs" id="no_bpjs">
    </div>
    <div class="form-group col-lg-4" id="input-pasien-pembayaran-container">
        <label>Jenis Pembayaran</label>
        <select class="js-select2 form-control" id="pasien-pembayaran" 
        name="pasien_pembayaran_id" style="width: 100%;" data-placeholder="Pilih Jenis Pembayaran"></select>
        <p class="text-danger teksWarning" id="pembayaranWarn" style="display: none; margin-bottom: 8px;"></p>
    </div>
    <div class="form-group col-lg-4">
        {{ Form::label('tanggal_periksa', 'Tanggal Rencana Pemeriksaan')}}
        <input autocomplete="off" type="text" class="js-datepicker form-control" id="example-datepicker3" name="tanggal_periksa" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="dd-mm-yyyy">
    </div>
</div>
<div class="form-group" style="padding-bottom: 10px;">
    <label class="control-label">Klinis</label>
    <textarea class="form-control" rows="4" name="keterangan" placeholder="Tulis Klinis disini..."></textarea>
</div>
<div class="form-group" style="padding-bottom: 10px;">
    <label class="control-label">Keterangan Permintaan</label>
    <textarea class="form-control" rows="4" name="keterangan_permintaan" placeholder="Tulis Keterangan tambahan disini..."></textarea>
</div>
<div class="form-group" id="tujuan-bayar">
    {{ Form::label('tipe_layanan', 'Tujuan Pembayaran')}}
    <br>
    <label class="css-control css-control-primary css-radio">
        <input type="radio" class="css-control-input" name="kirim_kasir" value="0" required="">
        <span class="css-control-indicator"></span>Tagihan Kasus
    </label>
    <label class="css-control css-control-primary css-radio">
        <input type="radio" class="css-control-input" name="kirim_kasir" value="1" required="">
        <span class="css-control-indicator"></span>Kasir
    </label>
</div>

<hr>
<div class="row">
    <div class="col-5"></div>
    <div class="col-2">
        <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style="display: none;"></span>
    </div>
    <div class="col-5"></div>
</div>
<div class="form-group mb-0">
    @include('kasus.penunjang.content.permintaan.layanan-lab')
    @include('labpk.transaksi.form-mikrobiologi')
</div>
<p class="text-danger teksWarning" id="layananWarn" style="display: none; margin-bottom: 8px;"></p>
<div class="form-group mb-0" style="text-align: right">
    <button type="button" class="btn btn-hero btn-primary btn-noborder"
    id="submitBuatPermintaanBtn" onclick="validate();">
    <i class="fa fa-check"></i> Simpan</button>
</div>
{{Form::close()}}