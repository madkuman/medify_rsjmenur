<div class="modal fade" id="modal-konseling-obat-form" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url("")}}/kasus/{{$kasus->nomor_kasus}}/farmasi/konseling-obat/save">
				<div class="block block-themed block-transparent mb-0">
				    <div class="block-header">
				        <h3 class="block-title">Form Konseling Obat</h3>
				        <div class="block-options">
				            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
				                <i class="si si-close"></i>
				            </button>
				        </div>
				    </div>
					<input type="hidden" name="id" value="" id="id">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12 my-1">
                                <label for="" class="form-label">Metode</label>
                                <textarea name="metode" id="metode" cols="30" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 my-1">
                                <label for="" class="form-label">Uraian</label>
                                <textarea name="uraian" id="uraian" cols="30" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 my-1">
                                <label for="" class="form-label">Rekomendasi</label>
                                <textarea name="rekomendasi" id="rekomendasi" cols="30" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="modal-footer hide">
				    <div class="form-group">
				        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
				    </div>
				</div>
            </form>
        </div>
    </div>
</div>
