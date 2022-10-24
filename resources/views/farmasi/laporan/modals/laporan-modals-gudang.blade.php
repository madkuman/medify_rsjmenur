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

                            <div class="export-as" id="form-group-ks"></div>
                        </div>
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
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tanggal" placeholder="Tanggal" id="tanggal" autocomplete="off">
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
                        <div class="export-as" id="form-group-rn"></div>
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

<div class="modal" id="modal-penerimaan" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="GET" action="{{ url('farmasi/'.session('farmasi')->slug.'/laporan/penerimaan-gudang') }}" target="_blank">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pilih Tanggal</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label for="penyedia">TANGGAL </label>
                            <input type="text" class="js-datepicker form-control datepicker" name="tgl_awal" placeholder="Tanggal Awal" id="tanggal_awal" autocomplete="off">
                            <input type="text" class="js-datepicker form-control mt-2 datepicker" name="tgl_akhir" placeholder="Tanggal Akhir" id="tanggal_akhir" autocomplete="off">
                        </div>
                        <div class="export-as" id="form-group-rn"></div>
                    </div>
                    <div class="col">
                        <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-danger btn-square btn-pdf">
                        <i class="fa fa-file-pdf-o"></i> Export Pdf
                    </button>
                    <button type="submit" class="btn btn-alt-success btn-square btn-excel d-none">
                        <i class="fa fa-file-excel-o"></i> Export Excel
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
                        <div class="export-as" id="form-group-ks"></div>
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
                    </div>
                    <div class="col">
                        <p class="text-warning txt-date d-none">Mohon Isi Tanggal Dengan Benar</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary" id="btn-simpan">
                        <i class="fa fa-check"></i> Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>