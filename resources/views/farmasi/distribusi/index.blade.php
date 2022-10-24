@extends('farmasi.layouts.main')

@section('title')
Farmasi Distribusi
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
    #distribusi_farmasi_filter {
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
</style>
@endsection

@section('content')
    <div class="block" style="min-height: 350px">
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
                    <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/distribusi')}}" id="formFilter">
                        {!!csrf_field()!!}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>UNIT TUJUAN </label>
                                    <select class="js-select2 form-control" id="cari-unit-select2" name="cari_unit" style="width: 100%;">
                                        <option>Semua Unit</option>
                                        <option value="0">Gudang</option>
                                        @foreach($pharmacy as $pharm)
                                            <option value="{{$pharm->id}}" @if($pharm->id == $unit_tujuan) selected @endif>{{$pharm->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Distribusi </label>
                                    <select class="js-select2 form-control" id="jenis-select2" name="jenis" style="width: 100%;">
                                        <option>Semua Jenis</option>
                                        <option value="Permintaan" {{($jenis == "Permintaan") ? "selected" : "" }}>Permintaan</option>
                                        <option value="Kiriman" {{($jenis == "Kiriman") ? "selected" : "" }}>Kiriman</option>
                                        <option value="Retur" {{($jenis == "Retur") ? "selected" : "" }}>Retur</option>
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
                            <div class="col row">
                                <div class="col">
                                    <label for="penyedia">STATUS </label><br>
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="status_selesai" id="status_selesai" @if($status_selesai) checked @endif>
                                        <input type="hidden" name="selesai" value="1">
                                        <span class="css-control-indicator"></span> Selesai
                                    </label><br>
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="status_menunggu" id="status_menunggu" @if($status_menunggu) checked @endif>
                                        <input type="hidden" name="menunggu" value="1">
                                        <span class="css-control-indicator"></span> Menunggu
                                    </label><br>
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="status_konfirmasi" id="status_konfirmasi" @if($status_konfirmasi) checked @endif>
                                        <input type="hidden" name="konfirmasi" value="1">
                                        <span class="css-control-indicator"></span> Konfimasi
                                    </label>
                                </div>
                                <div class="col">
                                    <label for="penyedia">KATEGORI </label><br>
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="tipe_masuk" id="tipe_masuk" @if($tipe_masuk) checked @endif>
                                        <input type="hidden" name="masuk" value="1">
                                        <span class="css-control-indicator"></span> Masuk
                                    </label><br>
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="tipe_keluar" id="tipe_keluar" @if($tipe_keluar) checked @endif>
                                        <input type="hidden" name="keluar" value="1">
                                        <span class="css-control-indicator"></span> Keluar
                                    </label>
                                </div>    
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Batalkan</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-warning btn-square" id="btnReset">Reset</button>
                                <span>&nbsp;</span>
                                <button type="button" class="btn btn-primary btn-square" id="searchBtn">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover table-vcenter" id="distribusi_farmasi" style="width: 100%">
                <thead>
                    <tr class="text-center">
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
    
    @include('farmasi.distribusi.components.modals.modal-index')
@endsection
    
@section('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    @include('farmasi.distribusi.components.js.js-index')
    @include('farmasi.distribusi.components.js.js-index-datatables')

    @if(count($auto_fill_items) > 0)
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#unit-tujuan-select2').val("{{$auto_fill_farmasi_id}}").trigger('change')
            $('#jenis-distribusi').val("{{$jenis}}").trigger('change')

            $('#modal-large').modal('show');
            @foreach($auto_fill_items as $index => $item)
                @if(!$loop->first)
                    if($('#jenis-distribusi').val() == 'Permintaan') $('#btnAddItems').click();
                    else $('#btnAddRetur').click();
                @endif

                if($('#jenis-distribusi').val() == 'Permintaan') {
                    stok = numeral("{{$item->stok}}")

                    var text = "{{$item->item_template->nama}} ({{$item->item_template->satuan}})- Stok Sekarang : {{$source_auto_fill_items[$index]->stok ?? 0}} - Stok Tujuan : " + stok.value() + " - Harga : {{$item->harga}}"

                    var option = new Option(text, "{{$item->id}}");
                    option.selected = true;

                    $("#barang-select2-{{$loop->iteration}}").append(option);
                    $("#barang-select2-{{$loop->iteration}}").trigger("change");

                    ketersediaan = stok.value();
                    jumlah_permintaan = "{{$source_auto_fill_items[$index]->min_stok}}";

                    $("#jumlah-{{$loop->iteration}}").val(jumlah_permintaan);
                }else{
                    var text = "{{$item->item_farmasi->item_template->nama}} ({{$item->item_farmasi->item_template->satuan}})- Stok Sekarang : {{$item->item_farmasi->stok ?? 0}} - Stok Tujuan : {{$source_auto_fill_items[$index]->stok ?? 0}} - Harga : {{$item->item_farmasi->harga}}"
                    var option = new Option(text, "{{$item->item_farmasi->id}}");
                    option.selected = true;
                    $("#template-select2-{{$loop->iteration}}").append(option);
                    $("#template-select2-{{$loop->iteration}}").trigger("change");
                    var text = "{{date('d F Y', strtotime($item->kadaluarsa))}}"
                    var option = new Option(text, "{{$item->id}}");
                    option.selected = true;
                    option.setAttribute('data-max', {{$item->jumlah}});
                    $("#barang-select2-{{$loop->iteration}}").append(option);
                    $("#barang-select2-{{$loop->iteration}}").trigger("change");
                    $("#jumlah-{{$loop->iteration}}").val({{$item->jumlah}});

                }

            @endforeach
        });
    </script>
    @endif
@endsection
