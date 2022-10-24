<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popout" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h5 id="exampleModalLabel">Mengapa anda menolak permintaan ini ?</h5>
      </div>
      <form id="modalReject">
      <div class="modal-body">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Keterangan penolakan</label>
              <textarea class="form-control" style="resize:none;" id="keterangan_tolak" rows="3" placeholder="jelaskan"></textarea>
            </div>
      </div>
      <div class="modal-body text-right">
          <button type="button" class="btn btn-secondary" style="padding:0px 40px;" data-dismiss="modal">Batal</button>
          <button type="button" id="buttonRejectModal" class="btn btn-primary" style="padding:0px 40px;">Ya</button>
          <button class="btn btn-alt-primary ml-2" style="display: none; padding:0px 40px;" type="button"  id="buttonLoading">
            <i class="fa fa-asterisk fa-spin"></i> Memuat
      </div>
        </form>
    </div>
  </div>
</div>
