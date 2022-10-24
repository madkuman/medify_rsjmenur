
	<div class="modal fade" id="qualificationreport" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<button type="button" class="close text-right mt-20 mr-20" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<form id="form-nominative-report" method="POST" action="{{ route('qualification-report') }}" target="_blank" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="mx-30">
						<h4 class="modal-title mb-10">Pilih Periode</h4>
						<div class="form-inline">
							<input type="text" id="date" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="month_year" class="combodate" value="{{date('d-m-Y')}}">
						</div>
					</div>
					@include('kepegawaian.laporan.sign_form')
					<div class="modal-footer">
						<button type="submit" class="btn btn-alt-primary  submit-button"><i class="fas fa-print mr-5"></i>Cetak</button>
					</div>
				</form>
			</div>
		</div>
	</div>