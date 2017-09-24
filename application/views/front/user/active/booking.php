<?
$session_out = FALSE;
$out = FALSE;
$out_cnt = 0;
if ( isset($response['data']['out']) ) {
    $out = $response['data']['out'];
};
if ( isset($response['data']['out_cnt']) ) {
    $out_cnt = $response['data']['out_cnt'];
};
if ( $response['data']['session_out'] ) {
    $session_out = $response['data']['session_out'][0];
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
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/back_button.png">
                </a>
                <h6><strong>나의 활동내역</strong></h6>
            </div>
            <div class="hamburgermenu">
                <button type="button" id="showMenu">
                    <img src="/assets/images/menu.png">
                </button>
            </div>
        </div>
    </div>
    <div class="mypage-list-wrap" id="container">
        <div class="list-tab ">
            <div class="tab">
                <a href="/user/active/all" class="text-center">종합</a>
            </div>
            <div class="tab tab-active">
                <a href="/user/active/booking" class="text-center">예약번호 발급/사용</a>
            </div>
            <div class="tab tab">
                <a href="/user/active/recommender" class="text-center">추천인</a>
            </div>
            <div class="tab">
                <a href="/user/active/salary" class="text-center">급여내역</a>
            </div>
        </div>
        <div class="container">
            <div class="row row-mypage-res">
                <div class="col s8">
                    <h6>
                        총 예약번호 내역(<span><? echo $out_cnt; ?></span>개)
                    </h6>
                </div>
                <div class="col s4">
                    <form method="get" enctype="application/x-www-form-urlencoded">
                        <?
                        if ( isset($_GET['state']) ) {
                            $state = $_GET['state'];
                        } else {
                            $state = 0;
                        }
                        ?>
                        <select class="form-element on-reload-select" name="state">
                            <option value="0" <? if ( $state == 0 ) { echo 'selected'; }; ?>>전체</option>
                            <option value="1" <? if ( $state == 1 ) { echo 'selected'; }; ?>>미사용</option>
                            <option value="2" <? if ( $state == 2 ) { echo 'selected'; }; ?>>사용</option>
                            <option value="3" <? if ( $state == 3 ) { echo 'selected'; }; ?>>취소</option>                        
                        </select>
                    </form>
                </div>
            </div>
        </div>
        
        <?
        if ( $response['status'] == 200 ) {
            if ( 0 < $response['data']['count'] ) {
                $temp = ((($p * 2) * 10) - 20 ); 
                $num = $response['data']['out_cnt'] - $temp; 
                foreach ( $response['data']['out'] as $row ) {
                    // $num; $num--;
                        ?>
        <div class="list-row list-res-row">
            <a href="#!">
                <h6>가맹점 명: <span><? echo $row['user_business_entity_name']; ?></span></h6>
                <h6>연락처: <span><? echo $row['user_tel']; ?></span></h6>
                <h6>예약번호: <span><? echo $row['booking_id']; ?></span></h6>
                <h6>예약상품</h6>
                
                <?
                $booking_option = '';
                if ( $row['booking_content'] ) {
                    foreach ( $row['booking_content'] as $basket_row ) {
                        if ($basket_row['basket_content']['option_name']) {
                            $i = 0;
                            foreach ( $basket_row['basket_content']['option_count'] as $option_row ) {
                                if ( 0 < $option_row ) {
                                    if ( $i == 0 ) {
                                        $booking_option = $booking_option.''.$basket_row['basket_content']['option_name'][$i];
                                    } else {
                                        $booking_option = $booking_option.','.$basket_row['basket_content']['option_name'][$i];
                                    };
                                };
                                $i++;
                            };
                        };
                        ?>
                <span><? echo $basket_row['product_name']; ?> [옵션: <? if ( strlen($booking_option) == 0 ) { echo '없음'; } else { echo $booking_option; }; ?>]</span><br>
                        <?
                    };
                };
                ?>
                <!--
                <span>자바칩 프라푸치노 [옵션: 휘핑크림]</span><br>
                <span>콜드브루 [옵션: 없음]</span>
                -->
                <h6>금액: <span><? echo number_format($row['booking_price'] - $row['booking_discount']); ?>원</span></h6>
                <p class="text-right">
                    <small>사용여부: <? if ( $row['booking_state'] == 2 ) { echo '사용'; } else { echo '미사용'; } ?></small><br>
                    <?
                    if ( $row['booking_state'] == 2 ) {
                        ?>
                    <small><? echo date("Y-m-d", strtotime($row['booking_register_date'])); ?></small>                    
                        <?
                    };
                    ?>
                </p>
            </a>
        </div>        
                        <?
                };
            };
        }
        ?>        
        
        <!--
        <div class="list-row list-res-row">
            <a href="#!">
                <h6>가맹점 명: <span>스타벅스 여의도 지점</span></h6>
                <h6>연락처: <span>02-3333-3333</span></h6>
                <h6>예약번호: <span>363273232</span></h6>
                <h6>예약상품</h6>
                <span>자바칩 프라푸치노 [옵션: 휘핑크림]</span><br>
                <span>콜드브루 [옵션: 없음]</span>
                <h6>금액: <span>14,000원</span></h6>
                <p class="text-right">
                    <small>사용여부: 미사용</small><br>
                    <small>2017-5-5</small>
                </p>

                <p class="ele-pt">1,000pt</p>
            </a>
        </div>
        <div class="list-row list-res-row">
            <a href="#!">
                <h6>가맹점 명: <span>스타벅스 여의도 지점</span></h6>
                <h6>연락처: <span>02-3333-3333</span></h6>
                <h6>예약번호: <span>363273232</span></h6>
                <h6>예약상품</h6>
                <span>자바칩 프라푸치노 [옵션: 휘핑크림]</span><br>
                <span>콜드브루 [옵션: 없음]</span>
                <h6>금액: <span>14,000원</span></h6>
                <p class="text-right">
                    <small>사용여부: 미사용</small><br>
                    <small>2017-5-5</small>
                </p>
                <p class="ele-pt">1,000pt</p>
            </a>
        </div>
        <div class="list-row list-res-row">
            <a href="#!">
                <h6>가맹점 명: <span>스타벅스 여의도 지점</span></h6>
                <h6>연락처: <span>02-3333-3333</span></h6>
                <h6>예약번호: <span>363273232</span></h6>
                <h6>예약상품</h6>
                <span>자바칩 프라푸치노 [옵션: 휘핑크림]</span><br>
                <span>콜드브루 [옵션: 없음]</span>
                <h6>금액: <span>14,000원</span></h6>
                <p class="text-right">
                    <small>사용여부: 미사용</small><br>
                    <small>2017-5-5</small>
                </p>

                <p class="ele-pt">1,000pt</p>
            </a>
        </div>
        -->
    </div>
    <? echo $this->pagination->create_links(); ?>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>