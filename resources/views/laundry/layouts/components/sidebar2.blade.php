<div id="sidebar-scroll" class="bg-white"  >
    <div class="sidebar-content" >

        <div class="content-side content-side-full px-12 align-parent">
            <div class="sidebar-mini-hidden-b text-left">
                <h5 class="block-title">Filter</h5><br>
            </div>
            <form  class="sidebar-form" id="Filter">
                <div class="form-group row text-left">
                    <div class="col-12">
                        <label for="ruanganSelect2" class="font-size-sm font-w600 text-uppercase">RUANGAN</label>
                        <div class="input-group mb-15">
                            <select class="js-select2 form-control custom-select" id="ruanganSelect2" name="ruangan"  data-placeholder="Pilih Ruangan">
                            <option value="0" selected>
                                Semua ruangan
                            </option>
                                @for ($i=0; $i < $permintaan['grup']->jumlah; $i++)
                            <option value="{{$permintaan['grup'][$i]->id}}">{{$permintaan['grup'][$i]->name}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row text-left">
                    <div class="col-12">
                        <label for="tgl_operasi" class="font-size-sm font-w600 text-uppercase">TANGGAL DITERIMA</label>
                        <div class="form-group input-group">
                          <input type="text" class="js-datepicker form-control" id="tgl_min" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Minimal">
                          <div class="input-group-append">
                            <button onclick="document.getElementById('tgl_min').value = ''" type="button" class="btn btn-secondary"><i class="si si-close"></i></button>
                          </div>
                        </div>
                        <div class="form-group input-group">
                          <input type="text" class="js-datepicker form-control" id="tgl_max" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Maksimal">
                          <div class="input-group-append">
                            <button onclick="document.getElementById('tgl_max').value = ''" type="button" class="btn btn-secondary"><i class="si si-close"></i></button>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row text-left">
                    <div class="col-12">
                        <label for="tgl_operasi" class="font-size-sm font-w600 text-uppercase ">TANGGAL DIKEMBALIKAN</label>
                        <div class="form-group input-group">
                          <input type="text" class="js-datepicker form-control" id="tgl_min2" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Minimal">
                          <div class="input-group-append">
                            <button onclick="document.getElementById('tgl_min2').value = ''" type="button" class="btn btn-secondary"><i class="si si-close"></i></button>
                          </div>
                        </div>
                        <div class="form-group input-group">
                          <input type="text" class="js-datepicker form-control" id="tgl_max2" data-week-start="1" data-autoclose="true" autocomplete="off" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Maksimal">
                          <div class="input-group-append">
                            <button onclick="document.getElementById('tgl_max2').value = ''" type="button" class="btn btn-secondary"><i class="si si-close"></i></button>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="form-group column">
                    <div class="sidebar-mini-hidden-b text-left">
                        <h6 class="my-6">LAINNYA</h6>
                    </div>
                    <div class="input-group">
                        <label class="css-control css-control-primary css-checkbox font-size-sm font-w600">
                            <input type="checkbox" value="1" class="css-control-input" id="proses_penerimaan">
                            <span class="css-control-indicator"></span> Proses Penerimaan
                        </label>
                    </div>
                    <div class="input-group">
                        <label class="css-control css-control-primary css-checkbox font-size-sm font-w600">
                            <input type="checkbox" value="2" class="css-control-input" id="proses_cuci">
                            <span class="css-control-indicator"></span> Proses Cuci
                        </label>
                    </div>
                    <div class="input-group">
                        <label class="css-control css-control-primary css-checkbox font-size-sm font-w600">
                            <input type="checkbox" value="3" class="css-control-input" id="proses_kembali">
                            <span class="css-control-indicator"></span> Siap Dikembalikan
                        </label>
                    </div>
                    <div class="input-group">
                        <label class="css-control css-control-primary css-checkbox font-size-sm font-w600">
                            <input type="checkbox" value="4" class="css-control-input" id="proses_terima">
                            <span class="css-control-indicator"></span> Konfirmasi Terima
                        </label>
                    </div>
                    <div class="input-group">
                        <label class="css-control css-control-primary css-checkbox font-size-sm font-w600">
                            <input type="checkbox" value="5" class="css-control-input" id="proses_selesai">
                            <span class="css-control-indicator"></span> Selesai
                        </label>
                    </div>
                </div>
                <div class="mb-10">
                <button class="btn btn-primary btn-block" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
