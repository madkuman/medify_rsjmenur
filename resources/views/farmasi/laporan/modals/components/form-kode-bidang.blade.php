<div class="form-group">
    <label for="penyedia">Pilih Kode Bidang</label>
    <select class="form-control js-select2" name="kode_bidang_id[]" placeholder="Pilih" style="width: 100%;" multiple>
        @foreach($master_kode_bidang as $item)
            <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
        @endforeach
    </select>
    <small>Kosongkan untuk semua kode</small>
</div>