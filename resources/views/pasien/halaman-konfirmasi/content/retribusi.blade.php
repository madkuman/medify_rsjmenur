<div class="row urikkes-hide">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Retribusi</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" class="css-control-input" id="pasien_baru">
                        <span class="css-control-indicator"></span> Pasien Baru (Rp 36,000)
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" class="css-control-input" id="is_kartu_baru">
                        <span class="css-control-indicator"></span> Kartu RSAL (Rp 15,000)
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="css-control css-control-primary css-checkbox">
                        <input type="checkbox" class="css-control-input" id="karcis_poli">
                        <span class="css-control-indicator"></span> Karcis Kontrol (Rp 9,000)
                    </label>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">
                    <span class="control-label font-w700">TOTAL TAGIHAN PEMBAYARAN : Rp </span><span id="total_bayar"></span>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">                                                
                    <input class="form-control" type="hidden" name="pasien_id" id="pasien_id" value="{{$pasien->id}}" />
                </div>
            </div>
        </div>
    </div>                             
</div>