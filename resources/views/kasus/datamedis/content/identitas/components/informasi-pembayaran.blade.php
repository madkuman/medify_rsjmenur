<div class="col-lg-12 mb-5">
	@if($allow_crud)
	<a type="button" class="btn-alt btn-primary min-width-125 float-right" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/datamedis/identitas/pembayaran/update"><i class="fa fa-pencil"></i> Edit Pembayaran</a>
	@endif
	@if(!empty($kasus->active_sep))
	<button class="btn-alt btn-info min-width-125 float-right" onclick="printSEP()">Print SEP</button>
	@endif
	<h5 class="text-uppercase pt-15">INFORMASI PEMBAYARAN</h5>
</div>
<div class="col-12">
	<div class="row">
		<div class="col-12 mb-10">
			<h5 class="mb-0"><small>Pembayaran Utama</small></h5>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="col-4">
					<h5 class="font-w400">
						{{ $kasus->pembayaran->perusahaan->nama or '-'}}
						@if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
						<br>
						<small>No SEP : {{$kasus->active_sep->no_sep ?? ''}}</small>
						@endif
					</h5>
				</div>
				<div class="col-4">
					<h5 class="font-w400">
						{{ $kasus->pembayaran->no_asuransi or '-'}}
					</h5>
				</div>
				<div class="col-4">
					<h5 class="font-w400">
						Kelas {{ $kasus->pembayaran->kelas->nama or '-'}}
					</h5>
				</div>
			</div>
		</div>
		@if(count($kasus->pembayaranTambahan) > 0)
		<div class="col-12 mb-10">
			<h5 class="mb-0"><small>Pembayaran Tambahan</small></h5>
		</div>
		@foreach($kasus->pembayaranTambahan as $item)
		<div class="col-8">
			<div class="row">
				<div class="col-4">
					<h5 class="font-w400 mb-5">
						{{ $item->pembayaran->perusahaan->nama or '-'}}
					</h5>
				</div>
				<div class="col-4">
					<h5 class="font-w400 mb-5">
						{{ $item->pembayaran->no_asuransi or '-'}}
					</h5>
				</div>
				<div class="col-4">
					<h5 class="font-w400 mb-5">
						Kelas {{ $item->pembayaran->kelas->nama or '-'}}
					</h5>
				</div>
			</div>
		</div>
		@endforeach
		@endif
	</div>
</div>

<div class="col-lg-12"><hr></div>