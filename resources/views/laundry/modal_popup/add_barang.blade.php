<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-lg" role="document">
        <div class="block rounded modal-content">
            <div class="modal-header pb-0">
                <h2>Tambah Jenis Barang</h2>
            </div>
            <div class="modal-content">
              <div class="col-12 ml-2">
                <form id="addBarang">
                  <div class="form-material">
                      <h5 class="mb-0">Nama Barang</h5>
                      <input type="text" class="form-control" id="namaBarang" name="nama" placeholder="Nama Barang">
                      <h5 class="mb-0 mt-3">Keterangan Barang</h5>
                      <input type="text" class="form-control mb-4" id="keteranganBarang" name="ket" placeholder="Keterangan Barang">
                  </div>
                </form>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-primary pull-right" type="button" id="buttonApply">Tambah</button>
              <button class="btn btn-alt-primary pull-right" style="display: none;" type="button"  id="buttonLoading">
                <i class="fa fa-asterisk fa-spin"></i> Memuat
                </button>
            </div>
        </div>
    </div>
</div>
