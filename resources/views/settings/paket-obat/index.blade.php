@extends('layouts.main2')

@section('title')
Paket Obat
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="row">
            @include('settings.components.sidebar')
            <div class="col-md-9 mb-20">
                <div class="bg-white px-20 py-20">
                    <div class="row justify-content">
                        <div class="col-12">
                         <button type="button" class="btn btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-resep"><i class="fa fa-plus"></i> Buat Paket Obat</button>
                         <button type="button" class="btn btn-secondary min-width-125 float-right mr-5" data-toggle="modal" data-target="#modal-subscribe-resep"><i class="fa fa-retweet"></i> Subscribe Paket Obat</button>
                         <h3 class="mb-20">Paket Obat</h3>
                         <hr>

                     </div>
                 </div>
                 @php $count = 0 @endphp
                 <div class="row row-deck gutters-tiny">
                    @foreach ($paket_obat as $paket)
                    @php $count++ @endphp
                    @include('settings.paket-obat.paket-obat-item',['is_subscribe'=>0])
                    @endforeach
                    @foreach ($paket_obat_subscribed as $paket)
                    @php $count++ @endphp
                    @include('settings.paket-obat.paket-obat-item',['is_subscribe'=>1])
                    @endforeach
                </div>
                @if($count == 0)
                <div class="row">
                    <div class="col-12 text-center py-50">
                        <h4 class="font-w400 mb-0">Belum ada paket</h4><br>
                        <p>Klik tombol <b>Buat Paket Obat</b> atau <b>Subscribe Paket Obat</b> untuk menambahkan paket baru</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</main>
@include('settings.paket-obat.create-modal')
@include('settings.paket-obat.subscribe-modal')
@include('settings.paket-obat.edit-modal')
@endsection

@section('js')
@include('settings.paket-obat.create-js')
@include('settings.paket-obat.edit-js')
@include('settings.paket-obat.delete')
@include('settings.paket-obat.subscribe-js')
@include('settings.paket-obat.subscribe-delete')
@endsection
