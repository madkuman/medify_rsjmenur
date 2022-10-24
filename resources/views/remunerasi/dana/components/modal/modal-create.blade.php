<div class="modal"  id="modal-create-dana"  role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Dana Baru</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option btn-close" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
                </div>
                <form id="form-dana">
                    {{ csrf_field() }}
                    <div class="block-content" id="content-dana">
                        <div class="col-md-12">
                            <label for="bulan_tahun"><h6>Pilih Tanggal Berlaku</h6></label>
                            <div class="form-inline">
                                <input type="text" id="date" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Nominal Dana (Rp)</label>
                                <input type="text" name="jumlah" id="nominal" class="form-control" required autocomplete="off" placeholder="Masukan nominal dana ">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-close" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                        <button class="btn btn-primary btn-submit-absensi" type="button" onclick="simpanDana()" id="btnSubmit"><i class="fa fa-plus"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-simple" style="display: none" type="button"  id="btnLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>