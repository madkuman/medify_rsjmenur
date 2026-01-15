{{-- modal --}}
<div class="modal fade" id="addTtd" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-md">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Tanda Tangan</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">				
                    {{csrf_field()}}
                    //<input type="hidden" id="pasien_id" name="pasien_id" class="form-control">
                    <div>Silahkan tanda tangan pada kotak dibawah<br/></div>
                    <canvas id="canvasTtd" class="mb-10" width="350" height="200" style="border:2px solid;"></canvas>
                    <a class="btn btn-sm btn-danger ml-5 float-right clearCanvasTtd text-white">
                        <i class="fa fa-trash"></i> Hapus
                    </a>
                    <a id="btnSubmitTtd" class="btn btn-xs btn-primary float-right text-light">
                        <i class="fa fa-print simpanTTD"></i> <i style="display: none;" class="fa fa-spinner fa-spin loadingSimpanTTD"></i> Simpan
                    </a>
                    <a class="btn btn-xs btn-default btn-secondary float-right ml-5" data-dismiss="modal" aria-label="Close">
                        Batal
                    </a>
				</div>
			</div>
		</div>
	</div>
</div>