<div class="block-content">
    <div class="row">
        <div class="col-12">
            <h6>MUTASI KUOTA CUTI</h6>
        </div>
    </div>
    <div class="row mb-10">
        <div class="col-lg-2 col-12">
            <label>Jenis Cuti </label>
            <select class="js-select2 form-control filter-jenis">
                <option value="all">Semua</option>
                @foreach($master_cuti as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <label>Rentang Waktu Cuti</label>
            <div class="input-daterange input-group" data-date-format="dd-mm-yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                <input type="text" class="form-control" autocomplete="off" id="filter-date-1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y',strtotime('-2 months'))}}" required="">
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">to</span>
                </div>
                <input type="text" class="form-control" autocomplete="off" id="filter-date-2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d-m-Y',strtotime('+1 months'))}}" required="">
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="tableCuti">
        <thead>
            <tr>

                <th class="">No</th>
                <th>Jenis Cuti</th>
                <th>Tanggal Cuti</th>
                <th>Form Pengajuan</th>
                <th>Waktu Perubahan</th>
                <th>Perubahan</th>
                <th>Sisa</th>
                <th width="10%">Aksi</th>
            </tr>

        </thead>
    </table>
</div>