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
                <h5>PERMINTAAN FILE BARU</h5>
                <div class="row mb-20">
                    <div class="col-lg-6 col-12">
                        <form action="{{url()->current()}}" method= "POST">
                        
                        @if($type == 2)
                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Asal Group</label>
                                    <select class="form-control" id="group_id" name="group_id" style="width: 100%;" data-placeholder="Cari Pasien" required="">
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{csrf_field()}}
                        <div class="row justify-content-center">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="control-label">Pilih File RM</label>
                                     <select class="form-control" id="pasien" name="pasien_id" style="width: 100%;" data-placeholder="Cari Pasien" required="">
                                
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
                                        <option value="{{$item->id}}">{{$item->deskripsi}}
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
    $(document).ready(function(){
        @if(session('status'))
            swal(
                '{{session("message")}}',
                "",
                '{{session("status")}}'
            );
        @endif
        initSelect2Layanan("#layanan0");
        Codebase.helpers(['select2']);
        $('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
    });
        function addForm(){
        var totalLayanan = $(".layananForm").length;
        var codeToAdd = `<div class="row form-group" id="layanan_`+totalLayanan+`" data-index="`+totalLayanan+`">
                    <div class="col-md-10">
                        <select class="form-control layananForm" id="layanan`+totalLayanan+`" name="layanan[]" style="width: 100%;" data-placeholder="Choose one..">
                                
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" onclick="removeForm(`+totalLayanan+`)">
                            <i class="fa fa-times mr-5"></i>
                            Hapus
                        </button>
                    </div>
                    <hr/>
                </div>`;
        $(".form-layanan").append(codeToAdd);
        initSelect2Layanan("#layanan"+totalLayanan);
        window.scrollTo(0, document.body.scrollHeight);
    }
    function removeForm(id) {
        $("#layanan_"+id).remove();
    }
    function submitForm() {
        $("#permintaanForm").submit();
    }
    $(document).on('select2:select', '.layananForm', function() {
        console.log($('#kelasLayanan').val())
        if($('#kelasLayanan').val()) return;
        else $("#kelasWarn").html("Mohon isi Kelas Pasien terlebih dahulu");
        if($('#tipeLayanan').val()) return;
        else $("#tipeWarn").html("Mohon isi Tipe Pasien terlebih dahulu");
    });
    $(document).on('select2:select', '.requireForm', function() {
        if($("#kelasLayanan").val()!= 0 && $("#tipeLayanan").val() != 0){
            $(".layananForm").removeAttr("disabled");
            $("#tambahBtn").removeAttr("disabled");
        }
    });
</script>
<script type="text/javascript">
    //FORMAT DISPLAY
    function formatPasien (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.name

        return markup;
    }

    //FORMAT UNTUK DI SHOW DI HTML
    function formatPasienSelection (item) {
        return item.name || item.text;
    }
    function formatLayananSelection (item) {
        return item.deskripsi || item.text;
    }
    function formatLayanan (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.deskripsi

        return markup;
    }

    function initSelect2Layanan(selector)
    {
        $(selector).select2({
            ajax: {
                url: API_URL+"/keuangan/tarif",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page,
                        detail: true
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    var kelas = $("#kelasLayanan").val();
                    var tipe = $("#tipeLayanan").val();
                    // console.log(tipe);
                    // console.table(data.data)
                    if(kelas == 2 ) tipe = 1;
                    
                    var filteredData = $.grep(data.data, (n, i) => {
                        return n.departemen_id === 8
                    });
                    var myResults = []
                    console.table(filteredData)
                    filteredData.forEach((dataItem) => {
                        dataItem['detail'].forEach((item) => {
                            if(item.tarif_tipe_id == tipe){
                                console.log(kelas)
                                switch (kelas) {
                                    case "1":
                                        if(item.urj != null)    myResults.push(dataItem);
                                        break;
                                    case "2":
                                        if(item.igd != null)    myResults.push(dataItem);
                                        break;
                                    case "3":
                                        if(item.vvip != null)    myResults.push(dataItem);
                                        break;
                                    case "4":
                                        if(item.vip_a != null)    myResults.push(dataItem);
                                        break;
                                    case "5":
                                        if(item.vip_paviliun != null)    myResults.push(dataItem);
                                        break;
                                    case "6":
                                        if(item.i_paviliun != null)    myResults.push(dataItem);
                                        break;
                                    case "7":
                                        if(item.vip_ruangan != null)    myResults.push(dataItem);
                                        break;
                                    case "8":
                                        if(item.i_a != null)    myResults.push(dataItem);
                                        break;
                                    case "9":
                                        if(item.i_b != null)    myResults.push(dataItem);
                                        break;
                                    case "10":
                                        if(item.ii != null)    myResults.push(dataItem);
                                        break;
                                    case "11":
                                        if(item.iii_ac != null)    myResults.push(dataItem);
                                        break;
                                    case "12":
                                        if(item.iii_non_ac != null)    myResults.push(dataItem);
                                        break;
                                }
                            }
                        })
                    })
                    return {
                        results: myResults,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Layanan",
            templateResult: formatLayanan,
            templateSelection: formatLayananSelection,
        });
    }


    $("#pasien").select2({
        ajax: {
            url: API_URL+"/pasien/get",
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
                    results: data.data,
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 3,
        placeholder: "Cari Pasien",
        templateResult: formatPasien,
        templateSelection: formatPasienSelection
    });

</script>
@endsection