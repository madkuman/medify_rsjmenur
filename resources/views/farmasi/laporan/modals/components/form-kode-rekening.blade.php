<div class="form-group">
    <label for="penyedia">Pilih Kode Rekening</label>
    <select class="form-control js-select2" name="kode_rekening_id[]" placeholder="Pilih" style="width: 100%;" multiple>
        <option value="0">Semua</option>
        @foreach($master_kode_rekening as $item)
            <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
        @endforeach
    </select>
    <small>Kosongkan untuk semua kode</small>
</div>