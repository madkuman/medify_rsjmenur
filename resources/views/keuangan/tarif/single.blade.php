@extends('keuangan.layouts.main')

@section('title')
Tarif {{$tarif->deskripsi}} - Keuangan
@endsection

@section('content')


<!-- Page Content -->
<div class="content p-0" id="print-content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none pt-0">
        Detail Tarif
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">#OUT{{$tarif->id}}</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Codebase() -> uiHelperPrint() -->
                @if($is_super_admin && isset($hasil_urikkes))
                    <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#pengaturan-urikkes">
                    <i class="si si-chemistry"></i> Setting Hasil Urikkes
                    </button>
                @endif
                <button type="button" class="btn btn-sm btn-alt-primary" onclick="printContent('print-content')" data-toggle="tooltip" title="Print Invoice">
                    <i class="si si-printer"></i>
                </button>
                <a href="edit/{{$tarif->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-sm btn-alt-danger remove" data-pk="{{$tarif->id}}" data-toggle="tooltip" title="Delete Transaksi">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content">
            <!-- Invoice Info -->
            <div class="row my-20">
                <div class="col-9">
                    <address>Kategori <p class="h5"> 
                    @if (isset($tarif->kategori->parent->parent->nama))
                        {{$tarif->kategori->parent->parent->nama ?? '-'}} >
                    @endif
                    @if (isset($tarif->kategori->parent->nama))
                        {{$tarif->kategori->parent->nama ?? '-'}} >
                    @endif
                    {{$tarif->kategori->nama ?? '-'}}</p></address>
                    {{-- <address>Kode Tarif <p class="h5">{{$tarif->tarif_kode->name}}</p></address> --}}
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
            @if($is_labpk)
            <div class="row my-20">
                <div class="col-9">
                    <address>LIS ID <p class="h5">{{$tarif->lis_id ?? '-'}}</p></address>
                </div>
            </div>
            @endif
            <!-- END Invoice Info -->

            <!-- Table -->
            <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($tarif->tarif->sortBy('kelas_id') as $rownum => $item)
                        <tr>
                            <td class="text-center">{{$i}}</td>
                            <td class="text-center">{{$item->tipe->nama}}</td>
                            <td class="text-center">
                                @if($item->kelas_id == 0)
                                    Semua Kelas
                                @else
                                    {{$item->kelas->nama ?? "-"}}
                                @endif
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
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END Table -->

            <!-- Footer -->
            <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
            <!-- END Footer -->
        </div>
    </div>
    <!-- END Invoice -->
</div>

@if($is_super_admin && isset($hasil_urikkes))
    @include('keuangan.tarif.components.modal-urikkes')
@endif
<!-- END Page Content -->
@endsection

@section('js')
<script type="text/javascript"> 
    $(document).on('click', '.remove-urikkes', function(){
        $(this).parent().parent().remove();
    });
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
                        url: API_URL + "/keuangan/tarif/delete",
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
    function addUrikkesItem(){
        $('.urikkes-div').append(`<div class="form-group row">
<input type="text" class="form-control col-4 mr-10 ml-10" name="tabel[]" placeholder="Nama Tabel">
                                <input type="text" class="form-control col-4 mr-10" placeholder="Nama Kolom" name="kolom[]">                            
                                <div class="col-2">                            
                                    <button type="button" class="btn btn-alt-danger h-100 remove-urikkes">
                                        <i class="fa fa-close"></i> Hapus
                                    </button>
                                </div>`);
    }
    function removeUrikkesItem(el){
        $(el).parent().parent().remove();
    }
    function printContent(id){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(id).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
@endsection