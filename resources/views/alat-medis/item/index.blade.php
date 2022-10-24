@extends('alat-medis.layouts.main')


@section('title')
    Barang
@endsection


@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Alat Medis</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal"
                        data-target="#modal-large">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Alat Medis Baru
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="block">
                <button type="submit" class="btn btn-secondary btn-square" id="btnFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter Data
                </button>
                <div class="d-none" id="filter-data">
                    <form id="search-form">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">NAMA </label>
                                    <input type="text" class="form-control" name="nama_filter" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">MERK </label>
                                    <input type="text" class="form-control" name="merk_filter" placeholder="Merk">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">MODEL </label>
                                    <input type="text" class="form-control" name="model_filter" placeholder="Model">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">DESCRIPTION </label>
                                    <input type="text" class="form-control" name="description_filter"
                                           placeholder="Deskripsi">
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btn-square" id="btnCancel">Batalkan
                                </button>
                                <button type="submit" class="btn btn-primary btn-square">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <hr>
            <table class="table table-bordered table-striped table-vcenter dataTable">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form_edit" method="post" enctype="multipart/form-data"
                  action="{{route('alat_medis.create')}}">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title">Alat Medis Baru</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penyedia">Nama Barang</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nama Barang"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Merk Barang
                                            <small>(Opsional)</small>
                                        </label>
                                        <input type="text" class="form-control" name="merk" placeholder="Merk Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="penyedia">Model Barang
                                            <small>(Opsional)</small>
                                        </label>
                                        <input type="text" class="form-control" name="model" placeholder="Model Barang">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Deskripsi Barang
                                            <small>(Opsional)</small>
                                        </label>
                                        <textarea type="text" name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">
                                            Foto
                                            <small>(Opsional)</small>
                                        </label>
                                        <input type="file" id="upload" name="link_gambar" accept="image/*"
                                               data-max-size="1024" class="form-control">
                                        <div class="text-center"><img id="previewHolder" height="250px"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan
                        </button>
                        <button id="submit_update" type="submit" class="btn btn-primary btn-square">
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
        .error {
            color: red;
        }

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

        .bootstrap-tagsinput .tag {
            background-color: deepskyblue;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(".clickable-row").click(function () {
            window.location = $(this).data("href");
        });

        $('#btnFilter').on('click', function () {
            $(this).addClass('d-none');
            $('#filter-data').removeClass('d-none');
        });

        $('#btnCancel').on('click', function () {
            $(this).parents('#filter-data').addClass('d-none');
            $('#btnFilter').removeClass('d-none');
        });
    </script>

    <script>
        var table = $('.dataTable').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            bLengthChange: false,
            pageLength: 10,
            responsive: true,
            scrollY: "calc( 100% - 70px )",
            scrollCollapse: true,
            ajax: {
                url: '{{route('alat_medis.json')}}',
                data: function (d) {
                    d.name = $('input[name=nama_filter]').val();
                    d.merk = $('input[name=merk_filter]').val();
                    d.model = $('input[name=model_filter]').val();
                    d.description = $('input[name=description_filter]').val();
                }
            },
            language: {
                processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
            },
            columns: [
                {data: 'id'},
                {data: 'image_thumb'},
                {data: 'name'},
                {data: 'jumlah'},
                {data: 'merk'},
                {data: 'model'},
                {data: 'description'},
            ],
            columnDefs: [{
                targets: 1,
                "render": function (data, type, row) {
                    if (data != "" && data != null) {
                        return '<div style="display: block; width: 30px; height: 30px; background:url(' + "../" + data + '); background:#1a8b8c, #1a8b8c; background-position: center; background-size: cover; border-radius: 100%"></div>';
                    } else {
                        return '<div style="display: block; width: 30px; height: 30px; background: #1a8b8c; background-position: center; background-size: cover; border-radius: 100%"><p align="center" style="color: #fff; margin: auto; line-height: 30px; font-size:12px">' + row.name.substring(0, 2) + '</p></div>';
                    }
                }
            },
            ]

        });

        table.on('click', 'tbody td', function () {
            var slug = table.row(this).data().slug;
            $(location).attr('href', '{{url('alat-medis/items_template')}}/' + slug);
        });

        $('#search-form').on('submit', function (e) {
            table.draw();
            e.preventDefault();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
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

