@php
$config_value = config('medify.' . $module_name . '.' . $fitur_key . '.' . $name);
@endphp
<div class="col-12 col-sm-12 col-md-{{ $col }}">
    <div class="form-group">
        <label for="">{{ $judul }}</label>
        <br>
        <label class="css-control css-control-primary css-switch">
            <input type="hidden" name="const[{{ $name }}]" value="{{ $config_value == 1 ? '1' : '0' }}">
            <input type="checkbox" class="css-control-input {{ $class ?? '' }}" value="1" onclick="this.previousElementSibling.value=1-this.previousElementSibling.value" {{ $config_value == 1 ? 'checked' : '' }}>
            <span class="css-control-indicator"></span> On
            <button type="button" class="btn btn-rounded btn-sm ml-20 btn-alt-primary" data-toggle="tooltip" data-html="true" data-placement="top"
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
