<?
$session_out = FALSE;
$row = FALSE;
if ( $response['data']['session_out'] ) {
    $session_out = $response['data']['session_out'][0];
};
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<nav class="navbar navbar-default navbar-fixed-top navbar-slide" id="navbar-collapse-menu" style="display: none;">
    <div class="top">
        <div class="container">
            <div class="logo text-center">
                <img src="/assets/images/logo.png">
            </div>
            <?
            if ( $session_id == 0 ) {
                ?>
            <!--로그아웃-->
            <p class="text-center">
                지금 바로 회원가입하시고 투잡다모아의 모든 제휴업체에서 직원 혜택을 누려보세요
            </p>
            <div class="row">
                <div class="col s6 text-right">
                    <a href="/login" class="btn primary-btn">로그인</a>
                </div>
                <div class="col s6 text-left">
                    <a href="/register" class="btn primary-btn">회원가입</a>
                </div>
            </div>
                <?
            } else {
                ?>
            <!--로그인-->            
            <h6 class="text-center welcome">
                <? if ( isset($session_out['user_name']) ) { echo $session_out['user_name']; } ?> 님, 반갑습니다!<br>
                <small>LV . <? if ( isset($session_out['user_level']) ) { echo $session_out['user_level']; } ?></small>
            </h6>
            <div class="row">
                <div class="col s8">
                    <p><span><img src="assets/images/dot.png"></span>
                    이용 가능한 직권 할인율</p>
                </div>
                <div class="col s4">
                    <p><span><? if ( isset($session_out['user_discount']) ) { echo $session_out['user_discount']; } else { echo '0'; }; ?>%</span></p>
                </div>
                <div class="col s8">
                    <p><span><img src="assets/images/dot.png"></span>
                    이번 달 나의 월급</p>
                </div>
                <div class="col s4">
                    <p><span><? if ( isset($session_out['user_salary']) ) { echo number_format($session_out['user_salary']); } else { echo '0'; } ?>원</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col s6 text-right">
                    <a href="/user/active/salary" class="btn primary-btn">급여내역</a>
                </div>
                <div class="col s6 text-left">
                    <a href="/logout" class="btn primary-btn">로그아웃</a>
                </div>
            </div>            
                <?                
            };
            ?>
        </div>
        <ul class="row text-center">
            <li class="col s3">
                <a href="/user/notice">알림</a>
            </li>
            <li class="col s3">
                <a href="/user/setting">설정</a>
            </li>
            <li class="col s6">
                <a href="/user/active/booking">예약번호사용조회</a>
            </li>
        </ul>
    </div>
    <div class="list-wrap">
        <div class="list-row">
            <a href="/user/bookmark">
                <h6><img src="/assets/images/ham-bookmark.png">즐겨찾는 가맹점</h6>
            </a>
        </div>
        <div class="list-row">
            <a href="/report">
                <h6><img src="/assets/images/ham-alert.png">가맹점 직거래 신고하기</h6>
            </a>
        </div>
        <div class="list-row">
            <a href="/user/active">
                <h6><img src="/assets/images/ham-history.png">나의 활동 내역</h6>
            </a>
        </div>
        <div class="list-row">
            <a href="/notice">
                <h6><img src="/assets/images/ham-notice.png">공지사항</h6>
            </a>
        </div>
        <div class="list-row">
            <a href="/event">
                <h6><img src="/assets/images/ham-event.png">이벤트</h6>
            </a>
        </div>
        <div class="list-row">
            <a href="/qna">
                <h6><img src="/assets/images/ham-question.png">자주 묻는 질문</h6>
            </a>
        </div>
        <div class="list-row">
            <a href="/customer">
                <h6><img src="/assets/images/ham-call.png">고객센터</h6>
            </a>
        </div>
    </div>
</nav>
<div class="wrap" id="hideMenu">
    <div class="login-header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/back_button.png">
                </a>
                <h6><strong>알림</strong></h6>
            </div>
            <div class="hamburgermenu">
                <button type="button" id="showMenu">
                    <img src="/assets/images/menu.png">
                </button>
            </div>
        </div>
    </div>
    <div class="container" id="container">
        <form method="post" enctype="application/x-www-form-urlencoded">                
            <input type="hidden" name="user_name" value="name">
            <div class="row setupnoti-row">
                <div class="col s10">
                    <h6>예약정보 받기</h6>
                </div>
                <div class="col s2 text-right">
                    <div class="form-check">
                      <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_reservation_status" value="1" <? if ( $row['user_notice_reservation_status'] == 1 ) { echo 'checked'; }; ?>>
                      </label>
                    </div>
                </div>
                <div class="col s12">
                    <span>투잡다모아에서 구매한 내역의 예약정보를 받아볼 수 있습니다.</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s10">
                    <h6>이벤트 등록 시</h6>
                </div>
                <div class="col s2 text-right">
                    <div class="form-check">
                      <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_event_status" value="1" <? if ( $row['user_notice_event_status'] == 1 ) { echo 'checked'; }; ?>>
                      </label>
                    </div>
                </div>
                <div class="col s12">
                    <span>투잡다모아의 이벤트 또는 가맹점들의 다양한 이벤트 정보를 받아볼 수 있습니다.</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s10">
                    <h6>관리자 메시지</h6>
                </div>
                <div class="col s2 text-right">
                    <div class="form-check">
                      <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_admin_status" value="1" <? if ( $row['user_notice_admin_status'] == 1 ) { echo 'checked'; }; ?>>
                      </label>
                    </div>
                </div>
                <div class="col s12">
                    <span>투잡다모아의 관리자 특별 공지를 받아볼 수 있습니다.</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s10">
                    <h6>신규 가맹점 입점 시</h6>
                </div>
                <div class="col s12">
                    <span>내 소재지 근처에 신규로 입점한 가맹점의 정보를 받아볼 수 있습니다.</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="서울특별시" <? if(strpos($row['user_notice_shop_status'], '서울특별시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>서울특별시</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="대구광역시" <? if(strpos($row['user_notice_shop_status'], '대구광역시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>대구광역시</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="대전광역시" <? if(strpos($row['user_notice_shop_status'], '대전광역시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>대전광역시</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="광주광역시" <? if(strpos($row['user_notice_shop_status'], '광주광역시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>광주광역시</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="인천광역시" <? if(strpos($row['user_notice_shop_status'], '인천광역시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>인천광역시</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="울산광역시" <? if(strpos($row['user_notice_shop_status'], '울산광역시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>울산광역시</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="부산광역시" <? if(strpos($row['user_notice_shop_status'], '부산광역시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>부산광역시</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="세종시" <? if(strpos($row['user_notice_shop_status'], '세종시') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>세종시</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="경기도" <? if(strpos($row['user_notice_shop_status'], '경기도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>경기도</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="강원도" <? if(strpos($row['user_notice_shop_status'], '강원도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>강원도</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="경상북도" <? if(strpos($row['user_notice_shop_status'], '경상북도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>경상북도</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="경상남도" <? if(strpos($row['user_notice_shop_status'], '경상남도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>경상남도</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="충청북도" <? if(strpos($row['user_notice_shop_status'], '충청북도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>충청북도</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="충청남도" <? if(strpos($row['user_notice_shop_status'], '충청남도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>충청남도</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="전라북도" <? if(strpos($row['user_notice_shop_status'], '전라북도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>전라북도</span>
                </div>
            </div>
            <div class="row setupnoti-row">
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="전라남도" <? if(strpos($row['user_notice_shop_status'], '전라남도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>전라남도</span>
                </div>
                <div class="col s4">
                    <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="user_notice_shop_status[]" value="제주도" <? if(strpos($row['user_notice_shop_status'], '제주도') !== false) { echo 'checked'; }; ?>>
                    </label>
                    <span>제주도</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col s12 text-center">
                    <button type="submit" class="btn primary-btn">정보수정</button>
                </div>
            </div>
            
        </form>    
    </div>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>