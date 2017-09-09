<div class="section">
    <h5 class="header">공지사항 관리</h5>
    <div class="row">
        <div class="col s12">
            <p>공지사항을 관리할 수 있습니다.</p>
            <table class="striped">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>작성일</th>
                        <th>조회수</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    for ( $i = 0; $i < 20; $i++ ) {
                        ?>
                    <tr>
                        <td><? echo $i; ?></td>
                        <td>제목</td>
                        <td>작성일</td>
                        <td>조회수</td>
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