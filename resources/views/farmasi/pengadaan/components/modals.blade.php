<div class="modal" id="addPenerimaanModal" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan')}}/new" id=form-pengadaan>
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">{{session('farmasi')->jenis_detail->nama != 'Gudang' ? "Pengadaan" : "Penerimaan"}} Baru</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Penyedia</label>
                                    <div>
                                        <select class="js-select2 form-control" id="peyedia-select2" name="peyedia" style="width: 100%;" data-placeholder="Pilih Penyedia" readonly>
                                            <option></option>
                                            @foreach($supplier as $supp)
                                                <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Faktur</label>
                                    <input type="text" class="form-control" name="nomor_referensi" placeholder="Isi Nomor Referensi Kwitansi" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Surat Jalan</label>
                                    <input type="text" class="form-control" name="nomor_surat" placeholder="Isi Nomor Surat Jalan" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Sumber Dana</label>
                                    <div>
                                        <select class="js-select2 form-control" id="sumber-dana-select2" name="sumber_dana_id" style="width: 100%;" data-placeholder="Pilih Sumber Dana">
                                            <option></option>
                                            @foreach($sumber_dana as $supp)
                                                <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Berikan Informasi Lebih" autocomplete="off" id="keterangan_penerimaan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penyedia">Tanggal Penerimaan</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control" id="datepicker1" name="tanggal_transaksi" placeholder="Masukkan Tanggal Penerimaan" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Tanggal Faktur</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker"  name="tanggal_faktur" placeholder="Masukkan Tanggal Faktur" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Tanggal Surat Jalan</label>
                                    <div>
                                        <input type="text" class="js-datepicker form-control tanggal-datepicker" name="tanggal_surat_jalan" placeholder="Masukkan Tanggal Surat Jalan" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Katalog</label>
                                    <div>
                                        <select class="js-select2 form-control" id="katalog-select2" name="katalog_id" style="width: 100%;" data-placeholder="Pilih Katalog">
                                            <option></option>
                                            @foreach($katalog as $supp)
                                                <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="table-responsive">
                            <table class="table my-0 pengadaan-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="min-width: 210px; position:sticky; left:0px;">Barang</th>
                                        <th class="text-center" style="min-width: 150px">Harga Beli Sebelumnya</th>
                                        <th class="text-center" style="min-width: 100px">Jumlah Besar</th>
                                        <th class="text-center" style="min-width: 100px">Jumlah Kecil</th>
                                        <th class="text-center" style="min-width: 110px">Diskon (%)</th>
                                        <th class="text-center" style="min-width: 140px">PPN (%)</th>
                                        <th class="text-center" style="min-width: 150px">Harga Per Box</th>
                                        <th class="text-center" style="min-width: 150px">Harga Satuan</th>
                                        <th class="text-center" style="min-width: 150px">Subtotal</th>
                                        <th class="text-center" style="min-width: 150px">Kadaluarsa</th>
                                        <th class="text-center" style="min-width: 150px">Produsen</th>
                                        <th class="text-center" style="min-width: 100px">Batch</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="newItem">
                                    <tr class="item-row item-wrapper">
                                        @include('farmasi.pengadaan.components.form-add-pengadaan', ['index' => 1, 'checked_ppn' => 'checked'])
                                    </tr>
                                </tbody>
                            </table>             
                        </div>
                        <div class="mt-3 mb-3 pb-2" id="loader">
                            <center>
                                <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddItems">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <center class="d-none" id="spinner"><i class="fa fa-2x fa-asterisk fa-spin text-info"></i></center>
                            </center>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total Sebelum PPN</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total-belum-ppn"></h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total Diskon</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total-diskon"></h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total PPN</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total-ppn"></h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-auto text-right"><h5 class="mb-5">Total Akhir</h5></div>
                            <div class="col-md-1 text-right"><h5 class="mb-5">Rp</h5></div>
                            <div class="col-md-2 text-right"><h5 class="mb-5" id="total"></h5></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square" id="btnSimpan">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>