@extends('layouts.main-dashboard')

@section('title')
    Admin - Pengaturan Fitur
@endsection

@section('css')

@endsection

@section('content')

    @include('admin.layouts.components.sidebar')
    @include('layouts.components2.navbar-dashboard')

    <!-- Page Content -->

    <div class="content" style="margin-top:50px;">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Pengaturan Fitur - {{ $module_name_text }}</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search..." id="input-search">
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordion-fitur">
                    <div class="row">
                        @foreach ($form_data as $fitur_key => $fitur)
                            <div class="col-md-12 feature-container" data-key="{{ mb_strtolower(preg_replace('/[^a-zA-Z0-9]+/', '', $fitur_key)) }}">
                                <hr>
                                <h5><a href="javascript:void(0)" class="text-decoration-underline" data-toggle="collapse"
                                        data-target="#collapse-{{ $fitur_key }}">Fitur - {{ $fitur['judul'] }}</a></h5>
                                <div id="collapse-{{ $fitur_key }}" class="collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                    data-parent="#accordion-fitur">
                                    <p>{{ $fitur['deskripsi'] }}</p>
                                    <form action="" method="post" class="form-ajax">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="fitur_key" value="{{ $fitur_key }}">
                                        <div class="row">
                                            @foreach ($fitur['input'] as $input_id => $input)
                                                @php $input['id'] = $input_id @endphp
                                                @include('admin.pengaturan-fitur.components.form.'.$input['type'],$input)
                                            @endforeach
                                        </div>
                                        @include('admin.pengaturan-fitur.components.form.submit')
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
        let size_option = {
            'small': [570, 520],
            'medium': [1000, 760],
        };

        $('.btn-action-preview').on('click', function() {
            let url = $(this).data('url');
            let size = $(this).data('size') || 'small';

            let option = size_option[size];

            window.open(url, '_blank', 'location=yes,height=' + option[0] + ',width=' + option[1] + ',scrollbars=yes,status=yes');
        })

        $('.form-ajax').submit(function(e) {
            e.preventDefault();
            setActiveButton($(this).find('button[type="submit"]'), false);

            let form_data = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                dataType: "JSON",
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    setActiveButton($(this).find('button[type="submit"]'), true);
                    callSwal(response.status == 1 ? 'success' : 'error', response.title, response.message, 0)
                }
            })
        });

        $('#input-search').on('input', function() {
            let val = $(this).val();
            val = val.replace(/[^0-9A-Z]+/gi, "");
            val = val.toLowerCase();

            if (val == "") {
                $('.feature-container').show(200);
            } else {
                $('.feature-container').not('[data-key*="' + val + '"]').hide(200);
                $('[data-key*="' + val + '"]').show(200);
            }
        })

        tinymce.init({
            selector: '.wysiwyg',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            },
        });
    </script>
@endsection
