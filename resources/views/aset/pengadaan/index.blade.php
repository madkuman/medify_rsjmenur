@extends('aset.layouts.main')

@section('title')
Pengadaan
@endsection


@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Pengadaan</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Pengadaan Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form id="search-form">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="penyedia">PENYEDIA </label>
                                <select class="js-select2 form-control mt-2 select2" id="cari-peyedia-select2" name="cari_peyedia" style="width: 100%;">
                                    <option value="0">Semua Penyedia</option>
                                    @foreach($supplier as $list)
                                        <option value="{{$list->id}}">
                                            {{$list->name_perusahaan}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="penyedia">TANGGAL </label>
                                <input type="text" class="js-datepicker form-control datepicker" class="form-control" name="tanggal_awal" placeholder="Tanggal Awal">
                                <input type="text" class="js-datepicker form-control datepicker mt-2" class="form-control" name="tanggal_akhir" placeholder="Tanggal Akhir">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="penyedia">TOTAL TRANSAKSI </label>
                                <input type="number" class="form-control" name="total_minimal" placeholder="Total Minimal">
                                <input type="number" class="form-control mt-2" name="total_maksimal" placeholder="Total Maksimal">
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Batalkan</button>
                            <button type="submit" class="btn btn-primary btn-square">Filter</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <hr>

            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Penyedia</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Keterangan</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form_edit"  method="post" action="{{route('transaction.store')}}" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Pengadaan Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Supplier
                                            @if(sizeof($supplier)==0)
                                                <br>
                                                <small style="color: red;">Tidak Ada supplier! <a target="_blank" href="{{route('supplier.index')}}">tambahkan supplier</a></small>
                                            @endif
                                        </label>
                                        <select class="js-select2 form-control" id="penyedia-select2" name="supplier" style="width: 100%;" data-placeholder="Pilih Penyedia" required>
                                            @foreach($supplier as $list)
                                                <option value="{{$list->id}}">
                                                    {{$list->name_perusahaan}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Tanggal Transaksi</label>
                                        <input type="text" class="js-datepicker form-control datepicker" name="date" placeholder="Masukkan Tanggal Transaksi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="description" placeholder="Berikan Informasi Lebih">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-label">Total Harga</label>
                                            <input id="total_transaction" name="total_transaction"  value="0" type="number" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Foto Kwitansi  <small>(Opsional)</small>
                                        </label>
                                        <input type="file" id="upload" name="link_gambar" accept="image/*" data-max-size="1024" class="form-control">
                                        <div class="text-center">
                                            <img id="previewHolder" width="250px" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="po">PO</small></label>
                                        <div>
                                            <select  class="form-control js-select2" name="po" data-placeholder="Pilih PO" style="width: 100%;" id="po">
                                                <option></option>
                                                @foreach($po_available as $po)
                                                <option value="{{$po->id}}">{{$po->judul}} - {{$po->no_po}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div id="newItem">
                                <div class="form-group">
                                <label>
                                    @if(sizeof($itemstemplate)==0)
                                        <small style="color: red;">Tidak Ada Barang! <a target="_blank" href="{{route('items_template.index')}}">tambahkan barang</a></small>
                                    @endif
                                </label>
                                </div>
                            </div>

                            <div class="mt-3 mb-3 pb-2" id="loader">
                                <center>
                                    <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button type="submit" id="submit_update"  class="btn btn-primary btn-square">
                             <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        .error {
            color: red;
        }
    .modal-content {
        border-radius: 0;
    }
    .modal-lg {
        max-width: 80% !important;
    }
    tr {
        cursor: pointer;
    }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        datepicker();

        function datepicker() {
            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd',
            });
        }

        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });

        $('#cari-peyedia-select2').select2();

        $('#btnAddItems').on('click', function(){
            addBarang()
        });

        function addBarang(){
            $.ajax({
                url: "{{ url('/aset/transaction_add/items') }}",
                type: "get",
                dataType: "html",
                beforeSend:function() {
                    $('#spinner').removeClass('d-none');
                    $('#btnAddItems').addClass('d-none');
                },
                success:function(data) {
                    $('#newItem').append(data);
                    $('#spinner').addClass('d-none');
                    $('#btnAddItems').removeClass('d-none');
                    $('.barang-select2').select2();
                    removeItem();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log('ERROR');
                },
            });
        }

        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-wrapper');
                wrapper.remove();
            });

            $(".itemtemplate").on("change",function(){
                var price = $('option:selected', this).attr('data-price');
                $(this).parents('.item-wrapper').find('.total_price').val(price);
                var price = $(this).parents('.item-wrapper').find('.total_price').val();
                var jumlah = $(this).parents('.item-wrapper').find('.jumlah').val();
                $(this).parents('.item-wrapper').find('.subtotal').val(price*jumlah);
                count_total_transaction()
            }).change();

            $(".jumlah").on("change",function () {
                var price = $(this).parents('.item-wrapper').find('.total_price').val();
                var jumlah = $(this).val();
                $(this).parents('.item-wrapper').find('.subtotal').val(price*jumlah);
                count_total_transaction()
            });

            $(".total_price").on("change",function () {
                var jumlah = $(this).parents('.item-wrapper').find('.jumlah').val();
                var price = $(this).val();
                $(this).parents('.item-wrapper').find('.subtotal').val(price*jumlah);
                count_total_transaction()
            });

        }

        function count_total_transaction(){
            var total_transaction = 0;
            $('.subtotal').each(function (key, val) {
                total_transaction = total_transaction + parseInt($(this).val());
            });
            $('#total_transaction').val(total_transaction);
        }

        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $('#btnFilter').removeClass('d-none');
        });

    </script>
    <script>
        var table = $('.dataTable').DataTable({
            searching: true,
            ordering: false,
            processing: false,
            serverSide: true,
            bLengthChange: false,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: {
                url: '{{route('admin.transaction.json')}}',
                data: function (d) {
                    d.total_minimal = $('input[name=total_minimal]').val();
                    d.total_maksimal = $('input[name=total_maksimal]').val();
                    d.cari_peyedia = $('select[name=cari_peyedia]').val();
                    d.tanggal_awal = $('input[name=tanggal_awal]').val();
                    d.tanggal_akhir = $('input[name=tanggal_akhir]').val();
                }
            },
            columns: [
                { data: 'kode', name:'kode', searchable:true,},
                { data: 'name_perusahaan', name:'name_perusahaan',searchable:true},
                { data: 'date', name:'date',searchable:true},
                { data: 'total_price', name:'total_price',searchable:true},
                { data: 'description', name:'description',searchable:true},
                { data: 'name_admin', name:'name_admin',searchable:true},
            ],

            columnDefs: [{
                targets:   1,
                "render": function ( data, type, row, meta ) {
                    return row.supplier.name_perusahaan;
                }
            },{
                targets:   2,
                "render": function ( data, type, row, meta ) {
                    return date_manusia(data);
                }
            },{
                targets:   3,
                "render": function ( data, type, row, meta ) {
                    return convert_rupiah(data);
                }
            },{
                targets:   5,
                "render": function ( data, type, row, meta ) {
                    return row.user.name;
                }
            }

            ],


        });

        table.on( 'click', 'tbody td', function () {
            var kode = table.row(this).data().kode;
            $(location).attr('href', '{{url('aset/transaction')}}/'+kode);
        });

        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });
        // $("[data-type='search']").keyup(function(){
        //     table.search($(this).val()).draw() ;
        // })
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewHolder').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#upload").change(function() {
            readURL(this);
        });


        $('#po').on('select2:select', function(e){
            var id_po = $(this).val();
            $.ajax({
                type: "GET",
                url: BASE_URL + "/aset/transaction_add/items-po/"+id_po,
                dataType: "html",
                beforeSend:function() {
                    $('#spinner').removeClass('d-none');
                    $('#btnAddItems').addClass('d-none');
                },
                success:function(data) {
                    $('#newItem').append(data);
                    $('#spinner').addClass('d-none');
                    $('#btnAddItems').removeClass('d-none');
                    removeItem();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log('ERROR');
                },
            });
        });
    </script>
@endsection