<h5 class="uppercase">Pembuatan Transaksi RM#{{$pasien['identitas']['id']}}
    <hr>
</h5>
<div class="row">
  <div class="col-12">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group col-md-8">
              <input type="hidden" id="id_permintaan" value="{{$permintaan}}">
                <label class="control-label">- Menggunakan pelayanan jenazah? -</label>
                <div class="custom-control custom-radio mb-5">
                    <input class="custom-control-input" type="radio" name="jenispelayanan" id="jenisya" value="1" onchange="changePelayanan(1)">
                    <label class="custom-control-label"  for="jenisya">Ya</label>
                </div>
                <div class="custom-control custom-radio mb-5">
                    <input class="custom-control-input" type="radio" name="jenispelayanan" id="jenistidak" value="0" onchange="changePelayanan(0)">
                    <label class="custom-control-label"  for="jenistidak">Tidak</label>
                </div>
            </div>
            <div id="divlayanan" >
              <div class="form-group col-md-8" style="margin-top:20px;">
                  <label class="control-label">- Penyakit Jenazah -</label>
                  <div class="custom-control custom-radio mb-5">
                      <input class="custom-control-input layanan" type="radio" name="jenispenyakit" id="menular" value="2" onchange="changePenyakit(2)">
                      <label class="custom-control-label"  for="menular">Menular</label>
                  </div>
                  <div class="custom-control custom-radio mb-5">
                      <input class="custom-control-input layanan" type="radio" name="jenispenyakit" id="tidakmenular" value="0" onchange="changePenyakit(0)">
                      <label class="custom-control-label"  for="tidakmenular">Tidak menular</label>
                  </div>
                  <input type="hidden" value="{{$pasien['identitas']['id']}}" id="idJenazah">
              </div>
            <div class="row col-md-12" id="div-tidakmenular">
              <div class="col-12">
                <label class="control-label">Pilihan layanan</label>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      @foreach($form['layanan'] as $detail)
                        @if($detail->kategori === 0)
                        <div class="row col-md-12">
                        <label class="css-control-primary css-checkbox">
                            <input type="checkbox" class="css-control-input checkLayananNormal layanan" id="{{$detail->id}}" value="{{$detail->id}}" checked>
                            <span class="css-control-indicator"></span>{{$detail->nama_layanan}}
                        </label>
                      </div>
                        @endif
                      @endforeach
                    </div>
                  </div>
              </div>
              <!-- <div class="col-2">
                <label class="control-label"></label>
                <div class="col-md-12">
                  @foreach($form['layanan'] as $detail)
                    @if($detail->kategori === 0)
                    <div class="row col-md-12">
                      <label class="css-control-primary">
                      Rp.{{number_format($detail->harga_layanan)}}
                      </label>
                    </div>
                    @endif
                  @endforeach
                </div>
              </div> -->
            </div>
            <div class="row col-md-12" id="div-menular">
              <div class="col-12">
                <label class="control-label">Pilihan Layanan</label>
                  <div class="row mb-12">
                    <div class="col-md-12">
                      @foreach($form['layanan'] as $detail)
                        @if($detail->kategori === 0 || $detail->kategori === 2)
                        <div class="row col-md-12">
                          <label class="css-control-primary css-checkbox">
                              <input type="checkbox" class="css-control-input checkLayananMenular layanan" id="{{$detail->id}}" value="{{$detail->id}}" checked>
                              <span class="css-control-indicator"></span>{{$detail->nama_layanan}}
                          </label>
                        </div>
                        @endif
                      @endforeach
                    </div>
                  </div>
              </div>
              <!-- <div class="col-2">
                <label class="control-label"></label>
                <div class="col-md-12">
                  @foreach($form['layanan'] as $detail)
                    @if($detail->kategori === 0 || $detail->kategori === 2)
                    <div class="row col-md-12">
                      <label class="css-control-primary">
                      Rp.{{number_format($detail->harga_layanan)}}
                      </label>
                  </div>
                    @endif
                  @endforeach
                </div>
              </div> -->
            </div>
                <div class="row col-md-12" id="div-peti" style="margin-top:20px;">
                      <div class="col-10">
                        <label class="control-label">- Pilihan Peti -</label>
                          <div class="row mb-12">
                            <div class="col-md-12">
                              @foreach($form['layanan'] as $detail)
                                @if($detail->kategori === 4)
                                <div class="custom-control custom-radio mb-5">
                                    <input class="custom-control-input layanan" type="radio" name="jenispeti" id="{{$detail->id}}" value="{{$detail->id}}" onchange="changePeti({{$detail->id}})">
                                    <label class="custom-control-label"  for="{{$detail->id}}">{{$detail->nama_layanan}}</label>
                                </div>
                                @endif
                              @endforeach
                            </div>
                          </div>
                      </div>
                      <!-- <div class="col-2">
                        <label class="control-label"></label>
                        <div class="col-md-12">
                          @foreach($form['layanan'] as $detail)
                            @if($detail->kategori === 4)
                            <div class="row col-md-12">
                              <label class="css-control-primary">
                              Rp.{{number_format($detail->harga_layanan)}}
                              </label>
                          </div>
                            @endif
                          @endforeach
                        </div>
                      </div> -->
                    </div>
                  <div class="row col-md-12" id="div-formalin" style="margin-top:20px;">
                    <div class="form-group col-md-10" >
                        <label class="control-label">- Suntik Formalin -</label>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input layanan" type="radio" name="formalin" id="formalinya" value="3" onchange="changeFormalin(3)">
                            <label class="custom-control-label"  for="formalinya">Ya</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input class="custom-control-input layanan" type="radio" name="formalin" id="formalintidak" value="-1" onchange="changeFormalin(-1)">
                            <label class="custom-control-label"  for="formalintidak">Tidak</label>
                        </div>
                    </div>
                    <!-- <div class="col-2">
                      <label class="control-label"></label>
                      <div class="col-md-12">
                        @foreach($form['layanan'] as $detail)
                          @if($detail->kategori === 3)
                          <div class="row col-md-12">
                            <label class="css-control-primary">
                            Rp.{{number_format($detail->harga_layanan)}}
                            </label>
                        </div>
                          @endif
                        @endforeach
                      </div>
                    </div> -->
                </div>
            </div>
        </div>
      </div>
    </div>
