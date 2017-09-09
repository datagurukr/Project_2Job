<div class="login-header" id="header">
    <div class="container">
        <div class="back">
            <a href="">
                <img src="/assets/images/back_button.png">
            </a>
            <h6><strong>공지사항</strong></h6>
        </div>
        <div class="hamburgermenu">
            <a href="#!">
                <img src="assets/images/menu.png">
            </a>
        </div>
    </div>
</div>
<div class="list-wrap" id="container">
    <?
    if ( $response['status'] == 200 ) {
        if ( 0 < $response['data']['count'] ) {
            $temp = ((($p * 2) * 10) - 20 ); 
            $num = $response['data']['out_cnt'] - $temp; 
            foreach ( $response['data']['out'] as $row ) {
                // $num; $num--;
                ?>       
    <div class="list-row">    
        <a href="/notice/<? echo $row['post_id']; ?>">
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
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>