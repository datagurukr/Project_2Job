<?
$notice_out = FALSE;
$event_out = FALSE;
if ( $response['data']['notice_out'] ) {
    $notice_out = $response['data']['notice_out'];
};
if ( $response['data']['event_out'] ) {
    $event_out = $response['data']['event_out'];
};
?>
<div class="wrap" id="hideMenu">
    <div class="main-header">
        <div class="container">
            <div class="logo text-center">
                <img src="/assets/images/logo.png">
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col s12 text-center main-searchbar">
                    <input class="form-element" type="search">
                    <button>
                        <img src="/assets/images/search.png">
                    </button>    
                </div>
            </div>
            <nav>
                <div class="main-nav clear-float">
                    <div class="row text-center">
                        <div class="col s3"><a href="#">영업사원</a></div>
                        <div class="col s3"><a href="#">투잡하기</a></div>
                        <div class="col s3"><a href="#">가맹점제휴</a></div>
                        <div class="col s3"><a href="#">입점비용</a></div>
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
        <div class="row main-userinfo">
            <div class="col s6">
                <strong>홍길동</strong> 회원님
                <span class="text-green">LV. 17</span>
            </div>
            <div class="col s6">
                <div class="progress">
                    <div class="progress-bar" style="width:40%"></div>
                </div>
            </div>

            <div class="col s8">
                <span><img src="/assets/images/dot.png"></span>
                이용 가능한 직권 할인율
                <span class="text-lightblue">25%</span>
            </div>
            <div class="col s4">
                <a href="" class="text-center">
                    직권 할인율이란?
                </a>
            </div>
            <div class="col s8">
                <span><img src="/assets/images/dot.png"></span>
                이번 달 나의 월급
                <span class="text-lightblue">120,000원</span>
            </div>
            <div class="col s4">
                <a href="" class="text-center">
                    급여내역
                </a>
            </div>

            <div class="col s5 text-right">
                <a href="" class="text-center">
                    예약번호 사용조회
                </a>
            </div>
            <div class="col s5">
                <a href="" class="text-center">
                    나의 활동 내역
                </a>
            </div>
            <div class="col s2">
                <a href="" class="text-center">
                    <img src="/assets/images/menu.png">
                </a>
            </div>
        </div> 
        <div class="row main-banner">
            <div class="col s12">
                <a href="">
                    <img src="/assets/images/banner.png" width="100%">
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
                        <a href="" class="truncate">
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
                        <a href="" class="truncate">
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
                };
                ?>
            </div>
        </div>
    </div>
</div>    
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>