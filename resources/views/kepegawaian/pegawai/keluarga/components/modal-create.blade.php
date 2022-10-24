<div class="modal fade" id="modal-create-keluarga" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title">Tambah Data Keluarga</h4>
            <p>Lengkapi Data-Data Keluarga</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-create-keluarga" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body mx-20">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama anggota keluarga"
                            name="nama" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kelamin">Jenis Kelamin</label>
                        <br>
                        <label class="css-control css-control-primary css-radio">
                            <input type="radio" class="css-control-input" name="gender" value="L" checked>
                            <span class="css-control-indicator"></span> Laki-Laki
                        </label>
                     
                        <label class="css-control css-control-primary css-radio">
                            <input type="radio" class="css-control-input" name="gender" value="P">
                            <span class="css-control-indicator"></span> Perempuan
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir"
                            placeholder="Masukkan tempat lahir sesuai kartu keluarga" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tanggal_lahir" required="required">  
                          </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hubungan Keluarga</label>
                        <select class="form-control js-select2" style="width: 100%" name="hubungan" required>
                            <option>— Pilih —</option>
                            <option value="Anak">Anak</option>
                            <option value="Istri">Istri</option>
                            <option value="Suami">Suami</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" placeholder="Masukkan NIK sesuai kartu keluarga" name="nik" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tempat_lahir">Asuransi</label>
                        <input type="text" class="form-control" name="asuransi"
                            placeholder="Masukkan tempat lahir sesuai kartu keluarga">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >No. Asuransi</label>
                        <input type="text" class="form-control" placeholder="Masukkan nomor BPJS" name="no_asuransi">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 6">
                    <div class="form-group">
                        <label for="faskes">Faskes</label>
                        <input type="text" class="form-control" name="faskes" placeholder="Masukkan faskes">
                    </div>
                </div>
                <div class="col-md 6">
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <input type="text" class="form-control" name="kelas" placeholder="Masukkan kelas">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-alt-default btn-close" data-dismiss="modal">
                Tutup
              </button>
              <button class="btn btn-alt-primary btn-submit-create" type="submit" id="buttonSubmitCreate"><i class="fa fa-check"></i> Simpan</button>
              <button class="btn btn-alt-primary" style="display: none" type="button"  id="buttonLoadingCreate" disabled>
                  <i class="fa fa-asterisk fa-spin"></i> Loading
              </button>
          </div>
        </form>
      </div>
    </div>
  </div>