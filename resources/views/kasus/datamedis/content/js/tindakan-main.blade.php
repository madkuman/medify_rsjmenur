<script type="text/javascript">
    $("#modal-create-tindakan .icd9-class").hide();
    $("#modal-create-tindakan .perawat-class").show();
    $(".button-kesalahan ").click(function () {
        var id=$(this).attr('id_data');
        $('#tindakan-id').val(id);
    });

    $('input:radio[name=kategori-tindakan]').change(function () {
        if ($("input[name='kategori-tindakan']:checked").val() == 'keperawatan') {
            $("#modal-create-tindakan .icd9-class").hide();
            $("#modal-create-tindakan .perawat-class").show();
            $("#tindakan-input-create-daftar-id").val('');
            $("#tindakan-input-create-price").val('');
            $("#modal-create-tindakan .tindakan-autocomplete").val('');
            $("#modal-create-tindakan .tindakan-icd9-autocomplete").val('');
            $('#modal-create-tindakan input:checkbox[name=tagihan]').prop('checked', true);
        }
        if ($("input[name='kategori-tindakan']:checked").val() == 'icd9') {
            $("#modal-create-tindakan .icd9-class").show();
            $("#modal-create-tindakan .perawat-class").hide();
            $("#tindakan-input-create-daftar-id").val('');
            $("#tindakan-input-create-price").val('');
            $("#modal-create-tindakan .tindakan-autocomplete").val('');
            $("#modal-create-tindakan .tindakan-icd9-autocomplete").val('');
            $('#modal-create-tindakan input:checkbox[name=tagihan]').prop('checked', false);
        }
    });
    function historiTindakan()
    {
        @if(!empty($kasus->id))
        window.open(
        "{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/tindakan/histori","popUpWindow",
        "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
        @endif
    }
</script>