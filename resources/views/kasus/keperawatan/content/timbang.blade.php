<div class="block-content tab-content overflow-hidden px-50 pb-30">
    <div class="row">
        <div class="col-lg-12">

            @if(session('my_role_'.$kasus->nomor_kasus))
            <button type="button" class="btn-alt btn-primary min-width-125 float-right" onclick="timbangCreate()" id="create-timbang" ><i class="fa fa-pencil"></i> Buat Timbang Terima</button>
            @endif
        </div>
    </div>
    @php $count = count($timbangs) @endphp
    
    @forelse($timbangs as $timbang)
    <div class="row">
        <div class="col-md-12">
            <div class="block block-bordered block-mode-hidden">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Timbang Terima #{{$count--}}</h3>

                    @if($timbang->created_by == Auth::user()->id)
                    <button class="btn-block-option deleteTimbangBtn" data-id="{{$timbang->id}}">
                        <i class="si si-trash"></i>
                    </button>

                    <button type="button" class="btn-block-option edit-timbang" data-toggle="modal" data-target="#modal-create-timbang-terima" data-timbang="{{$timbang}}" data-id="{{$timbang->id}}">
                        <i class="si si-pencil"></i>
                    </button>
                    @endif


                    @php $slug_specialty_creator = $timbang->creator->specialty_detail->slug ?? '-' @endphp
                    @php $slug_specialty_user = Auth::user()->specialty_detail->slug ?? '-' @endphp

                    @if(empty($timbang->ppja_verifikasi_at) && $slug_specialty_creator != 'perawat-ners' && $slug_specialty_user == 'perawat-ners' || $slug_specialty_user == 'magister-keperawatan')
                    <a class="btn-block-option" href="{{url()->current()}}/verifikasi-ners/{{$timbang->id}}" data-toggle="tooltip" data-placement="top" title="Verifikasi" >
                        <i class="si si-check"></i>
                    </a>
                    @endif

                    @if(empty($timbang->perawat_menerima_at) && $timbang->created_by != Auth::user()->id)
                    <a class="btn-block-option" href="{{url()->current()}}/verifikasi-terima-pasien/{{$timbang->id}}" data-toggle="tooltip" data-placement="top" title="Terima Pasien" >
                        <i class="si si-share-alt"></i>
                    </a>
                    @endif

                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <h5 class="font-w400 mb-0">
                        <small>SITUATION</small>
                    </h5>
                    <h5 class="font-w400" style="white-space: pre-line">{{$timbang->subjective }}</h5>


                    <h5 class="font-w400 mb-0">
                        <small>BACKGROUND</small>
                    </h5>
                    <h5 class="font-w400" style="white-space: pre-line">{{$timbang->objective }}</h5>


                    <h5 class="font-w400 mb-0">
                        <small>ASSESSMENT</small>
                    </h5>
                    <h5 class="font-w400" style="white-space: pre-line">{{$timbang->assessment }}</h5>


                    <h5 class="font-w400 mb-0">
                        <small>RECOMMENDATION</small>
                    </h5>
                    <h5 class="font-w400" style="white-space: pre-line">{{$timbang->plan }}</h5>


                    <h5 class="font-w400 mb-0">
                        <small>
                            INSTRUKSI PPA
                        </small>
                    </h5>
                    <h5 class="font-w400" style="white-space: pre-line">{{$timbang->ppa }}</h5>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <label>Dibuat Oleh</label><br>
                            {{$timbang->creator->name}}<br>
                            <span class="font-w400"><i class="fa fa-clock-o text-muted"></i> {{indonesian_date($timbang->created_at,'d F Y, H:i')}}</span>
                        </div>
                        @if(isset($timbang->updated_by))
                        <div class="col-4">
                            <label>Diubah Oleh</label><br>
                            {{$timbang->updater->name}}<br>
                            <span class="font-w400"><i class="fa fa-clock-o text-muted"></i> {{indonesian_date($timbang->updated_at,'d F Y, H:i')}}</span>
                        </div>
                        @endif
                        @if(isset($timbang->ppja_verifikasi_at))
                        <div class="col-4">
                            <label>Diverifikasi Oleh</label><br>
                            {{$timbang->verifikator->name}}<br>
                            <span class="font-w400"><i class="fa fa-clock-o text-muted"></i> {{indonesian_date($timbang->ppja_verifikasi_at,'d F Y, H:i')}}</span>
                        </div>
                        @endif
                        @if(isset($timbang->perawat_menerima_by))
                        <div class="col-4">
                            <label>Diterima Oleh</label><br>
                            {{$timbang->penerima->name}}<br>
                            <span class="font-w400"><i class="fa fa-clock-o text-muted"></i> {{indonesian_date($timbang->perawat_menerima_at,'d F Y, H:i')}}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-50">
        <h4 class="font-w400 mb-5">Belum ada timbang terima tersedia</h4>
        <p>Klik tombol <b>Buat Timbang Terima</b> untuk menambahkan timbang terima baru</p>
    </div>
    @endforelse
</div>


<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/keperawatan/timbang-terima/delete" id="formDeleteTimbang">
    {{csrf_field()}}
    <input name="id" type="hidden" id="deleteTimbangId">
    
</form>