
<div class="content pt-0">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="font-w400">Rencana Kegiatan Operasi</h3>
            <div id="summernote">
            	@if(empty($transaksi->deskripsi_rencana))
            	Belum ada Rencana
            	@else {!!html_entity_decode($transaksi->deskripsi_rencana)!!}
            	@endif
        	</div>
			<button id="save" class="btn btn-primary pull-right" onclick="save()" type="button">Save</button>
			<button id="edit" class="btn btn-warning pull-right" onclick="edit()" type="button">Edit</button>
		</div>
	</div>
</div>
<div class="col-lg-12"><hr></div>
<div class="content pt-0">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="font-w400">Rencana Penggunaan Obat dan Alat</h3>
			@if($rencana->isEmpty())
			<form id="hasil_pasca" method="POST" action="{{url('/kamaroperasi/pelaksanaan/rencana/obat')}}">
                {{csrf_field()}}
                <input type="hidden" name="operasi_id" value="{{$transaksi->id}}">
                <label class="col-12">Pilih Obat<star class="star">*</star></label>
                <div id="obat">
                    <div class="form-group row items">
	                    <div class="col-lg-6">
	                    	<select class="js-select2-item" name="obats[]" style="width: 100%">
								<option></option>
							  	@foreach($items as $item)
				                    <option value="{{$item->id}}" data-price="{{$item->price}}" data-qty="{{$item->qty_ready}}">{{$item->name}}</option>
				                @endforeach
							</select>
	                    </div>
						<div class="col-md-3">
							<input type="number" id="jumlah" class="form-control" placeholder="Jumlah" name="jumlah[]">
						</div>
					</div>
                </div>
                <div id="submit">
                	<button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
			</form>
			<div class="row" style="margin-top: 20px;">
                <div class="col-md-2 offset-md-4">
                    <button type="button" class="btn btn-primary btn-wd" id="btnAdd">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Obat
                    </button>
                </div>
            </div>
			@else
			@foreach($rencana as $rencanas) 
			<div class="row">
				<div class="col-lg-6">
					<h5 class="font-w400"><small>Nama Obat</small><br> {{$rencanas->obat->name}}</h5>
				</div>
				<div class="col-lg-3">
					<h5 class="font-w400"><small>Jumlah</small><br> {{ $rencanas->jumlah_obat}}</h5>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>