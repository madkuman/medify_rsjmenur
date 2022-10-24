@extends('aset.layouts.main')


@section('title')
Barang #{{$itemtemplate->name}}
@endsection


@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>NAMA BARANG</small> <br>
            	{{$itemtemplate->name}}
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
                		<label>HARGA SAAT INI</label>
                        <p>{{formatCurrency($itemtemplate->price)}}</p>
                		<label>STOCK</label>
                        <p>{{$itemtemplate->items()->count()}}</p>
                		<label>SATUAN STOCK</label>
                        <p>{{$itemtemplate->satuan}}</p>
                        <label>KATEGORI</label>
                        <p>
                            @foreach($itemtemplate->category as $list_category)
                                <a href="{{url('aset/category',$list_category->slug)}}"><span class="badge badge-primary">{{$list_category->name}}</span></a>
                            @endforeach
                        </p>
                	</div>
                	<div class="col">
                		<label>MERK</label>
                        <p>{{$itemtemplate->merk}}</p>
                		<label>MODE</label>
                        <p>{{$itemtemplate->model}}</p>
                		<label>KETERANGAN</label>
                        <p>{{$itemtemplate->description}}</p>
                	</div>
                    @if(isset($itemtemplate->image_ori) && $itemtemplate->image_ori!="")
                        <div class="col">
                        <img src="{{url($itemtemplate->image_ori)}}" alt="" style="width:100%;" />
                    </div>
                    @endif
                </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Daftar Satuan Barang <small>( Stok)</small></h3>
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
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Lokasi</th>
                        <th>Harga</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form  id="form_edit" method="post" enctype="multipart/form-data" action="{{route('admin.items.create',$itemtemplate->id)}}">
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
                                        <input id="dengan-rupiah" value="{{$itemtemplate->price}}" type="text" class="form-control total_price" name="price" placeholder="Harga Satuan" required>
                                    </div>
                                </div>
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

    <div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('items_template.update',$itemtemplate->id)}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Edit Barang</h3>
                        </div>
                        <div class="block-content">
                            {{csrf_field()}}
                            {!! method_field('patch') !!}
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penyedia">Nama Barang</label>
                                        <input value="{{$itemtemplate->name}}" type="text" class="form-control" name="name" placeholder="Nama Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Merk Barang  <small>(Opsional)</small></label>
                                        <input value="{{$itemtemplate->merk}}" type="text" class="form-control" name="merk" placeholder="Merk Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Model Barang  <small>(Opsional)</small></label>
                                        <input value="{{$itemtemplate->model}}" type="text" class="form-control" name="model" placeholder="Model Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Harga Pasar Barang</label>
                                        <input id="dengan-rupiah1"  value="{{$itemtemplate->price}}" type="text" class="form-control" name="price" placeholder="Harga Pasar Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Satuan  <small>(Opsional)</small></label>
                                        <input value="{{$itemtemplate->satuan}}" type="text" class="form-control" name="satuan" placeholder="Satuan Barang">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            Kategori Barang
                                            @if(sizeof($category)==0)
                                                <br>
                                                <small style="color: red;">Tidak Ada Kategori! <a target="_blank" href="{{route('category.index')}}">tambahkan kategori barang</a></small>
                                            @endif
                                        </label>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select style="width: 100%" id="tags" name="kategori[]" multiple="multiple">
                                                    @foreach(\App\Models\Aset\CategoryItemsTemplate::where('items_template_id',$itemtemplate->id)->get() as $list_category)
                                                        <option selected="selected">{{$list_category->category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Deskripsi  <small>(Opsional)</small>
                                        </label>
                                        <textarea type="text" name="description" class="form-control">{{$itemtemplate->description}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            Gambar  <small>(Opsional)</small>
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
                            <form  method="post" action="{{route('items_template.destroy',$itemtemplate->id)}}">
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
    <script type="text/javascript">
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });

        $('#btnFilter').on('click', function(){
            $(this).addClass('d-none');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function(){
            $(this).parents('#filter-data').addClass('d-none');
            $('#btnFilter').removeClass('d-none');
        });
    </script>
    <script>
        var table = $('.dataTable').DataTable({
            ordering: false,
            processing: false,
            serverSide: false,
            bLengthChange: false,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: '{{ route('admin.items.json',$itemtemplate->slug) }}',
            columns: [
                { data: 'id' },
                { data: 'image_thumb' },
                { data: 'location' },
                { data: 'price' },
                { data: 'condition' },
                { data: 'status' },
                { data: 'description' },
                { data: 'status' },
            ],
            columnDefs: [{
                targets:   1,
                "render": function ( data, type, row, meta ) {
                    console.log(data);
                    if (data != "" && data != null) {
                        return '<div style="display: block; width: 30px; height: 30px; background:url('+"'"+'../../'+data+"'"+'); background:#1a8b8c, #1a8b8c; background-position: center; background-size: cover; border-radius: 100%"></div>';
                    }else{
                        @if($itemtemplate->image_thumb && $itemtemplate->image_thumb!="")
                            return '<div style="display: block; width: 30px; height: 30px; background:url('+"'"+'../../{{$itemtemplate->image_thumb}}'+"'"+'); background:#1a8b8c, #1a8b8c; background-position: center; background-size: cover; border-radius: 100%"></div>';
                        @else
                            return '<div style="display: block; width: 30px; height: 30px; background: #1a8b8c; background-position: center; background-size: cover; border-radius: 100%"><p align="center" style="color: #fff; margin: auto; line-height: 30px; font-size:12px">'+row.itemstemplate.name.substring(0, 2)+row.id+'</p></div>';
                        @endif
                    }
                }
            },
                {
                targets:   4,
                "render": function ( data, type, row, meta ) {
                    return row.itemscondition.name;
                }
            },
                {
                    targets:   5,
                    "render": function ( data, type, row, meta ) {
                        return row.itemsstatus.name;
                    }
                },
                {
                    targets:   7,
                    "render": function ( data, type, row, meta ) {
                        return row.user.name;
                    }
                },{
                    targets:   3,
                    "render": function ( data, type, row, meta ) {
                        return convert_rupiah(data);
                    }
                },

            ]
        });

        table.on( 'click', 'tbody td', function () {
            var id = table.row(this).data().id;
            $(location).attr('href', '{{url('aset/items/history')}}/'+id);
        });

        // $('#myInputTextField').keyup(function(){
        //     table.search($(this).val()).draw() ;
        // })
        $('#tags').select2({
            data: [
                @foreach($category as $list_category)
                    '{{$list_category->name}}',
                @endforeach
            ],
            tags: true,
            tokenSeparators: [','],
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

        $("#upload").change(function() {
            readURL(this);
        });
        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e)
        {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        dengan_rupiah.value = formatRupiah(dengan_rupiah.value, 'Rp. ');

        var dengan_rupiah1 = document.getElementById('dengan-rupiah1');
        dengan_rupiah1.addEventListener('keyup', function(e)
        {
            dengan_rupiah1.value = formatRupiah(this.value, 'Rp. ');
        });

        dengan_rupiah1.value = formatRupiah(dengan_rupiah1.value, 'Rp. ');
    </script>
@endsection