<div class="modal fade" id="modal-update-keluarga" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title">Update Data Keluarga</h4>
            <p>Lengkapi Data-Data Keluarga</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-update-keluarga" method="POST" action="{{ route('edit-family', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="id" id="form-id">
          <div class="modal-body mx-20">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="form-nama" placeholder="Masukkan nama anggota keluarga"
                            name="nama" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kelamin">Jenis Kelamin</label>
                        <br>
                        <label class="css-control css-control-primary css-radio">
                            <input type="radio" class="css-control-input" name="gender" id="kelamin-lk" value="L" checked>
                            <span class="css-control-indicator"></span> Laki-Laki
                        </label>
                     
                        <label class="css-control css-control-primary css-radio">
                            <input type="radio" class="css-control-input" name="gender" id="kelamin-pr" value="P">
                            <span class="css-control-indicator"></span> Perempuan
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="form-tempat-lahir" name="tempat_lahir"
                            placeholder="Masukkan tempat lahir sesuai kartu keluarga" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" id="form-tanggal-lahir" name="tanggal_lahir" required="required">  
                          </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hubungan Keluarga</label>
                        <select class="form-control js-select2" style="width: 100%" id="form-relasi" name="hubungan" required>
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
                        <input type="text" class="form-control" id="form-nik" placeholder="Masukkan NIK sesuai kartu keluarga" name="nik" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tempat_lahir">Asuransi</label>
                        <input type="text" class="form-control" id="form-asuransi" name="asuransi"
                            placeholder="Masukkan tempat lahir sesuai kartu keluarga">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >No. Asuransi</label>
                        <input type="text" class="form-control" id="form-no-asuransi" placeholder="Masukkan nomor BPJS" name="no_asuransi">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 6">
                    <div class="form-group">
                        <label for="faskes">Faskes</label>
                        <input type="text" class="form-control" id="form-faskes" name="faskes" placeholder="Masukkan faskes">
                    </div>
                </div>
                <div class="col-md 6">
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <input type="text" class="form-control" id="form-kelas" name="kelas" placeholder="Masukkan kelas">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-alt-default btn-close" data-dismiss="modal">
                Tutup
              </button>
              <button class="btn btn-alt-primary btn-submit-edit" type="submit" id="buttonSubmitEdit"><i class="fa fa-check"></i> Simpan</button>
              <button class="btn btn-alt-primary" style="display: none" type="button"  id="buttonLoadingEdit" disabled>
                  <i class="fa fa-asterisk fa-spin"></i> Loading
              </button>
          </div>
        </form>
      </div>
    </div>
  </div>