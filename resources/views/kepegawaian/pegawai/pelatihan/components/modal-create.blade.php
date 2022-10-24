{{--  --}}
<div class="modal fade" id="modal-create-pelatihan" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <form id="form-pelatihan" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
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
                    <select class="form-control js-select2" style="width: 100%" name="id" id="add-nama" required>
                      <option value="">— Pilih Nama Pelatihan —</option>
                      @foreach ($master_pelatihan as $key)
                      <option value="{{$key->id}}">{{$key->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-form-label">Tahun Pelatihan </label> <i class="fa fa-spin fa-spinner fa-1x"></i>
                    <input type="text" class="form-control" name="period" autocomplete="off" readonly id="add-tahun"
                      placeholder="Masukan tempat pelatihan">
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Tempat Pelatihan </label> <i class="fa fa-spin fa-spinner fa-1x"></i>
                  <input type="text" class="form-control" name="place" autocomplete="off" readonly id="add-tempat"
                    placeholder="Masukan tempat pelatihan">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Skor Pelatihan</label> <i class="fa fa-spin fa-spinner fa-1x"></i>
                  <input type="number" class="form-control" name="skor" readonly  autocomplete="off" id="add-skor"
                    placeholder="Masukan skor pelatihan">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Durasi Pelatihan (Menit)</label> <i class="fa fa-spin fa-spinner fa-1x"></i>
                    <input type="number" class="form-control" name="durasi" readonly  autocomplete="off" id="add-durasi" placeholder="Masukan durasi pelatihan">
                  </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Upload Sertifikat  <small>(Opsional)</small></label>
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
                </div> --}}
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