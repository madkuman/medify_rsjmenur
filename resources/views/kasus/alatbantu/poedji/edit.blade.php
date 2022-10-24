<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Poedji Rochjati <i id="editLoading" class="fa fa-asterisk fa-spin"></i></h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/edit" method="POST">
							{{csrf_field()}}
							<input type="hidden" name="id" id="poedjiEditID">
							<select name="triwulan" class="form-control" id="selectTriwulan">
								<option value="1">Triwulan I</option>
								<option value="2">Triwulan II</option>
								<option value="3">Triwulan III</option>
								<option value="4">Triwulan IV</option>
							</select>
							<table class="table alat">
								<tr>
									<th width="10%"></th>
									<th class="text-left" width="80%">Parameters</th>
									<th width="10%">Skor</th>
								</tr>
								@foreach($parameters as $data)
								<tr>
									<td>
										<label class="checkbox text-center">
											<input type="checkbox" id="param{{$loop->index}}" name="param{{$loop->index}}" value="{{$data->score}}" data-toggle="checkbox">
										</label>
									</td>
									<th class="text-left">{{$data->parameter}}</th>
									<td>{{$data->score}}</td>
								</tr>
								@endforeach



							</table>
							<div class="modal-footer">
								<div class="form-group">
									<button type="button" class="btn btn-click-animate btn-default btn-simple" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-primary btn-simple">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>