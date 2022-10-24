  <!-- modal bayar -->
  <div id="confirmPayment" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="block block-themed">
          <div class="block-header bg-primary">
            <h5 class="block-title">Masukkan Jumlah Pembayaran</h5>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            </div>
          </div>
          <div class="block-content">
            <div class="row mb-20">
              <div class="col-md-5">
                <h5 style="margin-bottom:0">Belum Terbayar</h5>
              </div>
              <div class="col-md-1">
                <h5 style="margin-bottom:0">Rp</h5>
              </div>
              <div class="col-md-5">
                <input type="text" class="d-none" id="bill" value="">
                <h5 style="margin-bottom:0" id="allTotal"></h5>
              </div>
            </div>
            <div class="row mb-20 form-group align-items-center">
              <div class="col-md-5">
                <h5 style="margin-bottom:0">Pembayaran</h5>
              </div>
              <div class="col-md-1">
                <h5 style="margin-bottom:0">Rp</h5>
              </div>
              <div class="col-md-6">
                <input type="number" class="form-control"  id="input-paid" name="example-nf-password" placeholder="Masukkan Pembayaran..">

              </div>
            </div>
            <div class="row mb-20">
              <div class="col-md-5">
                <h5 style="margin-bottom:0">Akun Rekening</h5>
              </div>
              <div class="col-md-7">
                <h5 style="margin-bottom:0">{{$paket->akun->nama}} - {{$paket->akun->no_rekening}}</h5>
              </div>
            </div>
              <div class="row mb-20" id="centang_rugi" style="display: none;">
                  <div class="custom-control custom-checkbox mb-5 ml-15">
                      <input class="custom-control-input" type="checkbox" name="rugi" value="true" id="rugi">
                      <label class="custom-control-label" for="rugi">Kerugian ditanggung Rumah Sakit</label>
                  </div>
              </div>
                          <div class="row justify-content-center">
              <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                <input type="text" class="d-none" id="id_piutang" value="">
                <button class="btn btn-primary btn-hero" id="buttonPay"><i class="fa fa-check"></i> Terima Pembayaran</button>
                <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                  <i class="fa fa-asterisk fa-spin"></i> Loading
                </button>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>