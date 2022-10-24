@extends('farmasi.layouts.main')

@section('title')
Farmasi Detail Stok Opname
@endsection

@section('content')
<div class="block">
    <div class="block-content bordered">
        <div class="row">
            <h3 class="block-title col-lg-5 col-12">Stok Opname #{{$stokopname->slug}}</h3>
            <div class="col-lg-7 col-12">
                <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/stokopname/confirm')}}" id="form-confirm">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$stokopname->id}}">
                </form>
                <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/stokopname/delete')}}" id="form-delete">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$stokopname->id}}">
                </form>
                @if(session('farmasi')->group->my_role->admin ?? 0 == 1)
                <button type="submit" class="btn btn-alt-danger btn-square confirm-del mr-5 mb-5 pull-right">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                </button>
                @endif
                <button class="btn btn-alt-primary btn-square  mr-5 mb-5 pull-right" onclick="printStokOpname('{{$stokopname->slug}}')">
                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                </button>
                <a type="btn" class="btn btn-alt-success btn-square  mr-5 mb-5 pull-right" href="{{url('/farmasi/'.session('farmasi')->slug.'/stokopname/download/'.$stokopname->slug)}}/">
                    <i class="fa fa-file-excel" aria-hidden="true"></i>&nbsp;&nbsp;Download
                </a>
                @if(!$stokopname->status)
                @if(!$flag)
                <button type="button" class="btn btn-alt-info btn-square confirm  mr-5 mb-5 pull-right">
                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Konfirmasi
                </button>
                @endif
                <button class="btn btn-alt-success btn-square  mr-5 mb-5 pull-right" onclick="reviewStokOpname('{{$stokopname->slug}}')">
                    <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Review
                </button>
                <button class="btn btn-alt-primary btn-square  mr-5 mb-5 pull-right" id="new">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Detail
                </button>
                @endif
            </div>
        </div>
    </div>
    <div class="block-content">
        @if(!$stokopname->status)
        <h5 class="p-10 bg-primary-lighter text-primary-dark">Detail Stok Opname </h5>
            {{csrf_field()}}
            <input type="hidden" name="flag" value="{{$flag}}">
            <input type="hidden" name="id" value="{{$stokopname->id}}">
            <div class="col-12 ajax-container pt-10 px-0" id="itemsContainer">
                <input class="form-control" placeholder="Cari disini..." type="text" id="searchField" onkeyup="filterBarang(this)">
                <div class="form-items block-content autoscroll-x px-0" id="itemsDiv" data-toggle="slimscroll" data-always-visible="true" data-size="8px" data-height="250px">
                    <table class="js-table-sections table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama.Barang</th>
                                <th>Kadaluarsa</th>
                                <th>Jumlah</th>
                                <th></th>
                            </tr>
                        </thead>
                        @php $idx=0 @endphp
                        @forelse($stokopname->detail as $row)
                        @php $idx++ @endphp
                        <tbody class="js-table-sections-header opname-wrapper">
                            <tr>
                                <td class="text-center">
                                    <i class="fa fa-angle-right"></i>
                                </td>
                                <td class="font-w600 nama-item">{{$row->nama}}</td>
                                <td>
                                    {{date('d F Y', strtotime($row->kadaluarsa))}}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <em class="text-muted">{{$row->jumlah}}</em>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach($row->sub as $sub)
                            <tr class="opname-detail-wrapper">
                                <input type="hidden" name="detail_refer[]" value="{{$sub->id}}" id="sub-id-{{$sub->id}}">
                                <td class="text-center">{{$i++}}</td>
                                <td class="font-w600">{{$sub->created_by_detail->name}}</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control change-detail" name="keterangan[]" value="{{$sub->keterangan}}" placeholder='Keterangan Lokasi Obat' id="sub-ket-{{$sub->id}}" data-id="{{$sub->id}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control change-detail" name="jumlah[]" value="{{$sub->jumlah}}" id="sub-jumlah-{{$sub->id}}" data-id="{{$sub->id}}">
                                    </div>
                                </td>                            
                                <td>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveDetail" data-id="{{$sub->id}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @empty
                        <tbody>
                            <tr>
                                <td colspan="5" class="h4 text-center py-50 font-w600">Belum ada barang</td>
                            </tr>
                        </tbody>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="float-right">
                        <button type="button" class="btn btn-primary btn-square" id="saveEdit">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        @else
        <div class="block block-transparent">
            <div class="row">
                <div class="col">
                    <label>TANGGAL TRANSAKSI</label>
                    <h5>{{ date('d F Y', strtotime($stokopname->created_at)) }}</h5>
                </div>
                <div class="col">
                    <label>KETERANGAN</label>
                    <p>{{$stokopname->keterangan ? $stokopname->keterangan : "-"}}</p>
                </div>
            </div>
            <div class="row">
                @if($stokopname->penghapusan)
                <div class="col">
                    <label>Detail Penghapusan</label>
                    <a href="{{url('farmasi/'.session('farmasi')->slug.'/penghapusan/'.$stokopname->penghapusan->slug)}}">
                        <h5>#{{$stokopname->penghapusan->slug}}</h5>
                    </a>
                </div>
                @endif
                @if($stokopname->distribusi)
                <div class="col">
                    <label>Detail distribusi</label>
                    <a href="{{url('farmasi/'.session('farmasi')->slug.'/distribusi/'.$stokopname->distribusi->slug)}}">
                        <h5>#{{$stokopname->distribusi->slug}}</h5>
                    </a>
                </div>
                @endif
            </div>
        </div>
        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Kadaluarsa</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @if($stokopname->detail)
                @foreach($stokopname->detail as $row)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->jumlah}}</td>
                    <td>{{ date('d F Y', strtotime($row->kadaluarsa)) }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @endif

    <div class="mt-50">
        <label>DI BUAT OLEH</label>
        <h5 class="text-primary">{{$stokopname->created_by_detail->name}}</h5>
    </div>
</div>
</div>

@include('farmasi.stokopname.components.modal-detail')
@endsection

@section('css')
<style type="text/css">
.bordered {
    border-bottom: 1px solid #eaecee;
}
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
</style>
@endsection

@section('js')
    @include('farmasi.stokopname.components.js-detail')
@endsection