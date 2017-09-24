<div class="section">
    <h5 class="header">이벤트 관리</h5>
    <form class="col s12" method="get" enctype="application/x-www-form-urlencoded">        
        <div class="row">
            <div class="col s12">
                <p>이벤트를 관리할 수 있습니다.</p>
                
                <div class="col s12">
                    <select class="browser-default col s6 offset-s6" name="open">
                        <option value="" disabled selected>전체</option>
                        <option value="1" <? if ( $open == 1 ) { echo 'selected'; }; ?>>진행중</option>
                        <option value="2" <? if ( $open == 2 ) { echo 'selected'; }; ?>>종료</option>
                    </select>
                </div>                
                
                <table class="striped">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>구분</th>                        
                            <th>제목</th>
                            <th>진행기간</th>                        
                            <th>작성일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
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
                                <a href="/admin/shop/<? echo $shop_id; ?>/event/post/detail/<? echo $row['post_id']; ?>/2">
                                <?
                                if ( isset($row['post_content_title']) && isset($row['post_content_title']) ) {
                                    echo $row['post_content_title'];
                                } else {
                                    echo '-';
                                }
                                ?>
                                </a>    
                            </td>
                            <td>
                                <?
                                if ( isset($row['post_content_open_date']) && isset($row['post_content_close_date']) ) {
                                    echo $row['post_content_open_date'].'~'.$row['post_content_close_date'];
                                } else {
                                    echo '-';
                                }
                                ?>
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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?
        if ( strlen($q) != 0 ) {
            if ( $response['status'] != 200 && ($p == 1 || $p == 0) ) {
                ?>
        <div class="row">
            <p style="text-align: center;">검색하신 내역이 없습니다.</p>
        </div>    
                <?
            };
        };        
        ?>    
        
        <div class="row">
            <? echo $this->pagination->create_links(); ?>
        </div>        
        
        <div class="row">        
            <div class="col s12">
                <a href="/admin/shop/<? echo $shop_id; ?>/event/post/0/5" class="waves-effect waves-light btn col s6 offset-s6">
                    <i class="material-icons left">edit</i>
                    글쓰기
                </a>
            </div>    
        </div>        
        
        <div class="row">
            <div class="input-field col s2">
                <select name="target">
                    <option value="" <? if ( $target == '' ) { echo 'selected'; }; ?> disabled selected>전체</option>
                    <option value="title" <? if ( $target == 'title' ) { echo 'selected'; }; ?>>제목</option>
                    <option value="article" <? if ( $target == 'article' ) { echo 'selected'; }; ?>>내용</option>
                </select>
            </div>
            <div class="input-field col s6">
                <input id="" type="text" class="validate" name="q" value="<? echo $q; ?>">
                <label for="keyword">검색어를 입력해 주세요.</label>
            </div>
            <div class="input-field col s4 right-align">
                <button type="submit" class="waves-effect waves-light btn">검색</a>
            </div>
        </div>  
    </form>    
</div>