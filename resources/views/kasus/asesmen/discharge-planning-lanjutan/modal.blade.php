
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Discharge Planning Lanjutan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" id="id">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                        	
							<div class="col-12">
								<h5 class="pt-15">Usia</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="usia" value="<= 55 tahun--0">
							            <span class="css-control-indicator"></span> <= 55 tahun (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="usia" value="56 - 64 tahun--1">
							            <span class="css-control-indicator"></span> 56 - 64 tahun (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="usia" value="65 - 79 tahun--2">
							            <span class="css-control-indicator"></span> 65 - 79 tahun (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="usia" value=">= 80 tahun--3">
							            <span class="css-control-indicator"></span> >= 80 tahun (Skor : 3)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Dukungan Sosial</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dukungan_sosial" value="Hidup dengan Pasangan--0">
							            <span class="css-control-indicator"></span> Hidup dengan Pasangan (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dukungan_sosial" value="Hidup Bersama Keluarga Serumah--1">
							            <span class="css-control-indicator"></span> Hidup Bersama Keluarga Serumah (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dukungan_sosial" value="Hidup Sendiri Dengan Dukungan Keluarga, Tidak Serumah--2">
							            <span class="css-control-indicator"></span> Hidup Sendiri Dengan Dukungan Keluarga, Tidak Serumah (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dukungan_sosial" value="Hidup sendiri dengan dukungan Teman--3">
							            <span class="css-control-indicator"></span> Hidup sendiri dengan dukungan Teman (Skor : 3)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dukungan_sosial" value="Hidup Sendiri Tanpa Dukungan--4">
							            <span class="css-control-indicator"></span> Hidup Sendiri Tanpa Dukungan (Skor : 4)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="dukungan_sosial" value="Tinggal di Rumah Jompo Tua atau Perlu Perawatan di Rumah--5">
							            <span class="css-control-indicator"></span> Tinggal di Rumah Jompo Tua atau Perlu Perawatan di Rumah (Skor : 5)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Status Fungsional</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_mandiri">
							            <span class="css-control-indicator"></span> Mandiri (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								<label>Bergantung dalam hal : </label>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_mandi">
							            <span class="css-control-indicator"></span> Mandi (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_makan">
							            <span class="css-control-indicator"></span>Makan (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_ke_kamar_mandi">
							            <span class="css-control-indicator"></span>Ke Kamar Mandi (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_mobilisasi">
							            <span class="css-control-indicator"></span>Mobilisasi (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_bab">
							            <span class="css-control-indicator"></span>BAB (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_bak">
							            <span class="css-control-indicator"></span>BAK (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_pengobatan">
							            <span class="css-control-indicator"></span>Bertanggung Jawab Atas Pengobatannya (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung__makanan">
							            <span class="css-control-indicator"></span>Menyiapkan Makanan (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_keuangan">
							            <span class="css-control-indicator"></span>Mengatur Keuangan (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_daya_beli">
							            <span class="css-control-indicator"></span>Keterbatasan Daya Beli (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="status_fungsional_bergantung_transportasi">
							            <span class="css-control-indicator"></span> Transportasi (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Kognitif</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kognitif" value="Disorientas Penuh--0">
							            <span class="css-control-indicator"></span>Disorientas Penuh (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kognitif" value="isorientasi Terhadap Beberapa Bagian dari Waktu--1">
							            <span class="css-control-indicator"></span> Disorientasi Terhadap Beberapa Bagian dari Waktu (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kognitif" value="Disorientasi Terhadap Beberapa Bagian dari Seluruh Waktu --2">
							            <span class="css-control-indicator"></span> Disorientasi Terhadap Beberapa Bagian dari Seluruh Waktu (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kognitif" value="Disorientasi Semua Bagian dari Beberapa Waktu--3">
							            <span class="css-control-indicator"></span> Disorientasi Semua Bagian dari Beberapa Waktu (Skor : 3)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kognitif" value="Disorientasi Semua Bagian dari Semua Waktu--4">
							            <span class="css-control-indicator"></span> Disorientasi Semua Bagian dari Semua Waktu (Skor : 4)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="kognitif" value="Koma--5">
							            <span class="css-control-indicator"></span> Koma (Skor : 5)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Perilaku</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perilaku_tenang">
							            <span class="css-control-indicator"></span> Tenang (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perilaku_bingung">
							            <span class="css-control-indicator"></span> Bingung (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perilaku_gelisah">
							            <span class="css-control-indicator"></span> Gelisah (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perilaku_tidak_bisa_tenang">
							            <span class="css-control-indicator"></span> Tidak Bisa Tenang (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perilaku_lainnya">
							            <span class="css-control-indicator"></span> Lainnya (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Mobilisasi</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="mobilisasi" value="Mampu Mobilisasi Sendiri--0">
							            <span class="css-control-indicator"></span> Mampu Mobilisasi Sendiri (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="mobilisasi" value="Menggunakan Alat--1">
							            <span class="css-control-indicator"></span> Menggunakan Alat (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="mobilisasi" value="Dengan Bantuan Orang Lain--2">
							            <span class="css-control-indicator"></span> Dengan Bantuan Orang Lain (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="mobilisasi" value="Bed Rest--3">
							            <span class="css-control-indicator"></span> Bed Rest (Skor : 3)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Sensorik</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="sensorik" value="Tidak ada--0">
							            <span class="css-control-indicator"></span> Tidak ada (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="sensorik" value="angguan Penglihatan atau Pendengaran--1">
							            <span class="css-control-indicator"></span> Gangguan Penglihatan atau Pendengaran (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="sensorik" value="Gangguan Penglihatan atau Pendengaran--2">
							            <span class="css-control-indicator"></span> Gangguan Penglihatan atau Pendengaran (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Perawatan Sebelumnya</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="perawatan_sebelumnya" value="Tidak ada--0">
							            <span class="css-control-indicator"></span> Tidak ada (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="perawatan_sebelumnya" value="Dirawat 1 kali dalam 3 bulan terakhir--1">
							            <span class="css-control-indicator"></span> Dirawat 1 kali dalam 3 bulan terakhir (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="perawatan_sebelumnya" value="Dirawat 2 kali dalam 3 bulan terakhir--2">
							            <span class="css-control-indicator"></span> Dirawat 2 kali dalam 3 bulan terakhir (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="perawatan_sebelumnya" value="Dirawat lebih dari 2 kali dalam 3 bulan terakhir--3">
							            <span class="css-control-indicator"></span> Dirawat lebih dari 2 kali dalam 3 bulan terakhir (Skor : 3)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Masalah Medis</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="masalah_medis" value="5 masalah--1">
							            <span class="css-control-indicator"></span> 5 masalah (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="masalah_medis" value="Lebih dari 5 masalah--2">
							            <span class="css-control-indicator"></span> Lebih dari 5 masalah (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Konsumi Obat</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="konsumi_obat" value="< 3 macam--0">
							            <span class="css-control-indicator"></span> < 3 macam  (Skor : 0)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="konsumi_obat" value="3-5 macam--1">
							            <span class="css-control-indicator"></span> 3-5 macam (Skor : 1)
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="konsumi_obat" value="Lebih dari 5 macam--2">
							            <span class="css-control-indicator"></span> Lebih dari 5 macam (Skor : 2)
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
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
