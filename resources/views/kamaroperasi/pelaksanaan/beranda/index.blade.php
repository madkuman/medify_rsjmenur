
<div class="content pt-0">
	<div class="row">
		<div class="col-lg-6">
			<h3 class="font-w400">Identitas Pasien</h3>
			<h5 class="font-w400"><small>Nama Pasien</small><br> {{$transaksi->pasien_detail->name}}</h5>
			<h5 class="font-w400"><small>Jenis Kelamin</small><br> {{ $transaksi->pasien_detail->gender == '1' ? 'Laki laki' : 'Perempuan' }}</h5>
			<h5 class="font-w400"><small>Tempat, Tanggal Lahir</small><br> {{ $transaksi->pasien_detail->place_of_birth }}, {{\Carbon\Carbon::createFromFormat('Y-m-d', $transaksi->pasien_detail->date_of_birth)->format('d-m-Y') }}</h5>
			<h5 class="font-w400"><small>Alamat</small><br> {{ $transaksi->pasien_detail->address }}</h5>
			<h5 class="font-w400"><small>Status Pernikahan</small><br> {{ $transaksi->pasien_detail->marriage == 1 ? 'Menikah' : 'Tidak Menikah'}}</h5>
		</div>
		<div class="col-lg-6">
			<h3 class="font-w400">Jadwal Operasi</h3>
			<h5 class="font-w400"><small>Jadwal Operasi</small><br> {{Carbon\Carbon::createFromFormat('Y-m-d', $transaksi->jadwal_operasi)->format('l, j F Y')}}</h5>
			<h5 class="font-w400"><small>Ruang Operasi</small><br> {{$transaksi->ruangan->name}}</h5>
			<h5 class="font-w400"><small>Nomor Ronde</small><br> {{ $transaksi->nomor_ronde}}</h5>
			<h5 class="font-w400"><small>Status Pelaksanaan Operasi</small><br> {{ $transaksi->status == 1 ? 'Telah Terlaksana' : 'Dalam Perencanaan' }}</h5>
		</div>
		<div class="col-lg-12"><hr></div>
		<div class="col-lg-6">
			<h3 class="font-w400">Dokter Pelaksana</h3>
			<h5 class="font-w400"><small>Nama Dokter</small><br> {{ $transaksi->dokter->name }}</h5>
		</div>
		<div class="col-lg-6">
		</div>
	</div>
</div>