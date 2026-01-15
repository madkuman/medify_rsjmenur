<div class="block border">
    <div class="block-header">
        <h5 class="block-title">Update Plafon</h5>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
        </div>
    </div>
    <div class="block-content pb-10">
        <form action="{{ url('kasus') }}/{{ $nomor_kasus }}/pengaturan/{{ $kasus->sep->id ?? 0 }}/update-plafon" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Total Plafon</label>
                        <input class="form-control" name="total_plafon" required type="number"
                            value="{{ $kasus->plafon ?? 0 }}">
                    </div>
                </div>

                <div class="col-12">
                    <input name="submitButton" style="display:none" type="submit">

                    <button class="btn-alt btn-click-animate btn-hero btn-primary min-width-100 float-right"
                        type="submit">Perbarui</button>
                </div>

            </div>

        </form>
    </div>
</div>
