<div id="modal-delete" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Konfirmasi Hapus</h5>
			</div>
			<form method="POST" action="{{url('k3/logbook/delete')}}">
				<div class="modal-body text-center" id="modal-body">
					{!! csrf_field() !!}
					<input type="hidden" name="logbookid" id="logbook-id-del" >
					<div class="row">
						<div class="col-12">
							<i class="far fa-exclamation-circle fa-7x text-danger"></i>
						</div>
						<div class="col-12">
							<h5 class="font-w400 mt-10">Apakah Anda yakin ingin menghapus data ini?</h5>
						</div>
						<div class="col-12">
							<button type="button" data-dismiss="modal" class="btn-alt btn-secondary mr-2">
								Batal
							</button>
							<button type="submit" class="btn-danger ml-5 btn-alt">Hapus</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>