/*document 변수 초기화*/
var doc = document;

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

$(window).bind("popstate", function(event) {
    var data = event.originalEvent.state;
    if (data) {
        router( data.url, true );
    } else {
        router( document.location.href, false );
    };
});

function header () {
    doc = $(doc);
    var header = doc.find('#header');
    header.find('.back a').on('click', function ( event ) {
        event.preventDefault();
        window.history.back();
    });
};

function container () {
    doc = $(doc);
    var container = doc.find('#container');   
    container.find('a').on('click', function ( event ) {
        return router( this.href, true );
    });
}