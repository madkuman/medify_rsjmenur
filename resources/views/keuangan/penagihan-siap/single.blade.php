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
    @if($paket->total_paid == $paket->total)
      <button class="btn btn-alt-primary btn-hero pull-right mb-20" disabled="">Sudah Dibayar</button>
    @else
      <button class="btn btn-alt-warning btn-hero pull-right mb-20" id="btn-bayar">Tagihkan</button>
    @endif
  </div>
  <div class="block-content">
    @if($paket->pembayaran_perusahaan_tipe_id == config('const.bpjs'))
      <form action="{{url()->current()}}" method="POST" id="pembayaranForm">
    @else
      <form action="{{url('keuangan/penagihan-siap/'.$paket->slug)}}" method="POST" id="pembayaranForm">
    @endif
      {{csrf_field()}}
      <table class="table table-bordered table-vcenter">
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Pasien</th>
          <th>No. Piutang</th>
          <th>Jumlah</th>
        </tr>

        @php $total = 0 @endphp

        @foreach($paket->detail as $item)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$item->judul}}</td>
          <td>{{$item->pasien->name}}</td>
          <td>PTG{{$item->id}}</td>
          <td>Rp {{number_format($item->total)}}</td>
          </tr>
          @php $total = $total + $item->total @endphp
          @endforeach
          <tr>
            <td colspan="4"><strong>Total</strong></td>
            <td><strong>Rp {{number_format($total)}}</strong></td>
          </tr>
        </table>
        <input type="hidden" name="total" id="total" value="{{$total}}">
        <input type="hidden" name="total_bayar" id="total_bayar">
        <input type="hidden" name="akun_bayar" id="akun_bayar">
      </form>
    </div>
    
  </div>

  @include('keuangan.penagihan-siap.components.modal-bayar')
  @endsection

  @section('js')
  <script type="text/javascript">
    @if(session('status'))
      $(document).ready(function(){
          swal("{{session('title')}}",
              "{{session('message')}}",
              "{{session('status')}}")
      })
    @endif
    var rugi = false;
    var selisih = false;
    var total;
    $(document).on('click', '#btn-bayar', function(){
      total = $("#total").val();
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
      if(selisih){
        swal(
          'Gagal',
          'Jumlah Tagihan dan Pembayaran tidak sama',
          'error'
        );
        return false;
      }
      $("#total").val(total);
      $("#total_bayar").val($("#input-paid").val());
      $("#akun_bayar").val($("#akun").val());
      $("#pembayaranForm").submit();
      $("#buttonPay").hide();
      $("#buttonLoading").show();
    })

    $(document).on('change', '#input-paid', function(){
      var paid = $("#input-paid").val();
      var centang_rugi = $("#centang_rugi");
      if(paid == total)
        selisih = false;
      else
        selisih = true;
      // if(paid < total){
      //   rugi = true;
      //   centang_rugi.show();
      // }
      // else{
      //   rugi = false;
      //   centang_rugi.hide();
      // }
    })
  </script>
  @endsection