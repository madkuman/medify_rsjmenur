<div class="block-content">
	<div class="row">
		@foreach($master_cuti as $item)
		<div class="col-lg-3 col-md-4 col-6">
			<div class="block">
				<div class="block-content text-center  bg-primary py-5">
					<h5 class="mb-0 font-w400 text-white  text-center">{{$item->nama}}</h5>
				</div>
				<div class="block-content text-center">
					<h2 class="mb-0">{{$master_cuti_kuota[$item->id] ?? 0}}</h2>
					<h5 class="font-w400 mb-0"><small>SISA CUTI</small></h5>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>