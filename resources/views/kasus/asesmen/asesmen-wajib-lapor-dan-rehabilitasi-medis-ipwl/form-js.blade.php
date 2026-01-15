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

// skala penilaian pasien
$(document).ready(function() {
    let status_medis_skala_penilaian_pasien = $('input[name ="status_medis_skala_penilaian_pasien"]').val() ?? 0
    let status_pekerjaan_dukungan_hidup_skala_penilaian_pasien = $('input[name ="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien"]').val() ?? 0
    let status_penggunaan_narkotika_skala_penilaian_pasien = $('input[name ="status_penggunaan_narkotika_skala_penilaian_pasien"]').val() ?? 0
    let status_legal_skala_penilaian_pasien = $('input[name ="status_legal_skala_penilaian_pasien"]').val() ?? 0
    let riwayat_keluarga_sosial_skala_penilaian_pasien = $('input[name ="riwayat_keluarga_sosial_skala_penilaian_pasien"]').val() ?? 0
    let status_psikiatris_skala_penilaian_pasien = $('input[name ="status_psikiatris_skala_penilaian_pasien"]').val() ?? 0

    // status_medis_skala_penilaian_pasien
    $('input[name ="status_medis_skala_penilaian_pasien"]').change(function() {
        status_medis_skala_penilaian_pasien = $(this).val();
        for(let i = 0; i <= 9; i++) {
            $('[id^="status_medis_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
            if(status_medis_skala_penilaian_pasien == i) {
                $(`#status_medis_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                break;
            }
        }
    });
    // status_pekerjaan_dukungan_hidup_skala_penilaian_pasien
    $('input[name ="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien"]').change(function() {
        status_pekerjaan_dukungan_hidup_skala_penilaian_pasien = $(this).val();
        for(let i = 0; i <= 9; i++) {
            $('[id^="status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
            if(status_pekerjaan_dukungan_hidup_skala_penilaian_pasien == i) {
                $(`#status_pekerjaan_dukungan_hidup_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                break;
            }
        }
    });
    // status_penggunaan_narkotika_skala_penilaian_pasien
    $('input[name ="status_penggunaan_narkotika_skala_penilaian_pasien"]').change(function() {
        status_penggunaan_narkotika_skala_penilaian_pasien = $(this).val();
        for(let i = 0; i <= 9; i++) {
            $('[id^="status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
            if(status_penggunaan_narkotika_skala_penilaian_pasien == i) {
                $(`#status_penggunaan_narkotika_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                break;
            }
        }
    });
    // status_legal_skala_penilaian_pasien
    $('input[name ="status_legal_skala_penilaian_pasien"]').change(function() {
        status_legal_skala_penilaian_pasien = $(this).val();
        for(let i = 0; i <= 9; i++) {
            $('[id^="status_legal_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
            if(status_legal_skala_penilaian_pasien == i) {
                $(`#status_legal_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                break;
            }
        }
    });
    // riwayat_keluarga_sosial_skala_penilaian_pasien
    $('input[name ="riwayat_keluarga_sosial_skala_penilaian_pasien"]').change(function() {
        riwayat_keluarga_sosial_skala_penilaian_pasien = $(this).val();
        for(let i = 0; i <= 9; i++) {
            $('[id^="riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
            if(riwayat_keluarga_sosial_skala_penilaian_pasien == i) {
                $(`#riwayat_keluarga_sosial_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                break;
            }
        }
    });
    // status_psikiatris_skala_penilaian_pasien
    $('input[name ="status_psikiatris_skala_penilaian_pasien"]').change(function() {
        status_psikiatris_skala_penilaian_pasien = $(this).val();
        for(let i = 0; i <= 9; i++) {
            $('[id^="status_psikiatris_skala_penilaian_pasien_kesimpulan_"]').removeClass('filled');
            if(status_psikiatris_skala_penilaian_pasien == i) {
                $(`#status_psikiatris_skala_penilaian_pasien_kesimpulan_${i}`).addClass('filled');
                break;
            }
        }
    });
})
</script>
@endsection