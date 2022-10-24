<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script  type="text/javascript">

    $(document).ready(function() {
        $('#date-absensi').combodate({
            customClass: 'js-select2 form-control',
            smartDays: true,
            maxYear: new Date().getFullYear() + 1
        });
        var tgl = $('#date-absensi').val();
        dataTable(tgl);
    });

    $("#cariPeriode").submit(function(event) {
        event.preventDefault();
        $('#example').DataTable().destroy();
            var tgl = $('#date-absensi').val();
        dataTable(tgl);
    });

    function dataTable(tgl){
        $('#example').dataTable( {
            lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>',
                searchPlaceholder: "Cari pegawai"
            },
            "ajax": {
                "url": BASE_URL + "remunerasi/api/data-absensi",
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
                {"data": "absen","className": "text-center"},
                {"data": "lupa_absen","className": "text-center"},
                {"data": "telat","className": "text-center"},
                {"data": "pulang","className": "text-center"},
                {"data": "senam","className": "text-center"},
                {"data": "action","className": "text-center"}
            ],
        })
    };

    function deleteAbsensi(data) {
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
                        url: BASE_URL + 'remunerasi/absensi/delete/'+id,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            if (data.number == 200) {
                                swal("!Berhasil", "Data berhasil dihapus", "success").then((result) => {
                                    if (result.value) {
                                        $('#example').DataTable().destroy();
                                        var tgl = $('#date-absensi').val();
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