@extends('keuangan.layouts.main')

@section('title')
Pembayaran Paket Penagihan - Keuangan
@endsection

@section('css')
@endsection
@section('content')
@include('keuangan.piutang.components.header')

<div class="block">
  <div class="block-content">
    <h4>{{$paket->judul}}</h4>
    <hr>
    @if($paket->status == $state_dibayar)
      <button class="btn btn-alt-primary btn-hero pull-right mb-20" disabled="">Sudah Dibayar</button>
    @else
      <button class="btn btn-alt-warning btn-hero pull-right mb-20" id="btn-bayar">Tagihkan</button>
    @endif
  </div>
  <div class="block-content">
    <form action="{{url()->current()}}" method="POST" id="pembayaranForm">
      {{csrf_field()}}
      <table class="table table-bordered table-vcenter">
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Pasien</th>
          <th>No. Piutang</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>

        @php $total = 0 @endphp

        @foreach($paket->detail as $item)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$item->judul}}</td>
          <td>{{$item->pasien->name}}</td>
          <td>PTG{{$item->id}}</td>
          <td>Rp {{number_format($item->total)}}</td>
          <td>
            <label class="css-control css-control-success css-checkbox">&nbsp;
              <input checked="" @if($item->total == $item->total_paid) disabled @endif type="checkbox" class="css-control-input piutang-id" name="piutang_id[]" value="{{$item->id}}" data-subtotal="{{$item->total}}">&nbsp;<span class="css-control-indicator"></span></label>
            </td>
          </tr>
          @php $total = $total + $item->total @endphp
          @endforeach
          <tr>
            <td colspan="4"><strong>Total</strong></td>
            <td><strong>Rp {{number_format($total)}}</strong></td>
            <td></td>
          </tr>
        </table>
        <input type="hidden" name="total" id="total">
        <input type="hidden" name="total_bayar" id="total_bayar">
        <input type="hidden" name="akun_bayar" id="akun_bayar">
      </form>
    </div>
    
  </div>

  <!-- modal bayar -->
  <div id="confirmPayment" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="block block-themed">
          <div class="block-header bg-primary">
            <h5 class="block-title">Masukkan Jumlah Pembayaran</h5>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            </div>
          </div>
          <div class="block-content">

            <div class="row mb-20">
              <div class="col-md-5">
                <h5 style="margin-bottom:0">Belum Terbayar</h5>
              </div>
              <div class="col-md-1">
                <h5 style="margin-bottom:0">Rp</h5>
              </div>
              <div class="col-md-5">
                <input type="text" class="d-none" id="bill" value="">
                <h5 style="margin-bottom:0" id="allTotal"></h5>
              </div>
            </div>
            <div class="row mb-20 form-group align-items-center">
              <div class="col-md-5">
                <h5 style="margin-bottom:0">Pembayaran</h5>
              </div>
              <div class="col-md-1">
                <h5 style="margin-bottom:0">Rp</h5>
              </div>
              <div class="col-md-6">
                <input type="number" class="form-control"  id="input-paid" name="example-nf-password" placeholder="Masukkan Pembayaran..">

              </div>
            </div>
            <div class="row mb-20">
              <div class="col-md-5">
                <h5 style="margin-bottom:0">Akun Rekening</h5>
              </div>
              <div class="col-md-7">
                <h5 style="margin-bottom:0">{{$paket->akun->nama}} - {{$paket->akun->no_rekening}}</h5>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                <input type="text" class="d-none" id="id_piutang" value="">
                <button class="btn btn-primary btn-hero" id="buttonPay"><i class="fa fa-check"></i> Terima Pembayaran</button>
                <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                  <i class="fa fa-asterisk fa-spin"></i> Loading
                </button>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
  @endsection

  @section('js')
  <script type="text/javascript">
    var total;
    $(document).on('click', '#btn-bayar', function(){
      total = 0;
      var to_bayar = $(".piutang-id:checked");
      to_bayar.each(function(i, item){
        total += $(item).data('subtotal');
      });
      $("#bill").val(total);
      $("#allTotal").text(total.toLocaleString());
      $.ajax({
        type: "GET",
        url: API_URL + "/keuangan/akun/get",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          var option = [];
          option.push({
            id: '',
            text: '',
          });
          for (i in data) {
            option.push({
              id: data[i].id,
              text: data[i].no_rekening+' - '+data[i].nama,
            });
          }
          $('#akun').select2({
            data: option
          })
        }
      });
      $("#confirmPayment").modal('show');
    });

    $(document).on('click', '#buttonPay', function(){
      $("#total").val(total);
      $("#total_bayar").val($("#input-paid").val());
      $("#akun_bayar").val($("#akun").val());
      $("#pembayaranForm").submit();
      $("#buttonPay").hide();
      $("#buttonLoading").show();
    })
  </script>
  @endsection