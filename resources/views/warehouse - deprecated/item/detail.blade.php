@extends('layouts.main', ['app' => "warehouse"])

@section('title')
Item Detail - Pergudangan - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')
<div class="row page-title-container">
    <div class="icon">
        <i class="fa fa-info" aria-hidden="true"></i>
    </div>
    <div class="title">
        Data Barang<br>
        <small>
            Detail informasi data barang
        </small>
    </div>
</div>

<div class="card" style="">
    <div class="card-header ">
        <h3 class="card-title"><b>{{$items->name}}</b></h3>
        <p class="card-category">Dibuat oleh : @if($items->user_detail != null)
            {{$items->user_detail->name}}
            @else -
            @endif
        </p>
        <p class="card-category"><small>Ditambahkan pada : {{$items->created_at}}</small></p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ (!is_null($items->image_thumb) ? asset($items->image_thumb) : asset('assets/app/warehouse/no_image.png')) }}" width="100%" onerror="imgError(this);">
            </div>
            <div class="col-md-6">
                <p><strong>Informasi Barang</strong></p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Jenis</td>
                            <td>Obat</td>
                        </tr>
                        <tr>
                            <td>Harga Beli</td>
                            <td>Rp {{number_format($items->price)}},-</td>
                        </tr>
                        <tr>
                            <td>Stok Barang Siap Saat Ini</td>
                            <td>{{$items->qty_ready}}</td>
                        </tr>
                        <tr>
                            <td>Supplier</td>
                            <td>
                                @if(!is_null($items->supplier_detail)) {{$items->supplier_detail->nama}}
                                @else -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>
                                @forelse($items->items_category as $category)
                                    <span class="label label-info">{{$category->name}}</span>
                                @empty -
                                @endforelse
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin-top: 15px;">
                <h5><strong>Deskripsi</strong></h5>
                {{$items->description}}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <form method="POST" action="{{url('warehouse/item/delete')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="item" value="{{$items->id}}">
                    </form>
                    <button type="submit" class="btn btn-danger btn-fill" id="delete-item">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                    </button>
                    <a href="{{url('warehouse/item/edit/'.$items->slug)}}" class="btn btn-warning btn-fill">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Ubah
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Barang Tersedia</h4>
        <p class="card-category">Jumlah dan kadaluarsa barang</p>
    </div>
    <div class="card-body table-full-width table-responsive inventory">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pembelian Awal</th>
                    <th>Sisa</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody id="avail">
                @php $j=1 @endphp
                @forelse($available as $row)
                <tr class="transaction">
                    <td>{{$j++}}</td>
                    <td>{{$row->qty}}</td>
                    <td>{{$row->remain}}</td>
                    <td>{{ date('d F Y', strtotime($row->expired)) }}</td>
                    <td>
                        <a href="#" class="btn btn-warning" data-target="#detailModal" data-toggle="modal" onclick="getDetails({{$row->id}})">
                            <i class="fa fa-pencil" aria-hidden="true"></i>Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr style="text-align: center;">
                    <td></td>
                    <td colspan="6">Belum ada barang tersedia</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <center>
            <div id="loading2"></div>
            <button type="button" id="loadavail" class="btn btn-primary" onclick="getMoreAvail()">
                Load More
            </button>
        </center>
    </div>
</div>

<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Catatan Mutasi Barang</h4>
        <p class="card-category">Riwayat transaksi terakhir yang dilakukan</p>
    </div>
    <div class="card-body table-full-width table-responsive inventory">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>#</th>
                    <th>Asal/Tujuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody id="histori">
                @php $i=1 @endphp
                @forelse($history as $row)
                <tr class="transaction clickable-row" data-href="{{url('/warehouse/transaction/'.$row->transaction_detail->slug)}}">
                    @if($row->transaction_id)
                        <td>{{$i}}</td>
                        @php $i++ @endphp
                        <td>                        
                            @if($row->transaction_detail->type == 1)
                                <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                            @else
                                <span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>
                            @endif
                        </td>
                        <td>
                            @if($row->transaction_detail->type == 1)
                                {{$row->transaction_detail->seller_detail->nama}}
                            @else
                                @if($row->transaction_detail->buyer_detail != null)
                                    {{$row->transaction_detail->buyer_detail->nama}}
                                @else
                                    -
                                @endif
                            @endif
                        </td>
                        <td>{{$row->qty}}</td>
                        <td>{{ date('d F Y, H:i', strtotime($row->created_at)) }}</td>
                    @else
                        <td>{{$i}}</td>
                        @php $i++ @endphp
                        <td>                        
                            <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                        </td>
                        <td>
                            Awal barang masuk
                        </td>
                        <td>{{$row->qty}}</td>
                        <td>{{ date('d F Y, H:i', strtotime($row->created_at)) }}</td>
                    @endif
                </tr>
                @empty
                <tr style="text-align: center;">
                    <td></td>
                    <td colspan="6">Belum ada Mutasi untuk barang ini.</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <center>
            <div id="loading"></div>
            <button type="button" id="loadmore" class="btn btn-primary" onclick="getMore()">
                Load More
            </button>
        </center>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body myModalBody">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tujuan</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="purchase">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <style type="text/css">
        #loader-4 span{
          display: inline-block;
          width: 20px;
          height: 20px;
          border-radius: 100%;
          background-color: #3498db;
          margin: 35px 5px;
          opacity: 0;
        }

        #loader-4 span:nth-child(1){
          animation: opacitychange 1s ease-in-out infinite;
        }

        #loader-4 span:nth-child(2){
          animation: opacitychange 1s ease-in-out 0.33s infinite;
        }

        #loader-4 span:nth-child(3){
          animation: opacitychange 1s ease-in-out 0.66s infinite;
        }

        @keyframes opacitychange{
          0%, 100%{
            opacity: 0;
          }

          60%{
            opacity: 1;
          }
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var count = "{{$count}}" ;
            var coent = "{{$coent}}" ;
            $(document).on('click', '.clickable-row', function (){
                //console.log("masuq");
                window.location = $(this).data("href");    
            })
            @if(session('status')) {
                swal('Berhasil', '{{(session('status'))}}', 'success');
            }
            @endif
            if(count <= 10) {
                console.log(count);
                $("#loadmore").hide();
            }
            if(coent <= 10) {
                console.log(coent);
                $("#loadavail").hide();
            }
            
        });

        function imgError(image) {
            image.onerror = "";
            image.src = "https://cdn.browshot.com/static/images/not-found.png";
            return true;
        }

        $('#delete-item').on('click', function() {
            var deleteItem = $(this).parent().find('form');
            swal({
                title: "Apa anda yakin ?",
                text: "Data yang telah dihapus tidak dapat dikembalikan",
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
                    deleteItem.submit();
                    //swal("Berhasil Hapus!", "Data berhasil dihapus", "success");
                } else {
                    swal("Batal Hapus", "Hapus data barang dibatalkan", "error");
                }
            });
        });

        var currentPage = 0;
        var currentAvail = 0;
        var i = {{$i}};
        var j = {{$j}};
        var ctr = 1;

        function getMore() {
            var str = "";
            currentPage++;

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/item/".$items->id)}}/' + currentPage,
                dataType: 'json',
                beforeSend: function() {
                    //console.log("loading...");
                    var loadingScreen = 
                        '<tr style="text-align: center;">' +
                            '<td></td>' +
                            '<td colspan="5">' +
                                '<div class="loader" id="loader-4">' +
                                    '<span></span>' +
                                    '<span></span>' +
                                    '<span></span>' +
                                '</div>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                        '</tr>';
                    $('#loading').html(loadingScreen);
                },
                success:function(data){
                    $("#loader-4").remove();
                    data.data.forEach(function(item) {
                        var date = new Date(item.created_at);
                        str += `<tr class="transaction clickable-row" data-href="{{url('/warehouse/transaction/`+item.transaction_detail.slug+`')}}">`;
                            if(item.transaction_id) {
                                str += `<td>`+i+`</td><td>`;
                                    if(item.transaction_detail.type == 1)
                                        str += `<span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>`
                                    else
                                        str += `<span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>`
                                str += `</td>
                                <td>`;
                                    if(item.transaction_detail.type == 1)
                                    {
                                        if(item.transaction_detail.seller_detail != null)
                                        str += item.transaction_detail.seller_detail.nama;
                                        else str += "-";
                                    }
                                    else if(item.transaction_detail.type == -1)
                                    {
                                        if(item.transaction_detail.buyer_detail != null)
                                        str += item.transaction_detail.buyer_detail.nama;
                                        else str += "-";
                                    }
                                str += `</td>
                                <td>`+item.qty+`</td>
                                <td>`+formatDate(date)+`</td>`;
                            }
                            else {
                                str += `<td>`+i+`</td><td>                        
                                    <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                                </td>
                                <td>
                                    Awal barang masuk
                                </td>
                                <td>`+item.qty+`</td>
                                <td>`+formatDate(item.created_at)+`</td>`;
                            }
                        str += `</tr>`;
                        i++;
                        //console.log(item);
                    });

                    $("#histori").append(str);
                    if(data.count <= (currentPage+1)*10) $("#loadmore").hide();
                    //$("#transaksiDetails").html(data.msg);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function getMoreAvail() {
            var str = "";
            currentAvail++;

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/itemavail/".$items->id)}}/' + currentAvail,
                dataType: 'json',
                beforeSend: function() {
                    //console.log("loading...");
                    var loadingScreen = 
                        '<tr style="text-align: center;">' +
                            '<td></td>' +
                            '<td colspan="5">' +
                                '<div class="loader" id="loader-5">' +
                                    '<span></span>' +
                                    '<span></span>' +
                                    '<span></span>' +
                                '</div>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                        '</tr>';
                    $('#loading2').html(loadingScreen);
                },
                success:function(data){
                    $("#loader-5").remove();
                    data.data.forEach(function(item) {
                        var date = new Date(item.expired);
                        str += `<tr class="transaction">
                                <td>`+j+`</td>
                                <td>`+item.qty+`</td>
                                <td>`+item.remain+`</td>
                                <td>`+formatDateWithoutTime(date)+`</td>
                                <td>
                                    <a href="#" class="btn btn-warning" data-target="#detailModal" data-toggle="modal" onclick="getDetails(`+item.id+`)">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>Detail
                                    </a>
                                </td>
                            </tr>`;
                        j++;
                        //console.log(item);
                    });

                    $("#avail").append(str);
                    if(data.count <= (currentAvail+1)*10) $("#loadavail").hide();
                    //$("#transaksiDetails").html(data.msg);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function getDetails(id) {
            var str = "";
            ctr = 1;

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/log/purchase")}}/' + id,
                dataType: 'json',
                beforeSend: function() {
                    //console.log("loading...");
                    var loadingScreen = 
                        '<tr style="text-align: center;">' +
                            '<td></td>' +
                            '<td colspan="5">' +
                                '<div class="loader" id="loader-4">' +
                                    '<span></span>' +
                                    '<span></span>' +
                                    '<span></span>' +
                                '</div>' +
                            '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                        '</tr>';
                    $('#purchase').html(loadingScreen);
                },
                success:function(data){
                    $("#loader-4").remove();
                    data.forEach(function(item) {
                        var date = new Date(item.created_at);
                        str += `<tr class="transaction clickable-row" data-href="{{url('/warehouse/transaction/`+item.out_detail.transaction_detail.slug+`')}}">`;
                            
                            str += `<td>`+ctr+`</td><td>`;
                                if(item.out_detail.transaction_detail.buyer_detail != null)
                                str += item.out_detail.transaction_detail.buyer_detail.nama;
                                else str += "-";
                            str += `</td>
                            <td>`+item.qty+`</td>
                            <td>`+formatDate(date)+`</td>
                        </tr>`;
                        ctr++;
                        //console.log(item);
                    });

                    $("#purchase").append(str);
                    //$("#transaksiDetails").html(data.msg);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }
    </script>
@endsection