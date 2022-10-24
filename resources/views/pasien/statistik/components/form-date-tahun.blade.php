
<div class="form-group">
    <label  for="example-daterange1">Tahun</label>
    <select name="tahun" id="tahun" class="form-control" required>
        <option value="">Pilih Tahun</option>
        @for($i=2019;$i<=$tahun;$i++)
        <option value="{{$i}}" @if($i == $tahun) selected @endif>{{$i}}</option>
        @endfor
    </select>
</div>