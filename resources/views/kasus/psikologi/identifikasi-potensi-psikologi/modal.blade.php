<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/psikologi/identifikasi-potensi-psikologi/save">
				<div class="block block-themed block-transparent mb-0">
				    <div class="block-header">
				        <h3 class="block-title">Identifikasi Potensi Psikologi</h3>
				        <div class="block-options">
				            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
				                <i class="si si-close"></i>
				            </button>
				        </div>
				    </div>
					@include("kasus.psikologi.identifikasi-potensi-psikologi.form")
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