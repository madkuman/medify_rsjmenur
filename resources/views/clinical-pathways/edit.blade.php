@extends('layouts.main2')

@section('title')
    Edit - Clinical Pathway - Medify
@endsection

@section('content')
    <style type="text/css">
        .block-content.large {
            width: 85%;
            padding-top: 35px;
            padding-bottom: 35px;
        }

        .back-link {
            margin-bottom: 40px;
        }

        .bootstrap-tagsinput {
            border: none;
            box-shadow: none;
            padding: 2px 0;
        }

        .bootstrap-tagsinput .badge {
            font-size: 90%;
            padding: 6px 8px;
        }
    </style>

    <main id="main-container">
        <div class="content">
            <div class="block">
                <div class="block-content large">
                    <div class="back-link"><a href="/clinical-pathways"><i class="far fa-arrow-alt-circle-left"></i> Kembali ke Menu Utama</a></div>

                    <div>
                        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal-popout">Hapus</button>
                        <h2>Edit Clinical Pathway</h2>
                    </div>

                    <form method="post" action="/clinical-pathways/{{ $article->id }}/update" id ="my-form">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">Judul Referensi</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Judul Referensi" value="{{ $article->title }}" required>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="diagnosis">Pilih Diagnosis</label>
                                <select name="icd10_id" class="form-control" id="diagnosis" placeholder="Diagnosis" required>
                                    <option value="{{ $article->icd10_id }}" selected="selected">{{ $article->icd10->long_desc }}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="categories">Kategori</label>
                                <div class="form-control">
                                    <input type="text" name="categories" value="{{ implode(',', array_pluck($article->categories, 'name')) }}" data-role="tagsinput" class="form-control" placeholder="Ketik Kategori" id="categories" style="display: none;">
                                </div>
                                <p>Tekan ENTER untuk setiap kategori</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Deskripsi Referensi</label>
                            <textarea name="content" class="form-control" id="content" rows="10" placeholder="Deskripsi Referensi">{{ $article->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="reference">File Referensi</label>
                            <div class="dropzone" id="my-dropzone"></div>
                        </div>

                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Delete confirmation box -->
    <div class="modal fade" id="modal-popout" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Konfirmasi hapus</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <h4>Apakah anda yakin ingin menghapus Clinical Pathway ini?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="/clinical-pathways/{{ $article->id }}/delete">
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" id="delete-btn" class="btn btn-alt-danger">
                            <i class="fa fa-check"></i> Ya
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ URL::asset('/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script> 
    <script src="{{ URL::asset('/assets/js/bootstrap-tagsinput.js') }}" type="text/javascript"></script>
    <script>
        tinymce.init({
            selector:'#content' 
        });

        $('#diagnosis').select2({
            placeholder: 'Diagnosis',
            ajax: {
                url: function (params) {
                    return '/diagnosis/search/' + params.term;
                },
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    var selectobj = $.map(data, function (v) {
                        return {"text": v['long_desc'], "id": v['id']}
                    });
                    return {
                        results: selectobj
                    }
                },
                cache: true
            }
        });

        $('#categories').tagsinput({
            tagClass: function (item) {
                return 'badge badge-info text-capitalize';
            },
            confirmKeys: [9, 13, 44]
        });

        //Add existing files into dropzone
        var existingFiles = [
            @foreach ($article->files as $file)
                {
                    name: "{{ $file->original_name }}",
                    type: "{{ $file->type }}",
                    size: {{ $file->size }},
                    id: {{ $file->id }},
                    dataURL: "/uploads/clinical-pathways/{{ $file->name }}"
                },
            @endforeach
        ];

        Dropzone.options.myDropzone = {
            url: '/clinical-pathways/upload',
            params: {
                _token: "{{ csrf_token() }}"
            },
            addRemoveLinks: true,
            init: function () {
                var myDropzone = this;

                this.on('success', function (file, response) {
                    file.id = file.id || response;
                    var input = '<input type="hidden" name="files[]" value="' + file.id + '">';
                    $('#my-form').append(input);
                });

                this.on('removedfile', function (file) {
                    $('input[name="files[]"][value="' + file.id + '"]').remove();
                });

                for (let i = 0; i < existingFiles.length; i++) {
                    myDropzone.emit("addedfile", existingFiles[i]);

                    // Add thumbnail for images
                    if (existingFiles[i].type.match(/image.*/)) {
                        myDropzone.createThumbnailFromUrl(existingFiles[i],
                            myDropzone.options.thumbnailWidth, myDropzone.options.thumbnailHeight,
                            myDropzone.options.thumbnailMethod, true, function(thumbnail) {
                                myDropzone.emit('thumbnail', existingFiles[i], thumbnail);
                            });
                    }

                    myDropzone.emit("success", existingFiles[i]);
                    myDropzone.emit("complete", existingFiles[i]);
                    myDropzone.files.push(existingFiles[i]);
                }
            }
        };
    </script>
@endsection