@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Asesmen - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')
            <div class="col-lg-9 col-xl-9">
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  @if (session('active_nav') != 'asesmen') active @endif" href="#asesmen" id="nav-asesmen">Asesmen Lanjutan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (session('active_nav') == 'mutu') active @endif" href="#mutu" id="nav-mutu">Mutu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (session('active_nav') == 'ppi') active @endif" href="#ppi" id="nav-ppi">PPI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (session('active_nav') == 'alat-bantu') active @endif" href="#alat-bantu" id="nav-alat-bantu">Alat Bantu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (session('active_nav') == 'lainnya') active @endif" href="#lainnya" id="nav-lainnya">Lainnya</a>
                        </li>

                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-left @if (session('active_nav') != 'asesmen')  show active @endif" id="asesmen" role="tabpanel">
                            @include('kasus.alatbantu.index.asesmen')
                        </div>
                        <div class="tab-pane fade fade-left @if (session('active_nav') == 'alat-bantu') show active @endif" id="alat-bantu" role="tabpanel">
                            @include('kasus.alatbantu.index.alat-bantu')
                        </div>
                        <div class="tab-pane fade fade-left @if (session('active_nav') == 'ppi') show active @endif" id="ppi" role="tabpanel">
                            @include('kasus.alatbantu.index.ppi')
                        </div>
                        <div class="tab-pane fade fade-left @if (session('active_nav') == 'mutu') show active @endif" id="mutu" role="tabpanel">
                            @include('kasus.alatbantu.index.mutu')
                        </div>
                        <div class="tab-pane fade fade-left @if (session('active_nav') == 'lainnya') show active @endif" id="lainnya" role="tabpanel">
                            @include('kasus.alatbantu.index.form-lainnya')
                        </div>

                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
    <div class="modal" id="modal-riwayat" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Riwayat Asesmen</h3>
                    <div class="block-options">
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <ul class="list list-timeline list-timeline-modern pull-t">
                        <!-- Twitter Notification -->

                        @php $showEmptyActivity = 0 @endphp
                        @forelse($riwayat as $item)
                        <li>
                            <div class="list-timeline-time">{{$item->tanggal}} ago</div>
                            <i class="list-timeline-icon fa {{$item->icon}} bg-primary"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">{{$item->tab_string}}</p>
                                <p><strong>{{$item->creator->name}}</strong> {{$item->type_string}} {{$item->tab_string}}</p>
                            </div>
                        </li>
                        @empty
                        @php $showEmptyActivity = 1 @endphp
                        @endforelse
                    </ul>
                    @if($showEmptyActivity)
                    <div class="text-center py-50">
                        <h4 class="font-w400 mb-5">Tidak ada aktivitas pada hari ini</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-sk-terbang" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-md" role="document">
            <div class="modal-content">
                <div class="block block-transparent mb-0">
                    <div class="block-content row py-20">
                        <h4 class="col-md-12 mb-0">
                            Pilih TTD
                        </h4>
                        <form method="GET" class="col-md-12" action="{{url()->current()}}/sk-terbang" target="_blank">
                            {{csrf_field()}}
                            <input type="hidden" id="print-id" name="id" value="">
                            <h6 class="font-size-s font-w400 mt-5">Pilih TTD untuk Print Surat Keterangan Izin Terbang</h6>
                            <hr style="border-top: 2px solid #0b72c6">
                            <div class="my-15">
                                <div class="form-group row">
                                    <label class="col-12" for="example-datepicker1">TTD Dokter yang merawat</label>
                                    <select class="js-select2 form-control col-6" id="ttd2" name="ttd2" style="width: 100%;" data-placeholder="Pilih TTD">
                                        <option></option>
                                         @foreach($dokter as $key => $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" id="submitgroup" class="btn btn-xs btn-primary float-right">
                                <i class="fa fa-print"></i> Print
                            </button>
                            <button type="button" id="submitgroup" class="btn btn-xs btn-default float-right mr-5" data-dismiss="modal" aria-label="Close">
                                Batal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->    
@endsection

@section('js')

<script src="{{asset('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
    var options = {
        valueNames: [ 'title', 'desc' ]
    };

    var asesmenList = new List('asesmen-list', options);
    var alatList = new List('alat-list', options);
    var ppiList = new List('ppi-list', options);
    var mutuList = new List('mutu-list', options);
    var lainnyaList = new List('lainnya-list', options);

    $(".fuzzy-search-asesmen").keyup(function(){
        asesmenList.search($(this).val());
    });
    $(".fuzzy-search-alat").keyup(function(){
        alatList.search($(this).val());
    });
    $(".fuzzy-search-ppi").keyup(function(){
        ppiList.search($(this).val());
    });
    $(".fuzzy-search-mutu").keyup(function(){
        mutuList.search($(this).val());
    });
    $(".fuzzy-search-lainnya").keyup(function(){
        lainnyaList.search($(this).val());
    });

</script>
@endsection