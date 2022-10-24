{{-- MODAL DETAIL TANDA JASA --}}
<div class="modal fade" id="modal-detail-appretiation" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Detail Tanda Jasa</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-20">
        <p class="text-muted font-w400 mb-1">NAMA TANDA JASA</p>
        <h5 id="info-nama-tj"></h5>
        <p class="text-muted font-w400 mb-1">TMT TANDA JASA</p>
        <h5 id="info-tmt-tj"></h5>
        <p class="text-muted font-w400 mb-1">NO. ST/KEP</p>
        <h5 id="info-nost-tj"></h5>
        <div class="row">
          <div class="col-6">
            <p class="text-muted font-400 mb-1">DIUPLOAD OLEH</p>
            <h6 id="creator"><br>
              <p id="info-uploader" class="font-w400 mt-5"></p>
            </h6>
          </div>
          <div class="col-6" id="info-verificator"></div>
        </div>
      </div>
      <div id="verif-button"></div>
    </div>
  </div>
</div>

{{-- modal tambah tanda jasa  --}}
<div class="modal fade" id="modal-add-appretiation" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Tambah Tanda Jasa</h4>
          <p>Lengkapi Data-Data Tanda Jasa</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-appretiation" method="POST" action="{{ route('add-appretiation', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="namaTJ" class="col-form-label">Nama Tanda Jasa</label>
            <input type="text" class="form-control " id="name" name="name">  
          </div>
          <div class="form-group">
            <label for="tmtTJ" class="col-form-label tmt">TMT</label>
            <div class="input-group">
              <input type="text" class="form-control " id="tmt" data-format="YYYY-MM-DD HH:mm:ss" data-template="D MMMM YYYY" value="0000-00-00 00:00:00" name="tmt">  
            </div>
          </div>
          <div class="form-group">
            <label for="noST" class="col-form-label">No. ST/Kep</label>
            <input type="text" class="form-control" id="noST" placeholder="Masukkan nomor ST/Kep" name="st_number">
          </div>
          <div class="form-group">
            <label class="col-form-label">Upload Sertifikat</label>
            <div class="input-group">
              <span class="input-group-prepend mt-5">
                <span class="btn btn-default btn-file btn-outline-primary">
                  <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgInp" name="certificate">
                </span>
              </span>
              <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
            </div>
            {{-- <p id="error1">Invalid Image Format! Image Format Must Be JPG, JPEG, or PNG.</p> --}}
            <img class="mt-10 img-preview" id='img-upload'/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- modal edit tanda jasa  --}}
<div class="modal fade" id="modal-edit-appretiation" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Ubah Data Tanda Jasa</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-appretiation" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="namaTJ" class="col-form-label">Nama Tanda Jasa</label>
            <input class="form-control" id="appretiation"  name="name">
          </div>
          <div class="form-group">
            <label for="tmtTJ" class="col-form-label">TMT</label>
            <div class="input-group">
              <input type="text" class="form-control" id="tmt-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="tmt" required="required">  
            </div>
          </div>
          <div class="form-group">
            <label for="noST" class="col-form-label">No. ST/Kep</label>
            <input type="text" class="form-control" id="st-number" placeholder="Masukkan nomor ST/Kep" name="st_number">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div> 