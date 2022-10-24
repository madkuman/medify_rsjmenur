@extends('rekammedis.layouts.main')

@section('title')
Farmasi Grup {{$group->name}}
@endsection

@section('content')

<main id="main-container">
    <!-- Group Banner -->
    @include('group.component.banner')
    <!-- End of Group Banner -->
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                @include('group.component.sidebar-left')
                <!-- End of Sidebar -->
            </div>
            <div class="col-md-9 col-md-offset 1">
                <a href="{{url('')}}/farmasi/{{$group->farmasi->slug}}/distribusi" target="_blank" class="btn btn-secondary pull-right">Tambah Stok</a>
                <h5 class="text-uppercase text-muted">Farmasi</h5>
                <hr>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Stok Obat</h3>
                        <a href="{{url('')}}/farmasi/{{$group->farmasi->slug}}/item" target="_blank" class="btn btn-secondary pull-right">Lihat Stok Selengkapnya</a>
                    </div>
                    <div class="block-content">
                        <table class="table table-hover table-vcenter" id="items">
                            <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell">Nama Barang</th>
                                    <th class="d-none d-sm-table-cell">Stok</th>
                                    <th class="d-none d-sm-table-cell">Harga Beli</th>
                                    <th class="d-none d-sm-table-cell">Expired</th>
                                    <th class="d-none d-sm-table-cell">Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $flag=0 @endphp
                                @forelse($stok_obat as $item)
                                <tr>
                                    <td class="d-none d-sm-table-cell">
                                        <p class="font-w600 mb-0">{{$item->item_detail->nama}}</p>
                                        @if($item->min_stok > $item->stok)
                                        <p class="mb-0 text-danger inline">Stock Low</p>
                                        @php $flag=1 @endphp
                                        @endif
                                        @if(!$item->expired_day)
                                        @else
                                        @if($item->min_kadaluarsa > $item->expired_day)
                                        @if($flag)<p class="inline">-</p>@endif
                                        <p class="mb-0 text-success inline">Expired Soon</p>
                                        @endif
                                        @endif
                                    </td>
                                    @php $flag=0 @endphp
                                    <td class="d-none d-sm-table-cell">{{$item->stok}}</td>
                                    <td class="d-none d-sm-table-cell">Rp. {{number_format($item->harga)}}</td>
                                    <td class="d-none d-sm-table-cell">{{$item->expired}}</td>
                                    <td class="d-none d-sm-table-cell">
                                        @forelse($item->item_detail->items_category as $category)
                                        <span class="badge badge-primary">{{$category->nama}}</span>
                                        @empty
                                        @endforelse
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <h5 class="font-w400 text-center">Belum ada entry</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Distribusi Pending</h3>
                    </div>
                    <div class="block-content">
                       <table class="table table-hover table-vcenter" id="distribusi_farmasi">
                            <thead>
                                <tr>
                                    <th width="100px">Unit Tujuan</th>
                                    <th width="80px">Kategori</th>
                                    <th width="160px">Waktu</th>
                                    <th width="150px">Keterangan</th>
                                    <th width="110px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($distribusi as $item)
                                <tr>
                                    <td width="100px">{{$item->unit_tujuan ? $item->detail_tujuan->nama : 'Gudang'}}</td>
                                    <td width="80px">{{$item->kategori}}</td>
                                    <td width="160px">{{date('d F Y, H:i', strtotime($item->created_at))}}</td>
                                    <td width="150px">{{$item->deskripsi ? $item->deskripsi : "-"}}</td>
                                    <td width="110px">
                                        <a href="{{url('')}}/farmasi/{{$group->farmasi->slug}}/distribusi/{{$item->slug}}" target="_blank" class="btn btn-info">Lihat Selengkapnya</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <h5 class="font-w400 text-center">Belum ada entry</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#distribusi_farmasi').DataTable({
            "pagingType": "full_numbers"
        });
    });
</script>
@endsection