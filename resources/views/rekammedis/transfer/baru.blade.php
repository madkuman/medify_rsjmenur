@extends('rekammedis.layouts.main')

@section('title')
Rekam Medis - Medify
@endsection


@section('subtitle')
Permintaan Baru
@endsection

@section('content')
<main id="main-container">
    @include('rekammedis.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-content">
                <h5>TRANSFER FILE RM</h5>
                <div class="row mb-20">
                    <div class="col-6">
                        <form action="{{url('rekammedis/transaksi/transfer-rm')}}" method= "POST">
                            {{csrf_field()}}
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Pilih File RM</label>
                                        <select class="form-control" id="pasien" name="pasien_id" style="width: 100%;" data-placeholder="Cari Pasien" required="">
                                            <option value="{{$rm->id}}" selected="">{{$rm->name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Tujuan File</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="holder_type" id="example-inline-radio1" value="2" checked="">
                                        <label class="custom-control-label" for="example-inline-radio1">Grup</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="holder_type" id="example-inline-radio2" value="1">
                                        <label class="custom-control-label" for="example-inline-radio2">User</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center" id="groupContainer">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Pilih Grup Yang Akan Dikirim</label>
                                        <select class="form-control js-select2" id="grup" name="holder_group_id" style="width: 100%;"  data-placeholder="Cari Group" >
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center" id="userContainer" style="display: none">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Pilih User Yang Akan Dikirim</label>
                                        <select class="form-control js-select2" id="user" name="holder_user_id" style="width: 100%;" data-placeholder="Cari User" >
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Lokasi Peminjaman File <i id="identitasLoading" class="fa text-info"></i></label>
                                        <input class="form-control" type="text" name="lokasi" id="noIdentitas" placeholder="Ketik Lokasi Peminjaman File" required="required"/>
                                        <div class="invalid-feedback">Jenis / Nomor identitas ini sudah digunakan atau data nomor identitas kosong</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Tujuan Peminjaman File</label>
                                        <select name="tujuan_id" class="form-control">
                                            @foreach($tujuan as $item)
                                            <option value="{{$item->id}}">{{$item->deskripsi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Keterangan<i id="namaLoading" class="fa text-info"></i></label>
                                        <input class="form-control" type="text" name="keterangan" id="namaPasien" placeholder="Ketik Keterangan Peminjaman File" />
                                        <div class="invalid-feedback">Nama ini sudah digunakan atau data nama pasien kosong</div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit"  class="btn btn-primary pull-right" value="Submit">
                        </form>
                    </div>


                </div>
            </div>

        </div>

    </div>
</main>

@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    initSelect2Layanan("#user");
    initSelect2Layanan("#grup");
});


    function initSelect2Layanan(selector)
    {
        if(selector == '#grup') url = "/group/search"
        else if(selector == '#user') url = "/users/search"
        console.log(selector)
        $(selector).select2({
            ajax: {
                url: API_URL+url,
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: formatUser,
            templateSelection: formatUserSelection,
        });
    }


    function formatUser (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.name

        return markup;
    }

    function formatUserSelection (item) {
        return item.name || item.text;
    }

    $('input[type=radio][name=holder_type]').change(function() {
        if (this.value == '2') {
            $('#groupContainer').show();
            $('#userContainer').hide();
        }
        else if (this.value == '1') {
            $('#userContainer').show();
            $('#groupContainer').hide();

        }
    });


</script>
@endsection