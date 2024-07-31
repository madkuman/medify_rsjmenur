<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">

		<div class="form-group col-md-4 col-sm-12">
			<label>Tanggal Pelaksanaan Skoring</label>
			<input type="text" class="form-control js-datepicker" name="tanggal_pelaksanaan_skoring" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
		</div>
		<div class="form-group col-md-4 col-sm-12">
			<label>Jam Pelaksanaan Skoring</label>
			<input type="text" class="form-control time" name="jam_pelaksanaan_skoring" autocomplete="off">
		</div>
		<div class="form-group col-md-4 col-sm-12">
			<label>Tempat Pelaksanaan Skoring</label>
			<input type="text" class="form-control" name="tempat_pelaksanaan_skoring" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Skoring</h4>
		</div>
		<div class="row mx-0">
			<div class="col-md-12 col-sm-12 row">
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Gaduh Gelisah</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="gaduh_gelisah" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Permusuhan</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="permusuhan" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Ketegangan</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="ketegangan" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Ketidak Kooperatifan</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="ketidak_kooperatifan" autocomplete="off">
				</div>
				<div class="form-group col-12 row mx-0">
					<label class="col-md-4 col-sm-12">Pengendalian Impuls yang Buruk</label>
					<input type="number" class="form-control col-md-4 col-sm-12" name="pengendalian_impuls_yang_buruk" autocomplete="off">
				</div>
			</div>			
		</div>
	</div>
</div>