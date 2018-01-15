<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    $row = $response['data']['out'][0];
};
?>
<div class="section">
    <h2 class="header">가맹점 회원관리</h2>    
    <div class="row">
        <div class="col s12">
            <p>투잡다모아에 가입한 가맹점 회원의 내역을 확인할 수 있습니다.</p>                    
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
                        <b>상호명</b>
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
                        <b>사업자등록번호</b>
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
                        <b>대표자명</b>
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
                        <b>주소</b>
                    </td>
                    <td colspan="6">
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
                        <b>이메일</b>
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
                        <b>전화번호</b>
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
                        <b>승인여부</b>
                    </td>
                    <td>
                        <?
                        $flag = FALSE;
                        if ( isset($row['user_approval']) ) {
                            if ( $row['user_approval'] == 1 ) {
                                ?>
                        <button class="btn" disabled>승인완료</button>                                    
                                <?
                            } else {
                                $flag = TRUE;                                    
                            }
                        } else {
                            $flag = TRUE;                                                                
                        };
                        
                        if ( $flag ) {
                            ?>
                        <!-- Modal Trigger -->
                        <a class="waves-effect waves-light btn modal-trigger right" href="#modal1">승인대기</a>

                        <!-- Modal Structure -->
                        <div id="modal1" class="modal">
                            <form method="post" enctype="application/x-www-form-urlencoded">
                                <input type="hidden" name="user_id" value="<? echo $row['user_id']; ?>">                                
                                <input type="hidden" name="user_approval" value="1">
                                <div class="modal-content">
                                    <h4>알림</h4>
                                    <p>해당 가맹점을 승인처리 하시겠습니까?</p>                            
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
                    </td>                    
                </tr>
                <tr>
                    <td>
                        <b>업체정보</b>
                    </td>
                    <td colspan="6">
                        <p>다른 스타벅스랑 다르게 실내 분위기가  아주 따뜻하고 편안합니다. 스타벅스는 세계에서 가장 큰 다국적 커피 전문점이다.</p>
                        
                        <b>업체 통계</b>
                        <ul>
                            <li>
                                <p>
                                    <span>생성된 예약번호</span>
                                    <span>3,215개</span>
                                </p>    
                            </li>
                            <li>
                                <p>                                
                                    <span>판매 완료된 예약번호</span>
                                    <span>324개</span>
                                </p>    
                            </li>
                            <li>
                                <p>                                                                
                                    <span>즐겨찾는 가맹점 수</span>
                                    <span>512개</span>
                                </p>    
                            </li>
                        </ul>
                        
                        <b>이벤트</b>
                        <ul>
                            <li>
                                <p>스타벅스 여의도지점 이벤트 응모하세요~다양한 선물이...   170510</p>
                            </li>
                        </ul>
                        
                        <b>영업정보</b>
                        <ul>
                            <li>
                                <p>
                                    <span>영업시간</span>
                                    <span>매일 오전 10:00 ~ 오후 09:00</span>
                                </p>    
                            </li>
                            <li>
                                <p>                                
                                    <span>예약문의</span>
                                    <span>02-2222-3333</span>
                                </p>    
                            </li>
                        </ul>                        
                        
                        <b>위치정보</b>
                        
                        <b>사업자정보</b>
                        <ul>
                            <li>
                                <p>
                                    <span>상호명</span>
                                    <span>스타벅스 여의도지점</span>
                                </p>    
                            </li>
                            <li>
                                <p>                                
                                    <span>사업자등록번호</span>
                                    <span>11-22-33333</span>
                                </p>    
                            </li>
                        </ul> 
                        
                    </td>                    
                </tr>    
            </tbody>
        </table>         
    </div>   
    <div class="section">
        <h5 class="header">매출 및 인센티브</h5>    
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
                    <td colspan="8">매출 및 인센티브 내역이 없습니다.</td>
                </tr>                                
                    <?
                }                
                ?>
                <tr class="tr-result">
                    <td colspan="8">
                        <b>예약금액 : </b>180,000원 ㅣ <b>실제 매출액 : </b>18,000원 ㅣ <b>납입금 : </b>1,800원
                    </td>
                </tr>                
            </tbody>
        </table>           
    </div>  
    <div class="section">
        <h5 class="header">상품관리</h5>    
        <div>
            <select name="target">
                <option value="" selected disabled selected>전체</option>
                <option value="1" >2017년 5월</option>
            </select>                
        </div>        
        <table class="striped">
            <thead>
                <tr>
                    <th>상품명</th>
                    <th>이미지</th>
                    <th>가격</th>
                    <th>옵션</th>                    
                    <th>사용기한</th>                                        
                    <th>판매 인센티브</th>                    
                    <th>등록일</th>                    
                    <th>판매여부</th>                                        
                </tr>
            </thead>
            <tbody>
                <?
                if ( is_array($response['data']['active_out']) ) {
                    foreach ( $response['data']['active_out'] as $sub_row ) {
                        ?>
                <tr>
                    <td>상품명</td>
                    <td>이미지</td>
                    <td>가격</td>
                    <td>옵션</td>                    
                    <td>사용기한</td>                                        
                    <td>판매 인센티브</td>                    
                    <td>등록일</td>                    
                    <td>판매여부</td>                                        
                </tr>               
                        <?
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="8">등록된 상품이 없습니다.</td>
                </tr>                                
                    <?
                }                
                ?>
            </tbody>
        </table>        
    </div>        
    <div class="section">
        <h5 class="header">이벤트 관리</h5>    
        <table class="striped">
            <thead>
                <tr>
                    <th>구분</th>
                    <th>제목</th>
                    <th>진행기간</th>
                    <th>작성일</th>
                    <th>조회수</th>
                </tr>
            </thead>
            <tbody>
                <?
                if ( is_array($response['data']['booking_out']) ) {
                    foreach ( $response['data']['booking_out'] as $sub_row ) {
                        ?>
                <tr>
                    <td>구분</td>
                    <td>제목</td>
                    <td>진행기간</td>
                    <td>작성일</td>
                    <td>조회수</td>
                </tr>
                        <?
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="8">등록된 이벤트가 없습니다.</td>
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