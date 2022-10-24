<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout modal-dialog-centered modal-lg" role="document">
        <div class="block rounded modal-content">
            <div class="modal-header pb-0">
                <h2>Tambah Layanan Kamar Jenazah</h2>
            </div>
            <div class="modal-content">
              <div class="col-12 ml-2">
                <form id="addBarang">
                  <div class="form-group">
                      <label class="control-label">Nama Layanan</label>
                      <input required id="layananbaru_nama" value="" class="form-control" type="text" name="nama" placeholder="nama layanan" />
                  </div>
                  <div class="form-group">
                      <label class="control-label">Tarif Layanan</label>
                      <input required id="layananbaru_tarif" value="" class="form-control" type="text" name="harga" placeholder="tarif layanan" />
                  </div>
                  <div class="form-group">
                    <label class="control-label">Jenis Layanan</label>
                    <select name="tempatMeninggal" class="form-control" style="width:300px" data-size="5" id="jenisLayanan">
                    <option selected disabled>-- Pilih Jenis Layanan --</option>
                    <option value="0">Paket Umum (ada pada Menular & Tidak Menular)</option>
                    <option value="2">Paket Khusus (penyakit menular)</option>
                    <option value="4">Pilihan Peti</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-primary pull-right" type="button" id="buttonApply">Tambah</button>
              <button class="btn btn-alt-primary pull-right" style="display: none;" type="button" id="buttonAddLoading">
                <i class="fa fa-asterisk fa-spin"></i> Memuat
                </button>
            </div>
        </div>
    </div>
</div>
