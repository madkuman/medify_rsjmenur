<div class="modal fade" id="modal-add-galeri" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="uploadForm" method="POST" action="{{url()->current()}}/galeri/upload" enctype="multipart/form-data" >
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Upload Galeri</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content row">
                        {{csrf_field()}}
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Upload Galeri</label>
                            <div class="custom-file">
                                <input type="file" name="file_galeri" class="form-control custom-file-input" id="customFile" required>
                                <label class="custom-file-label" for="customFile">Pilih file . .</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Judul</label>
                            <input type="text" id="judul-galery" class="form-control form-control-lg" autocomplete="off" name="judul" placeholder="Isi judul galeri">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-primary btn-click-animate">
                            <i class="fa fa-save submit"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>