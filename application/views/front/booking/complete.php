<?
$session_out = FALSE;
$basket_out = FALSE;
$row = FALSE;
if ( $response['data']['session_out'] ) {
    $session_out = $response['data']['session_out'][0];
};
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
        $basket_out = $response['data']['basket_out'];
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
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <?
                $referer = @$_SERVER['HTTP_REFERER'];
                if ( isset($_GET['referer']) ) {
                    $referer = $_GET['referer'];
                };
                ?>
                <button onclick="history.back()">
                    <img src="/assets/images/login/back_button.png">
                </button>
                <h6><strong>예약완료</strong></h6>
            </div>
        </div>
    </div>
    <style>
        .row-reserbation{padding: 30px 0;margin:20px 0px;border: 1px solid #ECEDEE;background: #F6F7F8}
        .row-reserbation h6{}
        .row-reserbation h5{color: #00C634;}
        .row-reserbation p{color: #ABACAD;font-size:12px}
        .reserbationshare-row{margin: 20px 60px}
    </style>
    <div id="container">
        <div class="container">
            <div class="row row-reserbation">
                <div class="col s12">
                    <div class=" text-center">
                        <h6>상품이 정상적으로 예약되었습니다.</h6>
                        <h5>예약번호: <? echo $row['booking_id']; ?></h5>
                        <p>
                            사용기한: <? echo date('Y-m-d', strtotime($row['booking_expiration_date'])); ?>까지<br>
                            (사용기한이 지나 자동취소 되면 레벨업 포인트가 "10"만큼 감소합니다.)
                        </p>
                    </div>
                </div>
            </div>
            <div class="row reserbationshare-row">
                <div class="col s12 text-center">
                    <h6>예약정보 친구에게 알려주기</h6>
                </div>
                <div class="col s3 text-center">
                    <img src="/assets/images/fb.png">
                </div>
                <div class="col s3 text-center">
                    <img src="/assets/images/tweeter.png">
                </div>
                <div class="col s3 text-center">
                    <img src="/assets/images/email.png">
                </div>
                <div class="col s3 text-center">
                    <img src="/assets/images/kakao.png">
                </div>
            </div>
        </div>
        <div class="price-info-foot">
            <div class="row">
                <div class="col s6">
                    <a href="/" class="btn black-btn text-center">
                        홈으로
                    </a>
                </div>
                <div class="col s6">
                    <a href="/user/active" class="btn primary-btn text-center">
                        나의활동내역
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>