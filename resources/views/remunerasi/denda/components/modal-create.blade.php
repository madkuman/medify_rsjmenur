<div class="modal fade" id="modal-create-denda" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/create" id="modal-form">
				<div class="block block-themed block-transparent mb-0">
				    <div class="block-header">
				        <h3 class="block-title" id="title-modal"></h3>
				        <div class="block-options">
				            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
				                <i class="si si-close"></i>
				            </button>
				        </div>
				    </div>
                    
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
						<input type="hidden" name="id" id="id" value="">
	                    <div class="row">
							<div class="col-6 for-create d-none">
								<label for="example-datepicker1">Tanggal Berlaku Denda</label>
								<div class="form-inline">
									<input type="text" id="date-modal" data-format="DD-MM-YYYY" data-template="MMMM YYYY" name="bulan_tahun" class="combodate" value="{{date('d-m-Y')}}">
									<small class="text-danger hide" id="error_main_tanggal">Tidak Boleh Kosong</small>
								</div>
							</div>
							<div class="col-6 for-edit d-none">
								<label for="example-datepicker1">Bulan Berlaku Denda</label> : <h5><span id="bulan"></span></h5>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-3" id="input-pihak3-container">
								<label>Tidak Masuk Dengan Keterangan</label>
								<input type="text" class="form-control" id="absen-ket" name="absen_ket" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3" id="input-pasien-container">
								<label>Tidak Masuk Tanpa Keterangan</label>
								<input type="text" class="form-control" id="absen" name="absen" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3" id="input-pasien-pembayaran-container">
								<label>Lupa Absen Masuk</label>
								<input type="text" class="form-control" id="lupa-absen-masuk" name="lupa_absen_masuk" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3">
								<label>Lupa Absen Pulang</label>
								<input type="text" class="form-control" id="lupa-absen-pulang" name="lupa_absen_pulang" placeholder="Masukkan Jumlah">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-3" id="input-judul-container">
								<label>Telat < 30</label>
								<input type="text" class="form-control" id="telat-satu" name="telat_satu" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3" id="input-pasien-pembayaran-container">
								<label>Telat 31 - 60 Menit</label>
								<input type="text" class="form-control" id="telat-dua" name="telat_dua" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3">
								<label>Telat 61 - 90 Menit</label>
								<input type="text" class="form-control" id="telat-tiga" name="telat_tiga" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3" id="input-pihak3-container">
								<label>Telat 90 > </label>
								<input type="text" class="form-control" id="telat-empat" name="telat_empat" placeholder="Masukkan Jumlah">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-3" id="input-judul-container">
								<label>Pulang < 30</label>
								<input type="text" class="form-control" id="pulang-satu" name="pulang_satu" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3" id="input-pasien-pembayaran-container">
								<label>Pulang 31 - 60 Menit</label>
								<input type="text" class="form-control" id="pulang-dua" name="pulang_dua" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3">
								<label>Pulang 61 - 90 Menit</label>
								<input type="text" class="form-control" id="pulang-tiga" name="pulang_tiga" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3" id="input-pihak3-container">
								<label>Pulang 90 > </label>
								<input type="text" class="form-control" id="pulang-empat" name="pulang_empat" placeholder="Masukkan Jumlah">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-3" id="input-judul-container">
								<label>Tidak Senam</label>
								<input type="text" class="form-control" id="tidak-senam" name="tidak_senam" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-3" id="input-pasien-pembayaran-container">
								<label>Telat Senam</label>
								<input type="text" class="form-control" id="telat-senam" name="telat_senam" placeholder="Masukkan Jumlah">
							</div>
							<div class="col-12">
								<hr>
							</div>
						</div>
                    </div>
				</div><br>
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