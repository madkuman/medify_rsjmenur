<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script  type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content')
        }
    });

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
        //$('#example').DataTable().destroy();
            var tgl = $('#periode').val();
        dataTable(tgl);
    });

    function dataTable(tgl){
        $('#example').DataTable( {
            searching: true,
            ordering: false,
            processing: true,
            serverSide: true,
            bLengthChange: true,
            pageLength: 10,
            responsive: true,
            destroy:true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: {
                dataSrc: "data",
                url  : API_URL+'/e-sakip/verifikasi',
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
                { data: 'status',class:'status-check text-center' },
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
    function lihatDokumen(data) {
        var path = data.getAttribute("data-path");
        url = BASE_URL+path;
        popupwindow(url,'Dokumen Pegawai',600,800);
    }

    function verifikasi(dokumen) {
        var id = dokumen.getAttribute("data-id");

        $.ajax({
            type:'POST',
            dataType: 'json',
            url: BASE_URL+'e-sakip/verifikasi/edit/'+id,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data.number == 200){
                    $(dokumen).parents('tr').find('.btn-verifikasi').addClass('d-none');
                    $(dokumen).parents('tr').find('.btn-batal-verifikasi').removeClass('d-none');
                    $(dokumen).parents('tr').find('.status-check').html(data.content);
                    swal("!Berhasil", "Data berhasil diverifikasi", "success")
                } else {
                    swal("Opps!", data.ket, "error");
                }

            },
            error: function (data) {
                $('#btnSubmitEdit').show();
                $('#btnLoadingEdit').hide();
                swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
            }
        });
    }

    function batalVerifikasi(dokumen) {
        var id = dokumen.getAttribute("data-id");

        $.ajax({
            type:'POST',
            dataType: 'json',
            url: BASE_URL+'e-sakip/verifikasi/batal/'+id,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data.number == 200){
                    $(dokumen).parents('tr').find('.btn-batal-verifikasi').addClass('d-none')
                    $(dokumen).parents('tr').find('.btn-verifikasi').removeClass('d-none');
                    $(dokumen).parents('tr').find('.status-check').html(data.content)
                    swal("!Berhasil", "Batal verifikasi berhasil", "success")
                } else {
                    swal("Opps!", data.ket, "error");
                }

            },
            error: function (data) {
                $('#btnSubmitEdit').show();
                $('#btnLoadingEdit').hide();
                swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
            }
        });
    }
</script>