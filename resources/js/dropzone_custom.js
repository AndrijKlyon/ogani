jQuery(document).ready(function($) {

    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    // DROPZONE_SINGLE
    var previewNode_single = document.querySelector("#template_single");
    if(previewNode_single) {
      previewNode_single.id = "";
      var previewTemplate_single = previewNode_single.parentNode.innerHTML;
      previewNode_single.parentNode.removeChild(previewNode_single);
    }
    var element = $("div.dropzone-box_single");
    if(element.length) {
      //console.log(previewTemplate_single)

          var Dropzone_single = new Dropzone("div.dropzone-box_single", {
            url: homedir + "/admin/image/upload",
            maxFilesize: 12,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            thumbnailWidth: 80,
            thumbnailHeight: 100,
            parallelUploads: 20,
            maxFiles: 1,
            previewTemplate: previewTemplate_single,
            autoQueue: false,
            previewsContainer: "#previews_single",
            clickable: ".fileinput-button_single",
          });

          Dropzone_single.on("addedfile", function(file) {

            console.log(this.options.maxFiles);
            if(i=this.options.maxFiles) {
              $('#actions_single').css('display', 'none');
            }
            file.previewElement.querySelector(".start_single").onclick = function() { Dropzone_single.enqueueFile(file); };

        });

          Dropzone_single.on('success', function(file, response) {
            console.log(response);
            $('input[name="img"]').val(file.name);
          })

          Dropzone_single.on('error', function(file, response) {
            return false;
          })

          Dropzone_single.on("removedfile", function(file) {
            $('#actions_single').css('display', 'block');
            var name = file.name;
            if(name) {
              $.ajax({
                  headers: {
                              'X-CSRF-TOKEN': CSRF_TOKEN,
                          },
                  type: 'POST',
                  url: homedir + '/admin/image/delete',
                  data: {filename: name},
                  success: function (data){
                      console.log("File has been successfully removed!!", file.name);
                  },
                  error: function(e) {
                      console.log(e);
                  }});
            }
        });

      Dropzone_single.on("sending", function(file, xhr, formData) {
        formData.append("_token", CSRF_TOKEN);
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1";
        // And disable the start button
        file.previewElement.querySelector(".start_single").setAttribute("disabled", "disabled");

      });

      // Hide the total progress bar when nothing's uploading anymore
      Dropzone_single.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0";
      });

      Dropzone_single.on("complete", function(file) {
        document.querySelector("#total-progress").style.opacity = "0";

        var elem = $('div.dz-image-preview.dz-complete');
        elem.each( function() {
          $(this).find('.previews-progress').css('opacity', '0');
          $(this).find('.previews-start').css('opacity', '0');
          $(this).find('.previews-cancel').css('opacity', '0');
        })
      });
  }

    // trigger - single image
    $('.image-single_delete').on('click', function() {
        $('#img_single').remove();
        $('#loading_button_single').css('display', 'block');
        $('input[name="img"]').val('');
    });


    // DROPZONE_MULTI

     var previewNode_multi = document.querySelector("#template_multi");
    if( previewNode_multi) {
      previewNode_multi.id = "";
      var previewTemplate_multi = previewNode_multi.parentNode.innerHTML;
      previewNode_multi.parentNode.removeChild(previewNode_multi);
    }
    var element = $("div.dropzone-box_multi");
    if(element.length) {
      //console.log(previewTemplate_multi)
      var images = '';
      var Dropzone_multi = new Dropzone("div.dropzone-box_multi", {
        url: homedir + "/admin/image/upload",
        maxFilesize: 12,
      //   maxFiles: 2,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        thumbnailWidth: 80,
        thumbnailHeight: 100,
        parallelUploads: 20,
        previewTemplate: previewTemplate_multi,
        autoQueue: false,
        previewsContainer: "#previews_multi",
        clickable: ".fileinput-button",
      });

      Dropzone_multi.on("addedfile", function(file) {

        file.previewElement.querySelector(".start_multi").onclick = function() { Dropzone_multi.enqueueFile(file); };
      });

      Dropzone_multi.on('success', function(file, response) {
        console.log(response);
        console.log($('div[name="new_images[]"]').html());
        images = images + '<input type="hidden" name="new_images[]" value="' + file.name + '"/>';
        $('div[name="new_images[]"]').html(images);
      })

      Dropzone_multi.on('error', function(file, response) {
        return false;
      })

      Dropzone_multi.on("removedfile", function(file) {
        $('#actions_multi').css('display', 'block');
        var name = file.name;
        if(name) {
          $.ajax({
              headers: {
                          'X-CSRF-TOKEN': CSRF_TOKEN,
                      },
              type: 'POST',
              url: homedir + '/admin/image/delete',
              data: {filename: name},
              success: function (data){
                  console.log("File has been successfully removed!!", file.name);
              },
              error: function(e) {
                  console.log(e);
              }});
        }
    });
      // Update the total progress bar
      Dropzone_multi.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress_multi .progress-bar").style.width = progress + "%";
      });

      var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
      Dropzone_multi.on("sending", function(file, xhr, formData) {
        // Add token
        formData.append("_token", CSRF_TOKEN);
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress_multi").style.opacity = "1";
        // And disable the start button
        file.previewElement.querySelector(".start_multi").setAttribute("disabled", "disabled");

      });

      Dropzone_multi.on("complete", function(file) {
        document.querySelector("#total-progress_multi").style.opacity = "0";
        $('div.dz-image-preview.dz-complete').each( function() {
          $(this).find('.previews-progress').css('opacity', '0');
          $(this).find('.previews-start').css('opacity', '0');
          $(this).find('.previews-cancel').css('opacity', '0');
        })
      });


      document.querySelector("#actions_multi .start_multi").onclick = function() {
        Dropzone_multi.enqueueFiles(Dropzone_multi.getFilesWithStatus(Dropzone.ADDED));
      };
      document.querySelector("#actions_multi .cancel_multi").onclick = function() {
        Dropzone_multi.removeAllFiles(true);
      };
    }


    //Delete exists product image
    $('.productimage_delete').on('click', function() {
        selector = '#' + $(this).data('row');
        $(selector).fadeOut().remove();
    });

});
