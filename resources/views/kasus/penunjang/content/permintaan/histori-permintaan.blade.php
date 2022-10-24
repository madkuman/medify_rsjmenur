@extends('layouts.main-simple')
@section('content')
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">HISTORI Penunjang</h3>
        <h4>Pasien {{$kasus->identitas->nama}}</h4>
    </div>
    <div class="row">
        @forelse ($permintaans as $key => $permintaanss)
        <div class="col-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h5 class="mb-0">Kasus {{$permintaanss[0]->kasus->judul_kasus}}</h5>
                    <?php $i = sizeof($permintaanss); ?>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="permintaanss-item-{{$key}}"></button>
                    </div>
                </div>
                <div class="block-content soap-item" id="permintaanss-item-{{$key}}">
                    <div class="row">
                        @foreach($permintaanss as $item)
                        <div class="content pt-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="block block-transparent">
                                        <div class="block-content">
                                            <h4 class="text-info font-w600 badges">
                                                # 
                                                @if($item->modul_id == 6) 
                                                Radiologi
                                                @elseif($item->modul_id == 10)
                                                Lab PK
                                                @elseif($item->modul_id == 11)
                                                Lab PA
                                                @else
                                                Penunjang Lain
                                                @endif
                                            </h4>
                                            @if(!empty($item->transaksi->detail))
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="mb-0"><strong>Permintaan no. #{{$item->id}}:
                                                    </strong></p>
                                                    <ul>
                                                        @foreach($item->transaksi->detail as $permintaan_item)

                                                            @if($item->modul_id == 6) 
                                                                @if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
                                                                <li>
                                                                    {{$permintaan_item->tarif->deskripsi}}
                                                                </li>
                                                                @endif

                                                            @elseif($item->modul_id == 10) 
                                                                @if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
                                                                <li>
                                                                    {{$permintaan_item->tarif->deskripsi}} 
                                                                    @if(!empty($permintaan_item->barcode)) 
                                                                        <a href="javascript:void(0)" onclick="cetakBarcode('{{$permintaan_item->barcode}}','{{$permintaan_item->slug}}')">
                                                                            Cetak Barcode
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                @endif

                                                            @elseif($item->modul_id == 11) 
                                                                @if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
                                                                <li>
                                                                    {{$permintaan_item->tarif->deskripsi}}
                                                                </li>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @if($item->transaksi->status=='-1')
                                                <div class="col-md-4">
                                                    <p class="mb-0"><strong>Status:
                                                    </strong></p>
                                                        <p>Dibatalkan</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-0"><strong>Alasan Pembatalan:
                                                    </strong></p>
                                                    @if(!empty($item->transaksi->alasan_batal))
                                                        <p>{{$item->transaksi->alasan_batal}}</p>
                                                    @endif
                                                </div>
                                                @else
                                                <div class="col-md-4">
                                                    <p class="mb-0"><strong>Jadwal Pemeriksaan:
                                                    </strong></p>
                                                    @if(!empty($item->transaksi->inspected_at))
                                                        <p>{{$item->transaksi->inspected_at_formatted}}</p>
                                                    @else
                                                        <p>Belum dijadwalkan</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-0"><strong>Pemeriksaan :</strong></p>

                                                    @if(!empty($item->transaksi->result_created_at))
                                                        <p>{{$item->transaksi->result_created_at_formatted}}</p>

                                                    <ul>
                                                        @foreach($item->transaksi->detail as $permintaan_item)
                                                            @if($item->modul_id == 6) 
                                                                @if($permintaan_item->status != 'ask')
                                                                <li>
                                                                    {{$permintaan_item->tarif->deskripsi}}
                                                                </li>
                                                                @endif

                                                            @elseif($item->modul_id == 10) 
                                                                @if($permintaan_item->status != 'ask')
                                                                <li>
                                                                    {{$permintaan_item->tarif->deskripsi}}
                                                                </li>
                                                                @endif

                                                            @elseif($item->modul_id == 11) 
                                                                @if($permintaan_item->status != 'ask')
                                                                <li>
                                                                    {{$permintaan_item->tarif->deskripsi}}
                                                                </li>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    @else
                                                        <p>Belum ada pemeriksaan</p>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="mb-0"><strong>Keterangan :</strong></p>
                                                    {{$item->transaksi->keterangan}}
                                                </div>
                                            </div> 
                                            <br>
                                            @if($item->transaksi->status)
                                                @if($item->modul_id == 6) 
                                                <a href="{{url('radiologi/transaksi/hasil')}}/{{$item->transaksi->slug}}" class="btn btn-hero btn-alt-success text-uppercase float-right mt-15">Lihat Hasil Pemeriksaan</a> 
                                                @elseif($item->modul_id == 10)
                                                <a href="{{url('labpk/transaksi/hasil')}}/{{$item->transaksi->slug}}" class="btn btn-hero btn-alt-success text-uppercase float-right mt-15">Lihat Hasil Pemeriksaan</a>
                                                @elseif($item->modul_id == 11)
                                                <a href="{{url('labpa/transaksi/hasil')}}/{{$item->transaksi->slug}}" class="btn btn-hero btn-alt-success text-uppercase float-right mt-15">Lihat Hasil Pemeriksaan</a>
                                                @endif
                                            {{--@else
                                                <button class="btn btn-hero btn-alt-danger text-uppercase float-right mt-15" 
                                                onclick="tolakTransaksi({{$item->transaksi->id}},{{$item->modul_id}},'{{$item->transaksi->slug}}')"> Batalkan Permintaan</button>--}}
                                            @endif
                                            @else
                                            <h5 class="font-w400 text-danger">Transaksi #{{$item->transaksi_id}} tidak ditemukan</h5>
                                            @endif

                                            @if(!empty($item->creator->avatar_thumb))
                                            <div class="float-left mr-10">
                                                <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
                                            </div>
                                            @else
                                            <div class="float-left mr-10">
                                                <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                            </div>
                                            @endif
                                            <h6 class="pt-10">
                                                <small class="text-muted">Dibuat Oleh</small><br>
                                                {{$item->creator->name}}<br>
                                                {{date('d F y, H:i', strtotime($item->created_at))}}
                                            </h6>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i--; ?>
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