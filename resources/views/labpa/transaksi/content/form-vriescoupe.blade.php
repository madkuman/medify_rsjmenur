    <div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">FORM {{strtoupper($result->jenis_form)}}</p>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Makroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <p class="preserve-break">{{$result->makroskopis}}</p>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <p class="preserve-break">{{$result->kesimpulan}}</p>
            </div>
        </div>
    </div>
