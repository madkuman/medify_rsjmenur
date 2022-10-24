@extends('farmasi.layouts.main')

@section('title')
Farmasi Waktu Estimasi per Jenis Resep
@endsection

@section('css')

<style type="text/css">
    .inline {
        display: inline;
    }
    .modal-content {
        border-radius: 0;
    }
    .clickable-row {
        cursor: pointer;
    }
    .mt-70 {
        margin-top: 70px !important;
    }
</style>
@endsection

@section('content')
    <div class="block" style="min-height: 350px">
        <div class="block-header block-header-default">
            <h3 class="block-title">Waktu Estimasi per Jenis Resep</h3>
        </div>
        <div class="block-content">
            <div class="block block-transparent">            
            <table class="table table-striped table-hover table-vcenter js-dataTable-full" id="waktu_estimasi" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%">No</th>
                        <th class="text-center" style="width: 35%">Jenis Resep</th>
                        <th class="text-center" style="width: 20%">Waktu Estimasi (Menit)</th>
                        <th class="text-center" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($waktu_etimasi as $item)
                        <tr>    
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$item->jenis_resep}}</td>
                            <td class="text-center">{{$item->waktu_estimasi}}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-alt-warning editBtn" data-id="{{$item->id}}" data-index="{{$loop->iteration - 1}}" data-toggle="tooltip" title="Edit">
									<i class="fa fa-edit"></i>
								</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5" style="text-align: center">Tidak ada data</td>
                        </tr>                        
                    @endforelse
                        
                </tbody>
            </table>
        </div>
    </div>

    @include('farmasi.screen.pengaturan.waktu-estimasi-jenis-resep.modal')
@endsection

@section('js')
<script type="text/javascript">
    var data = JSON.parse({!!json_encode(str_replace("`", "'", $waktu_etimasi))!!});

    var table = jQuery('.js-dataTable-full').dataTable({
            "ordering": true,
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false
        });

    $(".editBtn").click(function(e){
        id = $(this).data("id");
        var item = data[$(this).data("index")];
        if(item != "" && item != undefined){
            $("#id").val(item.id);
            $(`:text[name="jenis_resep"]`).val(item.jenis_resep);
            $(`[name="waktu_estimasi"]`).val(item.waktu_estimasi);
        }
        $("#modal-medium").modal("toggle");
    });
</script>
@endsection