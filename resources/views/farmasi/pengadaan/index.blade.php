@extends('farmasi.layouts.main')

@section('title')
{{session('farmasi')->jenis_detail->nama != 'Gudang' ? 'Farmasi Pembelian' : 'Gudang Penerimaan'}}
@endsection

@section('css')
    <style type="text/css">
    .modal-content {
        border-radius: 0;
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
    #pengadaan_farmasi_filter {
        display: none;
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
    
    .pengadaan-table th
    {
        background-color:white;
        /*color:black;*/
    }
    </style>
@endsection

@section('content')
    <div class="block" style="min-height: 350px">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{session('farmasi')->jenis_detail->nama != 'Gudang' ? 'Pembelian' : 'Penerimaan'}}</h3>
            <div class="block-options">
                @if (session('farmasi')->jenis_detail->nama != 'Gudang')
                    <button type="button" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#addPenerimaanModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Pembelian Baru
                    </button>
                @else
                    <button type="button" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#addPenerimaanModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Penerimaan Baru
                    </button>
                @endif
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form method="POST">
                        {!!csrf_field()!!}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">PENYEDIA</label>
                                    <select class="js-select2 form-control mt-2" id="cari-peyedia-select2" name="cari_penyedia" style="width: 100%;">
                                        <option value="">Cari Penyedia</option>
                                        @foreach($supplier as $supp)
                                            <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">TANGGAL </label>
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                                    <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NILAI {{session('farmasi')->jenis_detail->nama != 'Gudang' ? 'PEMBELIAN' : 'PENERIMAAN'}} </label>
                                    <input type="number" class="form-control" name="harga_minimal" placeholder="Harga Minimal" id="harga_minimal">
                                    <input type="number" class="form-control mt-2" name="harga_maksimal" placeholder="Harga Maksimal" id="harga_maksimal">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NO. FAKTUR </label>
                                    <input type="text" class="form-control mt-2" name="no_faktur" placeholder="Nomor Faktur" id="no_faktur">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NO. SURAT JALAN</label>
                                    <input type="text" class="form-control mt-2" name="no_surat" placeholder="Nomor Surat Jalan" id="no_surat">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Tutup</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-primary btn-square" id="searchBtn">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="pengadaan_farmasi">
                <thead>
                    <tr>
                        <th width="30px">ID</th>
                        <th width="150px">Penyedia</th>
                        <th width="120px">Tanggal</th>
                        <th width="150px">Nilai {{session('farmasi')->jenis_detail->nama != 'Gudang' ? 'Pembelian' : 'Penerimaan'}}</th>
                        <th width="150px">Nomor Faktur</th>
                        <th width="150px">Nomor Surat Jalan</th>
                        <th width="150px">Keterangan</th>
                        <th width="60px">Detail</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('farmasi.pengadaan.components.modals')
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    
        @include('farmasi.pengadaan.components.js-gudang')
    <script type="text/javascript">
    $(document).ready(function(){
        var oTable = $("#pengadaan_farmasi").DataTable({
            pageLength: 10,
            autoWidth: false,
            lengthChange: false,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/pengadaan/get",
                data: function(d) {
                    d.farmid = "{{session('farmasi')->id}}";
                    d.penyedia = $('#cari-peyedia-select2').val();
                    d.tanggal_awal = $('#tanggal_awal').val();
                    d.tanggal_akhir = $('#tanggal_akhir').val();
                    d.harga_minimal = $('#harga_minimal').val();
                    d.harga_maksimal = $('#harga_maksimal').val();
                    d.no_faktur = $('#no_faktur').val();
                    d.no_surat = $('#no_surat').val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info mt-50"></i>'
            },
            columns: [
                { data: 'rownum', name: 'rownum', orderable: false, searchable: false, class: 'text-center'},
                { data: 'penyedia', name: 'penyedia'},
                { data: 'tanggal', name: 'tanggal'},
                { data: 'nilai', name: 'nilai', class: 'text-center'},
                { data: 'no_faktur', name: 'no_faktur', class: 'text-center'},
                { data: 'no_surat', name: 'no_surat', orderable: false, class: 'text-center'},
                { data: 'keterangan', name: 'keterangan', orderable: false, class: 'text-center'},
                { data: 'detail', name: 'detail', orderable: false, searchable: false, class: 'text-center'},
            ],
            order: []
        })
        $('#searchBtn').on('click', function(e) {
            oTable.draw();
            e.preventDefault();
        });

        $('#btnReset').on('click', function(e) {
            $('#cari-peyedia-select2').val(null).trigger('change');
            $('#tanggal_awal').val(null).trigger('change');
            $('#tanggal_akhir').val(null).trigger('change');
            $('#harga_minimal').val(null).trigger('change');
            $('#harga_maksimal').val(null).trigger('change');
            $('#no_faktur').val(null).trigger('change');
            $('#no_surat').val(null).trigger('change');
            oTable.draw();
            e.preventDefault();
        });
    });
    </script>
@endsection