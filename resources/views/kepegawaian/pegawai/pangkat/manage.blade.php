{{-- MODAL TAMBAH PANGKAT --}}
<div class="modal fade" id="modal-add-position" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8"> 
          <h4 class="modal-title">Tambah Pangkat</h4>
          <p>Lengkapi Data-Data Pangkat</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-add-position" method="POST" action="{{ route('add-position', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="pangkat" class="col-form-label">Pangkat</label>
            <select class="form-control js-select2-dynamic" style="width: 100%" name="mposition_id" required>
              <option selected disabled>— Pilih Pangkat —</option> 
              @foreach ($master_pangkat as $mposition)
                <option value="{{$mposition->nama}}"> {{$mposition->nama}} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="tmtPangkat" class="col-form-label">TMT</label>
            <div class="input-group"> 
              <input type="text" class="form-control" id="tmt-tambah" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="tmt" 
              required>  
            </div>
          </div>
          <div class="form-group">
            <label for="korps" class="col-form-label">Korps</label>
            <input type="text" class="form-control" id="korps" placeholder="Masukkan korps" name="korps" required>
          </div>
          <div class="form-group">
            <label for="gaji" class="col-form-label">Gaji</label>
            <input type="text" class="form-control currency" id="gaji" placeholder="Masukkan gaji" name="salary" required>
          </div>
          <div class="form-group">
            <label for="pejabat" class="col-form-label">Pejabat</label>
            <input type="text" class="form-control" id="pejabat" placeholder="Masukkan jabatan" name="supervisor" required>
          </div>
          <div class="form-group">
            <label for="noSurat" class="col-form-label">No. Surat</label>
            <input type="text" class="form-control" id="noSurat" placeholder="Masukkan nomor surat" name="letter_number" required>
          </div>
          <div class="form-group">
            <label for="tglSurat" class="col-form-label">Tgl Surat</label>
            <div>
              <div class="input-group">
                <input class="form-control" id="tgl-surat-tambah" type="text" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" name="letter_date" 
                required>  
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL EDIT PANGKAT  --}}
<div class="modal fade" id="modal-edit-position" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8"> 
          <h4 class="modal-title">Ubah Data Pangkat</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-position" method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="pangkat-edit" class="col-form-label">Pangkat</label>
            <select class="form-control js-select2-dynamic" id="pangkat-edit"  style="width: 100%" name="mposition_id" required>
              <option disabled selected>— Pilih Pangkat —</option> 
              @foreach ($master_pangkat as $mposition)
                <option value="{{$mposition->nama}}"> {{$mposition->nama}} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="tmtPendMiliter" class="col-form-label">TMT</label>
            <div class="input-group">
              <input type="text" class="form-control" id="tmt-edit" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" 
              name="tmt" required>  
            </div>     
          </div>
          <div class="form-group">
            <label for="korps" class="col-form-label">Korps</label>
            <input type="text" class="form-control" id="korps-edit" placeholder="Masukkan korps" name="korps" required>
          </div>
          <div class="form-group">
            <label for="gaji" class="col-form-label">Gaji</label>
            <input type="text" class="form-control currency" id="salary" placeholder="" name="salary" required>
          </div>
          <div class="form-group">
            <label for="pejabat" class="col-form-label">Pejabat</label>
            <input type="text" class="form-control" id="nama-pejabat" placeholder="" name="supervisor" required>
          </div>
          <div class="form-group">
            <label for="noSurat" class="col-form-label">No. Surat</label>
            <input type="text" class="form-control" id="no-surat" placeholder="" name="letter_number" required>
          </div>
          <div class="form-group">
            <label for="tglSurat" class="col-form-label">Tgl Surat</label>
            <div class="input-group">
              <input type="text"  class="form-control" id="tgl-surat" data-format="YYYY-MM-DD" data-template="D MMMM YYYY" 
              name="letter_date" required>  
            </div>
          </div>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>