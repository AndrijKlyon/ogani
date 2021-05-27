!function(e,t){function s(t,s){this.element=t,this.settings=e.extend({},e.fn.rate.settings,s),this.set_faces={},this.build()}e.fn.textWidth=function(){var t=e("<span>"+e(this).html()+"</span>");t.css("font-size",e(this).css("font-size")).hide(),t.prependTo("body");var s=t.width();if(t.remove(),0==s){var i=0;return e(this).eq(0).children().each(function(){i+=e(this).textWidth()}),i}return s},e.fn.textHeight=function(){var t=e("<span>"+e(this).html()+"</span>");t.css("font-size",e(this).css("font-size")).hide(),t.prependTo("body");var s=t.height();return t.remove(),s},Array.isArray=function(e){return"[object Array]"===Object.prototype.toString.call(e)},String.prototype.getCodePointLength=function(){return this.length-this.split(/[\uD800-\uDBFF][\uDC00-\uDFFF]/g).length+1},String.fromCodePoint=function(){for(var e=Array.prototype.slice.call(arguments),t=e.length;t-- >0;){var s=e[t]-65536;s>=0&&e.splice(t,1,55296+(s>>10),56320+(1023&s))}return String.fromCharCode.apply(null,e)},e.fn.rate=function(t){if(void 0===t||"object"==typeof t)return this.each(function(){e.data(this,"rate")||e.data(this,"rate",new s(this,t))});if("string"==typeof t){var i,a=arguments;return this.each(function(){var l=e.data(this,"rate");l instanceof s&&"function"==typeof l[t]&&(i=l[t].apply(l,Array.prototype.slice.call(a,1))),"destroy"===t&&(e(l.element).off(),e.data(this,"rate",null))}),void 0!==i?i:this}},s.prototype.build=function(){this.layers={},this.value=0,this.raise_select_layer=!1,this.settings.initial_value&&(this.value=this.settings.initial_value),e(this.element).attr("data-rate-value")&&(this.value=e(this.element).attr("data-rate-value"));var t=this.value/this.settings.max_value*100;if("string"==typeof this.settings.symbols[this.settings.selected_symbol_type]){var s=this.settings.symbols[this.settings.selected_symbol_type];this.settings.symbols[this.settings.selected_symbol_type]={},this.settings.symbols[this.settings.selected_symbol_type].base=s,this.settings.symbols[this.settings.selected_symbol_type].selected=s,this.settings.symbols[this.settings.selected_symbol_type].hover=s}var i=this.addLayer("base-layer",100,this.settings.symbols[this.settings.selected_symbol_type].base,!0),a=this.addLayer("select-layer",t,this.settings.symbols[this.settings.selected_symbol_type].selected,!0),l=this.addLayer("hover-layer",0,this.settings.symbols[this.settings.selected_symbol_type].hover,!1);this.layers.base_layer=i,this.layers.select_layer=a,this.layers.hover_layer=l,e(this.element).on("mousemove",e.proxy(this.hover,this)),e(this.element).on("click",e.proxy(this.select,this)),e(this.element).on("mouseleave",e.proxy(this.mouseout,this)),e(this.element).css({"-webkit-touch-callout":"none","-webkit-user-select":"none","-khtml-user-select":"none","-moz-user-select":"none","-ms-user-select":"none","user-select":"none"}),this.settings.hasOwnProperty("update_input_field_name")&&this.settings.update_input_field_name.val(this.value)},s.prototype.addLayer=function(t,s,i,a){for(var l="<div>",n=0;n<this.settings.max_value;n++)Array.isArray(i)?(this.settings.convert_to_utf8&&(i[n]=String.fromCodePoint(i[n])),l+="<span>"+i[n]+"</span>"):(this.settings.convert_to_utf8&&(i=String.fromCodePoint(i)),l+="<span>"+i+"</span>");var r=e(l+="</div>").addClass("rate-"+t).appendTo(this.element);return e(r).css({width:s+"%",height:e(r).children().eq(0).textHeight(),overflow:"hidden",position:"absolute",top:0,display:a?"block":"none","white-space":"nowrap"}),e(this.element).css({width:e(r).textWidth()+"px",height:e(r).height(),position:"relative",cursor:this.settings.cursor}),r},s.prototype.updateServer=function(){null!=this.settings.url&&e.ajax({url:this.settings.url,type:this.settings.ajax_method,data:e.extend({},{value:this.getValue()},this.settings.additional_data),success:e.proxy(function(t){e(this.element).trigger("updateSuccess",[t])},this),error:e.proxy(function(t,s,i){e(this.element).trigger("updateError",[t,s,i])},this)})},s.prototype.getValue=function(){return this.value},s.prototype.hover=function(t){var s=parseInt(e(this.element).css("padding-left").replace("px","")),i=t.pageX-e(this.element).offset().left-s,a=this.toValue(i,!0);if(a!=this.value&&(this.raise_select_layer=!1),!this.raise_select_layer&&!this.settings.readonly){var l=this.toWidth(a);if(this.layers.select_layer.css({display:"none"}),this.settings.only_select_one_symbol){var n=Math.floor(a);this.layers.hover_layer.css({width:"100%",display:"block"}),this.layers.hover_layer.children("span").css({visibility:"hidden"}),this.layers.hover_layer.children("span").eq(0!=n?n-1:0).css({visibility:"visible"})}else this.layers.hover_layer.css({width:l+"%",display:"block"})}},s.prototype.select=function(t){if(!this.settings.readonly){this.getValue();var s=parseInt(e(this.element).css("padding-left").replace("px","")),i=t.pageX-e(this.element).offset().left-s,a=this.toWidth(this.toValue(i,!0));this.setValue(this.toValue(a)),this.raise_select_layer=!0}},s.prototype.mouseout=function(){this.layers.hover_layer.css({display:"none"}),this.layers.select_layer.css({display:"block"})},s.prototype.toWidth=function(e){return e/this.settings.max_value*100},s.prototype.toValue=function(e,t){var s,i=(s=t?e/this.layers.base_layer.textWidth()*this.settings.max_value:e/100*this.settings.max_value)/this.settings.step_size;return i-Math.floor(i)<5e-5&&(s=Math.round(s/this.settings.step_size)*this.settings.step_size),s=(s=Math.ceil(s/this.settings.step_size)*this.settings.step_size)>this.settings.max_value?this.settings.max_value:s},s.prototype.getElement=function(t,s){return e(this.element).find(".rate-"+t+" span").eq(s-1)},s.prototype.getLayers=function(){return this.layers},s.prototype.setFace=function(e,t){this.set_faces[e]=t},s.prototype.setAdditionalData=function(e){this.settings.additional_data=e},s.prototype.getAdditionalData=function(){return this.settings.additional_data},s.prototype.removeFace=function(e){delete this.set_faces[e]},s.prototype.setValue=function(t){if(!this.settings.readonly){t<0?t=0:t>this.settings.max_value&&(t=this.settings.max_value);var s=this.getValue();this.value=t;e(this.element).trigger("change",{from:s,to:this.value});e(this.element).find(".rate-face").remove(),e(this.element).find("span").css({visibility:"visible"});var i=Math.ceil(this.value);if(this.set_faces.hasOwnProperty(i)){var a="<div>"+this.set_faces[i]+"</div>",l=this.getElement("base-layer",i),n=this.getElement("select-layer",i),r=this.getElement("hover-layer",i),o=l.textWidth()*(i-1)+(l.textWidth()-e(a).textWidth())/2;e(a).appendTo(this.element).css({display:"inline-block",position:"absolute",left:o}).addClass("rate-face"),l.css({visibility:"hidden"}),n.css({visibility:"hidden"}),r.css({visibility:"hidden"})}if(this.settings.only_select_one_symbol){h=this.toWidth(this.settings.max_value);this.layers.select_layer.css({display:"block",width:h+"%",height:this.layers.base_layer.css("height")}),this.layers.hover_layer.css({display:"none",height:this.layers.base_layer.css("height")}),this.layers.select_layer.children("span").css({visibility:"hidden"}),this.layers.select_layer.children("span").eq(0!=i?i-1:0).css({visibility:"visible"})}else{var h=this.toWidth(this.value);this.layers.select_layer.css({display:"block",width:h+"%",height:this.layers.base_layer.css("height")}),this.layers.hover_layer.css({display:"none",height:this.layers.base_layer.css("height")})}e(this.element).attr("data-rate-value",this.value),this.settings.change_once&&(this.settings.readonly=!0),this.updateServer();e(this.element).trigger("afterChange",{from:s,to:this.value});this.settings.hasOwnProperty("update_input_field_name")&&this.settings.update_input_field_name.val(this.value)}},s.prototype.increment=function(){this.setValue(this.getValue()+this.settings.step_size)},s.prototype.decrement=function(){this.setValue(this.getValue()-this.settings.step_size)},e.fn.rate.settings={max_value:5,step_size:.5,initial_value:0,symbols:{utf8_star:{base:"☆",hover:"★",selected:"★"},utf8_hexagon:{base:"⬡",hover:"⬢",selected:"⬢"},hearts:"&hearts;",fontawesome_beer:'<i class="fa fa-beer"></i>',fontawesome_star:{base:'<i class="fa fa-star-o"></i>',hover:'<i class="fa fa-star"></i>',selected:'<i class="fa fa-star"></i>'},utf8_emoticons:{base:[128549,128531,128530,128516],hover:[128549,128531,128530,128516],selected:[128549,128531,128530,128516]}},selected_symbol_type:"utf8_star",convert_to_utf8:!1,cursor:"default",readonly:!1,change_once:!1,only_select_one_symbol:!1,ajax_method:"POST",additional_data:{}}}(jQuery,window),$(document).ready(function(){var e=$(".price-range-custom"),t=$("#minamount"),s=$("#maxamount"),i=e.data("min"),a=e.data("max"),l=e.data("currency");e.slider({range:!0,step:10,min:i,max:a,values:[i,a],slide:function(e,i){t.val(l+i.values[0]),s.val(l+i.values[1])}}),t.val(l+e.slider("values",0)),s.val(l+e.slider("values",1));if($(".rating").rate({max_value:5,step_size:1,initial_value:0,selected_symbol_type:"utf8_star",cursor:"default",readonly:!1,change_once:!1,ajax_method:"POST",additional_data:{}}),$(".rating").on("change",function(e,t){$("#rating").val($(".rating").rate("getValue"))}),$("body").on("change","select.option-select",function(){let e=$(this).val(),t=$(this).find("option").filter(":selected").data("option"),s=$(this).find("option").filter(":selected").data("price");img=$(this).find("option").filter(":selected").data("img"),startOption=$("#optionImg").data("startimage"),startPrice=$("#optionImg").data("startprice"),console.log(e,t,s,img,startOption),s?$("#current_price").html(s).fadeIn("slow"):$("#current_price").html(startPrice).fadeIn("slow")}),"undefined"!=typeof cat_alias&&null!=cat_alias){var n='.categories_filter li a[data-alias="'+cat_alias+'"]';$(n).addClass("active")}if("undefined"!=typeof filters&&null!=filters){if(null!=filters["options.alias"]){var r='.sidebar__item__size input[value="'+filters["options.alias"]+'"]';$(r).parents("label").addClass("active")}null!=filters.price_between&&(filter_collection=filters.price_between.split(","),t.val(l+filter_collection[0]),s.val(l+filter_collection[1]),e.slider({values:[filter_collection[0],filter_collection[1]]}))}function o(e){var t="?";t=h("sort",t,e),t=h("pp",t,e),t=h("filter[options.alias]",t,e),t=h("filter[price_between]",t,e),t=h("filter[category.alias]",t,e),t=(t=h("filter[title]",t,e)).slice(0,-1),pathname=window.location.pathname;var s=pathname+t;window.location.replace(s)}function h(e,t,s){var i=function(e,t){t||(t=window.location.href);e=e.replace(/[\[\]]/g,"\\$&");var s=new RegExp("[?&]"+e+"(=([^&#]*)|&|#|$)").exec(t);return s?s[2]?decodeURIComponent(s[2].replace(/\+/g," ")):"":null}(e);return""!=s.split("=")[1]&&s.split("=")[0]==e&&(t=t+s+"&"),i&&s.split("=")[0]!=e&&(t=t+e+"="+i+"&"),t}"undefined"!=typeof pp&&$("select.perpage-select option").each(function(e){$(this).val()==pp&&($(this).attr("selected",":selected"),$("select").niceSelect("update"))}),"undefined"!=typeof sort&&$("select.sort-select option").each(function(e){$(this).val().split("=")[1]==sort&&($(this).attr("selected",":selected"),$("select").niceSelect("update"))}),$(".categories_filter li a").on("click",function(e){e.preventDefault(),$(".preloader").fadeIn(300),o("filter[category.alias]="+$(this).data("alias"))}),$(".sidebar__item__size input").on("click",function(e){e.preventDefault(),$(".preloader").fadeIn(300);var t="filter[options.alias]="+$(this).val();console.log(t),o(t)}),$("select.perpage-select").on("change",function(){$(".preloader").fadeIn(300),o("pp="+$(this).val())}),$("select.sort-select").on("change",function(){$(".preloader").fadeIn(300),o($(this).val())}),$("#price_btn").on("click",function(){var t=e.slider("values",0),s=e.slider("values",1);console.log(t,s);var i="filter[price_between]="+t+","+s;i&&o(i)})});