@foreach ($input as $item)
    @php
    $config = json_decode(config('medify.' . $module_name . '.' . $fitur_key . '.list_asesmen'), true);
    $config_value = $config[$item["slug"]] ?? 0;
    @endphp
    <div class="col-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="">{{ $item["nama"] }}</label>
            <br>
            <label class="css-control css-control-primary css-switch">
                <input type="checkbox" class="css-control-input" name="const[list_asesmen][{{ $item["slug"] }}]" {{ $config_value == 1 ? 'checked' : '' }}
                    value="1">
                <span class="css-control-indicator"></span> On
            </label>
        </div>
    </div>
@endforeach
