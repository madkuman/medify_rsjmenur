<div class="form-group">
    <label for="penyedia">Pilih Bangsal</label>
    <select class="form-control js-select2" name="waktu_makan_id" placeholder="Pilih Waktu Makan" style="width: 100%;" required>
        @foreach($waktu_makan as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
        @endforeach
    </select>
</div>