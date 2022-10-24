@extends('farmasi.layouts.app')

@section('title')
Farmasi
@endsection

@section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Daftar Farmasi Tersedia</h3>
        <div class="block-options">
            <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Farmasi Baru
            </button>
        </div>
    </div>
    <div class="block-content" style="min-height: 407px">
        <div class="row">
            @php $flag=1 @endphp
            @forelse($pharmacy as $row)
                @if(($row->jenis == 2 && $flag != $row->jenis) || ($row->jenis == 4 && $flag != $row->jenis)) 
                    @php $flag = $row->jenis @endphp
                    </div><hr><div class="row">
                @endif
                <div class="col-md-3">
                    <a class="block block-rounded block-link-pop text-center" href="{{url('farmasi/'.$row->slug.'/dashboard')}}" style="border: 1px solid #eaecee;">
                        <div class="block-content block-content-full">
                            <div class="font-size-h4 font-w600">{{$row->nama}}</div>
                            <!-- <div class="font-size-sm text-muted">{{$row->telepon}}</div> -->
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-150">
                        <h4 class="font-w400 mb-5">Belum ada Farmasi terdaftar</h4>
                        <p>Klik tombol <b>Farmasi Baru</b> untuk menambahkan Farmasi baru</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('farmasi.farmasi.components.modal')

@endsection

@section('js')
    @include('farmasi.farmasi.components.js')
@endsection