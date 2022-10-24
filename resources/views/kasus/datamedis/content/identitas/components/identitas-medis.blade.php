
<div class="col-lg-12 mb-5">
	@if($allow_crud)
	<button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-update-identitas-medis"><i class="fa fa-pencil"></i> Edit Informasi Medis</button>
	@endif
	{{-- <!--
	<div class="dropdown float-right">
		<button type="button" class="btn-alt btn-rounded btn-secondary min-width-125 float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-angle-down"></i> Tambah Assessment Lain
		</button>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" target="_blank" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/nyeri"><i class="fa fa-pencil mr-5"></i> Asesmen Nyeri</a>
			<a class="dropdown-item" target="_blank" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/humpty-dumpty"><i class="fa fa-pencil mr-5"></i> Resiko Jatuh Anak (<18 thn)</a>
			<a class="dropdown-item" target="_blank" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/morse"><i class="fa fa-pencil mr-5"></i> Resiko Jatuh Dewasa</a>
			<a class="dropdown-item" target="_blank" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/fungsional"><i class="fa fa-pencil mr-5"></i> Asesmen Fungsional</a>
			<a class="dropdown-item" target="_blank" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/gizi"><i class="fa fa-pencil mr-5"></i> Skrining Gizi</a>
			<a class="dropdown-item" target="_blank" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/edukasi-pasien"><i class="fa fa-pencil mr-5"></i> Kebutuhan Edukasi</a>
			<a class="dropdown-item" target="_blank" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/pulang"><i class="fa fa-pencil mr-5"></i> Discharge Planning</a>
		</div>

	</div>
	--> --}}
	<h5 class="text-uppercase pt-15">Informasi Medis</h5>
</div>
<div class="col-lg-6">
	<h5 class="font-w400"><small>Tinggi Badan</small><br>
		{{ $identitas->tinggi_badan or '-' }} cm 
	</h5>
	<h5 class="font-w400"><small>Berat Badan</small><br>
		{{ $identitas->berat_badan or '-'}} kg
	</h5>
	<h5 class="font-w400"><small>Lingkar Perut</small><br>
		{{ $identitas->lingkar_perut or '-'}} cm
	</h5>
	<h5 class="font-w400"><small>Lingkar Dada</small><br>
		{{ $identitas->lingkar_dada or '-'}} 
	</h5>
	<h5 class="font-w400"><small>Warna Kulit</small><br>
		{{ $identitas->warna_kulit or '-'}}
	</h5>
	<h5 class="font-w400"><small>Warna Mata</small><br>
		{{ $identitas->warna_mata or '-'}} 
	</h5>
	<h5 class="font-w400"><small>Bentuk Badan</small><br>
		{{ $identitas->bentuk_badan or '-'}} 
	</h5>
</div>
<div class="col-lg-6">
	<h5 class="font-w400"><small>Golongan Darah</small><br>
		{{ $identitas->golongan_darah or '-'}}
	</h5>
	<h5 class="font-w400"><small>Riwayat Sakit</small><br>
		{{ $identitas->riwayat_sakit or '-'}}
	</h5>
	<h5 class="font-w400"><small>Alergi Obat</small><br>
		@php $i = 0 @endphp
		@forelse($identitas->alergi_obat_array as $item)
		<span class="badge badge-pill badge-primary">{{$item}}</span>
		@empty
		Tidak memiliki alergi
		@endforelse
	</h5>
	<h5 class="font-w400"><small>Alergi Makanan</small><br>
		@php $i = 0 @endphp
		@forelse($identitas->alergi_makanan_array as $item2)
		<span class="badge badge-pill badge-primary">{{$item2}}</span>
		@empty
		Tidak memiliki alergi
		@endforelse
	</h5>
	<h5 class="font-w400"><small>Tanggal Tirah Baring</small><br>
		@if(!empty($identitas->tanggal_tirah_baring_start))
        @php $tirah_baring_start = indonesian_date($identitas->tanggal_tirah_baring_start)
        @endphp
        @else
        @php $tirah_baring_start = '-' @endphp
        @endif

        @if(!empty($identitas->tanggal_tirah_baring_end))
        @php $tirah_baring_end = indonesian_date($identitas->tanggal_tirah_baring_end)
        @endphp
        @else
        @php $tirah_baring_end = '-' @endphp
        @endif

        Mulai : {{$tirah_baring_start}}<br>
        Selesai : {{$tirah_baring_end}}

	</h5>
</div>

