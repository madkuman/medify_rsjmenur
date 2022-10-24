<div data-keyboard="false" class="modal fade" id="modal-create-tindakan-icd9" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Tindakan ICD 9 Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/tindakan/create" method="post" id="icd9-form">
                    {{ csrf_field() }}
                    <div class="block-content pb-0">    
                        <div id="create-modal-content-icd9">
                            <input type="hidden" name="kategori-tindakan" value="icd9">
                            <div class="form-group row icd9-class">
                                <label class="col-12" for="">Tindakan ICD9</label>
                                <div class="col-12">
                                    <input type="text" class="tindakan-icd9-autocomplete form-control form-control-lg" id="tindakan-icd9-text"  name="desc_icd" placeholder="Deskripsi Tindakan" value="" autocomplete="off">
                                </div>
                                <input type="hidden" name="icd_9" id="icd_9">
                            </div>
                            <div class="form-group row icd9-class">
                                <div class="col-12 text-center">
                                    <button type="submit" id="submit-create-tindakan-icd" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                        <i class="fa fa-send mr-5"></i> Tambah Tindakan Baru
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>Sugesti Tindakan</h6>
                    <div data-toggle="slimscroll" data-always-visible="true">
                        @forelse($suggest_icd9 as $item)
                        <div class="p-10 border-bottom">
                            <div class="row">
                                <div class="col-10">
                                    <span>
                                        {{$item->icd->code_icd}} - {{$item->icd->long_desc}} @if($item->icd->bpjs_support == 0) 
                                            <span class='badge badge-danger'>Tidak di Support BPJS</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-sm btn-alt-primary pull-right" type="button" onclick="addTindakanSuggest(this)" data-id="{{$item->icd_9}}" data-desc="{{$item->icd->code_icd}} - {{$item->icd->long_desc}}">+ Tambahkan</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center p-10">
                            <p>Tidak tersedia sugesti</p>
                        </div>
                        @endforelse
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>