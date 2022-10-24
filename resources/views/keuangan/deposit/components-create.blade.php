<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Buat Deposit Baru</h3>
    </div>
    <form method="POST" action="{{url('')}}/keuangan/deposit/baru">
        {{csrf_field()}}
        <div class="block-content">
            <input type="hidden" name="kasir_id" value="{{$kasir_id}}">
            <div class="row">
                <div class="col-4" id="input-pasien-container">
                    <label>Pasien</label>
                    <select class="js-select2 form-control" id="pasien" name="pasien_id" style="width: 100%;">
                    </select>
                </div>
                <div class="col-4">
                    <label>Banyak DP</label>
                    <input type="number" class="form-control" id="DP" name="jumlah">
                </div>
            </div>
            <div class="row mt-20">
                <div class="col-3">
                    <button class="btn btn-success btn-hero btn-block"><i class="fa fa-check"></i> Buat Deposit</button>
                    <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>