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
                    for ( $i = 0; $i < 20; $i++ ) {
                        ?>
                    <tr>
                        <td><? echo $i; ?></td>
                        <td>가입자명</td>
                        <td>이메일</td>
                        <td>전화번호</td>
                        <td>은행명</td>
                        <td>계좌번호</td>
                        <td>레벨</td>
                        <td>근로계약서</td>
                        <td>가입일</td>                         
                    </tr>
                        <?
                    }
                    /*
                    foreach ( $out as $row ) {
                        ?>
                    <tr>
                        <td><? echo $row['num']; ?></td>
                        <td><? echo $row['user_name']; ?></td>
                        <td><? echo $row['user_email']; ?></td>
                        <td><? echo $row['user_tel']; ?></td>
                        <td><? echo $row['user_birthday']; ?></td>
                        <td><? echo $row['user_address']; ?></td>
                        <td><? echo $row['user_level']; ?></td>
                        <td><? echo $row['user_register_date']; ?></td>                        
                    </tr>
                        <?
                    }
                    */
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>