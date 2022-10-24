@extends('unit-tindakan.layouts.main')

@section('title')
{{$tindakan->nama}} - Unit Tindakan
@endsection

@section('subtitle')
{{$tindakan->nama}} / Dashboard
@endsection

@section('css')
@endsection

@section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Transaksi Unit {{$tindakan->nama}}</h3>
    </div>
    <div class="block-content" style="overflow: auto;">
        <table class="table table-hover table-vcenter js-dataTable-full dataTable">
            <thead>
                <tr>
                    <th>No RM</th>
                    <th width="20%">Nama Pasien</th>
                    <th>Tanggal</th>
                    <th>Usia</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @include('unit-tindakan.dashboard.tr')
            </tbody>
        </table>
    </div>
</div>

@include('unit-tindakan.dashboard.components.tindakan-modal')
@include('unit-tindakan.dashboard.components.resep-modal')
@endsection
@section('js')
<script type="text/javascript">
    var slug = "{{$tindakan->slug}}";
    var tarif_kelas;

    function periksa(kasus_id, transaksi_id, el){
        $('#kasus-id').val(kasus_id);
        $('#modal-create-tindakan').modal('show');
        $('#transaksi-id').val(transaksi_id);
        $('#tarif-kelas').val($(el).data('tarif_kelas'));

        tarif_kelas = $('#tarif-kelas').val();

        /*REMOVE SELECTED TINDAKAN*/
        $('.tindakan-input').remove()
        $("#submit_akhir").hide();
        $('#hasil-tambahkan-empty').show()
        /********************************/
        
        SearchTindakanPerawat();
    }

    function modalResep(nomor_kasus,pasien_id,metode_pembayaran_id,lokasi_id,elemen){
        $('#modal-create-resep').modal('show')
        $('#modal-create-resep #resep-pasien').val(pasien_id)
        $('#modal-create-resep #resep-lokasi').val(lokasi_id)
        $('#modal-create-resep #resep-metode-pembayaran').val(metode_pembayaran_id)
        url = "{{url('kasus')}}/"+nomor_kasus+"/datamedis/resep/create"
        $('#modal-create-resep #form_create_resep').attr('action', url);
    }

    function selesai(transaksi_id){
        swal({
          title: 'Selesaikan Transaksi?',
          text: "Transaksi yang sudah diselesaikan tidak dapat diubah lagi",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          reverseButtons: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
        }).then((result) => {
          if (result.value) {
            window.location = `${BASE_URL}unit-tindakan/${slug}/selesai/${transaksi_id}`;
          }
        })
    }
</script>
@include('unit-tindakan.dashboard.components.tindakan-perawat-js')
@include('unit-tindakan.dashboard.components.resep-js')
@include('kasus.datamedis.content.js.resep-paket')
@endsection