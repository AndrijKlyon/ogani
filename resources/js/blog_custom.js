$(document).ready(function() {

    // PART 1 - OPTIONS SELECTING ON PAGE LOAD

    // Active category
    if(cat_alias != null) {
        var href_link = '.blog__sidebar__item__cats li a[data-filter="' + cat_alias + '"]';
    }
    else {
        var href_link = '.blog__sidebar__item__cats li a[data-filter=""]';
    }
        $(href_link).addClass('active')

    // Active tag
    if(tags_alias != null) {
        if(tags_alias) {
                var href_link = '.blog__sidebar__item__tags a[data-filter="' + tags_alias + '"]';
                console.log(href_link)
                $(href_link).addClass('active');
        }
        else {
            var href_link = '.tag_cloud_widget a[data-filter="' + tags_alias + '"]';
        }

    }
    else {
        var href_link = '.tag_cloud_widget a[data-filter=""]';
    }
        $(href_link).addClass('active')

    //search
    if(title != null) {
        $('#blog-search input').val(title);
    }


    // PART 2 - QUERY FORMING

    //Category
    $('.blog__sidebar__item__cats li a').on('click', function(e) {
        e.preventDefault();
        var filter_category = "filter[category.alias]=" + $(this).data('filter');
        FilterRedirect(filter_category);
    });

    // Tags
    $('.blog__sidebar__item__tags a').on('click', function(e) {
        e.preventDefault();
        var filter_tags = "filter[tags.alias]=" + $(this).data('filter');
        FilterRedirect(filter_tags);
    });

     // search
     $('.blog__sidebar__search button').on('click', function(e) {
        e.preventDefault();
        var query = "filter[title]=" + $('.blog__sidebar__search input').val();
        FilterRedirect(query);
     });

    function FilterRedirect(el) {

       // Проверяем, что в данный момент есть в запросе.
        // Что есть, сохраняем, что изменилось - меняем
       var newquery = '?';

       newquery = check_filter('filter[category.alias]', newquery, el);
       newquery = check_filter('filter[tags.alias]', newquery, el);
       newquery = check_filter('filter[title]', newquery, el);

       newquery = newquery.slice(0, -1);
    //    pathname = window.location.pathname;
       var newurl = homedir + '/posts' + newquery;
       //console.log(newquery, pathname, newurl);
       window.location.replace(newurl)
    }

    function check_filter(param, newquery, el) {
       var query_param = getParameterByName(param);
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
