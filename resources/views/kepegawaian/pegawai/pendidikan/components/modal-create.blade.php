<div class="modal fade" id="modal-create-pendidikan" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <form id="form-create-pendidikan" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
        <div class="modal-header mt-20">
          <div class="col-8"> 
            <h4 class="modal-title"><span id="modal-option">Tambah</span> Pendidikan</h4>
            <p>Lengkapi Data-Data Pendidikan</p>
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
                        <label class="col-form-label">Nama Pendidikan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama" placeholder="Masukan nama pendidikan" autocomplete="off" required>
                        </div>
                    </div>
                </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pangkat" class="col-form-label">Jenis Pendidikan</label>
                  <select class="form-control js-select2" style="width: 100%" name="jenis" required>
                    <option value="" selected>— Pilih Jenis Pendidikan —</option> 
                    @foreach ($master_jenis as $jenis)
                      <option value="{{$jenis->id}}"> {{$jenis->nama}} </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="pangkat" class="col-form-label">Strata Pendidikan</label>
                      <select class="form-control js-select2" style="width: 100%" name="strata" required>
                        <option value="" selected>— Pilih Strata Pendidikan —</option> 
                        @foreach ($master_strata as $strata)
                          <option value="{{$strata->id}}"> {{$strata->nama}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pangkat" class="col-form-label">Institusi Pendidikan</label>
                      <select class="form-control js-select2" style="width: 100%" name="institusi" required>
                        <option value="" selected>— Pilih Institusi Pendidikan —</option> 
                        @foreach ($master_institusi as $institusi)
                          <option value="{{$institusi->id}}"> {{$institusi->nama}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Tanggal Masuk</label>
                  <div class="input-group"> 
                    <input type="text" class="form-control datepicker"  name="tgl_masuk" autocomplete="off" placeholder="Masukan Tanggal Masuk"
                    required>  
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">Tanggal Lulus</label>
                  <div class="input-group"> 
                    <input type="text" class="form-control datepicker"  name="tgl_lulus" autocomplete="off" placeholder="Masukan Tanggal Lulus"
                    required>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-form-label">Upload Sertifikat/Ijazah  <small>(Opsional)</small></label>
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
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Upload Surat Verifikasi Sertifikat/Ijazah  <small>(Opsional)</small></label>
                        <div class="input-group">
                          <span class="input-group-prepend mt-5">
                            <span class="btn btn-default btn-file btn-outline-primary">
                              <i class="far fa-folder-open mr-5"></i>Pilih File<input type="file" id="imgSurat" name="surat_sertifikat">
                            </span>
                          </span>
                          <input type="text" class="form-control ml-10" placeholder="Nama file" aria-label="Nama File" aria-describedby="basic-addon2" readonly>
                        </div>
                        <img class="mt-10" id='img-uploadSurat'/>
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