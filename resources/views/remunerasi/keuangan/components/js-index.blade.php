<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#date-pelayanan').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
        var tgl = $('#date-pelayanan').val();
        dataTable(tgl);
    });

    $("#cariPeriode").submit(function(event) {
        event.preventDefault();
        $('#example').DataTable().destroy();
            var tgl = $('#date-pelayanan').val();
        dataTable(tgl);
    });

    function dataTable(tgl){
        $('#example').dataTable( {
            lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "scrollX": true,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>',
                searchPlaceholder: "Cari pegawai"
            },
            "ajax": {
                "url": BASE_URL + "remunerasi/api/data-keuangan",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    "bulan_tahun": tgl,
                }
            },
            "columns": [
                {"data": "nomer","className": "text-center"},
                {"data": "bulan","className": "text-center"},
                {"data": "pegawai"},
                {"data": "jp_dasar","className": "text-center"},
                {"data": "visite_tetap","className": "text-center"},
                {"data": "visite_anggrek","className": "text-center"},
                {"data": "jasa_pendidikan","className": "text-center"},
                {"data": "tindakan_dokter","className": "text-center"},
                {"data": "konsul_dokter","className": "text-center"},
                {"data": "poli_tumbang","className": "text-center"},
                {"data": "aps_ect","className": "text-center"},
                {"data": "patologi_klinik", "className": "text-center"},
                {"data": "ipwl", "className": "text-center"},
                {"data": "action", "className": "text-center"}
            ],
        })
    };

    function deletePelayanan(data) {
        var id = data.getAttribute("data-id");
        $('#deleteInputId').val(id);
        swal({
            title: "Hapus",
            text: "Apakah anda yakin akan menghapus data ini?",
            showCancelButton: true,
            reverseButtons: true,
            type: 'warning',
            confirmButtonClass: "btn btn-danger btn-click-animate",
            cancelButtonClass: "btn btn-default",
            confirmButtonText: "Hapus",
            cancelButtonText: "Kembali",
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: BASE_URL + 'remunerasi/keuangan/delete/'+id,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data.number == 200) {
                            swal("!Berhasil", "Data berhasil dihapus", "success").then((result) => {
                                if (result.value) {
                                    $('#example').DataTable().destroy();
                                    var tgl = $('#date-pelayanan').val();
                                    dataTable(tgl);
                                }
                            })
                        }
                    },
                    error: function (data) {
                        swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                    }
                });
            }
        });
    }
</script>