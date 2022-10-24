<div class="modal" id="modal-update-beban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Index</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option btn-close" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
                </div>
                <form method="POST" action="{{url()->current()}}/update" id="form-update-beban">
                    {{ csrf_field() }}
                    <div class="block-content row">
                        <div class="col-md-12">
                            <div class="row mb-20">
                                <table width="100%">
                                    <tr>
                                        <th width="30%"></th>
                                        <th width="70%"></th>
                                    </tr>
                                    <tr>
                                        <td><h6>Nama</h6></td>
                                        <td><h6>: <span id="nama"></span></h6></td>
                                    </tr>
                                    <tr>
                                        <td><h6>NRP</h6></td>
                                        <td><h6>: <span id="nrp"></span></h6></td>
                                    </tr>
                                    <tr>
                                        <td><h6>Bulan</h6></td>
                                        <td><h6>: <span id="bulan"></span></h6></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row mb-20 " id="edit-content">
                                <input type="hidden" name="beban_kerja_id" id="id">
                                <div class="form-group col-md-12 col-sm-12">        
                                    <label class="col-form-label">Index Beban Kerja</label>
                                    <input type="number" name="index_beban" placeholder="Masukan Index Beban Kerja Pegawai" class="form-control form-control-sm" id="index_beban" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>