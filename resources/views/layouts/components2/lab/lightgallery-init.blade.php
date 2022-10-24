<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-video.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // $("#lightgallery").lightGallery({
        //     appendSubHtmlTo: '.lg-item',
        //     addClass: 'fb-comments',
        //     mode: 'lg-fade',
        //     zoom: true,
        //     actualSize: true,
        //     fullscreen: true,
        //     selector:'.btn.selector'
        // });

        $("#lightgallery").lightGallery({
            pager: true,
            zoom: true,
            actualSize: true,
            fullscreen: true,
        });
    })
</script>