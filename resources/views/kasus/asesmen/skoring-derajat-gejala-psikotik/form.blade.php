<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">

		<div class="form-group col-md-3 col-sm-12">
			<label>Tanggal Pelaksanaan Skoring</label>
			<input type="text" class="form-control js-datepicker" name="tanggal_pelaksanaan_skoring" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Jam Pelaksanaan Skoring</label>
			<input type="text" class="form-control time" name="jam_pelaksanaan_skoring" autocomplete="off">
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Tempat Pelaksanaan Skoring</label>
			<input type="text" class="form-control" name="tempat_pelaksanaan_skoring" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Skoring</h4>
		</div>
		<div class="row mx-0">
			<div class="col-md-6 col-sm-12 row">
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Penampilan</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="penampilan" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Aktivitas Sosial</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="aktivitas_sosial" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Sikap</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="sikap" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Cara Bicara</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="cara_bicara" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Cara Berpikir</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="cara_berpikir" autocomplete="off">
				</div>
			</div>
			<div class="col-md-6 col-sm-12 row">
				<div class="form-group col-12 row mx-0">
					<label class="col-md-5 col-sm-12">Perilaku</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="perilaku" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-5 col-sm-12">Fungsi Intelek dan Orientasi</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="fungsi_intelek_dan_orientasi" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-5 col-sm-12">Pengendalian Emosi</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="pengendalian_emosi" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-5 col-sm-12">Fungsi Persepsi</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="fungsi_persepsi" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-5 col-sm-12">Tilikan</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="tilikan" autocomplete="off">
				</div>
			</div>
		</div>
	</div>
</div>