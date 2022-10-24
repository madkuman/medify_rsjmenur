@extends('mutu.layouts.main')

@section('title')
    Mutu - Laporan - Medify
@endsection

@section('subtitle')
    <span class="text-muted font-w400">Laporan</span> / SPM Penunjang
@endsection

@section('content')
    <main id="main-container">
        @include('mutu.layouts.navbar')
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-20">
                    <h3>Laporan SPM Penunjang</h3>
                </div>
                <div class="col-12 my-20 px-30">
                    <input type="text" class="form-control fuzzy-search-laporan" placeholder="Cari Laporan">
                </div>
            </div>
            <div id="laporan-list">
                <ul class="list row row-deck">
                    @include('mutu.layouts.components.card-and-modal',[
                        'title' => 'Laporan Radiologi',
                        'subtitle' => 'Laporan Radiologi',
                        'modal_target' => 'modal_spm_radiologi',
                        'form_url' => 'radiologi',
                        'form_fields' => ['date_range']
                    ])

                    @include('mutu.layouts.components.card-and-modal',[
                        'title' => 'Laporan Lab PK',
                        'subtitle' => 'Laporan Lab PK',
                        'modal_target' => 'modal_spm_lab_pk',
                        'form_url' => 'lab-pk',
                        'form_fields' => ['date_range']
                    ])
                </ul>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript" src="{{url('assets/js/plugins/listjs/list.min.js')}}"></script>
    <script type="text/javascript">
        $(document).on('click', '.submit-button', function(){
            $(this).parent().parent().unbind('submit').submit();
        })
        var options = {
            valueNames: [ 'title', 'desc' ]
        };
        var laporanList = new List('laporan-list', options);
        $(".fuzzy-search-laporan").keyup(function(){
            laporanList.search($(this).val());
        });
    </script>
@endsection