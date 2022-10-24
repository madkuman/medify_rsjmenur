@php
$config_value = config('medify.' . $module_name . '.' . $fitur_key . '.' . $name);
@endphp
<div class="col-12 col-sm-12 col-md-{{ $col }}">
    <div class="form-group">
        <label for="">{{ $judul }}</label>
        <br>
        <label class="css-control css-control-primary css-switch">
            <input type="checkbox" class="css-control-input" name="const[{{ $name }}]" {{ $config_value == 1 ? 'checked' : '' }}
                value="1">
            <span class="css-control-indicator"></span> On
            <button type="button" class="btn btn-rounded btn-sm ml-20 btn-alt-primary" data-toggle="tooltip" data-placement="top"
                title="{{ $deskripsi }}">
                <i class="fa fa-info">
                </i>
            </button>
            @if (isset($preview))
                <button type="button" class="btn btn-rounded btn-sm btn-alt-primary btn-action-preview" data-url="{{ $preview }}"
                    data-size="{{ $preview_size ?? 'small' }}">
                    <i class="fas fa-search"></i>
                    Preview
                </button>
            @endif
        </label>
    </div>
</div>
