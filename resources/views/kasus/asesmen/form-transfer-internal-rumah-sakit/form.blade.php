<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">
		<div class="form-group col-md-3 col-sm-12">
			<label>Tanggal transfer</label>
			<input type="text" class="form-control js-datepicker" name="tanggal_transfer" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Alergi obat</label>
			<input type="text" class="form-control" name="alergi_obat" >
		</div>
		<hr class="col-11">
		<div class="col-12 row mx-0">
			<div class="col-md-6 row mx-0">
				<div class="col-12">
					<h4>Pemeriksaan di Ruangan Asal</h4>
				</div>
				<div class="form-group col-sm-9">
					<label>Ruangan Asal</label>
					<input type="text" class="form-control" name="ruangan_asal" >
				</div>
				<div class="form-group col-sm-9">
					<label>Nama perawat pengirim</label>
					<input type="text" class="form-control" name="nama_perawat_pengirim" >
				</div>
				<div class="form-group col-sm-9">
					<label>Jam berangkat dari ruangan</label>
					<input type="text" class="form-control time" name="jam_berangkat_dari_ruangan" autocomplete="off">
				</div>
				<div class="form-group col-sm-9">
					<label>Tekanan darah</label>
					<input type="text" class="form-control" name="tekanan_darah_1" >
				</div>
				<div class="form-group col-sm-9">
					<label>Nadi</label>
					<input type="text" class="form-control" name="nadi_1" >
				</div>
				<div class="form-group col-sm-9">
					<label>Suhu (°C)</label>
					<input type="text" class="form-control" name="suhu_1" >
				</div>
				<div class="form-group col-sm-9">
					<label>Respirasi</label>
					<input type="text" class="form-control" name="respirasi_1" >
				</div>
				<div class="form-group col-sm-9">
					<label>GCS : E</label>
					<input type="text" class="form-control" name="gcs_e_1" >
				</div>
				<div class="form-group col-sm-9">
					<label>GCS : V</label>
					<input type="text" class="form-control" name="gcs_v_1" >
				</div>
				<div class="form-group col-sm-9">
					<label>GCS : M</label>
					<input type="text" class="form-control" name="gcs_m_1" >
				</div>
				<div class="col-12 full-only">
					&nbsp;
				</div>
				<div class="col-md-4 col-12">
					<h6 class="">Gelisah</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="gelisah_1" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="gelisah_1" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Agresif</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="agresif_1" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="agresif_1" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Fiksasi</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="fiksasi_1" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="fiksasi_1" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Korban pasung</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="korban_pasung_1" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="korban_pasung_1" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Indikasi bunuh diri</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_bunuh_diri_1" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_bunuh_diri_1" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Indikasi jatuh</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_jatuh_1" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_jatuh_1" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only">
					&nbsp;
				</div>
				<div class="col-12">
					<h5 class="mb-5">Skala nyeri</h5>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_1" value="Tidak Nyeri">
							<img src="{{asset('assets/img/nyeri/face(1).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Tidak Nyeri
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_1" value="Nyeri Ringan">
							<img src="{{asset('assets/img/nyeri/face(2).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Ringan
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_1" value="Nyeri Mengganggu">
							<img src="{{asset('assets/img/nyeri/face(3).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Mengganggu
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_1" value="Nyeri Menyusahkan">
							<img src="{{asset('assets/img/nyeri/face(4).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Menyusahkan
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_1" value="Nyeri Hebat">
							<img src="{{asset('assets/img/nyeri/face(5).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Hebat
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_1" value="Nyeri Sangat Hebat">
							<img src="{{asset('assets/img/nyeri/face(6).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Sangat Hebat
						</label>
					</div>
				</div>	
			</div>
			<div class="col-md-6 row mx-0 d-none" style="border-left: 1px solid gainsboro">
				<div class="col-12">
					<h4>Pemeriksaan di Ruangan Tujuan</h4>
				</div>
				<div class="form-group col-sm-9">
					<label>Ruangan Tujuan</label>
					<input type="text" class="form-control" name="ruangan_tujuan" >
				</div>
				<div class="form-group col-sm-9">
					<label>Nama perawat penerima</label>
					<input type="text" class="form-control" name="nama_perawat_penerima" >
				</div>
				<div class="form-group col-sm-9">
					<label>Jam tiba di ruangan</label>
					<input type="text" class="form-control time" name="jam_tiba_di_ruangan" autocomplete="off">
				</div>
				<div class="form-group col-sm-9">
					<label>Tekanan darah</label>
					<input type="text" class="form-control" name="tekanan_darah_2" >
				</div>
				<div class="form-group col-sm-9">
					<label>Nadi</label>
					<input type="text" class="form-control" name="nadi_2" >
				</div>
				<div class="form-group col-sm-9">
					<label>Suhu (°C)</label>
					<input type="text" class="form-control" name="suhu_2" >
				</div>
				<div class="form-group col-sm-9">
					<label>Respirasi</label>
					<input type="text" class="form-control" name="respirasi_2" >
				</div>
				<div class="form-group col-sm-9">
					<label>GCS : E</label>
					<input type="text" class="form-control" name="gcs_e_2" >
				</div>
				<div class="form-group col-sm-9">
					<label>GCS : V</label>
					<input type="text" class="form-control" name="gcs_v_2" >
				</div>
				<div class="form-group col-sm-9">
					<label>GCS : M</label>
					<input type="text" class="form-control" name="gcs_m_2" >
				</div>
				<div class="col-12 full-only">
					&nbsp;
				</div>
				<div class="col-md-4 col-12">
					<h6 class="">Gelisah</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="gelisah_2" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="gelisah_2" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Agresif</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="agresif_2" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="agresif_2" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Fiksasi</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="fiksasi_2" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="fiksasi_2" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Korban pasung</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="korban_pasung_2" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="korban_pasung_2" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Indikasi bunuh diri</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_bunuh_diri_2" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_bunuh_diri_2" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only"></div>
				<div class="col-md-4 col-12">
					<h6 class="">Indikasi jatuh</h6>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_jatuh_2" value="Ya">
							<span class="css-control-indicator"></span> Ya
						</label>
					</div>
				</div>
				<div class="col-md-2 col-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="indikasi_jatuh_2" value="Tidak">
							<span class="css-control-indicator"></span> Tidak
						</label>
					</div>
				</div>
				<div class="col-12 full-only">
					&nbsp;
				</div>
				<div class="col-12">
					<h5 class="mb-5">Skala nyeri</h5>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_2" value="Tidak Nyeri">
							<img src="{{asset('assets/img/nyeri/face(1).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Tidak Nyeri
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Ringan">
							<img src="{{asset('assets/img/nyeri/face(2).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Ringan
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Mengganggu">
							<img src="{{asset('assets/img/nyeri/face(3).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Mengganggu
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Menyusahkan">
							<img src="{{asset('assets/img/nyeri/face(4).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Menyusahkan
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Hebat">
							<img src="{{asset('assets/img/nyeri/face(5).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Hebat
						</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group mb-5">
						<label class="css-control css-control-primary css-radio">
							<input type="radio" class="css-control-input" name="skala_nyeri_2" value="Nyeri Sangat Hebat">
							<img src="{{asset('assets/img/nyeri/face(6).png')}}" class="mr-5">
							<span class="css-control-indicator"></span> Nyeri Sangat Hebat
						</label>
					</div>
				</div>	
			</div>
		</div>
		<hr class="col-11">
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h4 class="pt-15">Pemeriksaan Fisik</h4>
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-md-7 col-sm-12">
			<label>Keterangan Khusus</label>
			<textarea class="form-control" name="keterangan_khusus" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12">
			<h4 class="pt-15">Pemeriksaan Penunjang</h4>
		</div>
		<div class="col-12">
			<h5 class="pt-15">Pemeriksaan</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_radiologi">
					<span class="css-control-indicator"></span> Radiologi
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_laborat">
					<span class="css-control-indicator"></span> Laborat
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_ekg">
					<span class="css-control-indicator"></span> EKG
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_eeg_bm">
					<span class="css-control-indicator"></span> EEG BM
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15">Hasil pemeriksaan yang sudah keluar</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="hasil_pemeriksaan_keluar_radiologi">
					<span class="css-control-indicator"></span> Radiologi
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="hasil_pemeriksaan_keluar_laborat">
					<span class="css-control-indicator"></span> Laborat
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="hasil_pemeriksaan_keluar_ekg">
					<span class="css-control-indicator"></span> EKG
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="hasil_pemeriksaan_keluar_eeg_bm">
					<span class="css-control-indicator"></span> EEG BM
				</label>
			</div>
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Keterangan Radiologi</label>
			<input type="text" class="form-control" name="keterangan_radiologi" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Keterangan Laborat</label>
			<input type="text" class="form-control" name="keterangan_laborat" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Keterangan EKG</label>
			<input type="text" class="form-control" name="keterangan_ekg" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Keterangan EEG BM</label>
			<input type="text" class="form-control" name="keterangan_eeg" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Obat</h5>
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-md-7 col-sm-12">
			<label>Obat yang dibawa</label>
			<textarea class="form-control" name="obat_yang_dibawa" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
	</div>
</div>