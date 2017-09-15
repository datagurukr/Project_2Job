<div class="section">
    <h5 class="header">일반 회원관리</h5>
    <form class="col s12" method="get" enctype="application/x-www-form-urlencoded">    
        <div class="row">
            <div class="col s12">
                <p>투잡다모아에 가입한 일반회원의 내역을 확인할 수 있습니다.</p>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>가입자명</th>
                            <th>이메일</th>
                            <th>전화번호</th>
                            <th>생년월일</th>
                            <th>주소</th>
                            <?
                            $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
                            $sort = $protocol.'://'.$_SERVER["HTTP_HOST"].'/admin/user/list/1?';
                            if ( $order == 'asc' ) {
                                $order = 'desc';                
                            } else {
                                $order = 'asc';                
                            }

                            if ( strlen($target) != 0 ) {
                                $sort = $sort.'&target='.$target;
                            };

                            if ( strlen($q) != 0 ) {
                                $sort = $sort.'&q='.$q;
                            };        

                            if ( $p != 0 ) {
                                $sort_url = $sort."&p=".$p."&order_target=level&order=".$order;
                            } else {
                                $sort_url = $sort."&order_target=user_tel&order=".$order;
                            };
                            ?>
                            <th><a href="<? echo $sort_url; ?>">레벨 <? if ( $order == 'asc' ) { echo '▼'; } else { echo '▲'; }; ?> </a></th>
                            <th>가입일</th>                        
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
                                <a href="/admin/user/<? echo $row['user_id']; ?>">
                                <?
                                if ( isset($row['user_name']) ) {
                                    echo $row['user_name'];
                                } else {
                                    echo '-';
                                }
                                ?>
                                </a>    
                            </td>
                            <td>
                                <?
                                if ( isset($row['user_email']) ) {
                                    echo $row['user_email'];
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>
                                <?
                                if ( isset($row['user_tel']) ) {
                                    echo $row['user_tel'];
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>
                                <?
                                if ( isset($row['user_birthday']) ) {
                                    echo date("Y-m-d", strtotime($row['user_birthday']));
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>                        
                            <td>
                                <?
                                if ( isset($row['user_address']) ) {
                                    
                                    $user_address = explode('|',$row['user_address']);
                                    if ( count($user_address) == 4 ) {
                                        echo $user_address[0].' '.$user_address[1].' '.$user_address[2].' '.$user_address[3];
                                    };
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>
                                <?
                                if ( isset($row['user_level']) ) {
                                    echo $row['user_level'];
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>
                                <?
                                if ( isset($row['user_register_date']) ) {
                                    echo date("Y-m-d", strtotime($row['user_register_date']));
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
            <div class="input-field col s2">
                <select name="target">
                    <option value="" <? if ( $target == '' ) { echo 'selected'; }; ?> disabled selected>전체</option>
                    <option value="name" <? if ( $target == 'name' ) { echo 'selected'; }; ?>>가임자명</option>
                    <option value="email" <? if ( $target == 'email' ) { echo 'selected'; }; ?>>이메일</option>
                    <option value="level" <? if ( $target == 'level' ) { echo 'selected'; }; ?>>레벨</option>                
                </select>
            </div>
            <div class="input-field col s6">
                <input id="" type="text" class="validate" name="q" value="<? echo $q; ?>">
                <label for="keyword">검색어를 입력하세요.</label>
            </div>
            <div class="input-field col s4 right-align">
                <button type="submit" class="waves-effect waves-light btn">검색</a>
            </div>
        </div>    
    </form>    
</div>