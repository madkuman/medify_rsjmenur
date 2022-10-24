<div class="form-group">
    <label class="" for="example-daterange1">Zona</label>
    <select name="lokasi" id="lokasi" class="js-select2 form-control" style="width: 100%">
        <option value="all">Semua</option>
        @foreach($zona as $index => $item)
        <option value="{{$item->zona}}||{{$item->value}}">{{$item->zona}} - {{$item->lokasi}}</option>
        @endforeach
    </select>
</div>
<div class="form-group row">
    <label class="col-12">Tanggal</label>
    <div class="input-daterange input-group col-8 " data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
        <input type="text" class="form-control" autocomplete="off" id="example-daterange1" name="date_start" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
        <div class="input-group-prepend input-group-append">
            <span class="input-group-text font-w600">to</span>
        </div>
        <input type="text" class="form-control" autocomplete="off" id="example-daterange2" name="date_end" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
    </div>
</div>