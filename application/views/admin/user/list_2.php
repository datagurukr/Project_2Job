<div class="section">
    <h5 class="header">영업사원 회원관리</h5>
    <form class="col s12" method="get" enctype="application/x-www-form-urlencoded">        
        <div class="row">
            <div class="col s12">
                <p>투잡다모아에 가입한 영업사원 회원의 내역을 확인할 수 있습니다.</p>
                
                
                <div class="col s12">
                    <select class="browser-default col s6 offset-s6" name="yearmonth">
                        <option value="" disabled selected>전체</option>
                        <option value="2017-09" <? if ( $yearmonth == '2017-09' ) { echo 'selected'; }; ?>>2017년 9월</option>
                        <option value="2017-08" <? if ( $yearmonth == '2017-08' ) { echo 'selected'; }; ?>>2017년 8월</option>
                        <option value="2017-07" <? if ( $yearmonth == '2017-07' ) { echo 'selected'; }; ?>>2017년 7월</option>
                    </select>
                </div>    
                
                <table class="striped">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>가입자명</th>
                            <th>이메일</th>
                            <th>전화번호</th>
                            <th>은행명</th>
                            <th>계좌번호</th>
                            <?
                            $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
                            $sort = $protocol.'://'.$_SERVER["HTTP_HOST"].'/admin/user/list/2?';
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
                            <th>근로계약서</th>
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
                                if ( isset($row['user_bank_name']) ) {
                                    $bank = array(
                                        array('국민은행(004)','004'),
                                        array('신한은행(088)','088'),
                                        array('우리은행(020)','020'),
                                        array('KEB하나은행(081)','081'),
                                        array('한국씨티은행(027, 외국계)','027'),
                                        array('한국스탠다드차타드은행(023, 외국계)','023'),
                                        array('케이뱅크(089)','089'),
                                        array('카카오뱅크(090)','090'),
                                        array('중소기업은행(003)','003'),
                                        array('NH농협은행(011)','011'),
                                        array('한국산업은행(002)','002'),
                                        array('수협은행(007)','007'),                            
                                        array('한국수출입은행(008)','008'),
                                        array('경남은행(039)','039'),
                                        array('광주은행(034)','034'),
                                        array('대구은행(031)','031'),
                                        array('부산은행(032)','032'),
                                        array('전북은행(037)','037'),
                                        array('제주은행(035)','035'),
                                        array('우체국(071)','071')
                                    );  
                                    
                                    foreach ( $bank as $bank_row ) {
                                        if ( $bank_row[1] == $row['user_bank_name'] ) { echo $bank_row[0]; }
                                        break;
                                    };
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>
                                <?
                                if ( isset($row['user_bank_number']) ) {
                                    echo $row['user_bank_number'];
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
                                if ( isset($row['user_employment_contract']) ) {
                                    ?>
                                <a href=""><i class="material-icons">file_download</i></a>
                                    <?
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
            <div class="col s12">
                <a class="waves-effect waves-light btn col s6 offset-s6">
                    <i class="material-icons left">file_download</i>
                    급여내역 Excel 다운로드
                </a>
            </div>    
        </div>
        
        <div class="row">
            <div class="input-field col s2">
                <select name="target">
                    <option value="" <? if ( $target == '' ) { echo 'selected'; }; ?> disabled selected>전체</option>
                    <option value="name" <? if ( $target == 'name' ) { echo 'selected'; }; ?>>가입자명</option>
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