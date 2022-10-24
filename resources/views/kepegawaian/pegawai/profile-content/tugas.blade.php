<div class="row">
	<div class="col-12 mt-10 mb-20">
		<h5 class="card-title font-w400">DATA KONTRAK KERJA</h5>
		<hr>
		<div class="col-12 my-10">
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Jenis Pegawai</label>
				</div>
				<div class="col">
					{{$item->masterJenisPegawai->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Kategori Pegawai</label>
				</div>
				<div class="col">
					{{$item->masterKategoriPegawai->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Golongan Pegawai</label>
				</div>
				<div class="col">
					{{$item->masterGolonganPegawai->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Jabatan Pegawai</label>
				</div>
				<div class="col">
					{{$item->masterJabatan->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Pendidikan Pegawai</label>
				</div>
				<div class="col">
					{{$item->masterGelar->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Beban Kerja</label>
				</div>
				<div class="col">
					{{$item->masterBebanKerja->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Resiko Kerja</label>
				</div>
				<div class="col">
					{{$item->masterResikoKerja->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Tim Pembagi Jasa</label>
				</div>
				<div class="col">
					{{$item->masterTimPembagiJasa->nama ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Tanggal Masuk</label>
				</div>
				<div class="col">
					{{!empty($item->tmt) ? $item->tmt_formatted : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Nomor Surat Tugas Masuk</label>
				</div>
				<div class="col">
					{{!empty($item->phl_status) ? $item->phl_status : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Status Pegawai</label>
				</div>
				<div class="col">
					{{!empty($item->masterStatusPegawai->status) ? $item->masterStatusPegawai->status : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Tanggal Keluar</label>
				</div>
				<div class="col">
					{{!empty($item->tmt_out) ? $item->tmt_out_formatted : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Nomor Surat Tugas Keluar</label>
				</div>
				<div class="col">
					{{!empty($item->sprin_out_number) ? $item->sprin_out_number : '-'}}
				</div>
			</div>
		</div>
	</div>
</div>