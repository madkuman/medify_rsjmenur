@extends('bpjs.layouts.main')

@section('title')
Pengajuan Penerbitan SEP - Medify
@endsection

@section('subtitle')
Dashboard
@endsection

@section('css')

<style type="text/css">
    .block-content {
        padding-bottom: 18px;
    }
</style>
@endsection

@section('content')
<main id="main-container">
    @include('bpjs.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block rounded main-content transaction-index"  ng-controller="BPJSController">
                    <div class="block-header">
                        <h3 class="block-title">Daftar SEP</h3>
                        <div class="block-options">
                            <a href="{{url('')}}/bpjs/sep/search" class="btn btn-primary">Cari Dengan Nomor</a>
                        </div>
                    </div>
                    <div class="content">

                        <div class="table-full-width spinner-container" id="bpjsResult"> 
                            <div class="spinner-back">
                                <table class="table table-bordered table-striped table-vcenter no-footer" aria-describedby="DataTables_info" id="bpjsTable">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th class="d-none d-sm-table-cell text-center" style="width: 2%;">No. </th>
                                            <th class="d-none d-sm-table-cell text-center" style="width: 18%;">No. SEP</th>
                                            <th style="width: 20%">Pasien</th>
                                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">No. BPJS</th>
                                            <th class="d-none d-sm-table-cell text-center" style="width: 10%;">Jenis</th>
                                            <th class="text-center" style="width: 12%;">Total Plafon (Rp)</th>
                                            <th style="width: 18%">Dibuat Pada</th>
                                            <th style="width: 6%"></th>
                                            <th style="width: 6%"></th>
                                        </tr>
                                    </thead>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<div class="modal fade" id="modal-edit-item" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Ubah SEP #<span id="editHeaderNoSEP"></span></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form method="post" id="editForm">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control form-control-lg" id="editID" name="id" placeholder="NO BPJS" readonly="">
                        <div class="form-group ">
                            <label>No BPJS</label>
                            <input type="text" class="form-control form-control-lg" id="editBPJS" name="no_bpjs" placeholder="NO BPJS" readonly="">
                        </div>
                        <div class="form-group ">
                            <label>No SEP</label>
                            <input type="text" class="form-control form-control-lg" id="editSEP" name="no_sep" placeholder="No SEP Pasien" readonly>
                        </div>
                        <div class="form-group ">
                            <label>Plafon SEP</label>
                            <input type="text" class="form-control form-control-lg" id="editPlafon" name="plafon" placeholder="Jumlah Plafon misal : 1200000" >
                        </div>
                        
                        <div class="form-group ">
                            <div class="col-12 text-center">
                                <button type="submit" id="buttonEditSEP" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                    <i class="fa fa-send mr-5"></i> Ubah SEP
                                </button>
                                <button type="button" id="loadingEditSEP" style="display: none" class="btn-alt btn-hero btn-primary min-width-175 float-right disabled">
                                   <i class="fa fa-spinner fa-spin"></i> Loading
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKasus" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Daftar Kasus<span id="editHeaderNoSEP"></span></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="text-center">
                        <span class="fa fa-4x fa-cog fa-spin text-primary text-center loader" style=""></span>
                    </div>
                    <table class="table table-hover table-vcenter" id="tableKasus" style="display: none;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Nama</th>
                                <th class="d-none d-sm-table-cell" style="width: 35%;">Pasien</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="kasusBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    var oTable = $("#bpjsTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{url("bpjs/ajax")}}',
        },
        language: {
            processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
        },
        columns: [
        { data: 'id'},
        { data: 'no_sep'},
        { data: 'nama_pasien'},
        { data: 'no_bpjs'},
        { data: 'jenis'},
        { data: 'total_plafon'},
        { data: 'created_at', orderable: true},
        { data: 'edit', orderable: false, searchable: false},
        { data: 'detail', orderable: false, searchable: false},
        ],
        order: [],
        pageLength: 10
    });

    function showEdit(el)
    {
        const url = '{{url("kasus/")}}';
        let bpjs = el.dataset.bpjs,
        sep = el.dataset.sep,
        nomor = el.dataset.nomor,
        plafon = el.dataset.plafon,
        id = el.dataset.id;
        $("#editBPJS").val(bpjs);
        $("#editSEP").val(sep);
        $("#editPlafon").val(plafon);
        $("#editID").val(id);
        $("#modal-edit-item").modal('show');
        $('#loadingEditSEP').hide()
        $('#buttonEditSEP').show()
    }

    function showKasusModal(id)
    {
        $.ajax({
            url: "{{url('bpjs/kasus')}}?id="+id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function(){
                $('.loader').show();
                $('#tableKasus').hide();
            },
            success: function(response) {
                loadResponse(response);
            },
            complete: function(){
                $('.loader').hide();
                $('#tableKasus').show();
            },
            error: function() {

            },
        });
        $('#modalKasus').modal('show');
    }

    function loadResponse(data){
        console.log(data)
        let body = $('#kasusBody');
        body.empty();
        data.forEach(function(item, index){
            body.append(`<tr>
                <th class="text-center" scope="row">${index+1}</th>
                <td>${item.judul_kasus}</td>
                <td>${item.pasien.name}</td>
                <td class="text-center">
                <div class="btn-group">
                <button type="button" class="btn btn-info" data-toggle="tooltip" title="" data-original-title="Edit" onclick="window.open('${BASE_URL}kasus/${item.nomor_kasus}/bpjs',\'popUpWindow\',
                \'left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=yes,directories=no,status=yes\')">
                Kunjungi
                </button>
                </div>
                </td>
                </tr>`);
        });
    }

    $("#editForm").submit(function(event){
        event.preventDefault();
        var $form = $(this);
        var serializedData = $form.serialize();

        $('#loadingEditSEP').show()
        $('#buttonEditSEP').hide()
        $.ajax({
            type:'POST',
            url: API_URL+"/bpjs/edit-plafon",
            dataType: 'json',
            data:serializedData,
            tryCount : 0,
            retryLimit : 3,
            success:function(data){
                callSwal("success","Sukses","Plafon berhasil diubah","");
                $('#modal-edit-item').modal('hide');
                $('#loadingEditSEP').hide()    
                $('#buttonEditSEP').show()
                oTable.ajax.reload( null, false ) //agar ganti reload halaman
            },
            error : function(xhr, textStatus, errorThrown ) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }        
                $('#loadingEditSEP').hide()    
                $('#buttonEditSEP').show()
                return callSwal("error","Gagal","Terjadi kesalahan server","");
            }
        });

    });

</script>
@endsection