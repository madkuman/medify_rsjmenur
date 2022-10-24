<div class="modal"  id="garjas-pns"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document" style="min-width: 100%; margin: 10px; min-height: 100vh;">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/garjas-pns" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Laporan Kesegaran Jasmani PNS</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="block-content">
							<!-- NAMA -->
							@include('kepegawaian.laporan.component-form.pegawai-pns-select2')

							<!-- KESATUAN -->
							<div class="form-group">
								<div class="form-group">
									<label>Kesatuan</label>
									<select class="form-control js-select2 kesatuan" style="width: 100%" name="kesatuan" data-placeholder="Cari Satker" id="kesatuan">
										<option id="396" selected>{{config('app.name')}}</option>
									</select>
								</div>
							</div>
							<input type="hidden" class="umur" id="umur">
							<input type="hidden" class="gender" id="gender">
							<!-- TINGGI -->
							<div class="form-group">
								<label>Tinggi (cm)</label>
								<div class="form-inline">
									<input type="text" name="tinggi" class="form-control">
								</div>
							</div>

							<!-- BERAT -->
							<div class="form-group">
								<label>Berat (kg)</label>
								<div class="form-inline">
									<input type="text" name="berat" class="form-control">
								</div>
							</div>
						</div>		
					</div>
					<div class="col-lg-4">
						<div class="block-content">
							<!-- WAKTU -->
							<div class="form-group">
								<label>Waktu</label>
								<div class="form-inline">
									<input id="waktu_lari_pns" type="number" name="waktu" class="form-control">
								</div>
							</div>

							<!-- SAMAPTA -->
							<div class="form-group">
								<label>Tanggal Samapta</label>
								<div class="form-inline">
									<input type="text" class="js-datepicker form-control" id="example-datepicker1" name="samapta" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="mm/dd/yy" placeholder="mm/dd/yy">
								</div>
							</div>

							<!-- NILAI -->
							<div class="form-group">
								<label>Nilai</label>
								<div class="form-inline">
									<input id="nilai_lari_pns" type="text" name="nilai" class="form-control" disabled>
								</div>
							</div>
							<input type="hidden" id="nilai_lari_pns_nilai" name="nilai">
							<input type="hidden" id="kategori_lari_pns_nilai" name="kategori">
							<input type="hidden" id="kategori_umur" name="kategori_umur">
							<!-- KEPERLUAN -->
							<!-- <div class="form-group">
								<label>Keperluan</label>
								<div class="form-inline">
									<input type="text" name="keperluan" class="form-control" style="width: 100%">
								</div>
							</div> -->

						</div>		
					</div>
					<div class="col-lg-4">
						<div class="block-content">
							<!-- KATEGORI -->
							<div class="form-group">
								<label>Kategori</label>
								<div class="form-inline">
									<input id="kategori_lari_pns" type="text" name="kategori" class="form-control" disabled>
								</div>
							</div>

							@include('kepegawaian.laporan.component-form.bulan-tahun-combodate')
							@include('kepegawaian.laporan.component-form.tanda-tangan-select2')
						</div>		
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary  submit-button">
					<i class="fa fa-print"></i> Cetak
				</button>
			</div>
		</form>
	</div>
</div>