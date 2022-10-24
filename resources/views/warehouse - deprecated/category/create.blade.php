@extends('layouts.main',['app' => "warehouse"])

@section('title')
Barang - Pergudangan - Medify
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
            Kategori Barang<br>
            <small>
                Tambah Kategori Baru
            </small>
        </div>
    </div>
    <div class="card stacked-form">
        <form id="wizardForm" method="POST" action="{{url('warehouse/category/new')}}">
            {!! csrf_field() !!}            
            <div class="card-header">
                <h5 class="card-title text-center">Mohon cek kembali data dengan benar</h5>
            </div>
            <div class="card-body">                    
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label">Nama Kategori
                                <small>Opsional</small>
                            </label>
                            <input type="text" class="form-control" name="name" placeholder="Isikan Nama Kategori">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="control-label"> Pilih Barang
                                <star class="star">*</star>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" id="searchBar" placeholder="Cari Barang">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button">
                                        <i class="fa fa-search" aria-hidden="true" id="searchButton" onclick="riset(0); search()"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="hasilSearch">
                    @foreach($items as $item)
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input" name="items[]" value="{{$item->id}}">
                            {{$item->name}}
                        </div>
                    </div>
                    @endforeach
                </div> 
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="form-group">
                            <small><b>Catatan :</b></small>
                            <br>
                            <small><star class="star">(*)</star> Kolom wajib diisi</small> <br>
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
        });

        function search() {
            var str = "";
            mode = 1;
            var key = $('#searchBar').val();

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/item/search")}}/' + key,
                dataType: 'json',
                beforeSend: function() {
                    console.log("loading...");
                    var loadingScreen = 
                        '<div class="loader center" id="loader-4" style="margin: 0 auto;">' +
                            '<span></span>' +
                            '<span></span>' +
                            '<span></span>' +
                        '</div>';
                    $('#hasilSearch').html(loadingScreen);
                },
                success:function(data){
                    data.data.forEach(function(item) {
                        console.log(item);
                    str += `<div class="col-md-3" style="margin-bottom: 25px;">
                            <a href="{{url('warehouse/supplier/`+item.slug+`')}}">
                            <div class="card-custom card-inverse-custom card-info-custom">
                                <img class="card-img-top-custom" src="` 
                                if(item.foto != null) str += `{{asset('`+item.foto+`')}}`;
                                else str += `assets/app/Warehouse/supplier/no_image.png'`; str+= `" style="padding: 15px;" onerror="imgError(this);">
                                <div class="card-block-custom">
                                    <h4 class="card-title">`+item.nama+`</h4>
                                    <p class="card-category">`+item.jenis+`</p>
                                    <hr>
                                    <div class="meta card-text-custom">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> `+item.alamat+`
                                    </div>
                                    <div class="card-text-custom">
                                        <i class="fa fa-phone text-muted"></i> `+item.telepon+`
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>`;
                        //console.log(item);
                    });

                    document.getElementById("hasilSearch").innerHTML = str;
                    navigate(0, data.count);
                    //$("#transaksiDetails").html(data.msg);
                },
                error:function(data){
                    console.log(data);
                }
            });
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
                    name: {
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
                    name: {
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

    </script>
@endsection

@section('angular')
    <script type="text/javascript">
    </script>
@endsection