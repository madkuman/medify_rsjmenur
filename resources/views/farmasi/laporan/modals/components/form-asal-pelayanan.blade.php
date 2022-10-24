
<div class="form-group">
    <label for="penyedia">Pilih Asal Pelayanan</label>
    <select class="form-control js-select2" id="lokasi_id" name="lokasi_id" placeholder="Pilih Pelayanan" style="width: 100%;">
        <option value="all">Semua</option>
        <option value="all-rj">Semua Rawat Jalan</option>
        <option value="all-ri">Semua Rawat Inap</option>
        <option value="all-igd">Semua IGD</option>
        @foreach($lokasi_beauty as $lokasi)
        <option value="{{$lokasi->id}}">{{$lokasi->nama}}</option>
        @endforeach
    </select>
</div>