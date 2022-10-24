
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pengkajian Penggunaan Antibiotik Profilaksis</h3>
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
                        	
							<div class="form-group col-md-3 col-sm-12">
							    <label>Tanggal Pembedahan</label>
							    <input type="text" class="form-control js-datepicker" name="tanggal_pembedahan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jenis Pembedahan</label>
							    <input type="text" class="form-control" name="jenis_pembedahan" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Indikasi Pembedahan</label>
							    <input type="text" class="form-control" name="indikasi_pembedahan" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Jadwal Operasi</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="jadwal_operasi" value="Elektif">
							            <span class="css-control-indicator"></span> Elektif
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="jadwal_operasi" value="Emergensi">
							            <span class="css-control-indicator"></span> Emergensi
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="col-12">
								<h5 class="pt-15">Klasifikasi Operasi</h5>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="klasifikasi_operasi" value="Bersih">
							            <span class="css-control-indicator"></span> Bersih
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="klasifikasi_operasi" value="Bersih Kontaminasi">
							            <span class="css-control-indicator"></span> Bersih Kontaminasi
							        </label>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="klasifikasi_operasi" value="Terkontaminasi">
							            <span class="css-control-indicator"></span> Terkontaminasi
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Waktu Mulai Insisi</label>
							    <input type="text" class="form-control time" name="waktu_mulai_insisi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Lama Operasi</label>
							    <input type="text" class="form-control time" name="lama_operasi" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">PEMBERIAN ANTIBIOTIK PROFILAKSIS</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Obat yang diberikan</label>
							    <input type="text" class="form-control" name="obat_yang_diberikan" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Dosis</label>
							    <input type="text" class="form-control" name="dosis" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Rute</label>
							    <input type="text" class="form-control" name="rute" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Waktu Pemberian Pertama</label>
							    <input type="text" class="form-control time" name="waktu_pemberian_pertama" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Pemberian dosis tambahan</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="pemberian_dosis_tambahan" value="Ya">
							            <span class="css-control-indicator"></span> Ya
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="pemberian_dosis_tambahan" value="Tidak">
							            <span class="css-control-indicator"></span> Tidak
							        </label>
							    </div>
							</div>
							<div class="col-12">
								<hr>
							</div>
							<div class="form-group col-md-12 col-sm-12">
							    <h5 class="mb-0">Apabila Ya</h5>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Indikasi</label>
							    <input type="text" class="form-control" name="ya_indikasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Dosis</label>
							    <input type="text" class="form-control" name="ya_dosis" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Rute</label>
							    <input type="text" class="form-control" name="ya_rute" >
							</div>
							<div class="col-12">
								<hr>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Frekuensi pemberian antibiotik profilaks</label>
							    <input type="text" class="form-control" name="frekuensi_pemberian_antibiotik_profilaks" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Lama Pemberian</label>
							    <input type="text" class="form-control" name="lama_pemberian" >
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
