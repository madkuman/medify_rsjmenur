@extends('aset.layouts.main')

@section('title')
Pengadaan #{{$transaction->id}}
@endsection


@section('content')
    <div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">Pengadaan #{{$transaction->id}}</h3>
            <div class="block-options">
            	<a target="_blank" href="{{route('admin.transaction.print',$transaction->kode)}}" class="btn btn-alt-warning btn-square">
	                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
	            </a>
                <button class="btn btn-alt-danger btn-square" data-toggle="modal" data-target="#modal-delete">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                </button>
                <button class="btn btn-alt-primary btn-square" data-toggle="modal" data-target="#modal-edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row">
            	<div class="col">
            		<label>PENYEDIA</label>
            		<h4 class="text-primary">@if($transaction->supplier){{$transaction->supplier->name_perusahaan}} @endif</h4>
            		<label>TANGGAL TRANSAKSI</label>
            		<h5>{{indonesian_date($transaction->date)}}</h5>
            		<label>KETERANGAN</label>
            		<p>{{$transaction->description}}</p>
                    <label>KODE</label>
                    <h4>{{  $transaction->kode }}</h4>
                    <label>TOTAL TRANSAKSI</label>
                    <h4>{{  formatCurrency($transaction->total_price) }}</h4>
            	</div>
                @if(isset($transaction->image_ori) && $transaction->image_ori!="")
                    <div class="col">
                        <label>FOTO KWITANSI</label>
                        <img src="{{url($transaction->image_ori)}}" alt="" style="width:100%;" />

                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $transactions = json_decode($transaction->json,true);
                ?>
                @if($transaction->json==NULL|$transaction->json==""|| sizeof($transactions)==0)
                @else
                    @foreach($transactions as $key => $list_transaction)
                        <tr>
                            <td>{{$list_transaction['id_template']}}</td>
                            <td>{{$list_transaction['nama_template']}}</td>
                            <td>{{$list_transaction['jumlah']}}</td>
                            <td>{{formatCurrency($list_transaction['harga_satuan'])}}</td>
                            <td>{{formatCurrency($list_transaction['subtotal'])}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

            <div class="mt-50">
                <label>DI BUAT OLEH</label>
                <h5 class="text-primary">{{$transaction->user->name}} - {{indonesian_date($transaction->created_at)}}</h5>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-edit" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form_edit"  method="post" action="{{route('transaction.update',$transaction->id)}}" enctype="multipart/form-data" >
                {{csrf_field()}}
                {!! method_field('patch') !!}
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
                                        <select class="js-select2 form-control mt-2 select2" id="cari-peyedia-select2" name="cari_peyedia" style="width: 100%;">
                                            @foreach($supplier as $list)
                                                <option @if($transaction->supplier_id==$list->id){{'selected'}}@endif value="{{$list->id}}">
                                                    {{$list->name_perusahaan}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Tanggal Transaksi</label>
                                        <input type="text" class="js-datepicker form-control datepicker" value="{{$transaction->date}}" name="date" placeholder="Masukkan Tanggal Transaksi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" value="{{$transaction->description}}" name="description" placeholder="Berikan Informasi Lebih">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-label">Total Harga</label>
                                            <input id="total_transaction" value="{{$transaction->total_price}}" name="total_transaction"  value="0" type="number" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Foto Kwitansi
                                        </label>
                                        <input type="file" id="upload" name="link_gambar" accept="image/*" data-max-size="1024" class="form-control">
                                        <div class="text-center">
                                            <img id="previewHolder" height="250px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div id="newItem">
                                <label>
                                    @if(sizeof($itemstemplate)==0)
                                        <small style="color: red;">Tidak Ada Barang! <a target="_blank" href="{{route('items_template.index')}}">tambahkan barang</a></small>
                                    @endif
                                </label>
                                <?php
                                $transactions = json_decode($transaction->json,true);
                                ?>
                                @if($transaction->json==NULL|$transaction->json==""|| sizeof($transactions)==0)
                                @else
                                    @foreach($transactions as $key => $list_transaction)
                                        <input type="hidden" name="before[]" value="{{$key}}">
                                    <div class="row mt-3 item-wrapper">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            @if($key==0)
                                            <label for="penyedia">Barang </label>
                                            @endif
                                            <select class="js-select2 select2 form-control itemtemplate barang-select2" name="itemtemplate[]" style="width: 100%;" data-placeholder="Pilih Barang" required>
                                                @foreach($itemstemplate as $list)
                                                    <option @if($list_transaction['id_template']==$list->id){{'selected'}}@endif value="{{$list->id}}" data-price="{{$list->price}}">
                                                        {{$list->name." - ".$list->merk." - ".$list->model}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            @if($key==0)
                                            <label for="penyedia">Harga Satuan </label>
                                            @endif
                                            <input type="number" value="{{$list_transaction['harga_satuan']}}" class="form-control total_price" name="total_price[]" placeholder="Harga Satuan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            @if($key==0)
                                            <label for="penyedia">Jumlah </label>
                                            @endif
                                            <input type="number" value="{{$list_transaction['jumlah']}}" step="any" class="form-control jumlah" name="jumlah[]" placeholder="Jumlah" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            @if($key==0)
                                            <label for="penyedia">Subtotal </label>
                                            @endif
                                            <input type="number" value="{{$list_transaction['subtotal']}}" class="form-control subtotal" name="subtotal[]" placeholder="Subtotal" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            @if($key==0)
                                            <br>
                                            @endif
                                            <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                        @endforeach
                                    @endif
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

    <div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Hapus Transaksi</h3>
                        </div>
                        <div class="block-content">
                            <p>Apakah Anda benar ingin menghapus item ini?</p>
                            <form  method="post" action="{{route('transaction.destroy',$transaction->id)}}">
                                {{csrf_field()}}
                                {!! method_field('delete') !!}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                                    <button type="submit" class="btn btn-danger btn-square">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
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
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
        .modal-lg {
            max-width: 80% !important;
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

        $('.barang-select2').select2();
        $('#cari-peyedia-select2').select2();

        function count_total_transaction(){
            var total_transaction = 0;
            $('.subtotal').each(function (key, val) {
                total_transaction = total_transaction + parseInt($(this).val());
            });
            $('#total_transaction').val(total_transaction);
        }

        $('#btnAddItems').on('click', function(){
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
        });

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

        var table = $('.dataTable').DataTable({
            ordering: false,
        });

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

        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e)
        {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });


        dengan_rupiah.value = formatRupiah(dengan_rupiah.value, 'Rp. ');

    </script>
@endsection