@extends('mutu.layouts.main')

@section('title')
    Mutu - Laporan - Medify
@endsection

@section('subtitle')
    <span class="text-muted font-w400">Laporan</span> / Keselamatan Kerja
@endsection

@section('content')
    <main id="main-container">
        @include('mutu.layouts.navbar')
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-20">
                    <h3>Laporan Keselamatan Kerja</h3>
                </div>
                <div class="col-12 my-20 px-30">
                    <input type="text" class="form-control fuzzy-search-laporan" placeholder="Cari Laporan">
                </div>
            </div>
            <div id="laporan-list">
                <ul class="list row row-deck">
                    @include('mutu.layouts.components.card-and-modal',[
                        'title' => 'Laporan Insiden',
                        'subtitle' => 'Laporan Insiden K3',
                        'modal_target' => 'modal_insiden_k3',
                        'form_url' => 'insiden-k3',
                        'form_fields' => ['date_range']
                    ])
                </ul>
                <div id="modal_iad" class="modal fade " role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-bg">
                        <div class="modal-content ">
                            <div class="modal-body">
                                <form method="get" action="{{url('mutu/laporan/keselamatan-kerja/laporan-identifikasi-resiko')}}" class="js-validation-be-contact">
                                    <div name="modal-title" class="font-size-lg font-w600 mb-20">Laporan Identifikasi Resiko</div>
                                    @include('mutu.layouts.components.zona-tanggal')
                                    <div id="formid"> </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary submit-button">Print</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
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