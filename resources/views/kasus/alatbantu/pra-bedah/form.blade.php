<input type="hidden" name="id" value="" class="id-asesmen">
<input type="hidden" name="jenis" value="pra-bedah">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Pengkajian</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Keadaan Pra Bedah</label>
				<div class="col-12">
					<input type="text" class="form-control" name="keadaan_pra_bedah">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Pemeriksaan Fisik</label>
				<div class="col-12">
					<input type="text" class="form-control" name="pemeriksaan_fisik">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Keadaan Umum</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">GCS</label>
				<div class="col-12">
					<input type="text" class="form-control" name="gcs">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Vital Sign</label>
				<div class="col-12">
					<input type="text" class="form-control" name="vital_sign">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">TD</label>
				<div class="col-12">
					<input type="text" class="form-control" name="td">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">N</label>
				<div class="col-12">
					<input type="text" class="form-control" name="n">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">RR</label>
				<div class="col-12">
					<input type="text" class="form-control" name="rr">
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Suhu</label>
				<div class="col-12">
					<input type="text" class="form-control" name="suhu">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Pemeriksaan Regional</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="skull">
					<span class="css-control-indicator"></span> Skull
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="cervical">
					<span class="css-control-indicator"></span> Cervical
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="thoraks">
					<span class="css-control-indicator"></span> Thoraks
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="abdomen">
					<span class="css-control-indicator"></span> Abdomen
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="ekstremitas">
					<span class="css-control-indicator"></span> Ekstremitas
				</label>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Asesmen</h5>
		</div>
		<div class="col-md-5">
			<div class="form-group row mb-5">
				<label class="col-12">Asesmen</label>
				<div class="col-12">
					<textarea class="form-control" name="asesmen"></textarea>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Pemeriksaan Penunjang</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="ecg">
					<span class="css-control-indicator"></span> ECG
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="lab">
					<span class="css-control-indicator"></span> Lab
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="ro">
					<span class="css-control-indicator"></span> Ro
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="ct_scan">
					<span class="css-control-indicator"></span> CT Scan
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="mri">
					<span class="css-control-indicator"></span> MRI
				</label>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Lain-lain</label>
				<div class="col-12">
					<input type="text" class="form-control" name="lainlain">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-md-5">
			<div class="form-group row mb-5">
				<label class="col-12">Diagnosa Pra Bedah</label>
				<div class="col-12">
					<textarea class="form-control" name="diagnosa_pra_bedah"></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group row mb-5">
				<label class="col-12">Planning : Th/ Dx</label>
				<div class="col-12">
					<textarea class="form-control" name="planning_th_dx"></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Alat Khusus</label>
				<div class="col-12">
					<input type="text" class="form-control" name="alat_khusus">
				</div>
			</div>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="css-control-input" name="informed_consent">
					<span class="css-control-indicator"></span> Informed Consent
				</label>
			</div>
		</div>

	</div>
</div>