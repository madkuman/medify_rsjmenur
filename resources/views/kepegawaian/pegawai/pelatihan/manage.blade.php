{{-- ADD --}}
<div class="modal fade" id="modal-add-training" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Tambah Pelatihan</h4>
          <p>Lengkapi Data-Data Pelatihan</p>
        </div> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-training" method="POST" action="{{ route('training-add', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label class="col-form-label">Nama Pelatihan</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Pelatihan yang diikuti" name="name" required>
          </div>
          <div class="form-group">
            <label class="col-form-label">Tahun Pelatihan</label>
            <select class="form-control js-select2 year" style="width: 100%" name="period" required>
              <option value="">— Pilih Tahun Pelatihan —</option> 
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Tempat Pelatihan</label>
            <input type="text" class="form-control" placeholder="Masukkan nama kota dimana pelatihan diadakan" name="place" required>
          </div>
          <div class="form-group">
            <label class="col-form-label">Upload Sertifikat <small>(Opsional)</small></label>
            <div class="input-group">
              <span class="input-group-prepend mt-5">
                <span class="btn btn-default btn-file btn-outline-primary">
                  <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgInp" name="certificate" accept=".png, .jpg, .jpeg">
                </span>
              </span>
              <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
            </div>
            <img class="mt-10 img-upload" id='img-upload'/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- EDIT --}}
<div class="modal fade" id="modal-edit-training" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Edit Pelatihan</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-training" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label class="col-form-label">Nama Pelatihan</label>
            <input type="text" class="form-control" name="name" required id="nama-pelatihan">
          </div>
          <div class="form-group">
            <label class="col-form-label">Tahun Pelatihan</label>
            <select class="form-control js-select2 year" style="width: 100%" id="tahun-pelatihan" name="period">
              <option value="" selected disabled>— Pilih Tahun Pelatihan —</option>
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Tempat Pelatihan</label>
            <input type="text" class="form-control" id="tempat-pelatihan" name="place" required>
          </div>
          <div class="form-group" id="upload-sertif">
            <label class="col-form-label">Upload Sertifikat <small>(Opsional)</small></label>
            <div class="input-group">
              <span class="input-group-prepend mt-5">
                <span class="btn btn-default btn-file btn-outline-primary">
                  <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgInp-edit" name="certificate" accept=".png, .jpg, .jpeg">
                </span>
              </span>
              <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
            </div>
            <img class="mt-10 img-upload" id='img-upload-edit'/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- DETAIL --}}
<div class="modal fade" id="modal-detail-training" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Detail Pelatihan</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-20">
        <p class="text-muted font-w400 mb-1">NAMA PELATIHAN</p>
        <h5 id="info-nama-pelatihan"></h5>
        <p class="text-muted font-w400 mb-1">TAHUN PELATIHAN</p>
        <h5 id="info-tahun-pelatihan"></h5>
        <p class="text-muted font-w400 mb-1">TEMPAT PELATIHAN</p>
        <h5 id="info-tempat-pelatihan"></h5>
        <div class="row">
          <div class="col-6">
            <p class="text-muted font-400 mb-1">DIUPLOAD OLEH</p>
            {{-- edit uploader --}}
            <h6 id="creator"><br> 
              <p id="info-uploader" class="font-w400 mt-5"></p>
            </h6>
          </div>
          <div class="col-6" id="info-verificator"></div>
        </div>
      </div>
      @if($is_hrd_member)
      <div id="verif-button"></div>
      @endif
    </div>
  </div>
</div>

