<div class="col-12 col-sm-12 col-md-{{ $col ?? 4 }}">
    <div class="form-group">
        <label for="">{{ $judul }}</label>
        <select name="const[{{ $name }}][]"
            class="form-control js-select2multiple" multiple style="width: 100%">
            <option></option>
            @foreach ($selected_option ?? [] as $item)
                <option value="{{ $item['id'] }}" selected>{{ $item['text'] }}</option>
            @endforeach
        </select>
        <div class="small ml-5"> {{ $deskripsi }}</div>
    </div>
</div>

@section('js')
    @parent
    <script>
        $('.js-select2multiple').select2({
            ajax: {
                url: "{{ $source_url }}",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page,
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return data;
                },
                cache: true
            },
            tags : true,
            createTag: function (params) {
                return null;
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "{{ $placeholder ?? 'Pilih option' }}",
            templateResult: (item)  => {
                return item.text;
            },
            templateSelection: (item) =>  {
                return item.text;
            }
        });
    </script>
@endsection