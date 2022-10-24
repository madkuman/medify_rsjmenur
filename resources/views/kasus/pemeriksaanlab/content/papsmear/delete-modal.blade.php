<div class="modal fade" id="smearDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Hapus Pemeriksaan PAP SMEAR</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/smear/delete" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" class="form-control form-control-lg" id="smear_id" name="smear_id" placeholder="">
                        <h5 class="font-w400">
                            Apakah anda yakin akan menghapus data pemeriksaan PAP SMEAR ini?
                        </h5>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-100 float-right">
                                    <i class="fa fa-send mr-5"></i> Hapus Hasil PAP SMEAR
                                </button>
                                <button type="button" data-dismiss="modal" class="btn-alt btn-hero btn-regular min-width-100 float-right">Batal
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>