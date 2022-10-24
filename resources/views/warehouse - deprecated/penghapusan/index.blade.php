@extends('warehouse.layouts.main')

@section('title')
Gudang Penghapusan
@endsection

@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Penghapusan</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" id="new">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Penghapusan Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST" action="{{url('gudang/penghapusan')}}" id="formFilter">
                        {!!csrf_field()!!}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">TANGGAL </label>
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" value="{{$tanggal_awal}}" autocomplete="off">
                                    <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" value="{{$tanggal_akhir}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Tutup</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                                <span>&nbsp;</span>
                                <button type="submit" class="btn btn-primary btn-square">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="penghapusan">
                <thead>
                    <tr>
                        <th width="30px">ID</th>
                        <th width="120px">Tanggal</th>
                        <th width="150px">Keterangan</th>
                        <th width="80px">Detail</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('gudang/penghapusan')}}/new" id=form-pengadaan>
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Penghapusan Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih">
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5">
                            <div id="newItem">
                                <div class="row mt-3 item-wrapper">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="penyedia">Nama Barang </label>
                                            <div>
                                                <select class="js-select2 form-control" id="template-select2-1" name="template[]" style="width: 100%;">
                                                    <option value="">Cari Barang</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyedia">Kadaluarsa </label>
                                            <div>
                                                <select class="js-select2 form-control" id="barang-select2-1" name="barang[]" onchange="changeJumlah(1)" style="width: 100%;">
                                                    <option value="">Pilih Barang</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="penyedia">Jumlah </label>
                                            <div>
                                                <input type="number" class="form-control" id="jumlah-1" name="jumlah[]" placeholder="Jumlah">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="penyedia">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </label>
                                            <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove" disabled="disabled">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
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
                        <button type="button" class="btn btn-secondary btn-square" id="close">Batalkan</button>
                        <button type="submit" class="btn btn-primary btn-square">
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
    .modal-content {
        border-radius: 0;
    }
    /*.modal-lg {
        max-width: 80% !important;
    }*/
    .modal-full {
        min-width: 100%;
        margin: 0;
    }

    .modal-full .modal-content {
        min-height: 100vh;
    }
    .clickable-row {
        cursor: pointer;
    }
    div.dataTables_wrapper div.dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0;
    }
    .panel-default {
        border-color: #eaecee !important;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();

            if (tanggal_awal == "" && tanggal_akhir == "") {
                $('#filter-data').addClass('d-none');
                $('#btnFilter').removeClass('d-none');
            } else {
                $('#filter-data').removeClass('d-none');
                $('#btnFilter').addClass('d-none');
                $('#pengadaan_wrapper').addClass('mt-50');
            }

        });

        $('#new').on('click', function(){
            $('#modal-large').modal('show');
        });

        $('#close').on('click', function(){
            $('#modal-large').modal('hide');
        });

        datepicker();
        function datepicker() {
            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
        }

        $('#barang-select2-1').select2();
        $('#template-select2-1').select2({
            ajax: {
                url: API_URL+"/gudang/item/get",
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
            placeholder: "Cari Barang",
            templateResult: formatBarang,
            templateSelection: formatBarangSelection
        });

        var table = $('#penghapusan').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ordering: false,
            autoWidth: false,
            language: {
                processing: '<div class="panel panel-default"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></div>'
            },
            ajax: {
                url: "{{ url('/gudang/penghapusan/load-data') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {
                    tanggal_awal : function() {
                        return $('#tanggal_awal').val();
                    },
                    tanggal_akhir : function() {
                        return $('#tanggal_akhir').val();
                    }
                }
            }
            /*createdRow: function(row, data, dataIndex) {
                var a = $(row).find('input').val();
                var url = "{{url('gudang/penghapusan')}}/";
                var slug = url+a;
                $(row).addClass('clickable-row');
                $(row).attr('data-href', slug);
            },
            initComplete: function(settings, json) {
                $(".clickable-row").on('click', function() {
                    window.location = $(this).data("href");
                });
            }*/
        });
        
        counter = 1;
        $('#btnAddItems').on('click', function(){
            counter++;
            str = `<div class="row item-wrapper">
                        <div class="col-md-5">
                            <div class="form-group">
                                <div>
                                    <select class="js-select2 form-control" id="template-select2-`+counter+`" name="template[]" style="width: 100%;">
                                        <option value="">Cari Barang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <select class="js-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" onchange="changeJumlah(`+counter+`)" style="width: 100%;">
                                        <option value="">Pilih Barang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div>
                                    <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>`;
            $('#newItem').append(str);
            $('#barang-select2-'+counter).select2();
            $('#template-select2-'+counter).select2({
                ajax: {
                    url: API_URL+"/gudang/item/get",
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
                placeholder: "Cari Barang",
                templateResult: formatBarang,
                templateSelection: formatBarangSelection
            });
            removeItem();
        });

        function formatBarang (item) {
            if (item.loading) {
                return item.text;
            }
            var stok = 0;
            if(item.stok)
                stok = item.stok.aggregate;
            var markup = item.nama + " ("+item.satuan+") || Stok = " + stok;

            return markup;
        }

        function formatBarangSelection (item) {
            var stok;
            if(item.nama){
                if(item.stok)
                    stok = item.stok.aggregate;
                else
                    stok = item.stok;
                return item.nama + " ("+item.satuan+") || Stok = " + stok;
            }
            else return item.text;
        }

        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-wrapper');
                wrapper.remove();
            });
        }

        $('#newItem').on('select2:select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.slice(-1);
            console.log(data);
            
            if(!data.element) changeItems(ideas);
        });

        function changeItems(index) {
            $("#barang-select2-"+index).children('option').remove();
            temp = $('#template-select2-'+index).val();
            var url = "{{ url('/api/gudang/item/active') }}/"+temp;            

            $.get( url , function( data ) {
                if(data.length == 0) {
                    $("#barang-select2-"+index).append('<option>Belum ada barang</option>');
                    $("#jumlah-"+index).val('');
                    $("#jumlah-"+index).prop('max',0);
                }
                for(var key in data)
                {
                    row = data[key];
                    $("#barang-select2-"+index).append('<option value="'+row.id+'" data-max="'+row.jumlah+'">'+formatDate(row.kadaluarsa)+'</option>');
                    if(key==0) {
                        $("#jumlah-"+index).val(row.jumlah);
                        $("#jumlah-"+index).prop('max',row.jumlah);
                    }
                }
            });
            
            //$('#harga-'+index).val(harga);
        }

        function changeJumlah(index) {
            max = $("#barang-select2-"+index).find(':selected').data('max');
            $("#jumlah-"+index).val(max);
            $("#jumlah-"+index).prop('max', max);

        }

        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $(this).parents('.block-content').find('#pengadaan_wrapper').addClass('mt-50');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $(this).parents('.block-content').find('#pengadaan_wrapper').removeClass('mt-50');
            $('#btnFilter').removeClass('d-none'); 
        });

        $('#btnReset').on('click', function(e) {
            $('#tanggal_awal').val(null).trigger('change');
            $('#tanggal_akhir').val(null).trigger('change');
            document.getElementById("formFilter").submit();
        });
    </script>

    <script type="text/javascript">
        var BeFormValidation = function() {
            var initValidationBootstrap = function(){
                jQuery('#form-pengadaan').validate({
                    ignore: [],
                    errorClass: 'invalid-feedback animated fadeInDown',
                    errorElement: 'div',
                    errorPlacement: function(error, e) {
                        jQuery(e).parents('.form-group > div').append(error);
                    },
                    highlight: function(e) {
                        jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                    },
                    success: function(e) {
                        jQuery(e).closest('.form-group').removeClass('is-invalid');
                        jQuery(e).remove();
                    },
                    rules: {
                        'barang[]': {
                            required: true,
                        },
                        'jumlah[]': {
                            required: true,
                        },
                        'template[]': {
                            required: true,  
                        }
                    },
                    messages: {
                        'template[]': 'Kolom ini wajib diisi',
                        'barang[]': 'Kolom ini wajib diisi',
                        'jumlah[]': 'Jumlah tidak valid'                        
                    }
                });
            };

            return {
                init: function () {
                    initValidationBootstrap();
                    jQuery('.js-select2').on('change', function(){
                        jQuery(this).valid();
                    });
                }
            };
        }();

        jQuery(function(){ BeFormValidation.init(); });
    </script>
@endsection