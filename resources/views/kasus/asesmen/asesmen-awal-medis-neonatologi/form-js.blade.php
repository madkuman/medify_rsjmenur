@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        // $('.timid').mask('00:00');
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
// validasi Input Skala Penilaian
function validateInputSkalaPenilaian(inputElement) {
    const inputValue = inputElement.value;

    // Menghapus karakter selain angka 0-9
    const cleanedValue = inputValue.replace(/\D/g, '');

    // Memastikan nilai tetap antara 0-9
    if (cleanedValue < 0) {
        inputElement.value = 0;
    } else if (cleanedValue > 9) {
        inputElement.value = 9;
    } else {
        inputElement.value = cleanedValue;
    }
}
// TTD Mengetahui Dokter
$('#selectTtdMengetahuiDokter').select2({
    ajax: {
        url: '{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{ $form->slug }}/search-user',
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
                    return { id: obj.id, text: obj.name, ttd: obj.ttd };
                })
            };
        },
        cache: true
    }
}).on('change', function() {
    var selectedOption = $(this).select2('data')[0];
    $('#mengetahui_dokter').val(selectedOption.text)
    $('#ttd_mengetahui_dokter').val(selectedOption.ttd)
});


</script>
@endsection