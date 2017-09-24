/*document 변수 초기화*/
var doc = document;
var lat = 37.562296;
var lng = 126.990228;
var shopMap;

function global_Ajax (in_type, in_data_tpye, in_url, in_params, in_callback) {
	$.ajax({
	  type: in_type, 
	  url: in_url,
      cache: false,
	  dataType: in_data_tpye,
	  data: in_params, 
	  success: function(response){
		  in_callback(response);
	  }
	});
};

function router ( url, state ) {
    doc = $(doc);
    if ( history.pushState ) {
        if ( doc.find('body').hasClass('ajax-loading') )  {
            return false;
        };
        doc.find('body').addClass('ajax-loading');
        global_Ajax ('GET', 'json', url, '', function ( result ) {
            if ( result.module.redirect_url == 'reload' ) {
                location.reload();
                return false;
            } else {
                var html = result.module.html;
                if ( result.module.overlay ) {
                    var mark_up = [
                    '<div class="overlay">',
                    '<div class="overlay-view">'
                    +html+
                    '</div>',
                    '</div>'
                    ].join("");
                    $(doc).find('body').append(mark_up);
                    overlay_close( true );
                } else {
                    var body = doc.find('body');
                    $('#'+result.module.tree.inner_attributes.id).html(html);
                    scroller_func = new Array;
                };
                doc.find('body').removeClass('ajax-loading');
                var meta = result.module.page_info.meta;
                doc.title = meta.title;
                // meta
                $("meta[name='robots']").attr("content", meta.robots);
                $("meta[name='title']").attr("content", meta.title);
                $("meta[name='description']").attr("content", meta.description);
                $("meta[name='keywords']").attr("content", meta.keyword);
                $("meta[name='image']").attr("content", meta.image);
                if ( !result.module.url_change ) {
                    state = false;
                };
               if ( state ) {
                    history.pushState(result, meta.title, url);
                };
            };
        });
        return false;
    };
    return true;
};

function addComma(data_value) {
    var txtNumber = '' + data_value;  
    if (isNaN(txtNumber) || txtNumber == "") {
        return 0;
    } else {
        var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');  
        var arrNumber = txtNumber.split('.'); 
        arrNumber[0] += '.';
 
        do {
            arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2'); 
        } while (rxSplit.test(arrNumber[0]));
 
        if (arrNumber.length > 1) { 
            return arrNumber.join(''); 
        } else { 
            return arrNumber[0].split('.')[0];
        };
    };
};

function loadShop () {
    console.log("loadShop");
    global_Ajax ('GET', 'json', '/api/shop/out/gps', 'lat='+lat+'&lng='+lng+'&order=asc', function ( result ) {
        if( result.status == 200 ) {
            $('#shop-count').html('검색결과: '+addComma(result.data.count)+'개');            
            $('#shop-list-link').attr('href','/shop/list?lat='+lat+'&lng='+lng+'&order=asc');
            $('#shop-list-link').show();
            $(result.data.out).each(function( i, row ) {
                var shopLatLng = {lat: parseFloat(row.user_lat), lng: parseFloat(row.user_lng)};                
                var marker = new google.maps.Marker({
                  position: shopLatLng,
                  map: shopMap,
                  title: row.user_business_entity_name
                }); 
                if ( i == 0 ) {
                    shopMap.setCenter({
                        lat : parseFloat(row.user_lat),
                        lng : parseFloat(row.user_lng)
                    });                    
                }
            });
        } else {
            $('#shop-count').html('0'); 
            $('#shop-list-link').hide();            
        }
    });
}

function initGps() {
    if (navigator.geolocation) { // GPS를 지원하면
        navigator.geolocation.getCurrentPosition(function(position) {
            lat = position.coords.latitude;
            lng = position.coords.longitude;
        }, function(error) {
            console.error(error);
        }, {
            enableHighAccuracy: false,
            maximumAge: 0,
            timeout: Infinity
        });
    } else {
        alert('GPS를 지원하지 않습니다');
    }
    initShopMap();    
};

function initDetailShopMap() {
    var lat = parseFloat($('#map').attr('data-lat'));
    var lng = parseFloat($('#map').attr('data-lng'));
    var name = $('#map').attr('data-user-business-entity-name');
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng: lng},
        zoom: 15
    });
    var shopLatLng = {lat: lat, lng: lng};                
    var marker = new google.maps.Marker({
      position: shopLatLng,
      map: map,
      title: name
    });     
};


function initShopMap() {
    shopMap = new google.maps.Map(document.getElementById('shop-map'), {
        center: {lat: lat, lng: lng},
        zoom: 15
    });
    loadShop();
};

/*
$(window).bind("popstate", function(event) {
    var data = event.originalEvent.state;
    if (data) {
        router( data.url, true );
    } else {
        router( document.location.href, false );
    };
});
*/

function header () {
    doc = $(doc);
    var header = doc.find('#header');
    /*
    header.find('.back a').on('click', function ( event ) {
        event.preventDefault();
        window.history.back();
    });
    header.find('a').on('click', function ( event ) {
        return router( this.href, true );
    });    
    */
};

function container () {
    doc = $(doc);
    var container = doc.find('#container');   
    /*
    container.find('a').on('click', function ( event ) {
        return router( this.href, true );
    });
    */
    container.find('.on-reload-select').on('change', function ( event ) {
        $(this).parents('form').submit();
    });    
}

function slideNav () {
    $("#showMenu").on("click", function(){
        var container = $("#navbar-collapse-menu");
        container.show();
        $("body").addClass("site-nav-transition");
        if(event.stopPropagation) event.stopPropagation(); //MOZILLA
    else event.cancelBubble = true; //IE
    });
    $("#hideMenu").on("click", function(){
        var container = $("#navbar-collapse-menu");
        container.hide();
        $("#showMenu").show();
        $("body").removeClass("site-nav-transition");
        if(event.stopPropagation) event.stopPropagation(); //MOZILLA
    else event.cancelBubble = true; //IE
    });
    $("#hideMenu").click();    
}

function product () {
    var price = 0;
    var product = $('#product');
    var product_price = parseInt(product.find('input[name=product_price]').attr('value'));
    price = product_price;
    
    function cal () {
        price = 0;
        var product_cnt = parseInt(product.find('.row-quantity .qty-ctrl .cnt').attr('value'));        
        product.find('.row-option').each(function( i, element ) {
            var option_cnt = parseInt($(element).find('.qty-ctrl .cnt').attr('value'));
            var option_price = parseInt($(element).find('input[name=option_cal_price]').attr('value'));
            $(element).find('.in_option_price').attr('value',option_price);
            $(element).find('.in_option_count').attr('value',option_cnt);
            price = price + ((option_cnt*product_cnt) * option_price);
        });
        price = price + (product_price * product_cnt);
        product.find('.tot-price').html(addComma(price)+'원');
        product.find('input[name=purchase_price]').attr('value',price);
        product.find('input[name=purchase_count]').attr('value',product_cnt);        
    }
    
    product.find('.row-option').each(function( i, element ) {
        $(element).find('.btn-dec').on('click', function () {
            var cnt = $(this).parents('.qty-ctrl').find('.cnt').attr('value');
            if ( 0 < cnt ) {
                cnt--;
                $(this).parents('.qty-ctrl').find('.cnt').attr('value',cnt);
                cal();
            }
        });
        $(element).find('.btn-inc').on('click', function () {
            var cnt = $(this).parents('.qty-ctrl').find('.cnt').attr('value');
            cnt++;
            $(this).parents('.qty-ctrl').find('.cnt').attr('value',cnt);
            cal();
        });        
    });
    
    product.find('.row-quantity .qty-ctrl .btn-dec').on('click', function () {
        var cnt = $(this).parents('.qty-ctrl').find('.cnt').attr('value');
        if ( 1 < cnt ) {
            cnt--;
            $(this).parents('.qty-ctrl').find('.cnt').attr('value',cnt);
            cal();
        }
    });
    
    product.find('.row-quantity .qty-ctrl .btn-inc').on('click', function () {
        var cnt = $(this).parents('.qty-ctrl').find('.cnt').attr('value');
        cnt++;
        $(this).parents('.qty-ctrl').find('.cnt').attr('value',cnt);
        cal();
    });    
    
}