
<div class="block-content">
    <div class="row">
        <div class="col-6">
            <form id="form_search_sep">
                <div class="form-group">
                    <label>Nomor SEP</label>
                    <div class="input-group">
                        <input type="text" class="form-control required" id="search_nomor_sep" name="nomor_sep" value="{{$no_sep}}">
                        <div class="input-group-append">
                            <button id="search" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                        <br>
                    </div>
                    <small>Contoh : 1301R0101218V000019</small>
                    <div class="invalid-feedback alert alert-danger"  id="error_search_nomor_sep"></div>
                </div>
            </form>
        </div>
    </div>
</div>