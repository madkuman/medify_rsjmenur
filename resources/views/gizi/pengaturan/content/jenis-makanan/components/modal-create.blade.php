<div class="modal fade" id="modal-create" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('gizi/pengaturan/jenis-makanan/create')}}" id="form-add-jenis-makanan">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Tambah Data Jenis Makanan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Jenis Makanan" name="nama" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select name="utama" id="utama" class="js-select2 form-control" style="width: 100%;" onchange="changeJenis('#utama','.diet','#diet')" required>
                                        <option value="0">Makanan Tambahan</option>
                                        <option value="1">Makanan Utama</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 diet d-none">
                                <div class="form-group">
                                    <label>Diet</label>
                                    <select name="diet" id="diet" class="js-select2 form-control" disabled="disabled" style="width: 100%;" required>
                                        <option value="1">Diet</option>
                                        <option value="0">Non Diet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125 btn-click-animate btn-simpan" id="btn-simpan">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>