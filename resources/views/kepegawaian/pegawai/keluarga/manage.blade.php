{{-- modal tambah data keluarga --}}
<div class="modal fade" id="modal-add-family" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
      <form id="form-add-family" method="POST" action="{{ route('add-family', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="nama" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama anggota keluarga" name="name">
          </div>
          <div class="form-group">
            <label for="kelamin">Jenis Kelamin</label>

            <br>
            <label class="css-control css-control-primary css-radio">
              <input type="radio" class="css-control-input" name="sex" id="kelamin" value="L" checked>
              <span class="css-control-indicator"></span> Laki-Laki
            </label>
            <br>
            <label class="css-control css-control-primary css-radio">
              <input type="radio" class="css-control-input" name="sex" id="kelamin" value="P">
              <span class="css-control-indicator"></span> Perempuan
            </label>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="birth_place" placeholder="Masukkan tempat lahir sesuai kartu keluarga">
          </div>
          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <div class="input-group">
              <input type="text" class="form-control " id="birth-date" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="birth_date" required="required">  
            </div>
          </div>
          <div class="form-group">
            <label for="pisat">PISAT</label>
            <select class="form-control js-select2" style="width: 100%" id="pisat" name="relationship">
              <option>— Pilih Jenis PISAT —</option>
              <option value="Anak">Anak</option>
              <option value="Istri">Istri</option>
              <option value="Suami">Suami</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK sesuai kartu keluarga" name="citizen_number">
          </div>
          <div class="form-group">
            <label for="no_bpjs">No. BPJS</label>
            <input type="text" class="form-control" id="no_bpjs" placeholder="Masukkan nomor BPJS" name="bpjs">
          </div>
          <div class="form-group">
            <label for="faskes">Faskes</label>
            <input type="text" class="form-control" id="" name="faskes" placeholder="Masukkan faskes">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- modal edit data keluarga --}}
<div class="modal fade" id="modal-edit-family" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Ubah Data Keluarga</h4>
          <p>Lengkapi Data-Data Keluarga</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-family" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="nama" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="name" placeholder="Masukkan nama anggota keluarga" name="name">
          </div>
          <div class="form-group" id="jenis-kelamin">
            <label for="kelamin">Jenis Kelamin</label>

            <br>
            <label class="css-control css-control-primary css-radio">
              <input type="radio" class="css-control-input" name="sex" value="L" id="sexL">
              <span class="css-control-indicator"></span> Laki-Laki
            </label>
            <br>
            <label class="css-control css-control-primary css-radio">
              <input type="radio" class="css-control-input" name="sex" value="P" id="sexP">
              <span class="css-control-indicator"></span> Perempuan
            </label>


          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="Masukkan tempat lahir sesuai kartu keluarga">
          </div>
          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <div class="input-group">
              <input type="text" class="form-control" id="birth-date-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="birth_date" required="required">  
            </div>
          </div>
          <div class="form-group">
            <label for="pisat">PISAT</label>
            <select class="form-control js-select2" style="width: 100%" id="relationship" name="relationship">
              <option>— Pilih Jenis PISAT —</option>
              <option value="Anak">Anak</option>
              <option value="Istri">Istri</option>
              <option value="Suami">Suami</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="citizen_number" placeholder="Masukkan NIK sesuai kartu keluarga" name="citizen_number">
          </div>
          <div class="form-group">
            <label for="no_bpjs">No. BPJS</label>
            <input type="text" class="form-control" id="bpjs" placeholder="Masukkan nomor BPJS" name="bpjs">
          </div>
          <div class="form-group">
            <label for="faskes">Faskes</label>
            <input type="text" class="form-control" id="faskes" name="faskes" placeholder="Masukkan faskes">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div> 