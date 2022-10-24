@extends('layouts.main2')
@section('css')

@endsection
@section('content')
@include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Cetak Laporan LabPA</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">                        
                        {{Form::label('cetak_date', 'Rekap Jumlah Pasien Bulanan')}}
                        <input type="text" class="form-control" id="cetakRekapDate" name="cetak_rekap_date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="yyyy-mm">
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="submitLaporanBulanan('/labpa/laporan/bulanan/rekap_pasien', 'rekap_pasien');" class="btn btn-primary">Download</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">                        
                        {{Form::label('cetak_date', 'Laporan Diagnosa LabPA')}}
                        <input type="text" class="form-control" id="cetakDiagnosaDate" name="cetak_diagnosa_date" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="yyyy-mm">
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="submitLaporanBulanan('/labpa/laporan/bulanan/diagnosa', 'diagnosa');" class="btn btn-primary">Download</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
{{Form::close()}}
</div>
<div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Simpan Perubahan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <h4>Apakah anda yakin untuk menyimpan perubahan?</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                <button type="button" onclick="submitForm();" class="btn btn-alt-success" data-dismiss="modal">
                    <i class="fa fa-check"></i> Lanjut
                </button>
            </div>
        </div>
    </div>
</div>
@include('labpa.components.footer')
@endsection

@section('js')


<script src="{{asset('assets/js/pages/be_tables_datatables.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        @if(session('status'))
        swal(
            '{{session("message")}}',
            "",
            '{{session("status")}}'
            );
        @endif
        $("#cetakRekapDate").datepicker( {
            format: "yyyy-mm",
            startView: "months", 
            minViewMode: "months"
        });
        $("#cetakDiagnosaDate").datepicker( {
            format: "yyyy-mm",
            startView: "months", 
            minViewMode: "months"
        });
    });
    function submitLaporanBulanan(link, type){
        if(type == 'rekap_pasien')
            var date = $("#cetakRekapDate").val();
        else if(type == 'diagnosa')
            var date = $("#cetakDiagnosaDate").val();
        if(!date){
            swal("Error", "Mohon isi bulan/tanggal laporan yang diinginkan", "error")
            return false;
        }
        window.open(
          "{{url('/')}}"+link+"?date="+date,
          '_blank' // <- This is what makes it open in a new window.
          );
    }
</script>
@endsection