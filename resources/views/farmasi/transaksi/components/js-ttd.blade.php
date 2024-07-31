<script type="text/javascript">
	// CANVAS FOR TTD FIELD
    $(".ttdBtn").click(function(e){
        id = $(this).data("id");
        $('#transaksi_obat_id').val(id);
    });

	var canvas, ctx, flag = false,
		prevX = 0,
		currX = 0,
		prevY = 0,
		currY = 0,
		pos = {};

	var lineColor = "black",
		lineWidth = 2;

	function initCanvas() {
		canvas = document.getElementById('canvas');
		canvas.style.touchAction = "none";
		ctx = canvas.getContext("2d");
		w = canvas.width;
		h = canvas.height;

		canvas.addEventListener("pointermove", function (e) {
			e.preventDefault();
			findXY('move', e)
		}, false);
		canvas.addEventListener("pointerdown", function (e) {
			e.preventDefault();
			findXY('down', e)
		}, false);
		canvas.addEventListener("pointerup", function (e) {
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
	function clearCanvas() {
		// Use the identity matrix while clearing the canvas
    	ctx.setTransform(1, 0, 0, 1, 0, 0);
		ctx.clearRect(0, 0, w, h);
	}

	function saveImg() {
		var dataURL = canvas.toDataURL();
		return dataURL;
	}

	function getMousePos(canvas, evt) {
		var rect = canvas.getBoundingClientRect();
		return {
			x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas.width,
			y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height
		};
	}

	function findXY(res, e) {
		pos = getMousePos(canvas, e);
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
        initCanvas();
        $(".clearCanvas").click(function(e){
			clearCanvas();
		});
    });	

	// SUBMIT TTD FORM
	function ajaxSubmit(){
		var id = $('#transaksi_obat_id').val();
    	var nama = $('#nama-pasien').val();
    	var imgUrl = saveImg();

    	$('#buttonSubmit').hide();
        $('#buttonLoading').show();

    	var formData = new FormData();
    	formData.append('id', id);
    	formData.append('nama', nama);
    	formData.append('imgBase64', imgUrl);

    	$.ajax({
            type: "POST",
            url: "{{url()->current()}}/add-ttd-pasien",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                callSwal(data.type,data.title,data.text,data.url);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
    			clearCanvas();

            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });
	}
</script>