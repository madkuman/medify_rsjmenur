<div class="modal fade" id="modal-edit" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-edit" enctype="multipart/form-data">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title" id="title-modal-edit"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="edit-id" value="">
                        <div class="row">
                            <div class="col-12">
                                <label>Kode</label>
                                <input type="text" id="edit-kode" name="kode" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label>Nama</label>
                                <input type="text" id="edit-nama" name="nama" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label>Tipe</label>
                                <input type="text" id="edit-tipe" name="tipe" class="form-control">
                            </div>
                            <div class="col-12">
                                <label>Satuan</label>
                                <input type="text" id="edit-satuan" name="satuan" class="form-control">
                            </div>
                            <div class="col-12">
                                <label>Harga</label>
                                <input type="number" id="edit-harga" name="harga" class="form-control">
                            </div>
                            <div class="col-12">
                                <label>Kelompok Upload</label>
                                <input type="number" id="edit-kelompok" name="kelompok" class="form-control">
                            </div>
                            <div class="col-12">
                                <label>Akun Rekening</label>
                                <select class="js-example-basic-multiple form-control akun-rekening-select" name="akun_rekening[]" placeholder="Pilih Akun Rekening" multiple="multiple" style="width: 100%;">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit btn-click-animate" type="submit" id="btnSubmitEdit"> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>