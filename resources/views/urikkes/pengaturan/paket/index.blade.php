@extends('urikkes.layouts.main')

@section('title')
Pengaturan Paket Urikkes
@endsection

@section('subtitle')
Pengaturan / Daftar Paket Layanan
@endsection

@section('content')
<main id="main-container">
    @include('urikkes.layouts.navbar')
    <div class="content">
        <div class="row gutters-tiny mb-20">
            <div class="col-2  font-w400">
                <a href="{{url('urikkes/pengaturan')}}" class="link-effect text-primary">&larr; Kembali ke pengaturan</a>
            </div>
            <div class="col-10">
                <a href="{{url('urikkes/pengaturan/paket/add')}}" class="btn btn-primary float-right">+ Buat Baru</a>
            </div>
        </div>
        <div class="row gutters-tiny" >
            @forelse($paket as $item)
            <div class="col-6 col-md-4 col-xl-3 my-5">
                <a class="block block-bordered block-link-shadow" style="height:100%;" href="{{url('urikkes/pengaturan/paket/detail/'.$item->id)}}">
                    <div class="block-content block-content-full">
                        <div class="mb-10 text-center">
                         <h3><span class="font-w500">{{$item->nama}}</span></h3>
                        </div>
                        <ul>
                        @forelse($item->tarifPaket as $layanan)
                        <li>{{$layanan->tarifMaster->deskripsi}}</li>
                        @if($loop->iteration == 5 && !$loop->last)
                        <div class="text-center">...</div>
                        @break
                        @endif
                        @empty
                        <div>-</div>
                        @endforelse
                        </ul>

                        <div class="mt-10 text-center">
                            <h4 class="mb-0"><span class="font-w400">Rp {{number_format($item->total)}}</span></h4>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-6 col-md-4 col-xl-3 my-5 text-center">
                <div class="block block-bordered block-link-shadow aa" style="height:100%;">
                    <div class="block-content block-content-full">
                        <div class="mb-10 text-center">
                         <h3><span class="font-w400 my-40">Data Paket Masih Kosong</span></h3>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</main>

@endsection

@section('angular')
<script type="text/javascript">

    
</script>
@endsection