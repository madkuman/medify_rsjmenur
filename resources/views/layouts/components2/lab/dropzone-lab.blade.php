<script type="text/javascript">
        Dropzone.autoDiscover = false;
        var submitBtn = $("#submit-all");
        var deleteQueue = 0;
        var myTemplate = `<div class="dz-preview dz-file-preview" style="width: 200px;height: 250px; margin-bottom: 20px;">
        <div class="dz-image" style="margin-left: auto; margin-right: auto; width: 50%"><img data-dz-thumbnail /></div>
        <div class="dz-details">
        <div class="dz-size"><span data-dz-size></span></div>
        </div>
        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
        <div class="form-group fileDetails" style="margin-bottom: 0px;"><input type="text" placeholder="Judul" name="judul" class="form-control judul-input" style="margin-bottom: 5px;">
        <textarea placeholder="Keterangan" name="caption" class="form-control caption-input" ></textarea></div>
        </div>`; 
        $(function() {
            // Now that the DOM is fully loaded, create the dropzone, and setup the
            // event listeners
            var myDropzone = new Dropzone("#my-dropzone", {
                previewTemplate: myTemplate,
                addRemoveLinks: true,
                maxFilesize: 1000,
                removedfile: function(file) {
                    deleteQueue++;
                    disableSubmit();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{url($link."/delete/gambar")}}',
                        data: {
                            id: file.serverId,
                            CSRF: "{{csrf_token()}}",
                        },
                        dataType: 'JSON',
                        success: function(){
                            deleteQueue--;
                            console.log("Removing "+deleteQueue)
                            if(deleteQueue == 0){
                                enableSubmit();
                            }
                        }
                    });
                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                }
            });
            myDropzone.on("success", function(file, response) {
              file.serverId = response;
            });
            myDropzone.on("sending", function(file, xhr, formData){
                let count = $("#fileNumber").val();
                formData.append('fileNumber', count);
                $('#fileNumber').val(++count);
            })
            myDropzone.on("addedfile", (file) => {
                disableSubmit();
            });
            myDropzone.on("complete", function (file) {
                console.log("complete "+deleteQueue)
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0 && deleteQueue == 0) {
                    enableSubmit();
                }
            });
            myDropzone.on("error", function (file, error, xhr) {
                file.previewElement.innerHTML = `
        <div class="dz-preview dz-processing dz-image-preview dz-error dz-complete" style="width: 200px;height: 250px; margin-bottom: 20px;">
            <div class="dz-image" style="margin-left: auto; margin-right: auto; width: 50%"><img data-dz-thumbnail="" alt="nayeon-twice-summer-nights-v343.jpg" src="{{url('assets/img/cancel.png')}}" style="width:100%"></div>
            <div class="dz-details">
                <div class="dz-size"><span data-dz-size=""><strong>2.8</strong> MB</span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
            <div class="alert alert-danger alert-dismissable" role="alert">
                <h3 class="alert-heading font-size-h6 font-w400 mb-0">Error</h3>
                <p class="mb-0" style="word-wrap: break-word;">${error.message}</p>
            </div>
        </div>`;
                console.log(file.previewElement);

            })
        })

        function disableSubmit(){
            submitBtn.removeClass('btn-alt-primary').addClass('btn-warning');
            submitBtn.html(`<i class="fa fa-2x fa-cog fa-spin text-success"></i> Memproses File...`);
            submitBtn.attr("disabled", "disabled");
        }
        function enableSubmit(){
            submitBtn.removeAttr("disabled");
            submitBtn.removeClass('btn-warning').addClass('btn-alt-primary')
            submitBtn.html(`Simpan Pemeriksaan`);
        }
</script>