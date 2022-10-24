<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
    {{csrf_field()}}
    <div class="row">
		<div class="form-group col-md-3 col-sm-12">
		    <label>Nama</label>
		    <input type="text" class="form-control" name="nama" value="{{$kasus->identitas->nama}}" readonly>
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Jenis kelamin</label>
		    <input type="text" class="form-control" name="jenis_kelamin" value="{{$kasus->identitas->gender}}" readonly>
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Umur pasien</label>
		    <input type="text" class="form-control" name="umur_pasien" value="{{$kasus->identitas->umur}}" readonly>
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Alamat</label>
		    <input type="text" class="form-control" name="alamat_lengkap" value="{{$kasus->identitas->alamat}}" readonly>
		</div>
		<div class="col-12">
			<h5 class="pt-15">Jika memerlukan rawat inap</h5>
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Tanggal mulai rawat inap</label>
		    <input type="text" class="js-datepicker form-control datepicker" placeholder="Tanggal Mulai" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd/mm/yyyy" name="mulai_rawat_inap">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Sampai dengan tanggal</label>
		    <input type="text" class="js-datepicker form-control datepicker" placeholder="Tanggal Selesai" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd/mm/yyyy" name="selesai_rawat_inap">
		</div>
		<div class="col-12">
			<h5 class="pt-15">Jika memerlukan rawat jalan</h5>
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Tanggal mulai rawat jalan</label>
		    <input type="text" class="js-datepicker form-control datepicker" placeholder="Tanggal Mulai" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd/mm/yyyy" name="mulai_rawat_jalan">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Sampai dengan tanggal</label>
		    <input type="text" class="js-datepicker form-control datepicker" placeholder="Tanggal Selesai" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd/mm/yyyy" name="selesai_rawat_jalan">
		</div>
		<div class="col-12">
			<h5 class="pt-15">Jika memerlukan istirahat</h5>
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Tanggal mulai istirahat</label>
		    <input type="text" class="js-datepicker form-control datepicker" placeholder="Tanggal Mulai" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd/mm/yyyy" name="mulai_istirahat">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Sampai dengan tanggal</label>
		    <input type="text" class="js-datepicker form-control datepicker" placeholder="Tanggal Selesai" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd/mm/yyyy" name="selesai_istirahat">
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Keperluan surat</label>
		    <input type="text" class="form-control" name="keperluan_surat" placeholder="Keperluan Surat">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Dokter yang merawat</label>
		    <select name="dokter_merawat" class="form-control" id="select" style="width: 100%;" required>  
				<option value="" selected disabled>Pilih Dokter</option>
				@foreach($dokter as $dokters)
				<option value="{{$dokters->name}}">{{$dokters->name}}</option>
				@endforeach
			</select>
		</div>
    </div>
</div>