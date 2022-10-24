<script type="text/javascript">
    function readImage(input){
      if (input.files && input.files[0]) {
          var reader = new FileReader();
  
          reader.onload = function(e) {
              var preview = 
              '<center><img width="180" src="' + e.target.result + '" />'+
              '<p>' + input.files[0].name + '</p></center>';
              var previewZone = $(input).parent().parent().find('.preview-zone');
              var boxZone = $(input).parent().find('.preview-zone').find('.box').find('.box-body').find('.preview-img');
              previewZone.removeClass('d-none');
              boxZone.empty();
              boxZone.append(preview);
          }
  
          reader.readAsDataURL(input.files[0]);
      }
  }
  
  function resetImg(e) {
      e.wrap('<form>').closest('form').get(0).reset();
      e.unwrap();
  }
  
  $('.remove-preview').on('click', function() {
      var boxZone = $(this).parents('.preview-zone').find('.box-body');
      var previewZone = $(this).parents('.preview-zone');
      var changeImg = $(this).parents('.form-group').find('.change-img');
      boxZone.empty();
      previewZone.addClass('d-none');
      resetImg(changeImg);
  });
  
  $('.change-img').change(function() {
      readImage(this);
  });
  </script>