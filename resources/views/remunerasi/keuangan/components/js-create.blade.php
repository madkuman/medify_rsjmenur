<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','#btn-modal-create', function () {
        $('#modal-create-pelayanan').modal('show');
        $('#title-modal').html('Pelayanan Pegawai');
        $(`.for-edit`).addClass("d-none")
        $(`.for-create`).removeClass("d-none");
        $(`#pegawai`).removeAttr("disabled");
            $('#id').val(0);
            $(`:text[name="jp_dasar"]`).val("");
            $(`:text[name="visite_tetap"]`).val("");
            $(`:text[name="visite_anggrek"]`).val("");
            $(`:text[name="jasa_pendidikan"]`).val("");
            $(`:text[name="tindakan_dokter"]`).val("");
            $(`:text[name="konsul_dokter"]`).val("");
            $(`:text[name="poli_tumbang"]`).val("");
            $(`:text[name="patologi_klinik"]`).val("");
            $(`:text[name="aps_ect"]`).val("");
            $(`:text[name="ipwl"]`).val("");
        $('#date-modal').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });

        // ADD Pelayanan
        $("#form-pelayanan").submit(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $('#btnLoading').show();
            $('#btnSubmit').hide();
            $.ajax({
                type:'POST',
                dataType: 'json',
                url: BASE_URL + '/remunerasi/keuangan/create',
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                if(data.number == 200){
                    resetForm()
                    $('#btnLoading').hide();
                    $('#btnSubmit').show();
                    swal("!Berhasil", "Data berhasil disimpan", "success").then((result) => {
                        if (result.value) {
                            $('#example').DataTable().destroy();
                            var tgl = $('#date-pelayanan').val();
                            dataTable(tgl);
                            $('#modal-create-pelayanan').modal('hide');
                        }
                    })
                } else {
                    $('#btnLoading').hide();
                    $('#btnSubmit').show();
                    swal("Opps!", "Gagal, data pada periode yang dipilih sudah ada", "error");
                }
                    
                },
                error: function (data) {
                    $('#btnLoading').hide();
                    $('#btnSubmit').show();
                    swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                }
            });
        });
    });

    $(document).ready(function() {
        $("#pegawai").select2({
            ajax: {
                url: BASE_URL+ "remunerasi/api/get-pegawai",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari nama pegawai",
            templateResult: formatPegawai,
            templateSelection: formatSelection
        }); 
    });

    function formatPegawai (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.text

        return markup;
    }

    //FORMAT UNTUK DI SHOW DI HTML
    function formatSelection (item) {
        return item.name || item.text;
    }

    function getJPDasar()
    {
        $.ajax({
            type:'GET',
            url : API_URL+'/kepegawaian/'+$('#pegawai').val(),
            success:function(res){
                if(res.kualifikasi){
                    console.log(res)
                    $('#jp-dasar').val(res.master_kualifikasi.jp_dasar);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest, textStatus, errorThrown);
            },
        });
    }

    function resetForm(){
        $("#pegawai").val('');
        $("#jp-dasar").val('');
        $("#visite-tetap").val('');
        $("#visite-anggrek").val('');
        $("#jasa-pendidikan").val('');
        $("#tindakan-dokter").val('');
        $("#konsul-dokter").val('');
        $("#poli-tumbang").val('');
        $("#aps-ect").val('');
        $("#patologi-klinik").val('');
        $("#ipwl").val('');
    }

    

    // MASK FORM KEUANGAN
    $('#jp-dasar').mask('000.000.000.000.000', {reverse: true});
    $('#visite-tetap').mask('000.000.000.000.000', {reverse: true});
    $('#visite-anggrek').mask('000.000.000.000.000', {reverse: true});
    $('#jasa-pendidikan').mask('000.000.000.000.000', {reverse: true});
    $('#tindakan-dokter').mask('000.000.000.000.000', {reverse: true});
    $('#konsul-dokter').mask('000.000.000.000.000', {reverse: true});
    $('#poli-tumbang').mask('000.000.000.000.000', {reverse: true});
    $('#aps-ect').mask('000.000.000.000.000', {reverse: true});
    $('#patologi-klinik').mask('000.000.000.000.000', {reverse: true});
    $('#ipwl').mask('000.000.000.000.000', {reverse: true});
</script>