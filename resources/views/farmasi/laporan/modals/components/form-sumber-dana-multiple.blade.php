<div class="form-group">
    <label for="sumber_dana">Pilih Sumber Dana</label>
    <select class="form-control js-select2" name="sumber_dana_ids[]" multiple placeholder="Pilih Sumber Dana" style="width: 100%;">
        @foreach($sumber_dana as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
        @endforeach
    </select>
    <small>Kosongkan untuk melakukan filter semua sumber dana</small>
</div>