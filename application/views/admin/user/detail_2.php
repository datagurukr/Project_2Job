<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    $row = $response['data']['out'][0];
};
?>
<div class="section">
    <h2 class="header">영업사원 회원관리</h2>    
    <div class="row">
        <div class="col s12">
            <p>투잡다모아에 가입한 영업사원 회원의 내역을 확인할 수 있습니다.</p>                    
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
                <tr>
                    <td>
                        <b>은행명</b>
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
                        <b>계좌번호</b>
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
                        <b>근로계약서</b>
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
                </tr>                
            </tbody>
        </table>         
    </div>   
    <div class="section">
        <h5 class="header">판매 및 급여내역</h5>    
        <div>
            <select name="target">
                <option value="" selected disabled selected>전체</option>
                <option value="1" >2017년 5월</option>
            </select>                
        </div>        
        <table class="striped">
            <thead>
                <tr>
                    <th>구매자명</th>
                    <th>이메일</th>
                    <th>예약번호</th>
                    <th>예약상품</th>
                    <th>금액</th>
                    <th>구매일</th>
                    <th>사용유무</th>     
                    <th>인센티브</th>                    
                </tr>
            </thead>
            <tbody>
                <?
                if ( is_array($response['data']['sale_out']) ) {
                    foreach ( $response['data']['sale_out'] as $sub_row ) {
                        ?>
                <tr>
                    <td>구매자명</td>
                    <td>이메일</td>
                    <td>예약번호</td>
                    <td>예약상품</td>
                    <td>금액</td>
                    <td>구매일</td>
                    <td>사용유무</td>     
                    <td>인센티브</td>                    
                </tr>
                        <?
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="8">판매 및 급여내역이 없습니다.</td>
                </tr>                                
                    <?
                }                
                ?>
                <tr class="tr-result">
                    <td colspan="8"><b>인센티브 합계 : </b>25,000원 (미 사용된 인센티브 합계 : 15,000원)</td>
                </tr>
            </tbody>
        </table>           
        <div>
            <div class="right-align">
                <a href="/admin/post/<? if ( isset($row['post_id']) ) { echo $row['post_id']; }; ?>/1" class="waves-effect waves-light btn">
                    급여내역 Excel 다운로드
                </a>                                             
            </div>
        </div>                
    </div>  
    <div class="section">
        <h5 class="header">활동내역</h5>    
        <div>
            <div class="right-align">
                <a href="/admin/post/<? if ( isset($row['post_id']) ) { echo $row['post_id']; }; ?>/1" class="waves-effect waves-light btn">
                    포인트 지급
                </a>                
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
                    <td colspan="8"><b>총 예약번호 내역 : </b>3개</td>
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
        <!--
        <div class="input-field col">
            <a href="/admin/user/edit/<? if ( isset($row['user_id']) ) { echo $row['user_id']; }; ?>" class="waves-effect waves-light btn">
                수정
            </a>
        </div>   
        -->
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