<div class="modal" id="newItemModal" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/item')}}/new">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Barang Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Harga Pasar Barang</label>
                                    <input type="text" class="form-control" name="harga" placeholder="Harga Pasar Barang" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-6">
                                        <label for="penyedia">Jenis Barang</label>
                                        <select class="form-control" id="jenis-select2" name="jenis">
                                            <option value="Alkes">Alkes</option>
                                            <option value="Obat">Obat</option>
                                            <option value="Matkes">Matkes</option>
                                            <option value="Implan">Implan</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="penyedia">Satuan</label>
                                        <select class="js-select2 form-control" id="satuan-select2" name="satuan" placeholder="Pilih Satuan" style="width: 100%;">
                                            @foreach($satuan as $tuan)
                                                <option value="{{$tuan->nama}}">{{$tuan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Kategori Barang</label>
                                    <select class="js-example-basic-multiple form-control" name="kategori[]" placeholder="Pilih Kategori" multiple="multiple" style="width: 100%;">
                                        @foreach($gorilla as $gori)
                                            <option value="{{$gori->id}}">{{$gori->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">Batasan Low Stock <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="batasan_stok" placeholder="Isi Batasan Low Stock">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Batasan Expired <small>(Opsional)</small></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control mr-sm-2" name="batasan_kadaluarsa" placeholder="Isikan Angka">
                                        <select class="form-control mr-sm-2" id="expired-select2" name="satuan_waktu" data-placeholder="Bulan">
                                            <option value="1">Hari</option>
                                            <option value="30">Bulan</option>
                                            <option value="365">Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Batasan Distribusi <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="batasan_distribusi" placeholder="Isi Batasan Distribusi Farmasi">
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Keterangan Lebih Lanjut">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                            <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>