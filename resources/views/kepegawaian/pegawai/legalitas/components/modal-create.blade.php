
  <div class="modal fade" id="modal-create" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title"><span id="modal-option">Tambah</span> Legalitas</h4>
            <p>Lengkapi Data-Data Legalitas</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form" method="POST" action="{{ route('legalitas-create', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body mx-20">
            {{-- <input type="hidden" name="id" id="form-id-legalitas"> --}}
            <div class="form-group">
                <label class="col-form-label">Pilih Legalitas</label>
                <select class="form-control js-select2" style="width: 100%" name="tipe" required>
                    <option value="">— Pilih Legalitas —</option>
                    <option value="skk">SKK</option>
                    <option value="sip">SIP</option>
                    <option value="str">STR</option>
                    <option value="evkin">Evkin</option>
                    <option value="kredensial">Kredensial</option>
                </select>
              </div>
            <div class="form-group">
              <label class="col-form-label">Nomer</label>
              <input type="text" class="form-control " id="form-no" name="nomer" placeholder="Masukan nomer legalitas" autocomplete="off" required>  
            </div>
            <div class="form-group">
              <label class="col-form-label tmt">Tanggal Expired</label>
              <div class="input-group">
                <input type="text" class="form-control datepicker" id="form-expired" name="tanggal" placeholder="Masukan tanggal expired" autocomplete="off" required>  
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label">Upload File</label>
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