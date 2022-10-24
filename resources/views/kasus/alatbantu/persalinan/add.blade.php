<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog pl-20" style="min-width: 100%">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Asesmen Persalinan</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content">
						<input type="hidden" name="persalinan_id" id="id">
						@include('kasus.alatbantu.persalinan.components.persalinan-data-umum')
						<div class="row">
							@include('kasus.alatbantu.persalinan.components.persalinan-ikhtiyar')
							@include('kasus.alatbantu.persalinan.components.persalinan-keadaan-ibu')
							@include('kasus.alatbantu.persalinan.components.persalinan-placenta')
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group">
							<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>