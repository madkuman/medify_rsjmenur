<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        dataTable()
    });

    function dataTable() {
        $('#example').dataTable({
            searching: true,
            ordering: false,
            processing: true,
            serverSide: true,
            bLengthChange: true,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: {
                dataSrc: "data",
                url: API_URL + '/e-usulan/pengaturan/unit',
                type: 'GET'
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                {data: 'DT_Row_Index'},
                {data: 'nama'},
                {data: 'aksi'},
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    "searchable": false,
                },
                {
                    "targets": 2,
                    "className": "text-center",
                    "searchable": false,
                }
            ],
        })
    };

    function deleteUnit(data) {
        var id = data.getAttribute("data-id");
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
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: BASE_URL + 'e-usulan/pengaturan/unit/delete/' + id,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.number == 200) {
                            swal("Berhasil!", "Data berhasil dihapus", "success").then((result) => {
                                if (result.value) {
                                    $('#example').DataTable().destroy();
                                    dataTable();
                                }
                            })
                        } else {
                            swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
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