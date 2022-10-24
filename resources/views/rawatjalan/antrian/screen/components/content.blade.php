<div class="flat-transparent" style="height: 100vh;width: 100vw">
	<div class="row mx-0">
		<div class="col-6">
			<div class="row mt-20">
				<div class="col-12 pt-5 pb-10 pr-20" id="antrian-1">
					<div class="block">
						<div class="block-header-1" id="memanggil-antrian">
							MEMANGGIL ANTRIAN
						</div>
						<div class="block-content">
							<div class="header-1" id="nomor-antrian-1">00</div>
							<div class="sub-header-1"  id="fitin">
								<div><div id="ruangan-antrian-1">Test</div></div>
							</div>
						</div>
					</div>
					<input type="hidden" name="active_antrian" id="active_antrian">
				</div>	
				@php $num_ruangan = 0; @endphp
				@foreach ($ruangan as $key => $item)
				@if ($loop->iteration < 5)
				<?php $nama = explode(' ',$item); ?>
				<div class="col-6" style="height: 23vh">
					<div class="content-2 h-100">
						<div class="block block-full-height block-border-content block-content mb-0 text-center">
							<div class="header-2 ruangan-{{$ruangan_id[$key]}}" id="nomor-antrian-{{$loop->iteration + 1}}"><br></div>
							<div class="sub-header-2-container" id="antrian-container-{{$loop->iteration + 1}}">
								<div class="sub-header-2" id="ruangan-antrian-{{$loop->iteration + 1}}">{{count($nama) > 1 ? $nama[0].' '.$nama[1] : $nama[0]}}</div>
							</div>
						</div>
					</div>	
				</div>
				@endif
				@php $num_ruangan++ @endphp
				@endforeach
				@if ($num_ruangan < 4)
				@for ($i = 0; $i < (4 - $num_ruangan); $i++)
				<div class="col-6" style="height: 23vh">
					<div class="content-2 h-100">
						<div class="block block-full-height block-border-content block-content mb-0 text-center">
							<div class="header-2"><br></div>
							<div class="sub-header-2-container">
								<div class="sub-header-2"></div>
							</div>
						</div>
					</div>	
				</div>
				@endfor
				@php $num_ruangan = $num_ruangan + (4 - $num_ruangan); @endphp
				@endif
			</div>
		</div>
		<div class="col-6">
			<div class="row mt-20">
				@foreach ($ruangan as $key => $item)
				@if ($loop->iteration > 4)
				<?php $nama = explode(' ',$item); ?>
				<div class="col-6" style="height: 23vh">
					<div class="content-2 h-100">
						<div class="block block-full-height block-border-content block-content mb-0 text-center">
							<div class="header-2 ruangan-{{$ruangan_id[$key]}}" id="nomor-antrian-{{$loop->iteration + 1}}"><br></div>
							<div class="sub-header-2-container" id="antrian-container-{{$loop->iteration + 1}}">
								<div class="sub-header-2" id="ruangan-antrian-{{$loop->iteration + 1}}">{{count($nama) > 1 ? $nama[0].' '.$nama[1] : $nama[0]}}</div>
							</div>
						</div>
					</div>	
				</div>
				@endif
				@endforeach
				@if ($num_ruangan < 12)
				@for ($i = 0; $i < (12 - $num_ruangan); $i++)
				<div class="col-6" style="height: 23vh">
					<div class="content-2 h-100">
						<div class="block block-full-height block-border-content block-content mb-0 text-center">
							<div class="header-2"><br></div>
							<div class="sub-header-2-container">
								<div class="sub-header-2"></div>
							</div>
						</div>
					</div>	
				</div>
				@endfor
				@endif
			</div>
		</div>
	</div>
	<audio id="player"></audio>
</div>