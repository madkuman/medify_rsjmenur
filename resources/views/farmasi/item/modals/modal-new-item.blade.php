<div class="modal" id="newItemModal" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
                                    <div class="col-4">
                                        <label for="penyedia">Jenis Barang</label>
                                        <select class="form-control" id="jenis-select2" name="jenis">
                                            <option value="Alkes">Alkes</option>
                                            <option value="Obat">Obat</option>
                                            <option value="Matkes">Matkes</option>
                                            <option value="Implan">Implan</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="penyedia">Satuan</label>
                                        <select class="js-select2 form-control" id="satuan-select2" name="satuan" placeholder="Pilih Satuan" style="width: 100%;">
                                            @foreach($satuan as $tuan)
                                                <option value="{{$tuan->nama}}">{{$tuan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="rute">Rute</label>
                                        <select class="js-select2 form-control" id="rute" name="rute" style="width: 100%;">
                                            <option value="" selected disabled>Pilih Rute</option>
                                            @foreach($rute as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bahan-aktif">Bahan Aktif</label>
                                    <select class="js-select2 form-control" id="bahan-aktif" name="bahan_aktif" style="width: 100%;">
                                        <option value="" selected disabled>Pilih Bahan Aktif</option>
                                        @foreach($bahan_aktif as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="kekuatan-sediaan">Kekuatan Sediaan</label>
                                            <input class="form-control" type="number" name="kekuatan_sediaan" id="kekuatan-sediaan" step="0.1" autocomplete="off">
                                        </div>
                                        <div class="col-6">
                                            <label for="satuan-kekuatan">Satuan Kekuatan</label>
                                            <select class="js-select2 form-control" id="satuan-kekuatan" name="satuan_kekuatan" style="width: 100%;">
                                                <option value="" selected disabled>Pilih Satuan Kekuatan</option>
                                                @foreach($satuan_kekuatan as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang">
                                </div>
                                <div class="form-group">
                                    <label for="kode_atc">Kode Atc</label>
                                    <input type="text" class="form-control" id="kode_atc" name="kode_atc" placeholder="Kode Atc">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="kelas-terapi">Kelas Terapi</label>
                                            <select class="js-select2 form-control" id="kelas-terapi" name="kelas_terapi" style="width: 100%;">
                                                @foreach($kategori as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <input id="is-kelas-terapi" name="is_kelas_terapi" style="margin-top: 40px" type="checkbox">
                                            <label for="is-kelas-terapi">Kelas Terapi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="kelas-terapi-fornas">Kelas Terapi Fornas</label>
                                            <select class="js-select2 form-control" id="kelas-terapi-fornas" name="kelas_terapi_fornas" style="width: 100%;">
                                                @foreach($kategori as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <input id="is-kelas-terapi-fornas" name="is_kelas_terapi_fornas" style="margin-top: 40px" type="checkbox">
                                            <label for="is-kelas-terapi-fornas">Kelas Terapi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rak-obat">Rak Obat</label>
                                    <select class="js-select2 form-control" id="rak-obat" name="rak_obat" style="width: 100%;">
                                        @foreach($rak_obat as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="formularium-rs">Formularium RS</label>
                                    <select class="js-select2 form-control" id="formularium-rs" name="is_formularium_rs" style="width: 100%;">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fornas">Fornas</label>
                                    <select class="js-select2 form-control" id="fornas" name="is_fornas" style="width: 100%;">
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Dosis Maksimal</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="dosis_maksimal" placeholder="">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="dosis_maksimal_satuan" placeholder="Satuan">
                                        </div>     
                                    </div>
                                </div>
                                <div id="div-main-indikasi">
                                    <label>Indikasi</label>
                                    <div class="form-group div-item-indikasi">
                                        <input type="text" class="form-control" name="indikasi[]" placeholder="Indikasi">
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-tambah-indikasi"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                                
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
                                <div class="form-group">
                                    <label for="retriksi-bpjs">Retriksi BPJS Jumlah</label>
                                    <input class="form-control" type="number" name="retriksi_bpjs_jumlah" id="retriksi-bpjs" step="0.1">
                                </div>
                                <div class="form-group">
                                    <label for="retriksi-bpjs-data-lab">Retriksi BPJS Data Lab</label>
                                    <select class="js-example-basic-multiple form-control" name="retriksi_bpjs_data_lab[]" multiple="multiple" style="width: 100%;">
                                        @foreach($form_lab_pk as $item)
                                            <option value="{{$item->id}}">{{$item->parameter}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Waktu/dosage Maksimal</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="number" class="form-control" name="waktu_dosage_max_1" placeholder="">
                                        </div>
                                        <div class="col-md-1">
                                            <p style="padding-top: 10px; font-size: 10pt">x</p>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" class="form-control" name="waktu_dosage_max_2" placeholder="">
                                        </div>     
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- interaksi kelas terapi -->
                        <h5 class="mt-2">Interaksi Kelas Terapi</h5>
                        <div class="row" id="row-interaksi-kelas-terapi">
                            <div class="col-12 main-div-interaksi-kelas-terapi">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Nama</label>
                                            <select class="nama-interaksi-kelas-terapi form-control" name="nama_interaksi_kelas_terapi[]" style="width: 100%;">
                                                @foreach($kategori as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label>Jenis Interaksi</label>
                                            <select class="jenis-interaksi-kelas-terapi form-control" name="jenis_interaksi_kelas_terapi[]" style="width: 100%;">
                                                @foreach($jenis_interaksi as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label>Keterangan</label>
                                            <input class="form-control" type="text" name="keterangan_interaksi_kelas_terapi[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="btn-tambah-interaksi-kelas-terapi"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                        
                        <!-- interaksi obat -->
                        <br>
                        <br>
                        <h5 class="mt-2">Interaksi Obat</h5>
                        <div class="row" id="row-interaksi-obat">
                            <div class="col-12 main-div-interaksi-obat">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Nama</label>
                                            <select class="nama-interaksi-obat form-control" name="nama_interaksi_obat[]" style="width: 100%;">
                                                @foreach($item_template as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label>Jenis Interaksi</label>
                                            <select class="jenis-interaksi-obat form-control" name="jenis_interaksi_obat[]" style="width: 100%;">
                                                @foreach($jenis_interaksi as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label>Keterangan</label>
                                            <input class="form-control" type="text" name="keterangan_interaksi_obat[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="btn-tambah-interaksi-obat"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                        <!-- end interaksi obat -->
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