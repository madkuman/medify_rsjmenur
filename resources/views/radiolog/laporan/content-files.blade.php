<div class="row">
	<div class="col-3">
		<ul class="nav nav-pills flex-column">
			@foreach($laporan as $item)
			<li class="nav-item">
				<a class="nav-link @if($loop->first) active @endif" data-toggle="pill" href="#{{$item->slug}}">{{$item->nama}}</a>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="col-9">
		<div class="tab-content">
			@foreach($laporan as $lap)
			<div class="tab-pane container @if($loop->first) active @endif" id="{{$lap->slug}}">
				<ul class="nav nav-pills">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="pill" href="#{{$lap->slug}}-files">Pilih File</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#{{$lap->slug}}-picker">Buat Ulang</a>
					</li>
				</ul>
				<hr>
				<div class="tab-content">
					<div class="tab-pane container active p-0" id="{{$lap->slug}}-files">
						<h5 class="font-w400">Download laporan dan file yang telah tersedia.</h5>
						@include('radiolog.laporan.components.content-files-table',['lap' => $lap])
					</div>
					<div class="tab-pane container fade" id="{{$lap->slug}}-picker">
						<h5 class="font-w400">File akan dibuat ulang, dan akan tersedia pada pemilihan file.</h5>
						@include('radiolog.laporan.card.'.$lap->slug)
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>