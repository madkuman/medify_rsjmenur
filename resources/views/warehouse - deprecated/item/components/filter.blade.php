<div class="card border">
        <div class="header">
            <h6>Filter</h6>
        </div>
        <div class="container-fluid">
            <div class="form-container">
                <label>Cari Barang</label>
                <input type="text" class="form-control" id="searchBar" placeholder="Cari" name="key" value="{{old('key')}}" onkeyup="searchCallback()">
            </div>
            <hr>
            <div class="form-container">
                <label>Tipe Barang</label>
                <label class="checkbox" for="checkbox1">
                    <input name="obat" type="checkbox" value="true" id="checkbox1" data-toggle="checkbox" onkeyup="searchCallback()"
                    @if(old('obat'))
                        checked
                    @endif 
                    >
                    Obat
                </label>
                <label class="checkbox" for="checkbox2">
                    <input name="alat" type="checkbox" value="true" id="checkbox2" data-toggle="checkbox" onkeyup="searchCallback()"
                    @if(old('alat'))
                        checked
                    @endif>
                    Alat Kesehatan
                </label>
            </div>
            <hr>
            <div class="form-container">
                <label>Jumlah</label>
                <input name="qty_min" type="number" placeholder="Minimal" class="form-control" id="minQty" value="{{old('qty_min')}}" onkeyup="searchCallback()">
                <input name="qty_max" type="number" placeholder="Maximal" class="form-control" id="maxQty" style="margin-top:5px" value="{{old('qty_max')}}" onkeyup="searchCallback()">
            </div>
            <hr>
            <div class="form-container">
                <label>Harga</label>
                <input value="{{old('price_min')}}" name="price_min" type="number" placeholder="Minimal" class="form-control" id="minPrice" onkeyup="searchCallback()">
                <input value="{{old('price_max')}}" name="price_max" type="number" placeholder="Maximal" class="form-control" id="maxPrice" style="margin-top:5px" onkeyup="searchCallback()">
            </div>
            <div class="row">
                <button class="btn btn-primary" onclick="previousPage()"><<</button> 
                <button class="btn btn-primary" onclick="nextPage()">>></button>
            </div>
        </div>
    
</div>
</div>