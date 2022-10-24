<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Buat @yield('menu') Baru</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{date('d-m-Y', time())}}">
                <small class="text-danger hide" id="error_main_tanggal">Tidak Boleh Kosong</small>
            </div>
            <div class="col-6" id="input-judul-container">
                <label>Judul @yield('menu')</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Penerimaan">
                <small class="text-danger hide" id="error_judul_kosong">Tidak Boleh Kosong</small>
            </div>
            <div class="col-3" id="input-kasir-container">
                <label>Kasir ID</label>
                <input type="text" class="form-control" id="kasir_id" name="kasir_id" placeholder="" value="{{$kasir_id ?? ''}}" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-pihak3-container">
                <label>Penanggung Jawab Pembayaran</label>
                <input type="text" class="form-control" id="pihak3" name="pihak3" placeholder="Masukkan Nama Penanggung Jawab Pembayaran">
                <small class="text-danger hide" id="error_pihak_3_kosong">Tidak Boleh Kosong</small>
            </div>
            <div class="col-3" id="input-pasien-container">
                <label>Pasien</label>
                <select class="js-select2 form-control" id="pasien" name="pasien" style="width: 100%;">
                </select>
            </div>
            <div class="col-3" id="input-pasien-pembayaran-container">
                <label>Jenis Pembayaran <i class="fa fa-spin fa-spinner text-primary" style="display: none" id="pasien_pembayaran_loading"></i></label>
                <select class="js-select2 form-control" id="pasien-pembayaran" name="pasien-pembayaran" style="width: 100%;" data-placeholder="Pilih Jenis Pembayaran">
                </select>
            </div>
            <div class="col-3">
                <label>Perusahaan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                    <option></option>
                    @foreach($perusahaan as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
                <small class="text-danger hide" id="error_perusahaan_kosong">Tidak Boleh Kosong</small>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-pasien-pembayaran-container">
                <label>Lokasi</label>
                <select class="js-select2 form-control" id="lokasi" name="lokasi" style="width: 100%;" data-placeholder="Pilih Lokasi">
                    <option selected value="0"></option>
                    @foreach($lokasi as $item)
                    <option value="{{$item->id}}" data-kategori="{{$item->kategori_keuangan_id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
                <small class="text-danger hide" id="error_lokasi_kosong">Tidak Boleh Kosong</small>
            </div>
            <div class="col-3">
                <label>Kategori</label>
                <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori Transaksi">
                    <option></option>
                    @foreach($kategori as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <small class="text-danger hide" id="error_kategori_kosong">Tidak Boleh Kosong</small>
            </div>
            <div class="col-12">
                <hr>                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary" id="btnOpen"><i class="fa fa-plus"></i>Transaksi</button>
                <hr>         
            </div>
            <div class="col-12">
                <table class="main-table table table-hover table-striped table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 19%;">Deskripsi Transaksi</th>
                            <th style="width: 10%;">Keterangan</th>
                            <th class="text-center" style="width: 9%;">Jumlah</th>
                            <th class="text-right" style="width: 12%;">Harga</th>
                            <th class="text-center" style="width: 9%;">Diskon</th>
                            <th class="text-right" style="width: 18%;">SubTotal</th>
                            <th class="text-right" style="width: 7%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="emptyTable">
                            <td colspan="8" class="text-center"><h4 class="mb-0 mt-10">Tidak Ada Transaksi</h4><br>Klik <strong>Tambah Transaksi</strong> untuk menambahkan data</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
            <div class="col-12">
                <table class="table table-borderless table-vcenter">
                    <tbody>
                        <tr>
                            <td style="width: 80%" class="text-right">Jumlah</td>
                            <td class="text-right  "  style="width: 20%" id="allJumlah">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right">Diskon</td>
                            <td class="text-right "  style="width: 20%" id="allDiskon">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right font-w700">Total</td>
                            <td class="text-right font-w700"  style="width: 20%" id="allTotal">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 60%" class="text-right font-w700"></td>
                            <td class="text-right font-w700"  style="width: 40%" id="allTotal">
                                <button class="btn btn-success btn-hero btn-block" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                                <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                                    <i class="fa fa-asterisk fa-spin"></i> Loading
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>