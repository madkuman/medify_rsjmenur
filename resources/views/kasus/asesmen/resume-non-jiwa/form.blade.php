<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<label>Diagnosa Masuk</label>
						<textarea class="form-control form-control-lg" id="diagnosa_masuk" name="diagnosa_masuk" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Diagnosa Utama</label>
						<textarea class="form-control form-control-lg" id="diagnosa_utama" name="diagnosa_utama" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Diagnosa Tambahan</label>
						<textarea class="form-control form-control-lg" id="diagnosa_tambahan" name="diagnosa_tambahan" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Jenis Tindakan</label>
						<textarea class="form-control form-control-lg" id="jenis_tindakan" name="jenis_tindakan" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Alasan Dirawat</label>
						<textarea class="form-control form-control-lg" id="alasan_rawat" name="alasan_rawat" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Ringkasan Penyakit</label>
						<textarea class="form-control form-control-lg" id="ringkasan" name="ringkasan" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Pemeriksaan Fisik</label>
						<textarea class="form-control form-control-lg" id="pemeriksaan_fisik" name="pemeriksaan_fisik" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Lab</label>
						<textarea class="form-control form-control-lg" id="lab" name="lab" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Terapi Pasien</label>
						<textarea class="form-control form-control-lg" id="terapi" name="terapi" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Hasil Konsul</label>
						<textarea class="form-control form-control-lg" id="hasil_konsul" name="hasil_konsul" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Perkembangan</label>
						<textarea class="form-control form-control-lg" id="perkembangan" name="perkembangan" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Keadaan Waktu Pulang</label>
						<select class="js-select2 form-control" style="width: 100%;" id="keadaan_krs" name="keadaan_krs" data-placeholder="Pilih Keadaan Waktu Pulang">
							<option></option>
							<option value="Klinis Membaik">
								Klinis Membaik
							</option>
							<option value="Belum Membaik">
								Belum Membaik
							</option>
							<option value="Meninggal">
								Meninggal
							</option>
							<option value="Sembuh Sosial">
								Sembuh Sosial
							</option>
							<option value="Selesai Rehabilitasi T&R Napza">
								Selesai Rehabilitasi T&R Napza
							</option>
						</select>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Kontrol Poli</label>
						<select class="js-select2 form-control" id="poli_id" name="poli_id" style="width: 100%;" data-placeholder="Pilih Tujuan Poli">
							<option></option>
							@foreach($poli as $item)
								<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Waktu Kontrol Ulang</label>
						<textarea class="form-control form-control-lg" id="waktu_kontrol" name="waktu_kontrol" rows="4"></textarea>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label>Instruksi / Saran tindak lanjut</label>
						<textarea class="form-control form-control-lg" id="instruksi" name="instruksi" rows="4"></textarea>
					</div>
				</div>

				<input type="hidden" id="kasus_id" name="kasus_id" value="{{$kasus->id}}">
			</div>
	</div>