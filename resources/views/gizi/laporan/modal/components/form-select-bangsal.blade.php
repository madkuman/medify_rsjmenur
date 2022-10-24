<div class="form-group">
    <label for="penyedia">Pilih Bangsal</label>
    <select class="form-control js-select2" name="bangsal_id" placeholder="Pilih Bangsal" style="width: 100%;" required>
        @foreach($bangsal as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
        @endforeach
    </select>
</div>