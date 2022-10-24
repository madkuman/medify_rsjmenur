@extends('layouts.main-simple')
@section('content')
<div class="px-20 pt-20">
    <div class="text-center">
        <h3 class="mb-0">HISTORI CPPT</h3>
        <h4>Pasien {{$kasus->identitas->nama}}</h4>
    </div>
    <div class="row">
        @foreach ($cppts as $key => $cpptss)
        <div class="col-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h5 class="mb-0">
                        Kasus {{$cpptss[0]->kasus->judul_kasus}}
                        <br>
                        <p class="mb-0" style="font-size: 10px;">{{$cpptss[0]->kasus->lokasi->lokasi->nama}}</p>
                    </h5>
                    <?php $i = sizeof($cpptss); ?>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="cpptss-item-{{$key}}"></button>
                    </div>
                </div>
                <div class="block-content soap-item" id="cpptss-item-{{$key}}">
                    <div class="row">
                        @foreach($cpptss as $cppt)
                        <div class="col-12">
                            <div class="block block-bordered block-mode-hidden">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        {{($cppt->jenis) ? strtoupper($cppt->jenis) : 'CPPT'}} {{ $i }}
                                        <small> 
                                            {{$cppt->created_at->format('d-m-Y')}} 
                                            @if($cppt->creator->profesi == 1 ) @php $class_cppt = 'badge badge-primary' @endphp
                                            @elseif($cppt->creator->profesi == 2 ) @php $class_cppt = 'badge badge-success' @endphp
                                            @elseif($cppt->creator->profesi == 3 ) @php $class_cppt = 'badge badge-danger' @endphp
                                            @elseif($cppt->creator->profesi == 10 ) @php $class_cppt = 'badge badge-warning' @endphp
                                            @else @php $class_cppt = 'badge badge-secondary' @endphp 
                                            @endif

                                            <span class="{{$class_cppt}}"> 
                                                {{$cppt->creator->profesi_detail->title}}
                                                -
                                                {{$cppt->creator->name ?? '-'}}
                                            </span> 
                                        </small> 
                                    </h3>

                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" aria-controls="cppt-item-{{$i}}"></button>
                                    </div>
                                </div>
                                <div class="block-content soap-item" id="cppt-item-{{$i}}">

                                    @if($cppt->jenis == 'adime')


                                    <h5 class="font-w400 mb-0">
                                        <small>ASSESSMENT</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->assessment }}</h5>

                                    <h5 class="font-w400 mb-0">
                                        <small>DIAGNOSIS</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->subjective }}</h5>


                                    <h5 class="font-w400 mb-0">
                                        <small>INTERVENTION</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->objective }}</h5>


                                    <h5 class="font-w400 mb-0">
                                        <small>MONITORING</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->plan }}</h5>

                                    <h5 class="font-w400 mb-0">
                                        <small>EVALUATION</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->ppa }}</h5>
                                    @else
                                    @if($cppt->jenis == 'rapt')
                                    <div class="row">
                                        <div class="col-4">
                                            <h5 class="font-w400 mb-0">
                                                <small>KEBUTUHAN PELAYANAN</small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line" id="kebutuhan_pelayanan_rapt">
                                                @if($cppt->preventif) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Preventif
                                                @if($cppt->kuratif) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Kuratif
                                                @if($cppt->rehab) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Rehabilitatif
                                                @if($cppt->paliatif) <i class="fa fa-check text-primary"></i> @else <i class="fa fa-close text-danger"></i> @endif Paliatif
                                            </h5>
                                        </div>
                                        <div class="col-4">
                                            <h5 class="font-w400 mb-0">
                                                <small>PRIORITAS</small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line">
                                                @if($cppt->prioritas == 'prioritas') <strong>Prioritas</strong>
                                                @elseif($cppt->prioritas == 'tunda') Dapat Ditunda
                                                @endif
                                            </h5>

                                        </div>
                                        <div class="col-4">
                                            <h5 class="font-w400 mb-0">
                                                <small>PERKIRAAN HARI RAWAT</small>
                                            </h5>
                                            <h5 class="font-w400" style="white-space: pre-line">
                                                {{$cppt->perkiraan_hari_rawat ?? '-'}} hari
                                            </h5>
                                        </div>
                                    </div>
                                    @endif
                                    <h5 class="font-w400 mb-0">
                                        <small>SUBJECTIVE</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->subjective }}</h5>


                                    <h5 class="font-w400 mb-0">
                                        <small>OBJECTIVE</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->objective }}</h5>


                                    <h5 class="font-w400 mb-0">
                                        <small>ASSESSMENT</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->assessment }}</h5>


                                    <h5 class="font-w400 mb-0">
                                        <small>PLAN</small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->plan }}</h5>


                                    <h5 class="font-w400 mb-0">
                                        <small>
                                            @if($cppt->creator->profesi == 1)
                                            INSTRUKSI DOKTER
                                            @else
                                            KETERANGAN
                                            @endif
                                        </small>
                                    </h5>
                                    <h5 class="font-w400" style="white-space: pre-line">{{$cppt->ppa }}</h5>
                                    @if(!empty($cppt->discharge_planning))
                                    @php $item = json_decode($cppt->discharge_planning) @endphp
                                    @php $item = (array) $item @endphp
                                    @include('kasus.datamedis.content.asesmenawal.components.view-pulang',['item' => $item])
                                    @endif

                                    @endif
                                    <div class="row">
                                        <div class="col-4">
                                            <h6 class="p-10">
                                                <small class="text-muted">Dibuat Oleh</small><br>
                                                {{ $cppt->creator->name ?? '-'}}<br>
                                                <span class="font-w400"> {{ $cppt->tanggal }}</span>
                                            </h6>        
                                        </div>
                                        @if(!empty($cppt->updated_by))
                                        <div class="col-4">
                                            <h6 class="p-10">
                                                <small class="text-muted">Diupdate Oleh</small><br>
                                                {{ $cppt->updater->name }}<br>
                                                <span class="font-w400"> {{ $cppt->tanggal_update }}</span>
                                            </h6>                        
                                        </div>                    
                                        @endif

                                        @if(!empty($cppt->verified_by))
                                        <div class="col-4 ">
                                            <h6 class="p-10">
                                                <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                                                {{$cppt->verifier->name}}<br>
                                                <span class="font-w400"> {{ $cppt->tanggal_verifikasi }}</span>
                                            </h6>                        
                                        </div>
                                        @else
                                        <div class="col-4 hide" id="cppt_container_verified_{{$i}}">
                                            <h6 class="p-10">
                                                <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                                                <span id="cppt_verified_by_{{$i}}"></span><br>
                                                <span class="font-w400" id="cppt_verified_at_{{$i}}"></span>
                                            </h6>                        
                                        </div>
                                        @endif

                                        @if(!empty($cppt->verified_ners_by))
                                        <div class="col-4 ">
                                            <h6 class="p-10">
                                                <small class="text-muted">Verifikasi NERS Oleh</small><br>
                                                {{$cppt->verifikatorNers->name}}<br>
                                                <span class="font-w400"> {{ indonesian_date($cppt->verified_ners_at) }}</span>
                                            </h6>                        
                                        </div>
                                        @else
                                        <div class="col-4 hide" id="cppt_ners_container_verified_{{$i}}">
                                            <h6 class="p-10">
                                                <small class="text-muted">Verifikasi NERS Oleh</small><br>
                                                <span id="cppt_ners_verified_by_{{$i}}"></span><br>
                                                <span class="font-w400" id="cppt_ners_verified_at_{{$i}}"></span>
                                            </h6>                        
                                        </div>
                                        @endif
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
        @endforeach
    </div>
</div>
@endsection