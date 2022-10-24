<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content')
        }
    });

    // GET DATA
    function editAbsensi(data){
         console.log(data);
            var id                = data.getAttribute("data-id")
            var pegawai_id        = data.getAttribute("data-pegawai_id")
            var bulan             = data.getAttribute("data-bulan")
            var nama              = data.getAttribute("data-nama")
            var nrp               = data.getAttribute("data-nrp")
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
            $(`#pegawai`).attr('disabled', 'disabled');
                $('#id').val(id);
                $('#bulan').html(bulan);
                $('#nama').html(nama);
                $('#nrp').html(nrp);
                $(`#absen-ket`).val(absen_ket);
                $(`#absen`).val(absen);
                $(`#lupa-absen-masuk`).val(lupa_absen_masuk);
                $(`#lupa-absen-pulang`).val(lupa_absen_pulang);
                $(`#telat-satu`).val(telat_satu);
                $(`#telat-dua`).val(telat_dua);
                $(`#telat-tiga`).val(telat_tiga);
                $(`#telat-empat`).val(telat_empat);
                $(`#pulang-satu`).val(pulang_satu);
                $(`#pulang-dua`).val(pulang_dua);
                $(`#pulang-tiga`).val(pulang_tiga);
                $(`#pulang-empat`).val(pulang_empat);
                $(`#tidak-senam`).val(tidak_senam);
                $(`#telat-senam`).val(telat_senam);   

            $('#date-modal').combodate({
                customClass: 'js-select2 form-control',
                smartDays: true,
                maxYear: new Date().getFullYear() + 1
            });

            $('#modal-create-absensi').modal('show');
            $('#title-modal').html('Edit Absensi Pegawai');

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
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }
                        
                    },
                    error: function (data) {
                        $('#btnSubmit').show();
                        $('#btnLoading').hide();
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }
                });
            });
		};
</script>