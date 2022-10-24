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
<script src="{{asset('assets/js/codebase.medify1.1.js')}}"></script>
<script src="{{asset('assets/js/fa5.10.0.11/all.min.js')}}"></script>


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
<script type="text/javascript">$.fn.poshytip={defaults:null};</script>
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