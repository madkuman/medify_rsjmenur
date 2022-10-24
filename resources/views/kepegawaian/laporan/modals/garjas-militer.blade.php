<div class="modal" id="garjas-militer"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document" style="min-width: 100%; margin: 10px; min-height: 100vh;">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/garjas-militer" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Laporan Kesegaran Jasmani TNI AL</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="block-content">
							<!-- NAMA -->
							@include('kepegawaian.laporan.component-form.pegawai-militer-select2')

							<!-- KESATUAN -->
							<div class="form-group">
								<div class="form-group">
									<label>Kesatuan</label>
									<select class="form-control js-select2 kesatuan" style="width: 100%" name="kesatuan" data-placeholder="Cari Satker" required="required">
										<option id="396" selected>{{config('app.name')}}</option>
									</select>
								</div>
							</div>

							<!-- JABATAN -->
							<div class="form-group">
								<label>Jabatan</label>
								<div class="form-inline">
									<input type="text" id="jabatan" name="jabatan" class="form-control" style="width: 100%" required="required">
								</div>
							</div>
							<input type="hidden" class="umur" id="umur">
							<input type="hidden" class="gender" id="gender">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="block-content">
							<!-- KEPERLUAN -->
							<div class="form-group">
								<label>Keperluan</label>
								<div class="form-inline">
									<select class="form-control js-select2 keperluan" style="width: 100%" name="keperluan" data-placeholder="Cari Satker" required="required">
										<option value="" selected="" disabled="">Pilih Keperluan</option>
										@foreach($keperluan_garjas as $item)
										<option value="{{$item->nama}}" data-postur="{{$item->nilai_postur}}" data-garjas="{{$item->nilai_garjas}}" data-renang="{{$item->nilai_renang}}" data-akhir="{{$item->nilai_akhir}}" data-nama="{{$item->nama}}">{{$item->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<!-- PERIODE -->
							@include('kepegawaian.laporan.component-form.bulan-tahun-combodate')

							<!-- SAMAPTA -->
							<div class="form-group">
								<label>Tanggal Samapta</label>
								<div class="form-inline">
									<input type="text" class="js-datepicker form-control" id="example-datepicker1" name="samapta" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy" required="required">
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr><br>
				<div class="row">
					<div class="col-lg-4">
						<div class="block-content">
							
							<h5><b><u>NILAI KESEGARAN JASMANI</u></b></h5>
							<h6>I. NILAI BATTERY - A</h6>
							<div class="form-group row">
								<label class="col-12">Lari 12 Menit</label>
								<div class="col-4">
									<input type="text" id="lari" name="lari" class="form-control input_nilai" required="required">
								</div>
								<div class="col-4">
									<input type="text" id="nilai_lari" class="form-control nilai_lari" disabled>
									<input type="hidden" name="lari2" class="nilai_lari">
								</div>
							</div>

							<h6>II. NILAI BATTERY - B</h6>
							<div class="form-group row">
								<label class="col-12">Pull Up</label>
								<div class="col-4">
									<input type="text" id="pullup" name="pullup" class="form-control input_nilai" required="required">
								</div>
								<div class="col-4">
									<input type="text" id="nilai_pullup" class="form-control nilai_pullup" disabled>
									<input type="hidden" name="pullup2" class="nilai_pullup">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12">Sit Up</label>
								<div class="col-4">
									<input type="text" id="situp" name="situp" class="form-control input_nilai" required="required">
								</div>
								<div class="col-4">
									<input type="text" id="nilai_situp" name="situp2" class="form-control nilai_situp" disabled>
									<input type="hidden" name="situp2" class="nilai_situp">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12">Push Up</label>
								<div class="col-4">
									<input type="text" id="pushup" name="pushup" class="form-control input_nilai" required="required">
								</div>
								<div class="col-4">
									<input type="text" id="nilai_pushup" name="pushup2" class="form-control nilai_pushup" disabled>
									<input type="hidden" class="nilai_pushup" name="pushup2">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12">Shuttle Run</label>
								<div class="col-4">
									<input type="text" id="shuttle" name="shuttle" class="form-control input_nilai" required="required">
								</div>
								<div class="col-4">
									<input type="text" id="nilai_shuttle" name="shuttle2" class="form-control nilai_shuttle" disabled>
									<input type="hidden" name="shuttle2" class="nilai_shuttle">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12"><b>NILAI BATTERY - B</b></label>
								<div class="col-4">
									<input type="text" id="nilai_b" name="nilai-battery-b" class="form-control nilai_b" disabled>
									<input type="hidden" name="nilai-battery-b" class="nilai_b">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12"><b>NILAI GARJAS (AB)</b></label>
								<div class="col-4">
									<input type="text" id="nilai_mean" name="nilai-garjas-ab" class="form-control nilai_mean" disabled>
									<input type="hidden" name="nilai-garjas-ab" class="nilai_mean">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12"><b>KATEGORI GARJAS</b></label>
								<div class="col-4">
									<input type="text" id="kategori_garjas" name="kategori-garjas" class="form-control kategori_garjas" disabled>
									<input type="hidden" name="kategori-garjas" class="kategori_garjas">
								</div>
							</div>

						</div>
					</div>
					<div class="col-lg-4">
						<div class="block-content">
							<h5><b><u>NILAI POSTUR</u></b></h5>

							<div class="form-group row">
								<label class="col-12">Tinggi Badan (cm)</label>
								<div class="col-4">
									<input type="text" id="tinggi" name="tinggi" class="form-control" required="required">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12">Berat Badan (kg)</label>
								<div class="col-4">
									<input type="text" id="berat" name="berat" class="form-control" required="required">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12">Klasifikasi Berat Badan</label>
								<div class="col-4">
									<input type="text" id="klasifikasi_bb" name="klasifikasi_bb" class="form-control klasifikasi_bb" disabled>
									<input type="hidden" name="klasifikasi_bb" class="klasifikasi_bb">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12"><b>Nilai Postur</b></label>
								<div class="col-4">
									<input type="text" id="nilai_postur" name="nilai-postur" class="form-control nilai_postur" disabled>
									<input type="hidden" name="nilai-postur" class="nilai_postur">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12"><b>Kategori Postur</b></label>
								<div class="col-4">
									<input type="text" id="kategori_postur" name="kategori-postur" class="form-control kategori_postur" disabled>
									<input type="hidden" name="kategori-postur" class="kategori_postur">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4" id="berenang">
						<div class="block-content">
							<h5><b><u>NILAI RENANG</u></b></h5>

							<div class="form-group row">
								<label class="col-12">Gaya Renang</label>
								<div class="col-5">
									<select class="form-control js-select2" style="width: 100%" name="gaya_renang" id="gaya_renang" onchange="getNilaiRenang(this)" required="required">		
										<option value="" selected="" disabled="">Pilih Gaya</option>
										<option value="1">Gaya Bebas</option>
										<option value="2">Gaya Dada</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12">Waktu (menit)</label>
								<div class="col-4">
									<input type="number" id="waktu_renang" name="waktu" class="form-control">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12"><b>Nilai Renang</b></label>
								<div class="col-4">
									<input type="text" id="nilai_renang" name="nilai-renang" class="form-control nilai_renang" disabled>
									<input type="hidden" name="nilai-renang" class="nilai_renang">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-12"><b>Kategori Renang</b></label>
								<div class="col-4">
									<input type="text" id="kategori_renang" name="kategori-renang" class="form-control kategori_renang" disabled>
									<input type="hidden" name="kategori-renang" class="kategori_renang">
								</div>
							</div>
						</div>
					</div>	
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-4">
						<div class="block-content">
							<h5><b><u>NILAI AKHIR</u></b></h5>
							<div class="form-group">
								<div class="row">
									<div class="col-12">
										<input type="text" id="nilai_akhir" name="akhir" class="form-control nilai_akhir" disabled>
										<input type="hidden" name="akhir" class="nilai_akhir">
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-12">
										<input type="text" id="kategori_akhir" name="akhir2" class="form-control kategori_akhir" disabled>
										<input type="hidden" name="akhir2" class="kategori_akhir">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 kelulusan" style="padding-right: 0px; display:none;">
						<div class="block-content" style="padding-right: 0px;">
							<div id="kelulusan" style="font-size: 40px; font-weight: bold; padding-top: 50px;"></div>
						</div>
					</div>
					<div class="col-lg-4" style="padding-left: 0px;">
						<div class="block-content" style="padding-left: 0px; padding-top: 60px;">
							@include('kepegawaian.laporan.component-form.tanda-tangan-select2')	
						</div>
					</div>	
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary  submit-button">
						<i class="fa fa-print"></i> Cetak
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
</div>