{{--  --}}
<div class="modal fade" id="modal-create-pelatihan" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <form id="form-pelatihan" method="POST" action="{{url()->current()}}/baru" enctype="multipart/form-data">
        <div class="modal-header mt-20">
          <div class="col-8"> 
            <h4 class="modal-title"><span id="modal-option">Tambah</span> Pelatihan</h4>
            <p>Lengkapi Data-Data Pelatihan</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          {{csrf_field()}}
          <div class="block-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Nama Pelatihan</label>
                        <input type="text" class="form-control" name="nama" required id="create-nama" autocomplete="off" placeholder="Masukan nama pelatihan">
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Tahun Pelatihan</label>
                        <select class="form-control js-select2 year" style="width: 100%" name="period">
                          <option value="" selected disabled>— Pilih Tahun Pelatihan —</option>
                        </select>
                      </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Tempat Pelatihan</label>
                  <input type="text" class="form-control" name="place" id="create-tempat" autocomplete="off" required
                    placeholder="Masukan tempat pelatihan">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Skor Pelatihan</label>
                  <input type="number" class="form-control" name="skor" id="create-skor" required  autocomplete="off"
                    placeholder="Masukan skor pelatihan">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Durasi Pelatihan (Menit)</label>
                    <input type="number" class="form-control" name="durasi" id="create-durasi" required  autocomplete="off" placeholder="Masukan durasi pelatihan">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Upload Sertifikat</label>
                        <div class="input-group">
                          <span class="input-group-prepend mt-5">
                            <span class="btn btn-default btn-file btn-outline-primary">
                              <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgSertifikat" name="certificate">
                            </span>
                          </span>
                          <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
                        </div>
                        <img class="mt-10" id='img-uploadSertifikat'/>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-default btn-hero pull-right btn-close" data-dismiss="modal">
                Tutup
            </button>
            <button class="btn btn-primary btn-hero pull-right btn-click-animate" type="submit" id="buttonSubmitCreate"><i class="fa fa-check"></i> Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>