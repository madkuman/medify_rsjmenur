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
                    <a href="{{url('gizi/pemesanan/edit/')?? '-' }}/{{$data['kode_diet']->id?? '-' }}" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{url('gizi/pemesanan/delete/')?? '-' }}/{{$data['kode_diet']->id?? '-' }}"
                       class="btn btn-danger pull-right mr-5"><i class="fa fa-trash"></i> Delete</a>
                    Kode Diet {{$data['kode_diet']->nama?? '-' }}
                </h3>
            </div>
            <div class="block-content">
                <div class="row mt-20">
                    <div class="col">
                        <input type="hidden" id="kode_diet_id" value="{{$data['kode_diet']->id}}">
                        <h5 class="font-w400">
                            <small>Jenis Makanan</small>
                            @if(!empty($data['kode_diet']->jenis_makanan))
                                <br>{{$data['kode_diet']->jenis_makanan->nama?? '-' }}
                            @else
                                <br>-
                            @endif
                        </h5>
                        <h5 class="font-w400">
                            <small>Kategori Makanan</small>
                            @if(!empty($data['kode_diet']->kategori_makanan))
                                <br>{{$data['kode_diet']->kategori_makanan->nama?? '-' }}
                            @else
                                <br>-
                            @endif
                        </h5>
                        <h5 class="font-w400">
                            <small>Diet</small>
                            @if(!empty($data['kode_diet']->diet))
                                <br>{{$data['kode_diet']->diet->nama?? '-' }}
                            @else
                                <br>-
                            @endif
                        </h5>
                    </div>
                    <div class="col">
                        <h5 class="font-w400">
                            <small>BENTUK MAKANAN</small>
                            @if(!empty($data['kode_diet']->bentuk_makanan))
                                <br>{{$data['kode_diet']->bentuk_makanan->nama?? '-' }}
                            @else
                                <br>-
                            @endif
                        </h5>
                        <h5 class="font-w400">
                            <small>Tambahan</small>
                            <br>
                            @if($data['kode_diet']->is_rg ==1)
                                <span class="badge badge-info">RG</span>
                            @endif
                            @if($data['kode_diet']->is_ptg ==1)
                                <span class="badge badge-info">PTG</span>
                            @endif
                            @if($data['kode_diet']->is_lc ==1)
                                <span class="badge badge-info">LC</span>
                            @endif
                            @if($data['kode_diet']->is_rg ==0 && $data['kode_diet']->is_ptg ==0 && $data['kode_diet']->is_lc ==0)
                            -
                            @endif
                        </h5>
                        <h5 class="font-w400">
                            <small>Cair</small>
                            <br>
                            @if(!empty($data['kode_diet']->diet))
                                @if($data['kode_diet']->diet->cair!=null)
                                    <span class="badge badge-success">Iya</span>
                                @else
                                <span class="badge badge-danger">Tidak</span>
                                @endif
                            @else
                                <span class="badge badge-danger">Tidak</span>
                            @endif
                        </h5>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="kode_diet_menu">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Kelas</th>
                                <th>Periode Tanggal</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    
    

    <script type="text/javascript">
        $(document).ready( function () {
            var kode_diet_id = $("#kode_diet_id").val();
            var table = $('#kode_diet_menu').DataTable({
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
                    url: API_URL+'/gizi/kode-diet/single/load-data',
                    type :'GET',
                    data :{
                        kode_diet_id : kode_diet_id,
                    }
                },
                language: {
                    processing: '<i class="fa fa-4x fa-spinner fa-spin text-info"></i>'
                },
                columns: [
                    { data: 'DT_Row_Index' },
                    { data: 'menu' },
                    { data: 'kelas' },
                    { data: 'periode' },
                    { data: 'aksi' },
                ],

            });
        });

        $('#kode_diet_menu').on('click', '.btn-detail', function(){
            var id = $( this ).attr( 'id_data' );
            $(location).attr('href', '{{url('gizi/menu')}}/' + id);
        });

    </script>
@endsection