<div class="modal fade" id="modal-edit-pns" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mt-20">
        <div class="col-8">
          <h4 class="modal-title">Ubah Data Jabatan Khusus PNS</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-pns" method="POST" action="{{url()->current()}}/edit-pns" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body mx-20">
          <div class="form-group">
            <label for="dep-bag-pns" class="col-form-label">Dep/Bagian</label>
            <input type="text" class="form-control" id="dep-bag-pns" placeholder="Masukkan nama departemen atau bagian" name="departemen" value="{{$pegawai->departemen}}">
          </div>
          <div class="form-group">
            <label for="jabatan-pns" class="col-form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan-pns" placeholder="Masukkan jabatan" name="jabatan" value="{{$pegawai->jabatan}}">
          </div>
          <div class="form-group">
            <label for="jabatan-fungsional" class="col-form-label">Nama Jabatan Fungsional</label>
            <input type="text" class="form-control" id="jabatan-fungsional" placeholder="Masukkan jabatan fungsional" name="pns_jabatan_fungsional" value="{{$pegawai->pns_jabatan_fungsional}}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-alt-primary save-button"><i class="fas fa-save mr-5"></i>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>