@extends("kasus.layouts.main")

@section("title")
    {{$kasus->judul_kasus}} - Permintaan USG - Kasus
@endsection

@section("content")

    <!-- Main Container -->
    <main id="main-container">
        @include("kasus.layouts.header")

        <div class="content">
            <div class="row">
            @include("kasus.layouts.sidebar")

            <!-- Updates -->
                <div class="col-lg-9 col-xl-9">
                    <div class="block block-bordered">
                        <div class="block-content">
                            @if(session('my_role_'.$kasus->nomor_kasus))
                                <button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Buat Form Permintaan Pemeriksaan USG</button>
                            @endif

                            <h4>Permintaan Pemeriksaan USG</h4>
                            <hr>
                            @php $count = 1 @endphp
                            @forelse($permintaan as $item)

                                <h5 class="mb-5 pl-5">#Form Permintaan Pemeriksaan USG {{$count++}}</h5>
                                <hr>
                                <button class="btn btn-circle btn-outline-primary mr-5 mb-5 pull-right printBtn" data-id="{{$item->id}}">
                                    <i class="fa fa-print"></i>
                                </button>

                                @if(session('my_role_'.$kasus->nomor_kasus))
                                    @if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
                                        <button class="btn btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button class="btn btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    @endif
                                @endif
                                @if(!empty($item->creator->avatar_thumb))
                                    <div class="float-left mr-10">
                                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
                                    </div>
                                @else
                                    <div class="float-left mr-10">
                                        <img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
                                    </div>
                                @endif
                                <div class="creator">
                                    <h6 class="pt-10">
                                        <small class="text-muted">Dibuat Oleh</small><br>
                                        {{$item->creator->name}}<br>
                                        {{date("d F y, H:i", strtotime($item->created_at))}}
                                    </h6>
                                </div>

                                <hr class="my-20">
                            @empty

                                <div class="text-center py-50">
                                    <h4 class="font-w400 mb-5">Belum ada form permintaan pemeriksaan ultrasonografi tersedia</h4>
                                    <p>Klik tombol <b>buat form permintaan pemeriksaan usg</b> untuk melakukan pembuatan form permintaan pemeriksaan ultrasonografi</p>
                                </div>

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/permintaan-usg/delete" id="formDelete">
        {{csrf_field()}}
    </form>
    
    @include('kasus.alatbantu.permintaan-usg.form')
    @include('kasus.alatbantu.permintaan-usg.edit')
@endsection

@section('js')
    <script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.time').mask('00:00');

            $(".deleteBtn").click(function(e){
                e.preventDefault();
                id = $(this).data("id");
                $('#formDelete').attr('action', '{{url()->current()}}/delete/'+id);
                swal({
                    title: "Hapus",
                    text: "Apakah anda yakin akan menghapus data ini?",
                    showCancelButton: true,
                    reverseButtons: true,
                    type: 'warning',
                    confirmButtonClass: "btn btn-danger",
                    cancelButtonClass: "btn btn-default",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Kembali",
                    closeOnConfirm: false
                }).then(function(result) {
                    if(result.value)
                    {
                        $('#formDelete').submit();
                    }
                });
            });

            $(".editBtn").click(function(e){
                var id = $(this).attr('data-id');

                $('#form-edit').attr('action', '{{url()->current()}}/edit/'+id);

                $.ajax({
                    type:'GET',
                    url : API_URL+'/kasus/get/alat-bantu/val/'+id,
                    beforeSend:function() {
                        $('#loading').removeClass('d-none');
                        $('#edit-content').addClass('d-none');
                    },
                    success:function(data){
                        var data = JSON.parse(data);
                        var tes = "tes";

                        $('#edit_tujuan').text(data.tujuan);
                        $('#edit_hasil').text(data.hasil);

                        $('#loading').addClass('d-none');
                        $('#edit-content').removeClass('d-none');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest, textStatus, errorThrown);
                    },
                });
                $('#editModal').modal('show');
            });

            $('.printBtn').on('click', function(){
                var id = $(this).data('id');
                printSurat(id);
            });

        });

        
        function printSurat(id)
        {
            window.open(
                "{{url('kasus')}}/{{$kasus->nomor_kasus}}/alat-bantu/permintaan-ultrasonografi/print/"+id,"popUpWindow",
                "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");
        }
    </script>
@endsection