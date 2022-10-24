<div class="row item-wrapper">
    <div class="col-md-3">
        <div class="form-group">
            <select class="js-select2 form-control itemtemplate barang-select2" name="itemtemplate[]" style="width: 100%;" data-placeholder="Pilih Barang" required>
                @foreach($itemstemplate as $list)
                    <option value="{{$list->id}}" data-price="{{$list->price}}">
                        {{$list->name." - ".$list->merk." - ".$list->model}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <input type="number" class="form-control total_price" name="total_price[]" placeholder="Harga Satuan" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="number" step="any" class="form-control jumlah" name="jumlah[]" placeholder="Jumlah" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <input type="number" class="form-control subtotal" name="subtotal[]" placeholder="Subtotal" readonly>
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

