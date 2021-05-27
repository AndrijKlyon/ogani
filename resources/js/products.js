$(document).ready(function() {

// price slider re-init
var rangeSlider = $(".price-range-custom"),
minamount = $("#minamount"),
maxamount = $("#maxamount"),
minPrice = rangeSlider.data('min'),
maxPrice = rangeSlider.data('max'),
currSymbol = rangeSlider.data('currency');
rangeSlider.slider({
range: true,
step: 10,
min: minPrice,
max: maxPrice,
values: [minPrice, maxPrice],
slide: function (event, ui) {
    minamount.val(currSymbol + ui.values[0]);
    maxamount.val(currSymbol + ui.values[1]);
    }
});
minamount.val(currSymbol + rangeSlider.slider("values", 0));
maxamount.val(currSymbol + rangeSlider.slider("values", 1));

    // Rating
    var options = {
        max_value: 5,
        step_size: 1,
        initial_value: 0,
        selected_symbol_type: 'utf8_star', // Must be a key from symbols
        cursor: 'default',
        readonly: false,
        change_once: false, // Determines if the rating can only be set once
        ajax_method: 'POST',
        // url: 'http://localhost/test.php',
        additional_data: {} // Additional data to send to the server
    }
    $(".rating").rate(options);
    $(".rating").on("change", function(ev, data){
    //console.log(data.from, data.to);
    //console.log($(".rating").rate("getValue"));
    $('#rating').val($(".rating").rate("getValue"));
    });

    // change option
    $('body').on('change', 'select.option-select', function() {
        let modId=$(this).val(),
        option = $(this).find('option').filter(':selected').data('option'),
        price = $(this).find('option').filter(':selected').data('price');
        img = $(this).find('option').filter(':selected').data('img');
        startOption = $('#optionImg').data('startimage');
        startPrice = $('#optionImg').data('startprice');
        console.log(modId, option, price, img, startOption);
        if(price) {
            // $( "#optionImg" ).html( $( '<img src=' + homedir + '/img/options/' + img + '>' ) ).fadeIn('slow');
            $('#current_price').html(price).fadeIn('slow');
        } else {
            // $( "#optionImg" ).html( $( '<img src=' + homedir + '/img/options/' + startOption + '>' ) );
            $('#current_price').html(startPrice).fadeIn('slow');
        }
    });


// PART 1 - OPTIONS SELECTING ON PAGE LOAD

 // Active category
 if(typeof cat_alias !== 'undefined' && cat_alias != null) {
    var href_link = '.categories_filter li a[data-alias="' + cat_alias + '"]';
    $(href_link).addClass('active');
 }

 //Active options
if(typeof filters != 'undefined' && filters != null) {
    if(filters['options.alias'] != null ) {
        var element_selector = '.sidebar__item__size input[value="' + filters['options.alias'] + '"]';
        var element = $(element_selector);
        element.parents('label').addClass('active');
    }

// Price
if(filters['price_between'] != null ) {
    filter_collection = filters['price_between'].split(',');
    minamount.val(currSymbol + filter_collection[0]);
    maxamount.val(currSymbol + filter_collection[1]);

    rangeSlider.slider({
        values: [
            filter_collection[0],
            filter_collection[1]
        ],
    });
}


}
 //PerPage
 if(typeof pp !== 'undefined') {
    $('select.perpage-select option').each(function(index) {
        var value = $( this ).val();
        //console.log(value, pp);
        if(value == pp) {
            $(this).attr("selected", ":selected");
            $('select').niceSelect('update');
        }
        });
 }

 // Sorting
 if(typeof sort !== 'undefined') {
    $('select.sort-select option').each(function(index) {
        var value = ($( this ).val()).split('=')[1];
        //console.log(value, sort);
        if(value == sort) {
            $(this).attr("selected", ":selected");
            $('select').niceSelect('update');
        }
        });
 }

   // PART 2 - QUERY FORMING

    // Category
    $('.categories_filter li a').on('click', function(e) {
        e.preventDefault();
        $('.preloader').fadeIn(300);
        var filter_collection = "filter[category.alias]=" + $(this).data('alias');
        FilterRedirect(filter_collection);
    });

    // Options
    $('.sidebar__item__size input').on('click', function(e) {
        e.preventDefault();
        $('.preloader').fadeIn(300);
        var option = "filter[options.alias]=" + $(this).val();
        console.log(option);
        FilterRedirect(option);
    });

    // PerPage
    $('select.perpage-select').on('change', function() {
        $(".preloader").fadeIn(300);
        var pp = "pp=" + $(this).val();
        FilterRedirect(pp);
       });

   // Sorting
   $('select.sort-select').on('change', function() {
    $(".preloader").fadeIn(300);
       var sort = $(this).val();
       FilterRedirect(sort);
   });

// PriceQuery
$('#price_btn').on('click', function() {
    var price_min = rangeSlider.slider("values", 0),
        price_max = rangeSlider.slider("values", 1);
        console.log(price_min, price_max);
        var filter_collection = "filter[price_between]=" + price_min + ',' + price_max;
        if(filter_collection) FilterRedirect(filter_collection);
})


function FilterRedirect(el) {

   // Проверяем, что в данный момент есть в запросе.
    // Что есть, сохраняем, что изменилось - меняем
   var newquery = '?';
    // var page = getParameterByName('page%5Bnumber%5D');

   newquery = check_filter('sort', newquery, el);
   newquery = check_filter('pp', newquery, el);
   newquery = check_filter('filter[options.alias]', newquery, el);
   newquery = check_filter('filter[price_between]', newquery, el);
   newquery = check_filter('filter[category.alias]', newquery, el);
   newquery = check_filter('filter[title]', newquery, el);

   newquery = newquery.slice(0, -1);
   pathname = window.location.pathname;
   var newurl = pathname + newquery;
   // console.log(newurl);
   window.location.replace(newurl)
}

function check_filter(param, newquery, el) {
   var query_param = getParameterByName(param);
//    console.log(param, newquery, el,  query_param);
   // измененный фильтр меняем
   if(el.split('=')[1] !='' && el.split('=')[0] == param) newquery = newquery + el + '&';
   // все остальные фильтры - без изменений
   if(query_param && el.split('=')[0] != param) newquery = newquery + param + '=' + query_param  + '&';
   return newquery;
}

function getParameterByName(name, url) {
   if (!url) url = window.location.href;
   name = name.replace(/[\[\]]/g, '\\$&');
   var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
       results = regex.exec(url);
   if (!results) return null;
   if (!results[2]) return '';
   return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

});
