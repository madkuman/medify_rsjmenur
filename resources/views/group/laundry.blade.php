@extends('rekammedis.layouts.main')

@section('title')
Laundry Grup {{$group->name}}
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
                <h5 class="text-uppercase text-muted">Laundry</h5>
                <hr>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Transaksi Pencucian</h3>
                        <a href="{{url('')}}/laundry/permintaan/add-permintaan/{{$group->id}}" target="_blank" class="btn btn-primary pull-right">Tambah Laundry</a>
                    </div>
                    <div class="block-content">
                        <table class="table table-hover table-vcenter" id="transaction" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-left">Grup</th>
                                    <th width="20%" class="text-left">Diserahkan</th>
                                    <th width="20%" class="text-left">Diterima</th>
                                    <th width="20%" class="text-left">Penerima</th>
                                    <th width="15%" class="text-left">Dikembalikan</th>
                                    <th width="15%" class="text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $item)
                                <tr class="clickable-row" data-href="{{url('laundry/permintaan/detil-permintaan')}}/{{$item->id}}" style="cursor: pointer;">
                                    <td width="10%" class="text-left">{{$item->group_name}}</td>
                                    <td width="20%" class="text-left">{{$item->waktu_diserahkan}}</td>
                                    <td width="20%" class="text-left">{{$item->waktu_diterima}}</td>
                                    <td width="20%" class="text-left">{{$item->nama_penerima}}</td>
                                    <td width="15%" class="text-left">{{$item->waktu_dikembalikan}}</td>
                                    <td width="15%" class="text-left">{{$item->nama_status}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
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
        $('#transaction').DataTable({
            searching: false,
            lengthChange: false,
            ordering: false,
            "pagingType": "simple_numbers"
        });
    });
</script>
@endsection