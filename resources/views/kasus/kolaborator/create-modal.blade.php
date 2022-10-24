<div class="modal fade" id="modalTambahKolaborator" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Tambah Kolaborator Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-input-normal">Cari Pengguna Lain</label>
                        <input type="text" class="form-control" id="inputSearch" name="keyword" placeholder="Cari.." autocomplete="off">
                    </div>
                    <div id="daftarPengguna" style="min-height: 300px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Print</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <a href="javascript:void(0)" type="btn" class="btn-alt btn-block btn-primary ml-0 print-konsul" target="_blank">
                                <input class="id-input-konsul" type="hidden" name="id_konsul" value="">
                                <i class="fa fa-print"></i>Print Lembar Konsultasi
                            </a>
                        </div>
                        <div class="col-lg-6 col-12">
                            <a href="javascript:void(0)" type="btn" class="btn-alt btn-block btn-primary ml-0 print-dpjp" target="_blank">
                                <input class="id-input-dpjp" type="hidden" name="id_dpjp" value="">
                                <i class="fa fa-print"></i>Print Lembar Alih DPJP
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
