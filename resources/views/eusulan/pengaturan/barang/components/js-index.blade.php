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
                url: API_URL + '/e-usulan/pengaturan/barang',
                type: 'GET'
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                {data: 'DT_Row_Index'},
                {data: 'kode'},
                {data: 'nama'},
                {data: 'tipe'},
                {data: 'harga'},
                {data: 'satuan'},
                {data: 'kelompok'},
                {data: 'akun_rekening'},
                {data: 'aksi'},
            ],
            columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    "searchable": false,
                },
                {
                    "targets": 7,
                    "searchable": false,
                },
                {
                    "targets": 8,
                    "className": "text-center",
                    "searchable": false,
                }
            ],
        })
    };

    function deleteBarang(data) {
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
                    url: BASE_URL + 'e-usulan/pengaturan/barang/delete/' + id,
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

    $('.akun-rekening-select').select2({
        ajax: {
            url: API_URL+"/e-usulan/pengaturan/akun-rekening/search",
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
                    results: data.data,
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 3,
        placeholder: "Cari Akun Rekening",
        templateResult: formatAkunRekening,
        templateSelection: formatAkunRekeningSelection
    });

    function formatAkunRekening (item) {
        if (item.loading) {
            return item.text;
        }
        var markup = item.kode+' - '+item.nama;

        return markup;
    }

    function formatAkunRekeningSelection (item) {
        if(item.nama) return item.kode+' - '+item.nama;
        else return item.text;
    }
</script>