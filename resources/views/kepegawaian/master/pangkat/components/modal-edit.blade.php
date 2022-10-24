<div class="modal fade" id="modal-edit-pangkat" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/pangkat/edit')}}" id="form-add">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Edit Pangkat</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}

                        <div class="text-center" id="loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>
                        <div class="row d-none" id="edit-content">
                            <div class="col-md-12">
                                <div class="row" >
                                    <input type="hidden" id="pangkat-edit" name="pangkatid">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Nama Pangkat</label>
                                            <input type="text" name="nama" placeholder="Masukkan nama master pangkat"
                                                class="form-control" required autocomplete="off" id="nama-pangkat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Nama Pendek 1</label>
                                            <input type="text" name="nama_pendek_1" placeholder="Masukkan nama mendek"
                                                class="form-control" required autocomplete="off" id="nama-pendek-1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Nama Pendek 2</label>
                                            <input type="text" name="nama_pendek_2" placeholder="Masukkan nama pendek"
                                                class="form-control" required autocomplete="off" id="nama-pendek-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Usia Pensiun</label>
                                            <input type="number" name="usia" placeholder="Masukkan usia pensiun"
                                                class="form-control" autocomplete="off" id="usia-pensiun">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Strata</label>
                                            <input type="text" name="strata" placeholder="Masukkan strata pangkat"
                                                class="form-control" autocomplete="off" id="strata">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Urutan Strata</label>
                                            <input type="number" name="strata_order" placeholder="Masukkan urutan strata"
                                                class="form-control" autocomplete="off" id="strata-order">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Kenkatba</label>
                                            <input type="text" name="kenkatba" placeholder="Masukkan kenkatba"
                                                class="form-control" autocomplete="off" id="kenkatba">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-default btn-hero pull-right btn-close" data-dismiss="modal">
                            Tutup
                        </button>
                        <button class="btn btn-primary btn-hero pull-right btn-submit-edit" type="submit" id="buttonSubmitEdit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-hero pull-right" style="display: none" type="button"  id="buttonLoadingEdit" disabled>
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>