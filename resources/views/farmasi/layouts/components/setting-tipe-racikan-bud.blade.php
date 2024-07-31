
<div class="row">
    <div class="col-md-8">
        <h5>Tipe Racikan - Beyond Use Date</h5>
        <table class="table table-bordered table-stripped" style="width: 100%" cellpadding="5px">
            <tbody>
                <tr>
                    <td><label>Jenis</label></td>
                    <td><label for="">Beyond Use Date (hari)</label></td>
                </tr>
                @foreach (getTipeRacikan(1) as $item_tipe_racikan)
                    <tr>
                        <td><label for="" class="col-form-label">{{ $item_tipe_racikan->nama }}</label></td>
                        <td>
                            <input type="number" name="tipe_racikan[{{ $item_tipe_racikan->id }}]" class="form-control" value="{{ $item_tipe_racikan->beyond_use_date }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
