@php $skor = 0; @endphp
<div class="block-content">
	<div class="row">
		<div class="col-8">
			<table class="table">
				<tbody>
					<tr>
						<th>Usia</th>
						<td>
							@php $val = explode('--',$item->usia) @endphp
							{{$val[0] ?? "-"}}

							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
					<tr>
						<th>Dukungan Sosial</th>
						<td>
							@php $val = explode('--',$item->dukungan_sosial) @endphp
							{{$val[0] ?? "-"}}
							
							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
					<tr>
						<th>Status Fungsional</th>
						<td>
								@if($item->status_fungsional_mandiri == 1)
							<ul>
								<li>Mandiri</li>
							</ul>
								@php $skor += 0 @endphp
								@endif

							<label>Bergantung Dalam Hal :</label>
							<ul>
								@if($item->status_fungsional_bergantung_mandi == 1)
								<li>Mandi</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_makan == 1)
								<li>Makan</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_ke_kamar_mandi == 1)
								<li>ke Kamar Mandi</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_mobilisasi == 1)
								<li>Mobilisasi</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_bab == 1)
								<li>BAB</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_bak == 1)
								<li>BAK</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_pengobatan == 1)
								<li>Bertanggung Jawab Atas Pengobatannya</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung__makanan == 1)
								<li>Menyiapkan Makanan</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_keuangan == 1)
								<li>Mengatur Keuangan</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_daya_beli == 1)
								<li>Keterbatasan Daya Beli</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->status_fungsional_bergantung_transportasi == 1)
								<li>Transportasi</li>
								@php $skor += 1 @endphp
								@endif
							</ul>
						</td>
					</tr>
					<tr>
						<th>Kognitif</th>
						<td>
							@php $val = explode('--',$item->kognitif) @endphp
							{{$val[0] ?? "-"}}
							
							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
					<tr>
						<th>Perilaku</th>
						<td>
							<ul>
								@if($item->perilaku_tenang == 1)
								<li>Tenang</li>
								@php $skor += 0 @endphp
								@endif
								@if($item->perilaku_bingung == 1)
								<li>Bingung</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->perilaku_gelisah == 1)
								<li>Gelisah</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->perilaku_tidak_bisa_tenang == 1)
								<li>Tidak Bisa Tenang</li>
								@php $skor += 1 @endphp
								@endif
								@if($item->perilaku_lainnya == 1)
								<li>Lainnya</li>
								@php $skor += 1 @endphp
								@endif
							</ul>
						</td>
					</tr>
					<tr>
						<th>Mobilisasi</th>
						<td>
							@php $val = explode('--',$item->mobilisasi) @endphp
							{{$val[0] ?? "-"}}
							
							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
					<tr>
						<th>Gangguan Sensorik</th>
						<td>
							@php $val = explode('--',$item->sensorik) @endphp
							{{$val[0] ?? "-"}}
							
							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
					<tr>
						<th>Perawatan Sebelumnya</th>
						<td>
							@php $val = explode('--',$item->perawatan_sebelumnya) @endphp
							{{$val[0] ?? "-"}}
							
							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
					<tr>
						<th>Masalah Medis</th>
						<td>
							@php $val = explode('--',$item->masalah_medis) @endphp
							{{$val[0] ?? "-"}}
							
							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
					<tr>
						<th>Konsumsi Obat</th>
						<td>
							@php $val = explode('--',$item->konsumi_obat) @endphp
							{{$val[0] ?? "-"}}
							
							@if(!empty($val[1]))
							@php $skor += $val[1] @endphp
							@endif
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-4 text-center">
			<h4>Skor</h4>
			<h1 style="font-size: 8rem;font-weight: 400">{{$skor}}</h1>

			@if($skor <= 10)
			<div class="alert alert-primary">
				Butuh Perawatan Home Care
			</div>
			@elseif($skor>= 11 && $skor <= 19)
			<div class="alert alert-warning">
				Beresiko untuk perencanaan pulang
			</div>
			@else
			<div class="alert alert-danger">
				Perlu pendampingan komunitas
			</div>
			@endif
		</div>
	</div>

	<div class="col-12 creator">
		<h6 class="pt-10">
			<small class="text-muted">Dibuat Oleh</small><br>
			{{$item->creator->name}}<br>
			{{date("d F y, H:i", strtotime($item->created_at))}}
		</h6>
	</div>
</div>