<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    $row = $response['data']['out'][0];
};
?>
<div class="section">
    <h2 class="header">일반 회원관리</h2>    
    <div class="row">
        <div class="col s12">
            <p>투잡다모아에 가입한 일반회원의 내역을 확인할 수 있습니다.</p>                    
        </div>
    </div>    
    <div class="section">
        <h5 class="header">기본정보</h5>
        <div>
            <div class="right-align">
                <b>회원가입일 : </b>
                <span>
                    <?
                    if ( isset($row['user_register_date']) ) {
                        echo $row['user_register_date'];
                    } else {
                        echo '-';
                    }
                    ?>                    
                </span>
            </div>
        </div>        
        <table>
            <tbody>
                <tr>
                    <td>
                        <b>가입자명</b>
                    </td>
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
                        <b>이메일</b>
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
                        <b>전화번호</b>
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
                </tr>
                <tr>
                    <td>
                        <b>생년월일</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['user_birthday']) ) {
                            echo $row['user_birthday'];
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                    <td>
                        <b>주소</b>
                    </td>
                    <td colspan="4">
                        <?
                        if ( isset($row['user_address']) ) {
                            echo $row['user_address'];
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>                
            </tbody>
        </table>         
  
    </div>   
    <div class="section">
        <h5 class="header">활동내역</h5>    
        <div>
            <div class="right-align">
                <b>레벨 : </b>
                <span>
                    <?
                    if ( isset($row['user_level']) ) {
                        echo 'LV'.$row['user_level'];
                    } else {
                        echo '-';
                    }
                    ?>                    
                </span>
            </div>
        </div>        
        <table class="striped">
            <thead>
                <tr>
                    <th>활동내역</th>
                    <th>세부항목</th>
                    <th>포인트</th>
                    <th>날짜</th>                    
                </tr>
            </thead>
            <tbody>
                <?
                if ( is_array($response['data']['active_out']) ) {
                    foreach ( $response['data']['active_out'] as $sub_row ) {
                        ?>
                <tr>
                    <td>활동내역</td>
                    <td>세부항목</td>
                    <td>포인트</td>
                    <td>날짜</td>                    
                </tr>                
                        <?
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="4">활동내역이 없습니다.</td>
                </tr>                                
                    <?
                }                
                ?>
                <tr class="tr-result">
                    <td colspan="4"><b>포인트 합계 : </b>15,000pt</td>
                </tr>                                                
            </tbody>
        </table>        
        
    </div>        
    <div class="section">
        <h5 class="header">예약번호 발급/사용</h5>    
        <div>
            <select name="target">
                <option value="" selected disabled selected>전체</option>
                <option value="1" >사용</option>
                <option value="2" >미사용</option>
                <option value="3" >취소</option>                
            </select>                
        </div>        
        <table class="striped">
            <thead>
                <tr>
                    <th>가맹점명</th>
                    <th>연락처</th>
                    <th>예약번호</th>
                    <th>예약상품</th>
                    <th>금액</th>
                    <th>포인트</th>
                    <th>예약일자</th>     
                    <th>사용여부</th>                    
                </tr>
            </thead>
            <tbody>
                <?
                if ( is_array($response['data']['booking_out']) ) {
                    foreach ( $response['data']['booking_out'] as $sub_row ) {
                        ?>
                <tr>
                    <td>가맹점명</td>
                    <td>연락처</td>
                    <td>예약번호</td>
                    <td>예약상품</td>
                    <td>금액</td>
                    <td>포인트</td>
                    <td>예약일자</td>     
                    <td>사용여부</td>
                </tr>
                        <?
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="8">예약번호 발급/사용 내역이 없습니다.</td>
                </tr>                                
                    <?
                }                
                ?>
                <tr class="tr-result">
                    <td colspan="4"><b>총 예약번호 내역 : </b>1개</td>
                </tr>                                                                
            </tbody>
        </table>           
    </div>        
    <div class="section">
        <h5 class="header">추천인</h5>    
        <table class="striped">
            <thead>
                <tr>
                    <th>가입자명</th>
                    <th>연락처</th>
                    <th>이메일</th>
                    <th>레벨</th>
                    <th>가입일자</th>
                </tr>
            </thead>
            <tbody>
                <?
                if ( is_array($response['data']['recommender_out']) ) {
                    foreach ( $response['data']['recommender_out'] as $sub_row ) {
                        ?>
                <tr>
                    <td>가입자명</td>
                    <td>연락처</td>
                    <td>이메일</td>
                    <td>레벨</td>
                    <td>가입일자</td>
                </tr>
                        <?
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="5">추천인이 없습니다.</td>
                </tr>                                
                    <?
                }                
                ?>
            </tbody>
        </table>           
    </div>            
    
    <div class="row">        
        <div class="input-field col">

            <?
            $flag = FALSE;
            if ( isset($row['user_state']) ) {
                if ( $row['user_state'] == 9 ) {
                    ?>
            <button class="btn" disabled>탈퇴처리됨</button>            
                    <?
                } else {
                    $flag = TRUE;                                    
                }
            };

            if ( $flag ) {
                ?>
            <!-- Modal Trigger -->
            <a class="waves-effect waves-light btn modal-trigger right" href="#modal2">탈퇴처리</a>

            <!-- Modal Structure -->
            <div id="modal2" class="modal">
                <form method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="user_id" value="<? echo $row['user_id']; ?>">                                
                    <input type="hidden" name="user_state" value="9">
                    <div class="modal-content">
                        <h4>알림</h4>
                        <p>해당 가맹점을 탈퇴처리 하시겠습니까?</p>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-close waves-effect waves-red btn-flat">취소</button>
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">확인</button>
                    </div>
                </form>
            </div>                        
                <?
            }
            ?>              
            
        </div>    
        <div class="input-field col">
            <?
            $referer = @$_SERVER['HTTP_REFERER'];
            if ( isset($_GET['referer']) ) {
                $referer = $_GET['referer'];
            };
            ?>            
            <button type="button" class="waves-effect waves-light btn" onclick="history.back()">목록</button>
        </div>          
    </div>       
</div>