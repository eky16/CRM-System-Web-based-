<script src="<?= base_url('sb-admin') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('sb-admin') ?>/js/sb-admin-2.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />




<script type="text/javascript">
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>

<!-- tinyMCE -->

<script src="<?= base_url('sb-admin') ?>/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
  tinymce.init({
    selector: '.textEditor',
    plugins: 'link lists image advlist fullscreen media code table emoticons textcolor codesample hr preview',
    menubar: false,
    toolbar: [
      'undo redo | bold italic underline strikethrough forecolor backcolor bullist numlist | blockquote subscript superscript | alignleft aligncenter alignright alignjustify | image media link',
      ' formatselect | cut copy paste selectall | table emoticons hr | removeformat | preview code | fullscreen',
    ],
  });
</script>

<!-- DatePicker -->



  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
       dateFormat: "yy-mm-dd"
    });
  } );
  </script>

  <script>
  $( function() {
    $( "#datepicker_2" ).datepicker({
       dateFormat: "yy-mm-dd"
    });
  } );
  </script>
  <script>
  $( function() {
    $( "#datepicker_3" ).datepicker({
       dateFormat: "yy-mm-dd"
    });
  } );
  </script>
    <script>
  $( function() {
    $( "#datepicker_4" ).datepicker({
       dateFormat: "yy-mm-dd"
    });
  } );
  </script>
  <script type="text/javascript">
function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});
</script>

<script type="text/javascript">
  
  function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}
</script>

<script>
function validation(thisform)
{
   with(thisform)
   {
      if(validateFileExtension(photo, "valid_msg", "image files are only allowed!",
      new Array("jpg","jpeg","png")) == false)
      {
         return false;
      }
      if(validateFileSize(photo,1048576, "valid_msg", "Document size should be less than 1MB !")==false)
      {
         return false;
      }
   }
}
</script>

<script>
      $(document).ready(function() {
          $('#btn-file-reset-id').on('click', function() {
              $('#fileId').val('');
            });
        });
      $(document).ready(function() {
          $('#btn-text-reset-id').on('click', function() {
              $('#textId').val('');
            });
        });
    </script>
<script>
      $(document).ready(function() {
          $('#btn-file-reset-id1').on('click', function() {
              $('#fileId1').val('');
            });
        });
      $(document).ready(function() {
          $('#btn-text-reset-id1').on('click', function() {
              $('#textId').val('');
            });
        });
    </script>
    <script>
      $(document).ready(function() {
          $('#btn-file-reset-id2').on('click', function() {
              $('#fileId2').val('');
            });
        });
      $(document).ready(function() {
          $('#btn-text-reset-id2').on('click', function() {
              $('#textId').val('');
            });
        });
    </script>
    <script>
      $(document).ready(function() {
          $('#btn-file-reset-id3').on('click', function() {
              $('#fileId3').val('');
            });
        });
      $(document).ready(function() {
          $('#btn-text-reset-id3').on('click', function() {
              $('#textId').val('');
            });
        });
    </script>
        <script>
      $(document).ready(function() {
          $('#btn-file-reset-id4').on('click', function() {
              $('#fileId4').val('');
            });
        });
      $(document).ready(function() {
          $('#btn-text-reset-id4').on('click', function() {
              $('#textId').val('');
            });
        });
    </script>
        <script>
      $(document).ready(function() {
          $('#btn-file-reset-id5').on('click', function() {
              $('#fileId5').val('');
            });
        });
      $(document).ready(function() {
          $('#btn-text-reset-id5').on('click', function() {
              $('#textId').val('');
            });
        });
    </script>
        <script>
      $(document).ready(function() {
          $('#btn-file-reset-id6').on('click', function() {
              $('#fileId6').val('');
            });
        });
      $(document).ready(function() {
          $('#btn-text-reset-id6').on('click', function() {
              $('#textId').val('');
            });
        });
    </script>
<script src="<?php echo base_url(); ?>sb-admin/js/sweetalert.min.js"></script>

