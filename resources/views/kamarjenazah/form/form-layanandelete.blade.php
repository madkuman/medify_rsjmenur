<h5 class="uppercase">Penghapusan Layanan
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
</div>
