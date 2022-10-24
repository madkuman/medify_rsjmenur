<div id="confirmPayment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Masukkan Jumlah Pembayaran</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Belum Terbayar</h5>
                        </div>
                        <div class="col-md-1">
                        <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="d-none" id="bill" value="{{$piutang->total - $piutang->total_paid}}">
                            <h5 style="margin-bottom:0">{{number_format($piutang->total - $piutang->total_paid)}}</h5>
                        </div>
                    </div>
                    <input type="hidden" id="total_unpaid" value="{{$piutang->total - $piutang->total_paid}}">
                    <hr>
                    <div class="row form-group align-items-center">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Deposit</h5>
                        </div>
                        <div class="col-md-1">
                        <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control"  id="input-deposit" name="example-nf-password" placeholder="Masukkan Pembayaran.." data-max="{{$deposit->jumlah ?? '0'}}" value="{{$deposit->jumlah ?? '0'}}">
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group align-items-center">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Pembayaran</h5>
                        </div>
                        <div class="col-md-1">
                        <h5 style="margin-bottom:0">Rp</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control"  id="input-paid" name="example-nf-password" placeholder="Masukkan Pembayaran..">
                            <!-- <input type="text" class="d-none" id="input-paid">  
                            <a href="#" class="input-paid h5" data-type="text" data-placeholder="Masukkan Pembayaran.."></a> -->
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Akun Rekening</h5>
                        </div>
                        <div class="col-md-7">
                        <select class="js-select2 form-control" id="akun" name="akun" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                        </select>
                        </div>
                    </div>
                    <br>
                    <div id="rugi-rs-field" class="custom-control custom-checkbox custom-control-inline mb-5" style="display: none;">
                        <input class="custom-control-input" type="checkbox" name="rugi-rs" id="rugi-rs">
                        <label class="custom-control-label" for="rugi-rs">Kerugian ditanggung Rumah Sakit</label>
                    </div>
                    <div id="untung-rs-field" class="custom-control custom-checkbox custom-control-inline mb-5" style="display: none;">
                        <input class="custom-control-input" type="checkbox" name="untung-rs" id="untung-rs">
                        <label class="custom-control-label" for="untung-rs">Kelebihan menjadi keuntungan RS</label>
                    </div>
                    <br>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                    <input type="text" class="d-none" id="id_piutang" value="{{$piutang->id}}">
                    <button class="btn btn-primary btn-hero" disabled id="buttonSubmit"><i class="fa fa-check"></i> Terima Pembayaran</button>
                    <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </div>
        </div>
    </div>        
</div>