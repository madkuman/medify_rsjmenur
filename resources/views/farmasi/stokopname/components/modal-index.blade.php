<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/stokopname')}}/new" id=form-stokopname>
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Stok Opname Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="deskripsi" placeholder="Berikan Informasi Lebih">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-square">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
        
<div class="modal" id="modal-large2" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/stokopname')}}/add" id="form-stokopname">
            <input type="hidden">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Tambah Stok Opname (Live)</h3>
                    </div>
                    <div class="block-content">
                        <hr class="my-5">
                        <div id="newItem">
                            <div class="row mt-3 item-wrapper justify-content-center gutters-tiny">
                                <div class="col-md-4">
                                    <label for="penyedia">Barang </label>
                                </div>
                                <div class="col-md-2">
                                    <label for="penyedia">Kadaluarsa </label>
                                </div>
                                <div class="col-md-2">
                                    <label for="penyedia">Jumlah </label>
                                </div>
                                <div class="col-md-3">
                                    <label for="penyedia">Keterangan </label>
                                </div>
                                <div class="col-md-1">
                                    <label for="penyedia">&nbsp;</label>
                                </div>
                            </div>
                            <div class="row justify-content-center pt-15 item-baru gutters-tiny">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div>
                                            <select class="js-select2 barang-select2 form-control" id="barang-select2-1" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang" required>
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="js-datepicker form-control" id="tanggal-datepicker-1" name="kadaluarsa[]" placeholder="Tanggal Kadaluarsa" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div>
                                            <input type="number" class="form-control" id="jumlah-1" name="jumlah[]" placeholder="Jumlah">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control" id="ket-1" name="keterangan[]" placeholder="Keterangan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">&nbsp;</div>
                            </div>
                        </div>

                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square" name="live" value="1">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>