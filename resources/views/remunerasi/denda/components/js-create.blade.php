<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','#btn-modal-create', function () {
        $('#modal-create-denda').modal('show');
        $('#title-modal').html('Denda Absensi Baru');
        $(`.for-edit`).addClass("d-none")
        $(`.for-create`).removeClass("d-none");
            $('#id').val(0);
            $(`:text[name="absen_ket"]`).val("");
            $(`:text[name="absen"]`).val("");
            $(`:text[name="lupa_absen_masuk"]`).val("");
            $(`:text[name="lupa_absen_pulang"]`).val("");
            $(`:text[name="telat_satu"]`).val("");
            $(`:text[name="telat_dua"]`).val("");
            $(`:text[name="telat_tiga"]`).val("");
            $(`:text[name="telat_empat"]`).val("");
            $(`:text[name="pulang_satu"]`).val("");
            $(`:text[name="pulang_dua"]`).val("");
            $(`:text[name="pulang_tiga"]`).val("");
            $(`:text[name="pulang_empat"]`).val("");
            $(`:text[name="tidak_senam"]`).val("");
            $(`:text[name="telat_senam"]`).val("");    
        $('#date-modal').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
    })
</script>