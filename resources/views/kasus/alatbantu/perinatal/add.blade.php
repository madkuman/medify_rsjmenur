<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Asesmen Perinatal Dasar</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							{{csrf_field()}}
							<h5>Karakteristik Ibu</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="pendidikan">Pendidikan</label>
								<div class="col-12">
									<select class="form-control" id="pendidikan" name="pendidikan">
										@foreach($pendidikan as $p)
										<option value="{{$p}}">{{$p}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gravida">Jumlah Gravida</label>
								<div class="col-12">
									<input type="text" class="form-control" id="gravida" name="gravida">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="partus">Jumlah Partus</label>
								<div class="col-12">
									<input type="text" class="form-control" id="partus" name="partus">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="abortus">Jumlah Abortus</label>
								<div class="col-12">
									<input type="text" class="form-control" id="abortus" name="abortus">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hamilterakhir">Kehamilan Terakhir</label>
								<div class="col-12">
									<select class="form-control has-lain" id="hamilterakhir" name="hamilterakhir">
										@foreach($hamilterakhir as $h)
										<option value="{{$h}}">{{$h}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="hamilterakhir_lain2" style="display: none">
								<label class="col-12" for="hamilterakhir_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hamilterakhir_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="meninggal">Usia ketika meninggal (apabila bayi meninggal)</label>
								<div class="col-12">
									<select class="form-control" name="meninggal">
										@foreach($meninggal as $m)
										<option value="{{$m}}">{{$m}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="cara_salin">Cara Persalinan Terakhir</label>
								<div class="col-12">
									<select class="form-control" id="cara_salin" name="cara_salin">
										@foreach($cara_salin as $c)
										<option value="{{$c}}">{{$c}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="umur">Umur Anak Terakhir (dalam bulan)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="umur" name="umur">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pemberian ASI <b><u>saja</u></b> sampai umur 4 bulan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="asi_4_bulan" id="asi_4_bulan1" value="Ya" checked="">
										<label class="custom-control-label" for="asi_4_bulan1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="asi_4_bulan" id="asi_4_bulan2" value="Tidak">
										<label class="custom-control-label" for="asi_4_bulan2">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lama_asi">Lama pemberian ASI (dalam bulan)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="lama_asi" name="lama_asi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hpht">HPHT</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control hpht" autocomplete="off" name="hpht" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yyyy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tp">TP</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control tp" autocomplete="off" name="tp" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yyyy" value="">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Kehamilan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="menstruasi">Hari Pertama Menstruasi</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="menstruasi" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="umur_hamil">Umur Kehamilan (dalam minggu)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="umur_hamil" name="umur_hamil">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tinggi">Tinggi Badan (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="tinggi" name="tinggi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat">Berat Badan (Kg)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="berat" name="berat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lengan_atas">Lingkar Lengan Atas (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="lengan_atas" name="lengan_atas">
								</div>
							</div>
							<div class="form-group row gutters-tiny mb-5">
								<label class="col-12" for="tekanan_darah">Tekanan darah (mmHg)</label>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" id="tekanan_darah_1" name="tekanan_darah_1">
								</div>
								<div class="col-md-1 col-2 text-center" style="font-size: 20px;">/</div>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" id="tekanan_darah_2" name="tekanan_darah_2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hemogoblia">Kadar Hemogoblia saat MRS (g%)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="hemogoblia" name="hemogoblia">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="anc_bidan">Jumlah Kujungan ANC oleh Bidan</label>
								<div class="col-12">
									<input type="text" class="form-control" id="anc_bidan" name="anc_bidan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="anc_dokter">Jumlah Kunjungan ANC oleh Dokter</label>
								<div class="col-12">
									<input type="text" class="form-control" id="anc_dokter" name="anc_dokter">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="imunisasi_tt">Imunisasi TT</label>
								<div class="col-12">
									<select class="form-control" id="imunisasi_tt" name="imunisasi_tt">
										@foreach($imunisasi_tt as $i)
										<option value="{{$i}}">{{$i}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tablet_fe">Pemberian Tablet Fe</label>
								<div class="col-12">
									<select class="form-control" id="tablet_fe" name="tablet_fe">
										@foreach($tablet_fe as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach

									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pernah dirujuk selama kehamilan</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pernah_rujuk" id="pernah_rujuk1" value="Ya">
										<label class="custom-control-label" for="pernah_rujuk1">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pernah_rujuk" id="pernah_rujuk2" value="Tidak" checked="">
										<label class="custom-control-label" for="pernah_rujuk2">Tidak</label>
									</div>
								</div>
							</div>
							<div id="pernah_rujuk_true" style="display: none">
								<div class="form-group row mb-5">
									<label class="col-12" for="umur_hamil_rujuk">Umur Kehamilan ketika dirujuk (dalam satuan minggu)</label>
									<div class="col-12">
										<input type="text" class="form-control" id="umur_hamil_rujuk" name="umur_hamil_rujuk">
									</div>
								</div>
								<div class="form-group row mb-5">
									<label class="col-12" for="dirujuk_oleh">Dirujuk Oleh</label>
									<div class="col-12">
										<select class="form-control" id="dirujuk_oleh" name="dirujuk_oleh">
											@foreach($dirujuk_oleh as $t)
											<option value="{{$t}}">{{$t}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row mb-5">
									<label class="col-12" for="pergi_rujuk">Pergi Rujuk</label>
									<div class="col-12">
										<select class="form-control has-lain" id="pergi_rujuk" name="pergi_rujuk">
											@foreach($pergi_rujuk as $t)
											<option value="{{$t}}">{{$t}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row mb-5" id="pergi_rujuk_lain2" style="display: none">
									<label class="col-12" for="pergi_rujuk_lain2">Lain-lain</label>
									<div class="col-12">
										<input type="text" class="form-control" name="pergi_rujuk_lain2">
									</div>
								</div>
								<div class="form-group row mb-5">
									<label class="col-12" for="alasan_dirujuk">Alasan Dirujuk</label>
									<div class="col-12">
										<input type="text" class="form-control" id="alasan_dirujuk" name="alasan_dirujuk">
									</div>
								</div>
							</div>
							<hr class="mt-20 mb-20">
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Persalinan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="jenis_persalinan">Jenis Persalinan</label>
								<div class="col-12">
									<select class="form-control" id="jenis_persalinan" name="jenis_persalinan">
										@foreach($jenis_persalinan as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="presentasi_janin">Presentasi janin pada persalinan</label>
								<div class="col-12">
									<select class="form-control has-lain" id="presentasi_janin" name="presentasi_janin">
										@foreach($presentasi_janin as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="presentasi_janin_lain2" style="display: none;">
								<label class="col-12" for="presentasi_janin_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="presentasi_janin_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="macam_persalinan">Macam persalinan</label>
								<div class="col-12">
									<select class="form-control has-lain" id="macam_persalinan" name="macam_persalinan">
										@foreach($macam_persalinan as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="macam_persalinan_lain2" style="display: none;">
								<label class="col-12" for="macam_persalinan_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="macam_persalinan_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="komplikasi_persalinan">Komplikasi persalinan</label>
								<div class="col-12">
									<select class="form-control has-lain" id="komplikasi_persalinan" name="komplikasi_persalinan">
										@foreach($komplikasi as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="komplikasi_persalinan_lain2" style="display: none;">
								<label class="col-12" for="komplikasi_persalinan_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="komplikasi_persalinan_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lama_persalinan_1">Lama Persalinan Kala I (jam)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="lama_persalinan_1" name="lama_persalinan_1">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lama_persalinan_2">Lama Persalinan Kala II (menit)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="lama_persalinan_2" name="lama_persalinan_2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ketuban_pecah">Lama Ketuban Pecah sampai Bayi Lahir</label>
								<div class="col-12">
									<input type="text" class="form-control" id="ketuban_pecah" name="ketuban_pecah">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penolong_persalinan">Penolong Persalinan</label>
								<div class="col-12">
									<select class="form-control has-lain" id="penolong_persalinan" name="penolong_persalinan">
										@foreach($penolong as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="penolong_persalinan_lain2" style="display: none;">
								<label class="col-12" for="penolong_persalinan_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penolong_persalinan_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_persalinan">Tempat Persalinan</label>
								<div class="col-12">
									<select class="form-control has-lain" id="tempat_persalinan" name="tempat_persalinan">
										@foreach($tempat as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="tempat_persalinan_lain2" style="display: none;">
								<label class="col-12" for="tempat_persalinan_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_persalinan_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keadaan_ibu">Keadaan Ibu Sampai Pulang</label>
								<div class="col-12">
									<select class="form-control" id="keadaan_ibu" name="keadaan_ibu">
										@foreach($keadaan_ibu as $t)
										<option value="{{$t}}">{{$t}}</option>
									@endforeach									</select>
								</div>
							</div>
							<div id="keadaan_ibu_meninggal" style="display: none">
								<div class="form-group row mb-5">
									<label class="col-12" for="penyebab_kematian_ibu">Penyebab Langsung Kematian Ibu</label>
									<div class="col-12">
										<select class="form-control has-lain" id="penyebab_kematian_ibu" name="penyebab_kematian_ibu">
											@foreach($penyebab_kematian as $t)
											<option value="{{$t}}">{{$t}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row mb-5" id="penyebab_kematian_ibu_lain2" style="display: none;">
									<label class="col-12" for="penyebab_kematian_ibu_lain2">Lain-lain</label>
									<div class="col-12">
										<input type="text" class="form-control" name="penyebab_kematian_ibu_lain2">
									</div>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Bayi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_lahir_bayi">Tanggal Kelahiran</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tgl_lahir_bayi" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat_badan_bayi">Berat Badan</label>
								<div class="col-12">
									<input type="text" class="form-control" id="berat_badan_bayi" name="berat_badan_bayi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="panjang_badan">Panjang Badan (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="panjang_badan" name="panjang_badan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lingkar_kepala">Lingkar Kepala (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="lingkar_kepala" name="lingkar_kepala">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lingkar_dada">Lingkar Dada (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="lingkar_dada" name="lingkar_dada">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lengan_atas_bayi">Lingkar Lengan Atas</label>
								<div class="col-12">
									<input type="text" class="form-control" id="lengan_atas_bayi" name="lengan_atas_bayi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jk_bayi">Jenis Kelamin</label>
								<div class="col-12">
									<select class="form-control" id="jk_bayi" name="jk_bayi">
										@foreach($jk_bayi as $t)
										<option value="{{$t}}">{{$t}}</option>
									@endforeach									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nilai_apgar_1">Nilai Apgar (1 menit)</label>
								<div class="col-12">
									<select class="form-control" id="nilai_apgar_1" name="nilai_apgar_1">
										@foreach($apgar as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nilai_apgar_5">Nilai Apgar (5 menit)</label>
								<div class="col-12">
									<select class="form-control" id="nilai_apgar_5" name="nilai_apgar_5">
										@foreach($apgar as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keadaan_bayi_lahir">Keadaan Bayi Setelah Lahir</label>
								<div class="col-12">
									<select class="form-control has-lain" id="keadaan_bayi_lahir" name="keadaan_bayi_lahir">
										@foreach($bayi_lahir as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="keadaan_bayi_lahir_lain2" style="display: none;">
								<label class="col-12" for="keadaan_bayi_lahir_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keadaan_bayi_lahir_lain2">
								</div>
							</div>
							<div class="form-group row mb-5" style="display: none;">
								<label class="col-12" for="keadaan_bayi_1_minggu">Keadaan Bayi Sampai Umur 1 Minggu</label>
								<div class="col-12">
									<select class="form-control has-lain" id="keadaan_bayi_1_minggu" name="keadaan_bayi_1_minggu">
										@foreach($bayi_1minggu as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="keadaan_bayi_1_minggu_lain2" style="display: none;">
								<label class="col-12" for="keadaan_bayi_1_minggu_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keadaan_bayi_1_minggu_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kematian_janin">Kematian Janin / Bayi</label>
								<div class="col-12">
									<select class="form-control has-lain" id="kematian_janin" name="kematian_janin">
										@foreach($kematian_janin as $t)
										<option value="{{$t}}">{{$t}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="kematian_janin_lain2" style="display: none;">
								<label class="col-12" for="kematian_janin_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kematian_janin_lain2">
								</div>
							</div>
							<div id="kematian_janin_true" style="display: none">
								<div class="form-group row mb-5">
									<label class="col-12" for="bayi_bertahan">Lamanya bayi bertahan setelah kelahiran sebelum akhirnya meninggal</label>
									<div class="col-12">
										<input type="text" class="form-control" id="bayi_bertahan" name="bayi_bertahan">
									</div>
								</div>
								<div class="form-group row mb-5">
									<label class="col-12" for="penyebab_kematian_bayi"> Penyebab Kematian Bayi</label>
									<div class="col-12">
										<select class="form-control has-lain" id="penyebab_kematian_bayi" name="penyebab_kematian_bayi">
											@foreach($penyebab_kematian_bayi as $t)
											<option value="{{$t}}">{{$t}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row mb-5" id="penyebab_kematian_bayi_lain2" style="display: none;">
									<label class="col-12" for="penyebab_kematian_bayi_lain2">Lain-lain</label>
									<div class="col-12">
										<input type="text" class="form-control" name="penyebab_kematian_bayi_lain2">
									</div>
								</div>
								<div class="form-group row mb-5">
									<label class="col-12">Keterlambatan dalam sistem Rujukan : Persetujuan dirujuk</label>
									<div class="col-12">
										<div class="custom-control custom-radio mb-5">
											<input class="custom-control-input" type="radio" name="terlambat_rujuk_persetujuan" id="terlambat_rujuk_persetujuan1" value="Ya" checked="">
											<label class="custom-control-label" for="terlambat_rujuk_persetujuan1">Ya</label>
										</div>
										<div class="custom-control custom-radio mb-5">
											<input class="custom-control-input" type="radio" name="terlambat_rujuk_persetujuan" id="terlambat_rujuk_persetujuan2" value="Tidak">
											<label class="custom-control-label" for="terlambat_rujuk_persetujuan2">Tidak</label>
										</div>
									</div>
								</div>
								<div class="form-group row mb-5">
									<label class="col-12">Keterlambatan dalam sistem Rujukan : Sampai di RS</label>
									<div class="col-12">
										<div class="custom-control custom-radio mb-5">
											<input class="custom-control-input" type="radio" name="terlambat_rujuk_sampai_rs" id="terlambat_rujuk_sampai_rs1" value="Ya" checked="">
											<label class="custom-control-label" for="terlambat_rujuk_sampai_rs1">Ya</label>
										</div>
										<div class="custom-control custom-radio mb-5">
											<input class="custom-control-input" type="radio" name="terlambat_rujuk_sampai_rs" id="terlambat_rujuk_sampai_rs2" value="Tidak">
											<label class="custom-control-label" for="terlambat_rujuk_sampai_rs2">Tidak</label>
										</div>
									</div>
								</div>
								<div class="form-group row mb-5">
									<label class="col-12">Keterlambatan dalam sistem Rujukan : Penanganan di RS</label>
									<div class="col-12">
										<div class="custom-control custom-radio mb-5">
											<input class="custom-control-input" type="radio" name="terlambat_rujuk_penanganan" id="terlambat_rujuk_penanganan1" value="Ya" checked="">
											<label class="custom-control-label" for="terlambat_rujuk_penanganan1">Ya</label>
										</div>
										<div class="custom-control custom-radio mb-5">
											<input class="custom-control-input" type="radio" name="terlambat_rujuk_penanganan" id="terlambat_rujuk_penanganan2" value="Tidak">
											<label class="custom-control-label" for="terlambat_rujuk_penanganan2">Tidak</label>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kelainan_bawaan">Jenis Kelainan bawaan yang ditemukan (tulis "-" bila tidak ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="kelainan_bawaan" name="kelainan_bawaan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="dubowitz">Nilai Dubowitz</label>
								<div class="col-12">
									<input type="text" class="form-control" id="dubowitz" name="dubowitz">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ballard">Nilai Ballard</label>
								<div class="col-12">
									<input type="text" class="form-control" id="ballard" name="ballard">
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
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>