<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Asesmen Killip</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create" method="POST">
							{{csrf_field()}}
							<table class="mews table table-vcenter">
								<tr>
									<th width="33.4%">Kelas</th>
									<th width="66.6%">Deskripsi</th>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="Class I" checked="checked" />
											<div class="row">
												<div class="col-4 text-center">Class I</div>
												<div class="col-8 text-center">Tidak ada tanda-tanda gagal jantung</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="Class II" />
											<div class="row">
												<div class="col-4 text-center">Class II</div>
												<div class="col-8 text-center">Suara tidak normal (rales, crackles) di paru-paru, terdapat S3</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="Class III" />
											<div class="row">
												<div class="col-4 text-center">Class III</div>
												<div class="col-8 text-center">Edema paru-paru</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="Class IV" />
											<div class="row">
												<div class="col-4 text-center">Class IV</div>
												<div class="col-8 text-center">Syok kardiogenik</div>
											</div>
										</label>
									</td>
								</tr>
							</table>
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
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>