@extends('aset.layouts.main')

@section('title')
Daftar Barang - {{$itemtemplate->name}}
@endsection

@section('content')
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" />

	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">
            	<small>NAMA BARANG SATUAN</small> <br>
            	{{$itemtemplate->name}} {{$items->id}}
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
                		<label>LOKASI</label>
                        <p>{{$items->location}}</p>
                		<label>KONDISI</label>
                        <p>{{$items->itemscondition->name}}</p>
                        <label>STATUS</label>
                        <p>{{$items->itemsstatus->name}}</p>
                	</div>
                	<div class="col">
                        <label>TRANSAKSI ID</label>
                        <p>@if(isset($items->transaction))
                                <a href="{{route('transaction.show',$items->transaction->kode)}}"><u>{{$items->transaction->kode}}</u></a>
                            @endif</p>
                        <label>HARGA</label>
                        <p>{{formatCurrency($items->price)}}</p>
                		<label>KETERANGAN</label>
                        <p>{{$items->description}}</p>
                	</div>
                    @if(isset($items->image_ori) && $items->image_ori!="")
                        <div class="col">
                        <img src="{{url($items->image_ori)}}" alt="" style="width:100%;" />
                        </div>
                        @elseif(isset($itemtemplate->image_ori) && $itemtemplate->image_ori!="")
                        <div class="col">
                            <img src="{{url($itemtemplate->image_ori)}}" alt="" style="width:100%;" />
                        </div>
                        @endif
                </div>
            </div>
    </div>

    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Log Barang Satuan<small>({{sizeof($history)}} Log)</small></h3>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Kondisi</th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th>Desk</th>
                    <th>Admin</th>
                    <th>Ket</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-edit" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  id="form_edit" method="post" accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('admin.items.update',$items->id)}}">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Edit Barang Satuan</h3>
                        </div>
                        <div class="block-content">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col">

                                    <div class="form-group">
                                        <label class="form-label">
                                            Kondisi
                                        </label>
                                        <select name="condition" id="condition"class="js-select2 select2 form-control" style="width: 100%;" required>
                                            @foreach($itemscondition as $items_condition)
                                                <option @if($items->condition==$items_condition->id){{'selected'}}@endif value="{{$items_condition->id}}">{{$items_condition->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            Status
                                        </label>
                                        <select name="status" id="status" class="js-select2 select2 form-control" style="width: 100%;" required>
                                            @foreach($itemsstatus as $items_status)
                                                <option @if($items->status==$items_status->id){{'selected'}}@endif value="{{$items_status->id}}">{{$items_status->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            Harga
                                        </label>
                                        <input  id="dengan-rupiah" type="text" name="price" class="form-control" value="{{$items->price}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            Lokasi
                                        </label>
                                        <div class="row" style="padding: 5px">
                                            <div class="col-md-12" style="bottom: 5px">
                                                <select name="location" id="state" class="form-control" style="width: 100%" required>
                                                    @foreach($itemslocation as $items_status)
                                                        <option @if($items_status->name==$items->location){{'selected'}}@endif value="{{$items_status->name}}">{{$items_status->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-8">
                                                <input placeholder="Masukkan Opsi Lain" id="new-state" class="form-control" type="text" />
                                                </br>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-primary" id="btn-add-state">Lokasi Baru</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Deskripsi
                                        </label>
                                        <textarea type="text" name="description" class="form-control">{{$items->description}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Gambar</label>
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
                        <button id="submit_update" type="submit" class="btn btn-primary btn-square">
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
                            <h3 class="block-title">Hapus Barang Satuan</h3>
                        </div>
                        <div class="block-content">
                            <p>Apakah Anda benar ingin menghapus item ini?</p>
                            <form  method="post" action="{{route('admin.items.delete',$items->id)}}">
                                {{csrf_field()}}
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
        .clickable-row {
            cursor: pointer;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }
        td {
            font-size: 0.8em;
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
    <!-- Bootstrap tags input -->
    <script src="{{asset('/js/bootstrap-tagsinput.js')}}"></script>
    <!-- Type aheaed -->
    <script src="{{ asset('/js/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/bloodhound.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        // Get the reference to the input field

        var skills = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '{!!url("/")!!}' + '/api/find/%QUERY%',
                wildcard: '%QUERY%',
            }
        });
        skills.initialize();
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#state").select2({
                tags: true
            });
            $("#condition").select2();
            $("#status").select2();

            $("#btn-add-state").on("click", function(){
                var newStateVal = $("#new-state").val();
                // Set the value, creating a new option if necessary
                if ($("#state").find("option[value='" + newStateVal + "']").length) {
                    $("#state").val(newStateVal).trigger("change");
                } else {
                    // Create the DOM option that is pre-selected by default
                    var newState = new Option(newStateVal, newStateVal, true, true);
                    // Append it to the select
                    $("#state").append(newState).trigger('change');
                }
            });
        });

    </script>
    <script type="text/javascript">

        $('#txtSkills').tagsinput({
            itemValue : 'id',
            itemText  : 'name',
            maxChars: 20,
            trimValue: true,
            allowDuplicates : false,
            freeInput: false,
            focusClass: 'form-control',
            tagClass: function(item) {
                if(item.display)
                    return 'label label-' + item.display;
                else
                    return 'label label-default';

            },
            onTagExists: function(item, $tag) {
                $tag.hide().fadeIn();
            },
            typeaheadjs: [{
                hint: false,
                highlight: true
            },
                {
                    name: 'skills',
                    itemValue: 'id',
                    displayKey: 'name',
                    source: skills.ttAdapter(),
                    templates: {
                        empty: [
                            '<ul class="list-group"><li style="background-color: #eaeebd" class="list-group-item">Nothing found.</li></ul>'
                        ],
                        header: [
                            '<ul class="list-group">'
                        ],
                        suggestion: function (data) {
                            return '<li style="background-color: #eaeebd" class="list-group-item">' + data.name + '</li>'
                        }
                    }
                }]
        });
        @foreach(\App\Models\Aset\CategoryItemsTemplate::where('items_template_id',$itemtemplate->id)->get() as $list_category)
        $('#txtSkills').tagsinput('add', { id: '{{$list_category->category->id}}', name: '{{$list_category->category->name}}' }, {preventPost: true});
        @endforeach


    </script>

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
            ajax: '{{ route('admin.items.history.json',$items->id) }}',
            columns: [
                { data: 'tanggal' },
                { data: 'location' },
                { data: 'condition' },
                { data: 'status' },
                { data: 'price' },
                { data: 'description' },
                { data: 'email' },
                { data: 'keterangan' },
            ],

            columnDefs: [{
                targets:   0,
                "render": function ( data, type, row, meta ) {
                    return date_manusia(data);
                }
            },{
                targets:   4,
                "render": function ( data, type, row, meta ) {
                    return convert_rupiah(data);
                }
            },

            ],
        });


        // $('#myInputTextField').keyup(function(){
        //     table.search($(this).val()).draw() ;
        // })
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
    </script>
@endsection