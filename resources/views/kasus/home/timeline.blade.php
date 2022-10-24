@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Timeline - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    @include('kasus.home.components.event')
                    <div class="col-lg-12">
                        <h2 class="content-heading pt-0">Timeline</h2>
                    </div>
                </div>
                <div class="row row-deck mb-10">
                    <div class="col-12">
                        <div class="col-lg-12 pl-5">
                            <div class="block mb-0">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Aktivitas Berdasarkan Timeline</h3>
                                    <div class="block-options">
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <ul class="list list-timeline list-timeline-modern pull-t">
                                        <!-- Twitter Notification -->

                                        @php $showEmptyActivity = 0 @endphp
                                        @forelse($activities as $item)
                                        <li>
                                            <div class="list-timeline-time">{{$item->tanggal}} yang lalu</div>
                                            <i class="list-timeline-icon fa {{$item->icon}} bg-info"></i>
                                            <div class="list-timeline-content">
                                                <p class="font-w600">{{$item->tab_string}}</p>
                                                <p><strong>{{$item->creator->name}}</strong> {{$item->type_string}} {{$item->tab_string}}</p>
                                            </div>
                                        </li>
                                        @empty
                                        @php $showEmptyActivity = 1 @endphp
                                        @endforelse
                                        <!-- END Twitter Notification -->
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
                </div>


            </div>
        </div>
        <!-- END Updates -->
    </div>
</div>
</main>
<!-- END Main Container -->    


@endsection

@section('js')
<script type="text/javascript">
    function confirmToDo(id)
    {
        swal({
            title: 'Apakah anda sudah menyelesaikan instruksi ini?',
            text: "Anda tidak dapat mengembalikannya kembali",
            type: 'info',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonClass:'btn btn-primary',
            cancelButtonClass:'btn btn-secondary',
            confirmButtonText: 'Ya, Konfirmasi'
        }).then((result) => {
            if(result.value){
                swal({
                    title: 'Loading',
                    html: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>',
                    showConfirmButton : false
                })


                $.ajax({
                    url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/home/todo/done/'+ id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(data) {
                        swal(
                            'Berhasil!',
                            'Instruksi telah diselesaikan.',
                            'success'
                            )
                        $('#todo-'+id).fadeOut()
                    },
                    error: function() {
                     swal(
                        'Terjadi Kesalahan',
                        'Instruksi gagal diselesaikan, coba lagi. Atau hubungi admin bila error terjadi berulang kali',
                        'error'
                        )
                 }})
            }

        })
    }




</script>


@endsection