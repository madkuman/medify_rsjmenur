@extends('rekammedis.layouts.main')

@section('title')
Daftar RM Yang Dibawa Grup {{$group->name}}
@endsection

@section('content')

<main id="main-container">
    <!-- Group Banner -->
    @include('group.component.banner')
    <!-- End of Group Banner -->
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                @include('group.component.sidebar-left')
                <!-- End of Sidebar -->
            </div>
            <div class="col-md-9 col-md-offset 1">
                <a href="{{url('')}}/rekammedis/permintaan/baru?type=2&group_id={{$group->id}}" target="_blank" class="btn btn-secondary pull-right">Permintaan File</a>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#confirm-file" class="btn btn-primary pull-right mr-5">Konfirmasi File</a>
                <h5 class="text-uppercase text-muted">Daftar RM Yang Dibawa Grup {{$group->name}}</h5>
                <hr>
                <div class="row">
                    @foreach($my_group_rm as $item)
                    <div class="col-3">
                        <div class="block">
                            <div class="block-content block-content-full">
                                <div class="btn-group pull-right" role="group">
                                    <a href="javascript:void()" class="" id="btnGroupDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                        @if(!empty($item->rm_transaksi->holder_confirmed_at))
                                        <a class="dropdown-item" href="{{url('rekammedis/transaksi/transfer/'.$item->no_rm)}}" target="_blank">
                                            <i class="fa fa-fw fa-exchange mr-5"></i>Transfer
                                        </a>
                                        @endif
                                        @if(empty($item->rm_transaksi->holder_confirmed_at))
                                        <a class="dropdown-item" href="{{url('rekammedis/transaksi/'.$item->rm_transaksi->id)}}" target="_blank">
                                            <i class="fa fa-fw fa-check mr-5"></i>Konfirmasi
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <h5 class="mb-5"><small>#{{$item->no_rm}}</small></h5>
                                <h5 class="font-w600 mb-5">{{$item->name}}</h5>
                                @if(empty($item->rm_transaksi->holder_confirmed_at))
                                <h6>
                                    <small class="text-uppercase">(Belum Konfirmasi)</small>
                                </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pull-right">{{$history->links()}}</div>
                <h5 class="text-uppercase text-muted">Histori Transaksi RM Grup Ini</h5>
                <hr>
                @foreach($history as $item)
                <div class="block">
                    <div class="block-content">
                        <div class="row ">
                            <div class="col-3 h-100 d-flex align-self-center">
                                <div class="">
                                    <h5 class="font-w400 mb-5"><small>Jenis Transaksi</small></h5>
                                    <h5 class="font-w400 mb-5">{{$item->tujuan->deskripsi}}</h5>
                                    <h6>Lokasi : {{$item->lokasi}}</h6>
                                </div>
                            </div>
                            <div class="col-3 h-100 d-flex align-self-center">
                                <div class="">
                                    <h5 class="font-w400 mb-5"><small>Permintaan Oleh</small></h5>
                                    <h5 class="mb-5">{{$item->holder->name}}</h5>
                                    <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->created_at))}}</h6>
                                </div>
                            </div>
                            <div class="col-3 h-100 d-flex align-self-center">
                                <div class="">
                                    @if(!empty($item->sender_confirmed_at))

                                    @if(empty($item->holder_confirmed_at) && $item->status == -1)
                                    <h5 class="font-w400 mb-5"><small>Ditolak Oleh</small></h5>
                                    @else
                                    <h5 class="font-w400 mb-5"><small>Dikirim Oleh</small></h5>
                                    @endif

                                    <h5 class="mb-5">{{$item->sender->name}}</h5>
                                    <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->sender_confirmed_at))}}</h6>
                                    @else
                                    <h5 class="font-w400 mb-5"><small>Belum dikonfirmasi</small></h5>
                                    @endif
                                </div>
                            </div>
                            <div class="col-3 h-100 d-flex align-self-center">
                                <div class="">
                                    @if($item->status == 2)
                                    <h5 class="font-w400 mb-5"><small>Diterima Oleh</small></h5>
                                    <h5 class="mb-5">{{$item->holder_confirmer->name}}</h5>
                                    <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->holder_confirmed_at))}}</h6>
                                    @elseif($item->status == -2)
                                    <h5 class="font-w400 mb-5"><small> Mengkonfirmasi Tidak Menerima</small></h5>
                                    <h5 class="mb-5">{{$item->holder_confirmer->name}}</h5>
                                    <h6 class="font-w400">{{date('d F Y, H:i', strtotime($item->holder_confirmed_at))}}</h6>
                                    @else
                                    Belum Menerima <br>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

@include('group.modals.confirm-file')

@endsection
@section('js')
<script type="text/javascript">
    $('#btnSubmitLoading').hide();
    $('#btnSubmit').click(function(){
        no_rm = $('#noRM').val();
        $('#btnSubmit').hide();
        $('#btnSubmitLoading').show();
        $.ajax({
            type: "POST",
            url: "{{url('')}}/rekammedis/transaksi/permintaan/konfirmasi",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                no_rm : no_rm
            },
            success: function (data) 
            {
                console.log(data);
                callSwal(data.type,data.title,data.text,data.url);
                $('#noRM').val('');
                $('#btnSubmit').show();
                $('#btnSubmitLoading').hide();
            },
            error: function () 
            {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                console.log(data);
                $('#btnSubmit').show();
                $('#btnSubmitLoading').hide();
                    
            }
        });
            
    })

</script>

@endsection