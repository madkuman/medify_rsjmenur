<input type="hidden" name="id" value="" id="id">
<div class="block-content">
    {{csrf_field()}}
    <div class="row">
    	<div class="col-md-12">
    		<div class="row">
		    	<div class="form-group col-md-3 col-sm-12">
				    <label>No. RM</label>
				    <input type="text" class="form-control" name="no_rm" value="{{$identitas->no_rm}}" readonly>
				</div>
		    	<div class="form-group col-md-3 col-sm-12">
				    <label>Nama Pasien</label>
				    <input type="text" class="form-control" name="nama_pasien" value="{{$identitas->name}}" readonly>
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Tanggal Lahir</label>
				    <input type="text" class="form-control" name="tgl_lahir_pasien" value="{{date("d/m/Y", strtotime($identitas->date_of_birth))}}" readonly>
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Umur</label>
				    <input type="text" class="form-control" name="umur_pasien" value="{{$identitas->age}}" readonly>
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Jenis Kelamin</label>
				    <input type="text" class="form-control" name="jenis_kelamin_pasien" value="@if ($identitas->gender == 1) Laki laki @else Perempuan @endif" readonly>
				</div>
			</div>
		</div>

		<div class="col-md-12">
    		<div class="row">
				<div class="form-group col-md-3 col-sm-12">
				    <label>Nama Wali</label>
				    <input type="text" class="form-control" name="nama_wali">
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Alamat</label>
				    <input type="text" class="form-control" name="alamat_wali">
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>No. Telepon</label>
				    <input type="text" class="form-control" name="telepon_wali">
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Hubungan Dengan Pasien</label>
				    <select name="hubungan" class="form-control js-select2" style="width: 100%;" id="hubungan" required>  
						<option value="" selected disabled>Silahkan Pilih</option>
						<option value="Diri Sendiri">Diri Sendiri</option>
						<option value="Suami">Suami</option>
						<option value="Isteri">Isteri</option>
						<option value="Ibu">Ibu</option>
						<option value="Ayah">Ayah</option>
						<option value="Anak">Anak</option>
						<option value="Lain-lain">Lain-lain</option>
					</select>
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Dipindahkan perawatannya dari kelas</label>
				    <select name="awal_kelas" class="form-control js-select2" style="width: 100%;" id="awal_kelas" required>  
						<option value="" selected disabled>Pilih Kelas</option>
						@foreach($kelas as $kelas_ranap)
						<option value="{{$kelas_ranap->id}}">{{$kelas_ranap->nama}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Menuju ke kelas</label>
				    <select name="tujuan_kelas" class="form-control js-select2" style="width: 100%;" id="tujuan_kelas" required>  
						<option value="" selected disabled>Pilih Tujuan Kelas</option>
						@foreach($kelas as $kelas_ranap)
						<option value="{{$kelas_ranap->id}}">{{$kelas_ranap->nama}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3 col-sm-12">
				    <label>Ruangan</label>
				    <input type="text" class="form-control" name="ruangan_pasien" value="">
				</div>
			</div>
		</div>
    </div>
</div>