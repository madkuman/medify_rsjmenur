<div class="modal fade" id="modal-autoinput-pasien" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-content pt-1 pl-5">
                	<h4>Data Pasien</h4>
                    <hr>
                	<div class="form-group">
                        <label>Nama</label>
                        <h5 id="display-autoinput-pasien-nama"></h5>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <h5 id="display-autoinput-pasien-gender"></h5>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <h5 id="display-autoinput-pasien-tgl-lahir"></h5>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <h5 id="display-autoinput-pasien-nik"></h5>
                    </div>
                    <div class="form-group">
                        <label>No BPJS</label>
                        <h5 id="display-autoinput-pasien-bpjs"></h5>
                    </div>
                    <div class="form-group">
                        <label>Kelas BPJS</label>
                        <h5 id="display-autoinput-pasien-kelas"></h5>
                    </div>
                    <div class="form-group">
                        <label>Jenis BPJS</label>
                        <h5 id="display-autoinput-pasien-jenis-bpjs"></h5>
                    </div>
                    <div class="form-group">
                        <label>Status BPJS</label>
                        <h5 id="display-autoinput-pasien-status-bpjs"></h5>
                    </div>
                    @if($show_autofill_confirm)
                    <div class="form-group text-center">
                        <p>Apakah Anda ingin mengisi data pasien dengan data ini?</p>
                        <button class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button class="btn btn-primary" data-dismiss="modal" onclick="fillAutoInputData()">Ya</button>
                    </div>
                    @else
                    <div class="form-group text-center">
                        <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>