<div class="form-group">
    <label>Unit</label>
    <select class="form-control js-select2" name="unit_ids[]" placeholder="Pilih Unit" multiple="multiple" style="width: 100%;">
        @foreach($unit as $row)
            <option value="{{$row->id}}">{{$row->nama}}</option>
        @endforeach
    </select>
    <small>Kosongkan untuk melakukan filter semua unit</small>
</div>
<label class="css-control css-control-primary css-radio">
    <input type="radio" class="css-control-input" name="unit_kriteria" value="inklusi" checked>
    <span class="css-control-indicator"></span> Inklusi
</label>
<label class="css-control css-control-primary css-radio">
    <input type="radio" class="css-control-input" name="unit_kriteria" value="eksklusi">
    <span class="css-control-indicator"></span> Eksklusi
</label>