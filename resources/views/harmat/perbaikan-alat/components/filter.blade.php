<form action="#" method="get" class="form-inline mb-10">
    <label class="mr-2">Mulai</label>
    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0 js-datepicker" name="tgl_laporan_start" id="tgl_laporan_start"  data-date-format="dd-mm-yyyy" value="@isset($_GET['tgl_laporan_start']){{date("d-m-Y", strtotime($_GET['tgl_laporan_start']))}}@else {{date('01-m-Y')}}@endif">
    <label class="mr-2">Akhir</label>
    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0 js-datepicker"name="tgl_laporan_end" id="tgl_laporan_end"  data-date-format="dd-mm-yyyy" value="@isset($_GET['tgl_laporan_end']){{date("d-m-Y", strtotime($_GET['tgl_laporan_end']))}}@else{{date('t-m-Y')}}@endif">

    <button type="submit" class="btn btn-primary">
        <i class="fa fa-filter mr-2"></i> Filter
    </button>
</form>
