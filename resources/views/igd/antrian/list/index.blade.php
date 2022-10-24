@extends('igd.layouts.main')

@section('title')
List Antrian - IGD - Medify
@endsection

@section('subtitle')
List Antrian
@endsection


@section('css')

<style>
div.dataTables_wrapper div.dataTables_processing {
    top: 10%;
    text-align: center;
}
</style>
@endsection


@section('content')
<main id="main-container">
    @include('igd.layouts.navbar')
    <div class="container">
        <div class="block">
            <div class="block-header border-bottom">
                <h4 class="font-w400 mb-0">List Semua Antrian</h4> 
            </div>
            <div class="block-content block-content-full">
                <table class="table table-striped table-vcenter" id="tabel_antrian">
                    <thead>
                        <tr>
                            <th>
                                Nomor Antrian
                            </th>
                            <th>
                                Waktu Pengambilan Nomor Antrian
                            </th>
                            <th>
                                Tingkat Urgensitas
                            </th>
                            <th>
                                Menu
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($antrian as $an)
                        @include('igd.antrian.list.tr')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
@endsection

@section('js')


<script type="text/javascript">
    jQuery('#tabel_antrian').dataTable({
        pageLength: 8,
        lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
        autoWidth: false
    });
    function call(loket_id, nomor)
    {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: API_URL + '/igd/antrian-button/call/'+loket_id+'/'+nomor,
            tryCount : 0, 
            retryLimit : 3,
            success: function (result) {
                if(result.status == 1)
                    callSwal('success','Berhasil','Antrian Berikutnya Akan Dipanggil Beberapa Saat Lagi',0)
                else
                    callSwal('error','Gagal','Tidak Ada Antrian Tersedia',0)
                location.reload();
            },
            error : function(xhr, textStatus, errorThrown ) {
                if (textStatus == 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }            
                    return;
                }
                if (xhr.status == 500) {
                    callSwal('error','Error','Kesalahan Server Hubungi Admin',0)
                    reset();
                } else {
                    callSwal('error','Error','Kesalahan Server Hubungi Admin',0)
                    reset();
                }
            }
        });
    }

    $(document).ready(function() {
        var extensions = {
            "sFilter": "dataTables_filter text-right"
        };
    });
</script>

@endsection
