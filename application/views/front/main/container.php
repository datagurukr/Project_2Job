<?
$session_out = FALSE;
$notice_out = FALSE;
$event_out = FALSE;
$search_out = FALSE;
if ( $response['data']['notice_out'] ) {
    $notice_out = $response['data']['notice_out'];
};
if ( $response['data']['event_out'] ) {
    $event_out = $response['data']['event_out'];
};
if ( $response['data']['search_out'] ) {
    $search_out = $response['data']['search_out'];
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
    <div class="main-header" id="header">
        <div class="container">
            <div class="logo text-center">
                <img src="/assets/images/logo.png">
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col s12 text-center main-searchbar">
                    <a href="/search" class="form-element">
                    <button>
                        <img src="/assets/images/search.png">
                    </button>  
                    </a>    
                </div>
            </div>
            <nav>
                <div class="main-nav clear-float">
                    <div class="row text-center">
                        <?
                        if ( $search_out ) {
                            foreach ( $search_out as $row ) {
                                ?>
                        <div class="col s3"><a href="/search?q=<? echo $row['search_name']; ?>"><? echo $row['search_name']; ?></a></div>                        
                                <?
                            };
                        };
                        ?>
                        <!--
                        <div class="col s3"><a href="/search?q=영업사원">영업사원</a></div>
                        <div class="col s3"><a href="/search?q=투잡하기">투잡하기</a></div>
                        <div class="col s3"><a href="/search?q=가맹점제휴">가맹점제휴</a></div>
                        <div class="col s3"><a href="/search?q=입점비용">입점비용</a></div>
                        -->
                    </div>
                </div>
            </nav>
        </div>
    </div>	
    <div class="container" id="container">
        <div class="row main-thirdmenu">
            <div class="col s4 text-center">
                <a href="/shop">
                    <img src="/assets/images/pin.png">
                    <div>지도에서<br>가맹점 찾기</div>
                </a>
            </div>
            <div class="col s4 text-center">
                <a href="/shop/recommend">
                    <img src="/assets/images/likeit.png">
                    <div>일하기 편한<br>추천 가맹점</div>
                </a>
            </div>
            <div class="col s4 text-center">
                <a href="/shop">
                    <img src="/assets/images/find.png">
                    <div>맞춤조건으로<br>가맹점 찾기</div>
                </a>
            </div>
        </div>
        
        <?
        if ( $session_id == 0 ) {
            ?>
        <!--로그인 전-->
        <div class="row main-userinfo">
            <div class="col s12 text-center">
                <p class="nonmember-guide">
                    아직 투잡다모아 영업사원이 아니신가요?<br>
                    지금 바로 회원가입 하시고, 투잡다모아의 모든 제휴 업체에서<br>
                    직원 할인 혜택을 누려보세요.
                </p>
            </div>

            <div class="col s4">
                <a href="/user/active/booking" class="text-center sky-btn">
                    예약번호 사용조회
                </a>
            </div>
            <div class="col s3">
                <a href="/login" class="text-center sky-btn">
                    로그인
                </a>
            </div>
            <div class="col s3">
                <a href="/register" class="text-center sky-btn">
                    회원가입
                </a>
            </div>
            <div class="col s2">
                <button type="button" id="showMenu" class="text-center">
                    <img src="/assets/images/menu.png">
                </button>
            </div>
        </div>         
            <?
        } else {
            ?>
        <!--로그인 후-->        
        <div class="row main-userinfo">
            <div class="col s6">
                <strong><? if ( isset($session_out['user_name']) ) { echo $session_out['user_name']; } ?></strong> 회원님
                <span class="text-green">LV. <? if ( isset($session_out['user_level']) ) { echo $session_out['user_level']; } ?></span>
            </div>
            <div class="col s6">
                <div class="progress">
                    <div class="progress-bar" style="width:40%"></div>
                </div>
            </div>

            <div class="col s8">
                <span><img src="/assets/images/dot.png"></span>
                이용 가능한 직권 할인율
                <span class="text-lightblue"><? if ( isset($session_out['user_discount']) ) { echo $session_out['user_discount']; } else { echo '0'; }; ?>%</span>
            </div>
            <div class="col s4">
                <a href="/user/active/salary" class="text-center gray-btn">
                    직권 할인율이란?
                </a>
            </div>
            <div class="col s8">
                <span><img src="/assets/images/dot.png"></span>
                이번 달 나의 월급
                <span class="text-lightblue"><? if ( isset($session_out['user_salary']) ) { echo number_format($session_out['user_salary']); } else { echo '0'; }; ?>원</span>
            </div>
            <div class="col s4">
                <a href="/user/sarf" class="text-center gray-btn">
                    급여내역
                </a>
            </div>

            <div class="col s5 text-right">
                <a href="/user/active/booking" class="text-center sky-btn">
                    예약번호 사용조회
                </a>
            </div>
            <div class="col s5">
                <a href="/user/active" class="text-center sky-btn">
                    나의 활동 내역
                </a>
            </div>
            <div class="col s2">
                <button type="button" id="showMenu" class="text-center">
                    <img src="/assets/images/menu.png">
                </button>
            </div>
        </div>        
            <?
        }
        ?>
        <div class="row main-banner">
            <div class="col s12">
                <a href="http://naver.comd">
                    <img src="/assets/images/banner.jpg" width="100%">
                </a>
            </div>
        </div>
        <div class="row main-notice">
            <div class="col s12">
                <h6><span><img src="/assets/images/blit.png"></span> 공지사항</h6>
                <?
                if ( $notice_out ) {
                    foreach ( $notice_out as $row ) {
                        ?>
                <div>
                    <div class="col s8">
                        <a href="/notice/<? echo $row['post_id']; ?>" class="truncate">
                        <?
                        if ( 0 < strlen(trim($row['post_content_title'])) ) {
                            echo strip_tags($row['post_content_title']);
                        } else { 
                            echo '-'; 
                        };
                        ?>                        
                        </a>
                    </div>
                    <div class="col s4">
                        <?
                        echo date("Y.m.d.", strtotime($row['post_register_date']));
                        ?>                    
                    </div>
                </div>

                        <?
                    };
                } else {
                    ?>
                <p>등록된 공지사항이 없습니다.</p>
                    <?
                };

                ?>                
            </div>
        </div>
        <div class="row main-notice">
            <div class="col s12">
                <h6><span><img src="/assets/images/blit.png"></span> 이벤트</h6>
                <?
                if ( $event_out ) {
                    foreach ( $event_out as $row ) {
                        ?>            
                <div>            
                    <div class="col s8">
                        <a href="/event/<? echo $row['post_id']; ?>" class="truncate">
                        <?
                        if ( 0 < strlen(trim($row['post_content_title'])) ) {
                            echo strip_tags($row['post_content_title']);
                        } else { 
                            echo '-'; 
                        };
                        ?>                        
                        </a>
                    </div>
                    <div class="col s4">
                        <?
                        echo date("Y.m.d.", strtotime($row['post_register_date']));
                        ?>                    
                    </div>
                </div>    
                        <?
                    };
                } else {
                    ?>
                <p>등록된 이벤트가 없습니다.</p>
                    <?
                };
                ?>                
            </div>
        </div>
    </div>
</div>   
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>
<script type="text/javascript">run_func( 'slideNav', false );</script>