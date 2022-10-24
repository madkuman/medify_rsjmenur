<script  type="text/javascript">

    var tahun = '';
    var kategori ='';
    var atasan ='';
    var status = '';
    var total_pages = 1;
    var visible_pages = 5;
    var keyword = '';
    var items_show = 10;
    var firstLoadPagination = false;

    $(document).ready(function() {
        $(".js-datepicker-year").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        });
        tahun = $('#periode').val();
        kategori  = $('#kategori').val();
        atasan  = $('#atasan').val();
        status = $('#status').val();
        keyword = $('#pegawaiSearch').val();
        loadData(1);
    });

    function loadData(currentPage=1) {
        $('.spinner').fadeIn();
        $.ajax
        ({
            url: API_URL+'/e-sakip/monitoring',
            method: "GET",
            datatype:"json",
            data: {
                'page':currentPage,
                'tahun': tahun,
                'kategori': kategori,
                'atasan': atasan,
                'keyword':keyword,
                'status': status,
            },
            success: function(response)
            {
                var content = '';
                var count =0;
                response = JSON.parse(response);
                $.each(response.data, function(idx, elem){
                    count++;
                    content += '<div class="block toSearch">';
                    content += '<div class="block-content pb-20">';
                    content += '<div class="row p-0 m-0">';
                    content += '<div class="col-md-12 text-center h-200 d-flex align-self-center">';
                    content += '<span><h6 class="mb-0">'+idx+'</h6><hr style="border-bottom: 2px solid black"></span>';
                    content += '</div><br><br>';
                    $.each(response.kategori, function(i, item){
                        if(item.id == $('#kategori').val()) {
                            content += '<div class="col-md-3 h-200 d-flex">';
                            content += '<h6 class="mb-0">' + item.nama;
                            for (j = 0; j < item.max; j++) {
                                var counter = parseInt(j) + parseInt(1);
                                content += '<br><br>';
                                content += '<button type="button" class="btn btn-sm btn-circle btn-secondary" disabled="disabled">' + counter + '</button>';

                                if (elem[item.nama] && elem[item.nama][j]) {
                                    content += '<button type="button" onclick="lihatDokumen(this)" class="btn btn-sm btn-outline-primary js-tooltip-enabled ml-10" data-toggle="tooltip" data-path="' + elem[item.nama][j].path + '">Download</button>';
                                    if (elem[item.nama][j].verified_at) {
                                        content += '<button type="button" class="btn btn-sm btn-circle btn-success fa fa-check ml-10" disabled="disabled"></button>';
                                    } else {
                                        content += '<button type="button" class="btn btn-sm btn-circle btn-danger fa fa-close ml-10" disabled="disabled"></button>';
                                    }
                                    if (elem[item.nama][j].verified_admin_at) {
                                        content += '<button type="button" class="btn btn-sm btn-circle btn-success fa fa-check ml-10" disabled="disabled"></button>';
                                    } else {
                                        content += '<button type="button" class="btn btn-sm btn-circle btn-danger fa fa-close ml-10" disabled="disabled"></button>';
                                    }
                                } else {
                                    content += '<button type="button" class="btn btn-sm btn-outline-danger js-tooltip-enabled ml-10" data-toggle="tooltip" disabled="disabled" title="File Belum Tersedia">Download</button>';
                                    content += '<button type="button" class="btn btn-sm btn-circle btn-danger fa fa-close ml-10" disabled="disabled"></button>';
                                    content += '<button type="button" class="btn btn-sm btn-circle btn-danger fa fa-close ml-10" disabled="disabled"></button>';
                                }
                            }
                            content += '</h6>';
                            content += '</div>';
                        }
                    });
                    content += '</div>';
                    content += '</div>';
                    content += '</div>';
                });
                if(count == 0)
                {
                    content += '<div class="spinner"><h5>Data Tidak Tersedia</h5></div>';
                }
                total_pages = Math.ceil(response.total/items_show);
                $('.spinner').fadeOut();
                $('#transaksi-content').html(content);
                $('#transaksi-content').fadeIn();
                loadPagination(currentPage);
            }
        });
    }

    function loadPagination(currentPage = 1)
    {

        $('#pagination').twbsPagination('destroy');
        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                loadData(page);
            }
        });
        firstLoadPagination = true;
    }
    var startSearch;
    $(document).on('keyup', '#pegawaiSearch', function(){
        clearTimeout(startSearch);
        startSearch = setTimeout(function(){
            keyword = $('#pegawaiSearch').val();
            loadData(1);
        }, 700);

    });

    $( document ).on('change', '#atasan', function(){
        atasan = $('#atasan').val();
        loadData(1);
    });

    $( document ).on('change', '#periode', function(){
        tahun = $('#periode').val();
        loadData(1);
    });

    $( document ).on('change', '#kategori', function(){
        kategori = $('#kategori').val();
        loadData(1);
    });

    $( document ).on('change', '#status', function(){
        status = $('#status').val();
        loadData(1);
    });

    function lihatDokumen(data) {
        var path = data.getAttribute("data-path");
        url = BASE_URL+path;
        popupwindow(url,'Dokumen Pegawai',600,800);
    }
</script>