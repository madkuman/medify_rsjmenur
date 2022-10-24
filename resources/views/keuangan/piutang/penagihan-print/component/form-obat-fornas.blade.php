@foreach($pasien as $each_pasien)
	<div class="@if(!$loop->last) page @endif">	
		<div class="title">
			<b>Formulir Permintaan Obat Khusus Didalam Obat Fornas<b>
		</div>

		<div class="nomor">
			<b>1. DATA PENDERITA</b> <br>
			<div style="display: inline;">
				<div class="sub-nomor">Nomer KP BPJS</div><div style="float: left;">: @isset($each_pasien->pembayaran[0]){{$each_pasien->pembayaran[0]->no_asuransi}}@else-@endisset</div>
			</div>
			<div style="display: inline;">
				<div class="sub-nomor">Nama Penderita</div><div style="float: left;">: {{$each_pasien->name}}</div>
			</div>
			<div style="display: inline;">
				<div class="sub-nomor">Umur Penderita</div><div style="float: left;">: {{date_diff(date_create($each_pasien->date_of_birth), date_create(date('Y-m-d')))->format('%y')}} Tahun</div>
			</div>
			<div style="display: inline;">
				<div class="sub-nomor">Status Penderita</div><div style="float: left;">:
					@if($each_pasien->marriage == 1)
				   		Anak
					@elseif($each_pasien->marriage == 2)
						@if($each_pasien->gender == 1)
							Suami
						@else 
							Istri
						@endif 
					@else 
						Peserta 
					@endif
			</div>
			</div>
		</div>

		<div class="nomor">
			<b>2. DIAGNOSIS</b> <br>
			@foreach($each_pasien->diagnosis as $each_diagnosis)
				<div style="display: inline;">
					<div class="sub-nomor">&nbsp;</div><div style="float: left;">: {{$each_diagnosis->icd10->code_icd}} - {{$each_diagnosis->icd10->long_desc}}</div>
				</div>
			@endforeach			
		</div>

		<div class="nomor">
			<b>3. OBAT KHUSUS DIDALAM FORNAS PT. BPJS YANG DIMINTA</b>
			<table>
				<tr>
					<th>No</th>
					<th>Nama Obat</th>
					<th>Jumlah</th>
					<th>Dosis</th>
					<th>Lama Pemberian</th>
				</tr>
				@foreach($each_pasien->obat_fornas as $each_obat_fornas)
					<tr>
						<td align="center">{{$loop->iteration}}</td>
						<td>{{$each_obat_fornas->nama_obat}}</td>
						<td>{{$each_obat_fornas->jumlah}}</td>
						<td>{{$each_obat_fornas->dosis}}</td>
						<td>{{$each_obat_fornas->lama_pemberian}}</td>
					</tr>
				@endforeach
			</table>
		</div>

		<div style="display: inline">
			<div class="ttd">
				<br>
				Mengetahui Tim Pengendali
				<br><br><br>
				(................................)
			</div>
			<div class="ttd">
				Surabaya, {{indonesian_date(date('d-m-Y'))}} <br>
				Dokter yang merawat
				<br><br><br>
				({{$each_pasien->dpjp['user']['name']}})
			</div>
		</div>
	</div>
@endforeach