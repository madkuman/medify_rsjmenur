@extends('warehouse.layouts.main')

@section('title')
Gudang Distribusi
@endsection

@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Distribusi Barang</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Distribusi Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST" action="{{url('gudang/distribusi')}}" id="formFilter">
                        {!!csrf_field()!!}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>UNIT TUJUAN </label>
                                    <select class="js-select2 form-control" id="cari-unit-select2" name="cari_unit" style="width: 100%;">
                                        <option>Semua Unit</option>
                                        @foreach($pharmacy as $pharm)
                                            <option value="{{$pharm->id}}" @if($pharm->id == $unit_tujuan) selected @endif>{{$pharm->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>KATEGORI </label>
                                    <select class="js-select2 form-control" id="kategori-select2" name="kategori" style="width: 100%;">
                                        <option>Semua Kategori</option>
                                        <option value="Permintaan" {{($kategori == "Permintaan") ? "selected" : "" }}>Permintaan</option>
                                        <option value="Kiriman" {{($kategori == "Kiriman") ? "selected" : "" }}>Kiriman</option>
                                        <option value="Retur" {{($kategori == "Retur") ? "selected" : "" }}>Retur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>TANGGAL AWAL</label>
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" id="tanggal_awal" value="{{$tanggal_awal}}" placeholder="Tanggal Awal" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>TANGGAL AKHIR</label>
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_akhir" id="tanggal_akhir" value="{{$tanggal_akhir}}" placeholder="Tanggal Akhir" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <label for="penyedia">STATUS </label><br>
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="status_selesai" id="status_selesai" @if($status_selesai) checked @endif>
                                    <input type="hidden" name="selesai" value="1">
                                    <span class="css-control-indicator"></span> Selesai
                                </label><br>
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="status_konfirmasi" id="status_konfirmasi" @if($status_konfirmasi) checked @endif>
                                    <input type="hidden" name="konfirmasi" value="1">
                                    <span class="css-control-indicator"></span> Menunggu Konfimasi
                                </label>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Batalkan</button>
                                <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                                <button type="submit" class="btn btn-primary btn-square">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="distribusi">
                <thead>
                    <tr>
                        <th width="30px">ID</th>
                        <th width="100px">Unit Tujuan</th>
                        <th width="80px">Kategori</th>
                        <th width="160px">Waktu</th>
                        <th width="110px">Status</th>
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
            <form action="{{url('gudang/distribusi/new')}}" method="POST" id="form-distribusi">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Distribusi Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Unit Tujuan</label>
                                        <div>
                                            <select class="js-select2 form-control" id="unit-tujuan-select2" name="unit_tujuan" style="width: 100%;" data-placeholder="Pilih Tujuan" required="">
                                                <option></option>
                                                @foreach($pharmacy as $pharm)
                                                    <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jenis Distribusi</label>
                                        <select class="form-control" id="jenis-distribusi" name="type" style="width: 100%;" data-placeholder="Pilih Jenis" onchange="cekStok()">
                                            <option value="Kiriman">Kiriman</option>
                                            <!-- <option value="Permintaan">Permintaan</option>
                                            <option value="Retur">Retur</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih">
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div id="newItem">
                                <div class="row justify-content-center pt-15 item-wrapper">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="penyedia">Barang </label>
                                            <div>
                                                <h1 id="stok-hid-1" hidden></h1>
                                                <select class="js-select2 form-control" id="barang-select2-1" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang" required="">
                                                    <option></option>
                                                    
                                                </select>
                                                <p class="text-danger" id="alert-1" hidden>Stok kurang</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="penyedia">Jumlah </label>
                                            <div>
                                                <input type="number" class="form-control" id="jumlah-1" name="jumlah[]" placeholder="Jumlah" onchange="cekStok()" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="penyedia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                            <button type="button" class="btn btn-lg btn-outline-info btnStok" onclick="lihatStok(1)">
                                                Lihat Stok
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="penyedia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btn-square" id="saveBtn">
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
        .badge {
            width: 90px;
        }
        .clickable-row {
            cursor: pointer;
        }
        .modal-content {
            border-radius: 0;
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
        $('#cari-unit-select2').select2();
        $('#unit-tujuan-select2').select2();
        $('#kategori-select2').select2();
        $('#barang-select2-1').select2({
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

        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });

        var table = $('#distribusi').DataTable({
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
                url: "{{ url('/gudang/distribusi/load-data') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {
                    unit_tujuan : function() {
                        return $('#cari-unit-select2').val();
                    },
                    tanggal_awal : function() {
                        return $('#tanggal_awal').val();
                    },
                    tanggal_akhir : function() {
                        return $('#tanggal_akhir').val();
                    },
                    kategori : function() {
                        return $('#kategori-select2').val();
                    },
                    status : function() {
                        if($('#status_selesai').is(":checked"))
                        {
                            if($('#status_konfirmasi').is(":checked")) return 2;
                            else return 1;    
                        }
                        if($('#status_konfirmasi').is(":checked")) return 0;
                    }
                }
            }
        });

        datepicker();

        function datepicker() {
            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
        }

        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $('#filter-data').removeClass('d-none');
            $(this).parents('.block-content').find('#distribusi_wrapper').addClass('mt-50');
        });

        $('#btnReset').on('click', function(e) {
            $('#tanggal_awal').val(null).trigger('change');
            $('#tanggal_akhir').val(null).trigger('change');
            $('#unit-tujuan-select2n').val(null).trigger('change');
            $('#kategori-select2').val(null).trigger('change');
            $('#status_selesai').prop('checked', true);
            $('#status_konfirmasi').prop('checked', true);
            document.getElementById("formFilter").submit();
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $('#btnFilter').removeClass('d-none');
            $(this).parents('.block-content').find('#distribusi_wrapper').removeClass('mt-50');
        });

        var counter = 1;
        $('#btnAddItems').on('click', function(){
            counter++;
            str = 
            `<div class="row justify-content-center item-wrapper">
                <div class="col-md-5">
                    <div class="form-group">
                        <div>
                            <h1 id="stok-hid-`+counter+`" hidden></h1>
                            <select class="js-select2 barang-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang" required="">
                                <option></option>
                            </select>
                            <p class="text-danger" id="alert-`+counter+`" hidden>Stok kurang</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div>
                            <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah" onchange="cekStok()" required="">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-lg btn-outline-info btnStok" onclick="lihatStok(`+counter+`)">
                            Lihat Stok
                        </button>
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
            $('#barang-select2-'+counter).select2({
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

        $('#newItem').on('select2:select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.slice(-1);
            
            $('#stok-hid-'+ideas).text(data.stok);
            cekStok();
        });

        function cekStok() {
            flag = 0;
            if($('#jenis-distribusi').val() == 'Kiriman') {
                for(x=1; x<=counter; x++)
                {
                    stok = parseInt($('#stok-hid-'+x).text());
                    if(document.getElementById("jumlah-"+x) == null) continue;
                    jumlah = $('#jumlah-'+x).val();
                    console.log(jumlah);
                    if(jumlah>stok) 
                    {
                        flag++;
                        $('#alert-'+x).attr('hidden', false);
                    }
                    else $('#alert-'+x).attr('hidden', true);
                }
                if(flag > 0) $('#saveBtn').attr('disabled', true);
                else $('#saveBtn').attr('disabled', false);
            }
        }

        function lihatStok(index) {
            bar = $("#barang-select2-"+index).val();
            console.log(bar);
            var url = "{{ url('/gudang/item/stok') }}/"+bar;
            if(bar) popupwindow(url,'Stok Barang Tiap Farmasi',620,1000);

        }

        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-wrapper');
                wrapper.remove();
            });
        }
    </script>

@endsection