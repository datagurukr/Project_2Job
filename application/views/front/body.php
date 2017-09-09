<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>투잡다모아</title>
        <link href="https://necolas.github.io/normalize.css/7.0.0/normalize.css" rel="stylesheet">
        <link href="/assets/css/common.css" rel="stylesheet">
        <link href="/assets/css/general.css" rel="stylesheet">
        <script type="text/javascript">
        /* load_javascript */
        function load_javascript ( url, callback ) {
            var head= document.getElementsByTagName('head')[0];
            var script= document.createElement('script');
            script.type= 'text/javascript';
            var loaded = false;
            script.onreadystatechange= function () {
                if (this.readyState == 'loaded' || this.readyState == 'complete') {
                    if (loaded) {
                        return;
                    }
                    loaded = true;
                    run_func( callback, url );
                };
            }
            script.onload = function () {
                run_func(callback,url);
            }
            script.src = url;
            head.appendChild(script);
        };

        /* javascript run func */
        function run_func ( callback, url ) {
            callback = String(callback);
            if ( 0 < callback.length ) {
                if(typeof(window[callback]) == "function"){
                    eval(callback+'()');
                }else{
                    if ( url ) {
                        /* javascript url load */
                        load_javascript(url, callback);
                    } else {
                        setTimeout(function(){ 
                            run_func( callback, url );
                        }, 1000);
                    };
                };
            };
        };
        </script>        
    </head>
    <body>
        <div id="screen">
            <? echo $container; ?>
            <script type="text/javascript">run_func( 'header', false );</script>            
        </div>
        <div class="ajax-loading-body">
            <p>Loading..</p>            
        </div>
    </body>
    <script type="text/javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.form.min.js"></script>    
    <script type="text/javascript" src="/assets/js/common.js"></script>    
</html>