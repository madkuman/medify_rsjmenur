<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // GET DATA
    function editDenda(data){
         console.log(data);
            var id                = data.getAttribute("data-id")
            var bulan             = data.getAttribute("data-bulan")
            var absen             = data.getAttribute("data-absen")
            var absen_ket         = data.getAttribute("data-absen_ket")
            var lupa_absen_masuk  = data.getAttribute("data-lupa_absen_masuk")
            var lupa_absen_pulang = data.getAttribute("data-lupa_absen_pulang")
            var telat_satu        = data.getAttribute("data-telat_satu")
            var telat_dua         = data.getAttribute("data-telat_dua")
            var telat_tiga        = data.getAttribute("data-telat_tiga")
            var telat_empat       = data.getAttribute("data-telat_empat")
            var pulang_satu       = data.getAttribute("data-pulang_satu")
            var pulang_dua        = data.getAttribute("data-pulang_dua")
            var pulang_tiga       = data.getAttribute("data-pulang_tiga")
            var pulang_empat      = data.getAttribute("data-pulang_empat")
            var tidak_senam       = data.getAttribute("data-tidak_senam")
            var telat_senam       = data.getAttribute("data-telat_senam")

            $(`.for-edit`).removeClass("d-none")
            $(`.for-create`).addClass("d-none");
                $('#id').val(id);
                $('#bulan').html(bulan);
                $(`:text[name="absen_ket"]`).val(absen_ket);
                $(`:text[name="absen"]`).val(absen);
                $(`:text[name="lupa_absen_masuk"]`).val(lupa_absen_masuk);
                $(`:text[name="lupa_absen_pulang"]`).val(lupa_absen_pulang);
                $(`:text[name="telat_satu"]`).val(telat_satu);
                $(`:text[name="telat_dua"]`).val(telat_dua);
                $(`:text[name="telat_tiga"]`).val(telat_tiga);
                $(`:text[name="telat_empat"]`).val(telat_empat);
                $(`:text[name="pulang_satu"]`).val(pulang_satu);
                $(`:text[name="pulang_dua"]`).val(pulang_dua);
                $(`:text[name="pulang_tiga"]`).val(pulang_tiga);
                $(`:text[name="pulang_empat"]`).val(pulang_empat);
                $(`:text[name="tidak_senam"]`).val(tidak_senam);
                $(`:text[name="telat_senam"]`).val(telat_senam);   
             
            $('#date-modal').combodate({
                customClass: 'js-select2 form-control',
                smartDays: true,
                maxYear: new Date().getFullYear() + 1
            });

            $('#modal-create-denda').modal('show');
            $('#title-modal').html('Edit Denda Absensi');
		};
</script>