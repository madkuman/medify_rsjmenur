@extends('layouts.main-simple')
@section('content')
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">HISTORI Penunjang</h3>
        <h4>Pasien {{$kasus->identitas->nama}}</h4>
    </div>
    <div class="row">
        @forelse ($penunjangs as $key => $penunjangss)
        <div class="col-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h5 class="mb-0">Kasus {{$penunjangss[0]->kasus->judul_kasus}}</h5>
                    <?php $i = sizeof($penunjangss); ?>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="penunjangss-item-{{$key}}"></button>
                    </div>
                </div>
                <div class="block-content soap-item" id="penunjangss-item-{{$key}}">
                   <div class="row" style="padding-top: 5%; padding-bottom: 5%">
                        @foreach($penunjangss as $item)

                        <div class="col-xl-4" style="padding-bottom: 5%">
                            <div class="options-container">
                                <img class="img-fluid options-item" style="max-width: 100%; max-height: 100%; cursor: pointer;" src="{{asset($item->file_thumb)}}">
                                <div class="options-overlay bg-black-op-75">
                                    <div class="options-overlay-content">
                                        <h3 class="h4 text-white mb-10 text-uppercase">{{$item->judul}}</h3>
                                        <a class="btn btn-sm btn-rounded btn-alt-info selector full-only" href="{{url('kasus').'/'.$nomor_kasus.'/penunjang/galeri/detail-img/'.$item->id}}">
                                            <i class="fa fa-pencil"></i> View
                                        </a>
                                        <a class="text-white mobile-block" href="{{asset($item->file_primary)}}" target="_blank">
                                            <i class="fa fa-pencil"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <h1 style="text-align: center;">TIDAK ADA HISTORI</h1>
        </div>
        @endforelse
    </div>
</div>
@endsection