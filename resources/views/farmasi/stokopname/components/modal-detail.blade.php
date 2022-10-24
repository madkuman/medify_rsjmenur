<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/stokopname')}}/add" id="form-stokopname">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$stokopname->id}}">
            <input type="hidden" name="flag" value="{{$flag}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Tambah Detail Stok Opname</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="deskripsi" placeholder="Berikan Informasi Lebih" value="{{$stokopname->keterangan}}">
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">
                        <div id="newItem">
                            <div class="row mt-3 item-wrapper">
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
                                    <label for="penyedia">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </div>
                            <div class="row justify-content-center pt-15 item-baru">
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
                                            <input type="text" class="js-datepicker form-control" id="tanggal-datepicker-1" name="kadaluarsa[]" placeholder="Masukkan Tanggal Kadaluarsa" autocomplete="off" required>
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
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($flag == 0)
                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                            </center>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>

                    @if($flag == 0)
                    <button type="submit" class="btn btn-primary btn-square" name="live" value="0">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    @else
                    <button type="submit" class="btn btn-primary btn-square" name="live" value="1">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>