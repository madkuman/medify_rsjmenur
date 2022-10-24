
@extends('layouts.main-dashboard')

@section('title')
Tarif {{$tarif->deskripsi}} - Keuangan
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">#TAR{{$tarif->id}}</h3>
            <div class="block-options">
                <a href="edit/{{$tarif->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$tarif->id}}" data-toggle="tooltip" title="Delete ">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row my-20">
                <div class="col-9">
                    <address>Kategori <p class="h5 mb-5"> 
                    @if (isset($tarif->kategori->parent->parent->nama))
                        {{$tarif->kategori->parent->parent->nama ?? '-'}} >
                    @endif
                    @if (isset($tarif->kategori->parent->nama))
                        {{$tarif->kategori->parent->nama ?? '-'}} >
                    @endif
                    {{$tarif->kategori->nama ?? '-'}}</p>
                    {{$tarif->kategori_slug->nama ?? ''}}
                </address>
                </div>
                <div class="col-3 text-right">
                    <address>Dibuat tanggal <p class="h5"> {{date('d F Y', strtotime($tarif->created_at))}}</p></address>
                </div>
            </div>
            <div class="row my-20">
                <div class="col-12">
                    <p class="h4 text-center">{{$tarif->deskripsi}}</p>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($tarif->tarif->sortBy('kelas_id') as $rownum => $item)
                        <tr>
                            <td class="text-center">{{$i}}</td>
                            <td class="text-center">{{$item->tipe->nama}}</td>
                            <td class="text-center">
                                @php
                                if($item->kelas_id == 0)
                                    $kelas = 'Semua Kelas';
                                else
                                    $kelas = $item->kelas->nama ?? "-";
                                @endphp
                                {{$kelas}}
                            </td>
                            <td class="text-right">
                                @if (intval($item->harga)>0 && !$item->persen)
                                Rp {{number_format($item->harga,0)}}
                                @elseif($item->persen)
                                    {{$item->persen}}%
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-alt-primary btn-lihat" data-id="{{$item->id}}" data-deskripsi="{{$item->tipe->nama}} - Kelas {{$kelas}}" data-toggle="tooltip" title="Lihat Breakdown INACBG ">
                                    <i class="fa fa-search-plus"></i>
                                </button>
                                <a href="{{url()->current()}}/edit-inacbg/{{$item->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Breakdown INACBG ">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Invoice -->
</div>

<!-- END Page Content -->

<div class="modal fade" id="modal-single" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="block mb-0">
                    <div class="block-content">
                        <div class="loading-animation text-center p-20">
                            <i class="fa fa-spinner fa-spin text-primary fa-4x"></i>
                        </div>
                        <div class="main-content">
                            <h4 class="mb-5">Breakdown INACBG</h4>
                            <h5 class="mb-5 tarif-nama">Nama Tarif</h5>
                            <hr>
                            <table class="table table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1A</td>
                                        <td>Rp 20,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript"> 
    $('button.remove').click(function(){
        var id = $(this).data("pk")			
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "admin/tarif/delete",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id : id
                        },
                        success: function (data) {
                            callSwal(data.type,data.title,data.text,data.url);
                        },
                        error: function () {
                            callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                        }
                    })
                });
            }
        })
    });

    $(document).on('click', '.btn-lihat', function(){ 
        var id = $(this).data('id')
        var deskripsi = $(this).data('deskripsi')
        $('#modal-single').modal('show');
        $('#modal-single .loading-animation').show();
        $('#modal-single .main-content').hide();

        $.ajax({
            type:'GET',
            url: API_URL+"/keuangan/tarif/get-inacbg?id="+id,
            tryCount : 0,
            dataType: 'json',
            retryLimit : 3,
            success:function(data){
                $('#modal-single .table tbody').empty();
                if (data.length > 0) {
                    $.each(data, function( index, value ) {
                        content = `
                        <tr>
                            <td class="h5 font-w400">`+value.nama+`</td>
                            <td class="h5 font-w400">`+value.harga+`</td>
                        </tr>
                        `
                        thead = `
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                            </tr>
                        `

                        $('#modal-single .table thead').html(thead)
                        $('#modal-single .table tbody').append(content)
                        $('#modal-single .tarif-nama').text(deskripsi)

                    });
                } else {
                    content = `
                    <tr>
                        <td class="h5 font-w400 text-center" colspan="2">Belum ada breakdown</td>
                    </tr>
                    `;
                    $('#modal-single .table thead').html(content)
                    $('#modal-single .tarif-nama').text(deskripsi)
                }
                
                $('#modal-single .loading-animation').hide();
                $('#modal-single .main-content').show();
            },
            error : function(xhr, textStatus, errorThrown ) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }        
                $('#modal-single').modal('hide');
                return callSwal("error","Gagal","Terjadi kesalahan server","");
            }
        });
    })
</script>
@endsection
