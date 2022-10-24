@extends('rekammedis.layouts.main')

@section('title')
Transaksi #{{$transaksi->id}} - Rekam Medis - Medify
@endsection


@section('subtitle')
Transaksi #{{$transaksi->id}}
@endsection

@section('content')
<main id="main-container">
    <div class="container pt-50">
        <div class="block">
            <div class="pt-20 pl-20">
                <a href="{{url('rekammedis/permintaan')}}" style="text-align: left">Kembali ke halaman utama</a>
            </div>
            <div class="block-content p-50 text-center">
                <h5 class="font-w400">
                    <strong>{{$transaksi->holder->name}}</strong> 
                    meminta file rekam medis dari pasien <br> berikut untuk <strong>{{$transaksi->tujuan->deskripsi}}</strong>
                </h5>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-12">
                        <div class="block">
                            <div class="block-content text-center">
                                <h4 class="mb-0"><small>#{{$transaksi->pasien->no_rm}}</small></h4>
                                <h4><small>{{$transaksi->pasien->name}}</small></h4>
                            </div>

                        </div>
                    </div>
                </div>
                    {{-- JIKA BELUM DIKIRIM --}}
                    @if(empty($transaksi->sender_confirmed_at))

                        @if($allow_konfirmasi_kirim == 1)
                            @if($transaksi->pasien->rm_current_holder->id == 24 && $transaksi->pasien->rm_current_holder->type == 2)
                                @include('rekammedis.transaksi.content-single.permintaan-konfirmasi-sender')
                            @else
                                Tidak dapat menyetujui permintaan file RM dibawa <strong>{{$transaksi->pasien->rm_current_holder->name}}</strong>
                            @endif
                        @else
                            Menunggu Pengiriman
                        @endif
                    @elseif(empty($transaksi->holder_confirmed_at))
                        @include('rekammedis.transaksi.content-single.permintaan-konfirmasi-holder')
                    @else
                        @include('rekammedis.transaksi.content-single.permintaan-done')
                    @endif
            </div>
        </div>
    </div>
</main>

@endsection
@section('js')
<script type="text/javascript">
    
    function toggleTolakPengiriman()
    {
        $('#formTolakPengiriman').slideToggle();
    }

    function toggleTolakPenerimaan()
    {
        $('#formTolakPenerimaan').slideToggle();
    }

</script>
@endsection