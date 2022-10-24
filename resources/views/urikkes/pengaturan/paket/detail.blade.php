@extends('urikkes.layouts.main')

@section('title')
Urikkes - Medify
@endsection


@section('subtitle')
Detail Paket
@endsection


@section('content')
<main id="main-container">
    @include('urikkes.layouts.navbar')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-danger pull-right ml-10" id="deletePaket">Hapus</button>
                <a href="{{url('urikkes/pengaturan/paket/edit/'.$paket->id)}}" class="btn btn-primary pull-right ">Ubah</a>
                <h1><span class="font-w600">{{$paket->nama}}</span> </h1>
            </div>
        </div>
        <div class="row gutters-tiny" >
            <div class="col-12 my-5">
                <div class="block block-bordered block-link-shadow" style="height:100%;">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">#</th>
                                    <th style="width: 60%;">Nama</th>
                                    <th style="width: 30%;" class="text-center">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total = 0)
                                @foreach($paket->tarifPaket as $layanan)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$layanan->tarifMaster->deskripsi}}</td>
                                    <td class="text-right">Rp &nbsp; {{number_format($layanan->harga)}}</td>
                                    @php($total+=$layanan->harga)
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-right">
                            <h3><span class="font-w600">Total: Rp &nbsp; {{number_format($paket->total)}}</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){
    $("#deletePaket").on("click",function(e) {
        e.preventDefault(); // cancel the link itself
        hapusConfirm();
        //nggawe ajax
      });

    function hapusConfirm() {
        swal(
        {
            title:"Hapus {{$paket->nama}}?", 
            text:"Data layanan dari paket {{$paket->nama}} akan dihapus. Yakin ingin menghapus {{$paket->nama}}?", 
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Hapus!',
            confirmButtonText: "Batal",
            dangerMode: true,
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(isCancel) {
            if (isCancel) {
                hapus();
            }
        });
    }

    function hapus() {
        var id ={{$paket->id}};
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          $.ajax({
            type:'POST',
            url:'{{url("urikkes/pengaturan/paket/delete")}}',
            data: {
              "_token": "{{ csrf_token() }}",
              "paket_id": id
            },
            success:function(data){
                console.log('cook');
              swal(
                {
                    title:"Berhasil!", 
                    text:"Data layanan dari paket {{$paket->nama}} berhasil dihapus.", 
                    type:"success",
                    timer:3000,
                }).then(function() {
                        // console.log(data);
                        location.href = '{{url('urikkes/pengaturan/paket')}}';
                });
            },
            error:function(data){
              console.log(data);
              swal(
                {
                   type: "error", 
                   title: "Gagal|",
                   text: "Data layanan dari paket {{$paket->nama}} gagal dihapus",
                    timer:3000,
                });
            }
          });
    }
});
    
</script>
@endsection