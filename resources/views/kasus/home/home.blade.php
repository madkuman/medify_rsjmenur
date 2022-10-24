@extends('kasus.layouts.main')

@section('title')
  {{$kasus->judul_kasus}} - Home - Kasus
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
                    @include('kasus.home.components.datamedis')
                </div>
                <div class="row row-deck mb-10">
                    <div class="col-12">
                    {{--@include('kasus.home.components.todo')--}}
                    @include('kasus.home.components.timeline')
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