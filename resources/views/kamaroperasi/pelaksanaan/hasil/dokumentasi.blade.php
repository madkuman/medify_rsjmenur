<div class="row">
	<div class="col-md-12">
		<br><hr>
		<p class="h5 my-0 mb-10">Upload Dokumentasi Hasil Operasi</p>
		<form action="{{url('kamaroperasi/upload/gambar')}}" id="my-dropzone" method="POST" class="dropzone">
			<input type="hidden" name="transaksi_id" value="{{$transaksi->id}}">
			{{csrf_field()}}
		</form>
	</div>
</div>
<br><hr>
<p class="h5 my-0">Dokumentasi Hasil Operasi</p>
<br>
<div class="container mb-10">
	<div class="col-md-12" id="lightgallery" data-color="#42a5f5" data-opacity="1" data-always-visible="true" data-height="300px">
		<div class="row" id="baris-foto"> 
			@forelse($transaksi->foto as $foto)
			<div class="col-3" style="margin-bottom: 2%">
				<div id="{{$foto->last_url}}" class="photo-preview katalog" data-src="{{URL::asset($foto->url)}}" style="height: 150px; margin: 1%; overflow: hidden;">
					<a class="img-link img-link-zoom-in img-thumb img-lightbox">
						<img src="{{URL::asset($foto->url)}}" class="four-col" style="max-width: 100%;">
					</a>
					<br>
				</div>
				<button id="{{$foto->last_url}}_btn" class="btn btn-danger" style="display: block; margin:0 auto;" onclick="deleteFoto({{$foto->id}})">Hapus</button>
			</div>
			@empty
			<div id="dokumentasi-empty">
			Tidak Ada Dokumentasi
			</div>
			@endforelse
		</div>
	</div>
</div>