
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
                <label class="col-12">Tipe</label>
                <div class="col-md-9">
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
                <div class="col-12">
                    <input type="text" class="resep-autocomplete form-control form-control-lg obat-nama-generik" name="nama-obat" placeholder="" value="">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12" for="">Jumlah Obat</label>
            <div class="col-12">
                <input type="number" class="form-control form-control-lg obat-jumlah" name="jumlah" placeholder="" value="">
            </div>
        </div>

        <div class="form-group row" id="">
            <label class="col-12" for="">Aturan Penggunaan</label>
            <div class="col-12">
                <textarea class="aturan-autocomplete form-control form-control-lg obat-aturan" name="aturan" placeholder=""></textarea>
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