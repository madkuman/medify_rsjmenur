<div class="form-group">
    <label for="penyedia">Penyedia</label>
    <select class="form-control js-select2" name="supplier_ids[]" placeholder="Pilih Penyedia" multiple="multiple" style="width: 100%;">
        @foreach($penyedia as $pharm)
            <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
        @endforeach
    </select>
    <small>Kosongkan untuk melakukan filter semua penyedia</small>
</div>
