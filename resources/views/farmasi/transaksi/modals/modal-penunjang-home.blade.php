@extends('layouts.main-simple')
@section('content')
<div class="block block-themed block-transparent mb-0">
    <div class="block-header">
        <h3 class="block-title">Daftar Penunjang</h3>
    </div>
    <div class="block-content">
        @forelse($penunjang as $item)
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
                    @if(!empty($item->transaksi->transaction_detail))
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-0"><strong>Permintaan no. #{{$item->id}}:
                            </strong></p>
                            <ul>
                                @foreach($item->transaksi->transaction_detail as $permintaan_item)

                                @if($item->modul_id == 6) 
                                @if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
                                <li>
                                    {{$permintaan_item->transactionDetail_service->deskripsi}}
                                </li>
                                @endif

                                @elseif($item->modul_id == 10) 
                                @if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
                                <li>
                                    {{$permintaan_item->transactionDetail_service->deskripsi}}
                                </li>
                                @endif

                                @elseif($item->modul_id == 11) 
                                @if($permintaan_item->status == 'ask' || $permintaan_item->status == 'done')
                                <li>
                                    {{$permintaan_item->transactionDetail_service->deskripsi}}
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
                                @foreach($item->transaksi->transaction_detail as $permintaan_item)
                                @if($item->modul_id == 6) 
                                @if($permintaan_item->status != 'ask')
                                <li>
                                    {{$permintaan_item->transactionDetail_service->deskripsi}}
                                </li>
                                @endif

                                @elseif($item->modul_id == 10) 
                                @if($permintaan_item->status != 'ask')
                                <li>
                                    {{$permintaan_item->transactionDetail_service->deskripsi}}
                                </li>
                                @endif

                                @elseif($item->modul_id == 11) 
                                @if($permintaan_item->status != 'ask')
                                <li>
                                    {{$permintaan_item->transactionDetail_service->deskripsi}}
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

                    @if($item->transaksi->status)
                    @if($item->modul_id == 6) 
                    <a href="{{url('radiologi/transaksi/hasil')}}/{{$item->transaksi->slug}}" class="btn btn-hero btn-alt-success text-uppercase float-right mt-15" target="_blank">Lihat Hasil Pemeriksaan</a> 
                    @elseif($item->modul_id == 10)
                    <a href="{{url('labpk/transaksi/hasil')}}/{{$item->transaksi->slug}}" class="btn btn-hero btn-alt-success text-uppercase float-right mt-15" target="_blank">Lihat Hasil Pemeriksaan</a>
                    @elseif($item->modul_id == 11)
                    <a href="{{url('labpa/transaksi/hasil')}}/{{$item->transaksi->slug}}" class="btn btn-hero btn-alt-success text-uppercase float-right mt-15" target="_blank">Lihat Hasil Pemeriksaan</a>
                    @endif
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
        @empty
        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada penunjang</h4>
        </div>
        @endforelse
    </div>
</div>
@endsection