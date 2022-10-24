@foreach($po->detail as $detail)
<div class="row item-wrapper">
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control itemtemplate barang-select2" name="itemtemplate[]" style="width: 100%;" data-placeholder="Pilih Barang" readonly>
                    <option value="{{$detail->item_aset_id}}" data-price="{{$detail->harga}}" selected="">
                        {{$detail->deskripsi}}
                    </option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <input type="number" class="form-control total_price" name="total_price[]" placeholder="Harga Satuan" value="{{$detail->harga}}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <input type="number" step="any" class="form-control jumlah" name="jumlah[]" placeholder="Jumlah" required value="{{$detail->jumlah - $detail->jumlah_processed}}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <input type="number" class="form-control subtotal" name="subtotal[]" placeholder="Subtotal" readonly value="">
        </div>
    </div>
</div>
@endforeach