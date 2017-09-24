<?
$session_out = FALSE;
$popularity_keyword_out = FALSE;
$latest_keyword_out = FALSE;
if ( $response['data']['popularity_keyword_out'] ) {
    $popularity_keyword_out = $response['data']['popularity_keyword_out'];
};
if ( $response['data']['latest_keyword_out'] ) {
    $latest_keyword_out = $response['data']['latest_keyword_out'];
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
    <div class="search-header" id="header">
        <div class="row row-search">
            <div class="col s2 text-center back">
                <a href="">
                    <img src="assets/images/back_button.png">
                </a>
            </div>
            <form method="get" enctype="application/x-www-form-urlencoded">
                <div class="col s8">
                    <input class="form-element" type="text" name="q" value="<? echo $q; ?>" placeholder="검색어를 입력하세요.">
                </div>
                <div class="col s2 text-center">
                    <button type="submit">
                        <img src="assets/images/search.png">
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="search-category" id="container">
        <div class="category-label">
            <div class="label">
                <h6>최근 검색어</h6>
            </div>
            <div class="label">
                <h6>인기 검색어</h6>
            </div>
        </div>
        <div class="category-element">
            <div class="element-col">
                <?
                $i = 0;
                if ( $latest_keyword_out ) {
                    foreach ( $latest_keyword_out as $row ) {
                        ?>
                <div class="element">
                    <a href="/search?q=<? echo $row['keyword']; ?>"><? echo $row['keyword']; ?></a>
                    <button class="keyword-delete-a">
                        <img src="assets/images/X.png">
                    </button>
                </div>
                        <?
                        $i++;
                    };
                };
                ?>
            </div>
            <div class="element-col">
                
                <?
                $i = 0;
                if ( $popularity_keyword_out ) {
                    foreach ( $popularity_keyword_out as $row ) {
                        if ( $i < 3 ) {
                            ?>
                <div class="element">
                    <a href="<? echo $row['url']; ?>" class="top-keyword"><? echo $row['keyword']; ?></a>
                </div>
                            <?
                        } else {
                            ?>
                <div class="element">
                    <a href="<? echo $row['url']; ?>"><? echo $row['keyword']; ?></a>
                </div>
                            <?
                        };
                        $i++;
                    };
                };
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>