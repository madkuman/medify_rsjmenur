<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="" id="form-edit-golongan">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Ubah Data Golongan Pegawai</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content" id="block-edit-content">
                        <div class="d-none text-center" id="loading">
                            <i class="fa fa-2x fa-spinner fa-spin text-info"></i>
                        </div>
                        <div class="row d-none" id="edit-content">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Golongan Pegawai" name="nama" id="edit_nama"  required>
                                </div>
                                <div class="form-group">
                                    <label>Indek</label>
                                    <input type="number" step="any" class="form-control" placeholder="Jumlah Indek" name="indek" id="edit_indek" required>
                                </div>
                                <div class="form-group">
                                    <label>JP Dasar</label>
                                    <input type="number" step="any" class="form-control" placeholder="Jumlah JP Dasar" name="jp_dasar" id="edit_jp_dasar" required>
                                </div>
                                <div class="form-group">
                                    <label>Pajak(%)</label>
                                    <input type="number" step="any" class="form-control" placeholder="Jumlah Indek" name="pajak" id="edit_pajak" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125 btn-click-animate btn-edit" id="btn-edit">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>