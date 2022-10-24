@extends('gizi.layouts.index')

@section('title')
    Gizi Kode Diet
@endsection

@section('css')
    
@endsection

@section('content')
    <div class="content">
        <div class="block p-10">
            <div class="block-header">
                <h3 class="block-title">
                    <small><a href="{{url('gizi/kode-diet/baru')}}" class="pull-right"><i class="fa fa-plus-circle"></i> Kode Diet Baru</a></small>
                    Daftar Kode Diet
                </h3>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="kode_diet">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kode Diet</th>
                        <th>Jenis Makanan</th>
                        <th>Kategori Makanan</th>
                        <th>Diet</th>
                        <th>Bentuk Makanan</th>
                        <th>Tambahan</th>
                        <th>Cair</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')

    
    

    <script type="text/javascript">
        $(document).ready( function () {
            var table = $('#kode_diet').DataTable({
                searching: true,
                ordering: false,
                processing: true,
                serverSide: true,
                bLengthChange: true,
                pageLength: 10,
                responsive: true,
                scrollY: "calc( 100% - 70px )",
                scrollCollapse: true,
                ajax: {
                    dataSrc: "data",
                    url: API_URL+'/gizi/kode-diet/load-data',
                    type :'GET',
                    data :{

                    }
                },
                language: {
                    processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
                },
                columns: [
                    { data: 'DT_Row_Index' },
                    { data: 'kode_diet' },
                    { data: 'jenis_makanan' },
                    { data: 'kategori_makanan' },
                    { data: 'diet' },
                    { data: 'bentuk_makanan' },
                    { data: 'tambahan' },
                    { data: 'cair' },
                    { data: 'aksi' },
                ],
                columnDefs: [

                ],
            });
        });

        $('#kode_diet').on('click', '.btn-detail', function(){
            var id = $( this ).attr( 'id_data' );
            $(location).attr('href', '{{url('gizi/kode-diet/single')}}/' + id);
        });

    </script>
@endsection