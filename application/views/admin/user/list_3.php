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
                    for ( $i = 0; $i < 20; $i++ ) {
                        ?>
                    <tr>
                        <td><? echo $i; ?></td>
                        <td>상호명</td>
                        <td>사업자등록번호</td>
                        <td>대표자명</td>
                        <td>이메일</td>
                        <td>전화번호</td>
                        <td>가입일</td>
                        <td>승인여부</td>
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