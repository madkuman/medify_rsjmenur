<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // GET DATA
    function editPelayanan(data){
         console.log(data);
            var id                  = data.getAttribute("data-id")
            var pegawai_id          = data.getAttribute("data-pegawai_id")
            var bulan               = data.getAttribute("data-bulan")
            var nama                = data.getAttribute("data-nama")
            var nrp                 = data.getAttribute("data-nrp")
            var jp_dasar            = data.getAttribute("data-jp_dasar")
            var visite_tetap        = data.getAttribute("data-visite_tetap")
            var visite_anggrek      = data.getAttribute("data-visite_anggrek")
            var jasa_pendidikan     = data.getAttribute("data-jasa_pendidikan")
            var tindakan_dokter     = data.getAttribute("data-tindakan_dokter")
            var konsul_dokter       = data.getAttribute("data-konsul_dokter")
            var poli_tumbang        = data.getAttribute("data-poli_tumbang")
            var patologi_klinik     = data.getAttribute("data-patologi_klinik")
            var aps_ect             = data.getAttribute("data-aps_ect")
            var ipwl                = data.getAttribute("data-ipwl")

            $(`.for-edit`).removeClass("d-none")
            $(`.for-create`).addClass("d-none");
            $(`#pegawai`).attr('disabled', 'disabled');
                $('#id').val(id);
                $('#bulan').html(bulan);
                $('#nama').html(nama);
                $('#nrp').html(nrp);
                $(`:text[name="jp_dasar"]`).val(jp_dasar);
                $(`:text[name="visite_tetap"]`).val(visite_tetap);
                $(`:text[name="visite_anggrek"]`).val(visite_anggrek);
                $(`:text[name="jasa_pendidikan"]`).val(jasa_pendidikan);
                $(`:text[name="tindakan_dokter"]`).val(tindakan_dokter);
                $(`:text[name="konsul_dokter"]`).val(konsul_dokter);
                $(`:text[name="poli_tumbang"]`).val(poli_tumbang);
                $(`:text[name="patologi_klinik"]`).val(patologi_klinik);
                $(`:text[name="aps_ect"]`).val(aps_ect);
                $(`:text[name="ipwl"]`).val(ipwl);
             
            $('#date-modal').combodate({
                customClass: 'js-select2 form-control',
                smartDays: true,
                maxYear: new Date().getFullYear() + 1
            });

            $('#modal-create-pelayanan').modal('show');
            $('#title-modal').html('Edit Pelayanan Pegawai');

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
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }
                        
                    },
                    error: function (data) {
                        $('#btnLoading').hide();
                        $('#btnSubmit').show();
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }
                });
            });
		};
</script>