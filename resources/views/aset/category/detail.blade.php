@extends('aset.layouts.main')


@section('title')
{{$kategori->name}} - Kategori Barang
@endsection


@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>KATEGORI</small> <br>
                {{$kategori->name}}
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
                		<label>SLUG</label>
                		<p>{{$kategori->slug}}</p>
                        <label>DESKRIPSI</label>
                        <p>{{$kategori->description}}</p>
                	</div>
                	<div class="col">
                		<label>DIBUAT PADA</label>
                		<p>{{indonesian_date($kategori->created_at)}}</p>
                		<label>DIUPDATE PADA</label>
                		<p>{{indonesian_date($kategori->updated_at)}}</p>
                	</div>
                </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Kategori Barang </h3>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Users</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($kategoritemplate as $count=> $list)
                    @php $list=\App\Models\Aset\ItemsTemplate::find($list->items_template_id); @endphp
                    <tr>
                        <td>{{$count+1}}</td>
                        <td style="text-align: center">@if(isset($list->image_thumb) && $list->image_thumb!="")
                                <a data-toggle="modal" data-target="#gambar_{{$list->id}}">
                                    <div style="display: block; width: 40px; height: 40px; background:url({{url($list->image_thumb)}}), rgba(255,255,255,0.49); background-position: center; background-size: cover; border-radius: 100%">
                                    </div>
                                </a>
                                <div class="modal fade " id="gambar_{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                                    <div class="modal-dialog modal-lg" role="document" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Lihat Gambar</h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{url($list->image_ori)}}" alt="" style="width:100%;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div style="display: block; width: 40px; height: 40px;background:  #1a8b8c; background-position: center; background-size: cover; border-radius: 100%">
                                    <p align="center" style="color: #fff; margin: auto; line-height: 40px">{{strtoupper(substr($list->name, 0,2))}}</p>
                                </div>
                            @endif</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->merk}}</td>
                        <td>{{$list->model}}</td>
                        <td>
                            @foreach(\App\Models\Aset\CategoryItemsTemplate::where('items_template_id',$list->id)->get() as $list_category)
                                <a href="{{url('aset/category')}}/'+value.slug+'"><span style="margin-right:2px" class="badge badge-info">{{$list_category->category->name}}</span></a>
                            @endforeach
                        </td>
                        <td>{{$list->description}}</td>
                        <td>{{$list->user->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('category.update',$kategori->id)}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Edit Kategori</h3>
                        </div>
                        <div class="block-content">
                            {{csrf_field()}}
                            {!! method_field('patch') !!}
                            <div class="form-group">
                                <label class="form-label">Nama Kategori</label>
                                <input value="{{$kategori->name}}" name="name" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    Deskripsi
                                </label>
                                <textarea type="text" name="description" class="form-control">{{$kategori->description}}</textarea>
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
                            <h3 class="block-title">Hapus Kategori</h3>
                        </div>
                        <div class="block-content">
                            <p>Apakah Anda benar ingin menghapus item ini?</p>
                            <form  method="post" action="{{route('category.destroy',$kategori->id)}}">
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
		.bordered {
			border-bottom: 1px solid #eaecee;
		}
	</style>
@endsection

@section('js')
    <script>
        var table = $('.dataTable').DataTable({
            ordering: false,
        });
    </script>
@endsection
