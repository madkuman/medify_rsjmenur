
<div class="form-group">
    <label for="penyedia">TAHUNAN </label>
    <select class="form-control" name="tahun">
        @php $current_year = Carbon\Carbon::now()->format('Y') @endphp
        @for($i=2020;$i<=$current_year;$i++)
        <option value="{{$i}}">{{$i}}</option>
        @endfor
    </select>
</div>
<div class="col">
    <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
</div>