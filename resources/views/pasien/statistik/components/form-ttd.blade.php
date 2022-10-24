<div class="form-group row">
    <label class="col-12" for="example-datepicker1">Pilih Tanda Tangan</label>
    <div class="col-md-12">
        <select class="js-select2 form-control col-6" id="mengetahui" name="mengetahui" style="width: 100%;" data-placeholder="Pilih TTD">
            <option></option>
            @if (empty($ttd))
                <Option></Option>                
            @else
                @foreach($ttd as $item)
                <option value="{{$item->id}}">{{$item->nama}} ({{$item->jabatan}})</option>
                @endforeach
            @endif
        </select>
    </div>
</div>