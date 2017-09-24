<?
$shop_id = 0;
$session_out = FALSE;
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
<?
$total_price = 0
?>
<div class="wrap" id="hideMenu">
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="#!">
                    <img src="assets/images/back_button.png">
                </a>
                <h6><strong>주문확인(주문하기)</strong></h6>
            </div>
        </div>
    </div>
    <div id="container">
        <form method="post" action="/booking" enctype="application/x-www-form-urlencoded">
            <div class="container">
                <?
                if ( $response['status'] == 200 ) {
                    if ( 0 < $response['data']['count'] ) {
                        $temp = ((($p * 2) * 10) - 20 ); 
                        $num = $response['data']['out_cnt'] - $temp; 
                        foreach ( $response['data']['out'] as $row ) {
                            // $num; $num--;
                            $shop_id = $row['shop_id'];
                            $total_price = $total_price + $row['basket_content']['purchase_price'];
                            
                            ?>  
                <input type="hidden" name="basket_id[]" value="<? echo $row['basket_id']; ?>">
                <div class="order-ele">
                    <div class="row order-ele-row">
                        <div class="col s6">
                            <div class="order-ele-img">
                                <img src="assets/images/productsample.png" width="100%">
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="order-ele-hd">
                                <h6><? echo $row['product_name']; ?></h6>
                                <a href="#!">
                                    <img src="assets/images/X.png">
                                </a>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="order-ele-custom">
                                <?
                                if ( $row['basket_content'] ) {
                                    $i = 0;
                                    foreach ( $row['basket_content']['option_count'] as $option_row ) {
                                        if ( 0 < $option_row ) {
                                            ?>
                                <div>
                                    <div class="col s8">
                                        [옵션] <span><? echo $row['basket_content']['option_name'][$i]; ?></span>
                                    </div>
                                    <div class="col s4 text-right">
                                        <a href="#!" class="opt-cg-btn">변경</a>
                                    </div>
                                </div>
                                            <?
                                        };
                                        $i++;
                                    };
                                };
                                ?>
                                
                                <div class="col s8">
                                    <ul class="qty-ctrl">
                                        [수량]
                                        <li><a class="btn-dec">-</a></li>
                                        <li><input type="number" class="cnt text-center" disabled width="500px" value="<? echo $row['basket_content']['purchase_count']; ?>"></li>
                                        <li><a class="btn-inc">+</a></li>
                                    </ul>
                                </div>
                                <div class="col s4 text-right">
                                    +<? echo number_format($row['basket_content']['purchase_price']); ?>원
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                </div>                
                            <?
                        };
                    };
                }
                ?>    
                <!--
                <div class="order-ele">
                    <div class="row order-ele-row">
                        <div class="col s6">
                            <div class="order-ele-img">
                                <img src="assets/images/productsample.png" width="100%">
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="order-ele-hd">
                                <h6>자바칩 프라푸치노</h6>
                                <a href="#!">
                                    <img src="assets/images/X.png">
                                </a>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="order-ele-custom">
                                <div class="col s8">
                                    [옵션] <span>에스프레소</span>
                                </div>
                                <div class="col s4 text-right">
                                    <a href="#!" class="opt-cg-btn">변경</a>
                                </div>
                                <div class="col s8">
                                    <ul class="qty-ctrl">
                                        [수량]
                                        <li><a class="btn-dec">-</a></li>
                                        <li><input type="number" class="cnt text-center" disabled width="500px" value="1"></li>
                                        <li><a class="btn-inc">+</a></li>
                                    </ul>
                                </div>
                                <div class="col s4 text-right">
                                    +600원
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-ele">
                    <div class="row order-ele-row">
                        <div class="col s6">
                            <div class="order-ele-img">
                                <img src="assets/images/productsample.png" width="100%">
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="order-ele-hd">
                                <h6>자바칩 프라푸치노</h6>
                                <a href="#!">
                                    <img src="assets/images/X.png">
                                </a>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="order-ele-custom">
                                <div class="col s8">
                                    [옵션] <span>에스프레소</span>
                                </div>
                                <div class="col s4 text-right">
                                    <a href="#!" class="opt-cg-btn">변경</a>
                                </div>
                                <div class="col s8">
                                    <ul class="qty-ctrl">
                                        [수량]
                                        <li><a class="btn-dec">-</a></li>
                                        <li><input type="number" class="cnt text-center" disabled width="500px" value="1"></li>
                                        <li><a class="btn-inc">+</a></li>
                                    </ul>
                                </div>
                                <div class="col s4 text-right">
                                    +600원
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <input type="hidden" name="shop_id" value="<? echo $shop_id; ?>">
                <div class="pay-info">
                    <div class="pay-info-wrap">
                        <div class="row">
                            <div class="col s3 text-right">
                                총 액
                            </div>
                            <div class="col s9 text-right">
                                <? echo number_format($total_price); ?>원
                                <input type="hidden" name="booking_price" value="<? echo $total_price; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s3 text-right">
                                할인금액
                            </div>
                            <div class="col s9 text-right discount-price">
                                <input type="number" name="booking_discount" class="text-center" value="0"> 원
                                <span>(최대 할인가능 금액 1,200원)</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <h5>실 결제금액 <? echo number_format($total_price); ?>원</h5>
                                <h6>판매 완료될 경우 받게 될 금액: 2,000원</h6>
                                <input type="hidden" name="booking_incentive" value="0">                                
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="price-info-foot">
                <div class="row">
                    <div class="col s12">
                        <button type="submit" class="btn primary-btn text-center">
                            에약번호 발급
                        </button>
                    </div>
                </div>
            </div> 
        </form>    
    </div>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>