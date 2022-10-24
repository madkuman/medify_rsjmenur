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
    <a href="{{url('keuangan/penagihan/'.$paket->slug)}}" class="btn btn-hero btn-info pull-right">Kembali</a>
    <h4 class="mb-30">{{$paket->judul}}</h4>
    <hr>
    <h5>Nomor Surat : {{is_null($paket->nomor_surat) ? '-' : $paket->nomor_surat}}</h5>
    <hr>
    <h5>{{$penagihan_bpjs->kategori_bpjs->title}}</h5>
  </div>
  <form method="POST" id="penagihan_form">
    {{csrf_field()}}
    <input type="hidden" name="penagihan_bpjs_id" value="{{$penagihan_bpjs->id}}">

  <div class="block-content">
      <table class="table table-bordered table-vcenter detail_tabel">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Jumlah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0 @endphp

          @foreach($penagihan_bpjs->piutang_pivot_detail as $item)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->pasien->name}}</td>
            <td>Rp {{number_format($item->total)}}</td>
            <td>
              <label class="css-control css-control-primary css-checkbox">
                <input type="checkbox" class="css-control-input kirim-checkbox" @if($item->status == 1) checked="" @endif name="pivot_id[]" value="{{$item->id}}" data-subtotal="{{$item->total}}">
                <span class="css-control-indicator"></span> Kirim
              </label>
            </td>
          </tr>
            @if($item->status == 1)
              @php $total += $item->total @endphp
            @endif
            @endforeach
          <input type="hidden" id="harga_total" value="{{$total}}" name="harga_total">
          <tr>
            <td colspan="2"><strong>Total</strong></td>
            <td colspan="2"><strong id="total">Rp {{number_format($total)}}</strong></td>
          </tr>
          </tbody>
        </table>
 
    </div>
    <div class="row mb-20">
      <div class="col-8"></div>
      <div class="col-4">
        <button id="simpan_btn" class="btn btn-hero btn-primary mr-50" type="button">
          Simpan
        </button>
      </div>
    </div>
    </form>
  </div>

  @endsection

  @section('js')
  <script type="text/javascript">
    $(document).on('click', '#simpan_btn', function(){
      swal({
          title: 'Apakah anda Yakin?',
          type: 'info',
          confirmButtonText: 'Ya',
          showCancelButton: true,
          cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
              $("#penagihan_form").submit();
          }
      });
    })
    $(document).on('change', '.kirim-checkbox', function(){
      var total = parseInt($("#harga_total").val());
      if(this.checked)
        total += parseInt($(this).data('subtotal'));
      else
        total -= parseInt($(this).data('subtotal'));
      $("#harga_total").val(total);
      $("#total").text(parseFloat(total).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'}));
    })
  </script>
  @endsection