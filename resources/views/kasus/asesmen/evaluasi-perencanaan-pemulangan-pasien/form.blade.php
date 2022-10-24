
<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
    {{csrf_field()}}
    <div class="row">
    	
							<div class="form-group col-md-3 col-sm-12">
							    <label>Tanggal</label>
							    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jam</label>
							    <input type="text" class="form-control" name="jam" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Implementasi P3</label>
							    <input type="text" class="form-control" name="implementasi_p3" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Evaluasi</label>
							    <input type="text" class="form-control" name="evaluasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Materi</label>
							    <input type="text" class="form-control" name="materi" >
							</div>
    </div>
</div>
