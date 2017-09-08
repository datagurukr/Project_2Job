<div class="section">
    <h5 class="header">일반 회원관리</h5>
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
                        <th>레벨</th>
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
                        <td>생년월일</td>
                        <td>주소</td>
                        <td>라벨</td>
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