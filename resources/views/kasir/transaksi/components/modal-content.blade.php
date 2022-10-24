
<div class="modal-body">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control deskripsi js-autocomplete ">
                <input class="d-none departemen_id" name="departemen_id">
                <small class="deskripsi-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
        
        <div class="col-3">
            <div class="form-group">
                <label>Tarif ID</label>
                <input type="text" class="form-control tarif_id" readonly="">
            </div>
        </div>
    </div>
    <div class="row tarif_container">
        <div class="col-3" id="input-pasien-pembayaran-container">
            <div class="form-group">
                <label>Lokasi</label>
                <select class="js-select2 form-control lokasi" style="width: 100%;" data-placeholder="Pilih Lokasi">
                </select>
                <input class="d-none lokasi_kategori_id">
                <small class="lokasi-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Kategori</label><br>
                <select class="form-control js-select2 kategori" style="width: 100%" data-placeholder="Pilih Kategori">
                    <option selected value="0"></option>
                    @foreach($kategori as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <small class="kategori-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Tipe</label><br>
                <select class="form-control js-select2 tipe" style="width: 100%">
                    <option selected value="0">Pilih Tipe</option>
                </select>
                <small class="tarif-tipe-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Kelas</label>
                <select class="form-control js-select2 kelas_id"  style="width: 100%">
                    <option selected value="0">Pilih Kelas</option>
                </select>
                <input class="d-none kelas" name="kelas">
                <small class="tarif-kelas-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label>Harga Satuan</label>
                <input type="number" class="form-control harga_satuan">
                <small class="harga-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control jumlah">
                <small class="jumlah-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Diskon</label>
                <input type="number" class="form-control diskon">
                <small class="diskon-error text-danger hide">Input Tidak Valid</small>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Subtotal</label>
                <input type="number" class="form-control subtotal" readonly="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <label>Keterangan</label>
            <textarea class="form-control keterangan"></textarea>
        </div>
        <div class="col-4">
            <label>ID</label>
            <input type="text" class="form-control id" readonly="">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary submitBtn">Submit</button>
</div>