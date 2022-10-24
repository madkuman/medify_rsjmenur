<div class="modal"  id="modal-edit-dana"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header ">
                    <h3 class="block-title">Edit Dana</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form id="form-edit-dana">
                    {{ csrf_field() }}
                    <div class="block-content" id="content-dana">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <h5><span>Bulan : &nbsp;</span></h5><h5><span id="bulan"></span></h5>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Nominal Dana (Rp)</label>
                                <input type="hidden" name="id" id="id" value="">
                                <input type="text" name="jumlah" id="edit-nominal" class="form-control" required autocomplete="off" placeholder="Masukan nominal dana ">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-close" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                        <button class="btn btn-primary btn-submit-dana" type="submit" id="btnSubmit"><i class="fa fa-plus"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-simple" style="display: none" type="button"  id="btnLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>