<div class="form-group">
    <label for="penyedia">Pilih Katalog</label>
    <select class="form-control js-select2" name="katalog_id" placeholder="Pilih Katalog" style="width: 100%;">
        <option value="0">Semua</option>
        @foreach($katalog as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
        @endforeach
    </select>
</div>