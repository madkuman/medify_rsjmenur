<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="col-12">
				<h4 class="pt-15">Dokter</h4>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nama Obat</label>
			    <input type="text" class="form-control" name="nama_obat" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Dosis dan Frekuensi</label>
			    <input type="text" class="form-control" name="dosis_dan_frekuensi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nama Dokter</label>
			    <input type="text" class="form-control" name="nama_dokter" >
			</div>
			<div class="col-12">
				<h4 class="pt-15">Keperawatan</h4>
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam</label>
			    <input type="text" class="form-control time" name="jam" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Skor Nyeri</label>
			    <input type="number" class="form-control" name="skor_nyeri" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tensi</label>
			    <input type="number" class="form-control" name="tensi" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nadi</label>
			    <input type="text" class="form-control" name="nadi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nafas</label>
			    <input type="text" class="form-control" name="nafas" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Suhu</label>
			    <input type="text" class="form-control" name="suhu" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Intervensi Non Farmokologi</label>
			    <input type="text" class="form-control" name="intervensi_non_farmokologi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Waktu Kajian Ulang</label>
			    <input type="text" class="form-control time" name="waktu_kajian_ulang" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nama Perawat</label>
			    <input type="text" class="form-control" name="nama_perawat" >
			</div>
	    </div>
	</div>