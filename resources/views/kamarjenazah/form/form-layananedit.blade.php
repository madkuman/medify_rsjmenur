<h5 class="uppercase">Edit Layanan
    <hr>
</h5>
<div class="row">

    <div class="col-6">
      <div class="row justify-content-center">
          <div class="col-md-12 ">
              <div class="form-group">
                  <label class="control-label">Pilih Layanan</label>
                  <select  id="selectLayanan" name="layanan" class="form-control" style="width: 100%;" data-size="2">
                      @foreach($form['layanan'] as $item)
                      <option value="{{$item->id}}">{{$item->nama_layanan}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
      </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Nama Layanan baru*</label>
                    <input class="form-control" type="text" value="" name="namaLayanan" id="namaLayanan" placeholder="Contoh : Memandikan Jenazah" />
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Harga Layanan baru*</label>
                    <input class="form-control" type="text" value="" name="hargaLayanan" id="hargaLayanan" placeholder="Contoh : 150000" />
                </div>
            </div>
        </div>
    </div>
