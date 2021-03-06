<div class="section">
    <h5 class="header">가맹점 관리</h5>
    <form class="col s12" method="get" enctype="application/x-www-form-urlencoded">        
        <div class="row">
            <div class="col s12">
                <p>투잡다모아의 가맹점을 관리할 수 있습니다.</p>
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
                            <th colspan="2">가맹점종류</th>                        
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
                                <a href="/admin/shop/<? echo $row['user_id']; ?>">
                                <?
                                if ( isset($row['user_business_entity_name']) ) {
                                    echo $row['user_business_entity_name'];
                                } else {
                                    echo '-';
                                }
                                ?>
                                </a>    
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
                                <select>
                                    <option value="" selected disabled selected>선택</option>
                                    <option value="1" >일하기 편한 추천 가맹점</option>
                                    <option value="1" >추천 가맹점</option>
                                    <option value="1" >일반 가맹점</option>                                    
                                </select>                                
                            </td>                         
                            <td>
                                <select>
                                    <option value="" selected disabled selected>선택</option>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>                                    
                                    <option value="4" >4</option>                                    
                                    <option value="5" >5</option>                                    
                                    <option value="6" >6</option>                                    
                                    <option value="7" >7</option>                                    
                                    <option value="8" >8</option>                                    
                                    <option value="9" >9</option> 
                                    <option value="10" >10</option> 
                                </select>                                
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
            <div class="input-field col s2">
            </div>
            <div class="input-field col s6">
            </div>
            <div class="input-field col s4 right-align">
                <button type="submit" class="waves-effect waves-light btn">적용</a>                
            </div>
        </div>         
        
        <div class="row">
            <? echo $this->pagination->create_links(); ?>
        </div>        
        
        <div class="row">
            <div class="input-field col s2">
                <select name="target">
                    <option value="" <? if ( $target == '' ) { echo 'selected'; }; ?> disabled selected>전체</option>
                    <option value="business_entity_name" <? if ( $target == 'business_entity_name' ) { echo 'selected'; }; ?>>상호명</option>
                    <option value="business_license_number" <? if ( $target == 'business_license_number' ) { echo 'selected'; }; ?>>사업자등록번호</option>
                    <option value="business_representative" <? if ( $target == 'business_representative' ) { echo 'selected'; }; ?>>대표자명</option>                
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