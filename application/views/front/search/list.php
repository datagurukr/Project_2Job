<div class="wrap" id="hideMenu">
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/back_button.png">
                </a>
                <h6><strong>검색 결과</strong></h6>
            </div>
            <div class="hamburgermenu">
                <a href="#!">
                    <img src="assets/images/menu.png">
                </a>
            </div>
        </div>
    </div>
    <div class="list-wrap" id="container">       
    </div>
    <? echo $this->pagination->create_links(); ?>
</div>    
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>