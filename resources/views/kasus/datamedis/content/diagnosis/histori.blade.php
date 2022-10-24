@extends('layouts.main-simple')
@section('content')
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">HISTORI DIAGNOSIS</h3>
        <h4>Pasien {{$pasien->name}}</h4>
    </div>
    <div class="row">
        @foreach ($diagnosiss as $key => $diagnosis)
        <div class="col-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h5 class="mb-0">Kasus {{$diagnosis[0]->kasus->judul_kasus}}</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="diagnosis-item-{{$key}}"></button>
                    </div>
                </div>
                <div class="block-content soap-item" id="diagnosis-item-{{$key}}">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach ($diagnosis as $d)
                        <div class="col-md-12">
                            <div class="block block-transparent">
                                <div class="block-content p-0">
                                    <div class="row"> 
                                        <div class="col-md-8"> 
                                            @php
                                            if($d->utama == 1)
                                            $diagnosis_tipe = 'Tambahan';
                                            else
                                            $diagnosis_tipe = 'Utama';
                                            @endphp

                                            @if ($d->utama == 1)
                                            <h6 class="font-w400 text-muted mb-5">Diagnosis Utama</h6>
                                            @else
                                            <h6 class="font-w400 text-muted mb-5">Diagnosis</h6>
                                            @endif
                                            <h5 class=" mb-15"><span class="font-w600">{{ $d->icd10['code_icd'] }}</span> - <span class="font-w400">{{ $d->icd10['long_desc'] }}</span></h5>
                                            <h6>
                                                <small class="text-muted">Dibuat Oleh</small><br>
                                                {{ $d->creator->name }}
                                                <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> {{ $d->tanggal }}</span>
                                            </h6>
                                        </div>
                                        @if(count($d->clinical_pathway) > 0)
                                        <div class="col-md-4">
                                            <h6 class="text-uppercase text-muted font-w600 mb-5">REFERENSI</h6>
                                            <ul>
                                                @foreach($d->clinical_pathway as $artikel)
                                                <li><a href="{{url('')}}/clinical-pathways/{{$artikel->id}}">{{$artikel->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
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