<div class="modal fade" id="modal-create-resiko-pegawai" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/create">
				<div class="block block-themed block-transparent mb-0">
				    <div class="block-header">
				        <h3 class="block-title">Resiko Kerja Pegawai Baru</h3>
				        <div class="block-options">
				            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
				                <i class="si si-close"></i>
				            </button>
				        </div>
				    </div>
                    
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
	                    <div class="row">
                            <div class="col-md-12">
                                <label for="bulan_tahun">Pilih Waktu</label>
                                <div class="form-inline">
                                    <input type="text" id="date-modal" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
                                </div><br>
                            </div>                
                        </div>
                    </div>
				</div><br>
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