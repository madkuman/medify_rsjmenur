<div class="modal fade" id="modal-institusi-pendidikan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/institusi-pendidikan/baru')}}" id="form-add">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Tambah Institusi Pendidikan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Institusi Pendidikan</label>
                                    <input type="text" name="nama" id="createnama" placeholder="Masukkan nama master institusi pendidikan" class="form-control" 
                                    required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-default btn-hero pull-right btn-close" data-dismiss="modal">
                            Tutup
                        </button>
                        <button class="btn btn-primary btn-hero pull-right btn-submit-create" type="submit" id="buttonSubmitCreate"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-hero pull-right" style="display: none" type="button"  id="buttonLoadingCreate" disabled>
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>