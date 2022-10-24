<form id="form-create" method="POST">
    {{csrf_field()}}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Pasien</label>
                <select class="js-select2 form-control" id="select_pasien" name="pasien">
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Kasus</label>
                <select class="js-select2 form-control" id="select_kasus" name="kasus">
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>SEP</label>
                <select class="js-select2 form-control" id="select_sep" name="sep">
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="example-datepicker1">Tanggal Rujukan</label>
                <input type="text" class="js-datepicker form-control" id="tanggal_rujuk" name="tanggal_rujuk" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', time())}}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="example-datepicker1">Rencana Kunjungan</label>
                <input type="text" class="js-datepicker form-control" id="rencana_kunjungan" name="rencana_kunjungan" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', time())}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Pelayanan Rujukan</label>
                <select class="form-control" name="jenis_rujuk">
                    <option value="1" selected>Rawat Inap</option>
                    <option value="2">Rawat Jalan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tipe Rujukan</label>
                <select class="form-control" name="tipe_rujuk">
                    <option value="0" selected>Penuh</option>
                    <option value="1">Partial</option>
                    <option value="2">Rujuk Balik (Non PRB)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Diagnosis Rujukan</label>
                <select class="js-select2 form-control" id="select_diagnosis" name="diagnosis">
                </select>
            </div>
            <div class="form-group">
                <label>Tujuan Faskes</label>
                <select class="js-select2 form-control" id="select_faskes" name="faskes">
                </select>
            </div>
            <div class="form-group">
                <label>Tujuan Poli</label>
                <select class="js-select2 form-control" id="select_poli" name="poli">
                </select>
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <input type="text" class="form-control" name="catatan">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>