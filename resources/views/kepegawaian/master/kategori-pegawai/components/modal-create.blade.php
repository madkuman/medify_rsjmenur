<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/kategori-pegawai/create')}}" id="form-add-kategori-pegawai">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Tambah Data Kategori Pegawai</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Kategori Pegawai" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label>Pembagian Jaspel(%)</label>
                                    <input type="number" step="any" class="form-control" placeholder="Pembagian Jaspel" name="pembagian_jaspel" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125 btn-click-animate btn-simpan" id="btn-simpan">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>