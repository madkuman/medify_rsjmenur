@php
$atribute_text = '';
foreach ($attributes ?? [] as $key => $value) {
    if ($key == 'class') {
        continue;
    }
    $atribute_text = ' ' . $key . '="' . $value . '"';
}
@endphp
<div class="col-12 col-sm-12 col-md-{{ $col }}">
    <div class="form-group">
        <label for="">{{ $judul }}</label>
        <input type="text" name="const[{{ $name }}]" value="{{ config('medify.' . $module_name . '.' . $fitur_key . '.' . $name) }}"
            class="form-control {{ $attributes['class'] }}" {{ $atribute_text }}>
        <div class="small ml-5"> {{ $deskripsi }}</div>
    </div>
</div>
