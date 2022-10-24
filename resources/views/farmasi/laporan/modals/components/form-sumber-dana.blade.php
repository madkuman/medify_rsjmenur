<div class="form-group">
    <label for="penyedia">Pilih Sumber Dana</label>
    <select class="form-control js-select2" name="sumber_dana_id" placeholder="Pilih Sumber Dana" style="width: 100%;">
        @foreach($sumber_dana as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
        @endforeach
    </select>
</div>