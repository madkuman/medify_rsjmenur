<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.scrollLock.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.appear.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery.countTo.min.js')}}"></script>
<script src="{{asset('assets/js/core/js.cookie.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/codebase.js')}}"></script>

<!-- Hakim Nambah -->
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#penunjangGallery").lightGallery({
            pager: true,
            zoom: true,
            actualSize: true,
            fullscreen: true,
            thumbnail:true,
            animateThumb: false,
            showThumbByDefault: false,
            selector:'.btn.selector'
        });
    })
</script>



<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-datepaginator.js')}}"></script>
<script type="text/javascript">$.fn.poshytip={defaults:null};</script>
<script src="{{asset('assets/js/jquery-editable-poshytip.min.js')}}"></script>
<script src="{{asset('assets/js/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/numeral.min.js')}}"></script>
<script src="{{asset('assets/js/underscore-min.js')}}"></script>
<script src="{{asset('assets/js/backbone-min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap-material-datetimepicker.js')}}"></script>



<script src="{{asset('assets/js/pages/be_tables_datatables.js')}}"></script>

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



@if(Session::get('success')!=null)
<script type="text/javascript">
    swal({
        type: 'success',
        text: "{!! Session::get('success') !!}",
        timer: 2000,
        showConfirmButton: false,
    });
</script>
@endif

@if(Session::get('danger')!=null)
<script type="text/javascript">
    swal({
        type: 'error',
        text: "{!! Session::get('danger') !!}",
        timer: 2000,
        showConfirmButton: false,
  });
</script>
@endif

<script type="text/javascript">
    var API_URL = "{{url('api')}}";
    var BASE_URL = "{{url('')}}";
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
    function goToHref(url)
    {
        window.location = url;
    }
</script>

<script type="text/javascript">
    function date_manusia(date) {
        var date_break = date.split("-");
        var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        return date_break[2]+' '+bulan[parseInt(date_break[1])-1]+' '+date_break[0];
    }

    function convert_rupiah(angka)
    {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
    }

    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<script type="text/javascript">
    function callSwal(type,title,text,url)
    {
        swal({
            type: type,
            title: title,
            text: text,
            timer:3000,
        }).then((result) => {
            if (result.dismiss != '') swalRedirect(url);
        })
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
    $('.js-select2').select2();
</script>

@yield('js')

@yield('angular')