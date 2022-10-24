<div class="row">
	<div class="col-6">
		<div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Anamnesis</label>
                    <textarea class="form-control" type="textarea" name="anamnesis" id="anamnesis" placeholder="Anamnesis" rows="5"></textarea>
                </div>
            </div>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-6">
		<h5 class="uppercase">VITAL SIGN</h5>
		<div class="form-group row">
            <label class="col-12" for="">Tekanan Darah</label>
            <div class="col-6">
                <input type="text" class="form-control form-control-lg"  name="sistol" placeholder="" >
                <small>Sistol</small>
            </div>
            <div class="col-6">
                <input type="text" class="form-control form-control-lg"  name="diastol" placeholder="" >
                <small>Diastol</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12" for="">Nadi</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-lg"  name="nadi" placeholder="" >
                <small>Beat Per Minute</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12" for="">Pernapasan</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-lg"  name="pernapasan" placeholder="" >
                <small>Breath Per Minute</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12" for="">Temperatur</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-lg"  name="temperatur" placeholder="" >
                <small>Dalam Satuan Celcius</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12" for="">Skala Nyeri</label>
            <div class="col-12">
                <input type="number" class="form-control form-control-lg"  name="skala_nyeri" placeholder="" >
                <small>0 (Tidak Nyeri) - 10 (Sangat Nyeri)</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12" for="">SPO2</label>
            <div class="col-12">
                <input type="text" class="form-control form-control-lg"  name="spo" placeholder="" >
                <small>Dalam Satuan %</small>
            </div>
        </div>
	</div>
	<div class="col-6">
		<h5 class="uppercase">STATUS LOKASI CIDERA</h5>
		<div class="form-group row">
            <label class="col-5">Kelompok Anggota</label>
            <label class="col-7">Keterangan</label>
        </div>
        <div class="form-group row" id="lokasi_cidera">
        </div>
        <div class="row">
        	<div class="col-12 text-center">
        		<a href="javascript:addForm();"><i class="fa fa-plus-circle fa-3x text-primary"></i></a>
        	</div>
        </div>
	</div>
</div>