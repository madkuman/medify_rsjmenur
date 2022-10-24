@extends('layouts.main', ['app' => "warehouse"])

@section('title')
    Transaksi - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')
    @if($transaction->type==1)
        @php $action_desc = 'Menerima' @endphp
    @else
        @php $action_desc = 'Mengirim' @endphp
    @endif

    <div class="row page-title-container">
        <div class="icon">
            <i class="fa fa-info" aria-hidden="true"></i>
        </div>
        <div class="title">
            Detail Transaksi<br>
            <small>
                Detail informasi transaksi
            </small>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="card-title">Tujuan Barang : 
                        @if($transaction->buyer_detail != null)
                            {{$transaction->buyer_detail->nama}}
                        @else
                            -
                        @endif
                    </h4>
                    <p class="card-category">Jenis Transaksi : KELUAR</p>
                    <p class="card-category"><strong>{{$transaction->category}}</strong> - {{$transaction->slug}}</p>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        @if ($transaction->status == 2)
                        <span class="stamp is-rejected" style="margin-top: 30px;">Rejected</span>
                        @elseif ($transaction->status == 1)
                        <span class="stamp is-approved" style="margin-top: 30px;">Verified</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="card-category">
                Status Transaksi : <strong>
                @if($transaction->status == 0)
                    Menunggu Konfirmasi
                @elseif($transaction->status == 1)
                    Barang Telah Dikirim
                @else
                    Transaksi Ditolak   
                @endif </strong>
            </p>
            <div>
                <p>Deskripsi : <br>{{!is_null($transaction->description) ? $transaction->description : "-"}}</p>
            </div>
        </div>

        {{-- <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Permintaan Apotek</label>
                    <div class="table-full-width table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0 @endphp
                                @foreach($old as $item)
                                <tr>
                                    <td class="text-center">{{++$i}}</td>
                                    <td>{{$item->item_detail->name}}</td>
                                    <td>
                                        @if($item->item_detail->type == 1)
                                        Obat Obatan
                                        @else
                                        Alat Kesehatan
                                        @endif
                                    </td>
                                    <td>{{$item->qty}}</td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Terkirim</label>
                    <div class="table-full-width table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($transaction->status == 1)
                                    @php $i = 0 @endphp
                                    @foreach($new as $item)
                                    <tr>
                                        <td class="text-center">{{++$i}}</td>
                                        <td>{{$item->item_detail->name}}</td>
                                        <td>
                                            @if($item->item_detail->type == 1)
                                            Obat Obatan
                                            @else
                                            Alat Kesehatan
                                            @endif
                                        </td>
                                        <td>{{$item->qty}}</td>
                                    </tr>
                                    @endforeach 
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="#" onClick="window.open('{{ (!is_null($transaction->foto) ? asset($transaction->foto) : asset('assets/app/warehouse/no_nota.png')) }} ', 'WindowC', 'width=650, height=500,scrollbars=yes');">
                        <img src="{{ (!is_null($transaction->foto) ? asset($transaction->foto) : asset('assets/app/warehouse/no_nota.png')) }}" width="100%" onerror="imgError(this);">
                    </a>
                </div>
            </div>
        </div> --}}

        <div class="card-footer">
            <div class="row">
                @if($transaction->status==0)
                <div class="col-md-12">
                    <div class="pull-right">
                        <form method="POST" action="{{url('warehouse/transaction/edit/'.$transaction->slug)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$transaction->id}}">
                        </form>
                        <button type="button" class="btn btn-danger btn-fill" id="btnReject">
                            <i class="fa fa-times" aria-hidden="true"></i> Tolak</button>
                        <a href="{{url('warehouse/transaction/edit/'.$transaction->slug)}}" class="btn btn-primary btn-fill"><i     class="fa fa-pencil" aria-hidden="true"></i> Verifikasi</a>
                    </div>
                </div>
                <div class="modal fade" id="confirmsend" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> {{$action_desc}} Kiriman
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah anda yakin telah {{$action_desc}} barang barang tersebut?</p>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <form method="POST" action="{{url('warehouse/transaction')}}/accept">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$transaction->id}}">
                                                <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary btn-fill">Konfirmasi</button>
                                            </form>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if($transaction->status==0)
            <div class="row reject-form hidden">
                <div class="col-md-12">
                    <form method="POST" action="{{url('warehouse/transaction')}}/reject">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$transaction->id}}">
                        <div class="form-container">
                            <div class="form-container">
                                <label>Alasan Menolak</label>
                                <textarea name="explanation" class="form-control" rows="4" placeholder="Mengapa anda menolak permintaan ini"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-simple" id="btnCancel">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-fill">Kirim</button>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </form>        
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permintaan Apotek</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            @foreach($old as $item)
                            <tr>
                                <td class="text-center">{{++$i}}</td>
                                <td>{{$item->item_detail->name}}</td>
                                <td>
                                    @if($item->item_detail->type == 1)
                                    Obat Obatan
                                    @else
                                    Alat Kesehatan
                                    @endif
                                </td>
                                <td>{{$item->qty}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Terkirim</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Kadaluarsa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($transaction->status == 1)
                                @php $i = 0 @endphp
                                @foreach($new as $item)
                                    @foreach($item->log_detail as $detail)
                                    <tr>
                                        <td class="text-center">{{++$i}}</td>
                                        <td>{{$item->item_detail->name}}</td>
                                        <td>
                                            @if($item->item_detail->type == 1)
                                            Obat Obatan
                                            @else
                                            Alat Kesehatan
                                            @endif
                                        </td>
                                        <td>{{$detail->qty}}</td>
                                        <td>{{date('d F Y', strtotime($detail->in_detail->expired))}}</td>
                                    </tr>
                                    @endforeach 
                                @endforeach 
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($transaction->status !=0)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5>
                            @if($transaction->status==1)
                                <strong> Telah diverifikasi oleh : </strong><br>
                            @elseif($transaction->status==2)
                                <strong> Telah ditolak oleh : </strong><br>
                            @endif                            
                            </h5>

                            <div class="text-center">
                                <span>
                                    <img class="img-circle img-bordered-sm" id="largeImage" src="{{ (!is_null($transaction->created_by_detail->avatar_thumb) ? asset($transaction->created_by_detail->avatar_thumb) : asset('assets/app/warehouse/no_image.png')) }}" alt="user image" onerror="imgError(this);" >

                                    <strong>@if($transaction->verified_by_detail != null) {{$transaction->verified_by_detail->name}}</strong>@endif {{ date('d F Y, h:i', strtotime($transaction->updated_at)) }}
                                </span>
                            </div>
                            <div class="center">
                                @if($transaction->status==2)
                                    <div class="col-md-12" style="margin-top: 10px">
                                        <p>Alasan ditolak :</p><em>{{$transaction->explanation}}</em>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('css')
    <style type="text/css">
        .modal-footer {
            display: block;
        }

        .hidden {
            display: none;
        }

        .stamp {
            transform: rotate(12deg);
            color: #555;
            font-size: 2rem;
            font-weight: 700;
            border: 0.25rem solid #555;
            display: inline-block;
            padding: 0.25rem 1rem;
            text-transform: uppercase;
            border-radius: 1rem;
            font-family: 'Courier';
            -webkit-mask-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/8399/grunge.png');
            -webkit-mask-size: 944px 604px;
            mix-blend-mode: multiply;
        }

        .is-approved {
            color: #0A9928;
            border: 0.5rem solid #0A9928;
            -webkit-mask-position: 13rem 6rem;
            transform: rotate(-14deg);
            border-radius: 0;
        }

        .is-rejected {
            color: #FF2323;
            border: 0.5rem solid #FF2323;
            -webkit-mask-position: 13rem 6rem;
            transform: rotate(-14deg);
            border-radius: 0;
        }

        .post {
            border-bottom: 1px solid #d2d6de;
            margin-bottom: 15px;
            padding-bottom: 15px;
            color: #666;
        }

        /*.post .user-block {
            margin-bottom: 15px;
        }*/

        .text-center span img {
            width: 40px;
            height: 40px;
        }

        .img-bordered-sm {
            border: 2px solid #d2d6de;
            padding: 2px;
        }

        .img-circle {
            border-radius: 50%;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            /*@if(session('status')) {
                swal('Berhasil', '{{(session('status'))}}', 'success');
            }
            @endif*/
        });

        function imgError(image) {
            image.onerror = "";
            image.src = "https://cdn.browshot.com/static/images/not-found.png";
            return true;
        }

        $('#delete-transc').on('click', function() {
            var deleteTransc = $(this).parent().find('form');
            swal({
                title: "Apa anda yakin ?",
                text: "Data transaksi yang telah dihapus tidak dapat dikembalikan",
                type: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-default',
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
                allowOutsideClick: false
            }, function(isConfirm) {
                if (isConfirm) {
                    deleteTransc.submit();
                    //swal("Berhasil Hapus!", "Data berhasil dihapus", "success");
                } else {
                    swal("Batal Hapus", "Hapus data transaksi dibatalkan", "error");
                }
            });
        });

        $('#btnVerification').on('click', function() {
            var verification = $(this).parent().find('form');
            console.log("ini verifikasi", verification);
            swal({
                title: "{{$action_desc}} Kiriman",
                text: "Apa anda yakin telah {{$action_desc}} barang tersebut ?",
                type: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonClass: 'btn btn-primary',
                confirmButtonText: "Konfirmasi",
                cancelButtonClass: 'btn btn-default',
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
                allowOutsideClick: false
            }, function(isConfirm) {
                if (isConfirm) {
                    verification.submit();
                    //swal("Berhasil Hapus!", "Data berhasil dihapus", "success");
                } else {
                    swal("Verifikasi dibatalkan", "Verifikasi data barang dibatalkan", "error");
                }
            });
        })

        $('#btnReject').on('click', function() {
            var reject = 
                '<form method="POST" action="{{url('warehouse/transaction')}}/reject" id="rejectForm">' +
                    '{{csrf_field()}}' +
                    '<input type="hidden" name="id" value="{{$transaction->id}}">' +
                    '<div class="form-container">' +
                        '<div class="form-container">' +
                            '<textarea name="explanation" class="form-control" rows="4" placeholder="Mengapa anda menolak permintaan ini"></textarea>' +
                        '</div>' +
                    '</div>' +
                '</form>';
            //console.log("ini reject", reject);

            swal({
                title: 'Alasan Menolak',
                html: reject,
                showCancelButton: true,
                closeOnConfirm: false,
                allowOutsideClick: false,
                reverseButtons: true,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-default',
                confirmButtonText: "Tolak",
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Batal",
            },
            function(isConfirm) {
                if (isConfirm) {
                    document.getElementById('rejectForm').submit();
                    // swal({
                    //     html: 'You entered: <strong>' +
                    //         $('#input-field').val() +
                    //         '</strong>'
                    // });
                }
            })
        })

        // $('#btnReject').on('click', function() {
        //     var show = $(this).parents('.card-footer').find('.reject-form');
        //     show.removeClass('hidden');
        // });

        $('#btnCancel').on('click', function() {
            var hide = $(this).parents('.reject-form');
            hide.addClass('hidden');
        });

        function swipe() {
            var largeImage = document.getElementById('largeImage');
            largeImage.style.display = 'block';
            largeImage.style.width=200+"px";
            largeImage.style.height=200+"px";
            var url=largeImage.getAttribute('src');
            window.open(url,'Image','width=largeImage.stylewidth,height=largeImage.style.height,resizable=1');
        }

    </script>
@endsection