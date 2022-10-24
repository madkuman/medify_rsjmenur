<div class="form-group">
    <label for="penyedia">Penyedia</label>
    <select class="form-control js-select2" name="supplier_ids[]" placeholder="Pilih Penyedia" multiple="multiple" style="width: 100%;">
        @foreach($penyedia as $pharm)
            <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
        @endforeach
    </select>
    <small>Kosongkan untuk melakukan filter semua penyedia</small>
</div>

<label class="css-control css-control-primary css-radio">
    <input type="radio" class="css-control-input" name="supplier_kriteria" value="inklusi" checked>
    <span class="css-control-indicator"></span> Inklusi
</label>
<label class="css-control css-control-primary css-radio">
    <input type="radio" class="css-control-input" name="supplier_kriteria" value="eksklusi">
    <span class="css-control-indicator"></span> Eksklusi
</label>