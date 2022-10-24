<div class="modal fade" id="editlayananModal" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-lg" role="document">
        <div class="block rounded modal-content transaction-index">
            <div class="modal-header pb-0">
                <h2>Ubah Layanan</h2>
            </div>
            <div class="modal-body pb-0 pt-0">
                <h5>Jangan lupa klik simpan saat telah melakukan perubahan terhadap layanan</h5>
            </div>
            <div class="modal-content">
                <div class="table-full-width">
                    <div class="block-content">
                      <form id="modallayananEdit">
                        <div class="form-group">
                            <label class="control-label">Nama Layanan</label>
                            <input required id="layanan_nama" value="" class="form-control" type="text" name="nama" placeholder="nama baru layanan" />
                        </div>
                          <div class="form-group">
                              <label class="control-label">Tarif Layanan</label>
                              <input required id="layanan_tarif" value="" class="form-control" type="text" name="harga" placeholder="tarif baru layanan" />
                          </div>
                            <div class="block-content">
                                <div class="col-md-12 text-right">
                                        <button class="btn btn-secondary" style="padding:0px 40px;" type="button" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary ml-2" style="padding:0px 40px;" type="button" id="buttonEditModal">Simpan</button>
                                        <button class="btn btn-alt-primary ml-2" style="display: none; padding:0px 40px;" type="button"  id="buttonEditLoading">
                                        <i class="fa fa-asterisk fa-spin"></i> Menyimpan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
