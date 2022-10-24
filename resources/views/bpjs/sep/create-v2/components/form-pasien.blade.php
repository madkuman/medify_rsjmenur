<div class="form-group">
    <label>
        Pasien
        <i class="fa fa-asterisk fa-spin text-info" id="pasien-loading" style="display: none;"></i>
    </label>
    <select class="js-select2 form-control" name="pasien" data-placeholder="Pilih Pasien" id="pasienSelect" style="width: 100%;">
    	<option value=""></option>
    	@if($pasien_id != -1)
    	<option value="{{$pasien_id}}" selected="">{{$pasien_name}}</option>
    	@endif
    </select>
</div>

<div class="form-group">
    <label>
        No BPJS Pasien
        <i class="fa fa-asterisk fa-spin text-info" id="pembayaran-loading" style="display: none;"></i>
    </label>
    <select class="js-select2 form-control" name="pembayaran" data-placeholder="Pilih Nomor BPJS Pasien" required="" id="pembayaranSelect" style="width: 100%;">
        <option value=""></option>
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
			    <div class="col-4 mb-5">
			        <div class="font-w600 mb-5">Kelas BPJS</div>                            
			    </div>
			    <div class="col-8" id="preview_pasien_kelas_bpjs"></div>
            </div>
        </div>
    </div>
</div>