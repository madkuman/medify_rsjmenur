@extends('farmasi.layouts.main')

@section('title')
Farmasi Barang Stok Kosong
@endsection

@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Barang (Stok Tipis)</h3>
            <!-- <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Barang Baru
                </button>
            </div> -->
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/item-stok')}}" id="formFilter">
                        {!!csrf_field()!!}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NAMA BARANG </label>
                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="{{$nama_barang}}">
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">KATEGORI </label>
                                    <select class="js-example-basic-multiple form-control" id="kategori-select2" name="kategori[]" multiple="multiple" style="width: 100%;">
                                        
                                        @foreach($gorilla as $gori)
                                            <option value="{{$gori->id}}"
                                                @if($kategori)
                                                    @foreach($kategori as $tego) 
                                                        @if($gori->id == $tego) selected @endif
                                                    @endforeach
                                                @endif>{{$gori->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">HARGA BELI </label>
                                    <input type="number" class="form-control" name="harga_barang_minimal" id="harga_barang_minimal" placeholder="Harga Minimal" value="{{$harga_barang_minimal}}">
                                    <input type="number" class="form-control mt-2" name="harga_barang_maksimal" id="harga_barang_maksimal" placeholder="Harga Maksimal" value="{{$harga_barang_maksimal}}">
                                </div>
                            </div>
                            <!-- <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">TANGGAL </label>
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal">
                                    <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir">
                                </div>
                            </div> -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">STOK </label>
                                    <input type="number" class="form-control" name="stok_minimal" id="stok_minimal" placeholder="Minimal" value="{{$stok_minimal}}">
                                    <input type="number" class="form-control mt-2" name="stok_maksimal" id="stok_maksimal" placeholder="Maksimal" value="{{$stok_maksimal}}">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right mt-15">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Batalkan</button>
                                <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                                <button type="submit" class="btn btn-primary btn-square">
                                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="items">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="d-none d-sm-table-cell">Nama Barang</th>
                        <th class="d-none d-sm-table-cell">Stok</th>
                        <th class="d-none d-sm-table-cell">Harga Beli</th>
                        <th class="d-none d-sm-table-cell">Expired</th>
                        <th class="d-none d-sm-table-cell">Kategori</th>
                        <th class="d-none d-sm-table-cell">Detail</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        .inline {
            display: inline;
        }
        .modal-content {
            border-radius: 0;
        }
        .clickable-row {
            cursor: pointer;
        }
        .mt-70 {
            margin-top: 70px !important;
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
        $('#kategori-select2').select2();

        var table = $('#items').DataTable({
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
                url: "{{ url('/farmasi/'.session('farmasi')->slug.'/item/load-stok') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {
                    farmasi : function() {
                        return "{{session('farmasi')->slug}}";
                    },
                    nama_barang : function() {
                        return $('#nama_barang').val();
                    },
                    stok_minimal : function() {
                        return $('#stok_minimal').val();
                    },
                    stok_maksimal : function() {
                        return $('#stok_maksimal').val();
                    },
                    harga_barang_minimal : function() {
                        return $('#harga_barang_minimal').val();
                    },
                    harga_barang_maksimal : function() {
                        return $('#harga_barang_maksimal').val();
                    },
                    kategori : function() {
                        return $('#kategori-select2').val();
                    }
                }
            }
        });

        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $(this).parents('.block-content').find('#items_wrapper').addClass('mt-70');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $(this).parents('.block-content').find('#items_wrapper').removeClass('mt-70');
            $('#btnFilter').removeClass('d-none'); 
        });

        $('#btnReset').on('click', function(e) {
            $('#nama_barang').val(null).trigger('change');
            $('#stok_maksimal').val(null).trigger('change');
            $('#stok_minimal').val(null).trigger('change');
            $('#harga_barang_maksimal').val(null).trigger('change');
            $('#harga_barang_minimal').val(null).trigger('change');
            $('#kategori-select2').val(null).trigger('change');
            $('#warning_stok').prop('checked', false);
            $('#warning_kadaluarsa').prop('checked', false);
            document.getElementById("formFilter").submit();
        });
    </script>
@endsection