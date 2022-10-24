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
            <h4>{{ $paket->judul }}</h4>
            <hr>
            <button class="btn btn-alt-warning btn-hero pull-right mb-20" id="btn_kirim">Kirim Penagihan</button>
        </div>
        <div class="block-content">
            <form action="{{ url('keuangan/penagihan/' . $paket->slug) }}" method="POST" id="penagihanForm">
                {{ csrf_field() }}
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

                    @foreach ($paket->detail as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->pasien->name }}</td>
                            <td>PTG{{ $item->id }}</td>
                            <td>Rp {{ number_format($item->total) }}</td>
                            <td>
                                <label class="css-control css-control-success css-checkbox">&nbsp;
                                    <input type="checkbox" class="css-control-input piutang-id" name="piutang_id[]"
                                        value="{{ $item->id }}" data-subtotal="{{ $item->total }}">&nbsp;<span
                                        class="css-control-indicator"></span></label>
                            </td>
                        </tr>
                        @php $total = $total + $item->total @endphp
                    @endforeach
                    <tr>
                        <td colspan="4"><strong>Total</strong></td>
                        <td><strong>Rp {{ number_format($total) }}</strong></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>

    @include('keuangan.penagihan-siap.components.modal-bayar')
@endsection

@section('js')
    <script type="text/javascript">
        $(document).on('click', '#btn_kirim', function() {
            swal({
                title: 'Apakah anda Yakin?',
                text: "Piutang yang tidak dicentang akan dikembalikan",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    $("#penagihanForm").submit();
                }
            })
        })
    </script>
@endsection
