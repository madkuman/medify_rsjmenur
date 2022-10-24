<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Mengendalikan rangsang pembuangan tinja</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mengendalikan_rangsang_pembuangan_tinja" value="Tak terkendali atau tak teratur (perlu pencahar)" data-skor="0">
					            <span class="css-control-indicator"></span> Tak terkendali atau tak teratur (perlu pencahar)
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mengendalikan_rangsang_pembuangan_tinja" value="Kadang-kadang tak terkendali (1x seminggu)" data-skor="1">
					            <span class="css-control-indicator"></span> Kadang-kadang tak terkendali (1x seminggu)
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mengendalikan_rangsang_pembuangan_tinja" value="Terkendali teratur" data-skor="2">
					            <span class="css-control-indicator"></span> Terkendali teratur
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Mengendalikan rangsang berkemih</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mengendalikan_rangsang_berkemih" value="Tak terkendali / pakai kateter" data-skor="0">
					            <span class="css-control-indicator"></span> Tak terkendali / pakai kateter
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mengendalikan_rangsang_berkemih" value="Kadang-kadang tak terkendali (hanya 1x/24 jam)" data-skor="1">
					            <span class="css-control-indicator"></span> Kadang-kadang tak terkendali (hanya 1x/24 jam)
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mengendalikan_rangsang_berkemih" value="Mandiri" data-skor="2">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Membersihkan diri (Seka muka,sisir rambut,sikat gigi)</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="membersihkan_diri" value="Butuh pertolongan orang lain" data-skor="0">
					            <span class="css-control-indicator"></span> Butuh pertolongan orang lain
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="membersihkan_diri" value="Mandiri" data-skor="1">
					            <span class="css-control-indicator"></span> Mandiri

					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Penggunaan jamban,masuk dan keluar (melepaskan, memakai celana, membersihkan, menyiram)</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="penggunaan_jamban" value="Tergantung pertolongan orang lain" data-skor="0">
					            <span class="css-control-indicator"></span> Tergantung pertolongan orang lain
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="penggunaan_jamban" value="Perlu pertolongan pada beberapa kegiatan tetapi dapat mengerjakan sendiri beberapa kegiatan lain" data-skor="1">
					            <span class="css-control-indicator"></span> Perlu pertolongan pada beberapa kegiatan tetapi dapat mengerjakan sendiri beberapa kegiatan lain
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="penggunaan_jamban" value="Mandiri" data-skor="2">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Makan</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="makan" value="Tidak mampu" data-skor="0">
					            <span class="css-control-indicator"></span> Tidak mampu
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="makan" value="Perlu ditolong memotong makanan" data-skor="1">
					            <span class="css-control-indicator"></span> Perlu ditolong memotong makanan
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="makan" value="Mandiri" data-skor="2">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Berubah sikap dari berbaring ke duduk</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berubah_sikap" value="Tidak mampu" data-skor="0">
					            <span class="css-control-indicator"></span> Tidak mampu
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berubah_sikap" value="Perlu banyak bantuan untuk bisa duduk (2 orang)" data-skor="1">
					            <span class="css-control-indicator"></span> Perlu banyak bantuan untuk bisa duduk (2 orang)
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berubah_sikap" value="Bantuan minimal satu orang" data-skor="2">
					            <span class="css-control-indicator"></span> Bantuan minimal satu orang
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berubah_sikap" value="Mandiri" data-skor="3">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Berpindah atau berjalan</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berpindah_atau_berjalan" value="Tidak mampu" data-skor="0">
					            <span class="css-control-indicator"></span> Tidak mampu
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berpindah_atau_berjalan" value="Bisa pindah dengan kursi roda" data-skor="1">
					            <span class="css-control-indicator"></span> Bisa pindah dengan kursi roda
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berpindah_atau_berjalan" value="Berjalan dengan bantuan 1 orang" data-skor="2">
					            <span class="css-control-indicator"></span> Berjalan dengan bantuan 1 orang
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="berpindah_atau_berjalan" value="Mandiri" data-skor="3">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Memakai baju</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="memakai_baju" value="Tergantung orang lain" data-skor="0">
					            <span class="css-control-indicator"></span> Tergantung orang lain
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="memakai_baju" value="Sebagian dibantu (misalnya mengancing baju)" data-skor="1">
					            <span class="css-control-indicator"></span> Sebagian dibantu (misalnya mengancing baju)
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="memakai_baju" value="Mandiri" data-skor="2">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Naik turun tangga</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="naik_turun_tangga" value="Tidak mampu" data-skor="0">
					            <span class="css-control-indicator"></span> Tidak mampu
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="naik_turun_tangga" value="Butuh pertolongan" data-skor="1">
					            <span class="css-control-indicator"></span> Butuh pertolongan
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="naik_turun_tangga" value="Mandiri" data-skor="2">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>

			<div class="col-12">
				<h5 class="pt-15">Mandi</h5>
			</div>

			<div class="col-12 skoring">
				<div class="row">
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mandi" value="Tergantung orang lain" data-skor="0">
					            <span class="css-control-indicator"></span> Tergantung orang lain
					        </label>
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group mb-5">
					        <label class="css-control css-control-primary css-radio">
					            <input type="radio" class="css-control-input" name="mandi" value="Mandiri" data-skor="1">
					            <span class="css-control-indicator"></span> Mandiri
					        </label>
					    </div>
					</div>
				</div>

				<input type="hidden" name="skor[]">
			</div>
	    </div>
	</div>