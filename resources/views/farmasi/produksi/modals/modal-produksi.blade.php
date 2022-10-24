<div class="modal" id="modal-tambah" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <form action="{{url('farmasi/'.session('farmasi')->slug.'/produksi/produksi')}}" method="POST" id="form-transaksi">
            {{csrf_field()}}
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <input type="hidden" name="produksi_id" value="{{$produksi->id}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Lakukan Produksi</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Produksi</label>
                                    <br>
                                    <input type="text" name="nama_produksi" class="form-control" placeholder="Nama Produksi" id="nama-produksi" data-tags="true" style="width: 100%;" value="{{$produksi->nama}}" readonly="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tipe Produksi</label>
                                    <br>
                                    <select class="form-control js-select2" style="width: 100%;" data-placeholder="Tipe Produksi" data-tags="true" name="tipe_produksi" >
                                        <option></option>
                                        @foreach($tipe as $type)
                                        <option id="{{$type->nama}}"
                                            @if($type->nama == $produksi->tipe) selected
                                            @endif>{{$type->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <br>
                                    <input type="text" name="harga_produksi" class="form-control" placeholder="Harga" id="harga-produksi" data-tags="true" style="width: 100%;" value="{{$produksi->lastTransaksi->harga ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <br>
                                    <input type="text" name="jumlah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>E.D.</label>
                                    <br>
                                    <input type="text" name="ed" class="js-datepicker form-control" autocomplete="off" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div id="racikan-row">
                            
                        </div>
                        <div class="text-center pb-10" id="tambahRacikan">
                            <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddRacikan">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-square" id="btnSubmit">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>