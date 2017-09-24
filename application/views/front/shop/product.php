<?
$row = FALSE;
$product_out = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
        $product_out = $response['data']['product_out'];
    };
};
?>
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
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/back_button.png">
                </a>
                <h6><strong><? if ( isset($row['user_business_entity_name']) ) { echo $row['user_business_entity_name']; }; ?></strong></h6>
            </div>
            <div class="hamburgermenu">
                <button type="button" id="showMenu">
                    <img src="/assets/images/menu.png">
                </button>
            </div>
        </div>
    </div>
    <div id="container">
        <div class="intro-wrap">
            <img src="/assets/images/starbuckssample.png" width="100%">
            <h6 class="text-center"><? if ( isset($row['user_incentive']) ) { echo $row['user_incentive']; }; ?>%<br><small>판매 인센티브</small></h6>
        </div>
        <div class="list-wrap aff-list">
            <div class="list-tab">
                <div class="tab tab-active">
                    <a href="/shop/<? echo $row['user_id']; ?>/product" class="text-center">판매상품</a>
                </div>
                <div class="tab tab">
                    <a href="/shop/<? echo $row['user_id']; ?>/detail" class="text-center">업체정보</a>
                </div>
            </div>
        </div>
        <div class="container aff-grid">
            <div class="row">
                <?
                if ( $product_out ) {
                    foreach ( $product_out as $product_out_row ) {
                        // $product_out_row['product_picture']
                        ?>
                    <div class="col s6">
                        <a href="/product/<? echo $product_out_row['product_id']; ?>">
                            <img src="/assets/images/productsample1.png" width="100%">
                            <p class="text-center truncate"><strong><? echo $product_out_row['product_name']; ?></strong></p>
                        </a>
                    </div>
                        <?
                    };
                };
                ?>
                <!--
                <div class="col s6">
                    <img src="/assets/images/productsample1.png" width="100%">
                    <p class="text-center truncate"><strong>나이트로 콜드브루</strong></p>
                </div>
                <div class="col s6">
                    <img src="/assets/images/productsample2.png" width="100%">
                    <p class="text-center truncate"><strong>체리블라썸 화이트 초콜릿</strong></p>
                </div>
                <div class="col s6">
                    <img src="/assets/images/productsample1.png" width="100%">
                    <p class="text-center truncate"><strong>나이트로 콜드브루</strong></p>
                </div>
                <div class="col s6">
                    <img src="/assets/images/productsample2.png" width="100%">
                    <p class="text-center truncate"><strong>체리블라썸 화이트 초콜릿</strong></p>
                </div>
                -->
            </div>
        </div>
        <div class="aff-foot">
            <a href="#!" class="btn primary-btn text-center">
                장바구니 20
            </a>
        </div>        
    </div>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>