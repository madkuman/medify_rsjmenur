<div class="modal fade" id="modal-create-diagnosis" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Diagnosis Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/diagnosis/create" method="post">
                        {{ csrf_field() }}
                        <div class="col-xl-12">
                            <div class="form-group row">
                                <label class="col-12" for="example-autocomplete1">Diagnosis</label>
                                <div class="col-lg-12">
                                    <input type="text" class="diagnosis-autocomplete form-control" id="nama-diagnosis" name="nama-diagnosis" placeholder="Ketikkan diagnosis...">
                                </div>
                                <span id="diagnosis_error_wrapper"></span>
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="nomor-kasus" placeholder="" value="{{ $nomor_kasus }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="id-diagnosis" name="id-diagnosis" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-12">
                            
                            <div class="form-group row">
                                <label class="col-12">Jenis Diagnosis</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="type" id="diagnosis-type-utama" value="utama" checked>
                                        <label class="custom-control-label" for="diagnosis-type-utama">Utama</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="type" id="diagnosis-type-komplikasi" value="komplikasi">
                                        <label class="custom-control-label" for="diagnosis-type-komplikasi">Komplikasi</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="type" id="diagnosis-type-sekunder" value="sekunder">
                                        <label class="custom-control-label" for="diagnosis-type-sekunder">Sekunder</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" id="submit-create-diagnosis" class="btn-alt btn-click-animate btn-hero btn-primary float-right min-width-175">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                        <hr>
                        <h6>Sugesti Diagnosis</h6>
                        <div data-toggle="slimscroll" data-always-visible="true">
                            @foreach($suggest_diagnosis as $item)
                            <div class="p-10 border-bottom">
                                <div class="row">
                                    <div class="col-10">
                                        <span>
                                        {{$item->icd->code_icd}} - {{$item->icd->long_desc}} 
                                        @if($item->icd->bpjs_support == 0) 
                                            <span class='badge badge-danger'>Tidak di Support BPJS</span>
                                        @endif
                                        </span>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-sm btn-alt-primary pull-right" type="button" onclick="addDiagnosisSuggest(this)" data-id="{{$item->icd->id}}" data-desc="{{$item->icd->code_icd}} - {{$item->icd->long_desc}}">+ Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>