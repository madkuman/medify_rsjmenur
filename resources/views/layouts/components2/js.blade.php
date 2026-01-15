<div id="main-page-loading" style="background: transparent;position: fixed;top:20vh;left: 50vw;
    border-radius: 50%;
    width: 50px;
    height: 50px; padding:4px;display: none">
    <i class="fa fa-spinner fa-spin fa-3x text-primary"></i>
</div>

<script type="text/javascript">
    // Notice how this gets configured before we load Font Awesome
  window.FontAwesomeConfig = { autoReplaceSvg: false }
</script>
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.scrollLock.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.appear.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.countTo.min.js')}}"></script>
<script src="{{asset('assets/js/core/js.cookie.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/additional-methods.min.js')}}"></script>
<script src="{{asset('assets/js/codebase.medify1.0.js')}}"></script>

<script src="{{asset('assets/js/fa5.10.0.11/fontawesome.min.js')}}"></script>
<script src="{{asset('assets/js/fa5.10.0.11/brands.min.js')}}"></script>
<script src="{{asset('assets/js/fa5.10.0.11/duotone.min.js')}}"></script>
<script src="{{asset('assets/js/fa5.10.0.11/light.min.js')}}"></script>
<script src="{{asset('assets/js/fa5.10.0.11/regular.min.js')}}"></script>
<script src="{{asset('assets/js/fa5.10.0.11/solid.min.js')}}"></script>
<script src="{{asset('assets/js/fa5.10.0.11/v4-shims.min.js')}}"></script>


<!-- Hakim Nambah -->
{{-- <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script> --}}
<script src="{{asset('assets/js/jquery.bootstrap.wizard.min.js')}}"></script>


<!-- Page Plugins -->
<script src="{{asset('assets/js/plugins/slick/slick.min.js')}}"></script>

<script src="{{asset('assets/js/plugins/wickedpicker/wickedpicker.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/dropzonejs/min/dropzone.min.js')}}"></script>

<!-- Page JS Code -->
<script>
    jQuery(function () {
        // Init page helpers (Slick Slider plugin)
        Codebase.helpers('slick');
    });
    jQuery(function () {
        // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
        Codebase.helpers(['datepicker', 'colorpicker', 'maxlength', 'masked-inputs', 'rangeslider', 'tags-inputs']);
    });
</script>

<!-- Page JS Plugins -->
<script src="{{asset('assets/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/chartjs/Chart.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/flot/jquery.flot.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/flot/jquery.flot.pie.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/flot/jquery.flot.stack.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/flot/jquery.flot.resize.min.js')}}"></script>


<!-- Page JS Plugins -->
<script src="{{asset('assets/js/plugins/magnific-popup/magnific-popup.min.js')}}"></script>

<!-- Page JS Code -->
<script>
    jQuery(function () {
        // Init page helpers (Magnific Popup plugin)
        Codebase.helpers('magnific-popup');
    });
</script>
<script>
    jQuery(function () {
        // Init page helpers (Table Tools helper)
        Codebase.helpers('table-tools');
    });
</script>
<!-- Page JS Plugins -->
<script src="{{asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/sweetalert2/es6-promise.auto.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/summernote/summernote-bs4.min.js')}}"></script>

<!-- Page JS Code -->
<script src="{{asset('assets/js/pages/be_ui_activity.js')}}"></script>
<script>
    jQuery(function () {
        // Init page helpers (BS Notify Plugin)
        Codebase.helpers('notify');
    });
</script>

<script type="text/javascript" src="{{asset('assets/js/lightgallery/lightgallery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-fullscreen.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-pager.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-zoom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-video.min.js')}}"></script>


<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/combodate/combodate.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-datepaginator.js')}}"></script>
<script type="text/javascript">
    $.fn.poshytip={defaults:null};
</script>
<script src="{{asset('assets/js/jquery-editable-poshytip.min.js')}}"></script>
<script src="{{asset('assets/js/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/numeral.min.js')}}"></script>
<script src="{{asset('assets/js/underscore-min.js')}}"></script>
<script src="{{asset('assets/js/backbone-min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('assets/js/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/plugins/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jszip.min.js')}}"></script>


<script src="{{asset('assets/js/mustache.js')}}"></script>
<script type="text/javascript">
    var customTags = [ '@{{', '}}' ];
</script>

<script src="{{asset('assets/js/pagination-twb.min.js')}}"></script>

<script type="text/javascript">
    moment.locale('id');
</script>


<script src="{{asset('assets/js/plugins/image-upload/bootstrap-imageupload.min.js')}}"></script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    numeral.register('locale', 'id', {
        delimiters: {
            thousands: '.',
            decimal: ','
        },
        abbreviations: {
            thousand: 'rb',
            million: 'jt',
            billion: 'b',
            trillion: 't'
        },
        ordinal : function (number) {
            return number === 1 ? '' : '';
        },
        currency: {
            symbol: 'Rp'
        }
    });
    function openNav() {
        document.getElementById("sidenav").style.left = "0px";
        $('#page-overlay').show()
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("sidenav").style.left = "-250px";
        $('#page-overlay').hide()
    }
</script>
@if (session('status') == 1)
<script type="text/javascript">
    swal({
      type: 'success',
      title: "{{session('title')}}",
      text: "{{ session('message') }}",
  });
</script>

@elseif (session('status') == -1)

<script type="text/javascript">
    swal({
      type: 'error',
      title: "{{session('title')}}",
      text: "{{ session('message') }}",
  });
</script>
@endif

<script type="text/javascript">
    var API_URL = "{{url('api')}}";
    var BASE_URL = "{{url('')}}/";
    jQuery(document).ready(function($) {
        $(document).on('click', '.clickable-row', function(){
            window.location = $(this).data("href");
        })
        // $(".clickable-row").click(function() {
        //     window.location = $(this).data("href");
        // });
    });
    function goToHref(url)
    {
        window.location = url;
    }
</script>

<script type="text/javascript">
    const getCircularReplacer = () => {
      const seen = new WeakSet();
      return (key, value) => {
        if (typeof value === "object" && value !== null) {
          if (seen.has(value)) {
            return;
          }
          seen.add(value);
        }
        return value;
      };
    };
    function callSwal(type,title,text,url)
    {
        return swal({
            type: type,
            title: title,
            html: text,
            timer:3000,
        }).then((result) => {
            if (result.dismiss != '' && !(url == "" || url==0)){
                swalRedirect(url);
            }
        });
    }

    function swalRedirect(url)
    {
        url = String(url)
        if(url !== '0' || url != 0)
        {
            newurl = "{{url('')}}/"+url;
            window.location.href = newurl;
        }
    }

    function callSwalNewtab(type,title,text,url)
    {
        return swal({
            type: type,
            title: title,
            html: text,
            timer:3000,
        }).then((result) => {
            if (result.dismiss != '') swalNewTab(url);
        });
    }

    function swalNewTab(url)
    {
        url = String(url)
        if(url !== '0' || url != 0)
        {
            newurl = "{{url('')}}/"+url;
            window.open(newurl,"", "height=900,width=900,modal=yes,alwaysRaised=yes");
        }
    }

    function swalTerjadiKesalahanServer() {
        return callSwal('error', 'Gagal!', 'Terjadi Kesalahan Server', 0);
    }

    function swalLoading(title = 'Harap Menunggu', html = 'Sedang memuat data . . .', type = 'warning'){
        swal({
                type : type,
                title : title,
                html : html,
                showCancelButton: false,
                allowOutsideClick: false,
                confirmButtonText: ``,
                onOpen: () => {
                    swal.showLoading()
                }
            })

        return swal;
    }

    $('.js-select2').select2();
    
    $('.js-select2-multiple').select2({
        tags: true
    });
</script>

@if(config('app.fetch_notification'))
<script type="text/javascript">
    function fetchNotification() {
        $.ajax({
            url: "{{url('')}}/api/notification/fetch",
            dataType: 'json',
            cache: false,
            type: 'GET',
            error: function(){
                fetchNotification();
            },
            success: function(data){
                // console.log(data);
                $('#notifications #notification-dropdown').empty();
                if (data.length > 0) {
                    $('#notifications #notification-dropdown').append(
                        `<div>
                            <a class="link-effect pull-left mb-15" href="{{url('')}}/notification/mark_all_as_read">
                                Tandai Semua Sudah Dibaca
                            </a>
                        </div>`
                    );
                    $.each(data, function(key, value){
                        var url = '{{url("")}}/'+value.url;
                        if (!value.mark_as_read) {
                            $('#notifications #notification-dropdown').append(
                                `<a class="dropdown-item notification-item pl-20" id="`+value.id+`" href="{{url('')}}/notification/mark_as_read/`+value.id+`">
                                    <div class="row">
                                        <div class="col-md-2 mx-0 px-0">
                                            <img class="img-avatar-sm" src="{{url('`+value.img+`')}}" alt="">
                                        </div>
                                        <div class="col-md-10 mx-0 px-0">
                                            <div class="font-w600 font-size-s text-black" style="white-space: normal;">`+value.description+`</div>
                                            <div class="font-w400 font-size-xs text-muted">`+value.create_date+`</div>
                                        </div>
                                    </div>
                                </a>`
                            );
                        }
                        else{
                            $('#notifications #notification-dropdown').append(
                                `<a class="dropdown-item notification-item pl-20" id="`+value.id+`" href="{{url('')}}/notification/mark_as_read/`+value.id+`">
                                    <div class="row">
                                        <div class="col-md-2 mx-0 px-0">
                                            <img class="img-avatar-sm" src="{{url('`+value.img+`')}}" alt="">
                                        </div>
                                        <div class="col-md-10 mx-0 px-0">
                                            <div class="font-w400 font-size-s" style="white-space: normal;">`+value.description+`</div>
                                            <div class="font-w400 font-size-xs text-muted">`+value.create_date+`</div>
                                        </div>
                                    </div>
                                </a>`
                            );
                        }
                    });
                    $('#notifications #notification-dropdown').append(
                        `<a class="dropdown-item notification-item text-center link-effect pl-20" id="all-notification" href="{{url('')}}/notification/all">
                            Lihat Semua
                        </a>`
                    );
                }
                else{
                    $('#notifications #notification-dropdown').append(
                        `<h5 class="font-w400 text-center">Belum ada entry</h5>`
                    );
                    $('#notification-counter').hide();
                }
                setTimeout(function () {
                    fetchNotification();
                }, 30000);
            },
            timeout: 5000
        });
    }
    var unread_count = -1;
    function countUnread() {
        $.ajax({
            url: "{{url('')}}/api/notification/count_unread",
            dataType: 'json',
            cache: false,
            type: 'GET',
            error: function(){
                countUnread();
            },
            success: function(result) {
                if (result) {
                    $('#notification-counter').show();
                    $('#notification-counter').text(result);
                    $('#notification-counter-sm').show();
                    $('#notification-counter-sm').text(result);
                    if (unread_count < result) {
                        if (unread_count != -1) {
                            document.getElementById('notification-audio').play();
                        }
                        unread_count = result;
                    }
                }
                else{
                    $('#notification-counter').hide();
                    $('#notification-counter-sm').hide();
                    unread_count = result;
                }
                setTimeout(function () {
                    countUnread();
                }, 30000);
            },
            timeout: 5000
        });
    }

    $(document).ready(function(){
        fetchNotification();
        countUnread();
    });
</script>
<script type="text/javascript">
    $('.notification-dropdown').click(function() {
        $.ajax({
            url: "{{url('')}}/api/notification/update_displayed",
            dataType: 'json',
            cache: false,
            type: 'GET'
        });
    });
</script>
@endif
<script type="text/javascript">
    var timer = null;
    $('#navbarSearch').keyup(function() {
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(function() {
            searchNavbar();
        }, 500);
    });

    $('.komplain').on('click', function(){
        $.ajax({
                type:'GET',
                url : API_URL+'/it/getLokasi',
                beforeSend:function() {
                    $('#komplain_loading').removeClass('d-none');
                    $('#komplain-content').addClass('d-none');
                },
                success:function(data){
                    data.forEach(function(item, index) {
                        $('#komplain_lokasi').append('<option value="'+item.nama+'">'+item.nama+'</option');
                    });

                    $('#komplain_lokasi').select2({
                        dropdownParent: $("#modal-komplain-it"),
                        placeholder: "Cari Lokasi"
                    });

                    $('#komplain_loading').addClass('d-none');
                    $('#komplain-content').removeClass('d-none');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest, textStatus, errorThrown);
                },
            });

        $('#modal-komplain-it').modal('show');
    });

    function searchNavbar()
    {
        keyword = $('#navbarSearch').val();
        if (keyword.length < 3) {
            $('#search-dropdown').empty();
            $('#search-dropdown').append(
                `<h5 class="font-w400 font-size-xs text-muted my-0 py-0">Masukkan minimal 3 karakter</h5>`
            );
        }
        else{
            $.ajax({
                url: API_URL + '/search?keyword='+ keyword,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (!$.trim(data['users'])) {
                        $('#search-dropdown').empty();
                        $('#search-dropdown').append(`
                            <div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px">
                                <h6 class="text-uppercase text-muted my-0 py-0">User</h5>
                            </div>
                        `);
                        content = '<div class="block border mb-0"><div class="block-content py-20">'
                        content+= '<div class="text-center mt-10 "><div class="font-w600 mb-5">User tidak dapat ditemukan</div></div>'
                        content+= '</div></div>'
                        $('#search-dropdown').append(content);
                    }
                    else {
                        $('#search-dropdown').empty()
                        $('#search-dropdown').append(`
                            <div class="col-md-12" style="padding-top:10px; padding-bottom: 10px">
                                <h6 class="text-uppercase text-muted my-0 py-0">User</h5>
                            </div>
                        `);
                        var img;
                        $.each(data['users'], function(key, value) {
                            $('#search-dropdown').append(`
                                <a class="dropdown-item pl-20" id="`+value.id+`" href="{{url("profil")}}/`+value.id+`" style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img class="img-avatar-sm" src="{{asset('`+value.avatar_thumb+`')}}" alt="">
                                        </div>
                                        <div class="col-md-10 mx-0 px-0">
                                            <div class="font-w400 font-size-s" style="white-space: normal;">`+value.name+`</div>
                                            <div class="font-w400 font-size-xs text-muted">`+value.profesi_detail.title+`</div>
                                        </div>
                                    </div>
                                </a>
                            `);
                        });
                    }
                    if (!$.trim(data['groups'])) {
                        $('#search-dropdown').append(`
                            <div style="padding-top: 20px">
                            <hr>
                            <div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px">
                                <h6 class="text-uppercase text-muted my-0 py-0">Grup</h5>
                            </div>
                        `);
                        content = '<div class="block border mb-0"><div class="block-content py-20">'
                        content+= '<div class="text-center mt-10 "><div class="font-w600 mb-5">Grup tidak dapat ditemukan</div></div>'
                        content+='</div></div>'
                        $('#search-dropdown').append(content);
                    }
                    else {
                        $('#search-dropdown').append(`
                            <div style="padding-top: 20px">
                            <hr>
                            <div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px">
                                <h6 class="text-uppercase text-muted my-0 py-0">Grup</h5>
                            </div>
                        `);
                        $.each(data['groups'], function(key, value) {
                            $('#search-dropdown').append(`
                                <a class="dropdown-item pl-20" id="`+value.id+`" href="{{url('group/`+value.slug+`/members')}}" style="padding: 10px;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img class="img-avatar-sm" src="{{asset('`+value.photo_thumb+`')}}" alt="">
                                        </div>
                                        <div class="col-md-10 mx-0 px-0">
                                            <div class="font-w400 font-size-s" style="white-space: normal;">`+value.name+`</div>
                                        </div>
                                    </div>
                                </a>
                            `);
                        });
                    }
                },
            });

        }

    }

    function popupwindow(url,windowName,height,width) {
        window.open(url, '_blank', 'location=yes,height='+height+',width='+width+',scrollbars=yes,status=yes');
    }
    $(document).ready(function(){
       $("form").submit(function() {
            $(this).find(".btn-click-animate i").hide();
            $(this).find(".btn-click-animate").prepend('<i class="fa fa-spinner fa-spin mr-2"></i>');

            $(this).submit(function() {
                return false;
            });
            return true;
    });
    $('.form-unbind').unbind();
   });


    function disableClick(el){
        $(el).find("i").remove();
        $(el).prepend('<i class="fa fa-spinner fa-spin"></i>');
        $(el).attr("disabled", true);
    }
    function enableClick(el){
        $(el).find("i").remove();
        $(el).prepend('<i class="fa fa-check"></i>');
        $(el).attr("disabled", false);
    }

    function lihatDaftarTarif(){

        var daftar_tarif_url = BASE_URL + "tarif";
        popupwindow(daftar_tarif_url, "Daftar Tarif", 500, 900);
    }

    $(".js-datepicker-month").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months",
        autoclose: true
    });

    function formatNumberWithDots(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function downloadFile(url, filename) {
        // Create a hidden link element
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;

        // Append the link to the document
        document.body.appendChild(link);

        // Simulate a click on the link to trigger the download
        link.click();

        // Remove the link from the document
        document.body.removeChild(link);
    }
</script>

{{-- @include('layouts.components2.js.idle-logout') --}}
@include('layouts.components2.init')

@yield('js')

@yield('angular')

@stack('js')