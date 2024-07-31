{{-- canvasTtd --}}
<script type="text/javascript">
    var canvasTtd, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        pos = {};

    var lineColor = "black",
        lineWidth = 2;

    function initCanvasTtd() {
        canvasTtd = document.getElementById('canvasTtd');
        canvasTtd.style.touchAction = "none";
        ctx = canvasTtd.getContext("2d");
        w = canvasTtd.width;
        h = canvasTtd.height;

        canvasTtd.addEventListener("pointermove", function (e) {
            e.preventDefault();
            findXY('move', e)
        }, false);
        canvasTtd.addEventListener("pointerdown", function (e) {
            e.preventDefault();
            findXY('down', e)
        }, false);
        canvasTtd.addEventListener("pointerup", function (e) {
            e.preventDefault();
            findXY('up', e)
        }, false);
    }

    // draw line
    function draw() {
        ctx.beginPath();
        ctx.strokeStyle = lineColor;
        ctx.lineWidth = lineWidth;
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.closePath();
        ctx.stroke();
    }

    // clear canvas
    function clearCanvasTtd() {
        // Use the identity matrix while clearing the canvas
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.clearRect(0, 0, w, h);
    }

    function saveImgTtd() {
        var dataURL = canvasTtd.toDataURL();
        return dataURL;
    }

    function getMousePos(canvasTtd, evt) {
        var rect = canvasTtd.getBoundingClientRect();
        return {
            x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvasTtd.width,
            y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvasTtd.height
        };
    }

    function findXY(res, e) {
        pos = getMousePos(canvasTtd, e);
        prevX = currX;
        prevY = currY;
        currX = pos.x;
        currY = pos.y;
        
        if (res == 'down') {
            flag = true;
        }
        if (res == 'up') {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                draw();
            }
        }
    }

    $(document).ready(function() {
        initCanvasTtd();
        $(".clearCanvasTtd").click(function(e){
            clearCanvasTtd();
        });
    });	

    var url = '';
    $(".btn-add-ttd").click(function(e){
        clearCanvasTtd();
        ttd_id = $(this).attr('data-id');
        pasien_id = $(this).attr('data-pasien_id');
        url = $(this).attr('data-url');

        $("#addTtd").modal("toggle");
    });

    // submitTtd
	$('#btnSubmitTtd').on( 'click', function() {       
		var imgUrl = saveImgTtd();
		var ttd_nama = $("#ttd_nama").val();

		$(this).prop('disabled', true);
		$(this).css({ cursor: "not-allowed" });
		$('#btnSubmitTtd .simpanTTD').hide();
		$('#btnSubmitTtd .loadingSimpanTTD').show();

		var formDataTtd = new FormData();
		formDataTtd.append('id', ttd_id);
		formDataTtd.append('imgBase64', imgUrl);
		formDataTtd.append('ttd_nama', ttd_nama);
		formDataTtd.append('pasien_id', pasien_id);

		$.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: formDataTtd,
			cache: false,
			contentType: false,
			processData: false,
			async: true,

			success: function(response) {
				callSwal(response.type,response.title,response.text,response.url);
                $('#btnSubmitTtd .simpanTTD').show();
				$('#btnSubmitTtd .loadingSimpanTTD').hide();
    			clearCanvas();
			},
			error: function(error) {
				// console.log(error, 2)
				callSwal('error', 'TTD Gagal', 'Silahkan Coba Lagi', 0);
				$('#btnSubmitTtd').prop('disabled', false);
				$('#btnSubmitTtd').css({ cursor: "pointer" });
				$('#btnSubmitTtd .simpanTTD').show();
				$('#btnSubmitTtd .loadingSimpanTTD').hide();
			}
		});
	})
</script>