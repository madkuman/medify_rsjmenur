<div class="col-12 col-sm-12 col-md-{{ $col ?? 4 }}">
    <div class="form-group">
        <label for="">{{ $judul }}</label>
        <select name="const[{{ $name }}]"
            class="form-control js-select2" style="width: 100%" data-placeholder="-- Pilih --">
            <option></option>
            @php $selected_option = config('medify.' . $module_name . '.' . $fitur_key . '.' . $name) @endphp
            @foreach ($options ?? [] as $key => $value)
                <option value="{{ $key }}" {{ $selected_option == $key ? 'selected' : ''}}>{{ $value }}</option>
            @endforeach
        </select>
        <div class="small ml-5"> {{ $deskripsi }}</div>
    </div>
</div>