<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script  type="text/javascript">

    $(document).ready(function() {
        $(".js-datepicker-year").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });
        var tgl = $('#periode').val();
        dataTable(tgl);
    });

    $("#cariPeriode").submit(function(event) {
        event.preventDefault();
        $('#example').DataTable().destroy();
            var tgl = $('#periode').val();
        dataTable(tgl);
    });

    function dataTable(tgl){
        $('#example').dataTable( {
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
                url  : API_URL+'/e-sakip',
                type :'GET',
                data: {
                    'tahun': tgl,
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'DT_Row_Index' },
                { data: 'pegawai' },
                { data: 'title' },
                { data: 'status' },
                { data: 'aksi' },
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    "searchable":false,
                },
                {
                    "targets": 3,
                    "className": "text-center",
                    "searchable":false,
                }
                ,
                {
                    "targets": 4,
                    "className": "text-center",
                    "searchable":false,
                }
            ],
        })
    };

    function deleteDokumen(data) {
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
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: BASE_URL+'e-sakip/delete/'+id,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            if (data.number == 200) {
                                swal("!Berhasil", "Data berhasil dihapus", "success").then((result) => {
                                    if (result.value) {
                                        $('#example').DataTable().destroy();
                                        var tgl = $('#periode').val();
                                        dataTable(tgl);
                                    }
                                })
                            }else{
                                swal("Opps!", data.ket, "error");
                            }
                        },
                        error: function (data) {
                            swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
                        }
                    });
                }
            });
    }

    function lihatDokumen(data) {
        var path = data.getAttribute("data-path");
        url = BASE_URL+path;
        popupwindow(url,'Dokumen Pegawai',600,800);
    }
</script>