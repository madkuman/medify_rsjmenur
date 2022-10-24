<!-- modal fpk -->
  <div id="edit_fpk_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{url()->current()}}/edit-fpk">
          {{csrf_field()}}
        <div class="block block-themed">
          <div class="block-header bg-primary">
            <h5 class="block-title">Ubah FPK Penagihan</h5>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            </div>
          </div>
          <div class="block-content">
            <div class="row mb-20 form-group align-items-center">
              <div class="col-md-5">
                <h5 style="margin-bottom:0">FPK</h5>
              </div>
              <div class="col-md-1">
                <h5 style="margin-bottom:0">: </h5>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" name="fpk" value="{{$penagihan_bpjs->fpk}}">
              </div>
            </div>

            <div class="row justify-content-center">
              <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                <button class="btn btn-primary btn-hero" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
              </div>
              <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                <button class="btn btn-warning btn-hero" type="submit"><i class="fa fa-check"></i> Simpan</button>
              </div>
            </div>
          </div>
        </div>
        </form> 
      </div>
    </div>
  </div>