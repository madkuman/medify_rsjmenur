<!-- MODAL TAMBAH JABATAN -->
<div class="modal fade" id="modal-add-department" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"> 
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Tambah Jabatan</h4>
          <p>Lengkapi Data-Data Jabatan</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-department" method="POST" action="{{ route('add-department', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="gaji" class="col-form-label">Jabatan</label>
            <select class="form-control js-select2" style="width: 100%" name="mdepartment_id" required>
              <option value="0">— Pilih Jabatan —</option> 
              @foreach ($mdepartments as $mdepartment)
                <option value="{{$mdepartment->id}}"> {{$mdepartment->name}} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="tmtPendMiliter" class="col-form-label">TMT</label>
            <div class="input-group">
              <input type="text" class="form-control" id="tmt" 
              data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="tmt" required>  
            </div>
          </div>
          <div class="form-group">
            <label for="pendMiliter" class="col-form-label">No. ST</label>
            <input type="text" class="form-control" id="pendMiliter" placeholder="Masukkan nomor surat tugas" name="st_number" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT JABATAN -->
<div class="modal fade" id="modal-edit-department" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Ubah Data Jabatan</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-department" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="gaji" class="col-form-label">Jabatan</label>
            <select class="form-control js-select2" style="width: 100%" name="mdepartment_id" id="department">
              <option>— Pilih Jabatan —</option> 
              @foreach ($mdepartments as $mdepartment)
                <option value="{{$mdepartment->id}}"> {{$mdepartment->name}} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="tmtPendMiliter" class="col-form-label">TMT</label>
            <div class="input-group">
              <input type="text" class="form-control" id="tmt-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="tmt" required="required">  
            </div>
          </div>
          <div class="form-group">
            <label for="pendMiliter" class="col-form-label">No. ST</label>
            <input type="text" class="form-control" id="st_number" placeholder="" name="st_number">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL TAMBAH JABATAN SESUAI ST KASAL -->
<div class="modal fade" id="modal-add-kasal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20"> 
        <div class="col-8">
          <h4 class="modal-title">Tambah Data Jabatan Sesuai ST Kasal</h4>
          <p>Lengkapi Data-Data Jabatan</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
        </button>
      </div>
      <form id="form-add-kasal" method="POST" action="{{ route('add-kasal', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="dep-bag-kasal" class="col-form-label">Dep/Bagian</label>
            <input type="text" class="form-control" placeholder="Masukkan nama departemen atau bagian" name="section">
          </div>
          <div class="form-group">
            <label for="jabatan-kasal" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" placeholder="Masukkan jabatan" name="position">
          </div>
          <div class="form-group">
            <label for="no-st-kasal" class="col-form-label">No. ST</label>
            <input type="text" class="form-control" placeholder="Masukkan nomor surat tugas" name="st_number">
          </div>
          <div class="form-group">
            <label for="no-sp-kasal" class="col-form-label">No. SP</label>
            <input type="text" class="form-control" placeholder="Masukkan nomor surat perintah" name="sp_number">
          </div>
          <div class="form-group">
            <label for="tgl-sp-kasal" class="col-form-label">Tanggal SP</label>
            <div class="input-group">
              <input type="text" class="form-control combodate" id="sp-date-kasal" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="sp_date" required="required">  
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT JABATAN SESUAI ST KASAL -->
<div class="modal fade" id="modal-edit-kasal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Ubah Data Jabatan Sesuai ST Kasal</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-kasal" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="dep-bag-kasal" class="col-form-label">Dep/Bagian</label>
            <input type="text" class="form-control" id="dep-bag-kasal" placeholder="Masukkan nama departemen atau bagian" name="section">
          </div>
          <div class="form-group">
            <label for="jabatan-kasal" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan-kasal" placeholder="Masukkan jabatan" name="position">
          </div>
          <div class="form-group">
            <label for="no-st-kasal" class="col-form-label">No. ST</label>
            <input type="text" class="form-control" id="no-st-kasal" placeholder="Masukkan nomor surat tugas" name="st_number">
          </div>
          <div class="form-group">
            <label for="no-sp-kasal" class="col-form-label">No. SP</label>
            <input type="text" class="form-control" id="no-sp-kasal" placeholder="Masukkan nomor surat perintah" name="sp_number">
          </div>
          <div class="form-group">
            <label for="tgl-sp-kasal" class="col-form-label">Tanggal SP</label>
            <div class="input-group">
              <input type="text" class="form-control" id="sp-date-kasal-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="sp_date" required="required">  
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL TAMBAH JABATAN INTERN -->
<div class="modal fade" id="modal-add-intern" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Tambah Data Jabatan Intern</h4>
          <p>Lengkapi Data-Data Jabatan</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-intern" method="POST" action="{{ route('add-intern', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="dep-bag-intern" class="col-form-label">Dep/Bagian</label>
            <input type="text" class="form-control" placeholder="Masukkan nama departemen atau bagian" name="section">
          </div>
          <div class="form-group">
            <label for="jabatan-intern" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" placeholder="Masukkan jabatan" name="position">
          </div>
          <div class="form-group">
            <label for="no-sp-intern" class="col-form-label">No. SP</label>
            <input type="text" class="form-control" placeholder="Masukkan nomor surat perintah" name="sp_number">
          </div>
          <div class="form-group">
            <label for="tgl-sp-intern" class="col-form-label">Tanggal SP</label>
            <div class="input-group">
              <input type="text" class="form-control combodate" id="sp-date-intern" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="sp_date" required="required">  
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT JABATAN INTERN -->
<div class="modal fade" id="modal-edit-intern" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Ubah Data Jabatan Intern</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-intern" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="dep-bag-intern" class="col-form-label">Dep/Bagian</label>
            <input type="text" class="form-control" id="dep-bag-intern" name="section">
          </div>
          <div class="form-group">
            <label for="jabatan-intern" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan-intern" name="position">
          </div>
          <div class="form-group">
            <label for="no-sp-intern" class="col-form-label">No. SP</label>
            <input type="text" class="form-control" id="no-sp-intern" name="sp_number">
          </div>
          <div class="form-group">
            <label for="tgl-sp-intern" class="col-form-label">Tanggal SP</label>
            <div class="input-group">
              <input type="text" class="form-control" id="sp-date-intern-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="sp_date" required="required">  
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL TAMBAH JABATAN KHUSUS PNS -->
<div class="modal fade" id="modal-add-khusus-pns" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Tambah Data Jabatan Khusus PNS</h4>
          <p>Lengkapi Data-Data Jabatan</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-pns" method="POST" action="{{ route('add-pns', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="dep-bag-pns" class="col-form-label">Dep/Bagian</label>
            <input type="text" class="form-control" placeholder="Masukkan nama departemen atau bagian" name="section">
          </div>
          <div class="form-group">
            <label for="jabatan-pns" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" placeholder="Masukkan jabatan" name="position">
          </div>
          <div class="form-group">
            <label for="jabatan-fungsional" class="col-form-label">Nama Jabatan Fungsional</label>
            <input type="text" class="form-control" placeholder="Masukkan jabatan fungsional" name="functional_position">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT JABATAN KHUSUS PNS -->
<div class="modal fade" id="modal-edit-pns" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Ubah Data Jabatan Khusus PNS</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-pns" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="dep-bag-pns" class="col-form-label">Dep/Bagian</label>
            <input type="text" class="form-control" id="dep-bag-pns" placeholder="Masukkan nama departemen atau bagian" name="section">
          </div>
          <div class="form-group">
            <label for="jabatan-pns" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan-pns" placeholder="Masukkan jabatan" name="position">
          </div>
          <div class="form-group">
            <label for="jabatan-fungsional" class="col-form-label">Nama Jabatan Fungsional</label>
            <input type="text" class="form-control" id="jabatan-fungsional" placeholder="Masukkan jabatan fungsional" name="functional_position">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>