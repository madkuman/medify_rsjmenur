<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script  type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    dataTable();

    function dataTable(){
       
        $('#example').dataTable( {
            lengthMenu: [[10, 15, 20], [10, 15, 20]],
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-gear fa-spin text-info"></i></div>',
                searchPlaceholder: "Cari pegawai"
            },
            "ajax": {
                "url": BASE_URL + "remunerasi/api/data-dana",
                "dataType": "json",
                "type": "POST",
                // "data": {
                //     "_token": "{{ csrf_token() }}",
                //     "bulan_tahun": tgl,
                // }
            },
            "columns": [
                {"data": "nomer"},
                {"data": "jumlah"},
                {"data": "tanggal", "className": "text-center"},
                {"data": "action", "className": "text-center"},
            ],
        })
    };

     // MODAL DANA
     $(document).on('click','#btn-modal-create', function () {
        $('#modal-create-dana').modal('show');
        $('#nominal').mask('000.000.000.000.000', {reverse: true});
    })
    
    // Simpan Dana
    function simpanDana(){
        var formData = new FormData($('#form-dana')[0]);
        $('#btnLoading').show();
        $('#btnSubmit').hide();
        $.ajax({
            type:'POST',
            dataType: 'json',
            url: '{{url()->current()}}/create',
            data:formData,
            contentType: false,
            processData:false,
            cache: false,
            success:function(data){
                $('#modal-create-dana').modal('hide');
                   if (data.number == 200){
                        $('#example').DataTable().ajax.reload();
                        $('#modal-create-dana').modal('hide');
                        swal("Good job!", data.ket, "success");
                        $('#btnLoading').hide();
                        $('#btnSubmit').show();
                   
                   } else {
                        swal("Opps!", data.ket, "error");

                        $('#btnLoading').hide();
                        $('#btnSubmit').show();
                   
                   }
            },
            error: function (data) {
                $('#modal-create-dana').modal('hide');
                $('#btnLoading').hide();
                $('#btnSubmit').show();
                swal("Opps!", "Terjadi kesalahan sistem, silahkan ulangi lagi", "error");
            }
        });
    }

    function deleteDana(data) {
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
                    url: BASE_URL + 'remunerasi/dana/delete/'+id,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.number == 200) {
                            swal("!Berhasil", "Data berhasil dihapus", "success").then((result) => {
                                if (result.value) {
                                    $('#example').DataTable().destroy();
                                    var tgl = $('#date-dana').val();
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
</script>