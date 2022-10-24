
<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12 mb-20">
            @if($allow_crud)
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-diagnosis"><i class="fa fa-pencil"></i> Buat Diagnosis</button>
            <button type="button" onclick="historiDiagnosis()" class="btn-alt btn-info  min-width-125 float-right" ><i class="fa fa-loop"></i> Histori Diagnosis</button>
                @if(isset($kasus->active_sep->no_sep))
                    <button type="button" class="btn-alt btn-info min-width-125 float-right update-plafon"><i class="fa fa-paper-plane"></i> Update Plafon</button>
                @endif
            @endif
        </div>
        <form id="update_plafon">
            {{csrf_field()}}
        </form>
        

        <?php $i = 1; ?>
        @forelse ($diagnosis as $d)

        <div class="col-md-12 diagnosis-block">
            <div class="block block-transparent">
                <div class="block-content p-0">
                    <div class="row"> 
                        <div class="col-md-8"> 
                            @php
                            if($d->type == 'komplikasi'){
                                $diagnosis_tipe = 'Komplikasi';
                                $diagnosis_class = 'font-w400 text-info';
                            }
                            elseif($d->type =='utama'){
                                $diagnosis_tipe = 'Utama';
                                $diagnosis_class = 'font-w600 text-primary';
                            }
                            else{
                                $diagnosis_tipe = 'Sekunder';
                                $diagnosis_class = 'font-w400 text-muted';
                            }
                            $dx_tags = $d->icd10['tags'] ?? '-';
                            @endphp
                            @if($allow_crud)
                            <div class="btn-group float-right" role="group" aria-label="Third group">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </button>
                                <div class="dropdown-menu" aria-labelledby="toolbarDrop">
                                    <h6 class="dropdown-header">Menu</h6>
                                    @if($d->type !='utama')
                                    <a href="{{url()->current()}}/{{$d->id}}/utama">
                                        <button type="button" class="dropdown-item"  data-toggle="tooltip" data-placement="top" title="Jadikan Diagnosis Utama" data-id="{{$d->id}}" data-type="utama">
                                            <i class="fa fa-flag"></i> Utama
                                        </button>
                                    </a>
                                    @endif
                                    @if($d->type !='komplikasi')
                                    <a href="{{url()->current()}}/{{$d->id}}/komplikasi">
                                        <button type="button" class="dropdown-item"  data-toggle="tooltip" data-placement="top" title="Jadikan Diagnosis Komplikasi" data-id="{{$d->id}}" data-type="komplikasi">
                                            <i class="fa fa-flag"></i> Komplikasi
                                        </button>
                                    </a>
                                    @endif
                                    @if($d->type !='sekunder')
                                    <a href="{{url()->current()}}/{{$d->id}}/sekunder">
                                        <button type="button" class="dropdown-item"  data-toggle="tooltip" data-placement="top" title="Jadikan Diagnosis Sekunder" data-id="{{$d->id}}" data-type="sekunder">
                                            <i class="fa fa-flag"></i> Sekunder
                                        </button>
                                    </a>
                                    @endif

                                    @if(strpos($dx_tags, 'kanker') !== false)
                                    <a href="javascript:void(0)">
                                        <button type="button" class="dropdown-item btn-kanker-toggle"  data-toggle="tooltip" data-placement="top" title="" data-id="{{$d->id}}" data-stadium="{{$d->kanker_stadium}}">
                                            <i class="fa fa-ribbon"></i> Update Stadium Kanker
                                        </button>
                                    </a>
                                    @endif

                                    @if($my_role_admin == 1 || $d->created_by == Auth::user()->id)
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="diagnosisDeleteModal({{$d->id}})">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                    

                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            <h6 class="{{$diagnosis_class}} text-uppercase mb-5">Diagnosis {{$diagnosis_tipe}}
                                @if($d->icd10->bpjs_support == 0)
                                    <span class="badge badge-danger">Tidak di Support BPJS</span>
                                @endif
                            </h6>
                            <h5 class=" mb-15"><span class="font-w600">{{ $d->icd10['code_icd'] ?? '-'}}</span> - <span class="font-w400">{{ $d->icd10['long_desc'] ?? '-' }}</span>
                            @if(strpos($dx_tags, 'kanker') !== false)
                            <br><small>(Stadium : {{$d->kanker_stadium ?? '-'}})</small>
                            @endif
                            </h5>
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
        @empty

        <div class="col-12 text-center py-50">
            <h4 class="font-w400 mb-5">Belum ada diagnosis</h4>
            <p>Klik tombol <b>Buat Diagnosis</b> untuk menambahkan tagihan baru</p>
        </div>

        @endforelse
        <form method="POST" action="{{url()->current()}}/toggle-utama" id="formToggleDiagnosisUtama">
            {{csrf_field()}}
            <input type="hidden" name="diagnosis_id" id="diagnosis_id">
        </form>

        <div class="modal fade" id="modal_cmg" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Pilihan Spesial CMG</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <form id="cmg_form">
                            {{csrf_field()}}
                            <div class="block-content" id="cmg-content">

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-alt-success" id="submit-cmg">
                            <i class="fa fa-check"></i> Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>