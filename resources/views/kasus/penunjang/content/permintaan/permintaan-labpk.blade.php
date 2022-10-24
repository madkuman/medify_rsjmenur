<div class="modal fade" id="permintaanLabPK" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
		<div class="modal-content py-20">

			<form class="col-md-12 text-center" enctype="multipart/form-data" id="form" method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/permintaan-penunjang/create">
				{!! csrf_field() !!}
				<input type="hidden" name="kasus_id" value="{{$kasus->id}}">
				<input type="hidden" name="departemen" value="lab_pk">

				<div class="row" style="text-align: left">
					<div class="col-12">
						<h4>Permintaan Lab PK</h4>
						<hr>
					</div>
					<div class="col-md-12">
						<div class="form-group row">
							<label class="col-12" for="example-masked-time">Jam Sampling</label>
							<div class="col-lg-12">
								<input type="text" class="js-masked-time form-control" name="jam_sampling" placeholder="00:00">
							</div>
						</div>
					</div> 
					{{--
					@foreach($labpk as $layanan_kategori)
					<div class="col-md-12 py-20 px-30">
						<div class="row"> 
							<div class="col-12">
								<h5><strong>{{$layanan_kategori->name}}</strong></h5>
								<hr>
							</div>

							@foreach($layanan_kategori->layanan as $item)
							<div class="col-6">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="services[]" value="{{$item->id}}">
									<span class="css-control-indicator"></span>  {{$item->name}} (Rp {{number_format($item->harga,0)}})
								</label>
							</div>
							@endforeach
						</div>
					</div>
					@endforeach
					--}}
					<div class="col-12 text-center mt-20">

						<button type="submit" class="btn btn-info btn-hero btn-fill  " style="">Submit</button>
					</div>
				</div>

			</form> 
		</div>
	</div>
</div>