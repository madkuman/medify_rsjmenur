<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/penghargaan/edit')}}"  enctype="multipart/form-data" id="form-edit">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Edit Penghargaan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id">
                        <div class="text-center" id="loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>
                        <div class="row d-none" id="edit-content">
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Penghargaan</label>
                                    <input type="text" name="nama" id="nama" placeholder="Masukkan nama penghargaan" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">TMT</label>
                                    <input type="text" id="tmt" class="js-datepicker form-control datepicker" name="tmt" placeholder="Masukkan Tanggal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">ST Number</label>
                                    <input type="text" name="st_number" id="st-number" placeholder="Masukkan number" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value=""> -- Pilih Status -- </option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Pemberi</label>
                                    <input type="text" name="pemberi" id="pemberi" placeholder="Masukkan pemberi penghargaan" class="form-control pemberi" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Upload Sertifikat  <small>(Opsional)</small></label>
                                    <div class="input-group">
                                      <span class="input-group-prepend mt-5">
                                        <span class="btn btn-default btn-file btn-outline-primary">
                                          <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgSertifikat" name="sertifikat">
                                        </span>
                                      </span>
                                      <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
                                    </div>
                                    <img class="mt-10" id='img-uploadSertifikat'/>
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