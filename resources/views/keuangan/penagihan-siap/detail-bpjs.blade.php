@extends('keuangan.layouts.main')

@section('title')
Detail Penagihan BPJS - Keuangan
@endsection

@section('css')

@endsection
@section('content')
@include('keuangan.piutang.components.header')
<div class="block">
  <div class="block-content">
    <a href="{{url('keuangan/penagihan-siap/'.$paket->slug)}}" class="btn btn-hero btn-info pull-right">Kembali</a>
    <h4 class="mb-30">{{$paket->judul}}</h4>
    <hr>
    <div class="row">
      <div class="col-6">
        <h5>Nomor Surat : {{is_null($paket->nomor_surat) ? '-' : $paket->nomor_surat}}</h5>    
      </div>
      <div class="col-6">
        <h5>FPK : {{is_null($penagihan_bpjs->fpk) ? '-' : $penagihan_bpjs->fpk}}
          @if(is_null($penagihan_bpjs->confirmed_by))
            <button class="btn btn-info ml-50" id="edit_fpk"><i class="fa fa-pencil"></i> Edit</button></h5>    
          @endif
      </div>
    </div>
    <hr>
    <h5>{{$penagihan_bpjs->kategori_bpjs->title}}</h5>
  </div>
  <form method="POST" id="penagihan_form">
    <input type="hidden" name="method" value="save" id="form_method">
  <div class="block-content">
      {{csrf_field()}}
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
              @if(is_null($penagihan_bpjs->confirmed_by))
                <label class="css-control css-control-primary css-checkbox">
                  <input type="checkbox" class="css-control-input kirim-checkbox" @if($item->status == 1) checked="" @endif name="pivot_id[]" value="{{$item->id}}" data-subtotal="{{$item->total}}">
                  <span class="css-control-indicator"></span> Kirim
                </label>
              @else
                Terkirim
              @endif
            </td>
          </tr>
            @if($item->status == 1)
              @php $total += $item->total @endphp
            @endif
            @endforeach
          </tbody>
          <input type="hidden" id="harga_total" value="{{$total}}">
          <tr>
            <td colspan="2"><strong>Total</strong></td>
            <td colspan="2"><strong id="total">Rp {{number_format($total)}}</strong></td>
          </tr>
        </table>
    </div>
    @if(is_null($penagihan_bpjs->confirmed_by))
      <div class="row mb-20">
        <div class="col-8"></div>
        <div class="col-4">
          <button id="simpan_btn" class="btn btn-hero btn-primary mr-50" type="submit">
            Simpan
          </button>
          <button id="confirm_btn" class="btn btn-hero btn-warning" type="button">
            <i class="fa fa-paperplane"></i>
            Konfirmasi
          </button>
        </div>
      </div>
    @endif
    </form>
  </div>
  @include('keuangan.penagihan-siap.components.modal-edit-fpk')
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
    $(document).on('click', '#confirm_btn', function(){
      swal({
          title: 'Apakah anda yakin mengonfirmasi penagihan ini?',
          text: 'Penagihan tidak dapat diubah setelah dikonfirmasi',
          type: 'info',
          confirmButtonText: 'Ya',
          showCancelButton: true,
          cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
              $("#form_method").val("confirm");
              $("#penagihan_form").submit();
          }
      });
    })
    $(document).on('click', '#edit_fpk', function(){
      $("#edit_fpk_modal").modal('show');
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