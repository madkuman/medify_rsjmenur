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
		    <input type="text" class="form-control time" name="jam" autocomplete="off">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Ruangan</label>
		    <input type="text" class="form-control" name="ruangan" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Dx Medis</label>
		    <input type="text" class="form-control" name="dx_medis" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Tinggi Badan</label>
		    <input type="text" class="form-control" name="tinggi_badan" id="tb">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>Berat Badan</label>
		    <input type="text" class="form-control" name="berat_badan" id="bb">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>IMT</label>
		    <input type="text" class="form-control" name="imt" readonly id="imt">
		</div>
		<div class="form-group col-md-3 col-sm-12">
		    <label>IMTU</label>
		    <input type="text" class="form-control" name="imtu" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Asupan Nutrisi</h5>
		</div>

		<div class="col-12 skoring">
			<div class="row">
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="asupan_nutrisi" value="Asupan lebih dari 50" data-skor="0">
				            <span class="css-control-indicator"></span> Asupan lebih dari 50
				        </label>
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="asupan_nutrisi" value="Asupan 25 sampai 50" data-skor="1">
				            <span class="css-control-indicator"></span> Asupan 25 sampai 50
				        </label>
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="asupan_nutrisi" value="Asupan kurang dari 25" data-skor="2">
				            <span class="css-control-indicator"></span> Asupan kurang dari 25
				        </label>
				    </div>
				</div>
			</div>

			<input type="hidden" name="skor[]">
		</div>

		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15">Status Gizi</h5>
		</div>

		<div class="col-12 skoring">
			<div class="row">
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="status_gizi" value="Normal" data-skor="0">
				            <span class="css-control-indicator"></span> Normal
				        </label>
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="status_gizi" value="Gemuk" data-skor="0">
				            <span class="css-control-indicator"></span> Gemuk
				        </label>
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="status_gizi" value="Obesitas" data-skor="2">
				            <span class="css-control-indicator"></span> Obesitas
				        </label>
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="status_gizi" value="Kurus" data-skor="2">
				            <span class="css-control-indicator"></span> Kurus
				        </label>
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="status_gizi" value="Sangat Kurus" data-skor="2">
				            <span class="css-control-indicator"></span> Sangat Kurus
				        </label>
				    </div>
				</div>
			</div>

			<input type="hidden" name="skor[]">
		</div>

		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15">Pasien dengan kondisi khusus</h5>
		</div>

		<div class="col-12 skoring">
			<div class="row">
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="pasien_dengan_kondisi_khusus" value="Tidak" data-skor="0">
				            <span class="css-control-indicator"></span> Tidak
				        </label>
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group mb-5">
				        <label class="css-control css-control-primary css-radio">
				            <input type="radio" class="css-control-input" name="pasien_dengan_kondisi_khusus" value="Ya" data-skor="2">
				            <span class="css-control-indicator"></span> Ya
				        </label>
				    </div>
				</div>
			</div>

			<input type="hidden" name="skor[]">
		</div>

		<div class="form-group col-md-3 col-sm-12">
		    <label>Jika Ya, Sebutkan</label>
		    <input type="text" class="form-control" name="sebutkan_pasien_dengan_kondisi_khusus" >
		</div>
    </div>
</div>