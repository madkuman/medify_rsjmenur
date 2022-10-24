<div class="row m-0 no-gutters">
	<div class="col-12 pl-30 pt-30" style="height: 15vh;">
		<h1>{{config('app.name')}}</h1>
	</div>
</div>
<div id="jam">
	<span id="hours"></span><span id="colon">:</span><span id="minutes"></span>
</div>
<div id="tanggal">
	Selasa, 05 Februari 2019
</div>
<div class="" style="height: 55vh;width: 100vw">
	<div id="video-container" style="">
		<div class="row" style="height: 100%">
			<div class="col-12">
				<div class="block block-transparent">
					<div class="block-content block-content-full text-right bg-image" style="background-image: url('{{url('assets/img/hospital-bg.jpg')}}'); height: 100%;padding:20px">
						<div class="py-20 text-center bg-black-op-25" style="height: 100%">
							<div class="font-size-h2 font-w500 mb-0 text-white">Informasi Rawat Inap</div>
							<div class="row p-10 mt-20">
								@for($i=1;$i<=8;$i++)
								
								@if($i > 4) @php $set = 1; @endphp 
								@else @php $set = 0; @endphp
								@endif

								<div class="col-3 set-{{$set}} @if($set) hide @endif">
									<div class="rawat-inap-content" id="rawat-inap-kelas-{{$i}}">
										<h4><span class="kelas"></span></h4>
										<span class="h2 total-kosong"></span><span class="total-kapasitas h5"></span>
									</div>
								</div>
								@endfor
							</div>
							<div class="text-center text-white">
								Update Terakhir : <span id="rawat-inap-last-update"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="antrian-1">
		<div class="block">
			<div class="block-header-1" id="memanggil-antrian">
				MEMANGGIL ANTRIAN
			</div>
			<div class="block-content">
				<div class="header-1" id="nomor-antrian-1">00</div>
				<div class="sub-header-1"  id="fitin">
					<div><div id="poli-antrian-1">default</div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div  id="row-3">
	<div class="row m-0 no-gutters pl-26 pr-40">
		<div class="col-3" style="height: 25vh">
			<div class="content-2 h-100">
				<div class="block block-full-height block-border-content block-content mb-0 text-center">
					<div class="header-2" id="nomor-antrian-2">00</div>
					<div class="sub-header-2-container" id="antrian-container-2">
						<div class="sub-header-2" id="poli-antrian-2">default</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-3" style="height: 25vh">
			<div class="content-2 h-100">
				<div class="block block-full-height block-border-content block-content mb-0 text-center">
					<div class="header-2" id="nomor-antrian-3">00</div>
					<div class="sub-header-2-container"  id="antrian-container-3">
						<div class="sub-header-2" id="poli-antrian-3">default</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-3" style="height: 25vh">
			<div class="content-2 h-100">
				<div class="block block-full-height block-border-content block-content mb-0 text-center">
					<div class="header-2" id="nomor-antrian-4">00</div>
					<div class="sub-header-2-container" id="antrian-container-4">
						<div class="sub-header-2" id="poli-antrian-4">default</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-3" style="height: 25vh">
			<div class="content-2 h-100">
				<div class="block block-full-height block-border-content block-content mb-0 text-center">
					<div class="header-2" id="nomor-antrian-5">00</div>
					<div class="sub-header-2-container" id="antrian-container-5">
						<div class="sub-header-2" id="poli-antrian-5">default</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="marquee" class="hide">
	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. END. 
	&nbsp;
</div>

<audio id="player">