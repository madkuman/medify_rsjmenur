@extends('rekammedis.layouts.main')

@section('title')
Rekam Medis {{$rm->name}} - {{$rm->no_rm}} - Medify
@endsection


@section('subtitle')
{{$rm->name}} - {{$rm->no_rm}}
@endsection

@section('css')
@endsection

@section('content')
<main id="main-container">
    @include('rekammedis.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content">
                @if($rm->rm_current_holder->type == 2 && $rm->rm_current_holder->id == 24)
                @else
                <button class="btn btn-primary pull-right" onclick="confirmAmbilFileRM()">Ambil File RM</button>
                @endif

                @if($rm->rm_current_holder->type == 1)
                <h4 class="mb-5"><small>REKAM MEDIS SAAT INI DIBAWA OLEH</small></h4>
                @else
                <h4 class="mb-5"><small>REKAM MEDIS SAAT INI TERLETAK DI</small></h4>
                @endif
                <div class="row">
                    <div class="col-4">
                        <div class="block block-transparent">
                            <div class="block-content">
                                <h4>{{$rm->rm_current_holder->name}}</h4>
                                @if(!empty($rm->rm_transaksi))
                                Dikirim oleh <br>
                                <h5 class="mb-0">{{$rm->rm_transaksi->sender->name}}</h5>
                                <h5 class="mb-20">
                                    <small>
                                        {{date('d F Y, H:i', strtotime($rm->rm_transaksi->sender_confirmed_at))}}
                                    </small>
                                </h5>
                                @if($rm->rm_transaksi->status == 2)
                                Diterima oleh <br>
                                @elseif($rm->rm_transaksi->status == -2)
                                Mengkonfirmasi Tidak Menerima<br>
                                @else
                                Belum Menerima <br>
                                @endif

                                <h5 class="mb-0">{{$rm->rm_transaksi->holder->name ?? 'Rekam Medis'}}</h5>
                                @if(empty($rm->rm_transaksi->holder_confirmed_at))
                                <h5 class="mb-20"><small>BELUM DIKONFIRMASI</small></h5>
                                @else
                                <h5 class="mb-20">
                                    <small>
                                        {{date('d F Y, H:i', strtotime($rm->rm_transaksi->holder_confirmed_at))}}
                                    </small>
                                </h5>
                                @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h5><small>Daftar Transaksi File Ini</small></h5>
     
        @foreach($transaksi as $item)
        <div class="block">
            <div class="block-content">
                <div class="row ">
                    <div class="col-3 h-100 d-flex align-self-center">
                        <div class="">
                            <h5 class="font-w400 mb-5"><small>Jenis Transaksi</small></h5>
                            <h5 class="font-w400 mb-5">{{$item->tujuan->deskripsi}}</h5>
                            <h6>Lokasi : {{$item->lokasi}}</h6>
                        </div>
                    </div>
                    <div class="col-3 h-100 d-flex align-self-center">
                        <div class="">
                            <h5 class="font-w400 mb-5"><small>Permintaan Oleh</small></h5>
                            <h5 class="mb-5">{{$item->holder->name ?? '-'}}</h5>
                            <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->created_at))}}</h6>
                        </div>
                    </div>
                    <div class="col-3 h-100 d-flex align-self-center">
                        <div class="">
                            @if(!empty($item->sender_confirmed_at))

                            @if(empty($item->holder_confirmed_at) && $item->status == -1)
                            <h5 class="font-w400 mb-5"><small>Ditolak Oleh</small></h5>
                            @else
                            <h5 class="font-w400 mb-5"><small>Dikirim Oleh</small></h5>
                            @endif

                            <h5 class="mb-5">{{$item->sender->name}}</h5>
                            <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->sender_confirmed_at))}}</h6>
                            @else
                            <h5 class="font-w400 mb-5"><small>Belum dikonfirmasi</small></h5>
                            @endif
                        </div>
                    </div>
                    <div class="col-3 h-100 d-flex align-self-center">
                        <div class="">
                            @if($item->status == 2)
                            <h5 class="font-w400 mb-5"><small>Diterima Oleh</small></h5>
                            <h5 class="mb-5">{{$item->holder_confirmer->name}}</h5>
                            <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->holder_confirmed_at))}}</h6>
                            @elseif($item->status == -2)
                            <h5 class="font-w400 mb-5"><small> Mengkonfirmasi Tidak Menerima</small></h5>
                            <h5 class="mb-5">{{$item->holder_confirmer->name}}</h5>
                            <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->holder_confirmed_at))}}</h6>
                            @else
                            Belum Menerima <br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</main>

<form method="POST" action="{{url('rekammedis/transaksi/ambil-rm')}}" id="formAmbilRM">
    {{csrf_field()}}
    <input type="hidden" name="pasien_id" value="{{$rm->id}}">
    <input type="hidden" name="holder_type" value="2">
    <input type="hidden" name="holder_group_id" value="24">
    <input type="hidden" name="keterangan" value="">
    <input type="hidden" name="tujuan_id" value="1">
    <input type="hidden" name="lokasi" value="Ruang File RM">
</form>

@endsection


@section('js')
<script type="text/javascript">
    function confirmAmbilFileRM()
    {
        swal({
            title: 'Apakah anda yakin?',
            text: "File akan dikembalikan ke Rekam Medis!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-primary',
            confirmButtonText: 'Yes, Ambil file RM!'
        }).then((result) => {
            if (result.value) {
                $('#formAmbilRM').submit();
            }
        })
    }

</script>
@endsection