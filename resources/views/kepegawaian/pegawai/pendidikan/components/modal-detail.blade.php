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
          <p class="text-muted font-w400 mb-1">NAMA PENDIDIKAN </p>
          <h5 id="info-nama-pend"></h5>        
          <p class="text-muted font-w400 mb-1">TAMAT PENDIDIKAN </p>
          <h5 id="info-tahun-pend"></h5>                
          <p class="text-muted font-w400 mb-1">TEMPAT PENDIDIKAN </p>
          <h5 id="info-tempat-pend"></h5>                
          {{-- <div class="row">
            <div class="col-6">
              <p class="text-muted font-400 mb-1">DIUPLOAD OLEH</p>
              <h6 id="creator" class="mb-0"></h6>
              <p id="info-uploader-pend" class="font-w400 mt-5"></p>
              
            </div>
            <div class="col-6" id="info-verificator-edu"></div>
          </div> --}}
          @if($is_hrd_member)
          <div id="verify-edu-mil" class="form-group">
            <form id="form-verifikasi" class="form-verifikasi-edu" method="POST" action="{{url('kepegawaian/pegawai/pendidikan/{id}/verifikasi')}}" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="id" id="form-detail-id" value="0">
              <label class="col-form-label">Upload Surat Verifikasi  <small>(Opsional)</small></label>
              <div class="input-group">
                <span class="input-group-prepend mt-5">
                  <span class="btn btn-default btn-file btn-outline-primary">
                    <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgSurat" name="verification_file">
                  </span>
                </span>
                <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly required>
              </div>
              <img class="mt-10" id='img-uploadSurat'/>
          </div>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-danger btn-delete" data-id=""><i class="fa fa-trash mr-5"></i>Hapus</button>
          {{-- <button type="button" class="btn btn-alt-success edit-edu-button" data-id=""><i class="fa fa-pencil mr-5"></i>Ubah</button> --}}
          
          @if($is_hrd_member)
          <button class="btn btn-alt-primary btn-submit-verifikasi" type="submit" id="buttonSubmitVerifikasi"><i class="fa fa-check"></i> Verifikasi</button>
          <button class="btn btn-alt-primary" style="display: none" type="button"  id="buttonLoadingVerifikasi" disabled>
              <i class="fa fa-asterisk fa-spin"></i> Loading
          </button>
          @endif
        </div>
    </form>
      </div>
    </div>
  </div>