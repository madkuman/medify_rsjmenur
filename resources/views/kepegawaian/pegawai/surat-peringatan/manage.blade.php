{{-- modal tambah surat Peringatan --}}
<div class="modal fade" id="modal-add-family" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title">Tambah Surat Peringatan</h4>
            <p>Lengkapi Data Surat Peringatan</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-add-family" method="POST" action="{{ route('tambah-surat_peringatan', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body mx-20">
            <div class="form-group">
              <label for="jenis_surat">Jenis Surat</label>
                <select class="form-control js-select2" style="width: 100%" name="jenis_surat" required>
                    <option value="">- Pilih Jenis Surat Peringatan -</option>
                    @foreach ($jenis as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label for="tanggal_surat">Tanggal Surat</label>
              <br>
              <input type="text" class="form-control" id="tanggal_surat" name="tanggal_surat">
            </div>
            <div class="form-group">
              <label for="no_surat">Nomor Surat</label>
              <input type="text" class="form-control" name="no_surat" placeholder="Masukkan nomor surat">
            </div>
            <div class="form-group">
              <label for="judul_surat">Judul Surat</label>
              <div class="input-group">
                <input type="text" class="form-control " name="judul_surat" placeholder="Masukkan judul surat">  
              </div>
            </div>
            <div class="form-group">
              <label for="konten_surat">Konten Surat</label>
              <textarea id="konten_surat" class="form-control" name="konten_surat" rows="10" cols="50"></textarea >
            </div>
            <div class="form-group">
              <label for="nik">nama file</label>
              <input type="file" class="form-control" name="nama_file">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="button-add-surat" class="btn btn-alt-primary save-button btn-submit"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> <i class="fas fa-save mr-5"></i>Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  {{-- modal edit surat perigatan --}}
  <div class="modal fade" id="modal-edit" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title">Tambah Surat Peringatan</h4>
            <p>Lengkapi Data Surat Peringatan</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-edit-surat" method="POST" action="" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="d-none text-center" id="loading">
              <i class="fa fa-spin fa-spinner fa-7x"></i>
          </div>
         
          <div class="modal-body mx-20 d-none" id="edit-content">
            <div class="form-group">
              <label for="jenis_surat">Jenis Surat</label>
                <select class="form-control js-select2" id="jenis_surat" style="width: 100%" name="jenis_surat" required>
                    <option value=""></option>
                    @foreach ($jenis as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label for="tanggal_surat">Tanggal Surat</label>
              <br>
              <input type="text" class="form-control" id="edit_tanggal_surat" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="tanggal_surat" required>
            </div>
            <div class="form-group">
              <label for="no_surat">Nomor Surat</label>
              <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Masukkan nomor surat" required>
            </div>
            <div class="form-group">
              <label for="judul_surat">Judul Surat</label>
              <div class="input-group">
                <input type="text" class="form-control" id="judul_surat" name="judul_surat" placeholder="Masukkan judul surat" required>  
              </div>
            </div>
            <div class="form-group">
              <label for="konten_surat">Konten Surat</label>
              <textarea class="form-control" id="edit_konten_surat" name="konten_surat"></textarea >
            </div>
            <div class="form-group">
              <label for="nik">nama file</label>
              <input type="file" class="form-control" id="nama_file" name="nama_file">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="button_edit_surat" class="btn btn-alt-primary save-button btn-submit"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> <i class="fas fa-save mr-5"></i>Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div> 

  <div id="modal_delete" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            
            <div class="modal-body">
                <p id="show-name"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="del-btn">
                    <form id="form_delete" action="" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger pull-right btn-delete" style="margin-left: 4px ;"> <i class="fa fa-spin fa-spinner fa-1x btn-spin"></i> Hapus</button>
                    </form>
                </a>
            </div>
        </div>
    </div>
</div>