@extends('rekammedis.layouts.main')

@section('title')
Daftar RM Yang Saya Bawa
@endsection


@section('content')
<main id="main-container">
    <div class="container pt-50">
        <h5 class="text-uppercase text-muted">Daftar RM Yang Saya Bawa</h5>
        <hr>
        <div class="row">
            @foreach($my_rm as $item)
            <div class="col-3">
                <div class="block">
                    <div class="block-content pb-10">
                        <div class="btn-group pull-right" role="group">
                            <a href="javascript:void()" class="" id="btnGroupDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                @if(!empty($item->rm_transaksi->holder_confirmed_at))
                                <a class="dropdown-item" href="{{url('rekammedis/transaksi/transfer/'.$item->id)}}">
                                    <i class="fa fa-fw fa-exchange mr-5"></i>Transfer
                                </a>
                                @endif
                                @if(empty($item->rm_transaksi->holder_confirmed_at))
                                <a class="dropdown-item" href="{{url('rekammedis/transaksi/'.$item->rm_transaksi->id)}}">
                                    <i class="fa fa-fw fa-check mr-5"></i>Konfirmasi
                                </a>
                                @endif
                            </div>
                        </div>

                        <h5 class="mb-5"><small>#{{$item->no_rm}}</small></h5>
                        <h5 class="font-w600 mb-5">{{$item->name}}</h5>
                        @if(empty($item->rm_transaksi->holder_confirmed_at))
                        <h6 class="mb-5"><small>Belum Konfirmasi</small></h6>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <h5 class="text-uppercase text-muted">Daftar RM Yang Di Bawa Grup Saya</h5>
        <hr>
        <div class="row">
            @foreach($my_group_rm as $item)
            <div class="col-3">
                <div class="block">
                    <div class="block-content">
                        <div class="btn-group pull-right" role="group">
                            <a href="javascript:void()" class="" id="btnGroupDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                @if(!empty($item->rm_transaksi->holder_confirmed_at))
                                <a class="dropdown-item" href="{{url('rekammedis/transaksi/transfer/'.$item->id)}}">
                                    <i class="fa fa-fw fa-exchange mr-5"></i>Transfer
                                </a>
                                @endif
                                @if(empty($item->rm_transaksi->holder_confirmed_at))
                                <a class="dropdown-item" href="{{url('rekammedis/transaksi/'.$item->rm_transaksi->id)}}">
                                    <i class="fa fa-fw fa-check mr-5"></i>Konfirmasi
                                </a>
                                @endif
                            </div>
                        </div>
                        <h5 class="mb-5"><small>#{{$item->no_rm}}</small></h5>
                        <h5 class="font-w600 mb-5">{{$item->name}}</h5>
                        @if(!empty($item->rm_transaksi->holder_group->name))
                        <h6 class="text-muted">{{$item->rm_transaksi->holder_group->name}}
                        @else
                        <h6 class="text-muted">RM
                        @endif
                        @if(empty($item->rm_transaksi->holder_confirmed_at))
                        <h6><small class="text-uppercase">(Belum Konfirmasi)</small>
                        @endif
                        </h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>

@endsection
@section('js')
@endsection