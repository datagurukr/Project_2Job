<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<?
$session_out = FALSE;
$event_out = FALSE;
$row = FALSE;
if ( $response['data']['session_out'] ) {
    $session_out = $response['data']['session_out'][0];
};
if ( $response['data']['event_out'] ) {
    $event_out = $response['data']['event_out'];
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
                <?
                $referer = @$_SERVER['HTTP_REFERER'];
                if ( isset($_GET['referer']) ) {
                    $referer = $_GET['referer'];
                };
                ?>
                <button onclick="history.back()">
                    <img src="/assets/images/login/back_button.png">
                </button>
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
                <div class="tab">
                    <a href="/shop/<? echo $row['user_id']; ?>/product" class="text-center">판매상품</a>
                </div>
                <div class="tab tab-active">
                    <a href="/shop/<? echo $row['user_id']; ?>/detail" class="text-center">업체정보</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="affdetail-info">
                <p class="intro-body">
                    <? if ( isset($row['user_introduction']) ) { echo $row['user_introduction']; }; ?>
                </p>
                <h6>업체통계</h6>
                <div class="row">
                    <div class="col s6">
                        <p>생성된 예약번호</p>
                        <p>판매 완료된 예약번호</p>
                        <p>즐겨찾는 가맹점 수</p>
                    </div>
                    <div class="col s6">
                        <p><? echo number_format($row['shop_booking_number_count']); ?>개</p>
                        <p><? echo number_format($row['shop_sale_booking_number_count']); ?>개</p>
                        <p><? echo number_format($row['shop_bookmark_count']); ?>개</p>
                    </div>
                </div>
                <h6>이벤트</h6>
                <div class="row">
                    <?
                    if ( $event_out ) {
                        foreach ( $event_out as $event_row ) {
                        ?>
                    <a href="/event/<? echo $event_row['post_id']; ?>">
                        <div class="col s9">
                            <p class="truncate"><? if ( 0 < strlen(trim($event_row['post_content_title'])) ) { echo $event_row['post_content_title']; } else { echo '-'; }; ?></p>
                        </div>
                        <div class="col s3">
                            <p><? echo date("Ymd", strtotime($event_row['post_register_date'])); ?></p>
                        </div>
                    </a>
                        <?
                        };
                    } else {
                        ?>
                        <?
                    }
                    ?>
                </div>
                <h6>영업정보</h6>
                <div class="row">
                    <div class="col s3">
                        <?
                        if ( $row['user_shop_daily_open_state'] == 1 ) {
                            ?>
                        <p>영업시간</p>
                            <?
                        };
                        ?>
                        <?
                        if ( $row['user_shop_holiday_open_state'] == 1 ) {
                            ?>
                        <p><? if ( $row['user_shop_daily_open_state'] == 0 ) { echo '영업시간'; }; ?></p>
                            <?
                        };
                        ?>    
                        <?
                        if ( isset($row['user_tel']) ) { 
                            if ( strlen($row['user_tel']) != 0 ) {
                                ?>
                        <p>
                            예약문의
                        </p>    
                                <?
                            };
                        }; 
                        ?>                        
                    </div>
                    <div class="col s9">
                        <?
                        if ( $row['user_shop_daily_open_state'] == 1 ) {
                            $date1 = date_create('0000-00-00 '.$row['user_shop_daily_open_time']);
                            $date2 = date_create('0000-00-00 '.$row['user_shop_daily_close_time']);
                            ?>
                        <p>
                            매일 <? echo date_format($date1, 'A g:i'); ?> ~ <? echo date_format($date2, 'A g:i'); ?>
                        </p>
                            <?
                        };
                        ?>
                        <?
                        if ( $row['user_shop_holiday_open_state'] == 1 ) {
                            $date1 = date_create('0000-00-00 '.$row['user_shop_holiday_open_time']);
                            $date2 = date_create('0000-00-00 '.$row['user_shop_holiday_close_time']);                            
                            ?>
                        <p>
                            휴일 <? echo date_format($date1, 'A g:i'); ?> ~ <? echo date_format($date2, 'A g:i'); ?>
                        </p>
                            <?
                        };
                        ?>
                        <?
                        if ( isset($row['user_tel']) ) { 
                            if ( strlen($row['user_tel']) != 0 ) {
                                ?>
                        <p>
                            <? echo $row['user_tel']; ?>
                        </p>    
                                <?
                            };
                        }; 
                        ?>
                    </div>
                </div>
                <h6>위치정보</h6>
                <div class="map-wrap">
                    <div class="map">
                        <div id="map" data-user-business-entity-name="<? echo $row['user_business_entity_name']; ?>" data-lat="<? echo $row['user_lat']; ?>" data-lng="<? echo $row['user_lng']; ?>" style="width: 100%;height: 146px;display: block;">
                        </div>
                        
                        
                        <div id="pano"></div>
                        
                    </div>
                    <div class="map-tab">
                        <div class="tab tab-frt">
                            <a href="https://www.google.co.kr/maps/@<? echo $row['user_lat']; ?>,<? echo $row['user_lng']; ?>,14z" class="text-center">크게보기</a>
                        </div>
                        <div class="tab">
                            <button id="btn-loadview" class="text-center" data-user-business-entity-name="<? echo $row['user_business_entity_name']; ?>" data-lat="<? echo $row['user_lat']; ?>" data-lng="<? echo $row['user_lng']; ?>">길찾기</button>
                        </div>
                    </div>
                </div>
                <h6>사업자 정보</h6>
                <div class="row">
                    <div class="col s4">
                        <p>상호명</p>
                        <p>사업자등록번호</p>
                    </div>
                    <div class="col s8">
                        <p><? if ( isset($row['user_business_entity_name']) ) { echo $row['user_business_entity_name']; }; ?></p>
                        <p><? if ( isset($row['user_business_license_number']) ) { echo $row['user_business_license_number']; }; ?></p>
                    </div>

                </div>

            </div>

        </div>  
        <div class="aff-foot">
            <a href="/basket" class="btn primary-btn text-center">
                장바구니 <? echo number_format($session_out['user_basket_count']) ?>
            </a>
        </div>        
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCosefOMaqji0zK3Ei_-NvH396sprDbSDQ&callback=initDetailShopMap" async defer></script>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>
<script type="text/javascript">run_func( 'shopDetail', false );</script>