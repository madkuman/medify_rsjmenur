<div class="form-group">
    <label for="produsen">Produsen</label>
    <select class="form-control js-select2" name="produsen_ids[]" placeholder="Pilih Produsen" multiple="multiple" style="width: 100%;">
        @foreach($penyedia as $pharm)
            <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
        @endforeach
    </select>
    <small>Kosongkan untuk melakukan filter semua produsen</small>
</div>