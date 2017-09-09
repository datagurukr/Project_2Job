<div class="section">
    <h5 class="header">가맹정 회원관리</h5>
    <div class="row">
        <div class="col s12">
            <p>투잡다모아에 가입한 가맹점 회원의 내역을 확인할 수 있습니다.</p>
            <table class="striped">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>상호명</th>
                        <th>사업자등록번호</th>
                        <th>대표자명</th>
                        <th>이메일</th>
                        <th>전화번호</th>
                        <th>가입일</th>
                        <th>승인여부</th>                        
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
                            if ( isset($row['user_business_entity_name']) ) {
                                echo $row['user_business_entity_name'];
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                        <td>
                            <?
                            if ( isset($row['user_business_license_number']) ) {
                                echo $row['user_business_license_number'];
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                        <td>
                            <?
                            if ( isset($row['user_business_representative']) ) {
                                echo $row['user_business_representative'];
                            } else {
                                echo '-';
                            }
                            ?>
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
                            if ( isset($row['user_register_date']) ) {
                                echo date("Y-m-d", strtotime($row['user_register_date']));
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>  
                        <td>
                            <?
                            if ( isset($row['user_state']) ) {
                                if ( $row['user_state'] == 1 ) {
                                    echo '승인';
                                } else {
                                    echo '승인안함';
                                }
                            } else {
                                echo '알수없음';
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
</div>