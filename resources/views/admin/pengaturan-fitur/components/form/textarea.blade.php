<div class="col-12 col-sm-12 col-md-{{ $col }}">
    <div class="form-group">
        <label for="">{{ $judul }}</label>
        <textarea name="const[{{ $name }}]" class="{{ $attributes['class'] }}" id="{{ $name }}"data-ori-name="{{ $name }}">{{ $value }}</textarea>
        <div class="small ml-5"> {{ $deskripsi }}</div>
    </div>
</div>
