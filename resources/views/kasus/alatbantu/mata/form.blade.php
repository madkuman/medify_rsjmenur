<input type="hidden" name="id" value="" class="id-asesmen">
<input type="hidden" name="jenis" value="perioperatif">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<h4 class="mb-0">KLINIK MATA</h4>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Funduskopi</h5>
		</div>
		<div class="col-12 full-only"></div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Anamnesia</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group row mb-5">
				<label class="col-12">Anamnesia</label>
				<div class="col-12">
					<textarea class="form-control" name="anamnesia"></textarea>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Kedudukan / Gerak Bola Mata</h5>
		</div>
		<div class="col-12">
			<table class="table">
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">O.D</th>
					<th class="text-center">O.S</th>
				</tr>
				<tr>
					<td>Palpebra</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="palpebra_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="palpebra_os">
						</div>
					</td>
				</tr>
				<tr>
					<td>Conjuctive</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="palpebra_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="palpebra_os">
						</div>
					</td>
				</tr>
				<tr>
					<td>Cornes</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="cornes_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="cornes_os">
						</div>
					</td>
				</tr>
				<tr>
					<td>C.O.A</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="coa_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="coa_os">
						</div>
					</td>
				</tr>
				<tr>
					<td>Iris</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="iris_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="iris_os">
						</div>
					</td>
				</tr>
				<tr>
					<td>Pupil</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="pupil_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="pupil_os">
						</div>
					</td>
				</tr>
				<tr>
					<td>Lensa</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="lensa_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="lensa_os">
						</div>
					</td>
				</tr>
				<tr>
					<td>Vitreous Humor</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="vitreous_humor_od">
						</div>
					</td>
					<td>
						<div class="col-12">
							<input type="text" class="form-control" name="vitreous_humor_os">
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-12"><hr></div>
	</div>
	<div class="row mr-0">
		<div class="col-md-4">
			<div class="col-12">
				<h5 class="mb-5 mt-10">Visus dan Refraksi</h5>
			</div>
			<div class="col-12">
				<div class="form-group row mb-5">
					<label class="col-12">O.D</label>
					<div class="col-12">
						<input type="text" class="form-control" name="visus_dan_refraksi_od">
					</div>
				</div>
				<div class="form-group row mb-5">
					<label class="col-12">O.S</label>
					<div class="col-12">
						<input type="text" class="form-control" name="visus_dan_refraksi_os">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="col-12">
				<h5 class="mb-5 mt-10">Kacamata</h5>
			</div>
			<div class="col-12">
				<div class="form-group row mb-5">
					<label class="col-12">O.D</label>
					<div class="col-12">
						<input type="text" class="form-control" name="kacamata_od">
					</div>
				</div>
				<div class="form-group row mb-5">
					<label class="col-12">O.S</label>
					<div class="col-12">
						<input type="text" class="form-control" name="kacamata_os">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="col-12">
				<h5 class="mb-5 mt-10">Streak Retinoskopi / Auto Ruf</h5>
			</div>
			<div class="col-12">
				<div class="form-group row mb-5">
					<label class="col-12">O.D</label>
					<div class="col-12">
						<input type="text" class="form-control" name="streak_retinoskopi_od">
					</div>
				</div>
				<div class="form-group row mb-5">
					<label class="col-12">O.S</label>
					<div class="col-12">
						<input type="text" class="form-control" name="streak_retinoskopi_os">
					</div>
				</div>
			</div>
		</div>
		<div class="col-12"><hr></div>
	</div>
	<div class="row mr-0">
		<div class="col-md-4">
			<div class="col-12">
				<h5 class="mb-5 mt-10">Keratometri 7 Biometri</h5>
			</div>
			<div class="col-12">
				<div class="form-group row mb-5">
					<label class="col-12">O.D</label>
					<div class="col-12">
						<input type="text" class="form-control" name="keratometri_od">
					</div>
				</div>
				<div class="form-group row mb-5">
					<label class="col-12">O.S</label>
					<div class="col-12">
						<input type="text" class="form-control" name="keratometri_os">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="col-12">
				<h5 class="mb-5 mt-10">Tonometri Schiotz</h5>
			</div>
			<div class="col-12">
				<div class="form-group row mb-5">
					<label class="col-12">O.D</label>
					<div class="col-12">
						<input type="text" class="form-control" name="tonometri_schiotz_od">
					</div>
				</div>
				<div class="form-group row mb-5">
					<label class="col-12">O.S</label>
					<div class="col-12">
						<input type="text" class="form-control" name="tonometri_schiotz_os">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
		</div>
		<div class="col-12"><hr></div>
	</div>
	<div class="row mr-0">
		<div class="col-12">
			<h5 class="mb-5 mt-10">Pemeriksaan Khusus</h5>
		</div>
		<div class="col-12">
			<div class="col-md-3">
				<div class="form-group row mb-5">
					<label class="col-12">Diagnosis</label>
					<div class="col-12">
						<input type="text" class="form-control" name="pemeriksaan_khusus_diagnosis">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group row mb-5">
					<label class="col-12">O.D</label>
					<div class="col-12">
						<input type="text" class="form-control" name="pemeriksaan_khusus_od">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group row mb-5">
					<label class="col-12">O.S</label>
					<div class="col-12">
						<input type="text" class="form-control" name="pemeriksaan_khusus_os">
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>