@extends('urikkes.layouts.main')

@section('title')
Pengaturan Paket Medical Checkup
@endsection

@section('subtitle')
Pengaturan Paket Medical Checkup
@endsection

@section('content')
<main id="main-container">
    @include('urikkes.layouts.navbar')
    <div class="content">
            <div class="row  gutters-tiny">
                <div class="col-3 form-group">
                    <label for="name">Nama Paket</label>
                    <input class="form-control" type="text" name="name" id="namaPaket" value="{{$paket->nama}}">
                </div>
            </div>
            <div class="row gutters-tiny" >
                <div class="col-12 my-5">
                    <div class="block block-bordered block-link-shadow" style="height:100%;">
                        <div class="block-content block-content-full text-center">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 10%;">#</th>
                                        <th style="width: 60%;">Nama</th>
                                        <th style="width: 30%;" class="text-center">Harga</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-lg btn-circle btn-alt-primary" id="add" class="btn btn-circle btn-alt-primary" data-toggle="modal" data-target="#modal-detail">
                                <i class="fa fa-plus"></i>
                            </button>

                            @if($paket->id != 0)
                            <div class="mb-10 pull-right">
                                <h3>Total <input id="totalHarga" class="totalHarga form-control font-w400" value="{{number_format($paket->total, 2)}}"/></h3>
                            </div>
                            @else
                            <div class="mb-10 pull-right">  
                                <h3>Total <input id="totalHarga" class="totalHarga form-control font-w400" value="0"/></h3>
                            </div>
                            @endif


                            <div class="pull-right col-12 mb-30 mt-20 text-right">
                                <button class="btn btn-primary col-2" type="button" id="save">
                                    <i class="fa fa-1x fa-spin fa-spinner text-white d-none" id="loading-simpan"></i>
                                    Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="modal-detail" class="modal fade " role="dialog">
        <div class="modal-dialog modal modal-dialog-centered">
            <div class="modal-content ">
              <div class="modal-body">
                <div name="modal-title" class="font-size-lg font-w600 mb-20">Tambahkan Layanan</div>
                <div class="row">
                    <div class="form-group col-12">
                        <label class="control-label">Tarif</label>
                        <select type="text" class="form-control js-select2 custom-select" id="tarif" name="tarif" onchange="getTipeTarif()">
                            <option></option>
                            @foreach($tarif as $item)
                            <!-- INI HARGA DITAMPILIN SOALE ADA LAYANAN YG SAMA TP HARGA BERBEDA -->
                            @if(!isset($item->tarif[0]->harga))
                                @continue
                            @endif
                            <option value="{{$item}}">{{$item->deskripsi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label class="control-label">Tipe Tarif</label>
                        <select type="text" class="form-control js-select2 custom-select" id="tarif-tipe" name="tarif" style="width: 100%">
                        </select>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="addButton">Tambah</button>

              </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    var total = 0;
    var layanan = JSON.parse('{{json_encode($paket->tarifPaket)}}'.replace(/&quot;/g,'"'));
    var i =1;
    for (; i <= layanan.length; i++) {
        $('#table').append('<tr id="row'+i+'"><td>'+i+'</td>'+
                '<td>'+layanan[i-1].tarif_master.deskripsi+'</td>'+
                '<td class="row-harga" data-harga="'+layanan[i-1].harga+'">Rp '+(layanan[i-1].harga).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-circle btn-alt-danger delete" id="delete_'+i+'">'+
                        '<i class="fa fa-times"></i>'+
                    '</button></td></tr>');
        layanan[i-1].flag=0;
        delete layanan[i-1].tarif_master.tarif_kode;
    };
    $('#addButton').on('click', function(e){
        var selected = {};
        selected = JSON.parse($('#tarif option:selected').val());
        var total_lama = parseInt($('#totalHarga').val());
        var harga = $('#tarif-tipe option:selected').data('data').harga;
        var tipe = $('#tarif-tipe option:selected').val();
        selected.tipe = tipe;
        console.log(selected);
        $('#table').append('<tr id="row'+i+'"><td>'+i+'</td>'+
                '<td>'+selected.deskripsi+'</td>'+
                '<td class="row-harga" data-harga="'+harga+'">Rp '+(harga).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</td>'+
            '<td>'+
                '<button type="button" class="btn btn-circle btn-alt-danger delete" id="delete_'+i+'">'+
                    '<i class="fa fa-times"></i>'+
                '</button></td></tr>');
        i++;
        $("#tarif").val('').trigger('change');
        $('#modal-detail').modal('toggle');
        selected.flag=1;
        delete selected.tarif_kode;
        layanan.push(selected);
        calculateHarga();
    });
    $(document).on('click', '.delete', function(){
        var total_lama = parseInt($('#totalHarga').val());
        var button_id = $(this).attr("id");
        result = button_id.split("_");
        pos = result[1];
        $('#row'+pos+'').remove();
        if(layanan[pos-1].flag == 0){
            layanan[pos-1].flag=-1;
        }else{
            layanan.splice(pos-1, 1);
        }
        i--;
        calculateHarga();
    });
    $('#tarif').select2({
        width: '100%',
        placeholder: "Pilih Tarif",
    });
     $("#save").on("click",function(e) {
        e.preventDefault(); // cancel the link itself
        $('#loading-simpan').removeClass('d-none');
        $(this).prop('disabled', true);
        submit($("#namaPaket").val());
      });
    $(document).on("focus", "#totalHarga", function(){
        var result = this.value.split('.')[0].replace(/,/g, "");
        this.value = result;
    })
    $(document).on("blur", "#totalHarga", function(){
        var result = parseFloat(this.value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        this.value = result;
    })
    function submit(nama) {
        for(var j = 0;j<layanan.length;j++){
            if(layanan[j].flag != 1)
                delete layanan[j].tarif_master.tarif;
        }
        var id ={{$paket->id}};
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
        var total_harga = $("#totalHarga").val().split('.')[0].replace(/,/g, "");
          $.ajax({
            type:'POST',
            url:'{{url("urikkes/pengaturan/paket/save")}}',
            data: {
              "_token": "{{ csrf_token() }}",
              "paket_nama": nama,
              "paket_id": id,
              "layanan": layanan,
              "total": total_harga
            },
            success:function(data){
              swal(
                {
                    title:"Berhasil!",
                    text:"Data layanan dari paket "+nama+" berhasil disimpan.",
                    type:"success",
                    timer:3000,
                }).then(function() {
                        location.href = '{{url("urikkes/pengaturan/paket/detail")}}/'+data;
                });
            },
            error:function(data){
              swal(
                {
                   type: "error",
                   title: "Gagal|",
                   text: "Data layanan dari paket "+nama+" gagal disimpan",
                    timer:3000,
                });
            }
          });
    }
    function calculateHarga(){
        var rows = document.getElementsByClassName('row-harga');
        total = 0;
        for (var i = rows.length - 1; i >= 0; i--) {
            total += parseInt(rows[i].dataset.harga);
        }
        $('#totalHarga').val(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    }
    function formatHarga(el){
        var res = $("#totalHarga").split('.')[0].replace(/,/g, "");
        res = res.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        $(el).val(res);
    }
});

function getTipeTarif()
{
    if($('#tarif').val() != '') {
        var select = JSON.parse($('#tarif option:selected').val());
        $.ajax({
            type: "get",
            url: API_URL + "/urikkes/pengaturan/all-tipe-tarif",
            dataType: "json",
            data: {
                id: select.id
            },
            success: function (data) {
                var option = [];
                for (i in data) {
                    option.push({
                        id: data[i].tipe.id,
                        text: data[i].tipe.nama,
                        harga: data[i].harga
                    });
                }
                $('#tarif-tipe').select2({
                    data: option
                })
            }
        });
    }
}
</script>
@endsection