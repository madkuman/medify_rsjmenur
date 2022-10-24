<div class="form-group">
    <label>Pasien</label>
    <select class="js-select2 form-control" name="pasien" data-placeholder="Pilih Pasien" id="pasienSelect" disabled="" readonly="">
    	<option value="{{json_encode($sep->pasien)}}">{{$sep->pasien->name}}</option>
    </select>
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