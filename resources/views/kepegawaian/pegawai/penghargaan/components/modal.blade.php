{{-- MODAL DETAIL TANDA JASA --}}

  
  {{-- modal tambah tanda jasa  --}}
  <div class="modal fade" id="modal-tandajasa" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header mt-20">
          <div class="col-8">
            <h4 class="modal-title"><span id="modal-option">Edit</span> Penghargaan</h4>
            <p>Lengkapi Data-Data Penghargaan</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-tandajasa" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body mx-20">
            <input type="hidden" name="id_penghargaan" id="add-penghargaanid">
            <input type="hidden" name="master_id" id="add-masterid">
            <div class="form-group">
              <label class="col-form-label">Nama Penghargaan</label>
              <select class="form-control js-select2" style="width: 100%" name="id" required id="add-nama">
                <option value="">— Pilih Nama Penghargaan —</option>
                @foreach ($master_penghargaan as $key)
                <option value="{{$key->id}}">{{$key->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label">No. ST/Kep  </label><i class="fa fa-spin fa-spinner fa-1x"></i>
              <input type="text" class="form-control" id="add-st-number" placeholder="Masukkan nomor ST/Kep" name="no_surat" readonly>
            </div>
            <div class="form-group">
              <label class="col-form-label tmt">Tanggal Terbit Surat  </label><i class="fa fa-spin fa-spinner fa-1x"></i>
              <div class="input-group">
                <input type="text" class="form-control datepicker" id="add-tgl-terbit" name="tgl_terbit" placeholder="Masukan tanggal terbit surat" readonly>  
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label tmt">Pemberi Penghargaan  </label><i class="fa fa-spin fa-spinner fa-1x"></i>
              <div class="input-group">
                <input type="text" class="form-control " id="add-pemberi" name="pemberi" placeholder="Masukan pemberi tanda jasa" readonly>  
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-alt-default btn-close" data-dismiss="modal">
              Tutup
            </button>
            <button class="btn btn-alt-primary btn-click-animate" type="submit" id="buttonSubmitCreate"><i class="fa fa-check"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>