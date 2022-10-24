@extends('layouts.main-dashboard')

@section('title')
Admin - 
    @if(empty($data))
    Input Pembayaran Perusahaan Baru
    @else
    Edit Pembayaran Perusahaan
    @endif
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
    <div class="block p-10">
        <div class="block-header">
            <h3 class="block-title">
                @if(empty($data))
                Input Pembayaran Perusahaan Baru
                @else
                Edit Pembayaran Perusahaan
                @endif
            </h3>
        </div>
        <div class="block-content">
            <!--ketika dikoding ini diganti ya action sama methodnya -->
            <form action="{{url('admin/pembayaran-perusahaan/simpan')}}" method="POST">
            {{csrf_field()}}
            @if(!empty($data))
            <input type="hidden" name="id" value="{{$data->id}}">
            @endif          
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" name="nama" 
                            @if(!empty($data))
                            value="{{$data->nama}}"
                            @endif autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Tipe</label>
                            <select class="form-control" name="type">
                                @foreach($tipe_list as $tipe)
                                    <option value="{{ $tipe->id }}"
                                        @if(!empty($data) && $data->type == $tipe->id)
                                            selected
                                        @endif >{{ $tipe->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Perusahaan Keuangan</label>
                            <select class="form-control js-select2" name="perusahaan_keuangan_id">
                                <option></option>
                                @foreach($perusahaan_keuangan as $item)
                                    <option value="{{ $item->id }}"
                                        @if(!empty($data) && $data->perusahaan_keuangan_id == $item->id)
                                            selected
                                        @endif >{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <small>Tidak menemukan perusahaan? Atur perusahaan <a target="_blank" href="{{url('keuangan/pengaturan/rekanan')}}">disini</a></small>
                        </div>
                        <div class="form-group">
                            <label>SIRS : Cara Bayar</label>
                            <select class="form-control js-select2" name="cara_bayar">
                                <option></option>
                                @foreach($cara_bayar as $cara)
                                    <option value="{{ $cara->id }}"
                                        @if(!empty($data) && $data->cara_bayar == $cara->id)
                                            selected
                                        @endif >{{ $cara->nomor }}) {{ $cara->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-hero pull-right">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')



<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });

    function deleteModal(id)
    {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Pembayaran perusahaan akan dihapus.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-secondary',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.value) {
                swal(
                    'Sukses!',
                    'Pembayaran perusahaan berhasil dihapus.',
                    'success'
                    )
            }
        })

    }
</script>

@endsection