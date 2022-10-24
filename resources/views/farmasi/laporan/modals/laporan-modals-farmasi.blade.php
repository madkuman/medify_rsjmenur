<div class="modal" id="modal-kegiatan-kesehatan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/kegiatan-kesehatan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                    <div class="block-content">
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-stok-opname" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/stok-opname') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL MULAI</label>
                            <input type="text" class="js-datepicker form-control datepicker"  name="tanggal_min" placeholder="Tanggal Mulai" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="penyedia">TANGGAL SELESAI</label>
                            <input type="text" class="js-datepicker form-control datepicker"  name="tanggal_max" placeholder="Tanggal Selesai" autocomplete="off">
                        </div>
                    </div>
                    <div class="export-as" id="form-group-ks"></div>
                    <div class="block-content">
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-narkotika" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/rekapitulasi-narkotika') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="form-group">
                            <label for="penyedia">Kategori Barang</label>
                            <select class="js-example-basic-multiple form-control" name="kategori[]" placeholder="Pilih Kategori" multiple="multiple" style="width: 100%;">
                                @foreach($gorilla as $gori)
                                <option value="{{$gori->id}}">{{$gori->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-pemakaian" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/pemakaian-obat') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="row">
                            <div class="col-4">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="obat_bebas" id="obat-bebas" checked> <span class="css-control-indicator"></span> Obat Bebas
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="obat_resep" id="obat-resep" checked> <span class="css-control-indicator"></span> Obat Resep
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="pasien_umum" id="pasien-umum" checked> <span class="css-control-indicator"></span> Pasien Umum
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="pasien_bpjs" id="pasien_bpjs" checked> <span class="css-control-indicator"></span> Pasien BPJS
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="pasien_asuransi" id="pasien_asuransi" checked> <span class="css-control-indicator"></span> Pasien Asuransi
                                </label>
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
                        <div class="form-group" id="jenis-pembayaran">
                            <label for="penyedia">Jenis Pembayaran</label>
                            <select class="js-example-basic-multiple form-control" name="jenis[]" placeholder="Pilih Jenis Pembayaran" multiple="multiple" style="width: 100%;">
                                @foreach($perusahaan as $usaha)
                                <option value="{{$usaha->id}}">{{$usaha->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penyedia">Pilih Shift</label>
                            <select class="js-example-basic-multiple form-control" name="shift[]" placeholder="Pilih Shift" multiple="multiple" style="width: 100%;">
                                @foreach(session('farmasi')->aturan_shift as $row)
                                <option value="{{$row->id}}">{{date('H:i',strtotime($row->waktu_min))}}-{{date('H:i',strtotime($row->waktu_max))}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-pengeluaran" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/pengeluaran-obat') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="row">
                            <div class="col">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="obat_bebas" id="bebas" checked> <span class="css-control-indicator"></span> Obat Bebas
                                </label>
                            </div>
                            <div class="col">
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" name="obat_resep" id="resep"checked> <span class="css-control-indicator"></span> Obat Resep
                                </label>
                            </div>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-pemberian-obat" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/pemberian-obat') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pemberian Obat</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <select class="js-select2 form-control pasien-select2" name="pasien" style="width: 100%;" data-placeholder="Cari Pasien">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penyedia">Pilih Farmasi</label>
                            <select class="js-example-basic-multiple form-control" name="farmasi[]" placeholder="Pilih Farmasi" multiple="multiple" style="width: 100%;">
                                @foreach($pharmacy as $pharm)
                                <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-pemberian-per-bangsal" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/pemberian-per-bangsal') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pemberian Obat Per Bangsal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="form-group">
                            <label for="penyedia">Pilih Farmasi</label>
                            <select class="js-example-basic-multiple form-control" name="farmasi[]" placeholder="Pilih Farmasi" multiple="multiple" style="width: 100%;">
                                @foreach($pharmacy as $pharm)
                                <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penyedia">Pilih Bangsal</label>
                            <select class="js-example-basic-multiple form-control" name="bangsal[]" placeholder="Pilih Bangsal" multiple="multiple" style="width: 100%;">
                                @foreach($bangsal as $bang)
                                <option value="{{$bang->id}}">{{$bang->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-resep" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/resep-obat') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <select class="js-select2 form-control pasien-select2" name="pasien" style="width: 100%;" data-placeholder="Cari Pasien">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penyedia">Pilih Farmasi</label>
                            <select class="js-example-basic-multiple form-control" name="farmasi[]" placeholder="Pilih Farmasi" multiple="multiple" style="width: 100%;">
                                @foreach($pharmacy as $pharm)
                                <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-penjualan-obat" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-penjualan-obat') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>
                        <div class="form-group">
                            <label for="penyedia">Pilih Shift</label>
                            <select class="js-example-basic-multiple form-control" name="shift[]" placeholder="Pilih Shift" multiple="multiple" style="width: 100%;">
                                @foreach(session('farmasi')->aturan_shift as $row)
                                <option value="{{$row->id}}">{{$row->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-penjualan-bebas" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-penjualan-bebas') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf">
                        <i class="fa fa-file-pdf-o"></i> Print PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-distribusi-obat-masuk" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/distribusi-obat-masuk') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Distribusi Obat Masuk</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="form-group">
                            <label for="penyedia">Pilih Farmasi</label>
                            <select class="js-example-basic-multiple form-control" name="farmasi[]" placeholder="Pilih Farmasi" multiple="multiple" style="width: 100%;">
                                @foreach($pharmacy as $pharm)
                                <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-distribusi-obat-keluar" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/distribusi-obat-keluar') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Distribusi Obat Keluar</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                        <div class="form-group">
                            <label for="penyedia">Pilih Farmasi</label>
                            <select class="js-example-basic-multiple form-control" name="farmasi[]" placeholder="Pilih Farmasi" multiple="multiple" style="width: 100%;">
                                @foreach($pharmacy as $pharm)
                                <option value="{{$pharm->id}}">{{$pharm->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-expired" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/barang-expired') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL EXPIRED</label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-obat-dukungan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="documentobat-dukungan">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/obat-dukungan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pemakaian Obat Dukungan</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label>BULAN</label>
                            <select class="form-control js-select2" style="width: 100%" name="bulan">
                                <option selected="" disabled="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>TAHUN</label>
                            <input type="text" name="tahun" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-put-gudang" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/put-gudang') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pemakaian Obat Dukungan</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <label class="col-12">Tipe Laporan</label>
                            <div class="col-12">
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="tipe_put" id="tipe-triwulan" value="triwulan" checked="">
                                    <label class="custom-control-label" for="tipe-triwulan">Triwulan</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="tipe_put" id="tipe-bulanan" value="bulanan">
                                    <label class="custom-control-label" for="tipe-bulanan">Bulanan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="put-bulanan-form" style="display: none;">
                            <label>Bulan</label>
                            <select class="form-control js-select2" style="width: 100%" name="bulan" id="bulan-put" data-placeholder="Pilih Bulan">
                                {{-- <option ></option> --}}
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group" id="put-triwulan-form">
                            <label>Triwulan</label>
                            <select class="form-control js-select2" style="width: 100%" name="triwulan" id="triwulan-put" data-placeholder="Pilih Triwulan" required>
                                {{-- <option value="null"></option> --}}
                                <option value="1">Triwulan I</option>
                                <option value="2">Triwulan II</option>
                                <option value="3">Triwulan III</option>
                                <option value="4">Triwulan IV</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" name="tahun" class="form-control" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf" id="btn-pdf-ks">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-pasien-kemoterapi" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/pasien-kemoterapi') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tanggal_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                    <div class="block-content">
                        <div class="col">
                            <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modal-laporan-pelayanan-resep" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-pelayanan-resep') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pelayanan Resep</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                        <div class="form-group" id="jenis-pembayaran">
                            <label for="penyedia">Jenis Pembayaran</label>
                            <select class="js-example-basic-multiple form-control" name="jenis[]" placeholder="Pilih Jenis Pembayaran" multiple="multiple" style="width: 100%;">
                                @foreach($perusahaan as $usaha)
                                <option value="{{$usaha->id}}">{{$usaha->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modal-laporan-response-time-harian" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-response-time-harian') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kecepatan Pelayanan Resep (Respon Time) - Harian</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                        @include('farmasi.laporan.modals.components.form-jenis-resep')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal" id="modal-laporan-response-time-tahunan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-response-time-tahunan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kecepatan Pelayanan Resep (Respon Time) - Tahunan</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-year')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modal-laporan-waktu-pelayanan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-waktu-pelayanan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Waktu Pelayanan</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-jenis-resep')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-laporan-kesesuaian-dokter-fornas-bulanan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-kesesuaian-dokter-fornas-bulanan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kesesuaian Fornas atau Formularium RS Dokter Menulis Resep - Bulanan</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-resep-fornas-formularium')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-kesesuaian-dokter-fornas-harian" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-kesesuaian-dokter-fornas-harian') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kesesuaian Fornas atau Formularium RS Dokter Menulis Resep - Harian</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-resep-fornas-formularium')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-telaah-resep" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-telaah-resep') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Telaah Resep</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modal-laporan-persediaan-farmasi" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-persediaan-farmasi') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Sisa Stok</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-single')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-perbekalan-farmasi" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-perbekalan-farmasi') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Mutasi Stok</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                        @include('farmasi.laporan.modals.components.form-sumber-dana-ada-semua')
                        <div class="form-group" id="jenis-pembayaran">
                            <label for="penyedia">Jenis Pembayaran</label>
                            <select class="js-example-basic-multiple form-control" name="jenis[]" placeholder="Pilih Jenis Pembayaran" multiple="multiple" style="width: 100%;">
                                @foreach($perusahaan as $usaha)
                                <option value="{{$usaha->id}}">{{$usaha->nama}}</option>
                                @endforeach
                            </select>
                            <small>Kosongkan untuk melakukan filter semua kategori</small>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-mutasi-stok-emergensi" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/mutasi-stok-emergensi') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Mutasi Stok Farmasi</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-stok-emergensi" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-stok-emergensi') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Persediaan Stok Rumah Sakit</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-single')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                        @include('farmasi.laporan.modals.components.form-sumber-dana-ada-semua')
                        <div class="form-group" id="jenis-pembayaran">
                            <label for="penyedia">Jenis Pembayaran</label>
                            <select class="js-example-basic-multiple form-control" name="jenis[]" placeholder="Pilih Jenis Pembayaran" multiple="multiple" style="width: 100%;">
                                @foreach($perusahaan as $usaha)
                                <option value="{{$usaha->id}}">{{$usaha->nama}}</option>
                                @endforeach
                            </select>
                            <small>Kosongkan untuk melakukan filter semua kategori</small>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modal-rekap-penggunaan-barang" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/rekap-penggunaan-barang') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Rekap Penggunaan Barang</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        @include('farmasi.laporan.modals.components.form-asal-pelayanan')
                        @include('farmasi.laporan.modals.components.form-sumber-dana-ada-semua')
                        <div class="form-group" id="jenis-pembayaran">
                            <label for="penyedia">Jenis Pembayaran</label>
                            <select class="js-example-basic-multiple form-control" name="jenis[]" placeholder="Pilih Jenis Pembayaran" multiple="multiple" style="width: 100%;">
                                @foreach($perusahaan as $usaha)
                                <option value="{{$usaha->id}}">{{$usaha->nama}}</option>
                                @endforeach
                            </select>
                            <small>Kosongkan untuk melakukan filter semua kategori</small>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="modal-laporan-penggunaan-barang" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-penggunaan-barang') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Nilai Penggunaan Barang</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-year')
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-barang-telah-expired" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-barang-telah-expired') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Barang Telah Expired</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-laporan-barang-mendekati-expired" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-barang-mendekati-expired') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Barang Mendekati Expired</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-farmasi')
                        <div class="form-group">
                            <label>Batas Expired</label>
                            <select class="form-control" name="batas_hari">
                                <option value="30">1 Bulan Lagi</option>
                                <option value="60">2 Bulan Lagi</option>
                                <option value="90">3 Bulan Lagi</option>
                                <option value="120">4 Bulan Lagi</option>
                                <option value="150">5 Bulan Lagi</option>
                                <option value="180">6 Bulan Lagi</option>
                            </select>
                        </div>
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-pelayanan-kefarmasian-jatim" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-pelayanan-kefarmasian-jatim') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pelayanan Kefarmasian Triwulan</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label>Triwulan</label>
                            <select class="form-control js-select2" style="width: 100%" name="triwulan" id="triwulan" data-placeholder="Pilih Triwulan" required>
                                {{-- <option value="null"></option> --}}
                                <option value="1">Triwulan I</option>
                                <option value="2">Triwulan II</option>
                                <option value="3">Triwulan III</option>
                                <option value="4">Triwulan IV</option>
                            </select>
                        </div>
                        @include('farmasi.laporan.modals.components.form-date-year')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-penggunaan-obat" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-penggunaan-obat') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Triwulan Penggunaan Obat Di Rumah Sakit</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label>Triwulan</label>
                            <select class="form-control js-select2" style="width: 100%" name="triwulan" id="triwulan" data-placeholder="Pilih Triwulan" required>
                                {{-- <option value="null"></option> --}}
                                <option value="1">Triwulan I</option>
                                <option value="2">Triwulan II</option>
                                <option value="3">Triwulan III</option>
                                <option value="4">Triwulan IV</option>
                            </select>
                        </div>
                        @include('farmasi.laporan.modals.components.form-date-year')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-pelayanan-obat-jkn" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-pelayanan-obat-jkn') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Pelayanan Obat Untuk Peserta JKN</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label>Triwulan</label>
                            <select class="form-control js-select2" style="width: 100%" name="triwulan" id="triwulan" data-placeholder="Pilih Triwulan" required>
                                {{-- <option value="null"></option> --}}
                                <option value="1">Triwulan I</option>
                                <option value="2">Triwulan II</option>
                                <option value="3">Triwulan III</option>
                                <option value="4">Triwulan IV</option>
                            </select>
                        </div>
                        @include('farmasi.laporan.modals.components.form-date-year')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-penerimaan-barang-habis-pakai" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/penerimaan-barang-habis-pakai') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Penerimaan Barang Habis Pakai</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-range')
                        @include('farmasi.laporan.modals.components.form-sumber-dana')
                        @include('farmasi.laporan.modals.components.form-katalog')
                        @include('farmasi.laporan.modals.components.form-select-penyedia')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-realisasi" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-realisasi') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Realisasi</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-year')
                        <div class="form-group">
                            <label>Triwulan</label>
                            <select class="form-control js-select2" style="width: 100%" name="triwulan" id="triwulan" data-placeholder="Pilih Triwulan" required>
                                {{-- <option value="null"></option> --}}
                                <option value="all">Semua</option>
                                <option value="1">Triwulan I</option>
                                <option value="2">Triwulan II</option>
                                <option value="3">Triwulan III</option>
                                <option value="4">Triwulan IV</option>
                            </select>
                        </div>
                        @include('farmasi.laporan.modals.components.form-sumber-dana-ada-semua')
                        @include('farmasi.laporan.modals.components.form-select-kategori')
                        @include('farmasi.laporan.modals.components.form-radio-inklusi-eksklusi')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-laporan-bpk-penerimaan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-bpk-penerimaan') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan BPK Penerimaan</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-year')
                        @include('farmasi.laporan.modals.components.form-sumber-dana')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-laporan-bpk-pemakaian" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-bpk-pemakaian') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan BPK Pemakaian</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-year')
                        @include('farmasi.laporan.modals.components.form-sumber-dana')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal-laporan-bpk-sumber-dana" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/laporan-bpk-sumber-dana') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Laporan BPK Sumber Dana</h3>
                    </div>
                    <div class="block-content">
                        @include('farmasi.laporan.modals.components.form-date-year')
                        @include('farmasi.laporan.modals.components.form-sumber-dana')
                        <div class="export-as" id="form-group-ks"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary btn-square" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel" id="btn-excel-ks">
                        <i class="fa fa-file-excel-o"></i> Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>