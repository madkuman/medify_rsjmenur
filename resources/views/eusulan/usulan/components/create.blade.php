@extends('eusulan.layouts.main')

@section('title')
    E-Usulan - Usulan Baru
@endsection


@section('css')

    <style>
        .dataTables_processing {
            background-color: white;
        }
        .tableFixHead {
            overflow-y: auto; height: 100px;
        }
        .tableFixHead .headrow-1
        {
            top: 0;
        }
        .tableFixHead .headrow-2
        {
            top: 40px;
        }

        .tableFixHead .headrow-1, .tableFixHead .headrow-2
        {
            position: sticky;
            background: white;
            box-shadow: inset 1px 1px #eaecee, 0 1px #eaecee;
            border:none;
            z-index: 999;
        }

        .tableFixHead .headcol {
            background: white;
            position: sticky;
            width: 5em;
            left: 0;
            top: auto;
            border-top-width: 1px;
            margin-top: -1px;
            font-weight: 600;
            box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
        }

        .tableFixHead .headcol-1 {
            background: white;
            position: sticky;
            width: 5em;
            left: 230px;
            top: auto;
            border-top-width: 1px;
            margin-top: -1px;
            font-weight: 600;
            box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
        }

        .tableFixHead .headcolrow{
            z-index: 1000;
            position: sticky;
            left: 0;
            top: 0;
            background: white;
            box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
        }

        .tableFixHead .headcolrow1{
            z-index: 1000;
            position: sticky;
            left: 210px;
            top: 0;
            background: white;
            box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
        }
        .tr-striped, .tr-striped td{
            background-color: #fbfbfb!important;
        }
        .item-wrapper .form-group .select2-container {
            position: relative;
            z-index: 2;
            float: left;
            min-width: 210px;
            max-width: 210px;
            margin-bottom: 0;
            display: table;
            table-layout: fixed;
        }
    </style>
@endsection
@section('content')
    <div class="block block-rounded">
        <div class="block-header py-20">
                <span><h4 class="mb-0">Usulan Baru</h4><hr>
                <h5></h5></span>
        </div>
        <div class="block-content py-5">
            <form method="POST" enctype="multipart/form-data" action="{{url('e-usulan/baru')}}" id=form-usulan>
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tahun</label>
                            <input type="text" class="form-control js-datepicker-year" onkeydown="return false"
                                   name="tahun" value="{{date('Y')}}" data-date-autoclose="true">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required
                                   placeholder="Isi Nama Usulan" autocomplete="off" @if(isset($usulan)) value="{{$usulan->nama}}" @endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Unit</label>
                            <div>
                                <select class="js-select2 form-control" id="katalog-select2" name="unit_id"
                                        style="width: 100%;" data-placeholder="Pilih Unit">
                                    @foreach($unit as $item)
                                        <option value="{{$item->id}}" @if(isset($usulan) && $usulan->unit_id == $item->id) selected @endif>{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penyedia">Tanggal Usulan</label>
                            <div>
                                <input type="text" class="js-datepicker form-control" id="datepicker1" onkeydown="return false" required data-today-highlight="true"
                                       value="{{date('m/d/Y')}}" name="tanggal_usulan" placeholder="Masukkan Tanggal Usulan"
                                       autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="penyedia">Deskripsi</label>
                            <select class="js-select2 form-control" id="katalog-select2" name="deskripsi"
                                    style="width: 100%;" data-placeholder="Pilih Deskripsi">
                                    <option value="RKA" @if(isset($usulan) && $usulan->deskripsi == 'RKA') selected @endif>RKA</option>
                                    <option value="RKPA" @if(isset($usulan) && $usulan->deskripsi == 'RKPA') selected @endif>RKPA</option>
                                    <option value="DBHCHT" @if(isset($usulan) && $usulan->deskripsi == 'DBHCHT') selected @endif>DBHCHT</option>
                                    <option value="DAK" @if(isset($usulan) && $usulan->deskripsi == 'DAK') selected @endif>DAK</option>
                                    <option value="DID" @if(isset($usulan) && $usulan->deskripsi == 'DID') selected @endif>DID</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="penyedia">Indikator</label>
                            <textarea class="form-control" rows="3" placeholder="Tambahkan Indikator.."
                                      name="indikator">@if(isset($usulan)) {{$usulan->indikator}} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="penyedia">Target</label>
                            <textarea class="form-control" rows="3" placeholder="Tambahkan Target.."
                                      name="target">@if(isset($usulan)) {{$usulan->target}} @endif</textarea>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <div class="table-responsive" style="height: 530px; overflow-x: scroll; overflow-y: scroll;padding-left: 0px;padding-top: 0">
                    <table class="table my-0 pengadaan-table tableFixHead">
                        <thead>
                        <tr>
                            <th class="text-center headcolrow" style="min-width: 210px">Akun Rekening</th>
                            <th class="text-center headcolrow1" style="min-width: 210px">Barang</th>
                            <th class="text-center headrow-1" style="min-width: 100px">Penting</th>
                            <th class="text-center headrow-1" style="min-width: 200px">Kegiatan</th>
                            <th class="text-center headrow-1" style="min-width: 100px">Jumlah</th>
                            <th class="text-center headrow-1" style="min-width: 100px">Satuan</th>
                            <th class="text-center headrow-1" style="min-width: 150px">Harga Satuan</th>
                            <th class="text-center headrow-1" style="min-width: 150px">Subtotal</th>
                            <th class="text-center headrow-1" style="min-width: 200px">Link 1</th>
                            <th class="text-center headrow-1" style="min-width: 200px">Link 2</th>
                            <th class="text-center headrow-1" style="min-width: 200px">Link 3</th>
                            <th class="text-center headrow-1" style="min-width: 200px">Spesifikasi</th>
                            <th class="text-center headrow-1" style="min-width: 200px">Justifikasi</th>
                            <th class="text-center headrow-1" style="min-width: 200px">File Pendukung</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="newItem">
                        @if(isset($usulan))
                            @php
                                $index=0;
                                $total = 0;
                            @endphp
                            @foreach($usulan->detail as $row)
                                @php $total += ($row->harga * $row->jumlah); ++$index;  @endphp
                                <tr class="item-row item-wrapper">
                                    @include('eusulan.usulan.components.form-add',['index' => $index,'row' => $row])
                                </tr>
                            @endforeach
                        @else
                        <tr class="item-row item-wrapper">
                            @include('eusulan.usulan.components.form-add',['index' => 1])
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 mb-3 pb-2" id="loader">
                    <center>
                        <button type="button" class="btn btn-block btn-alt-primary" id="btnAddItems">
                            Tambah Record
                        </button>
                        <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i>
                        </center>
                    </center>
                </div>
                <div class="row">
                    <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total Akhir</h5></div>
                    <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                    <div class="col-md-2 text-right"><h5 class="mb-5" id="total">{{isset($total) ? $total : ''}}</h5></div>
                </div>
                <div class="mt-3 mb-3 pb-2 text-right">
                    <button type="submit" class="btn btn-primary btn-square btn-click-animate" id="btnSimpan">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        counter = {{isset($usulan) ? count($usulan->detail) : 1}}
        $(document).ready(function () {
            $(".js-datepicker-year").datepicker({
                format: "yyyy",
                startView: "years",
                minViewMode: "years"
            });
            for (i=1;i<=counter;i++){
                initBarangSelect2('#barang-select2-'+i,i,1);
                initAkunRekeningSelect2('#akun-rekening-select2-'+i,i);
                initFileInput('#file-'+i,i);
                removeItem()
            }
            ++counter;
        });
    </script>
    @include('eusulan.usulan.components.js-form')
@endsection