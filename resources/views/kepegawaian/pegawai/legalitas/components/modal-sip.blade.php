
  <div class="modal fade" id="modal-sip" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title"><span id="modal-option">Edit</span> SIP</h4>
            <p>Lengkapi Data-Data SIP</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-sip" method="POST" action="{{ route('legalitas-sip', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body mx-20">
            <input type="hidden" name="id" id="form-id-sip">
            <div class="form-group">
              <label class="col-form-label">S I P</label>
              <input type="text" class="form-control " id="form-no-sip" name="sip" placeholder="Masukan nomer SIP" autocomplete="off">  
            </div>
            <div class="form-group">
              <label class="col-form-label tmt">Tanggal Expired SIP</label>
              <div class="input-group">
                <input type="text" class="form-control datepicker" id="form-expired-sip" name="expired" placeholder="Masukan tanggal expired" autocomplete="off">  
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label">Upload File SIP</label>
              <div class="input-group">
                <span class="input-group-prepend mt-5">
                  <span class="btn btn-default btn-file btn-outline-primary">
                    <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="img-file" name="file">
                  </span>
                </span>
                <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
              </div>
              {{-- <p id="error1">Invalid Image Format! Image Format Must Be JPG, JPEG, or PNG.</p> --}}
              <img class="mt-10 img-preview" id='img-upload'/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>