
<div class="row form-resep">
    <div class="col-lg-6">
        <div class="form-group row">
            <label class="col-12">Kategori</label>
            <div class="col-12">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input kategori-radio-generik" id="kategori-radio-generik{{$extra_id}}" name="kategori" value="generik" checked>
                    <label class="custom-control-label" for="kategori-radio-generik{{$extra_id}}">Obat Generik/Paten</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input kategori-radio-racikan" id="kategori-radio-racikan{{$extra_id}}" name="kategori" value="racikan">
                    <label class="custom-control-label" for="kategori-radio-racikan{{$extra_id}}">Racikan</label>
                </div>
            </div>
        </div>
        <div class="racikan">
            <div class="form-group row ">
                <label class="col-12" for="example-select">Tipe</label>
                <div class="col-md-12">
                    <select class="js-select2 form-control obat-tipe-racikan" style="width:100%;">
                        <option value="" disabled="" selected="">Pilih Tipe Obat</option>
                        @foreach($tipe_obat as $item)
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row" id="resep-racikan">
                <label class="col-12" for="">Racikan</label>
                <div class="col-12">
                    <textarea class="form-control form-control-lg obat-nama-racikan" name="obat-nama-racikan" rows="3" placeholder=""></textarea>
                </div>
            </div>
            <!-- ||| -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group racikan-row" id="racikan-row">
                        <label>Nama Obat <i id="" class="obatLoading fa fa-asterisk fa-spin text-info"></i></label>
                        <div class="row racikan-wrapper">
                            <input type="hidden" class="form-control obat-harga-racikan" id="harga-racikan-1">
                            <input type="hidden" class="form-control obat-id-racikan" id="id-racikan-1">
                            <div class="col-md-7">
                                <input type="text" class="resep-autocomplete form-control form-control-lg obat-barang-racikan" id="barang-racikan-1" name="obat-barang-racikan[]" placeholder="" value="">
                            </div>
                            <div class="col-md-3 px-1">
                                <input type="number" class="form-control obat-jumlah-racikan" id="jumlah-racikan-1" placeholder="Jumlah">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center pb-10" id="tambahRacikan">
                <button type="button" class="btn btn-lg btn-circle btn-outline-primary btn-add-racikan" id="btnAddRacikan">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="generik">
            <div class="form-group row">
                <div class="col-md-8">
                    <label >Tipe Obat</label>
                    <input type="text" class="form-control form-control-lg obat-tipe-generik" placeholder="Otomatis" readonly>
                </div>
                <div class="col-md-4">
                    <label>Kode Obat</label>
                    <input type="text" name="obat-id-generik" class="form-control form-control-lg obat-id-generik" placeholder="Otomatis" readonly>
                </div>
            </div>

            <div class="form-group row generik" id="resep-obat" style="">
                <label class="col-12" for="">Obat <i id="" class="obatLoading fa fa-asterisk fa-spin text-info"></i></label>
                <input type="hidden" class="form-control obat-harga-generik" id="harga-generik">
                <div class="col-12">
                    <input type="text" class="resep-autocomplete form-control form-control-lg obat-nama-generik" name="nama-obat" placeholder="" value="">
                </div>
            </div>
        </div>
        @if(session('farmasi')->perharian)
        <div class="form-group row">
            <div class="col-6">
                <label>Jumlah </label>
                <input type="number" class="form-control form-control-lg obat-jumlah" id="jumlah-obat" placeholder="Jumlah">
                <p class="text-warning"></p>
            </div>
            <div class="col-6">
                <label>7 hari</label>
                <input type="number" class="form-control form-control-lg obat-jumlah-hari-7" id="hari-7" placeholder="Jumlah">
            </div>
            <div class="col-6">
                <label>23 Hari</label>
                <input type="number" class="form-control form-control-lg obat-jumlah-hari-23" id="hari-23" placeholder="Jumlah">
            </div>
            <div class="col-6">
                <label>Duk RS</label>
                <input type="number" class="form-control form-control-lg obat-jumlah-dukungan-rs" id="dukungan-rs" placeholder="Jumlah">
            </div>
        </div>
        @else
        <div class="form-group row">
            <label class="col-12" for="">Jumlah Obat</label>
            <div class="col-12">
                <input type="number" class="form-control form-control-lg obat-jumlah" name="jumlah" placeholder="" value="">
            </div>
        </div>
        @endif

        <div class="form-group row" id="">
            <label class="col-12" for="">Aturan Penggunaan</label>
            <div class="col-12">
                <select class="js-select2 form-control form-control-lg obat-aturan" id="aturan-select2" name="aturan" style="width: 100%;" data-placeholder="Pilih Aturan Penggunaan">
                    @foreach($aturan as $item)
                    <option value="{{$item->nama}}">{{$item->nama}}</option>
                    @endforeach
                </select>
                <!-- <input type="text" class="form-control form-control-lg obat-aturan" name="aturan" placeholder="" value=""> -->
            </div>
        </div>

        <div class="form-group row d-none">
            <label class="col-12" for="">Satuan Penggunaan</label>
            <div class="col-12">
                <select class="js-select2 form-control form-control-lg obat-satuan-penggunaan" id="satuan-penggunaan-select2" name="satuan_penggunaan" style="width: 100%;" data-placeholder="Pilih Satuan Penggunaan">
                    <option value=""></option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div id="div-spinner" class="d-none col-12">
                <div class="text-center">
                    <span class="fa fa-4x fa-spinner fa-spin text-info"></span>
                </div>
            </div>
            <div id="tambah-button" class="col-12">
                <button type="button" class="btn btn-success mr-5 mb-5 button-tambah-obat">
                    <i class="fa fa-plus mr-5"></i>Tambahkan ke Resep
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group row ">
            <label class="col-12">Daftar Obat Pada Resep</label>
            <div class="col-12"><hr></div>
            <div class="daftar-obat col-12"></div>
        </div>
    </div>
</div>