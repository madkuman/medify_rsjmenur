<div class="modal fade" id="addTTD" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-md">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">TTD Surat</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
                    <iframe id="the_iframe" name="the_iframe" src="javascript:false" style="display: none;"></iframe>
					<form class="col-md-12" onsubmit="return ajaxSubmit();" autocomplete="on" target="the_iframe">
                        {{csrf_field()}}
                        <input type="hidden" id="id-item" name="id" value="{{$item->id}}">                        
                        <hr style="border-top: 2px solid #0b72c6">
                        <div>Silahkan tanda tangan pada kotak dibawah<br/></div>
                        <canvas id="canvas" class="mb-10" width="350" height="200" style="border:2px solid;"></canvas>
                        <button type="button" class="btn btn-sm btn-outline-danger mr-5 mb-5 float-right clearCanvas">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                        <button class="btn btn-xs btn-primary float-right" style="display: none" id="buttonLoading" type="button" disabled>
                            <i class="fa fa-spinner fa-spin"></i> Simpan
                        </button>
                        <button type="submit" id="buttonSubmit" class="btn btn-xs btn-primary float-right">
                            <i class="fa fa-print"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-xs btn-default float-right mr-5" data-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </form>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>