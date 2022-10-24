// let currentType = 0;
const Image = ["jpg", "png", "jpeg", "bmp", "svg"];
const Video = ["mp4", "webm", "3gp"];

const linkInp = $("#linkPenunjang");
const avatarInp = $("#avatar");
var submitBtn = document.getElementById('buatPenunjangSubmit');

function changeFileType(el){
	let newType = el.value;

	$(".input-penunjang").css('display', 'none');

	switch(newType) {
		case "media":
            avatarInp.prop('disabled', false);
            avatarInp.prop('required', 'required');
            linkInp.prop('disabled', true);
            linkInp.removeAttr('required');
			$("#penunjangGambar").css('display', '');
			break;
		case "link":
            avatarInp.prop('disabled', true);
            avatarInp.removeAttr('required');
            linkInp.prop('required', 'required');
            linkInp.prop('disabled', false);
			$("#penunjangLink").css('display', '');
			break; 
	}
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('videoPreview').style.display = "none";    
            document.getElementById('imagePreview').style.display = "";
            $('#uploadPenunjang #imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#uploadPenunjang #imagePreview').hide();
            $('#uploadPenunjang #imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


function previewVideo(input) {
    let source = $("#videoSource");
    let videoInput = $("#avatar")[0];
    source[0].src = URL.createObjectURL(videoInput.files[0]);
    source.parent()[0].load();
    document.getElementById('imagePreview').style.display = "none";    
    document.getElementById('videoPreview').style.display = "";
}

function getExtension(filePath) {
    return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[1];
}

$("#uploadPenunjang #avatar").change(function() {

    let extension = getExtension(this.value);
    console.log(extension);

    if(Image.includes(extension) > 0)
        readURL(this);
    else if(Video.includes(extension) > 0)
        previewVideo(this);
    else
        $("#errorEmptyGambar").css('display', 'block');
});

$(document).on('click', '#buatPenunjangSubmit', function(){
    disableClick(this);
    if ($('#uploadPenunjang #avatar').get(0).files.length === 0) {
        swal('Gagal!', 'Pilih File Penunjang yang akan diunggah', 'error');
        enableClick(this);
        return;
    }
    $('#uploadForm').submit();
});