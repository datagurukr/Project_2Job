<?
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $temp = ((($p * 2) * 10) - 20 ); 
        $num = $response['data']['out_cnt'] - $temp; 
        foreach ( $response['data']['out'] as $row ) {
            // $num; $num--;
            ?>              
<a href="/qna/<? echo $row['post_id']; ?>">
    <? if ( 0 < strlen(trim($row['post_content_title'])) ) { echo $row['post_content_title']; } else { echo '-'; }; ?>
    </br>
    <? echo date("Y-m-d", strtotime($row['post_register_date'])); ?>
</a>
            <?
        };
    };
}
?>
<? echo $this->pagination->create_links(); ?>