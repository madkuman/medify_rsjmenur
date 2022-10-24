
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Monitoring Transfusi Darah</h3>
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
							    <label>Tanggal</label>
							    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd-mm-yyyy">
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jam</label>
							    <input type="text" class="form-control" name="jam" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Monitoring</h3>
							</div>
							<div class="col-12">
								<h4 class="pt-15">15 Menit Sebelum Transfusi</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Sebelum Tekanan Darah</label>
							    <input type="text" class="form-control" name="menit_15_sebelum_td" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Sebelum Nadi</label>
							    <input type="text" class="form-control" name="menit_15_sebelum_nadi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Sebelum Transfusi</label>
							    <input type="text" class="form-control" name="menit_15_sebelum_t" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Sebelum Respiratory Rate</label>
							    <input type="text" class="form-control" name="menit_15_sebelum_rr" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Transfusi</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jam Mulai Transfusi</label>
							    <input type="text" class="form-control time" name="jam_mulai_transfusi" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Setelah Darah Masuk</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Setelah Tekanan Darah</label>
							    <input type="text" class="form-control" name="menit_15_setelah_td" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Setelah Nadi</label>
							    <input type="text" class="form-control" name="menit_15_setelah_nadi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Setelah Transfusi</label>
							    <input type="text" class="form-control" name="menit_15_setelah_t" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>15 Menit Setelah Respiratory Rate</label>
							    <input type="text" class="form-control" name="menit_15_setelah_rr" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>1 Jam Setelah Tekanan Darah</label>
							    <input type="text" class="form-control" name="jam_1_setelah_td" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>1 Jam Setelah Nadi</label>
							    <input type="text" class="form-control" name="jam_1_setelah_nadi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>1 Jam Setelah Transfusi</label>
							    <input type="text" class="form-control" name="jam_1_setelah_t" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>1 Jam Setelah Respiratory Rate</label>
							    <input type="text" class="form-control" name="jam_1_setelah_rr" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Reaksi Selama Transfusi</label>
							    <input type="text" class="form-control" name="reaksi_selama_transfusi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Jam Selesai Transfusi</label>
							    <input type="text" class="form-control time" name="jam_selesai_transfusi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>4 Jam Setelah Tekanan Darah</label>
							    <input type="text" class="form-control" name="jam_4_setelah_td" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>4 Jam Setelah Nadi</label>
							    <input type="text" class="form-control" name="jam_4_setelah_nadi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>4 Jam Setelah Transfusi</label>
							    <input type="text" class="form-control" name="jam_4_setelah_t" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>4 Jam Setelah Respiratory Rate</label>
							    <input type="text" class="form-control" name="jam_4_setelah_rr" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Reaksi Transfusi</label>
							    <input type="text" class="form-control" name="reaksi_transfusi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Golongan Darah</label>
							    <input type="text" class="form-control" name="golongan_darah" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Rhesus</label>
							    <input type="text" class="form-control" name="rhesus" >
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
