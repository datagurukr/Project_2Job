<div class="section">
    <h5 class="header">탈퇴 회원관리</h5>
    <div class="row">
        <div class="col s12">
            <p>투잡다모아에 회원 중 탈퇴한 회원의 내역을 확인할 수 있습니다.</p>
            <table class="striped">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>구분</th>
                        <th>상호명</th>
                        <th>가입자명(대표자명)</th>
                        <th>이메일</th>
                        <th>전화번호</th>
                        <th>레벨</th>
                        <th>가입일</th>
                        <th>탈퇴일</th>
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
                            if ( isset($row['user_status']) ) {
                                if ( $row['user_status'] == 1 ) {
                                    echo '일반';
                                } elseif ( $row['user_status'] == 2 ) {
                                    echo '영업';
                                } elseif ( $row['user_status'] == 3 ) {
                                    echo '가맹점';
                                }
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
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
                            if ( isset($row['user_name']) ) {
                                echo $row['user_name'];
                            } else {
                                echo '-';
                            }
                            ?>
                            <?
                            if ( isset($row['user_business_representative']) ) {
                                echo '('.$row['user_business_representative'].')';
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
                        <td>
                            <?
                            if ( isset($row['user_update_date']) ) {
                                echo date("Y-m-d", strtotime($row['user_update_date']));
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
</div>