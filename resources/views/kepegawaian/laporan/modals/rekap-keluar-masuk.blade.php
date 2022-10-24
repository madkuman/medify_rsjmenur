<div class="modal fade" id="rekap-personel-keluar-masuk" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close text-right mt-20 mr-20" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<form id="form-keluar-masuk-report" action="{{url()->current()}}/rekap-keluar-masuk" target="_blank" enctype="multipart/form-data">
				<div class="mx-30">
					<h4 class="modal-title mb-10">Pilih Periode</h4>
					<div class="form-inline mb-10">
						<input type="text" id="date" data-format="DD-MM-YYYY" data-template="DD MMMM YYYY" name="date" class="combodate" value="{{date('d-m-Y')}}">
					</div>
	                @include('kepegawaian.laporan.component-form.tanda-tangan-select2')
				</div>
<!-- 				<div class="block-content">					
				</div> -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-alt-primary submit-button"><i class="fas fa-print mr-5"></i>Cetak</button>
				</div>
			</form>
		</div>
	</div>
</div>