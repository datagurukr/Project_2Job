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
if ( isset($response['data']['session_out']) ) {
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
                <?
                $referer = @$_SERVER['HTTP_REFERER'];
                if ( isset($_GET['referer']) ) {
                    $referer = $_GET['referer'];
                };
                ?>
                <button onclick="history.back()">
                    <img src="/assets/images/login/back_button.png">
                </button>
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
        <div class="list-tab">
            <div class="tab">
                <a href="/user/active/all" class="text-center">종합</a>
            </div>
            <div class="tab tab">
                <a href="/user/active/booking" class="text-center">예약번호 발급/사용</a>
            </div>
            <div class="tab tab">
                <a href="/user/active/recommender" class="text-center">추천인</a>
            </div>
            <?
            if ( $session_out['user_status'] != 1 ) {
                ?>            
            <div class="tab tab-active">
                <a href="/user/active/salary" class="text-center">급여내역</a>
            </div>
                <?
            };
            ?>            
        </div>
        <div class="container">
            <?
            if ( $session_out['user_status'] == 2 ) {
                ?>            
            <div class="row row-mypage-pay">
                <div class="col s12">
                    <form method="get" enctype="application/x-www-form-urlencoded">
                        <?
                        $salary_date = array();
                        $y = (int)date("Y");
                        $n = (int)date("n");
                        for ( $i = 0; $i < 13; $i++ ) {
                            if ( $n < 10 ) { $m = '0'.$n; } else { $m = $n; }
                            array_push($salary_date,array('value' => $y.'-'.$m,'string' => $y.'년 '.$m.'월'));
                            $n--;
                            if ( $n == 0 ) { $n = 12; $y--; }
                        };
                        ?>
                        <select class="form-element on-reload-select" name="yearmonth">
                            <?
                            foreach ( $salary_date as $salary_date_row ) {
                                if ($salary_date_row['value'] == $yearmonth ) { $selected = 'selected'; } else { $selected = ''; }
                                ?>
                            <option value="<? echo $salary_date_row['value']; ?>" <? echo $selected; ?>><? echo $salary_date_row['string']; ?></option>
                                <?
                            }
                            ?>
                        </select>
                    </form>    
                </div>
            </div>
            <?
            };
            ?>
        </div>
        
        <?
        if ( $response['status'] == 200 ) {
            if ( 0 < $response['data']['count'] ) {
                $temp = ((($p * 2) * 10) - 20 ); 
                $num = $response['data']['out_cnt'] - $temp; 
                foreach ( $response['data']['out'] as $row ) {
                    // $num; $num--;
                        ?>
        <div class="list-row">
            <a href="#!">
                <h6>추천인 가입</h6>
                <p><small><? echo date("Y-m-d", strtotime($row['saving_register_date'])); ?></small></p>
                <p class="ele-pt"><? if ( isset($row['saving_exp']) ) { echo number_format($row['saving_exp']); } else { echo '0'; } ?>pt</p>
            </a>
        </div>
                        <?
                };
            };
        }
        ?>         
        
        <!--
        <div class="list-row">
            <a href="#!">
                <h6>추천인 가입</h6>
                <p><small>2017-5-5</small></p>
                <p class="ele-pt">1,000pt</p>
            </a>
        </div>
        <div class="list-row">
            <a href="#!">
                <h6>예약번호 취소 (<span>5343454-기간만료</span>)</h6>
                <p><small>2017-5-5</small></p>
                <p class="ele-pt">1,000pt</p>
            </a>
        </div>
        <div class="list-row">
            <a href="#!">
                <h6>추천인 레벨업(<span>김영희 LV7 >LV8</span>)</h6>
                <p><small>2017-5-5</small></p>
                <p class="ele-pt">1,000pt</p>
            </a>
        </div>
        -->
    </div>

    <?
    if ( $session_out['user_status'] == 2 ) {
        ?>
    <div class="mypage-foot">
        <div class="container">
            <div class="row row-mypage-pay">
                <div class="col s9">
                    <h6 class="mypage-foot-pay">나의 월급: <? if ( isset($session_out['user_salary']) ) { echo number_format($session_out['user_salary']); } else { echo '0'; } ?>원 <small>사업소득세 3.3% 공제</small></h6>
                </div>
                <div class="col s3">
                    <a class="btn blackgreen-btn text-center truncate" href="#!">사업소득세란?</a>
                </div>
            </div>
            <?
            if ( isset($session_out['user_bank_name']) && isset($session_out['user_bank_number']) ) {
                ?>
            <p>
                입금계좌: <? echo $session_out['user_bank_name']; ?> <span><? echo $session_out['user_bank_number']; ?></span><br>
                <small>(입금계좌를 다시 한번 확인해주세요.)</small>
            </p>
                <?
            }
            ?>
        </div>
    </div>
        <?
    } else {
        ?>
    <p>영업사원만 확인할 수 있는 화면입니다.</p>
        <?
    }
    ?>
    <? echo $this->pagination->create_links(); ?>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>