$(document).ready(function() {

    // Attach text editor
    $("#compose-textarea").wysihtml5();


    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });

     // Toggle activefolder
      var links =  document.querySelectorAll('.menu-link')
      //console.log(links[0].childNodes[0].href.split('=')[1])
       var link_component
       var last_component
       for (var i = 0; i < links.length; i++) {
           link_component = links[i].childNodes[0].href.split('=')[1]
           if ((document.URL).includes(link_component)) {
               links[i].classList.add('active')
           } else {
               links[i].classList.remove('active')
           }
       }

    // Detect active folder
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('filter[folder]');
    if(myParam) {
        if(myParam == 'inbox') $('h3.folder-title').text('Входящие')
        if(myParam == 'sent') $('h3.folder-title').text('Отправленные')
        if(myParam == 'draft') $('h3.folder-title').text('Черновики')
        if(myParam == 'trash') $('h3.folder-title').text('Корзина')
    }



 //search
    $('.glyphicon-search.form-control-feedback').on('click', function() {
        var subject = $('.form-control.input-sm').val()
        link = homedir + '/admin/mail/messages?filter[folder]=' + myParam + '&filter[subject]=' + subject
        //console.log('clicked on search', link)
        window.location.href =  link
    });

});
