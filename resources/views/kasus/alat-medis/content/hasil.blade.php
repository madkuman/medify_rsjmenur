<div class="row">
	<div class="col-12">
		<button type="button" class="btn btn-primary mb-15 pull-right" data-toggle="modal" data-target="#modal-hasil-operasi"><i class="fa fa-plus"></i> Tambah Hasil Operasi</button>
	</div>
</div>
@forelse($hasil_operasi as $key => $item)
<div class="block block-bordered block-mode-hidden">
	<div class="block-header block-header-default">
        <h5 class="mb-10 mt-10 block-title">
        	Operasi {{$item->tanggal_operasi->format('d F Y')}} :<br>
        	<strong>{{$item->diagnosis_akhir}}</strong>
        </h5>
	    <div class="block-options">
	        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
	    </div>
	</div>
	<div class="block-content soap-item">
		<div class="row">
		    <div class="col-md-12"><hr></div>
			<div class="col-md-6">
				<h4 class="font-w400">Hasil Operasi</h4>
			</div>
			<div class="col-md-6 text-right">
				@if(!empty($item->transaksi))
		        <a href="{{url('kamaroperasi').'/pelaksanaan/'.$item->transaksi->id.'#hasil_operasi'}}" class="btn btn-default text-uppercase">Lihat Operasi</a>
				<a href="{{url('kamaroperasi/pelaksanaan')}}/{{$item->transaksi->id}}/print/hasil" target="_blank">
				@else
				<a href="{{url()->current()}}/print/{{$item->id}}/hasil" target="_blank">
		        @endif
					<button type="button" class="btn btn-default">
						<i class="fa fa-print"></i> Print
					</button>
				</a>
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-hasil-operasi-{{$key}}"><i class="fa fa-pencil"></i> Edit</button>
			</div>
			<div class="col-6">
				<h5 class="font-w400">
					<small class="title-hasil">DIAGNOSIS AWAL</small><br>
					{{ $item->diagnosis_awal }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">DIAGNOSIS AKHIR</small><br>
					{{ $item->diagnosis_akhir }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">PERSIAPAN</small><br>
					{{ $item->persiapan }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">POSISI</small><br>
					{{ $item->posisi }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">DISINFEKTAN</small><br>
					{{ $item->disinfektan }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">INCISI</small><br>
					{{ $item->incisi }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">TEMUAN OPERASI</small><br>
					{{ $item->temuan_operasi }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">TINDAKAN</small><br>
					{{ $item->tindakan }}<br>
				</h5>
			</div>

			<div class="col-6">
				<h5 class="font-w400">
					<small class="title-hasil">PENDARAHAN</small><br>
					{{ $item->pendarahan }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">ADVICE POST OPS</small><br>
					{{ $item->advice_post }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">PEMERIKSAAN PA</small><br>
					{{ $item->pemeriksaan_pa }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">JENIS OPERASI</small><br>
					{{ $item->jenis->nama }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">TANGGAL OPERASI</small><br>
					{{ $item->tanggal_operasi->format('d F Y') }}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">WAKTU MULAI OPERASI</small><br>
					{{\Carbon\Carbon::parse($item->waktu_mulai)->format('H:i')}}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">WAKTU SELESAI OPERASI</small><br>
					{{\Carbon\Carbon::parse($item->waktu_selesai)->format('H:i')}}<br>
				</h5>
				<h5 class="font-w400">
					<small class="title-hasil">LAMA ANASTESI</small><br>
					{{\Carbon\Carbon::parse($item->lama_anastesi)->format('H:i')}}<br>
				</h5>
			</div>
			<div class="col-md-12"><hr></div>
		</div>
	</div>
</div>
@empty
<p class="col-12">Belum ada hasil operasi</p>
@endforelse