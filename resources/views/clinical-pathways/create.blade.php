@extends('layouts.main2')

@section('title')
    Buat Baru - Clinical Pathway - Medify
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

                    <h2>Buat Baru Clinical Pathway</h2>

                    <form method="post" action="/clinical-pathways" id="my-form">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">Judul Referensi</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Judul Referensi" required>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="diagnosis">Pilih Diagnosis</label>
                                <select name="icd10_id" class="form-control" id="diagnosis" placeholder="Diagnosis" required></select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="categories">Kategori</label>
                                <div class="form-control">
                                    <input type="text" name="categories" value="" data-role="tagsinput" placeholder="Ketik Kategori" id="categories" style="display: none;">
                                </div>
                                <p>Tekan ENTER untuk setiap kategori</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Deskripsi Referensi</label>
                            <textarea name="content" class="form-control" id="content" rows="15" placeholder="Deskripsi Referensi"></textarea>
                        </div>

                        <div class="form-group">
                            <label>File Referensi</label>
                            <div class="dropzone" id="my-dropzone"></div>
                        </div>

                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-primary float-right" id="submit-all">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
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
            }
        };
    </script>
@endsection