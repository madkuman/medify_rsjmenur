<div class="modal" id="modal-tambah" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <form action="{{url('farmasi/'.session('farmasi')->slug.'/produksi/create')}}" method="POST" id="form-transaksi">
            {{csrf_field()}}
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Tambah Produksi Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Produksi</label>
                                    <br>
                                    <input type="text" name="nama_produksi" class="form-control" placeholder="Nama Produksi" id="nama-produksi" data-tags="true" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tipe Produksi</label>
                                    <br>
                                    <select class="form-control js-select2" style="width: 100%;" data-placeholder="Tipe Produksi" data-tags="true" name="tipe_produksi">
                                        <option></option>
                                        @foreach($tipe as $type)
                                        <option id="{{$type->nama}}">{{$type->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <br>
                                    <input type="text" name="harga_produksi" class="form-control" placeholder="Harga" id="harga-produksi" data-tags="true" style="width: 100%;" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <br>
                                    <input type="text" name="jumlah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>E.D.</label>
                                    <br>
                                    <input type="text" name="ed" class="js-datepicker form-control" autocomplete="off" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="" id="racikan-row">
                            <div class="obat-wrapper row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Barang</label>
                                        <br>
                                        <select class="form-control js-select2" style="width: 100%" data-placeholder="Pilih Barang" id="barang-produksi-1" name="barang_produksi[]">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>E.D</label>
                                        <br>
                                        <input type="text" name="edbarang[]" class="js-datepicker form-control" autocomplete="off" disabled="" id="edbarang-1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <br>
                                        <input type="text" name="barang_jumlah[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pb-10" id="tambahRacikan">
                            <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddRacikan">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-square" id="btnSubmit">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>