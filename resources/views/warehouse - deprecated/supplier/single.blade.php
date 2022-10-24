@extends('layouts.main', ['app' => "warehouse"])

@section('title')
    Supplier - Pergudangan - Medify
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
            Data Supplier<br>
            <small>
                Detail informasi data supplier
            </small>
        </div>
    </div>

    <div class="card ">
        <div class="card-header ">
            <h3 class="card-title"><b>{{$supplier->nama}}</b></h3>
            <p class="card-category">{{$supplier->jenis}}</p>
            <p class="card-category"><small>Ditambahkan pada : {{$supplier->created_at}}</small></p>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{asset($supplier->foto)}}" width="100%" onerror="imgError(this);">
                </div>
                <div class="col-md-6">
                    <p><strong>Informasi Supplier</strong></p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{$supplier->alamat}}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>{{$supplier->telepon}}</td>
                                </tr>
                                <tr>
                                    <td>Agen</td>
                                    <td>{{$supplier->agen}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 15px;">
                    <h5><strong>Deskripsi</strong></h5>
                    {{$supplier->deskripsi}}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <form method="POST" action="{{url('warehouse/supplier/delete')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="supp_id" value="{{$supplier->id}}">
                        </form>
                        <button type="submit" class="btn btn-danger btn-fill" id="delete-supp">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                        </button>
                        <a href="{{url('warehouse/supplier/edit/'.$supplier->slug)}}" class="btn btn-warning btn-fill">
                            <i class="fa fa-pencil" aria-hidden="true"></i> Ubah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card strpied-tabled-with-hover">
        <div class="card-header ">
            <h4 class="card-title">Barang Supplier</h4>
            <p class="card-category">Daftar barang yang dimiliki oleh Supplier</p>
        </div>
        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr><th>No</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                </tr></thead>
                @php $i=1 @endphp
                <tbody id="items">
                    @forelse($items as $row)
                    <tr class="clickable-row" data-href="{{url('/warehouse/item/'.$row->slug)}}">
                        <td>{{$i}}</td>
                        @php $i++ @endphp
                        <td>{{$row->name}}</td>
                        <td>
                            @if($row->type == 1)
                            Obat
                            @else
                            Alat
                            @endif
                        </td>
                        <td>
                            {{$row->qty_ready}}
                        </td>
                        <td>Rp. {{number_format($row->price)}}</td>
                        <td>
                            @if($row->description != null)
                                {{$row->description}}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr style="text-align: center;">
                        <td></td>
                        <td colspan="6">Belum ada Transaksi untuk Supplier ini.</td>
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

    <div class="card strpied-tabled-with-hover">
        <div class="card-header ">
            <h4 class="card-title">Catatan Transaksi</h4>
            <p class="card-category">Riwayat transaksi terakhir yang dilakukan</p>
        </div>
        <div class="card-body table-full-width table-responsive inventory">
            <table class="table table-hover table-striped">
                <thead>
                    <tr><th>No</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr></thead>
                @php $i=1 @endphp
                <tbody id="histori">
                    @forelse($history as $row)
                    <tr class="transaction clickable-row" data-href="{{url('/warehouse/transaction/'.$row->slug)}}">
                        <td>{{$i}}</td>
                        @php $i++ @endphp
                        <td>
                            @if($row->type == 1)
                            <span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>
                            @elseif($row->type == -1)
                            <span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>
                            @endif
                        </td>
                        <td>
                            @if($row->explanation != null)
                                {{$row->explanation}}
                            @else
                                -
                            @endif
                        </td>
                        <td>Rp. {{number_format($row->total_price)}}</td>
                        <td>{{ date('F d, H:i', strtotime($row->created_at)) }}</td>
                    </tr>
                    @empty
                    <tr style="text-align: center;">
                        <td></td>
                        <td colspan="6">Belum ada Transaksi untuk Supplier ini.</td>
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
        $('document').ready(function() {
            var count = "{{$count}}";
            $(document).on('click', '.clickable-row', function (){
                //console.log("masuq");
                window.location = $(this).data("href");    
            });

            $('#delete-supp').on('click', function() {
                var deleteSupp = $(this).parent().find('form');
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
                        deleteSupp.submit();
                        //swal("Berhasil Hapus!", "Data berhasil dihapus", "success");
                    } else {
                        swal("Batal Hapus", "Hapus data dibatalkan", "error");
                    }
                });
            })
            if(count <= 10) {
                console.log(count);
                $("#loadmore").hide();
            }
        });

        function imgError(image) {
                image.onerror = "";
                image.src = "https://cdn.browshot.com/static/images/not-found.png";
                return true;
            }

        var currentPage = 0;
        var i = {{$i}};

        function getMore() {
            var str = "";
            currentPage++;

            $.ajax({
                type:'GET',
                url:'{{url("warehouse/supplier/".$supplier->id)}}/' + currentPage,
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
                        str += `<tr class="transaction clickable-row" data-href="{{url('/warehouse/transaction/`+item.slug+`')}}">
                            <td>`+i+`</td>                            
                            <td>`;
                                if(item.type == 1)
                                str += `<span class="in"><i class="fa fa-share" rel="tooltip" data-original-title="Transaksi Masuk"></i> </span>`;
                                else if(item.type == -1)
                                str += `<span class="out"><i class="fa fa-reply"  rel="tooltip" data-original-title="Transaksi Keluar"></i> </span>`;
                            str += `</td>
                            <td>`; if(item.explanation != null) str += item.explanation; else str += "-"; 
                            str += `</td>
                            <td>Rp. `; if(item.total_price != null) str += formatMoney(item.total_price); else str += "0"; 
                            str += `</td>
                            <td>`+formatDate(date)+`</td>
                        </tr>`;
                        //console.log(item);
                        i++;
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
    </script>
@endsection