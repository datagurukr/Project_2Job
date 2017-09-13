<div class="wrap" id="hideMenu">
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/back_button.png">
                </a>
                <h6><strong>지도에서 가맹점 찾기</strong></h6>
            </div>
            <div class="hamburgermenu">
                <a href="#!" id="showMenu">
                    <img src="/assets/images/menu.png">
                </a>
            </div>
        </div>
    </div>
    <div id="container">
        <div class="map">
            aoq
        </div>
        <style>
            .map-bottom{background:#00C63C }
            .map-bottom p{font-size: 16px;color: #fff}
            .map-bottom a{
                display: block;
                border: 1px solid #fff;
                padding: 5px 10px;
                margin-top: 10px
            }

        </style>
        <div class="map-bottom">
            <div class="container">
                <div class="row">
                    <div class="col s6">
                        <p>
                            검색결과: 1,230개
                        </p>
                    </div>
                    <div class="col s6">
                        <a class="btn primary-btn text-center">
                            이 지역 목록보기 >
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> 
<script>
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
</script>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>