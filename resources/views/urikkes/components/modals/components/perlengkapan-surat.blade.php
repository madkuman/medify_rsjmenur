<div class="form-group row">
    <div class="col-8">
        <label>Judul Surat</label>
        <input class="col-12 form-control form-control-lg" type="text" value="Lampiran Surat {{config('app.name')}}" name="judul" requried>
    </div>
</div>
<div class="form-group row">
    <div class="col-8">
        <label>Nomor Surat</label>
        <textarea rows="1" style="resize: none" class="col-12 form-control" name="no_surat" required>R/     /{{$bulan_romawi}}/{{$tahun}}</textarea>
    </div>
</div>
<div class="form-group row">
    <div class="col-8">
        <label>Tanggal Laporan</label>
        <textarea rows="1" style="resize: none" class="col-12 form-control" id="tanggal" name="tanggal" placeholder="Tanggal Laporan" value="">&nbsp;     {{$today}}</textarea>
    </div>
</div>