<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
		<div class="modal-content">
			<form method="POST" action="{{url()->current()}}/create">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header">
						<h3 class="block-title">Asesmen Ceklis Keselamatan Pasien Pembedahan</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<input type="hidden" name="id" value="0" class="id" id="id">
					<input type="hidden" name="jenis" value="Hemodialisis">
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
						{{csrf_field()}}
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Sign In</h5>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_identitas_dan_gelang_pasien">
										<span class="css-control-indicator"></span> Konfirmasi identitas dan gelang pasien
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_lokasi_pasien">
										<span class="css-control-indicator"></span> Konfirmasi lokasi pasien
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_prosedur_operasi">
										<span class="css-control-indicator"></span> Konfirmasi prosedur operasi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_persetujuan_operasi">
										<span class="css-control-indicator"></span> Konfirmasi persetujuan operasi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="lokasi_operasi_sudah_diberi_tanda">
										<span class="css-control-indicator"></span> Lokasi operasi sudah diberi tanda
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="lokasi_operasi_tidak_dapat_dilakukan">
										<span class="css-control-indicator"></span> Lokasi operasi tidak dapat dilakukan
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="mesin_dan_obat_anestesi_sudah_dicek">
										<span class="css-control-indicator"></span> Mesin dan obat anestesi sudah dicek
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="pulse_oximeter_sudah_dicek_dan_berfungsi">
										<span class="css-control-indicator"></span> Pulse oximeter sudah dicek dan berfungsi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="pasien_mempunyai_riwayat_alergi">
										<span class="css-control-indicator"></span> Pasien mempunyai riwayat alergi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="kesulitan_nafas_atau_resiko_aspirasi">
										<span class="css-control-indicator"></span> Kesulitan nafas atau resiko aspirasi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="resiko_kehilangan_darah_lebih_dari_500ml">
										<span class="css-control-indicator"></span> Resiko kehilangan darah lebih dari 500ml
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="dua_akses_intravena_akses_sentral_dan_rencana_terapi_cairan">
										<span class="css-control-indicator"></span> Dua akses intravena akses sentral dan rencana terapi cairan
									</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Time Out</h5>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="sebutkan_nama_dan_peran_masing_masing_anggota_tim">
										<span class="css-control-indicator"></span> Sebutkan nama dan peran masing masing anggota tim
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_nama_pasien">
										<span class="css-control-indicator"></span> Konfirmasi nama pasien
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_prosedur">
										<span class="css-control-indicator"></span> Konfirmasi prosedur
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_lokasi_insisi">
										<span class="css-control-indicator"></span> Konfirmasi lokasi insisi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_fiksasi_pasien">
										<span class="css-control-indicator"></span> Konfirmasi fiksasi pasien
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="profilaksis_antibiotik_sudah_diberikan_30_menit_sebelum">
										<span class="css-control-indicator"></span> Profilaksis antibiotik sudah diberikan 30 menit sebelum
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="kemungkinan_timbul_kesulitan_dalam_operasi">
										<span class="css-control-indicator"></span> Kemungkinan timbul kesulitan dalam operasi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="masalah_khusus_pada_pasien_dan_langkah_antisipasi">
										<span class="css-control-indicator"></span> Masalah khusus pada pasien dan langkah antisipasi
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="cek_alat_steril">
										<span class="css-control-indicator"></span> Cek alat steril
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="kesediaan_alat_khusus">
										<span class="css-control-indicator"></span> Kesediaan alat khusus
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="hasil_mri_ct_scan_foto_rontgen_terpasang">
										<span class="css-control-indicator"></span> Hasil MRI CT Scan Foto Rontgen terpasang
									</label>
								</div>
							</div>
							<div class="col-12 full-only mt-20"></div>
							<div class="col-md-4">
								<div class="form-group row mb-5">
									<label class="col-12">Profilaksis diberikan oleh</label>
									<div class="col-12">
										<input type="text" class="form-control" name="profilaksis_diberikan_oleh">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group row mb-5">
									<label class="col-12">Estimasi lama operasi dalam jam</label>
									<div class="col-12">
										<input type="text" class="form-control" name="estimasi_lama_operasi_dalam_jam">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group row mb-5">
									<label class="col-12">Perkiraan kehilangan darah dalam cc</label>
									<div class="col-12">
										<input type="text" class="form-control" name="perkiraan_kehilangan_darah_dalam_cc">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group row mb-5">
									<label class="col-12">Sirculation Nurs</label>
									<div class="col-12">
										<input type="text" class="form-control" name="sirculation_nurs">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mr-0">
							<div class="col-12">
								<h5 class="mb-5 mt-10">Sign Out</h5>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="konfirmasi_secara_verbal_tentang_nama_prosedur_tindakan">
										<span class="css-control-indicator"></span> Konfirmasi secara verbal tentang nama prosedur tindakan
									</label>
								</div>
							</div>
							<div class="col-12 full-only mt-20"></div>
							<div class="col-12">
								<h6 class="mb-5 mt-10">Jumlah Item Sesuai</h6>
							</div>
							<div class="col-md-2"><u><b></b></u></div>
							<div class="col-md-2"><u><b>Pra</b></u></div>
							<div class="col-md-2"><u><b>Intra</b></u></div>
							<div class="col-md-2"><u><b>Tambahan</b></u></div>
							<div class="col-md-2"><u><b>Pasca</b></u></div>
							<div class="col-md-2"><u><b>Keterangan</b></u></div>
							<div class="col-md-2">Instrumen</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="instrumen_pra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="instrumen_intra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="instrumen_tambahan">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="instrumen_pasca">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="instrumen_keterangan">
									</div>
								</div>
							</div>
							<div class="col-md-2">Kassa</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="kassa_pra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="kassa_intra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="kassa_tambahan">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="kassa_pasca">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="kassa_keterangan">
									</div>
								</div>
							</div>
							<div class="col-md-2">Lapspong</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="lapspong_pra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="lapspong_intra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="lapspong_tambahan">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="lapspong_pasca">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="lapspong_keterangan">
									</div>
								</div>
							</div>
							<div class="col-md-2">Depers</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="depers_pra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="depers_intra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="depers_tambahan">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="depers_pasca">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="depers_keterangan">
									</div>
								</div>
							</div>
							<div class="col-md-2">Jarum</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="jarum_pra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="jarum_intra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="jarum_tambahan">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="jarum_pasca">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="jarum_keterangan">
									</div>
								</div>
							</div>
							<div class="col-md-2">Pisau</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="pisau_pra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="pisau_intra">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="pisau_tambahan">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="pisau_pasca">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group row mb-5">
									<div class="col-12">
										<input type="text" class="form-control" name="pisau_keterangan">
									</div>
								</div>
							</div>
							<div class="col-12 full-only mt-20"></div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="spesimen_telah_diberikan_label">
										<span class="css-control-indicator"></span> Spesimen telah diberikan label
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group mb-5">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" value="1" class="css-control-input" name="terdapat_masalah_dengan_peralatan_selama_operasi">
										<span class="css-control-indicator"></span> Terdapat masalah dengan peralatan selama operasi
									</label>
								</div>
							</div>
							<div class="col-12 full-only"></div>
							<div class="col-md-6">
								<div class="form-group mb-5">
									<label>Pesan Khusus Oleh Ahli Bedah, Ahli Anestesi, dan Perawat Bedan untuk Perawat RR</label>
									<textarea class="form-control" name="pesan_khusus"></textarea>
								</div>
							</div>
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