@extends('layouts.main',['app' => "warehouse"])

@section('title')
    Pengadaan - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')
    <div class="row page-title-container">
        <div class="icon">
            <i class="fa fa-plus"></i>
        </div>
        <div class="title">
            Tambah Pengadaan<br>
            <small>
                Anda akan membuat transaksi baru
            </small>
        </div>
    </div>
    <form id="wizardForm" enctype="multipart/form-data" method="POST" action="{{url('warehouse/pengadaan/new')}}">
        {!! csrf_field() !!}
        <div class="card card-wizard">
            <div class="card-body ">
                <input type="hidden" name="type" value="1" id="jenisTransaksi">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab1" data-toggle="tab" role="tab" aria-controls="tab1" aria-selected="true">Data Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab2" data-toggle="tab" role="tab" aria-controls="tab2" aria-selected="true">Tambah Stok Barang</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                        <h5 class="text-center">Mohon isi data dengan benar</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Pilih Kategori Transaksi 
                                        <star class="star">*</star>
                                    </label>
                                    <select class="selectpicker" data-style="btn-default btn-outline" data-width="130px" name="category">
                                        <!-- <option disabled>Pilih</option> -->
                                        <option value="Beli" selected data-content=''>Beli
                                        </option>
                                        <option value="Retur" data-content=''>Retur
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label" id="asal-tujuan">Asal Barang
                                        <star class="star">*</star>
                                    </label>
                                    <select id="client" class="selectpicker" id="client" data-style="btn-default btn-outline" data-live-search="true" data-width="100%" data-size="4" name="client" onchange="changeItem()">
                                        <option selected disabled="">Pilih</option>
                                        @foreach($supplier as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Kadaluarsa
                                    </label>
                                    <input type="text" class="form-control datepicker" name="expired_date" placeholder="Tanggal Kadaluarsa Barang">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Nomor Struk
                                        <small>Opsional</small>
                                    </label>
                                    <input type="text" class="form-control" name="referral_number" placeholder="Isikan Nomor Struk">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Keterangan Transaksi
                                        <small>Opsional</small>
                                    </label>
                                    <textarea name="description" class="form-control" placeholder="Isikan Barang Tertukar" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label">Bukti Nota 
                                        <small>Opsional</small>
                                    </label>
                                    <div class="preview-zone hidden" style="text-align: center;">
                                        <div class="box box-solid">
                                            <div class="box-header with-border" style="border-bottom: 1px solid #333;">
                                                <div>Preview</div>
                                            </div>
                                            <div class="box-body" style="padding: 20px;">
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-sm btn-danger remove-preview" title="Tekan untuk menghapus gambar ini"><i class="fa fa-times"></i></button>
                                                </div>
                                                <div class="preview-img"></div>
                                                {{-- <img width="200" src="{{asset('assets/app/warehouse/supplier/2.png')}}"/> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" id="inputImg" name="image" class="form-control change-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <h5 class="text-center">Mohon isi data dengan benar</h5>
                        <div id="item">
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group error-stock" id="items_form_group_1">
                                                <label class="control-label">Pilih Barang Masuk
                                                    <star class="star">*</star>
                                                </label>
                                                {{-- <select class="selectpicker selectBarang" id="selectBarang1" onchange="changeSubtotal(1,1)" data-style="btn-default btn-outline" data-width="100%" name="items[]" data-live-search="true">
                                                    <option value="">Pilih</option>
                                                    @foreach($items as $item)
                                                        <option value="{{$item->id}}" data-price="{{$item->price}}" data-qty="{{$item->qty_ready}}">{{$item->name}} (Stok = {{$item->qty_ready}})</option>
                                                    @endforeach 
                                                </select> --}}
                                                <select id="selectBarang1" class="selectpicker2" data-style="btn-default btn-outline" data-live-search="true" name="items[]" data-width="100%" onchange="changeSubtotal(1,1)"></select>
                                                <small id="cekStok1" class="form-text" style="color: #FB404B;"></small>
                                                {{-- <div id="cekStok1" ></div> --}}
                                            </div>  
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label">Harga
                                                    <star class="star">*</star>
                                                </label>
                                                <input type="number" id="harga1" class="form-control" placeholder="Harga" onkeyup="changeSubtotal(1,0)" onchange="changeSubtotal(1,0)" name="harga[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Jumlah
                                                    <star class="star">*</star>
                                                </label>
                                                <input type="number" id="jumlah1" class="form-control" placeholder="Jumlah" onkeyup="changeSubtotal(1,0)" onchange="changeSubtotal(1,0)" name="qty[]">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="control-label">Perkiraan Harga
                                                </label>
                                                <label class="control-label" id="sub1">
                                                </label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <button type="button" class="btn btn-danger remove-item" title="Tekan untuk menghapus item">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center" style="margin-top: 20px;">
                            <div class="col-md-2 col-md-offset-5">
                                <div class="center">
                                    <button type="button" class="btn btn-primary btn-wd" id="btnAdd">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data Barang
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center" style="margin-top: 50px;">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <small><b>Catatan :</b></small>
                                    <br>
                                    <small><star class="star">(*)<star> Kolom wajib diisi</small> <br>
                                    <small>Anda akan membuat transaksi baru, jika transaksi telah dibuat maka stok barang yang telah terpilih akan berubah. <br>
                                    Anda tidak dapat membatalkan transaksi kecuali admin pada sistem gudang ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-default btn-wd btn-back btn-previous pull-left">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                </button>
                <button type="button" class="btn btn-info btn-wd btn-next pull-right">
                    Selanjutnya <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
                <button type="submit" id="saveBtn" class="btn btn-primary btn-wd btn-finish pull-right" onclick="onFinishWizard()">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan
                </button>
                <div class="clearfix"></div>
            </div>
        </div>
    </form>
@endsection

@section('css')
    <style type="text/css">
        .card .header {
            padding: 15px 15px 0px;
            color: #333333;
            font-weight: 300;
            font-size: 22px;
        }

        .bootstrap-select.btn-group .dropdown-menu.inner {
            max-height: 200px !important;
        }

        .hidden {
            display: none;
        }

        /*.btn-primary:disabled {
            background-color: #0275d8;
            border-color: #0275d8;
        }*/

        .btn.disabled, .btn:disabled {
            cursor: not-allowed;
            opacity: .40;
        }

        .btn-primary.disabled, .btn-primary:disabled {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        /*.btn[disabled] {
            background-color: #0275d8;
            border-color: #0275d8;
        }*/

        /*.btn-primary:disabled, primary[disabled] {
            background-color: #0275d8;
            border-color: #0275d8;
        }*/

        /*.btn.disabled:hover {
            background-color: #333;
        }*/
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Init Wizard
            $('.datepicker').datetimepicker({
                format: 'MM/DD/YYYY',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });

            initLBDWizard();
            @if (session('status')) {
                swal('Gagal', '{{(session('status'))}}', 'error');
            }
            @endif
        });

        var x = 1;
        var mode = 1;
        var client = 0;
        $('#btnAdd').on('click', function() {
            x++;
            var row = 
            '<div class="row justify-content-center item" id="details'+x+'">' +
                '<div class="col-md-5">' +
                    '<div class="row">' +
                        '<div class="col-md-7">' +
                            '<div class="form-group error-stock" id="items_form_group_'+x+'">' +
                                '<select id="selectBarang'+x+'" class="selectpicker2" data-style="btn-default btn-outline" data-live-search="true" name="items[]" data-width="100%" onchange="changeSubtotal('+x+',1)"></select>' +
                                '<small id="cekStok'+x+'" class="form-text" style="color: #FB404B;"></small>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-5">' +
                            '<div class="form-group">' +
                                '<input type="number" id="harga'+x+'" class="form-control" placeholder="Harga" onkeyup="changeSubtotal('+x+',0)" onchange="changeSubtotal('+x+',0)" name="harga[]">' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-5">' +
                    '<div class="row">' +
                        '<div class="col-md-4">' +
                            '<div class="form-group">' +
                                '<input type="number" class="form-control" id="jumlah'+x+'" placeholder="Jumlah" onkeyup="changeSubtotal('+x+',0)" onchange="changeSubtotal('+x+',0)" name="qty[]">' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-5">' +
                            '<div class="form-group">' +
                                '<label class="control-label" id="sub'+x+'"></label>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-3">' +
                            '<div class="form-group">' +
                                '<button type="button" class="btn btn-danger remove-item-new" title="Tekan untuk menghapus item">' +
                                    '<i class="fa fa-times" aria-hidden="true"></i>' +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
            $('#item').append(row);
            $('.selectpicker2').selectpicker().ajaxSelectPicker({
                ajax: {
                    url: '{{url("warehouse/item/supplier")}}/' + client,
                    dataType: 'json',
                    type: 'get',
                    // jsonpCallback: 'truckingsimABS',
                },
                locale: {
                    emptyTitle: 'Cari Barang'
                },
                log: 3,
                preprocessData: function (data) {
                    // console.log(data[0].item_detail);
                    arr = [];
                    data.forEach(function(item) {
                        //if (item.item_detail.name.toLowerCase().indexOf(this.plugin.query) != -1) {
                            //console.log(data[i]);
                            arr.push($.extend(true, item, {
                                text: item.name,
                                value: item.id,
                                data: {
                                    subtext: "Stok Barang : "+ item.qty_ready,
                                    qty: item.qty_ready,
                                    price: item.price
                                }
                            }));
                        //}
                    });
                    return arr;
                }
            });
            //changeItem(x);
            $('.selectpicker').selectpicker('refresh');
            initLBDWizard();
        });

        $('#item').on('click', '.remove-item-new', function() {
            $(this).closest('.item').remove();
            disableButton();
        });

        function changeSubtotal(index, item) {
            //var barang = document.getElementById("selectBarang"+index);
            var harga_barang;
            var jumlah = 0;
            if(item) {
                harga_barang = $('#selectBarang'+index).find(":selected").data('price');
                $("#harga"+index).val(harga_barang);
            }

            harga_barang = $("#harga"+index).val();
            jumlah = document.getElementById("jumlah"+index).value;
            var subtotal = harga_barang * jumlah;
        
            document.getElementById("sub"+index).innerHTML = "Rp " + formatMoney(subtotal);
        };

        function cekStok(index) {
            //var barang = document.getElementById("selectBarang"+index);
            var str = "";
            var itemError = $('.error-stock');
            var flag;

            document.getElementById("cekStok"+index).innerHTML = str;
            if(mode) return;
            
            var stok_barang = $('#selectBarang'+index).find(":selected").data('qty');
            var jumlah = document.getElementById("jumlah"+index).value;            
            if(jumlah > stok_barang) {
                str = "Jumlah stok tidak mencukupi (Stok saat ini = "+stok_barang+")";
                document.getElementById("cekStok"+index).innerHTML = str;
            }else {
                document.getElementById("cekStok"+index).innerHTML = str;
            }
            disableButton();

        };

        function disableButton() {
            var flag = 0;
            for (var i = 1; i <= x; i++) {
                if(document.getElementById("jumlah"+i) != null)
                {
                    stok_barang = $('#selectBarang'+i).find(":selected").data('qty');
                    jumlah = document.getElementById("jumlah"+i).value;   

                    if (jumlah > stok_barang) {
                        flag++;
                    }    
                }
            }

            if (!flag || mode) {
                $('#saveBtn').attr('disabled', false);
                $('.error-stock').removeClass('has-error');
            } else {
                $('.error-stock').addClass('has-error');
                $('#saveBtn').attr('disabled', true);
            }
        }

        function riset() {
            for (var i = 2; i <= x; i++) {
                var zoe = document.getElementById("details"+i);
                if(zoe!=null) zoe.remove();
            }
            x = 1;

            changeItem(1);
            document.getElementById("jumlah1").value = "";
            document.getElementById("sub1").innerHTML = "";
        }

        function changeCategory() {
            var type = $('#jenisTransaksi').val();
            var select = document.getElementById("kategori");
            var kata = document.getElementById("asal-tujuan");
            var klien = document.getElementById("client");

            var length = klien.options.length;
            for (var i = 0; i < length; i++) {
                klien.options[0] = null;
            }
            klien.options.add(new Option("Pilih", "", true));
            klien.options[0].disabled = true;

            if(type == 1) {
                mode = 1;
                select.options[0] = null;    
                select.options.add(new Option("Beli", "Beli", true));
                select.options.add(new Option("Retur", "Retur", true));

                kata.innerHTML = 'Asal Barang <star class="star">*</star>';

                $.ajax({
                    type:'GET',
                    url:'{{url("warehouse/supplier/get")}}',
                    dataType: 'json',
                    success:function(data){
                        data.data.forEach(function(item) {
                            klien.options.add(new Option(item.nama, item.id, true));
                            klien.options[klien.options.length-1].setAttribute('data-price', item.price);
                            //console.log(select);
                        });
                        $('.selectpicker').selectpicker('refresh');
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
            } else {
                mode = 0;
                select.options[0] = null;
                select.options[0] = null;
                select.options.add(new Option("Permintaan", "Permintaan", true));

                kata.innerHTML = 'Tujuan Barang <star class="star">*</star>';

                $.ajax({
                    type:'GET',
                    url:'{{url("apotek/pharmacy/get")}}',
                    dataType: 'json',
                    success:function(data){
                        data.data.forEach(function(item) {
                            klien.options.add(new Option(item.nama, item.id, true));
                            klien.options[klien.options.length-1].setAttribute('data-price', item.price);
                            //console.log(select);
                        });
                        $('.selectpicker').selectpicker('refresh');
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
            }
            /*for (var i = 1; i <= x; i++) {
                if(document.getElementById("jumlah"+i) != null) cekStok(i);
            }
            disableButton();*/
            riset();

            $('.selectpicker').selectpicker('refresh');
            //document.getElementById("kategori").innerHTML = str;
        }

        function changeItem() {
            var type = $('#jenisTransaksi').val();
            client = $('#client').val();

            $('.selectpicker2').selectpicker().ajaxSelectPicker({
                ajax: {
                    url: '{{url("warehouse/item/supplier")}}/' + client,
                    dataType: 'json',
                    type: 'get',
                    // jsonpCallback: 'truckingsimABS',
                },
                locale: {
                    emptyTitle: 'Cari Barang'
                },
                log: 3,
                preprocessData: function (data) {
                    // console.log(data[0].item_detail);
                    arr = [];
                    data.forEach(function(item) {
                        //if (item.item_detail.name.toLowerCase().indexOf(this.plugin.query) != -1) {
                            //console.log(data[i]);
                            arr.push($.extend(true, item, {
                                text: item.name,
                                value: item.id,
                                data: {
                                    subtext: "Stok Barang : "+ item.qty_ready,
                                    qty: item.qty_ready,
                                    price: item.price
                                }
                            }));
                        //}
                    });
                    return arr;
                }
            });

            /*var select = document.getElementById("selectBarang"+index);
            var text;

            //console.log("cok");
            var length = select.options.length;
            console.log(length);
            for (var i = 0; i < length; i++) {
                select.options[0] = null;
            }
            select.options.add(new Option("Pilih", "", true));
            select.options[0].disabled = true;

            if(type == 1) {
                $.ajax({
                    type:'GET',
                    url:'{{url("warehouse/supplier/item")}}/' + client,
                    dataType: 'json',
                    success:function(data){
                        data.data.forEach(function(item) {
                            text = item.name + "(Stok = "+item.qty_ready+")";
                            select.options.add(new Option(text, item.id, true));
                            select.options[select.options.length-1].setAttribute('data-price', item.price);
                            //console.log(select);
                        });
                        $('.selectpicker').selectpicker('refresh');
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
            } else {
                var items = <?php echo json_encode($items); ?>;
                items.forEach(function(item) {
                    select.options.add(new Option(item.name, item.id, true));
                    select.options[select.options.length-1].setAttribute('data-price', item.price);
                    select.options[select.options.length-1].setAttribute('data-qty', item.qty_ready);
                });
                $('.selectpicker').selectpicker('refresh');
            }*/
            
            /*for (var i = 1; i <= x; i++) {
                if(document.getElementById("jumlah"+i) != null) cekStok(i);
            }*/
            //disableButton();

            
            //document.getElementById("kategori").innerHTML = str;
        }

        function readImage(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var preview = 
                        '<img width="200" src="' + e.target.result + '" />'+
                        '<p>' + input.files[0].name + '</p>';
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    console.log(previewZone);
                    var boxZone = $(input).parent().find('.preview-zone').find('.box').find('.box-body').find('.preview-img');
                    previewZone.removeClass('hidden');
                    boxZone.empty();
                    boxZone.append(preview);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetImg(e) {
            //console.log(e);
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $('.change-img').change(function() {
            //console.log(this);
            readImage(this);
        });

        $('.remove-preview').on('click', function() {
            //console.log("masuk");
            var boxZone = $(this).parents('.preview-zone').find('.box-body');
            var previewZone = $(this).parents('.preview-zone');
            var changeImg = $(this).parents('.form-group').find('.change-img');
            boxZone.empty();
            previewZone.addClass('hidden');
            resetImg(changeImg);
        });

        function initLBDWizard() {
            // Code for the Validator
            var $validator = $('#wizardForm').validate({
                rules: {
                    type: {
                        required: true,
                    },
                    client: {
                        required: true,
                    },
                    category: {
                        required: true,
                    },
                    expired_date: {
                        required: true,
                    },
                    "items[]": {
                        required: true,
                    },
                    "qty[]": {
                        required: true,
                    },
                },
                messages: {
                    type: {
                        required: "Kolom ini wajib di isi"
                    },
                    client: {
                        required: "Kolom ini wajib di isi"
                    },
                    category: {
                        required: "Kolom ini wajib di isi"
                    },
                    expired_date: {
                        required: "Kolom ini wajib di isi"
                    },
                    "items[]": {
                        required: "Kolom ini wajib di isi",
                    },
                    "qty[]": {
                        required: "Kolom ini wajib di isi",
                    },
                },
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function(element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },

                // errorPlacement: function(error, element) {
                //     $(element).parent('div').addClass('has-danger');
                //  }
            });

            // Wizard Initialization
            $('.card-wizard').bootstrapWizard({
                'tabClass': 'nav nav-pills',
                'nextSelector': '.btn-next',
                'previousSelector': '.btn-previous',

                onNext: function(tab, navigation, index) {
                    var $valid = $('#wizardForm').valid();
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    }
                },

                onInit: function(tab, navigation, index) {
                    //check number of tabs and fill the entire row
                    var $total = navigation.find('li').length;
                    var $wizard = navigation.closest('.card-wizard');

                    $first_li = navigation.find('li:first-child a').html();
                    $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                    $('.card-wizard .wizard-navigation').append($moving_div);

                    refreshAnimation($wizard, index);

                    $('.moving-tab').css('transition', 'transform 0s');
                },

                onTabClick: function(tab, navigation, index) {
                    var $valid = $('#wizardForm').valid();

                    if (!$valid) {
                        return false;
                    } else {
                        return true;
                    }
                },

                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index + 1;

                    var $wizard = navigation.closest('.card-wizard');
                    //console.log($current);

                    // If it's the last tab then hide the last button and show the finish instead
                    if ($current >= $total) {
                        $($wizard).find('.btn-next').hide();
                        $($wizard).find('.btn-finish').show();
                        $($wizard).find('.btn-previous').show();
                    } else {
                        $($wizard).find('.btn-next').show();
                        $($wizard).find('.btn-finish').hide();
                        $($wizard).find('.btn-previous').hide();
                    }

                    button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                    setTimeout(function() {
                        $('.moving-tab').text(button_text);
                    }, 150);

                    var checkbox = $('.footer-checkbox');

                    if (!index == 0) {
                        $(checkbox).css({
                            'opacity': '0',
                            'visibility': 'hidden',
                            'position': 'absolute'
                        });
                    } else {
                        $(checkbox).css({
                            'opacity': '1',
                            'visibility': 'visible'
                        });
                    }

                    refreshAnimation($wizard, index);
                }
            });


            // Prepare the preview for profile picture
            $("#wizard-picture").change(function() {
                readURL(this);
            });

            $('[data-toggle="wizard-radio"]').click(function() {
                wizard = $(this).closest('.card-wizard');
                wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
                $(this).addClass('active');
                $(wizard).find('[type="radio"]').removeAttr('checked');
                $(this).find('[type="radio"]').attr('checked', 'true');
            });

            $('[data-toggle="wizard-checkbox"]').click(function() {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).find('[type="checkbox"]').removeAttr('checked');
                } else {
                    $(this).addClass('active');
                    $(this).find('[type="checkbox"]').attr('checked', 'true');
                }
            });

            $('.set-full-height').css('height', 'auto');

            //Function to show image before upload

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(window).resize(function() {
                $('.card-wizard').each(function() {
                    $wizard = $(this);

                    index = $wizard.bootstrapWizard('currentIndex');
                    refreshAnimation($wizard, index);

                    $('.moving-tab').css({
                        'transition': 'transform 0s'
                    });
                });
            });

            function refreshAnimation($wizard, index) {
                $total = $wizard.find('.nav li').length;
                $li_width = 100 / $total;

                total_steps = $wizard.find('.nav li').length;
                move_distance = $wizard.width() / total_steps;
                index_temp = index;
                vertical_level = 0;

                mobile_device = $(document).width() < 600 && $total > 3;

                if (mobile_device) {
                    move_distance = $wizard.width() / 2;
                    index_temp = index % 2;
                    $li_width = 50;
                }

                $wizard.find('.nav li').css('width', $li_width + '%');

                step_width = move_distance;
                move_distance = move_distance * index_temp;

                $current = index + 1;

                if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
                    move_distance -= 8;
                } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
                    move_distance += 8;
                }

                if (mobile_device) {
                    vertical_level = parseInt(index / 2);
                    vertical_level = vertical_level * 38;
                }

                $wizard.find('.moving-tab').css('width', step_width);
                $('.moving-tab').css({
                    'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                    'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

                });
            }
        }
    </script>
@endsection

@section('angular')
    <script type="text/javascript">
    </script>
@endsection