@extends('layouts.main-simple')
@section('content')
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">HISTORI TINDAKAN</h3>
        <h4>Pasien {{$pasien->name}}</h4>
    </div>
    <div class="row">
        @foreach ($tindakan10 as $key => $tindakan)
        <div class="col-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h5>Kasus {{$tindakan[0]->kasus->judul_kasus}}</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="tindakan-item-{{$key}}"></button>
                    </div>
                </div>
                <div class="block-content soap-item" id="tindakan-item-{{$key}}">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach ($tindakan as $t)
                        <div class="col-md-12">
                            <div class="block block-transparent">
                                <div class="block-content p-0">
                                    <div class="row"> 
                                        <div class="col-md-8"> 
                                            @if(!empty($t->icd_9))
                                            <h6 class="font-w400 text-muted mb-5">Tindakan ICD9</h6>
                                            @else
                                            <h6 class="font-w400 text-muted mb-5" style="display: inline;">Tindakan Keperawatan</h6>
                                            @if($t->subscribe == 1)
                                            <span class="badge badge-success mx-10"><i class="fa fa-calendar mr-5"></i>Dijadwalkan rutin</span>
                                            @endif
                                            @endif
                                            <h5 class=" mb-0"><span class="font-w400">{{ $t->desc}}</span></h5>
                                            <h5 class="mb-15"><small class="font-w400">Biaya : Rp {{ number_format($t->price,0) }}</small></h5>
                                            <div class="row">
                                                <h6 class="col-6">
                                                    <small class="text-muted">Dibuat Oleh</small><br>
                                                    {{ $t->creator->name }} <br>
                                                    <span class="font-w400">{{ $t->tanggal }}</span>
                                                </h6>
                                                @if(!empty($t->subscribed_by) && $t->subscribe == 1)
                                                <h6 class="col-6">
                                                    <small class="text-muted">Dijadwalkan Rutin Oleh </small><br>
                                                    {{ $t->subscriber->name }}
                                                </h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection