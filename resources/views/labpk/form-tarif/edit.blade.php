@extends('layouts.main2')
@section('title')
{{$tarif->deskripsi}} - Edit Form - Pengaturan
@endsection
@section('css')

@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">{{$tarif->deskripsi}} - Edit Form</h3>
        </div>
        <div class="block-content">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Tambah Parameter</label>
                            <select class="js-select2 form-control" name="form_id[]" multiple required>
                                @foreach($forms_available as $item)
                                <option value="{{$item->id}}">{{$item->parameter}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content">
            <h5>Form Pada Tarif Ini</h5>
            <hr>
            <table class="table table-striped js-dataTable-full">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Parameter</td>
                        <td>Satuan</td>
                        <td>Metode</td>
                        <td>Hapus</td>
                        <td>Lihat</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($form_tarif as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->form->parameter}}</td>
                        <td>{{$item->form->satuan}}</td>
                        <td>{{$item->form->metode}}</td>
                        <td>
                            <button class="btn btn-danger btn-sm deleteButton" data-id="{{$item->id}}"><i class="fa fa-trash"></i> Hapus Form</button>
                        </td>
                        <td>
                            <a class="btn btn-secondary btn-sm" href="{{url('')}}/labpk/pengaturan/form/edit/{{$item->form_id}}"><i class="fa fa-paper-plane"></i> Lihat Form</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@include('labpk.components.footer')

@endsection
@section('js')

@section('js')
<script type="text/javascript">

    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
        autoWidth: false
    });

    $('.deleteButton').click(function(){
        var id = $(this).data('id')
        swal({
            title: 'Apakah anda yakin?',
            text: "Data tidak dapat dikembalikan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-secondary',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "labpk/pengaturan/form-tarif/delete/"+id,
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            callSwal(data.type,data.title,data.message,0);
                            if(data.type == 'success')
                                location.reload();
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    });
</script>
@endsection
@endsection