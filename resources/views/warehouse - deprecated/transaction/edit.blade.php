@extends('layouts.main',['app' => "warehouse"])

@section('title')
Transaksi - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')
    <div class="row page-title-container">
        <div class="icon">
            <i class="fa fa-pencil"></i>
        </div>
        <div class="title">
            Verifikasi Transaksi<br>
            <small>
                {{$transaction->category}} - {{$transaction->slug}}
            </small>
        </div>
    </div>
    <div class="card stacked-form">
        <form id="wizardForm" method="POST" action="{{action('Warehouse\Transaction\EditController@confirm')}}">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{$transaction->id}}">
            <div class="card-header">
                <h5 class="card-title text-center">Mohon cek kembali data dengan benar</h5>
            </div>
            <div class="card-body">                    
                <div class="row justify-content-center hidden">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Pilih Jenis Transaksi 
                                <star class="star">*</star>
                            </label>
                            <select class="selectpicker" data-style="btn-default btn-outline" data-width="130px" name="type" onchange="changeCategory()" id="jenisTransaksi">
                                <option selected disabled="">Pilih</option>
                                <option value="1" data-content='' @if($transaction->type==1) selected='true' @endif>Masuk
                                </option>
                                <option value="-1" data-content='' @if($transaction->type==-1) selected='true' @endif>Keluar
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Asal Barang
                                <star class="star">*</star>
                            </label>
                            <select class="selectpicker" data-style="btn-default btn-outline" data-live-search="true" data-width="100%" data-size="4" name="client">
                                <option selected disabled="">Pilih</option>
                                @foreach($supplier as $item)
                                <option value="{{$item->id}}" @if($transaction->client==$item->id) selected='true' @endif>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Nomor Struk
                                <small>Opsional</small>
                            </label>
                            <input type="text" class="form-control" name="referral_number" placeholder="Isikan Nomor Struk" value="{{$transaction->referral_number}}">
                        </div>
                    </div>
                </div> --}}
                <div class="row justify-content-center hidden">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Kategori Transaksi
                                <star class="star">*</star>
                            </label>
                            <select class="selectpicker" data-style="btn-default btn-outline" name="category" id="kategori">
                                <option disabled>Pilih</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Keterangan Transaksi
                                <small>Opsional</small>
                            </label>
                            <textarea name="description" class="form-control" placeholder="Isikan Keterangan Transaksi" rows="5" >{{$transaction->description}}</textarea>
                        </div>
                    </div>
                </div>
                {{-- <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Bukti Nota 
                                <small>Opsional</small>
                            </label>
                            <div class="preview-zone" style="text-align: center;">
                                <div class="box box-solid">
                                    <div class="box-header with-border" style="border-bottom: 1px solid #333;">
                                        <div>Preview</div>
                                    </div>
                                    <div class="box-body" style="padding: 20px;">
                                        <div class="pull-right">
                                            <button type="button" class="btn btn-sm btn-warning edit-preview" title="Tekan untuk mengubah gambar ini"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="preview-img">
                                            <img src="{{asset($transaction->foto)}}" id="preview" height="200" class="img-responsive img-rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="inputImg" name="image" class="form-control hidden change-img" style="margin-bottom: 20px;" value="">
                        </div>
                    </div>
                </div> --}}
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label"> Pilih Barang
                                <star class="star">*</star>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"> Jumlah
                                        <star class="star">*</star>
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Perkiraan Harga
                                    </label>
                                </div>
                            </div> --}}
                            <div class="col-md-3">
                                {{-- <button type="button" class="btn btn-danger remove-item" title="Tekan untuk menghapus item">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @php $i = 1; @endphp
                <div id="item">
                    <div class="row justify-content-center">
                        @foreach($transaction->transaction_detail as $detail)
                        <div class="col-md-5">
                            <div class="form-group error-stock" id="items_form_group_{{$i}}">
                                {{-- <select class="selectpicker" id="selectBarang{{$i}}" onchange="cekStok({{$i}})" data-style="btn-default btn-outline" data-width="100%" name="items[{{$i}}]" data-live-search="true">
                                    <option value="">Pilih</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}" data-price="{{$item->price}}" data-qty="{{$item->qty_ready}}" @if($item->id == $detail->item_id) selected="true" @endif>{{$item->name}} (Stok = {{$item->qty_ready}})</option>
                                    @endforeach
                                </select> --}}
                                <select id="selectBarang{{$i}}" class="selectpicker2" data-style="btn-default btn-outline" data-live-search="true" name="items[{{$i}}]" onchange="cekStok({{$i}})" data-width="100%">
                                    <option value="{{$detail->item_id}}" data-price="{{$detail->item_detail->price}}" data-qty="{{$detail->item_detail->qty_ready}}" data-subtext="Stok Barang : {{$detail->item_detail->qty_ready}}">{{$detail->item_detail->name}}</option>
                                </select>
                                <small id="cekStok{{$i}}" class="form-text" style="color: #FB404B;"></small>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" id="jumlah{{$i}}" class="form-control" placeholder="Jumlah" onkeyup="cekStok({{$i}})" onchange="cekStok({{$i}})" value="{{$detail->qty}}" name="qty[{{$i}}]">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    {{-- <div class="form-group">
                                        <label class="control-label" id="sub{{$i}}"></label>
                                    </div> --}}
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger remove-item" title="Tekan untuk menghapus item">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                    </div> 
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-2 col-md-offset-5">
                        <div class="center">
                            <button type="button" class="btn btn-primary btn-wd" id="btnAdd">
                                <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data Barang
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <small><b>Catatan :</b></small>
                            <br>
                            <small><star class="star">(*)</star> Kolom wajib diisi</small> <br>
                            <small>Anda akan membuat transaksi baru, jika transaksi telah dibuat maka stok barang yang telah terpilih akan berubah. <br>
                            Anda tidak dapat membatalkan transaksi kecuali admin pada sistem gudang ini</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="pull-right">
                    <button type="submit" id="saveBtn" class="btn btn-primary btn-wd btn-finish" onclick="onFinishWizard()">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
    
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

        .btn.disabled, .btn:disabled {
            cursor: not-allowed;
            opacity: .40;
        }

        .btn-primary.disabled, .btn-primary:disabled {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Init Wizard
            initLBDWizard();
            //changeCategory();
            @if (session('status')) {
                swal('Gagal', '{{(session('status'))}}', 'error');
            }
            @endif
        });

        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "form_changed";
        input.value = 0;
        $('#item').append(input);

        var x = {{$i}}-1;
        var mode = 1;
        $('#btnAdd').on('click', function() {
            x++;
            console.log(x);
            var row = 
            '<div class="row justify-content-center item">' +
                '<div class="col-md-5">' +
                    '<div class="form-group error-stock" id="items_form_group_'+x+'">' +
                        '<select id="selectBarang'+x+'" class="selectpicker2" data-style="btn-default btn-outline" ' +
                        'data-live-search="true" name="items['+x+']" onchange="cekStok('+x+')" data-width="100%">' +
                        '</select>' +
                        '<small id="cekStok'+x+'" class="form-text" style="color: #FB404B;"></small>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-5">' +
                    '<div class="row">' +
                        '<div class="col-md-4">' +
                            '<div class="form-group">' +
                                '<input type="number" class="form-control" id="jumlah'+x+'" placeholder="Jumlah" onkeyup="cekStok('+x+')" onchange="cekStok('+x+')" name="qty['+x+']">' +
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
            $('.selectpicker').selectpicker('refresh');

            $('.selectpicker2').selectpicker().ajaxSelectPicker({
                ajax: {
                    {{-- url: '{{asset('js/dataset.json')}}', --}}
                    url: '{{url('warehouse/item/list')}}',
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
                                    subtext: "Stok Barang : " + item.qty_ready,
                                    qty: item.qty_ready
                                }
                            }));
                        //}
                    });
                    return arr;
                }
            });
            initLBDWizard();
            $('input[name=form_changed]').val(1);
        });

        $('#item').on('click', '.remove-item-new', function() {
            $(this).closest('.item').remove();
            disableButton();
        });

        function changeSubtotal(index) {
            //var barang = document.getElementById("selectBarang"+index);
            console.log(index);
            var harga_barang = $('#selectBarang'+index).find(":selected").data('price');
            var jumlah = document.getElementById("jumlah"+index).value;            
            var subtotal = harga_barang * jumlah;
            console.log(harga_barang);
            document.getElementById("sub"+index).innerHTML = "Rp " + subtotal;
        };

        function cekStok(index) {
            //var barang = document.getElementById("selectBarang"+index);
            var str = "";
            var itemError = $('.error-stock');
            var flag;

            document.getElementById("cekStok"+index).innerHTML = str;
            //if(mode) return;
            
            var stok_barang = $('#selectBarang'+index).find(":selected").data('qty');
            var jumlah = document.getElementById("jumlah"+index).value;            
            console.log(stok_barang);
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

        function changeCategory() {
            var type = $('#jenisTransaksi').val();
            var select = document.getElementById("kategori");
            var kategori = "{{$transaction->category}}";

            if(type == 1) {
                mode = 1;
                select.options[0] = null;    
                select.options.add(new Option("Beli", "Beli"));
                select.options.add(new Option("Retur", "Retur"));
                if(kategori == 'Retur') select.selectedIndex = 1;
            } else {
                mode = 0;
                select.options[0] = null;
                select.options[0] = null;
                select.options.add(new Option("Permintaan", "Permintaan"));
            }
            for (var i = 1; i <= x; i++) {
                if(document.getElementById("jumlah"+i) != null) 
                {
                    cekStok(i);
                    changeSubtotal(i);
                }
            }
            disableButton();

            $('.selectpicker').selectpicker('refresh');
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
                    var boxZone = $(input).parent().find('.preview-zone').find('.box').find('.box-body').find('.preview-img');
                    previewZone.removeClass('hidden');
                    boxZone.empty();
                    boxZone.append(preview);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('.selectpicker2').selectpicker().ajaxSelectPicker({
            ajax: {
                {{-- url: '{{asset('js/dataset.json')}}', --}}
                url: '{{url('warehouse/item/list')}}',
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
                                subtext: "Stok Barang : " + item.qty_ready,
                                qty: item.qty_ready
                            }
                        }));
                    //}
                });
                return arr;
            }
        });

        function resetImg(e) {
            //console.log(e);
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $('.change-img').change(function() {
            //console.log(this);
            readImage(this);
        });

        $('.edit-preview').on('click', function() {
            var previewZone = $(this).parents('.preview-zone');
            var input = $(this).parents('.form-group').find('#inputImg');
            var changeImg = $(this).parents('.form-group').find('.change-img');

            previewZone.addClass('hidden');
            input.removeClass('hidden');
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

        $("form :input").change(function() {
            $('input[name=form_changed]').val(1);
        });

        $('.selectpicker2').selectpicker().ajaxSelectPicker({
            ajax: {
                {{-- url: '{{asset('js/dataset.json')}}', --}}
                url: '{{url('warehouse/item/list')}}',
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
                                subtext: "Stok : " + item.qty_ready,
                                qty: item.qty_ready
                            }
                        }));
                    //}
                });
                return arr;
            }
        });
    </script>
@endsection

@section('angular')
    <script type="text/javascript">
    </script>
@endsection