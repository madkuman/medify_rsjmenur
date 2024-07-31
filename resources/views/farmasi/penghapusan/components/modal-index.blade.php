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

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label>JENIS PENGHAPUSAN</label>
                                <select class="form-control js-select2" name="jenis_penghapusan_id" style="width: 100%;">
                                    @foreach($penghapusan_jenis as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>SURAT PERINTAH</label>
                                <input type="text" class="form-control" name="surat_perintah">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label>TANGGAL PENGELUARAN</label>
                                <input type="text" class="js-datepicker form-control tanggal-datepicker" data-date-format='dd-mm-yyyy' name="tgl_pengeluaran" placeholder="Masukkan Tanggal Penerimaan" autocomplete="off" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                            </div>
                            <div class="col-md-6">
                                <label>NO PENGELUARAN</label>
                                <input type="text" class="form-control" name="no_pengeluaran">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label>PENYEDIA</label>
                                <select class="form-control js-select2" name="penyedia_id" style="width: 100%;">
                                    <option value="">-</option>
                                    @foreach($supplier as $supp)
                                    <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penyedia">KETERANGAN <small>(Opsional)</small></label>
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