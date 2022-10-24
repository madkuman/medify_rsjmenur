@extends('pasien.layouts.main')

@section('title')
    Pasien - Daftar Online
@endsection

@section('subtitle')
    Daftar Pasien Batal Online
@endsection

@section('css')
    <style type="text/css">
        .block-content {
            padding-bottom: 18px;
        }

    </style>
@endsection

@section('content')
    <main id="main-container">
        @include('pasien.layouts.navbar')
        <div class="container">
            <div class="row row-deck">
                <div class="col-sm-12">
                    <div class="block rounded main-content transaction-index"  ng-controller="PasienController">
                        <div class="block-header">
                            <h3 class="block-title">Daftar Pasien Batal Online</h3>
                        </div>
                        <div class="block-content">
                            <div class="row mb-20">
                                <div class="col-sm-12">
                                    <form style="margin-top: 10px">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tanggal Pembatalan</label>
                                                    <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                                        <input type="text" class="form-control" id="start_date" name="start_date" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{Carbon\Carbon::now()->format('d/m/Y')}}" autocomplete="off">
                                                        <div class="input-group-prepend input-group-append">
                                                            <span class="input-group-text font-w600">to</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="end_date" name="end_date" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{Carbon\Carbon::now()->format('d/m/Y')}}" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Poliklinik</label>
                                                    <select class="form-control js-select2" name="poliklinik" id="poliklinik">
                                                        <option value="all">Semua Poliklinik</option>
                                                        @foreach ($poliklinik as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Dokter</label>
                                                    <select class="form-control js-select2" name="dokter" id="dokter">
                                                        <option value="all">Semua Dokter</option>
                                                        @foreach ($dokter as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-15">
                                                <a href="javascript:void(0)" type="button" class="btn btn-primary btn-block mb-10" id="btn_filter">Filter</a>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-pointer table-vcenter" id="data_tabel_daftar_pasien" style="font-family: sans-serif; width: 100%" >
                                <thead>
                                <tr class="header">
                                    <th style="width:8%;">Tanggal Pembatalan</th>
                                    <th style="width:8%">No RM </th>
                                    <th style="width:20%">Nama Pasien</th>
                                    <th style="width:10%">Tanggal Pemesanan</th>
                                    <th style="width:22%">Poliklinik</th>
                                    <th style="width:10%">Dokter</th>
                                    <th style="width:20%">Tipe Pembayaran</th>
                                    <th style="width:20%">Pembayaran Via</th>
                                    <th style="width:20%">No Pembayaran</th>
                                    <th style="width:20%">Status Refund</th>
                                    <th style="width:5%">Aksi</th>
                                </tr>
                                </thead>
                                <tbody id="tabel_daftar_pasien">
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection


@section('js')


    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        $('#btn_filter').click(function(){
            $('#spinner').removeAttr('class');
            $('#data_tabel_daftar_pasien').dataTable().fnDestroy();
            loadData();
        })

        loadData()

        function loadData() {
            table = $('#data_tabel_daftar_pasien').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                processing: true,
                serverSide: true,
                searching: true,
                pagingType: "full_numbers",
                paging: true,
                lengthMenu: [[10, 15, 25, 50], [10, 15, 25, 50]],
                order: [[ 1, 'desc' ]],
                language: {
                    processing: '<div style="position: absolute; left:50%; top:25%"><i class="fa fa-4x fa-spinner fa-spin text-info"></i></div>'
                },
                ajax: {
                    url: API_URL + '/pasien/get-daftar-online-batal',
                    data: function(d){
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.poliklinik = $('#poliklinik').val();
                        d.dokter = $('#dokter').val();
                    },
                },
                columnDefs: [
                    { width: 50, targets: 0, className: "text-center" },
                    { width: 100, targets: 2, className: "text-center" },
                    { width: 200, targets: 1, className: "text-center" },
                    { width: 150, targets: 3, className: "text-center" },
                    { width: 150, targets: 4, className: "text-center" },
                    { width: 120, targets: 5, className: "text-center" },
                    { width: 120, targets: 6, className: "text-center" },
                    { width: 110, targets: 7, className: "text-center" },
                    { width: 110, targets: 8, className: "text-center" },
                    { width: 110, targets: 8, className: "text-center" },
                    { width: 100, targets: 9, className: "text-center" }
                ],
                columns: [
                    { data: 'tanggal_pembatalan' },
                    { data: 'no_rm'},
                    { data: 'nama_pasien'},
                    { data: 'tanggal_pemesanan'},
                    { data: 'poliklinik'},
                    { data: 'dokter'},
                    { data: 'tipe_pembayaran'},
                    { data: 'payment_online_tipe'},
                    { data: 'payment_online_nomor'},
                    { data: 'status_refund'},
                    { data: 'aksi'},
                ],
            });
        }

        function konfirmasi(data) {
            var id = data.getAttribute("data-id");
            swal({
                title: "Konfirmasi Refund",
                text: "Apakah anda yakin akan konfirmasi refund data ini?",
                showCancelButton: true,
                reverseButtons: true,
                type: 'warning',
                confirmButtonClass: "btn btn-danger btn-click-animate",
                cancelButtonClass: "btn btn-default",
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Kembali",
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: BASE_URL + 'pasien/daftar-online-batal/konfirmasi/' + id,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            if (data.number == 200) {
                                swal("Berhasil!", "Berhasil Konfirmasi Refund", "success").then((result) => {
                                    if (result.value) {
                                        $('#data_tabel_daftar_pasien').dataTable().fnDestroy();
                                        loadData();
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

@endsection