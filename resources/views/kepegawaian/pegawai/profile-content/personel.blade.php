
<div class="row">
	<div class="col-12 mt-10 mb-20">
		<h5 class="card-title font-w400">DATA PERSONAL</h5>
		<hr>
		<div class="col-12 my-10">
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>KTP</label>
				</div>
				<div class="col">
					{{!empty($item->identity_card) ? $item->identity_card : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Nomor KK</label>
				</div>
				<div class="col">
					{{!empty($item->family_registers) ? $item->family_registers : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Agama</label>
				</div>
				<div class="col">
					{{ $item->agama->nama ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Suku/Bangsa</label>
				</div>
				<div class="col">
					{{ $item->suku_bangsa ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Golongan Darah</label>
				</div>
				<div class="col">
					{{!empty($item->blood_type) ? $item->blood_type : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Jenis Kendaraan</label>
				</div>
				<div class="col">
					{{$item->masterJenisKendaraan->nama ?? '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Nomor HP/Telp</label>
				</div>
				<div class="col">
					{{!empty($item->phone) ? $item->phone : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Email</label>
				</div>
				<div class="col">
					{{!empty($item->email) ? $item->email : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>NPWP</label>
				</div>
				<div class="col">
					{{!empty($item->npwp) ? $item->npwp : '-'}}
				</div>
			</div>
			@if (!empty($item->sim_a))
				<div class="row my-10">
					<div class="col-sm-5 col-xs-3 col-12">
						<label>Nomor SIM A</label>
					</div>
					<div class="col">
						{{ !empty($item->sim_a) ? $item->sim_a : '-' }}
					</div>
				</div>
			@endif
			@if (!empty($item->sim_b1))
				<div class="row my-10">
					<div class="col-sm-5 col-xs-3 col-12">
						<label>Nomor SIM B1</label>
					</div>
					<div class="col">
						{{ !empty($item->sim_b1) ? $item->sim_b1 : '-' }}
					</div>
				</div>
			@endif
			@if (!empty($item->sim_b2))
				<div class="row my-10">
					<div class="col-sm-5 col-xs-3 col-12">
						<label>Nomor SIM B2</label>
					</div>
					<div class="col">
						{{ !empty($item->sim_b2) ? $item->sim_b2 : '-' }}
					</div>
				</div>
			@endif
			@if (!empty($item->sim_c))
				<div class="row my-10">
					<div class="col-sm-5 col-xs-3 col-12">
						<label>Nomor SIM C</label>
					</div>
					<div class="col">
						{{ !empty($item->sim_c) ? $item->sim_c : '-' }}
					</div>
				</div>
			@endif
			@if (!empty($item->sim_d))
				<div class="row my-10">
					<div class="col-sm-5 col-xs-3 col-12">
						<label>Nomor SIM D</label>
					</div>
					<div class="col">
						{{ !empty($item->sim_d) ? $item->sim_d : '-' }}
					</div>
				</div>
			@endif
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Nomor Plat Kendaraan</label>
				</div>
				<div class="col">
					{{!empty($item->license_plate) ? $item->license_plate : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Rekening Bank</label>
				</div>
				<div class="col">
					{{ !empty($item->bank) ? $item->masterNamaBank->nama.(!empty($item->bank_account) ? ' - '.$item->bank_account : '') : '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Atas Nama Rekening Bank</label>
				</div>
				<div class="col">
					{{ $item->atas_nama_bank ?? '-' }}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Status Rumah</label>
				</div>
				<div class="col">
					{{ !empty($item->masterStatusRumah->status) ? $item->masterStatusRumah->status : '-'}}
				</div>
			</div> 
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Ukuran Tutup Kepala</label>
				</div>
				<div class="col">
					{{!empty($item->headgear) ? $item->headgear : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Ukuran Baju</label>
				</div>
				<div class="col">
					{{!empty($item->size_chart) ? $item->size_chart : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Tinggi Badan</label>
				</div>
				<div class="col">
					{{!empty($item->height) ? $item->height.' cm' : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Berat Badan</label>
				</div>
				<div class="col">
					{{!empty($item->weight) ? $item->weight.' kg' : '-'}}
				</div>
			</div>
			<div class="row my-10">
				<div class="col-sm-5 col-xs-3 col-12">
					<label>Ukuran Sepatu</label>
				</div>
				<div class="col">
					{{!empty($item->shoe_size) ? $item->shoe_size : '-'}}
				</div>
			</div>
		</div>
	</div>  
</div>