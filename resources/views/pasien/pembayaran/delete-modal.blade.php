<div class="modal fade" id="pembayaranDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Hapus Metode Pembayaran </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('pasien')}}/{{ $id }}/pembayaran/delete" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" class="form-control form-control-lg" id="pembayaran-id" name="pembayaran_id" placeholder="">
                        <input type="hidden" class="form-control form-control-lg" id="pasien-id" name="pasien_id" value="{{$id}}">
                        <input type="hidden" class="form-control form-control-lg" id="utama" name="utama">
                        <h5 class="font-w400">
                            Apakah anda yakin akan menghapus data metode pembayaran ini?
                        </h5>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-100 float-right">
                                    <i class="fa fa-send mr-5"></i> Hapus
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