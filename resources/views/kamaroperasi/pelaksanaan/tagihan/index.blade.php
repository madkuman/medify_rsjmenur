<div class="content">
	<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-create-tindakan-manual"><i class="fa fa-plus"></i> Tambah Tagihan Manual</button>
	<button class="btn btn-primary pull-right mr-5" data-toggle="modal" data-target="#modal-create-tindakan"><i class="fa fa-plus"></i> Tambah Tagihan</button>
	<h4 class="mb-5">Tagihan Kamar Operasi</h4>
	<small>Daftar tagihan kasus yang berasal dari operasi ini</small>
	<hr>

	@if(!empty($tagihan[0]))
	<div class="table-responsive">
		<table class="table table-striped table-vcenter">
			<thead>
				<tr>
					<th>Uraian</th>
					<th class="text-center" style="width: 20%;">Harga Satuan</th>
					<th class="text-center" style="width: 10%;">Jumlah</th>
					<th class="text-center" style="width: 20%;">Subtotal</th>
					<th class="text-center" style="width:150px">Opsi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tagihan as $detail)
				<tr>
					<td class="font-w400">
						{{$detail->lokasi->nama}} - {{$detail->creator->name}}
						<h5 class="mb-1 mt-1">{{$detail->desc}}</h5>
						<span class="badge badge-primary mt-5">
							{{date('d F y, H:i', strtotime($detail->updated_at))}}
						</span>
						@if(!empty($detail->sep_id))
						<p>SEP : {{$detail->sep->no_sep}}</p>
						@endif
					</td>
					<td class="h5 font-w400">Rp <span style="float:right">{{number_format($detail->unit_price,0)}}</span></td>
					<td class="h5 font-w400 text-center">{{$detail->qty}}</td>
					<td class="h5 font-w400">Rp <span style="float:right">{{number_format($detail->subtotal,0)}}</span>
					</td>

					<td class="text-center">
						@if(!$detail->tagihan->checkout)
						<button type="button" class="btn btn-circle btn-alt-info mr-5 mb-5" onclick="showModalEdit({{$detail->id}})">
							<i class="fa fa-pencil"></i>
						</button>
						<button type="button" class="btn btn-circle btn-alt-danger mr-5 mb-5" onclick="showModalDelete({{$detail->id}})">
							<i class="fa fa-trash"></i>
						</button>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@else
	<div class="text-center py-50">
		<h4 class="font-w400 mb-5">Belum ada tagihan tersedia</h4>
		<p>Klik tombol <b>Tambah Tagihan</b> untuk menambahkan tagihan baru</p>
	</div>
	@endif
</div>

</div>