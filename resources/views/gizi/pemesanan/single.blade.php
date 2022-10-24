@extends('gizi.layouts.index')

@section('title')
Medify - Gizi Pemesanan
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')?? '-' }}">
@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<a href="{{url('kasus/')?? '-' }}/{{$data['pesanan']->kasus->nomor_kasus?? '-' }}/form/all/custom/36" 
				class="btn btn-info pull-right ml-5"><i class="fa fa-sticky-note-o"></i> Skrining Gizi</a>
				<a href="{{url('gizi/pemesanan/edit/')?? '-' }}/{{$data['pesanan']->id?? '-' }}" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Edit</a>
				<a href="{{url('gizi/pemesanan/batal/')?? '-' }}/{{$data['pesanan']->id?? '-' }}" 
				class="btn btn-info pull-right mr-5"><i class="fa fa-close"></i> Pembatalan</a>
				<a href="{{url('gizi/pemesanan/delete/')?? '-' }}/{{$data['pesanan']->id?? '-' }}" 
				class="btn btn-danger pull-right mr-5"><i class="fa fa-trash"></i> Delete</a>
				Pesanan <small>#{{$data['pesanan']->id?? '-' }} </small>
			</h3>
		</div>
		<div class="block-content">
			<div class="row">
				<div class="col">
					<div class="row">
						<div class="col-2">
							<img class="img-avatar" src="{{url($data['pasien']->photo_thumb)?? '-' }}" alt="">
						</div>
						<div class="col-10 px-0">
							<h5 class="mb-0">{{$data['pasien']->name?? '-' }}</h5>
							<h6 class="mb-0 font-w400">{{$data['pasien']->getJenisKelaminAttribute()?? '-' }}, {{$data['pasien']->getAgeAttribute()?? '-' }} tahun</h6>
							<h6 class="mb-0 font-w400">{{$data['pasien']->no_rm?? '-' }}</h6>
							<span class="badge badge-info">{{$data['pesanan']->pembayaran->perusahaan->tipe->nama?? '-' }}</span>
							<!-- <span class="badge badge-info">{{$data['pesanan']->pembayaran->perusahaan->id?? '-' }}</span> -->
						</div>
					</div>
				</div>
				<div class="col">
				</div>
			</div>
			<div class="row mt-20">
				<div class="col">
					<h5 class="font-w400">
						<small>KODE DIET</small>
						@if(!empty($data['pesanan']->diet_kode->nama))
						<br>{{$data['pesanan']->diet_kode->nama?? '-' }} @if(!empty($data['pesanan']->lc)) - LC @endif @if(!empty($data['pesanan']->rg)) - RG @endif @if(!empty($data['pesanan']->ptg)) - PTG @endif
						@else
						<br> -
						@endif
					</h5>
<!-- 					<h5 class="font-w400">
						<small> DIET TAMBAHAN</small>
						@if(!empty($data['pesanan']->diet_tambahan))
						@foreach($data['pesanan']->diet_tambahan as $tambah)
						<br>{{$tambah->diet->nama?? '-' }}
						@endforeach
						@else
						<br>-
						@endif
					</h5> -->
					<h5 class="font-w400">
						<small>BENTUK MAKANAN</small>
						@if(!empty($data['pesanan']->bentuk_makanan))
						<br>{{$data['pesanan']->bentuk_makanan->nama?? '-' }}
						@else
						<br>-
						@endif
					</h5>
					<h5 class="font-w400">
						<small>RUANGAN</small>
						<br>{{$data['pesanan']->lokasi->nama?? '-' }}
					</h5>
					<h5 class="font-w400">
						<small>KELAS</small>
						<br>{{$data['pesanan']->kelas->nama?? '-' }}
					</h5>
					<h5 class="font-w400">
						<small>WAKTU MAKAN</small>
						<br>
						@if(in_array('1',$data['pesanan']->cek_waktu_makan()['waktu']))
						Pagi
						@endif
						@if(in_array('2',$data['pesanan']->cek_waktu_makan()['waktu']))
						, Siang
						@endif
						@if(in_array('3',$data['pesanan']->cek_waktu_makan()['waktu']))
						, Sore
						@endif
					</h5>
					<h5 class="font-w400">
						<small>JADWAL PENGANTARAN</small>
						@if(in_array('3',$data['pesanan']->cek_waktu_makan()['waktu']))
						<br>{{$data['pesanan']->cek_waktu_makan()['tanggal'][2]?? '-' }} - Sore
						@endif
						@if(in_array('1',$data['pesanan']->cek_waktu_makan()['waktu']))
						<br>{{$data['pesanan']->cek_waktu_makan()['tanggal'][0]?? '-' }} - Pagi
						@endif
						@if(in_array('2',$data['pesanan']->cek_waktu_makan()['waktu']))
						<br>{{$data['pesanan']->cek_waktu_makan()['tanggal'][1]?? '-' }} - Siang
						@endif
					</h5>
					<h5 class="font-w400">
						<small>CATATAN</small>
						@if(!empty($data['pesanan']->catatan))
						<p>{{$data['pesanan']->catatan?? '-' }}</p>
						@else
						<p>-</p>
						@endif
					</h5>
					<h5 class="font-w400">
						<small>ALERGI PASIEN</small>
						@if(!empty($data['alergi']))
						<p>{{$data['alergi']?? '-' }}</p>
						@else
						<p>Tidak Ada</p>
						@endif
					</h5>

				</div>
				<div class="col">
					<div class="row">
						<div class="col">
							@if(!empty($data['makan_pagi']))
							<h5 class="font-w400">
							<small>MAKAN PAGI</small>
							@foreach($data['makan_pagi'] as $m_pagi)
								<br>{{$m_pagi->resep->nama?? '-' }}
							@endforeach
							</h5>
							@endif
						</div>
						<div class="col">
							@if(!empty($data['makan_siang']))
							<h5 class="font-w400">
							<small>MAKAN SIANG</small>
							@foreach($data['makan_siang'] as $m_siang)
								<br>{{$m_siang->resep->nama?? '-' }}
							@endforeach
							</h5>
							@endif
						</div>

					</div>
					<div class="row">
						<div class="col">
							@if(!empty($data['makan_sore']))
							<h5 class="font-w400">
							<small>MAKAN SORE</small>
							@foreach($data['makan_sore'] as $m_sore)
								<br>{{$m_sore->resep->nama?? '-' }}
							@endforeach
							</h5>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col">
							@if(!empty($data['snack_pagi']))
							<h5 class="font-w400">
							<small>SNACK PAGI</small>
							@foreach($data['snack_pagi'] as $s_pagi)
								<br>{{$s_pagi->resep->nama?? '-' }}
							@endforeach
							</h5>
							@endif
						</div>
						<div class="col">
							@if(!empty($data['snack_sore']))
							<h5 class="font-w400">
							<small>SNACK SORE</small>
							@foreach($data['snack_sore'] as $s_sore)
								<br>{{$s_sore->resep->nama?? '-' }}
							@endforeach
							</h5>
							@endif
						</div>
					</div>

				</div>
			</div>
			<div class="row mt-20">
				<div class="col">
					<hr>
					<h6 class="p-10">
						<small class="text-muted">Dibuat Oleh</small><br>
						{{$data['pesanan']->pembuat->name?? '-' }}<br>
						<span class="font-w400">{{$data['pesanan']->created_at?? '-' }}</span>
					</h6>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection