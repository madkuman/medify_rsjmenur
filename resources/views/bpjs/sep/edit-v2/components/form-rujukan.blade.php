<div class="form-group">
	<label class="control-label">
		Nomor Rujukan
		<i class="fa fa-asterisk fa-spin text-info" id="loading_select_rujukan" style="display: none;"></i>
	</label>
	<select name="no_rujukan" class="form-control js-select2" id="selectNoRujukan" style="width: 100%;" data-placeholder="Pilih Nomor Rujukan Pasien" required="" disabled="" readonly="">
		<option value=""></option>
	</select>
	<div class="invalid-feedback">Data Nomor Rujukan BPJS tidak dapat kosong</div>
</div>
<div class="form-group" id="infoRujuk" style="display: none;">
    <div class="block block-bordered">
        <div class="block-content">
            <div class="row">
            	<div class="col-12">
                    <span class="font-w600 h5">
                        Data Rujukan
                    </span>    
                </div>
            	<div class="col-4">
					<div class="font-w600 mb-5" >Faskes Perujuk</div>                            
				</div>
				<div class="col-8" id="preview_bpjs_modal_perujuk"></div>
				<div class="col-4">
					<div class="font-w600 mb-5" >Diagnosis </div>
				</div>
				<div class="col-8" id="preview_bpjs_modal_diagnosis"></div>
				<div class="col-4">
					<div class="font-w600 mb-5" >Keluhan</div>                            
				</div>
				<div class="col-8" id="preview_bpjs_modal_keluhan"></div>

				<div class="col-4">
					<div class="font-w600 mb-5" >Jenis Pelayanan</div>                            
				</div>
				<div class="col-8" id="preview_bpjs_modal_pelayanan"></div>

				<div class="col-4">
					<div class="font-w600 mb-5" >Poli Rujukan</div>                            
				</div>
				<div class="col-8" id="preview_bpjs_modal_poli"></div>
				<div class="col-4">
					<div class="font-w600 mb-5" >COB Asuransi</div>                            
				</div>
				<div class="col-8" id="preview_bpjs_modal_cob_nama"></div>
				<div class="col-4">
					<div class="font-w600 mb-5" >Nomor COB</div>                            
				</div>
				<div class="col-8" id="preview_bpjs_modal_cob_nomor"></div>
            </div>
        </div>
    </div>
</div>