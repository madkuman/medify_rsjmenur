<div class="alert alert-warning alert-dismissable" role="alert" id="peringatan">
	<h5 class="alert-heading font-size-h4 font-w400">Terdapat Data Kosong Pada Bagian Berikut</h5>
	<ul>
		@if(empty($identitas->name) || $identitas->name == '-') @php $flag = 1; @endphp <li>Nama</li> @endif
		@if(empty($identitas->jenis_identitas)) @php $flag = 1; @endphp <li>Jenis Identitas</li> @endif
		@if(empty($identitas->gender)) @php $flag = 1; @endphp <li>Jenis Kelamin</li> @endif
		@if(empty($identitas->job) || $identitas->job == '-') @php $flag = 1; @endphp <li>Pekerjaan</li> @endif
		@if(empty($identitas->place_of_birth || $identitas->place_of_birth == '-')) @php $flag = 1; @endphp <li>Tempat Lahir</li> @endif
		@if(empty($identitas->date_of_birth)) @php $flag = 1; @endphp <li>Tanggal Lahir</li> @endif
		@if(empty($identitas->pendidikan)) @php $flag = 1; @endphp <li>Pendidikan</li> @endif
		@if(empty($identitas->marriage)) @php $flag = 1; @endphp <li>Pernikahan</li> @endif
		@if(empty($identitas->phone)) @php $flag = 1; @endphp <li>No HP</li> @endif
		@if(empty($identitas->address)) @php $flag = 1; @endphp <li>Alamat</li> @endif
		@if(empty($identitas->alamat_kecamatan)) @php $flag = 1; @endphp <li>Kecamatan</li> @endif
		@if(empty($identitas->alamat_kelurahan)) @php $flag = 1; @endphp <li>Kelurahan</li> @endif
		@if(empty($identitas->alamat_kota)) @php $flag = 1; @endphp <li>Kota</li> @endif
		@if($identitas->is_anggota == 1)
			@if(empty($identitas->tni_nrp)) @php $flag = 1; @endphp <li>NRP</li> @endif
			@if(empty($identitas->tni_keanggotaan)) @php $flag = 1; @endphp <li>Keanggotaan</li> @endif
			@if(empty($identitas->tni_pangkat)) @php $flag = 1; @endphp <li>Pangkat</li> @endif
			@if(empty($identitas->tni_kotama)) @php $flag = 1; @endphp <li>Kotama</li> @endif
			@if(empty($identitas->tni_satker)) @php $flag = 1; @endphp <li>Satker</li> @endif
		@endif

          @if(!empty($identitas->wali))
			@if(empty($identitas->wali->name)) @php $flag = 1; @endphp <li>Nama Keluarga</li> @endif
			@if(empty($identitas->wali->phone)) @php $flag = 1; @endphp <li>No HP Keluarga</li> @endif
			@if(empty($identitas->wali->address)) @php $flag = 1; @endphp <li>Alamat Keluarga</li> @endif
			@if(empty($identitas->jenis_hubungan_keluarga)) @php $flag = 1; @endphp <li>Hubungan Keluarga</li> @endif
		@endif
	</li>
</div>