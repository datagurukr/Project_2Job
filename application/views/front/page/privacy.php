<!-- screen -->
<div class="wrap" id="hideMenu">
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <?
                $referer = @$_SERVER['HTTP_REFERER'];
                if ( isset($_GET['referer']) ) {
                    $referer = $_GET['referer'];
                };
                ?>
                <button onclick="history.back()">
                    <img src="/assets/images/login/back_button.png">
                </button>
                <h6><strong>개인정보처리방침</strong></h6>
            </div>
        </div>
    </div>
    <div class="container" id="container">
        개인정보처리방침
    </div>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>