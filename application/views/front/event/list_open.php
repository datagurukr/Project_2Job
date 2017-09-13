<div class="wrap" id="hideMenu">
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/back_button.png">
                </a>
                <h6><strong>이벤트</strong></h6>
            </div>
            <div class="hamburgermenu">
                <a href="#!">
                    <img src="assets/images/menu.png">
                </a>
            </div>
        </div>
    </div>
    <div class="list-wrap" id="container">    
        <div class="event-nav">
            <div class="tab tab-active">
                <a href="/event/open" class="text-center disable">진행중인 이벤트</a>
            </div>
            <div class="tab tab">
                <a href="/event/close" class="text-center">종료된 이벤트</a>
            </div>        
        </div>    
        <?
        if ( $response['status'] == 200 ) {
            if ( 0 < $response['data']['count'] ) {
                $temp = ((($p * 2) * 10) - 20 ); 
                $num = $response['data']['out_cnt'] - $temp; 
                foreach ( $response['data']['out'] as $row ) {
                    // $num; $num--;
                    ?>       
        <div class="list-row">    
            <a href="/event/<? echo $row['post_id']; ?>">
                <h6><? if ( 0 < strlen(trim($row['post_content_title'])) ) { echo $row['post_content_title']; } else { echo '-'; }; ?></h6>
                <p><small><? echo date("Y-m-d", strtotime($row['post_register_date'])); ?></small></p>
                <img class="link" src="/assets/images/link.png">
            </a>    
        </div>    
                    <?
                };
            };
        }
        ?>    
    </div>
    <? echo $this->pagination->create_links(); ?>
</div>    
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>