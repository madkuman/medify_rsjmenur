<div class="form-group row">
    <div class="col-12">
        <label>{{ $form_title }}</label>
        <select class="form-control js-select2" name="{{ $form_name }}" {{ ($multiple ?? false) ? 'multiple' : '' }}>
            @foreach ($form_option as $key => $value)
                <option value={{ $key }} {{ $selected_value == $key ? 'selected' : '' }}> {{ $value }} </option>
            @endforeach
        </select>
    </div>
</div>