<div class="section">
    <h5 class="header">상품관리 관리</h5>
    <form class="col s12" method="get" enctype="application/x-www-form-urlencoded">        
        <div class="row">
            <div class="col s12">
                <p>신규상품 및 등록상품을 관리할 수 있습니다.</p>
                
                <div class="col s12">
                    <select class="browser-default col s6 offset-s6" name="open">
                        <option value="" disabled selected>전체</option>
                        <option value="1" <? if ( $open == 1 ) { echo 'selected'; }; ?>>판매중</option>
                        <option value="2" <? if ( $open == 2 ) { echo 'selected'; }; ?>>판매중지</option>
                    </select>
                </div>                
                
                <table class="striped">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>구분</th>                        
                            <th>상품명</th>
                            <th>가격</th>                        
                            <th>옵션</th>
                            <th>사용기간</th>
                            <th>등록일</th>                            
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
                                <?
                                if ( $row['product_state'] == 1 ) {
                                    echo '판매중';
                                } else {
                                    echo '판매중지';
                                }
                                ?>
                            </td>                               
                            <td>
                                <a href="/admin/shop/<? echo $shop_id; ?>/product/<? echo $row['product_id']; ?>">
                                <?
                                if ( isset($row['product_name']) ) {
                                    echo $row['product_name'];
                                } else {
                                    echo '-';
                                }
                                ?>
                                </a>    
                            </td>
                            <td>
                                <?
                                if ( isset($row['product_price']) ) {
                                    echo number_format($row['product_price']);
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td> 
                            <td>
                                <?
                                if ( isset($row['product_option']) ) {
                                    if ( is_array($row['product_option']) ) {
                                        $j = 0;
                                        foreach ( $row['product_option'] as $option_row ) {
                                            if ( isset($option_row['name']) ) {
                                                if ( strlen($option_row['name']) != 0 ) {
                                                    if ( $j == 0 ) {
                                                        echo $option_row['name'];
                                                    } else {
                                                        echo ','.$option_row['name'];
                                                    };
                                                    $j++;
                                                };
                                            };
                                        };
                                    };
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>    
                            <td>
                                <?
                                if ( isset($row['product_life_open_date']) && isset($row['product_life_close_date']) ) {
                                    echo $row['product_life_open_date'].'~'.$row['product_life_close_date'];
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>   
                            <td>
                                <?
                                if ( isset($row['product_register_date']) ) {
                                    echo $row['product_register_date'];
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
                <a href="/admin/shop/<? echo $shop_id; ?>/product/0" class="waves-effect waves-light btn col s6 offset-s6">
                    <i class="material-icons left">edit</i>
                    상품등록
                </a>
            </div>    
        </div>        
        
        <!--
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
        -->
    </form>    
</div>