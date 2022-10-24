@extends('layouts.main-simple')
@section('content')
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">HISTORI RESEP</h3>
        <h4>Pasien {{$pasien->name}}</h4>
    </div>
    <div class="row">
        @foreach ($reseps as $key => $resep)
        <div class="col-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h5>Kasus {{$resep[0]->kasus->judul_kasus}}</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="resep-item-{{$key}}"></button>
                    </div>
                </div>
                <div class="block-content soap-item" id="resep-item-{{$key}}">
                    <div class="row">
                        @forelse ($resep as $r)
                        <div class="col-md-6">
                            <div class="block block-rounded block-bordered">
                                <div class="block-content">
                                    @if(!empty($r->transaksi_id))
                                    <h6 class="pt-10">
                                        <span class="font-w400">@if(!empty($r->transaksi_farmasi->ori_detail->nomor_resep))
                                            {{$r->transaksi_farmasi->ori_detail->nomor_resep}} -
                                            @endif
                                            @if(!empty($r->transaksi_farmasi->owner_detail->nama)) 
                                            {{ $r->transaksi_farmasi->owner_detail->nama }} 
                                            @else
                                            -
                                        @endif</span>
                                    </h6>
                                    <hr>
                                    @endif

                                    @foreach ( $r->resepDetail as $resepDetail )
                                    <span class="text-muted font-w400"> {{ $resepDetail->type }} </span>
                                    @if($resepDetail->kategori == 'racikan')
                                    <h6 class="font-w600 mb-5" style="white-space: pre;">{{ $resepDetail->racikan }} </h6>
                                    @else
                                    <h6 class="font-w600 mb-5 mt-5"> {{ $resepDetail->obat_name }} </h6>
                                    @endif
                                    <span>Jumlah : {{ $resepDetail->jumlah }}</span><br>
                                    <span>Aturan : {{ $resepDetail->aturan }}</span>
                                    <hr>

                                    @endforeach

                                    <h6 class="pt-10">
                                        <small class="text-muted">Dibuat Oleh</small><br>
                                        <span class="float-right"> {{ $r->tanggal }} </span>
                                        {{ $r->doctor['name'] }}
                                    </h6>
                                    @if(!empty($r->updated_by))
                                    <h6 class="pt-10">
                                        <small class="text-muted">Diupdate Oleh</small><br>
                                        <span class="float-right"> {{ $r->tanggal_update }} </span>
                                        {{ $r->doctor2['name'] }}
                                    </h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection