$(document).ready(function(){if(null!=cat_alias)var a='.blog__sidebar__item__cats li a[data-filter="'+cat_alias+'"]';else a='.blog__sidebar__item__cats li a[data-filter=""]';if($(a).addClass("active"),null!=tags_alias)if(tags_alias){a='.blog__sidebar__item__tags a[data-filter="'+tags_alias+'"]';console.log(a),$(a).addClass("active")}else a='.tag_cloud_widget a[data-filter="'+tags_alias+'"]';else a='.tag_cloud_widget a[data-filter=""]';function t(a){var t="?";t=e("filter[category.alias]",t,a),t=e("filter[tags.alias]",t,a),t=(t=e("filter[title]",t,a)).slice(0,-1);var i=homedir+"/posts"+t;window.location.replace(i)}function e(a,t,e){var i=function(a,t){t||(t=window.location.href);a=a.replace(/[\[\]]/g,"\\$&");var e=new RegExp("[?&]"+a+"(=([^&#]*)|&|#|$)").exec(t);return e?e[2]?decodeURIComponent(e[2].replace(/\+/g," ")):"":null}(a);return""!=e.split("=")[1]&&e.split("=")[0]==a&&(t=t+e+"&"),i&&e.split("=")[0]!=a&&(t=t+a+"="+i+"&"),t}$(a).addClass("active"),null!=title&&$("#blog-search input").val(title),$(".blog__sidebar__item__cats li a").on("click",function(a){a.preventDefault(),t("filter[category.alias]="+$(this).data("filter"))}),$(".blog__sidebar__item__tags a").on("click",function(a){a.preventDefault(),t("filter[tags.alias]="+$(this).data("filter"))}),$(".blog__sidebar__search button").on("click",function(a){a.preventDefault(),t("filter[title]="+$(".blog__sidebar__search input").val())})});
