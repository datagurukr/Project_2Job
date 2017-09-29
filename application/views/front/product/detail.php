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
                    <p><span><img src="/assets/images/dot.png"></span>
                    이용 가능한 직권 할인율</p>
                </div>
                <div class="col s4">
                    <p><span><? if ( isset($session_out['user_discount']) ) { echo $session_out['user_discount']; } else { echo '0'; }; ?>%</span></p>
                </div>
                <div class="col s8">
                    <p><span><img src="/assets/images/dot.png"></span>
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
        </div>
    </div>
    <div class="productname-wrap">
        <img src="/assets/images/productsample.png" width="100%">
        <p class="text-center"><strong><? if ( isset($row['product_name']) ) { echo $row['product_name']; }; ?></strong></p>
    </div>
    <div id="container">
        <form method="post" action="/basket" enctype="application/x-www-form-urlencoded">
            <div class="container" id="product">
                <input type="hidden" name="product_price" value="<? if ( isset($row['product_price']) ) { echo $row['product_price']; } else { echo '0'; }; ?>">        
                <input type="hidden" name="product_id" value="<? echo $row['product_id']; ?>">            
                <input type="hidden" name="product_name" value="<? echo $row['product_name']; ?>">                            
                <input type="hidden" name="purchase_price">
                <input type="hidden" name="purchase_count">

                <div class="price-info">
                    <div class="row row-price">
                        <div class="col s6">
                            가격
                        </div>
                        <div class="col s6 text-right">
                            <span><? if ( isset($row['product_price']) ) { echo number_format($row['product_price']); } else { echo '0'; }; ?></span>원
                        </div>
                    </div>
                    <div class="option-title">
                        <h6>옵션</h6>
                    </div>

                    <?
                    if ( is_array($row['product_option']) ) {
                        foreach ( $row['product_option'] as $option_row ) {
                            if ( strlen($option_row['name']) != 0 ) {
                                ?>
                    <div class="row row-option">
                        <div class="col s4"><? echo $option_row['name']; ?></div>
                        <div class="col s3 data-option-price">+<? echo number_format($option_row['price']); ?>원</div>
                        <div class="col s5 text-right">
                            <ul class="qty-ctrl">
                                <li><button type="button" class="btn-dec">-</button></li>
                                <input type="hidden" name="option_cal_price" value="<? echo $option_row['price']; ?>">                            
                                <input type="hidden" class="in_option_name" name="option_name[]" value="<? echo $option_row['name']; ?>">
                                <input type="hidden" class="in_option_price" name="option_price[]" value="0">
                                <input type="hidden" class="in_option_count" name="option_count[]" value="0">                            
                                <li><input type="number" class="cnt text-center " disabled width="500px" value="0"></li>
                                <li><button type="button" class="btn-inc">+</button></li>
                            </ul>
                        </div>
                    </div>
                                <?
                            };
                        };
                    };
                    ?>

                    <!--
                    <div class="row row-option">
                        <div class="col s4">자바칩</div>
                        <div class="col s3">+600원</div>
                        <div class="col s5 text-right">
                            <ul class="qty-ctrl">
                                <li><a class="btn-dec">-</a></li>
                                <li><input type="number" class="cnt text-center" disabled width="500px" value="1"></li>
                                <li><a class="btn-inc">+</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row row-option">
                        <div class="col s4">자바칩</div>
                        <div class="col s3">+600원</div>
                        <div class="col s5 text-right">
                            <ul class="qty-ctrl">
                                <li><a class="btn-dec">-</a></li>
                                <li><input type="number" class="cnt text-center" disabled width="500px" value="1"></li>
                                <li><a class="btn-inc">+</a></li>
                            </ul>
                        </div>
                    </div>
                    -->

                    <div class="row row-quantity">
                        <div class="col s6">
                            수량
                        </div>
                        <div class="col s6 text-right">
                            <ul class="qty-ctrl">
                                <li><button type="button" class="btn-dec">-</button></li>
                                <li><input type="number" class="cnt text-center" disabled value="1"></li>
                                <li><button type="button" class="btn-inc">+</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tot-info">
                        <div class="row">
                            <div class="col s12 lmt-date text-center">
                                사용기한: <? echo date("Y-m-d", strtotime($row['product_life_open_date']));; ?>~<? echo date("Y-m-d", strtotime($row['product_life_close_date']));; ?>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col s12">
                                총 주문금액
                            </div>
                            <div class="col s12 tot-price">
                                <? if ( isset($row['product_price']) ) { echo number_format($row['product_price']); } else { echo '0'; }; ?>원
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="price-info-foot">
                <div class="row">
                    <div class="col s6">
                        <a href="#!" class="btn black-btn text-center">
                            장바구니 담기
                        </a>
                    </div>
                    <div class="col s6">
                        <button type="submit" class="btn primary-btn text-center">
                            주문하기
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
<script type="text/javascript">run_func( 'product', false );</script>