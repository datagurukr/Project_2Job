<div class="section">
    <h5 class="header">영업사원 회원관리</h5>
    <div class="row">
        <div class="col s12">
            <p>투잡다모아에 가입한 영업사원 회원의 내역을 확인할 수 있습니다.</p>
            <table class="striped">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>가입자명</th>
                        <th>이메일</th>
                        <th>전화번호</th>
                        <th>은행명</th>
                        <th>계좌번호</th>
                        <th>레벨</th>
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
                            <?
                            if ( isset($row['user_name']) ) {
                                echo $row['user_name'];
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
                            if ( isset($row['user_bank_name']) ) {
                                echo $row['user_bank_name'];
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
                                echo $row['user_employment_contract'];
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
</div>