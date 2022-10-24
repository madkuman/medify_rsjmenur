<div class="row item-wrapper">
    <div class="col-md-3">
        <div class="form-group">
            <select class="js-select2 form-control barang-select2" id="" name="barang" style="width: 100%;" data-placeholder="Pilih Barang">
                <option></option>
                @foreach($item as $data)
                    <option value="{{$data->id}}">{{$data->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="text" class="form-control" name="harga_satuan" placeholder="Harga Satuan">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="text" class="form-control" name="subtotal" placeholder="Subtotal">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="text" class="js-datepicker form-control datepicker" name="expired" placeholder="Tanggal Expired">
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
</div>