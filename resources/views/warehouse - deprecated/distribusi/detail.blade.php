@extends('warehouse.layouts.main')

@section('title')
Gudang Detail Distribusi
@endsection

@section('content')
    <div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">Distribusi #{{$distribusi->slug}}
                @if($distribusi->status == 0)
                    <span class="p-2 badge badge-info">Konfirmasi</span>
                @elseif($distribusi->status == 1)
                    @if($distribusi->tipe==-1) <span class="p-2 badge badge-primary">Terkirim</span>
                    @else <span class="p-2 badge badge-info">Konfirmasi</span>
                    @endif
                @elseif($distribusi->status == 2)
                    <span class="p-2 badge badge-success">Selesai</span>
                @elseif($distribusi->status == -1)
                    <span class="p-2 badge badge-danger">Ditolak</span>
                @endif
            </h3>
            <div class="block-options">
                <form method="POST" action="{{url('gudang/distribusi/delete')}}" id="form-delete">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$distribusi->id}}">
                </form>
                <form method="POST" action="{{url('gudang/distribusi/verify')}}" id="form-konfirmasi">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$distribusi->id}}">
                </form>
                <!-- <button type="submit" class="btn btn-square">
                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                </button> -->
                @if(!$distribusi->status)
                    <button type="submit" class="btn btn-alt-primary btn-square" id="btnKonfirmasi">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Konfirmasi
                    </button>
                    @if($distribusi->kategori == 'Permintaan')
                        {{-- <button type="submit" class="btn btn-alt-warning btn-square confirm-reject">
                            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Tolak
                        </button> --}}
                        <button type="button" class="btn btn-alt-warning btn-square" id="confirm-reject">
                            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Tolak
                        </button>
                    @endif
                    <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                    </button>
                @elseif($distribusi->status==1)
                    @if($distribusi->tipe==-1)
                    <button type="submit" class="btn btn-alt-primary btn-square" id="btnEdit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                    </button>
                    @else
                    <button type="submit" class="btn btn-alt-primary btn-square" id="btnVerify">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Konfirmasi
                    </button>
                    @endif
                    <button type="submit" class="btn btn-alt-danger btn-square confirm-del">
                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                    </button>
                @endif
                    <a href="{{url('gudang/distribusi/print/'.$distribusi->slug)}}" class="btn btn-alt-secondary btn-square" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</a>
                
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                    <div class="col">
                        <label>UNIT TUJUAN</label>
                        <h5>{{$distribusi->farmasi_id ? $distribusi->farmasi_detail->nama : "Gudang"}}</h5>
                        <label>TANGGAL TRANSAKSI</label>
                        <h5>{{ date('d F Y', strtotime($distribusi->created_at)) }}</h5>
                    </div>
                    <div class="col">
                        <label>KATEGORI</label>
                        <h5>{{$distribusi->kategori}}</h5>
                        <label>KETERANGAN</label>
                        <p>{{ is_null($distribusi->deskripsi) ? "-" : $distribusi->deskripsi }}</p>
                    </div>
                </div>
            </div>

            @if($distribusi->status)
                @if($distribusi->kategori == 'Retur')
                    @if($distribusi->status == 1)
                        <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikembalikan</h4>
                        <table class="table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Kadaluarsa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($distribusi->transaksi_detail->log as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->detail_item->detail_item->item_detail->nama}}</td>
                                    <td>{{$row->jumlah}}</td>
                                    <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikembalikan</h4>
                        <table class="table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Kadaluarsa</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($distribusi->log as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->detail_item->detail_item->nama}}</td>
                                    <td>{{$row->jumlah}}</td>
                                    <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                                    <td>Rp. {{number_format($row->subtotal)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right font-w600">TOTAL BIAYA :</td>
                                    <td id="total-harga">Rp. {{number_format($distribusi->total_harga)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                @else
                    <h4 class="p-10 bg-primary-lighter text-primary-dark">Barang Dikirim</h4>
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Kadaluarsa</th>
                                <!-- <th>Subtotal</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach($distribusi->log as $row)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$row->detail_item->detail_item->nama}}</td>
                                <td>{{$row->jumlah}}</td>
                                <td>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</td>
                                <!-- <td>Rp. {{number_format($row->subtotal)}}</td> -->
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <td colspan="4" class="text-right font-w600">TOTAL BIAYA :</td>
                                <td id="total-harga">Rp. {{number_format($distribusi->total_harga)}}</td>
                            </tr> -->
                        </tbody>
                    </table>
                @endif
            @endif

            @if($distribusi->kategori == 'Permintaan')
                <h4 class="p-10 bg-primary-lighter text-primary-dark">Permintaan Awal</h4>
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($distribusi->transaksi_detail->draft as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->detail_draft->nama}}</td>
                            <td>{{$row->jumlah}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="mt-50">
                <div class="row">
                    <div class="col-md-4">
                    @if($distribusi->kategori != 'Kiriman')
                        <label>DI BUAT OLEH</label>
                        <h5 class="text-primary">{{$distribusi->created_by_detail->name}} - {{ date('d F Y, H:i', strtotime($distribusi->created_at)) }}</h5>
                    @endif
                    </div>
                    <div class="col-md-4">
                        <div class="pull-right">
                        @if($distribusi->status==2)
                            <label>DI KIRIM OLEH</label>
                            <h5 class="text-primary">{{$distribusi->verified_by_detail->name}} - {{ date('d F Y, H:i', strtotime($distribusi->verified_at)) }}</h5>
                        @endif
                        </div>   
                    </div>
                    <div class="col-md-4">
                        <div class="pull-right">
                        @if($distribusi->status==2 && is_null($distribusi->stok_opname_id) && !empty($distribusi->transaksi_ptr))
                            <label>DI KONFIRMASI OLEH</label>
                            <h5 class="text-primary">{{$distribusi->transaksi_detail->verified_by_detail->name ?? "-"}} - @if(!empty($distribusi->transaksi_detail->verified_at ?? '-')){{ date('d F Y, H:i', strtotime($distribusi->transaksi_detail->verified_at)) }} @else - @endif</h5>
                        @endif
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php $j=0 @endphp
    @if(!$distribusi->status)
    <div class="modal" id="modal-konfirmasi" role="dialog" aria-labelledby="modal-konfirmasi" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('gudang/distribusi')}}/konfirmasi" id="form-distribusi">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$distribusi->id}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Konfirmasi Distribusi</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Unit Tujuan</label>
                                        <div>
                                            <select class="js-select2 form-control" id="unit-tujuan-select2" name="unit_tujuan" style="width: 100%;" data-placeholder="Pilih Penyedia" disabled>
                                                @foreach($pharmacy as $pharm)
                                                    <option value="{{$pharm->id}}" @if($pharm->id == $distribusi->farmasi_id) selected @endif>{{$pharm->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jenis Distribusi</label>
                                        <select class="form-control" name="type" style="width: 100%;" data-placeholder="Pilih Jenis" disabled>
                                            <option value="Permintaan" @if($distribusi->kategori == "Permintaan") selected @endif>Permintaan</option>
                                            <option value="Retur" @if($distribusi->kategori == "Retur") selected @endif>Retur</option>
                                            <option value="Kiriman" @if($distribusi->kategori == "Kiriman") selected @endif>Kiriman</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih" value="{{$distribusi->deskripsi}}">
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div class="row justify-content-center pt-15 item-wrapper">
                                @if($distribusi->tipe == -1)
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="penyedia">Barang </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="penyedia">Jumlah </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="penyedia">Barang </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="penyedia">Jumlah </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="penyedia">Kadaluarsa </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div id="newItem">
                                @php $j=0 @endphp
                                @if($distribusi->tipe == -1)
                                @foreach($distribusi->transaksi_detail->draft as $row)
                                @php $j++ @endphp
                                <div class="row justify-content-center pt-15 item-wrapper">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <h1 id="stok-hid-{{$j}}" hidden>{{$row->detail_draft->stok}}</h1>
                                            <div>
                                                <select class="js-select2 form-control barang" id="barang-select2-{{$j}}" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang" onchange="cekStok()">
                                                    <option></option>
                                                    <option value="{{$row->item_id}}" selected>{{$row->detail_draft->nama}} ({{$row->detail_draft->satuan}}) || Stok = {{$row->detail_draft->stok}}</option>
                                                </select>
                                                <p class="text-danger" id="alert-{{$j}}" hidden>Stok kurang</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div>
                                                <input type="number" class="form-control" id="jumlah-{{$j}}" onchange="cekStok()" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}">
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
                                </div>
                                @endforeach
                                @else
                                @foreach($distribusi->draft as $row)
                                @php $j++ @endphp
                                <div class="row justify-content-center pt-15 item-wrapper">
                                    <input type="hidden" name="refer[]" value="{{$row->id}}">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div>
                                                <select class="js-select2 form-control barang" id="barang-select2-{{$j}}" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang" onchange="cekStok()">
                                                    <option></option>
                                                    <option value="{{$row->detail_item->item_template_id}}" selected>{{$row->detail_item->detail_item->nama}} ({{$row->detail_item->detail_item->satuan}})</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div>
                                                <input type="number" class="form-control" id="jumlah-{{$j}}" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div>
                                                <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" value="{{ date('d/m/Y', strtotime($row->detail_item->kadaluarsa)) }}" readonly>
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
                                </div>
                                @endforeach
                                @endif
                            </div>

                            <div class="mt-3 mb-3 pb-2" id="loader">
                                <center>
                                    @if($distribusi->tipe==-1)
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddRetur">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    @endif
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
    @elseif($distribusi->status == 1)
    <div class="modal" id="modal-edit" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{url('gudang/distribusi')}}/edit" id="form-penghapusan">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$distribusi->id}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Ubah {{$distribusi->kategori}}</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Unit Tujuan</label>
                                        <div>
                                            <select class="js-select2 form-control" id="unit-tujuan-select2" name="unit_tujuan" style="width: 100%;" data-placeholder="Pilih Penyedia" disabled>
                                                @foreach($pharmacy as $pharm)
                                                    <option value="{{$pharm->id}}" @if($pharm->id == $distribusi->farmasi_id) selected @endif>{{$pharm->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jenis Distribusi</label>
                                        <select class="form-control" name="type" style="width: 100%;" data-placeholder="Pilih Jenis" disabled>
                                            <option value="Permintaan" @if($distribusi->kategori == "Permintaan") selected @endif>Permintaan</option>
                                            <option value="Retur" @if($distribusi->kategori == "Retur") selected @endif>Retur</option>
                                            <option value="Kiriman" @if($distribusi->kategori == "Kiriman") selected @endif>Kiriman</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                        <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih" value="{{$distribusi->deskripsi}}">
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-5">
                            <div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="penyedia">Jenis Barang </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyedia">Barang </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="penyedia">Jumlah </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="penyedia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="newItem">
                                @php $j=0 @endphp
                                @foreach($distribusi->log as $row)
                                @php $j++ @endphp
                                <div class="row item-wrapper">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div>
                                                <select class="js-select2 form-control barang" id="barang-select2-{{$j}}" name="template[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                                    <option></option>
                                                    <option value="{{$row->detail_item->item_template_id}}" selected>{{$row->detail_item->detail_item->nama}} ({{$row->detail_item->detail_item->satuan}})</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div>
                                                <select class="js-select2 form-control" id="items-select2-{{$j}}" name="barang[]" onchange="changeJumlah({{$j}})" style="width: 100%;">
                                                    <option value="{{$row->item_id}}" selected>{{ date('d F Y', strtotime($row->detail_item->kadaluarsa)) }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div>
                                                <input type="number" class="form-control" id="jumlah-{{$j}}" name="jumlah[]" placeholder="Jumlah" value="{{$row->jumlah}}" max="{{$row->jumlah + $row->detail_item->jumlah}}">
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
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-3 mb-3 pb-2" id="loader">
                                <center>
                                    <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddEdit">
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
    @endif
@endsection

@section('css')
    <style type="text/css">
        .badge {
            width: 120px;
        }
        .p-10 {
            padding: 5px!important;
        }
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        counter = "{{$j}}";
        status = "{{$distribusi->status}}";
        cekStok();
        removeItem();
        datepicker();
        $('#unit-tujuan-select2').select2();
        for(x=1; x<=counter; x++)
        {
            $('#barang-select2-'+x).select2({
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
            if(status==1)
            {
                changeItems(x,0);
                $('#items-select2-'+x).select2();
            }
        }


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

        function datepicker() {
            $('.datepicker').datepicker({
                startDate: "today",
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
            });
        }

        $('#btnAddItems').on('click', function(){
            counter++;
            str = 
            `<div class="row justify-content-center item-wrapper">
                <div class="col-md-5">
                    <div class="form-group">
                        <div>
                            <select class="js-select2 barang-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang" onchange="cekStok()">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div>
                            <input type="number" class="form-control" name="jumlah[]" id="jumlah-`+counter+`" placeholder="Jumlah" onchange="cekStok()">
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

        $('#btnAddRetur').on('click', function(){
            counter++;
            str = 
            `<div class="row justify-content-center item-wrapper">
                <div class="col-md-5">
                    <div class="form-group">
                        <h1 id="stok-hid-`+counter+`" hidden></h1>
                        <div>
                            <select class="js-select2 barang-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div>
                            <input type="number" class="form-control" name="jumlah[]" id="jumlah-`+counter+`" placeholder="Jumlah">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div>
                            <input type="text" class="js-datepicker form-control datepicker" name="expired[]" placeholder="Tanggal Expired" readonly>
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
            datepicker();
        });

        $('#btnAddEdit').on('click', function(){
            counter++;
            str = `<div class="row item-wrapper">
                        <div class="col-md-5">
                            <div class="form-group">
                                <div>
                                    <select class="js-select2 form-control" id="barang-select2-`+counter+`" name="template[]" style="width: 100%;">
                                        <option value="">Cari Barang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <select class="js-select2 form-control" id="items-select2-`+counter+`" name="barang[]" onchange="changeJumlah(`+counter+`)" style="width: 100%;">
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
            $('#items-select2-'+counter).select2();
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

        $('#btnKonfirmasi').on('click', function(){
            $('#modal-konfirmasi').modal('show');
        });

        $('#btnEdit').on('click', function(){
            $('#modal-edit').modal('show');
        });

        $('#newItem').on('select2:select', function (e) {
            var data = e.params.data;
            ide = $(e.target).attr('id');
            ideas = ide.slice(-1);
            
            if(status == 0)
            {
                $('#stok-hid-'+ideas).text(data.stok);
                cekStok();
            }
            if(!data.element && status == 1) changeItems(ideas,1);
        });

        function removeItem() {
            $('.btnRemove').on('click', function(){
                var wrapper = $(this).parents('.item-wrapper');
                wrapper.remove();
                if(status==0) cekStok();
            });
        }

        function cekStok() {
            flag = 0;
            for(x=1; x<=counter; x++)
            {
                stok = parseInt($('#stok-hid-'+x).text());
                if(document.getElementById("jumlah-"+x) == null) continue;
                jumlah = $('#jumlah-'+x).val();
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

        function changeItems(index, remove) {
            if(remove == 1) $("#items-select2-"+index).children('option').remove();
            temp = $('#barang-select2-'+index).val();
            var url = "{{ url('/api/gudang/item/active') }}/"+temp;            

            $.get( url , function( data ) {
                if(data.length == 0 && remove == 1) {
                    $("#items-select2-"+index).append('<option>Belum ada barang</option>');
                    $("#jumlah-"+index).val('');
                    $("#jumlah-"+index).prop('max',0);
                }
                for(var key in data)
                {
                    row = data[key];
                    if(row.id != $("#items-select2-"+index).val() || remove == 1) $("#items-select2-"+index).append('<option value="'+row.id+'" data-max="'+row.jumlah+'">'+formatDate(row.kadaluarsa)+'</option>');
                    if(key==0 && remove == 1) {
                        $("#jumlah-"+index).val(row.jumlah);
                        $("#jumlah-"+index).prop('max',row.jumlah);
                    }
                }
            });
            
            //$('#harga-'+index).val(harga);
        }

        function changeJumlah(index) {
            max = $("#items-select2-"+index).find(':selected').data('max');
            $("#jumlah-"+index).val(max);
            $("#jumlah-"+index).prop('max', max);

        }

        $('#btnVerify').on('click', function(){
            var confirmSupp = $(this).parent().find('#form-konfirmasi');
            swal({
                title: 'Apa anda yakin?',
                text: 'Pastikan barang yang diterima benar',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Konfirmasi',
                html: false,
                preConfirm: function() {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result){
                if (result.value) {
                    confirmSupp.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Konfirmasi dibatalkan.', 'error');
                }
            });
        });

        $('.confirm-del').on('click', function(){
            var deleteSupp = $(this).parent().find('#form-delete');
            swal({
                title: 'Apa anda yakin?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d26a5c',
                confirmButtonText: 'Hapus',
                html: false,
                preConfirm: function() {
                    return new Promise(function (resolve) {
                        setTimeout(function () {
                            resolve();
                        }, 50);
                    });
                }
            }).then(function(result){
                if (result.value) {
                    deleteSupp.submit();
                    //swal('Berhasil', 'Data berhasil dihapus.', 'success');
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Hapus data dibatalkan.', 'error');
                }
            });
        });

        $('#confirm-reject').on('click', function(){
            var reject = 
                '<form method="POST" action="{{url('gudang/distribusi/reject')}}" id="rejectForm">' +
                    '{{csrf_field()}}' +
                    '<input type="hidden" name="id" value="{{$distribusi->id}}">' +
                    '<div class="form-container">' +
                        '<div class="form-container">' +
                            '<textarea name="explanation" class="form-control" rows="4" placeholder="Mengapa anda menolak permintaan ini" id="explanation"></textarea>' +
                        '</div>' +
                    '</div>' +
                '</form>';

            swal({
                title: 'Alasan Menolak',
                html: reject,
                showCancelButton: true,
                closeOnConfirm: false,
                allowOutsideClick: false,
                reverseButtons: true,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-default',
                confirmButtonText: "Tolak",
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Batal",
                preConfirm: function() {
                    var value = $('#explanation').val();
                    return new Promise((resolve) => {
                        if (value === '') {
                            swal.showValidationError(
                              'Kolom ini wajib diisi.'
                            );
                            swal.enableButtons()
                        } else {
                            resolve();
                        }
                    })
                },
            }).then((result) => {
                if (result.value) {
                    document.getElementById('rejectForm').submit();
                } else if (result.dismiss === 'cancel') {
                    swal('Batal', 'Tolak permintaan dibatalkan.', 'error');
                }
            });
        })
    </script>

    <script type="text/javascript">
        var BeFormValidation = function() {
            var initValidationBootstrap = function(){
                jQuery('#form-distribusi').validate({
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
                        'unit_tujuan': {
                            required: true,
                        },
                        'barang[]': {
                            required: true,
                        },
                        'jumlah[]': {
                            required: true,
                        }
                    },
                    messages: {
                        'unit_tujuan': 'Kolom ini wajib diisi',
                        'barang[]': 'Kolom ini wajib diisi',
                        'jumlah[]': 'Kolom ini wajib diisi',
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