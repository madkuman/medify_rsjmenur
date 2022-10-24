@extends('farmasi.layouts.main')

@section('title')
Paket Obat Farmasi
@endsection

@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Paket Obat</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-create-resep">
                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Buat Paket Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row">
                @forelse ($paket_obat as $paket)
                <div class="col-md-6">
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h5 class="block-title font-w600">{{$paket->nama}}</h5>
                            <button type="button" class="btn-block-option deleteBtn" data-toggle="tooltip" data-placement="top" title="Hapus"  data-id="{{$paket->id}}">
                                <i class="si si-trash"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="top" title="Edit" onclick="resepEdit({{$paket->id}})">
                                <i class="si si-pencil"></i>
                            </button>
                            <div style="display: none" id="loading-top-{{$paket->id}}" class="loading">
                                <i class="fa fa-spinner fa-spin text-info"></i>
                            </div>
                        </div>

                        <div class="block-content">
                            @foreach ( $paket->detail as $item )
                            <span class="text-muted font-w400"> {{ $item->type }} </span>
                            @if($item->kategori == 'racikan')
                            <h6 class="font-w600 mb-5 mt-5" style="white-space: pre;">{{ $item->racikan }} </h6>

                            @php
                            $namaObat = json_decode($item->nama);
                            $jumlahObat = json_decode($item->jumlah_racikan);
                            @endphp

                            @foreach($namaObat as $key => $obat)
                            <span class="text-muted font-w400 font-italic"> {{ $obat }} - {{ $jumlahObat[$key]}} </span><br>
                            @endforeach

                            @else
                            <h6 class="font-w600 mb-5 mt-5"> {{ $item->item_detail->item_detail->nama ?? "-"}} </h6>
                            @endif
                            <span class="mt-5">Jumlah : {{ $item->jumlah }} @if(session('farmasi')->perharian) (7 Hari : {{$item->jumlah_hari_7}}, 23 Hari : {{$item->jumlah_hari_23}}, Duk RS : {{$item->jumlah_duk_rs}}) @endif</span><br>
                            <span style="white-space: pre">Aturan : {{ $item->aturan }}</span>
                            <hr>
                            @endforeach

                            <h6 class="pt-10">
                                <small class="text-muted">Dibuat Oleh</small><br>
                                <span class="float-right"> {{ $paket->created_at->format('d F Y, H:i') }} </span>
                                {{Auth::user()->name}}
                            </h6>
                        </div>
                    </div>
                </div>
                @empty
            </div>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="col-12 text-center py-50">
                    <h4 class="font-w400 mb-0">Belum ada paket</h4><br>
                    <p>Klik tombol <b>Buat Paket</b> untuk menambahkan paket baru</p>
                </div>
        @endforelse
            </div>
        </div>
    </div>
@endsection

@section('js')
@include('farmasi.paket-obat.modals.create-modal');
@include('farmasi.paket-obat.modals.edit-modal');
@include('farmasi.paket-obat.js.create-js');
@include('farmasi.paket-obat.js.edit-js');
@include('farmasi.paket-obat.js.delete-js');
<script type="text/javascript">
    $('#aturan-select2').select2({
        tags: true
    });
    $('#satuan-penggunaan-select2').select2({
        tags: true
    });
    $('.obat-tipe-racikan').select2();
</script>
@endsection
