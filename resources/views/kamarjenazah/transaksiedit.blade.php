@extends('kamarjenazah.layouts.main')

@section('title')
Kamar Jenazah - Medify
@endsection

@section('toprightmenu')
+ Tambah Layanan
@endsection

@section('url')
{{url('kamarjenazah/layanan/new')}}
@endsection

@section('css')
<style type="text/css">
    .block-content {
        padding-bottom: 18px;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-sm-7">
            <div class="block rounded">
                <form id="layananSubmit">
                    <div class="block-content" id="layananBaru">
                        @include('kamarjenazah.form.form-transaksiedit')
                    <div class="col-12" style="height: 75px">
                        <button class="btn btn-success btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Perbarui Invoice</button>
                        <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
          <div class="col-sm-5 pl-0">
            <div class="block rounded">
                  <div class="col-md-12 block-content" id="listnya">
                    <h5 class="text-primary font-size-md">Layanan Invoice</h5>
                  <table>
                    <tbody>
                    </tbody>
                    <hr>
                  </table>
                    <div class="row">
                        <div class="col-md-2">
                            <h5 class="font-size-md"><strong>Total</strong> </h5>
                        </div>
                        <div class="col-md-1">
                            <h5 class="pull-left font-size-md"><small>Rp </small></h5>
                        </div>
                        <div class="col-md-8 total font-size-md">
                            <h5><small>0</small></h5>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('angular')
<script type="text/javascript">
    var valPelayanan = -1;
    var valPenyakit = -1;
    var valFormalin = -1;
    var valPeti = -1;
    i = 0;
    arr = [];

    var options = {style: 'currency', currency: '', minimumFractionDigits: 2, maximumFractionDigits: 2};
    var formatter = new Intl.NumberFormat(options);

    $( document ).ready(function(){
      $("#menular").hide();
      $('#div-menular').hide();
      $("#tidakmenular").hide();
      $("#div-tidakmenular").hide();
      $("#div-peti").hide();
      $("#div-formalin").hide();
      $("#divlayanan").hide();
    });

    function changePelayanan(val)
    {
        valPelayanan = val;
        if(val == 1)
        {
            $('#divlayanan').slideDown(1000);
            $("input:radio[name='formalin'][value='-1']").prop('checked',true);
            changeFormalin(-1);
            $("input:radio[name='jenispeti'][value='9']").prop('checked',true);
            changePeti(9);
        }
        else {
          $('#listnya tr').remove();
          $('#divlayanan').slideUp(1000);
          changePenyakit(-1);
          changeFormalin(-1);
          changePeti(-1);
          sum = 0;
          $(".total").val(sum).html(formatter.format(sum));
          $("input:radio[name='jenispenyakit']").each(function(i){
            this.checked = false;
          });
          $("input:radio[name='jenispeti']").each(function(i){
            this.checked = false;
          });
          $("input:radio[name='formalin']").each(function(i){
            this.checked = false;
          });
        }
    }

    function changePenyakit(val)
    {
        valPenyakit = val;
        if(val == 0){
            $('#div-tidakmenular').slideDown(1000);
            $('#div-menular').slideUp(1000);
            $("#div-peti").slideDown(1000);
            $("#div-formalin").slideDown(1000);
        }
        else if(val == 2) {
          $('#div-menular').slideDown(1000);
          $('#div-tidakmenular').slideUp(1000);
          $("#div-peti").slideDown(1000);
          $("#div-formalin").slideDown(1000);
        }
        else {
          $('#div-menular').slideUp(1000);
          $('#div-tidakmenular').slideUp(1000);
          $("#div-peti").slideUp(1000);
          $("#div-formalin").slideUp(1000);
        }
    }

    function changeFormalin(val)
    {
        valFormalin = val;
    }

    function changePeti(val)
    {
        valPeti = val;
    }

    $(document).on("change", ".layanan", function() {
      var sum = 0;
      $('#listnya tr').remove();
      @foreach($form['layanan'] as $detail)
        if (valFormalin == '{{$detail->id}}'){
          sum += {{$detail->harga_layanan}};
          console.log("{{$detail->nama_layanan}}"+' '+"{{$detail->harga_layanan}}");
          $('#listnya tbody').append('<tr><td class="pr-15 pb-15 font-size-sm">'+'</b>'+'{{$detail->nama_layanan}}'+'</td><td class="pb-15 font-size-sm">'+'Rp.{{number_format($detail->harga_layanan)}}'+'</td></tr>');
        }
        if (valPeti == '{{$detail->id}}') {
          sum += {{$detail->harga_layanan}};
          console.log("{{$detail->nama_layanan}}"+' '+"{{$detail->harga_layanan}}");
          $('#listnya tbody').append('<tr><td class="pr-15 pb-15 font-size-sm">'+'</b>'+'{{$detail->nama_layanan}}'+'</td><td class="pb-15 font-size-sm">'+'Rp.{{number_format($detail->harga_layanan)}}'+'</td></tr>');
        }
        if (valPenyakit == 0) {
          $('.checkLayananNormal:checked').each(function () {
            if (parseInt($(this).val()) == {{$detail->id}}) {
              sum += {{$detail->harga_layanan}};
              console.log("{{$detail->nama_layanan}}"+' '+"{{$detail->harga_layanan}}");
              $('#listnya tbody').append('<tr><td class="pr-15 pb-15 font-size-sm">'+'</b>'+'{{$detail->nama_layanan}}'+'</td><td class="pb-15 font-size-sm">'+'Rp.{{number_format($detail->harga_layanan)}}'+'</td></tr>');
            }
          });
        }
        if (valPenyakit == 2) {
          $('.checkLayananMenular:checked').each(function () {
            if (parseInt($(this).val()) == {{$detail->id}}) {
              sum += {{$detail->harga_layanan}};
              console.log("{{$detail->nama_layanan}}"+' '+"{{$detail->harga_layanan}}");
              $('#listnya tbody').append('<tr><td class="pr-15 pb-15 font-size-sm">'+'</b>'+'{{$detail->nama_layanan}}'+'</td><td class="pb-15 font-size-sm">'+'Rp.{{number_format($detail->harga_layanan)}}'+'</td></tr>');
            }
          });
        }
      @endforeach
    $(".total").val(sum).html(formatter.format(sum));
    console.log(formatter.format(sum));
    });

    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        idJenazah = $("#idJenazah").val();
        selectLayanan = $("#selectLayanan").val();
        selectPeti = $("#selectPeti").val();
        selectFormalin = $('#selectFormalin').val();
        idTransaksi = $("#id_transaksi").val();
        total = $('.total').val();

        if (valPenyakit == 0) {
          $('.checkLayananNormal:checked').each(function () {
            arr[i++]= $(this).val();
          });
        }
        if (valPenyakit == 2) {
          $('.checkLayananMenular:checked').each(function () {
            arr[i++]= $(this).val();
          });
        }

        var formData = new FormData();
        formData.append('selectPeti', valPeti);
        formData.append('idTransaksi', idTransaksi);
        formData.append('idJenazah', idJenazah);
        formData.append('selectFormalin', valFormalin);
        formData.append('total', total);
        while(i--){
        formData.append('layanan'+'['+i+']', arr[i]);
        }
        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
        }
        $.ajax({
            type: "POST",
            url: API_URL + "/kamarjenazah/transaksi/edit",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                callSwalString(response);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });

        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });

</script>

@endsection
