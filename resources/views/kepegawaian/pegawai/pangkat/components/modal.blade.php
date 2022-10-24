<div class="modal fade" id="modal-pangkat" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <form id="form-pangkat" method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
        <div class="modal-header mt-20">
          <div class="col-8"> 
            <h4 class="modal-title"><span id="modal-option">Tambah</span> Pangkat</h4>
            <p>Lengkapi Data-Data Pangkat</p>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          {{csrf_field()}}
          <div class="block-content">
            <input type="hidden" name="id" id="form-id" value="0">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pangkat" class="col-form-label">Pangkat</label>
                  <select class="form-control js-select2"  id="form-namapangkat" style="width: 100%" name="pangkat" required>
                    <option value="" selected>— Pilih Pangkat —</option> 
                    @foreach ($master_pangkat as $mposition)
                      <option value="{{$mposition->nama}}"> {{$mposition->nama}} </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-form-label">TMT (Tanggal Mulai Tugas)</label>
                  <div class="input-group"> 
                    <input type="text" class="form-control datepicker" id="form-tmt" name="tmt" autocomplete="off"
                    required>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
            <div class="form-group">
              <label for="korps" class="col-form-label">Korps</label>
              <input type="text" class="form-control" id="form-korps" placeholder="Masukkan korps" name="korps" required autocomplete="off">
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="gaji" class="col-form-label">Gaji</label>
              <input type="text" name="gaji" id="form-gaji" placeholder="Masukkan Gaji" class="form-control js-masked form-gaji js-masked-enable" autocomplete="off" required>
            </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-12">
            <div class="form-group">
              <label for="pejabat" class="col-form-label">Pejabat</label>
              <input type="text" class="form-control" id="form-pejabat" placeholder="Masukkan jabatan" name="supervisor" autocomplete="off" required>
            </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-6">
            <div class="form-group">
              <label for="noSurat" class="col-form-label">No. Surat</label>
              <input type="text" class="form-control" id="form-no-surat" placeholder="Masukkan nomor surat" name="letter_number" autocomplete="off" required>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="tglSurat" class="col-form-label">Tgl Surat</label>
              <div>
                <div class="input-group">
                  <input class="form-control datepicker" id="form-tgl" type="text" name="letter_date" 
                  required autocomplete="off">  
                </div>
              </div>
            </div>
            </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-alt-default btn-close" data-dismiss="modal">
                Tutup
              </button>
              <button class="btn btn-alt-primary btn-click-animate" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>