jQuery(document).ready(function($) {

    // Add token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Active menu item
    var url = window.location;
    // for sidebar menu but not for treeview submenu
    $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().siblings().removeClass('active').end().addClass('active');
    // for treeview which is like a submenu
    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');

    // Delete item
    $('.delete').click(function(e) {
        e.preventDefault();
        var link = $(this).parents('form').attr("action");
        var element = $(this).attr("element");
        console.log(link);
        $('#deleted_element').text(element);
        $('#delete_form').attr('action', link);
        $('#my-modal-danger').modal();
    });

    //Change order_status
    $('#change_orderstatus_link').click(function(e) {
        e.preventDefault();
        $.ajax ({
            url: homedir + '/admin/order_statuses',
            type: 'GET',
            success: function(res) {
                console.log(res);
                $('#statuses_select').html(res);
            },
            error: function() {
                alert('Ошибка! Попробуйте, пожалуйста, позже.');
            }
        });
        $('#change_orderstatus_modal-info').modal();
    });

    //Change order pay_status
    $('#change_paystatus_link').click(function(e) {
        e.preventDefault();
        $('#change_paystatus_modal-info').modal();
    });

    //Change status
    $('input[name="status"].bootstrap-toggle').on('change', function() {
        var element = $(this);
        element.bootstrapToggle('disable');
        var parent = $(this).parents('tr');
        var id = parent.data('id');
        var model = parent.data('model');
        console.log(id, model);
        $.ajax ({
            url: homedir + '/admin/changestatus/' + model + '/' + id,
            data: {id:id},
            type: 'POST',
            success: function(res) {
                element.bootstrapToggle('enable');
                console.log(res);
            },
            error: function() {
                alert('Ошибка! Попробуйте, пожалуйста, позже.');
            }
        });
    });

    //Change hit
    $('input[name="hit"].bootstrap-toggle').on('change', function() {
        var element = $(this);
        element.bootstrapToggle('disable');
        var parent = $(this).parents('tr');
        var id = parent.data('id');
        var model = parent.data('model');
        console.log(id, model);
        $.ajax ({
            url: homedir + '/admin/changehit/' + model + '/' + id,
            data: {id:id},
            type: 'POST',
            success: function(res) {
                element.bootstrapToggle('enable');
                console.log(res);
            },
            error: function() {
                alert('Ошибка! Попробуйте, пожалуйста, позже.');
            }
        });
    });

     //Change views
     $('input[name="viewed"].bootstrap-toggle').on('change', function() {
        var element = $(this);
        element.bootstrapToggle('disable');
        var parent = $(this).parents('tr');
        var id = parent.data('id');
        var model = parent.data('model');
        console.log(id, model);
        $.ajax ({
            url: homedir + '/admin/changeviewed/' + model + '/' + id,
            data: {id:id},
            type: 'POST',
            success: function(res) {
                element.bootstrapToggle('enable');
                console.log(res);
            },
            error: function() {
                alert('Ошибка! Попробуйте, пожалуйста, позже.');
            }
        });
    });


//icheck
$('input.delete-item-marker').iCheck({
    checkboxClass: 'icheckbox_flat-blue'
});

var item_ids = [];
// Add or remove id from checked items
$('input.delete-item-marker').on('ifChanged', function(event) {
    var element_id = $(this).parents('tr').data('id');
    if(event.target.checked) {
        item_ids.push(element_id);
    } else {
        var index = item_ids.indexOf(element_id);
        item_ids.splice(index, 1);
    }
    if(item_ids.length > 0) {
        $('#delete_all-button').removeClass('disabled');
    } else {
        $('#delete_all-button').addClass('disabled');
    }
});

//Check all
$('#delete-all-items').on('click', function() {
    $('input.delete-item-marker').iCheck('toggle');
});

    $('#delete_all-button').on('click', function(e) {
        e.preventDefault();
        console.log(item_ids);
        var model = $(this).data('model');
        var link = homedir + '/admin/' + model + '/' + item_ids;
        var element = item_ids;
        console.log(link);
        $('#deleted_element').text(element);
        $('#delete_form').attr('action', link);
        $('#my-modal-danger').modal();
    })

    // End Delete items checkbox

    //enable tooltip

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });

     // select2
     $('.select2-products').select2 ( {
        placeholder: "Начните вводить название товара...",
        minimumInputLength: 2,
        language: "ru",
        cache: true,
        ajax: {
            url: homedir + "/admin/related-product",
            delay: 250,
            method: 'get',
            dataType: 'json',
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.items
                };
            },
        },
     });

     $('.select2-tags').select2();

     //Product - specifications
     var number = 0,
         form = '',
         selector = '',
         template = '';
     $('#specifications_add').on('click', function() {
        number++;
        var id= "added_specification_" + number;

        template = $('.specifications_template');
        template.clone().appendTo( '#specifications' );
        template.attr("id", id);
        selector = '#' + id;
        form = $(selector);
        //console.log(form);
        form.find('.delete_specification').attr('data-id', id);
        form.css("display", "block" );
        form.removeClass('specifications_template');
        $('.added_specifications').parent().append(form[0]);
     });

     $('#specifications').on('click', '.delete_specification', function() {
        var data_id = '#' + $(this).data('id');
        $(data_id).remove();
     });

      // Delete all specifications
     $('#delete_allspecifications').on('click', function() {
        var added_elements = $('.delete_specification');
        added_elements.each( function() {
            var id = '#' + $(this).data('id');
            $(id).fadeOut().remove();
         });
    });

    // Product - modifications
    var mod_number = 0,
         mod_form = '',
         mod_selector = '',
         mod_template = '';
     $('#modifications_add').on('click', function() {
        mod_number++;
        var id = "added_modification_" + mod_number;

        mod_template = $('.modifications_template');
        mod_template.clone().appendTo( '#modifications' );
        mod_template.attr("id", id);
        mod_selector = '#' + id;
        mod_form = $(mod_selector);
        mod_form.find('.delete_modification').attr('data-id', id);
        mod_form.css("display", "block" );
        mod_form.removeClass('modifications_template');
        $('.added_modifications').parent().append(mod_form[0]);
     });

    // Delete modification
     $('#modifications').on('click', '.delete_modification', function() {
        var data_id = '#' + $(this).data('id');
        $(data_id).remove();
     });

    // Delete all modifications
     $('#delete_allmodifications').on('click', function() {
        var added_elements = $('.delete_modification');
        //console.log(added_elements);
        added_elements.each( function() {
            var id = '#' + $(this).data('id');
            $(id).fadeOut().remove();
         });
    });


    // Delete templates in submit action
    $('button[type="submit"]').on('click', function() {
        $('.specifications_template').remove();
        $('.modifications_template').remove();
    });

    //Datepicker
    $('#datepicker').datepicker({
        language: 'ru',
        format: 'dd/mm/yyyy',
        autoclose: true
});

});
