<div class="modal fade" id="modal-create-lokasi" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pindahkan Pasien</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/lokasi/create" method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="nomor-kasus" placeholder="" value="{{ $nomor_kasus }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Lokasi</label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-lg" id="" name="lokasi" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Alasan</label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-lg" id="" name="alasan" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-hero btn-alt-primary min-width-175">
                                    <i class="fa fa-send mr-5"></i> Pindahkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>