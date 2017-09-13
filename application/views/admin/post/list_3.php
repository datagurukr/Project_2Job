<?
$out = array();
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $out = $response['data']['out'];
    }
}
?>
<div class="section">
    <h5 class="header">인기 검색어 관리</h5>
    <form class="col s12" method="post" enctype="application/x-www-form-urlencoded">        
        <div class="row">
            <div class="col s12">
                <p>인기 검색어를 관리할 수 있습니다.</p>
                
                <table class="striped">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>검색어</th>                        
                            <th>링크URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        for ( $i = 0; $i < 10; $i++ ) {
                            ?>
                        <tr>
                            <td><? echo $i+1; ?></td>
                            <td>
                                <div class="input-field col s12">
                                    <input type="text" class="validate" name="keyword[]" value="<? if ( isset($out[$i]['keyword']) ) { echo $out[$i]['keyword']; }; ?>">
                                    <label for="course">검색어</label>
                                </div>                                
                            </td>
                            <td>
                                <div class="input-field col s12">
                                    <input type="text" class="validate" name="url[]" value="<? if ( isset($out[$i]['url']) ) { echo $out[$i]['url']; }; ?>">
                                    <label for="course">검색어</label>
                                </div>                                                                
                            </td>                            
                        </tr>    
                            <?
                        }
                        /*
                        if ( $response['status'] == 200 ) {
                            if ( 0 < $response['data']['count'] ) {
                                $temp = ((($p * 2) * 10) - 20 ); 
                                $num = $response['data']['out_cnt'] - $temp; 
                                foreach ( $response['data']['out'] as $row ) {
                                    ?>
                        <tr>
                            <td><? echo $num; $num--; ?></td>
                            <td>
                                진행중
                            </td>                               
                            <td>
                                <a href="/admin/post/detail/<? echo $row['post_id']; ?>/2">
                                <?
                                if ( isset($row['post_content_title']) ) {
                                    echo $row['post_content_title'];
                                } else {
                                    echo '-';
                                }
                                ?>
                                </a>    
                            </td>
                            <td>
                                2017-05-10~2017-06-10
                            </td>                            
                            <td>
                                <?
                                if ( isset($row['post_register_date']) ) {
                                    echo date("Y-m-d", strtotime($row['post_register_date']));
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>   
                            <td>
                                <?
                                if ( isset($row['post_hit_count']) ) {
                                    echo number_format($row['post_hit_count']);
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>                         
                        </tr>                    
                                    <?
                                };
                            };
                        }
                        */
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">        
            <div class="col s12">
                
                    <!-- Modal Trigger -->
                    <a class="waves-effect waves-light btn modal-trigger right" href="#modal1">등록</a>

                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>알림</h4>
                            <p>검색어를 등록하시겠습니까?</p>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-close waves-effect waves-red btn-flat">취소</button>
                            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">확인</button>
                        </div>
                    </div>                

            </div>    
        </div>        
        
    </form>    
</div>