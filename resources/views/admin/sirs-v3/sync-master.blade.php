@extends('layouts.main-dashboard')

@section('title')
Admin - SIRS V3 - Pekerjaan
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/datatables.min.css')}}"/>
@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Auto Sync Master Data SIRS V3</h3>
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
                    @foreach ($api_list as $item)
                        @php
                        $name = str_replace('-', ' ', $item->slug);
                        $name = ucfirst($name);
                        $kolom = json_decode($item->kolom_values, true);
                        @endphp
                        <div class="col-md-12 feature-container" data-key="{{ $name }}">
                            <hr>
                            <h5><a href="javascript:void(0)" class="text-decoration-underline" data-toggle="collapse"
                                    data-target="#collapse-{{ $item->slug }}">{{ $name }}</a></h5>
                            <div id="collapse-{{ $item->slug }}" class="collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                data-parent="#accordion-fitur">
                                <p>
                                    <b>Data disimpan di :</b> <br>
                                    DB Connection : {{ $item->connection }} <br>
                                    Table : {{ $item->tabel }} <br>
                                    Kolom : 
                                    @if (!empty($item->kolom_values))
                                    @foreach ($kolom as $colsource => $colname)
                                    <br>- SIRS {{ $colsource.' => '.$colname }}
                                    @endforeach
                                    @else
                                    -
                                    @endif
                                </p>
                                <p>Data yang sudah berhasil di Sinkronisasikan : <b>{{ $item->sync_row }} Data</b></p>
                                <form action="{{ url()->current().'/sync' }}" method="post" class="form-ajax">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="slug" value="{{ $item->slug }}">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Sinkronisasikan Data</button>
                                    </div>
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
<script type="text/javascript">
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
            if(response.fill_element?.length != 0){
                $.each(response.fill_element, function(selector_id, item){
                    $('#'+selector_id).find('h4').text(item);
                })
            }
            //reset preview jika error
            if(response.status == -1){
                $('.all-preview-text').find('h4').html(`<span class="text-secondary">Tekan tombol submit terlebih dahulu</span>`);
            }
        },
        error: (response) => {
            setActiveButton($(this).find('button[type="submit"]'), true);
            callSwal('error', response.statusText, response.statusText, 0)
            $('.all-preview-text').find('h4').html(`<span class="text-secondary">Tekan tombol submit terlebih dahulu</span>`);
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
</script>
@endsection
