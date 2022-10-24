<div class="modal pl-0 pr-0" id="modal-transaksi-kemoterapi">
    <div class="modal-dialog modal-full" role="document">
        <form action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/new')}}" method="POST" id="form-kemo">
            {{csrf_field()}}
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <input type="hidden" name="is_kemo" value="true">
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
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_transaksi" placeholder="Pilih Tanggal" id="tanggal_transaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y', time())}}" data-date-format="dd-mm-yyyy" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nomor Resep <small>(tidak wajib diisi)</small></label>
                                    <input type="text" class="form-control" id="" name="no_resep" placeholder="Nomor Resep">
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-group pt-10">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input is_repack" name="is_repack"> <span class="css-control-indicator"></span> Repacking
                                    </label>
                                </div>
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="radio" class="css-control-input status_pasien" name="status_pasien" data-waschecked="false" data-flag="1"> <span class="css-control-indicator"></span> Pasien Bebas
                                </label>
                                <label class="css-control css-control-lg css-control-primary css-checkbox">
                                    <input type="radio" class="css-control-input status_pasien" name="status_pasien" data-waschecked="false" data-flag="2"> <span class="css-control-indicator"></span> Pasien Luar
                                </label>
                                <div class="form-group mt-10 pasien-div" id="nama-pasien-input">
                                    <label>Nama Pasien</label>
                                    <input type="hidden" class="form-control" id="text-pasien" name="nama_pasien" placeholder="Nama Pasien">
                                    <div id="pasien-rsal-select2">
                                        <select class="js-select2 form-control pasien-select2" id="pasien-form-kemo" name="pasien" style="width: 100%;" data-placeholder="Cari Pasien">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pasien-div">
                                    <div class="form-group">
                                        <label for="penyedia">Kasus </label>
                                        <select class="js-select2 form-control" id="kasus-kemo-select2" name="kasus" style="width: 100%;" data-placeholder="Pilih Kasus">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                @if(count(session('aturan_shift')))
                                    <div class="form-group row mx-0">
                                        <label class="col-12 pl-0">Shift</label>
                                        <select class="js-select2 form-control" name="shift" style="width: 100%">
                                            @foreach(session('aturan_shift') as $s)
                                                <option value="{{$s->id}}" @if(session('farmasi')->current_shift_id == $s->id) selected @endif>{{$s->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <h6>Aturan Shift masih kosong, silahkan buat terlebih dahulu</h6>
                                @endif

                                @include('farmasi.transaksi.modals.components.dokter-create',['id_radio' => 'baru'])

                                <div class="form-group pasien-div">
                                    <label>Nomor Antrian</label>
                                    <input type="text" class="form-control" id="" name="no_antrian" placeholder="Nomor Antrian">
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">

                        <div class="row">
                            <div class="col-6">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Isi resep obat</h3>
                                </div>
                                <div class="block-content">
                                    <input type="hidden" class="input" name="count" value="0" id="counter_kemo">
                                    <input type="hidden" class="input" name="" value="0" id="check_resep_id_kemo">
                                    <input type="hidden" class="input" name="" value="false" id="is_edit_kemo">
                                    <div class="form-group row">
                                        <label for="penyedia">Tipe Obat </label>
                                        <select class="js-select2 form-control" id="tipe_kemo" name="" style="width: 100%;" data-placeholder="Pilih Satuan">
                                            @foreach($tipe as $tip)
                                            <option value="{{$tip->nama}}">{{$tip->nama}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-warning"></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 px-0">
                                            <div class="form-group" id="kemo-row">
                                                <label>Obat</label>
                                                <div class="row kemo-obat-wrapper">
                                                    <h1 class="text-kemo" id="kemo-text-1" hidden></h1>
                                                    <input type="hidden" class="form-control harga-kemo" id="harga-kemo-1">
                                                    <div class="col-7">
                                                        <select class="js-select2 form-control barang-kemo barang-kemo-racik" id="kemo-select2-1" style="width: 100%;" data-placeholder="Pilih Barang">
                                                            <option></option>
                                                        </select>
                                                        <p class="text-warning"></p>
                                                    </div>
                                                    <div class="col-2 pr-0">
                                                        <input type="number" class="form-control jumlah-obat-kemo" id="jumlah-kemo" placeholder="Jumlah Amp/Vial">
                                                        <p class="text-warning"></p>
                                                    </div>
                                                    <div class="col-2 pr-0">
                                                        <input type="number" class="form-control volume-obat-kemo" id="volume-kemo" placeholder="Volume Amp/Vial (mg)">
                                                        <p class="text-warning"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pb-10" id="tambahKemo">
                                        <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddKemo">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>

                                    <div class="form-group row">
                                        <label>Dosis yang dibutuhkan</label>
                                        <input type="number" class="form-control" id="dosis_kemo" placeholder="Dosis yang dibutuhkan">
                                        <p class="text-warning"></p>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-6 pl-0">
                                            <label for="penyedia">Cara Pemberian</label>
                                            <select class="js-select2 form-control" id="cara_pemberian" name="" data-tags="true" style="width: 100%;">
                                                <option value="IV Drip">IV Drip</option>
                                                <option value="IV Bolus">IV Bolus</option>
                                                <option value="IV Pump">IV Pump</option>
                                            </select>
                                        </div>
                                        <div class="col-6 pr-0">
                                            <label for="penyedia">Lama Pemberian</label>
                                            <select class="js-select2 form-control" id="lama_pemberian" name="" data-tags="true" style="width: 100%;">
                                                <option value="30 Menit">30 Menit</option>
                                                <option value="2 jam">2 jam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6 pl-0">
                                            <label for="penyedia">Nama Infus</label>
                                            <div style="width: 100%;">
                                                <select class="js-select2 form-control barang-kemo" id="nama-infus" style="width: 100%;" data-placeholder="Pilih Infus">
                                                    <option></option>
                                                </select>
                                                <p class="text-warning"></p>
                                            </div>
                                        </div>
                                        <div class="col-2 pr-0">
                                            <label for="penyedia">Jumlah Infus</label>
                                            <input type="number" class="form-control" id="jumlah_infus" name="" placeholder="Jumlah Infus">
                                        </div>
                                        <div class="col-2 pr-0">
                                            <label for="penyedia">Vol Infus</label>
                                            <input type="text" class="form-control" id="volume_infus" name="" placeholder="Vol Infus">
                                        </div>
                                        <div class="col-2 pr-0">
                                            <label for="penyedia">Vol Pelarut</label>
                                            <input type="text" class="form-control" id="volume_pelarut" name="" placeholder="Vol Pelarut">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-6 pl-0">
                                            <label for="penyedia">Nama Dagang</label>
                                            <input type="text" class="form-control" id="dagang" name="" placeholder="Nama Dagang">
                                        </div>
                                        <div class="col-6 pr-0">
                                            <label for="penyedia">Pabrik</label>
                                            <input type="text" class="form-control" id="pabrik" name="" placeholder="Pabrik">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-6 pl-0">
                                            <label for="penyedia">No. Batch</label>
                                            <input type="text" class="form-control" id="batch" name="" placeholder="No Batch">
                                        </div>
                                        <div class="col-6 pr-0">
                                            <label for="penyedia">Exp. Date</label>
                                            <input type="text" class="js-datepicker form-control datepicker" name="exp_date" placeholder="Pilih Tanggal" id="exp_date_kemo" data-week-start="1" data-autoclose="true" data-today-highlight="true"  data-date-format="dd-mm-yyyy" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 pl-0">
                                            <label for="penyedia">Kondisi Penyimpanan</label>
                                        </div>
                                        <div class="col-6 pl-0">
                                            <select class="js-select2 form-control" id="kondisi" name="" style="width: 100%;">
                                                <option value="Suhu Ruangan">Suhu Ruangan</option>
                                                <option value="Suhu Lemari es">Suhu Lemari es</option>
                                            </select>
                                        </div>
                                        <div class="col-6 pr-0">
                                            <select class="js-select2 form-control" id="penyimpanan" name="" style="width: 100%;">
                                                <option value="Tempat Terang">Tempat Terang</option>
                                                <option value="Terlindung Cahaya">Terlindung Cahaya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 pl-0">
                                            <label for="penyedia">Stabilitas</label>
                                        </div>
                                        <div class="col-6 pl-0">
                                            <select class="js-select2 form-control" id="stabilitas_time" name="" style="width: 100%;" data-tags="true">
                                                <option value="8 Jam">8 Jam</option>
                                                <option value="4 Jam">4 Jam</option>
                                                <option value="12 Jam">12 Jam</option>
                                            </select>
                                        </div>
                                        <div class="col-6 pr-0">
                                            <input type="text" class="js-datepicker form-control datepicker" name="stabilitas_date" placeholder="Pilih Tanggal" id="stabilitas_date" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off">
                                        </div>
                                    </div>

                                    {{-- <div id="div-spinner" class="d-none text-center">
                                        <span class="fa fa-4x fa-spinner fa-spin text-info"></span>
                                    </div> --}}
                                    <div id="editResepBtn" class="">
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-center pb-10 d-none">
                                                    <button type="button" class="btn btn-sm btn-square" id="btn-cancel">
                                                        <i class="fa fa-times" aria-hidden="true"></i>&nbsp; Batal
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="text-center pb-10 d-none">
                                                    <button type="button" class="btn btn-sm btn-success btn-square" id="">
                                                        <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pb-10" id="">
                                        <button type="button" class="btn btn-sm btn-primary btn-square mt-20" id="btn-add-kanker">
                                            <i class="fa fa-plus mr-2" aria-hidden="true"></i> Tambahkan Obat
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row" id="">
                                    <div class="col-12 resep-jadi" id="resep-jadi">
                                        
                                    </div>
                                </div>
                                {{-- <div class="py-30 text-center">
                                    <h2 class="h3 font-w400 text-muted mb-50" id="">Tidak Ada Resep Obat !</h2>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square" id="">
                       <i class="fa fa-save"></i> Simpan
                   </button>
               </div>
           </div>
       </form>
   </div>
</div>