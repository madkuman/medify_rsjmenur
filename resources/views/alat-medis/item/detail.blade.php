@extends('alat-medis.layouts.main')


@foreach($item as $item)
@section('title')
    Barang #{{$item->name}}
@endsection


@section('content')
    <div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
                <small>NAMA BARANG</small> <br>
                {{$item->name}}
            </h3>
            <div class="block-options">
                <button class="btn btn-alt-danger btn-square" data-toggle="modal" data-target="#modal-delete">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                </button>
                <button class="btn btn-alt-primary btn-square" data-toggle="modal" data-target="#modal-edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                </button>
            </div>
            <hr class="my-5">
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col">
                    <label>Merk</label>
                    <p>{{$item->merk}}</p>
                    <label>Model</label>
                    <p>{{$item->model}}</p>
                    <label>Deskripsi</label>
                    <p>{{$item->description}}</p>
                </div>
                @if(isset($item->image_ori) && $item->image_ori!="")
                    <div class="col">
                        <img src="{{url($item->image_ori)}}" alt="" height="250px" style="width:100%;" />
                    </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  method="POST" accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('alat_medis.edit',$item->id)}}">
                            {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Edit Barang</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penyedia">Nama Barang </label>
                                        <input value="{{$item->name}}" type="text" class="form-control" name="name" placeholder="Nama Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Merk Barang  <small>(Opsional)</small></label>
                                        <input value="{{$item->merk}}" type="text" class="form-control" name="merk" placeholder="Merk Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Model Barang  <small>(Opsional)</small></label>
                                        <input value="{{$item->model}}" type="text" class="form-control" name="model" placeholder="Model Barang">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penyedia">Deskripsi Barang  <small>(Opsional)</small></label>
                                        <textarea type="textarea" class="form-control" name="description" > {{$item->description}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            Gambar <small>(Opsional)</small>
                                        </label>
                                        <input type="file" id="upload" name="link_gambar" accept="image/*" data-max-size="1024" class="form-control">
                                        <div class="text-center">
                                            <img id="previewHolder" height="250px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btn-square">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Hapus Barang</h3>
                    </div>
                    <div class="block-content">
                        <p>Apakah Anda benar ingin menghapus item ini?</p>
                        <form  method="post" action="{{route('alat_medis.destroy',$item->id)}}">
                            {{csrf_field()}}
                            {!! method_field('delete') !!}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-danger btn-square">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Daftar Satuan Barang <small>({{$count_stock}} Stok)</small></h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal" data-target="#modal-large">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Barang Satuan
                </button>
            </div>

        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Pasien</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form  id="form_edit" method="post" enctype="multipart/form-data" action="{{route('alat_medis.items.create',$item->id)}}">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Barang Satuan Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" step="any" class="form-control jumlah" name="jumlah" placeholder="Jumlah" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                        <button id="submit_update"  type="submit" class="btn btn-primary btn-square">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection

@section('css')
    <style type="text/css">
        .inline {
            display: inline;
        }
        .modal-content {
            border-radius: 0;
        }
        tr {
            cursor: pointer;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }
        .bootstrap-tagsinput .tag{
            background-color: deepskyblue;
        }
    </style>
    <style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
    </style>
@endsection
@section('js')
    <script>
        var table = $('.dataTable').DataTable({
            ordering: false,
            processing: true,
            serverSide: false,
            bLengthChange: false,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: '{{ route('alat-medis.items.json',$item->slug) }}',
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                { data: 'no_items' },
                { data: 'location' },
                { data: 'status' },
                { data: 'pasien' },
            ],
            columnDefs: [
                {
                    targets:   2,
                    "render": function ( data, type, row, meta ) {
                        if (data==0) {
                            return '<td>Tersedia</td>' ;
                        }
                        else if(data==1){
                            return '<td>Terpakai</td>';
                        }
                        else{
                            return '<td></td>';
                        }
                    }
                },
            ]
        });

        table.on( 'click', 'tbody td', function () {
            var id = table.row(this).data().id;
            $(location).attr('href', '{{url('alat-medis/items/history')}}/'+id);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewHolder').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#upload").change(function () {
            readURL(this);
        });
    </script>
    @endsection