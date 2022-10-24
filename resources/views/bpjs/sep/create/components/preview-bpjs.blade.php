
<div class="form-group">
    <label>Tanggal SEP</label>
    <input type="text" class="js-datepicker form-control" id="tanggal_sep" name="tanggal_sep" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" required="" placeholder="dd-mm-yyyy">
</div>

<div class="form-group" id="infoPasien" style="display: none;">
    <div class="block block-bordered">
        <div class="block-content">
            <div class="row">
            	<div class="col-12">
                    <span class="font-w600 h5">
                        Data Pasien BPJS
                    </span>    
                </div>
			    <div class="col-4">
			        <div class="font-w600 mb-5">Nama</div>                            
			    </div>
			    <div class="col-8" id="preview_pasien_nama"></div>
			    <div class="col-4">
			        <div class="font-w600 mb-5">Nomor RM</div>                            
			    </div>
			    <div class="col-8" id="preview_pasien_no_rm"></div>
			    <div class="col-4">
			        <div class="font-w600 mb-5">Nomor BPJS</div>                            
			    </div>
			    <div class="col-8" id="preview_pasien_no_bpjs"></div>
			    <div class="col-4 mb-5">
			        <div class="font-w600 mb-5">Jenis BPJS</div>                            
			    </div>
			    <div class="col-8" id="preview_pasien_jenis_bpjs"></div>
            </div>
        </div>
    </div>
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
