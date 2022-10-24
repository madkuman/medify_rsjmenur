@extends('warehouse.layouts.main')

@section('title')
Gudang Barang
@endsection

@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Barang (Stok Tipis)</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Barang Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST" action="{{url('gudang/item-stok')}}" id="formFilter">
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
                                        <!-- <option>Pilih Kategori</option> -->
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

    <div class="modal" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('gudang/item')}}/new">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Barang Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                	<div class="form-group">
                                        <label for="penyedia">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Harga Pasar Barang</label>
                                        <input type="text" class="form-control" name="harga" placeholder="Harga Pasar Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Satuan</label>
                                        <input type="text" class="form-control" name="satuan" placeholder="Satuan Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Kategori Barang</label>
                                        <select class="js-example-basic-multiple form-control" name="kategori[]" placeholder="Pilih Kategori" multiple="multiple" style="width: 100%;">
                                            @foreach($gorilla as $gori)
                                                <option value="{{$gori->id}}">{{$gori->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penyedia">Jenis Barang</label>
                                        <select class="form-control" id="jenis-select2" name="jenis">
                                            <option value="Obat">Obat</option>
                                            <option value="Matkes">Matkes</option>
                                            <option value="Implan">Implan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Batasan Low Stock <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="batasan_stok" placeholder="Isi Batasan Low Stock">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Batasan Expired <small>(Opsional)</small></label>
                                        <div class="form-inline">
                                        	<input type="text" class="form-control mr-sm-2" name="batasan_kadaluarsa" placeholder="Isikan Angka">
                                        	<select class="form-control mr-sm-2" id="expired-select2" name="satuan_waktu" data-placeholder="Bulan">
                                                <option value="1">Hari</option>
	                                            <option value="30">Bulan</option>
	                                            <option value="365">Tahun</option>
	                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan Lebih Lanjut">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
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
    {{--  --}}
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
        table.dataTable {
            border-collapse: collapse !important;
        }
        .mt-66 {
            margin-top: 66px !important;
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
            var barang = $('#nama_barang').val();
            var stok_minimal = $('#stok_minimal').val();
            var stok_maksimal = $('#stok_maksimal').val();
            var harga_barang_minimal = $('#harga_barang_minimal').val();
            var harga_barang_maksimal = $('#harga_barang_maksimal').val();

            if (barang == "") {
                $('#filter-data').addClass('d-none');
                $('#btnFilter').removeClass('d-none');
            } else {
                $('#filter-data').removeClass('d-none');
                $('#btnFilter').addClass('d-none');
                $('#items_wrapper').addClass('mt-66');
            }

            $('#kategori-select2').select2();
            $('.js-example-basic-multiple').select2();
            
        });

        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });

        /*var table = $('#items').DataTable({
            searching: false,
            ordering: false,
            pageLength: 5,
            lengthChange: false,
        });*/

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
                url: "{{ url('/gudang/item/load-stok') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {
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
            $(this).parents('.block-content').find('#items_wrapper').addClass('mt-66');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $(this).parents('.block-content').find('#items_wrapper').removeClass('mt-66');
            $('#btnFilter').removeClass('d-none'); 
        });

        $('#btnReset').on('click', function(e) {
            $('#nama_barang').val(null).trigger('change');
            $('#stok_maksimal').val(null).trigger('change');
            $('#stok_minimal').val(null).trigger('change');
            $('#harga_barang_maksimal').val(null).trigger('change');
            $('#harga_barang_minimal').val(null).trigger('change');
            $('#kategori-select2').val(null).trigger('change');
            document.getElementById("formFilter").submit();
        });
    </script>
@endsection