<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','#btn-modal-create', function () {
        $('#modal-create-absensi').modal('show');
        $('#title-modal').html('Absensi Pegawai');
        $(`.for-edit`).addClass("d-none")
        $(`.for-create`).removeClass("d-none");
        $(`#pegawai`).removeAttr("disabled");
            $('#id').val(0);
            $('#pegawai').val("").trigger('change');
            $(`#absen-ket`).val("");
            $(`#absen`).val("");
            $(`#lupa-absen-masuk`).val("");
            $(`#lupa-absen-pulang`).val("");
            $(`#telat-satu`).val("");
            $(`#telat-dua`).val("");
            $(`#telat-tiga`).val("");
            $(`#telat-empat`).val("");
            $(`#pulang-satu`).val("");
            $(`#pulang-dua`).val("");
            $(`#pulang-tiga`).val("");
            $(`#pulang-empat`).val("");
            $(`#tidak-senam`).val("");
            $(`#telat-senam`).val("");   
        $('#btnSubmit').show();
        $('#btnLoading').hide();

        $('#date-modal').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });

        // ADD Absensi
        $("#form-absensi").submit(function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData(this);
            $('#btnSubmit').hide();
            $('#btnLoading').show();
            $.ajax({
                type:'POST',
                dataType: 'json',
                url: BASE_URL+'remunerasi/absensi/create',
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                if(data.number == 200){
                    $('#btnLoading').hide();
                    $('#btnSubmit').show();
                    swal("!Berhasil", "Data berhasil disimpan", "success").then((result) => {
                        if (result.value) {
                            $('#example').DataTable().destroy();
                            var tgl = $('#date-absensi').val();
                            dataTable(tgl);
                            $('#modal-create-absensi').modal('hide');
                        }
                    })
                } else {
                    $('#btnSubmit').show();
                    $('#btnLoading').hide();
                    swal("Opps!", "Gagal, data pada periode yang dipilih sudah ada", "error");
                }
                    
                },
                error: function (data) {
                    $('#btnSubmit').show();
                    $('#btnLoading').hide();
                    swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                }
            });
        });
    });

    $(document).ready(function() {
        $("#pegawai").select2({
            ajax: {
                url: BASE_URL+"remunerasi/api/get-pegawai",
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
</script>