{{-- MODAL LIHAT DETAIL PENDIDIKAN MILITER --}}
<div class="modal fade" id="modal-detail-militer" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Detail Pendidikan Militer</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-20">
        <p class="text-muted font-w400 mb-1">NAMA PENDIDIKAN MILITER</p>
        <h5 class="h5" id="info-nama-mil"></h5>
        <p class="text-muted font-w400 mb-1">TMT PENDIDIKAN MILITER</p>
        <h5 id="info-tahun-mil"></h5>
        <p class="text-muted font-w400 mb-1">TEMPAT PENDIDIKAN MILITER</p>
        <h5 id="info-tempat-mil"></h5>
        <div class="row">
          <div class="col-6">
            <p class="text-muted font-400 mb-1">DIUPLOAD OLEH</p>
            <h6 id="creator" class="mb-0"></h6>
            <p id="info-uploader-mil" class="font-w400 mt-5"></p>
          </div>
          <div class="col-6" id="info-verificator-mil"></div>
        </div>
        @if($is_hrd_member)
        <div id="verify-div-mil" class="form-group">
          <form class="form-verifikasi-mil" method="POST" action="" enctype="multipart/form-data">
            {{csrf_field()}}
            <label class="col-form-label">Upload Surat Verifikasi  <small>(Opsional)</small></label>
            <div class="input-group">
              <span class="input-group-prepend mt-5">
                <span class="btn btn-default btn-file btn-outline-primary">
                  <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgVerifyInp" name="verification_file">
                </span>
              </span>
              <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
            </div>
            <img class="mt-10" id='img-verify-upload'/>
          </form>
        </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-alt-danger delete-military-edu-button" data-id=""><i class="fa fa-trash mr-5"></i>Hapus</button>

        <button type="button" class="btn btn-alt-success edit-military-edu-button" data-id=""><i class="fa fa-pencil mr-5"></i>Ubah</button>
        
        @if($is_hrd_member)
        <div id="verif-button-mil"></div>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- MODAL TAMBAH PENDIDIKAN MILITER --}}
<div class="modal fade" id="modal-add-pend-militer" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-10">
          <h4 class="modal-title">Tambah Pendidikan Militer</h4>
          <p>Lengkapi Data-Data Pendidikan Militer</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-miliedu" method="POST" action="{{ route('add-militaryeducation', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="nama-pend-militer-add" class="col-form-label">Nama Pendidikan Militer</label>
            <input type="text" class="form-control" id="nama-pend-militer-add" 
            placeholder="Masukkan jenis pendidikan militer" name="name-military-education" required>
          </div>
          <div class="form-group">
            <label for="tahun-pend-militer-add" class="col-form-label">Tahun Pendidikan</label>
            <select required class="form-control js-select2 year" style="width: 100%" id="tahun-pend-militer-add" name="tmt-military">
              <option>— Pilih Tahun Pendidikan —</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat-pend-militer-add" class="col-form-label">Tempat Pendidikan</label>
            <input required type="text" class="form-control" id="tempat-pend-militer-add" placeholder="Masukkan tempat dimana pendidikan militer didapatkan" name="military-place">
          </div>
          <div class="form-group">
            <label class="col-form-label">Upload Sertifikat/Ijazah  <small>(Opsional)</small></label>
            <div class="input-group">
              <span class="input-group-prepend mt-5">
                <span class="btn btn-default btn-file btn-outline-primary">
                  <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgInp" name="certificate">
                </span>
              </span>
              <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
            </div>
            <img class="mt-10" id='img-upload'/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL EDIT PENDIDIKAN MILITER --}}
<div class="modal fade" id="modal-edit-pend-militer" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-10">
          <h4 class="modal-title">Ubah Data Pendidikan Militer</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-miliedu" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="nama-pend-militer-edit" class="col-form-label">Nama Pendidikan Militer</label>
            <input required type="text" class="form-control" id="nama-pend-militer-edit" name="name-military-education">
          </div>
          <div class="form-group">
            <label for="tahun-pend-militer-edit" class="col-form-label">Tahun Pendidikan</label>
            <select required class="form-control js-select2 year" style="width: 100%" id="tahun-pend-militer-edit" name="tmt-military">
              <option>— Pilih Tahun Pelatihan —</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat-pend-militer-edit" class="col-form-label">Tempat Pendidikan</label>
            <input required type="text" class="form-control" id="tempat-pend-militer-edit" name="military-place">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL LIHAT DETAIL PENDIDIKAN UMUM --}}
<div class="modal fade" id="modal-detail-pendidikan" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Detail Pendidikan Umum</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-20">
        <p class="text-muted font-w400 mb-1">NAMA PENDIDIKAN UMUM</p>
        <h5 id="info-nama-pend"></h5>        
        <p class="text-muted font-w400 mb-1">TMT PENDIDIKAN UMUM</p>
        <h5 id="info-tahun-pend"></h5>                
        <p class="text-muted font-w400 mb-1">TEMPAT PENDIDIKAN UMUM</p>
        <h5 id="info-tempat-pend"></h5>                
        <div class="row">
          <div class="col-6">
            <p class="text-muted font-400 mb-1">DIUPLOAD OLEH</p>
            <h6 id="creator" class="mb-0"></h6>
            <p id="info-uploader-pend" class="font-w400 mt-5"></p>
            
          </div>
          <div class="col-6" id="info-verificator-edu"></div>
        </div>
        @if($is_hrd_member)
        <div id="verify-edu-mil" class="form-group">
          <form class="form-verifikasi-edu" method="POST" action="" enctype="multipart/form-data">
            {{csrf_field()}}
            <label class="col-form-label">Upload Surat Verifikasi  <small>(Opsional)</small></label>
            <div class="input-group">
              <span class="input-group-prepend mt-5">
                <span class="btn btn-default btn-file btn-outline-primary">
                  <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgVerifyInpEdu" name="verification_file">
                </span>
              </span>
              <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
            </div>
            <img class="mt-10" id='img-verify-uploadEdu'/>
          </form>
        </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-alt-danger delete-edu-button" data-id=""><i class="fa fa-trash mr-5"></i>Hapus</button>
        <button type="button" class="btn btn-alt-success edit-edu-button" data-id=""><i class="fa fa-pencil mr-5"></i>Ubah</button>
        
        @if($is_hrd_member)
        <div id="verif-button-edu"></div>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- MODAL TAMBAH PENDIDIKAN UMUM --}}
<div class="modal fade" id="modal-add-pend-umum" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-10">
          <h4 class="modal-title">Tambah Pendidikan Umum</h4>
          <p>Lengkapi Data-Data Pendidikan Umum</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-edu" method="POST" action="{{ route('add-education', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="nama-pend-umum-add" class="col-form-label">Nama Pendidikan Umum</label>
            <input required type="text" class="form-control" id="nama-pend-umum-add" placeholder="Masukkan jenis pendidikan umum" name="name">
          </div>
          <div class="form-group">
            <label for="tahun-pend-umum-add" class="col-form-label">Tahun Pendidikan</label>
            <select required class="form-control js-select2 year" style="width: 100%" id="tahun-pend-umum-add" name="tmt">
              <option value="">— Pilih Tahun Pendidikan —</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat-pend-umum-add" class="col-form-label">Tempat Pendidikan</label>
            <input required type="text" class="form-control" id="tempat-pend-umum-add" placeholder="Masukkan tempat dimana pendidikan umum didapatkan" name="place">
          </div>
          <div class="form-group">
            <label class="col-form-label">Upload Sertifikat/Ijazah  <small>(Opsional)</small></label>
            <div class="input-group">
              <span class="input-group-prepend mt-5">
                <span class="btn btn-default btn-file btn-outline-primary">
                  <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgInpEdu" name="certificate">
                </span>
              </span>
              <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
            </div>
            <img class="mt-10" id='img-uploadEdu'/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL EDIT PENDIDIKAN UMUM --}}
<div class="modal fade" id="modal-edit-pend-umum" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-10">
          <h4 class="modal-title">Ubah Data Pendidikan Umum</h4> 
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-edu" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-body mx-20">
          {{csrf_field()}}
          <div class="form-group">
            <label for="nama-pend-umum-edit" class="col-form-label">Nama Pendidikan Umum</label>
            <input required type="text" class="form-control" id="nama-pend-umum-edit" placeholder="Contoh: sek" name="name">
          </div>
          <div class="form-group">
            <label for="tahun-pend-umum-edit" class="col-form-label">Tahun Pendidikan</label>
            <select required class="form-control js-select2 year" style="width: 100%" id="tahun-pend-umum-edit" name="tmt">
              <option>— Pilih Tahun Pendidikan —</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat-pend-umum-edit" class="col-form-label">Tempat Pendidikan</label>
            <input required type="text" class="form-control" id="tempat-pend-umum-edit" placeholder="Nama tempat dimana pendidikan umum didapatkan" name="place">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>