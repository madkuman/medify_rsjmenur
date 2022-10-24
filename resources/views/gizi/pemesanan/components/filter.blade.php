

		<div class="block-content" id="filter">
			<div class="form-group row">
				<div class="col-md-3">
					<label>Tanggal</label>
					<form action="{{url()->current()}}" method="GET">
						<div class="input-group">
							<input type="text" class="js-datepicker form-control" id="filter-tanggal" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off">
							<div class="input-group-append">
								<button type="submit" class="btn btn-secondary">Filter</button>
							</div>
						</div>
					</form>

				</div>
				<div class="col-md-6">
					<label>Tipe Rekap</label>
					<ul class="nav nav-pills push">
						<li class="nav-item">
							<a class="nav-link 
							@if($flag == 0)
							active
							@endif
							" href="{{url('gizi/pemesanan/rekap-diet')}}">Diet</a>
						</li>
						<li class="nav-item">
							<a class="nav-link
							@if($flag == 1)
							active
							@endif
							" href="{{url('gizi/pemesanan/rekap-resep')}}">Resep</a>
						</li>
						<li class="nav-item">
							<a class="nav-link
							@if($flag == 2)
							active
							@endif
							" href="{{url('gizi/pemesanan/rekap-jp')}}">Jenis-Pasien</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link
							@if($flag == 3)
							active
							@endif
							" href="{{url('gizi/pemesanan/rekap-diet-v2')}}">Diet Kombinasi</a>
						</li> -->
					</ul>
				</div>
			</div>
		</div>