    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <form action="{{ url('farmasi/' . session('farmasi')->slug . '/transaksi/new') }}" method="POST"
                id="form-transaksi">
                {{ csrf_field() }}
                <input type="hidden" name="farmasi" value="{{ session('farmasi')->slug }}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Transaksi Obat Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Transaksi </label>
                                        <input type="text" class="js-datepicker form-control datepicker"
                                            name="tanggal_transaksi" placeholder="Pilih Tanggal" id="tanggal_transaksi"
                                            data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                            value="{{ date('d-m-Y', time()) }}" data-date-format="dd-mm-yyyy"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nomor Resep <small>(tidak wajib diisi)</small></label>
                                        <input type="text" class="form-control" id="nomor-resep" name="no_resep"
                                            placeholder="Nomor Resep">
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div class="row">
                                <div class="col-8 pt-10">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="radio" class="css-control-input status_pasien"
                                            name="status_pasien" data-waschecked="false" data-flag="1"> <span
                                            class="css-control-indicator"></span> Pasien Bebas
                                    </label>
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="radio" class="css-control-input status_pasien"
                                            name="status_pasien" data-waschecked="false" data-flag="2"> <span
                                            class="css-control-indicator"></span> Pasien Luar
                                    </label>
                                    <div class="form-group mt-10 pasien-div" id="nama-pasien-input">
                                        <label>Nama Pasien</label>
                                        <input type="text" class="form-control" id="text-pasien" name="nama_pasien"
                                            placeholder="Nama Pasien">
                                        <div id="pasien-rsal-select2">
                                            <select class="js-select2 form-control pasien-select2" id="pasien-form"
                                                name="pasien" style="width: 100%;" data-placeholder="Cari Pasien">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pasien-div">
                                        <div class="form-group">
                                            <label for="penyedia">Kasus </label>
                                            <select class="js-select2 form-control" id="kasus-select2" name="kasus"
                                                style="width: 100%;" data-placeholder="Pilih Kasus">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    @if (count(session('aturan_shift')))
                                        <div class="form-group row mx-0">
                                            <label class="col-12 pl-0">Shift</label>
                                            <select class="js-select2 form-control" name="shift" style="width: 100%">
                                                @foreach (session('aturan_shift') as $s)
                                                    <option value="{{ $s->id }}"
                                                        @if (session('farmasi')->current_shift_id == $s->id) selected @endif>
                                                        {{ $s->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <h6>Aturan Shift masih kosong, silahkan buat terlebih dahulu</h6>
                                    @endif

                                    @include('farmasi.transaksi.modals.components.dokter-create', [
                                        'id_radio' => 'baru',
                                    ])

                                    <div class="form-group pasien-div">
                                        <label>Nomor Antrian</label>
                                        <input type="text" class="form-control" id="nomor-antrian" name="no_antrian"
                                            placeholder="Nomor Antrian">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="histori-resep-container">
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5">
                            <div class="row" id="resepForm">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paket Obat</label> <i class="fa fa-spin fa-spinner text-info"
                                            id="loading-paket"></i>
                                        <br>
                                        <select class="form-control js-select2" id="selectPaket" data-width="100%"
                                            style="width: 100%" data-placeholder="Pilih Paket Obat">
                                            <option></option>
                                        </select>
                                        <hr>
                                    </div>
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Isi resep obat</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                                    <input class="custom-control-input" type="radio"
                                                        name="jenisObat" id="obatGenerik" value="generik" checked>
                                                    <label class="custom-control-label" for="obatGenerik">Obat
                                                        Generik</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                                    <input class="custom-control-input" type="radio"
                                                        name="jenisObat" id="racikan" value="racikan">
                                                    <label class="custom-control-label" for="racikan">Racikan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row d-none">
                                            <label for="penyedia">Tipe Obat </label>
                                            <select class="js-select2 form-control" id="satuan-select2"
                                                name="satuan[]" style="width: 100%;" data-placeholder="Pilih Satuan">
                                                @foreach ($tipe as $tip)
                                                    <option value="{{ $tip->nama }}">{{ $tip->nama }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-warning"></p>
                                        </div>
                                        <div id="obatForGenerik">
                                            <div class="form-group row">
                                                <h1 id="obat-generik" hidden></h1>
                                                <input type="hidden" class="form-control" id="harga-generik">
                                                <label for="penyedia">Obat </label>
                                                <select class="js-select2 form-control barang" id="namaObat"
                                                    name="barang[]" style="width: 100%;"
                                                    data-placeholder="Pilih Barang">
                                                    <option></option>
                                                </select>
                                                <p class="text-warning"></p>
                                            </div>
                                        </div>

                                        <div id="obatForRacikan" class="d-none">
                                            <div class="form-group row">
                                                <label>Racikan</label>
                                                <textarea class="form-control" id="textRacikan"></textarea>
                                                <p class="text-warning"></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="racikan-row">
                                                        <label>Nama Obat</label>
                                                        <div class="row racikan-obat-wrapper">
                                                            <h1 class="text-racikan" id="racikan-text-1" hidden></h1>
                                                            <input type="hidden" class="form-control harga-racikan"
                                                                id="harga-racikan-1">
                                                            <div class="col-md-7">
                                                                <select class="js-select2 form-control barang-racikan"
                                                                    id="racikan-select2-1" style="width: 100%;"
                                                                    data-placeholder="Pilih Barang">
                                                                    <option></option>
                                                                </select>
                                                                <p class="text-warning"></p>
                                                            </div>
                                                            <div class="col-md-3 px-1">
                                                                <input type="number" class="form-control jumlah-obat"
                                                                    id="jumlah" placeholder="Jumlah">
                                                                <p class="text-warning"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center pb-10" id="tambahRacikan">
                                                <button type="button"
                                                    class="btn btn-lg btn-circle btn-outline-primary"
                                                    id="btnAddRacikan">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @if (session('farmasi')->perharian)
                                            <div class="form-group row">
                                                <div class="col-md-3 px-1">
                                                    <label>Jumlah </label>
                                                    <input type="number" class="form-control" id="jumlah-obat"
                                                        placeholder="Jumlah" onchange="changeDukungan()">
                                                    <p class="text-warning"></p>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <label>7 hari</label>
                                                    <input type="number" class="form-control" id="hari-7"
                                                        placeholder="Jumlah" onchange="changeDukungan()">
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <label>23 Hari</label>
                                                    <input type="number" class="form-control" id="hari-23"
                                                        placeholder="Jumlah">
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <label>Duk RS</label>
                                                    <input type="number" class="form-control" id="dukungan-rs"
                                                        placeholder="Jumlah" onchange="changeDukungan()">
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group row">
                                                <label>Jumlah Obat</label>
                                                <input type="number" class="form-control" id="jumlahObat"
                                                    placeholder="Jumlah Obat">
                                                <p class="text-warning"></p>
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <label>Aturan Penggunaan</label>
                                            <select class="form-control" id="aturan-select2" name="aturan[]"
                                                style="width: 100%;" data-placeholder="Pilih Aturan Penggunaan">
                                                <option></option>
                                            </select>
                                            <p class="text-warning"></p>
                                        </div>
                                        <div class="form-group row d-none">
                                            <label>Satuan Penggunaan</label>
                                            <select class="js-select2 form-control" id="satuan-penggunaan-select2"
                                                name="satuan_penggunaan[]" style="width: 100%;"
                                                data-placeholder="Pilih Satuan Penggunaan">
                                                <option value=""></option>
                                            </select>
                                            <p class="text-warning"></p>
                                        </div>
                                        <div id="div-spinner" class="d-none text-center">
                                            <span class="fa fa-4x fa-spinner fa-spin text-info"></span>
                                        </div>
                                        <div id="editResepBtn" class="d-none">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-center pb-10">
                                                        <button type="button" class="btn btn-sm btn-square"
                                                            id="btn-cancel">
                                                            <i class="fa fa-times" aria-hidden="true"></i>&nbsp; Batal
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="text-center pb-10">
                                                        <button type="button"
                                                            class="btn btn-sm btn-success btn-square" id="btn-save">
                                                            <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center pb-10" id="tambahResepBtn">
                                            <button type="button" class="btn btn-sm btn-primary btn-square"
                                                id="btn-add">
                                                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Tambahkan Obat
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row" id="resep-wrapper">

                                    </div>
                                    <div class="py-30 text-center">
                                        <h2 class="h3 font-w400 text-muted mb-50" id="checkResep">Tidak Ada Resep Obat
                                            !</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <label class="css-control css-control-primary css-checkbox div-override-checkbox"
                            id="div-override-checkbox">
                            <input type="checkbox" class="override-checkbox css-control-input"
                                id="override-checkbox" />
                            <span class="css-control-indicator"></span> <strong>Abaikan Peringatan</strong>
                        </label>
                        <button type="button" class="btn btn-secondary btn-square"
                            data-dismiss="modal">Batalkan</button>
                        <button type="button" class="btn btn-primary btn-square" id="btnSubmit">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
