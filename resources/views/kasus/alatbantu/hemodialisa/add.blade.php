<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
		<div class="modal-content">
			<form method="POST" action="{{url()->current()}}/create">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header">
						<h3 class="block-title">Asesmen Unit Hemodialisis</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<input type="hidden" name="id" value="" class="id-asesmen">
					<input type="hidden" name="jenis" value="Hemodialisis">
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
						{{csrf_field()}}
						<div class="row">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Diagnosis Penyakit Ginjal</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Etiologi</label>
									<div class="col-12">
										<input type="text" class="form-control" name="etiologi">
									</div>
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Penyulit</label>
									<div class="col-12">
										<input type="text" class="form-control" name="penyulit">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Tekanan Darah (Pre Kemoterapi)</label>
									<div class="col-12">
										<input type="text" class="form-control" name="kemo_td_pre">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Penyakit Penyerta</label>
									<div class="col-12">
										<input type="text" class="form-control" name="penyakit_penyerta">
									</div>
								</div>
							</div>
							<div class="col-12"><hr></div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group row mb-5">
									<label class="col-12">Anemnesis</label>
									<div class="col-12">
										<textarea class="form-control" name="anamnesis"></textarea>
									</div>
								</div>  
							</div>
							<div class="col-12"><hr></div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group row mb-5">
									<label class="col-12">Pemeriksaan Fisik</label>
									<div class="col-12">
										<textarea class="form-control" name="pemeriksaan_fisik"></textarea>
									</div>
								</div>  
							</div>
							<div class="col-12"><hr></div>
						</div>
						<div class="row">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Laboratorium Penunjang</h5>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">HBs Ag</label>
									<div class="col-12">
										<input type="text" class="form-control" name="hbs_ag">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Anti HCV</label>
									<div class="col-12">
										<input type="text" class="form-control" name="anti_hcv">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Anti HIV</label>
									<div class="col-12">
										<input type="text" class="form-control" name="anti_hiv">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Hemoglobin</label>
									<div class="col-12">
										<input type="text" class="form-control" name="hemoglobin">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Ureum</label>
									<div class="col-12">
										<input type="text" class="form-control" name="ureum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Kreatinin</label>
									<div class="col-12">
										<input type="text" class="form-control" name="kreatinin">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Asam Urat</label>
									<div class="col-12">
										<input type="text" class="form-control" name="asam_urat">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Kalium</label>
									<div class="col-12">
										<input type="text" class="form-control" name="kalium">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Natrium</label>
									<div class="col-12">
										<input type="text" class="form-control" name="natrium">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Kalsium</label>
									<div class="col-12">
										<input type="text" class="form-control" name="kalsium">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Posfor Anorganik</label>
									<div class="col-12">
										<input type="text" class="form-control" name="posfor_anorganik">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Gula Darah</label>
									<div class="col-12">
										<input type="text" class="form-control" name="gula_darah">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Fe Serum</label>
									<div class="col-12">
										<input type="text" class="form-control" name="fe_serum">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">TIBC</label>
									<div class="col-12">
										<input type="text" class="form-control" name="tibc">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Sat Transferin</label>
									<div class="col-12">
										<input type="text" class="form-control" name="sat_transferin">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Lain-lain</label>
									<div class="col-12">
										<input type="text" class="form-control" name="penunjang_lain2">
									</div>
								</div>
							</div>
							<div class="col-12"><hr></div>
						</div>
						<div class="row">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Resep Hemodialisis Kronik</h5>
							</div>
							<div class="col-12">
								<h6 class="mb-5 mt-10">Mohon dijadwalkan untuk</h6>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="dijadwalkan" class="css-control-input" name="hd_akut">
										<span class="css-control-indicator"></span> HD Akut
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="dijadwalkan" class="css-control-input" name="hd_pre_op">
										<span class="css-control-indicator"></span> HD Pre Op
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="dijadwalkan" class="css-control-input" name="pd_akut">
										<span class="css-control-indicator"></span> PD Akut
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="dijadwalkan" class="css-control-input" name="capd">
										<span class="css-control-indicator"></span> CAPD
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="dijadwalkan" class="css-control-input" name="hd_rutin">
										<span class="css-control-indicator"></span> HD Rutin
									</label>
								</div>
							</div>
							<div class="col-12 full-only"></div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Jenis Dialisat</label>
									<div class="col-12">
										<select class="form-control" name="jenis_dialisat">
											<option value="Asetat">Asetat</option>
											<option value="Bikarbonat">Bikarbonat</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Akses Sirkulasi</label>
									<div class="col-12">
										<select class="form-control" name="akses_sirkulasi">
											<option value="Femoral">Femoral</option>
											<option value="Cimino">Cimino</option>
											<option value="Double Lumen Catether">Double Lumen Catether</option>
											<option value="Subclavia">Subclavia</option>
											<option value="Jugular">Jugular</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Durasi HD</label>
									<div class="col-12">
										<input type="text" class="form-control" name="durasi_hd">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">UF Goal</label>
									<div class="col-12">
										<input type="text" class="form-control" name="uf_goal">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Kecepatan Aliran Darah</label>
									<div class="col-12">
										<input type="text" class="form-control" name="kecepatan_aliran_darah">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Kecepatan Aliran Dialisat</label>
									<div class="col-12">
										<input type="text" class="form-control" name="keccepatan_aliran_dialisat">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Heparinisasi Kontinua</label>
									<div class="col-12">
										<input type="text" class="form-control" name="heparinisasi_kontinua">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Heparinisasi Intermiten</label>
									<div class="col-12">
										<input type="text" class="form-control" name="heparinisasi_intermiten">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Heparinisasi LMWH</label>
									<div class="col-12">
										<input type="text" class="form-control" name="heparinisasi_lmwh">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Program Profiling UF</label>
									<div class="col-12">
										<input type="text" class="form-control" name="program_profiling_uf">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group row mb-5">
									<label class="col-12">Program Profiling Na</label>
									<div class="col-12">
										<input type="text" class="form-control" name="program_profiling_na">
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
							<div class="col-12"><hr></div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group row mb-5">
									<label class="col-12">Terapi</label>
									<div class="col-12">
										<textarea class="form-control" name="terapi"></textarea>
									</div>
								</div>  
							</div>
							<div class="col-12"><hr></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>