@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-submit').prop('disabled', false);
        $('#btn-submit').html('Simpan')
    });	
    $('#btn-submit').on( 'click', function() {
        $(this).prop('disabled', true);
        $(this).css({ cursor: "not-allowed" });
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Simpan')
        $('#form-post').submit()
    } );
</script>
<script type="text/javascript">
    $('#selectDokterPelaksana').select2({
        ajax: {
            url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/formulir-permintaan-ect/search-user',
            data: function(params){
                return {
                    name: params.term, 
                };
            },
            delay: 250,
            processResults: function (data, params) {
                var  res = JSON.parse(data);
                var results = [];
                if(res.code == 200){
                    results = res.data.data;
                }
                return {
                    results: $.map(results, function(obj) {
                        return { id: obj.id, text: obj.name };
                    })
                };
            },
            cache: true
        }
    }).on('change', function() {
        var selectedOption = $(this).select2('data')[0];
        $('#dokter_pelaksana').val(selectedOption.text)
    });
    
    $('#selectPemberiInformasi').select2({
        ajax: {
            url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/formulir-permintaan-ect/search-user',
            data: function(params){
                return {
                    name: params.term, 
                };
            },
            delay: 250,
            processResults: function (data, params) {
                var  res = JSON.parse(data);
                var results = [];
                if(res.code == 200){
                    results = res.data.data;
                }
                return {
                    results: $.map(results, function(obj) {
                        return { id: obj.id, text: obj.name };
                    })
                };
            },
            cache: true
        }
    }).on('change', function() {
        var selectedOption = $(this).select2('data')[0];
        $('#pemberi_informasi').val(selectedOption.text)
    });
    
    $('#selectPenerimaInformasi').select2({
        ajax: {
            url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/formulir-permintaan-ect/search-user',
            data: function(params){
                return {
                    name: params.term, 
                };
            },
            delay: 250,
            processResults: function (data, params) {
                var  res = JSON.parse(data);
                var results = [];
                if(res.code == 200){
                    results = res.data.data;
                }
                return {
                    results: $.map(results, function(obj) {
                        return { id: obj.id, text: obj.name };
                    })
                };
            },
            cache: true
        }
    }).on('change', function() {
        var selectedOption = $(this).select2('data')[0];
        $('#penerima_informasi').val(selectedOption.text)
    });
    
</script>
@endsection