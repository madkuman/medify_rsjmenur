<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/penghapusan')}}/new" id=form-pengadaan>
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Penghapusan Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih">
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">
                        <div id="newItem">
                            <div class="row mt-3 item-wrapper">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="penyedia">Nama Barang </label>
                                        <div>
                                            <select class="js-select2 form-control" id="template-select2-1" name="template[]" style="width: 100%;">
                                                <option value="">Cari Barang</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="penyedia">Kadaluarsa </label>
                                        <div>
                                            <select class="js-select2 form-control" id="barang-select2-1" name="barang[]" onchange="changeJumlah(1)" style="width: 100%;">
                                                <option value="">Pilih Barang</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="penyedia">Jumlah </label>
                                        <div>
                                            <input type="number" class="form-control" id="jumlah-1" name="jumlah[]" placeholder="Jumlah">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="penyedia">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
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
                    <button type="button" class="btn btn-secondary btn-square" id="close" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>