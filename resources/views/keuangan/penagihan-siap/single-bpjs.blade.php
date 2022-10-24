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
    @if($paket->status == $state_dibayar)
      <button class="btn btn-alt-primary btn-hero pull-right mb-20 pb-10" disabled="">Sudah Dibayar</button>
    @else
      <button class="btn btn-alt-warning btn-hero pull-right mb-20 pb-10" id="btn-bayar">Tagihkan</button>
    @endif
    <h4>{{$paket->judul}}</h4>
    <hr>
    <h5>{{$paket->nomor_surat}}</h5>
  </div>
  <div class="block-content">
      <form action="{{url()->current()}}" method="POST" id="pembayaranForm">
        <input type="hidden" name="penagihan_bpjs_id" id="penagihan_bpjs_id">
        <input type="hidden" name="jenis_pembayaran" id="jenis_pembayaran" value="multi">
        {{csrf_field()}}
      <table class="table table-bordered table-vcenter">
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>No. FPK</th>
          <th>Konfirmator</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>

        @php $total = 0 @endphp
        @php $multi_tagih = 1 @endphp
        @foreach($paket->detail_bpjs as $item)
          @if($item->total != $item->total_paid && is_null($item->confirmed_by))
            @php $multi_tagih = 0 @endphp
          @endif

        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$item->kategori_bpjs->name}}</td>
          <td>{{$item->fpk}}</td>
          <td>{{$item->confirmator->name ?? '-'}}</td>
          <td>Rp {{number_format($item->total)}}</td>
          <td>
            <a href="{{url()->current()}}/bpjs/{{$item->id}}" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp
            @if($item->total_paid == 0 && !is_null($item->confirmed_by))
              <button type="button" class="btn btn-sm btn-alt-warning tagihkan_btn" data-toggle="tooltip" title="Tagihkan" data-id="{{$item->id}}" data-total="{{$item->total}}" data-total-paid="{{$item->total_paid}}">&nbsp;<i class="fa fa-search-paperplane"></i> Tagihkan</a>
            @endif
            @if(is_null($item->confirmed_by))
              <button disabled="" type="button" class="btn btn-sm btn-alt-danger" >&nbsp; Belum dikonfirmasi</a>
            @endif
          </td>
        </tr>
          @php $total = $total + $item->total @endphp
          @endforeach
          <tr>
            <td colspan="4"><strong>Total</strong></td>
            <td colspan="2"><strong>Rp {{number_format($total)}}</strong></td>
          </tr>
        </table>
        <input type="hidden" name="total" id="total">
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
      var total;
      var rugi = false;
      var selisih = false;
      $(document).on('click', '#kirim_btn', function(){
        swal({
            title: 'Simpan Penagihan',
            text: 'Apakah anda yakin mengirim penagihan ini?',
            type: 'info',
            confirmButtonText: 'Ya',
            showCancelButton: true,
            cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.value) {
                $("#penagihan_form").submit();
            }
        });
      });

    $(document).on('click', '.tagihkan_btn', function(){
      total = $(this).data('total');
      var id = $(this).data('id');
      $("#penagihan_bpjs_id").val(id);
      $("#bill").val(total);
      $("#allTotal").text(total.toLocaleString());
      $("#jenis_pembayaran").val("single");
      $("#confirmPayment").modal('show');
    })
    $(document).on('click', '#btn-bayar', function(){
      if(multi_tagih == 0){
        swal(
          'Gagal',
          'Mohon Konfirmasi semua Kategori',
          'error'
        );
        return;
      }
      $("#bill").val(total);
      $("#allTotal").text(total.toLocaleString());
      $("#confirmPayment").modal('show');
      $("#jenis_pembayaran").val("multi");
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
    var multi_tagih = {{$multi_tagih}};
    var total = {{$paket->total-$paket->total_paid}};

    </script>
  @endsection