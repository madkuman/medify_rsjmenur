
<div class="row">
	<div class="col-12 mt-10 mb-20">
		<h5 class="card-title font-w400">DATA PERNIKAHAN</h5>
		<hr>
		<div class="col-12 my-10">
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Status</label>
				</div>
				@php
				$marriages = [
				'K' => 'Menikah',
				'TK' => 'Belum Menikah',
				'D' => 'Duda',
				'J' => 'Janda'
				];

				$status = '-';
				if(!empty($marriage->status))
				$status = $marriages[$marriage->status];
				@endphp
				<div class="col">
					{{ $status }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Jumlah Anak</label>
				</div>
				<div class="col">
					{{!empty($marriage->total_child) ? $marriage->total_child : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>No. Surat Nikah</label>
				</div>
				<div class="col">
					{{!empty($marriage->marriage_certificate_number) ? $marriage->marriage_certificate_number : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Tanggal Pernikahan</label>
				</div>
				<div class="col">
					{{!empty($marriage->marriage_date) ? $marriage->marriage_date_formatted : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Tempat Pernikahan</label>
				</div>
				<div class="col">
					{{!empty($marriage->marriage_place) ? $marriage->marriage_place : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Pekerjaan Pasangan</label>
				</div>
				<div class="col">
					{{!empty($marriage->couple_job) ? $marriage->couple_job : '-'}}
				</div>
			</div>
		</div>
	</div>
</div>