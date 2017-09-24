<?
$session_out = FALSE;
$shop_recommend_out = FALSE;
$count = 0;
if ( $response['data']['session_out'] ) {
    $session_out = $response['data']['session_out'][0];
};
if ( $response['data']['shop_recommend_out'] ) {
    $shop_recommend_out = $response['data']['shop_recommend_out'];
};
if ( $response['status'] == 200 ) {
    if ( isset($response['data']['count']) ) {
        $count = $count + $response['data']['count'];
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
                <h6><strong>지역 목록 (<? echo number_format($count); ?>개)</strong></h6>
            </div>
            <div class="hamburgermenu">
                <button type="button" id="showMenu">
                    <img src="/assets/images/menu.png">
                </button>
            </div>
        </div>
    </div>
    <div id="container">
        <div class="list-wrap">
            <div class="container recomend-hd">
                <div class="row">
                    <div class="col s6">
                        <h6>추천 가맹점</h6>
                    </div>
                    <!--
                    <div class="col s6 text-right">
                        <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio">등록순
                          </label>
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio">인기순
                          </label>
                        </div>
                    </div>
                    -->
                </div>
            </div>  
            
            <?
            if ( $shop_recommend_out ) {
                foreach ( $shop_recommend_out as $row ) {
                    ?>
            <div class="list-row aff-ele">
                <a href="/shop/<? echo $row['user_id']; ?>">
                    <div class="row">
                        <div class="col s5 col-tltle">
                            <img src="<? if ( isset($row['user_shop_pictrue']) ) { echo $row['user_shop_pictrue']; }; ?>">
                        </div>
                        <div class="col s7">
                            <h6 class="truncate">
                                <? if ( isset($row['user_business_entity_name']) ) { echo $row['user_business_entity_name']; }; ?>
                                <img class="bookmark-on" src="assets/images/on.png">
                            </h6>
                            <p class="intro">
                                <? if ( isset($row['user_short_introduction']) ) { echo $row['user_short_introduction']; }; ?>
                            </p>
                            <p class="info">
                                <? if ( isset($row['user_incentive']) ) { echo '판매인센티브: '.$row['user_incentive'].'%'; } else { echo ''; }; ?> <br>
                                즐겨 찾는 가맹점(인기)수:  <? if ( isset($row['shop_bookmark_count']) ) { echo number_format($row['shop_bookmark_count']); } else { echo '0'; }; ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>            
                    <?
                };
            };
            ?>
            
            <!--
            <div class="list-row aff-ele">
                <a href="#!">
                    <div class="row">
                        <div class="col s5 col-tltle">
                            <img src="/assets/images/aff-sample.png">
                        </div>
                        <div class="col s7">
                            <h6 class="truncate">스타벅스 여의도 지점 <img class="bookmark-on" src="assets/images/on.png">  </h6>
                            <p class="intro">
                                다른 스타벅스랑 차별점은 실내 분위기가 아주 따뜻하고 편안합니다.
                            </p>
                            <p class="info">
                                판매인센티브: 10~12% <br>
                                즐겨 찾는 가맹점(인기)수: 20
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="list-row aff-ele">
                <a href="#!">
                    <div class="row">
                        <div class="col s5 col-tltle">
                            <img src="/assets/images/aff-sample.png">
                        </div>
                        <div class="col s7">
                            <h6 class="truncate">스타벅스 여의도 지점 <img class="bookmark-on" src="assets/images/on.png">  </h6>
                            <p class="intro">
                                다른 스타벅스랑 차별점은 실내 분위기가 아주 따뜻하고 편안합니다.
                            </p>
                            <p class="info">
                                판매인센티브: 10~12% <br>
                                즐겨 찾는 가맹점(인기)수: 20
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            -->
            <div class="container recomend-hd">
                <div class="row">
                    <div class="col s6">
                        <h6>일반 가맹점</h6>
                    </div>
                    <!--
                    <div class="col s6 text-right">
                        <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio">등록순
                          </label>
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio">인기순
                          </label>
                        </div>
                    </div>
                    -->
                </div>
            </div>
            <?
            if ( $response['status'] == 200 ) {
                if ( 0 < $response['data']['count'] ) {
                    $temp = ((($p * 2) * 10) - 20 ); 
                    $num = $response['data']['out_cnt'] - $temp; 
                    foreach ( $response['data']['out'] as $row ) {
                        ?>              
            <div class="list-row aff-ele">
                <a href="/shop/<? echo $row['user_id']; ?>">
                    <div class="row">
                        <div class="col s5 col-tltle">
                            <img src="<? if ( isset($row['user_shop_pictrue']) ) { echo $row['user_shop_pictrue']; }; ?>">
                        </div>
                        <div class="col s7">
                            <h6 class="truncate">
                                <? if ( isset($row['user_business_entity_name']) ) { echo $row['user_business_entity_name']; }; ?>
                                <img class="bookmark-on" src="assets/images/on.png">
                            </h6>
                            <p class="intro">
                                <? if ( isset($row['user_short_introduction']) ) { echo $row['user_short_introduction']; }; ?>
                            </p>
                            <p class="info">
                                <? if ( isset($row['user_incentive']) ) { echo '판매인센티브: '.$row['user_incentive'].'%'; } else { echo ''; }; ?> <br>
                                즐겨 찾는 가맹점(인기)수:  <? if ( isset($row['shop_bookmark_count']) ) { echo number_format($row['shop_bookmark_count']); } else { echo '0'; }; ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
                        <?
                    };
                };
            }
            ?>
            <? //echo $this->pagination->create_links(); ?>            
            <!--
            <div class="list-row aff-ele">
                <a href="#!">
                    <div class="row">
                        <div class="col s5 col-tltle">
                            <img src="/assets/images/aff-sample.png">
                        </div>
                        <div class="col s7">
                            <h6 class="truncate">스타벅스 여의도 지점 <img class="bookmark-on" src="assets/images/on.png">  </h6>
                            <p class="intro">
                                다른 스타벅스랑 차별점은 실내 분위기가 아주 따뜻하고 편안합니다.
                            </p>
                            <p class="info">
                                판매인센티브: 10~12% <br>
                                즐겨 찾는 가맹점(인기)수: 20
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            -->
        </div>
    </div>    
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>