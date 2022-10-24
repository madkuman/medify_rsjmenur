<div class="modal" id="modal_panggil_antrian" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv/panggil-antrian')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Panggil Antrian</h3>
                    </div>
                    <div class="block-content">
                        <input type="hidden" class="form-control" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="no_rm">No RM</label>
                                    <input type="text" class="form-control" name="no_rm" id="no_rm" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Nama Pasien</label>
                                    <input type="text" class="form-control" name="nama_pasien_panggil" id="nama_pasien_panggil" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nomor_resep">Nomor Resep</label>
                                    <input type="text" class="form-control" name="nomor_resep_panggil" id="nomor_resep_panggil" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loket">Loket</label>
                                    <select name="loket" id="loket" class="form-control js-select2" aria-placeholder="Pilih Loket" style="width: 100%" required>
                                        <option value="">Pilih Loket</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-click-animate btn-primary btn-simple">
                         <i class="fa fa-bullhorn"></i> Panggil
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>