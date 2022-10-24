<div id="modal-warning-edit" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Konfirmasi Edit Jawaban</h5>
			</div>
			<form method="POST" action="{{url()->current().'/edit'}}">
				<div class="modal-body text-center" id="modal-body">
					{!! csrf_field() !!}
					<input type="hidden" name="kuisionerslug" value="{{Request::segment(2)}}">
					<input type="hidden" name="kuisionerid" id="kuisioner-id-edit" >
					<div class="row">
						<div class="col-12">
							<i class="far fa-exclamation-circle fa-7x text-warning"></i>
						</div>
						<div class="col-12">
							<h5 class="font-w400 mt-10">Jawaban kuisioner hanya bisa diedit 1 kali.<br>Apakah Anda yakin ingin mengedit jawaban Anda?</h5>
						</div>
						<div class="col-12">
							<button type="button" data-dismiss="modal" class="btn-alt btn-secondary mr-2">
								Batal
							</button>
							<button type="submit" class="btn-warning ml-5 btn-alt">Edit Jawaban</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>