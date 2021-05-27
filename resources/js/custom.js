$(document).ready(function() {

    // Add token to ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Logout
    $('a[href="logout"]').on('click', function(e) {
        e.preventDefault();
        $('form.logout_form').submit();
    });


    // advanced search menu
    var cat_id ="all";
    var cat_alias;

    $('.category_hover_menu .category-item').on('click', function() {

        $('.category_hover_menu').fadeOut();
        setTimeout(function() {
            $('.category_hover_menu').fadeIn();
        }, 1000);

        var cat_selected = $(this).data('cat');
        if(cat_selected == 'all') {
            cat_id = "all";
        } else {
            cat_id = cat_selected;
            cat_alias = $(this).data('alias');
        }
        var text_selected = $(this).text();
        if(text_selected.length > 13) {
            text_selected = text_selected.slice(0,13) + '...';
        }
        $('.hero__search__categories .cat_value').text( text_selected );
        $('.advanced-search input').val('');
    });

    //live search
    $.typeahead({
      input: '#search_input',
      minLength: 2,
      order: "desc",
      maxItem: 6,
      dynamic: true,
      delay: 500,
      template: function (query, item) {

          return '<span class="row">' +
                   '<span class=""><img style="width: 40px; padding-right: 10px;" src="' + homedir + '/img/products/' + item.images[0].img + '">{{title}}</span>' +
                  '</span>'
      },
      emptyTemplate: 'По запросу "{{query}}" ничего не найдено',
      source: {
          products: {
              display: 'title',
              href: homedir + "/products/{{alias}}",
              ajax: function (query) {
                  return {
                      type: "GET",
                      url: homedir + "/search",
                      path: "products",
                      data: {
                          query: "{{query}}",
                          cat_id: cat_id,
                          cat_alias: cat_alias
                      },
                      callback: {
                          done: function (data) {
                              console.log(data)
                          }
                      }
                  }
              }
          }
      },
      callback: {
          onClick: function (node, a, item, event) {
              //alert(JSON.stringify(item));
          },
          onSendRequest: function (node, query) {
              console.log('request is sent')
          },
          onReceiveRequest: function (node, query) {
              console.log('request is received')
          }
      },
      debug: true
  });

  // search
  $('.advanced-search button[type="submit"]').on('click',function(e) {
    e.preventDefault();
    var query = $('input#search_input').val();
    if(cat_id == 'all') {
        window.location = homedir + '/products?filter[title]=' + query;
    } else {
        window.location = homedir + '/products?filter[title]=' + query + '&filter[category.alias]=' + cat_alias;
    }

    $('input[name="query"]').val(query);
    $('input[name="cat"]').val(cat_alias);
});


  // Subscribe
 $('#newsletter_form').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
      // handle the invalid form...
    } else {
      // everything looks good!
      e.preventDefault()
      var email = $('input[type="email"]').val()
      console.log(email)
      $.ajax({
        url: homedir + '/subscribe',
        data: {email: email},
        type: 'POST',
        success: function(res) {
            console.log(res);
            if(res == 'subscribed') {
                $('#newsletter_form .success').html('Подписка оформлена')
            } else if(res == 'unsubscribed') {
                $('#newsletter_form .success').html('Подписка отменена')

            } else if(res == 'resubscribed') {
                $('#newsletter_form .success').html('Подписка возобновлена')
            }
        },
        error: function() {
            alert('Ошибка! Попробуйте позже!');
        },
    });
    }
  });

  var best_product_slider = $('.best_product_slider_custom');
      if (best_product_slider.length) {
        best_product_slider.owlCarousel({
          items: 4,
          loop: true,
          dots: false,
          autoplay: true,
          autoplayHoverPause: true,
          autoplayTimeout: 5000,
          navigation: false,
          responsive: {
            0: {
              margin: 15,
              items: 1,
              nav: false
            },
            576: {
              margin: 15,
              items: 2,
              nav: false
            },
            768: {
              margin: 30,
              items: 3,
              nav: true
            },
            991: {
              margin: 30,
              items: 4,
              nav: true
            }
          }
        });
    }

    // CART
    // Cart add
    $('body').on('click', '.add-tocart-link', function(e) {
        e.preventDefault();
        var id = $(this).data('id'),
        qty = Number($('.pro-qty input').val() ? $('.pro-qty input').val() : 1),
        select = $('#niceSelect.option_select').find('option').filter(':selected'),
        option = select.data('option') ? select.data('option') : '',
        url = $(this).attr("href");
        console.log(id, qty, option, url);

        if(qty == '0') {
            $('div.cart-error').text('Пожалуйста, укажите количество больше 0');
            hideTooltip()
        }
        else {
            $('div.cart-error').text('');
            $.ajax ({
                url: url,
                data: {"_token": $('meta[name="csrf-token"]').attr('content'), id: id, qty: qty, option: option},
                type: 'POST',
                success: function(res) {
                  console.log(res);
                  // fill cart
                  fillCart(res);
                  // change count products in header shopping cart
                  showCartQty(res);
                  // show success modal
                  $('#message_modal').modal('show');
                  $('#message_modal .modal-body').html('<div class="d-flex flex-column justify-content-center align-items-center"><i class="fa fa-shopping-cart message_icon"></i><p>Товар добавлен в корзину</p></div>')
                  setTimeout( function() {
                  $('#message_modal').modal('hide');
                  }, 1500);
                },
                error: function() {
                    alert('Ошибка! Попробуйте, пожалуйста, позже.');
                }
              });
        }
    });

    function fillCart(res) {
        $('.cart-hover').html(res);
    }


    function showCartQty(res) {
        // change count products in header shopping cart
        if(res.trim() == '<p class="text-center">Корзина пуста</p>') {
            $('li.cart-icon a.cart-icon-qty').html('<i class="fa fa-shopping-bag"></i>');
            $('.header__cart__price').html('');
        } else {
            total_quantity = $('.cart-hover input[name="total_qty"]').val()
            total_products = $('.cart-hover input[name="total_products"]').val()
            total_sum = $('.cart-hover .select-total h5').text()
            console.log(total_quantity, total_sum)
            if(total_quantity != null) {
                $('li.cart-icon a.cart-icon-qty').html('<i class="fa fa-shopping-bag"></i><span>'+total_quantity+'</span>')
            }
            if(total_sum != null) {
                $('.header__cart__price').html(total_products)
            }
        }
    }

 // delete product from cart
  // modal
  $('.cart-hover').on('click', '.fa-close', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $(this).fadeOut("slow");
    deleteCart(id);
  });
// cart page
$('.js-cart-table .icon_close').on('click', function() {
    $(this).parents('tr').fadeOut();
    var id = $(this).data('id');
    deleteCart(id);
});

function cartReload() {
    if(window.location.href.indexOf("cart") > -1) {
        $(".loader").fadeIn('slow');
        $("#preloder").fadeIn("slow");
        location.reload();
    }
}

function deleteCart(id) {
    $.ajax({
        url: homedir + '/cart/delete/' + id,
        data: {id},
        type: 'DELETE',
        success: function(res) {
            fillCart(res);
            showCartQty(res);
            cartReload();
        },
        error: function() {
            alert('Ошибка! Попробуйте позже!');
        },
    });
}


    $('.cart-hover').on('click', '#clearCart', function (e) {
    e.preventDefault();
    $.ajax({
        url: homedir + '/cart/clear',
        type: 'GET',
        success: function(res) {
            fillCart(res);
            showCartQty(res);
            cartReload();
        },
        error: function() {
            alert('Ошибка! Попробуйте позже!');
        },
    });
    });

// recalculate products number
$('#recalculate').on('click', function(e) {
    e.preventDefault();
    var products = $('.pro-qty input');
    //console.log(products);
    $(".loader").fadeIn('slow');
    $("#preloder").fadeIn("slow");
    var products_array = new Array();
    products.each(function(){
        var qty = parseInt($(this).val());
        var id = $(this).data('id');
        var obj = { id: id, qty: qty };
        products_array.push(obj);
     });
    //console.log(products_array);
    $.ajax({
        url: homedir + '/cart/recalculate',
        type: 'POST',
        data: {products_array: products_array},
        success: function(res) {
            console.log(res);
            document.location.reload(true);
        },
        error: function(res) {
            alert('Ошибка! Попробуйте позже!');
        },
      });
});
// CART END

// WISHLIST
  // Add to wishlist
  $('body').on('click', '.add-towish-link', function(e) {
    e.preventDefault();

    var id = $(this).data('id'),
    qty = Number($('.pro-qty input').val() ? $('.pro-qty input').val() : 1),
    select = $('#niceSelect.option_select').find('option').filter(':selected'),
    option = select.data('option') ? select.data('option') : '',
    url = $(this).attr("href");
    console.log(id, qty, option, url);

    if(qty == '0') {
        $('div.cart-error').text('Пожалуйста, укажите количество больше 0');
        hideTooltip()
    }
    else {
        $('div.cart-error').text('');
        $.ajax ({
            url: url,
            data: {"_token": $('meta[name="csrf-token"]').attr('content'), id: id, qty: qty, option: option},
            type: 'POST',
            success: function(res) {
                console.log(res);
                // fill wishlist
                fillWishList(res);
                // change count products in header wishlist
                showWishQty(res);
                 // show success modal
                 $('#message_modal').modal('show');
                 $('#message_modal .modal-body').html('<div class="d-flex flex-column justify-content-center align-items-center"><i class="fa fa-heart message_icon"></i><p>Товар добавлен в список пожеланий</p></div>')
                 setTimeout( function() {
                 $('#message_modal').modal('hide');
                 }, 1500);
            },
            error: function() {
                alert('Ошибка! Попробуйте, пожалуйста, позже.');
            }
          });
        }

  });

function hideTooltip() {
    setTimeout(function() {
        $('div.cart-error').text('');
    }, 2000);
}

function fillWishList(res) {
    $('.wishlist-hover').html(res);
}

function showWishQty(res) {
    // change count products in header wishlist
    if(res.trim() == '<p class="text-center">Список пожеланий пуст</p>') {
        $('li.wishlist-icon a.wishlist-icon-qty').html('<i class="fa fa-heart"></i>');
    } else {
        total_quantity = $('.wishlist-hover input[name="total_qty"]').val();
        //console.log(total_quantity);
        if(total_quantity != null) {
            $('li.wishlist-icon a.wishlist-icon-qty').html('<i class="fa fa-heart"></i><span>'+total_quantity+'</span>')
        }
    }
}


  // delete product from wishlist
  // modal
  $('.wishlist-hover').on('click', '.fa-close', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $(this).fadeOut("slow");
    deleteWishList(id);
  });
// wishlist page
$('.js-wish-table .icon_close').on('click', function() {
    $(this).parents('tr').fadeOut();
    var id = $(this).data('id');
    deleteWishList(id);
});

function wishlistReload() {
    if(window.location.href.indexOf("wishlist") > -1) {
        $(".loader").fadeIn('slow');
        $("#preloder").fadeIn("slow");
        location.reload();
    }
}


function deleteWishList(id) {
    $.ajax({
        url: homedir + '/wishlist/delete/' + id,
        data: {id},
        type: 'DELETE',
        success: function(res) {
            fillWishList(res);
            showWishQty(res);
            wishlistReload();
        },
        error: function() {
            alert('Ошибка! Попробуйте позже!');
        },
    });
}

// Add product to shopping cart
$('body').on('click', '.move-to-cart', function() {
    $(this).parents('tr').fadeOut("slow");
    var product_id = $(this).data('productid'),
    id = $(this).data('id'),
    option = $(this).data('option'),
    wishToCart = true;
    $.ajax({
        url: homedir + '/cart/add/' + product_id,
        data: {id: product_id, option: option, wishToCart: wishToCart},
        type: 'POST',
        success: function(res) {
            // showWishList(res);
            if(res) {
                //console.log('added to cart', res)
                deleteWishList(id);
                fillCart(res);
                showCartQty(res);
                wishlistReload();
            }

        },
        error: function() {
            alert('Ошибка! Попробуйте позже!');
        },
    });
  });

  // clearwishlist
$('body').on('click', '#clearWishList', function (e) {
    e.preventDefault();
$.ajax({
  url: homedir + '/wishlist/clear',
  type: 'GET',
  success: function(res) {
    console.log(res)
    // delete content from modal wishlist
        fillWishList(res);
        showWishQty(res);
        wishlistReload();
  },
  error: function() {
      alert('Ошибка! Попробуйте позже!');
  },
});
});
  // WISHLIST END


  // checkout
    $('.checkout__input__checkbox input[name="shipping"]').on('click', function() {
        var checked = $(this).data('value');
        $('input[name="shipping_method"]').val(checked);
        console.log($('input[name="shipping_method"]').val())
    });

    $('.checkout__input__checkbox input[name="pay"]').on('click', function() {
        var checked = $(this).data('value');
        $('input[name="pay_method"]').val(checked);
        console.log($('input[name="pay_method"]').val())
    });



    $('button#checkout_finish').on('click', function(e) {
        e.preventDefault();
        var shippingmethod = $('input[name="shipping_method"]').val();
        var paymethod = $('input[name="pay_method"]').val();
        $('#methods_error').html('');
        if(paymethod == "") {
            $('#methods_error').append('Не указан способ оплаты<br>');
            $('#methods_error').removeClass('d-none');
        }
        if(shippingmethod == "") {
          $('#methods_error').append('Не указан способ доставки<br>');
          $('#methods_error').removeClass('d-none');
      }
        else if (paymethod != "" && shippingmethod != "") {
            $('#checkout_form').submit();
        }
    });


});
