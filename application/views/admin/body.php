<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>투잡다모아</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/assets/admin/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="/assets/admin/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>    
    <link href="/assets/admin/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="/assets/admin/js/materialize.js"></script>
    <script src="/assets/admin/js/init.js"></script>
    <script src="http://cdn.ckeditor.com/4.7.1/full-all/ckeditor.js"></script>    
    
</head>
<body>
    
    <header>
        <?
        if ( !isset($shop_nav) ) {
            ?>        
        <nav>
            <div class="nav-wrapper">
                <div class="container">
                    <div class="col s12">
                        <a href="#!" class="breadcrumb">
                            홈
                        </a>    
                        <a href="#!" class="breadcrumb">
                            <?
                            if ( $key == 'user' ) {
                                echo '회원관리';
                            } elseif ( $key == 'shop' ) {
                                echo '가맹점 관리';
                            } elseif ( $key == 'post' ) {
                                echo '커뮤니티 관리';
                            } elseif ( $key == 'service' ) {
                                echo '고객센터';
                            } elseif ( $key == 'auth' ) {                                
                                echo '인증';
                            }
                            ?>
                        </a>
                        <a href="#!" class="breadcrumb">
                            <?
                            if ( $sub_key == 'user_1' ) {
                                echo '일반 회원관리';
                            } elseif ( $sub_key == 'user_2' ) {
                                echo '영업사원 회원관리';
                            } elseif ( $sub_key == 'user_3' ) {
                                echo '가맹점 회원관리';
                            } elseif ( $sub_key == 'user_4' ) {
                                echo '탈퇴 회원관리';
                            } elseif ( $sub_key == 'shop_1' ) {
                                echo '가맹점 관리';                            
                            } elseif ( $sub_key == 'post_1' ) {
                                echo '공지사항 관리';
                            } elseif ( $sub_key == 'post_2' ) {
                                echo '이벤트 관리';
                            } elseif ( $sub_key == 'post_3' ) {
                                echo '인기 검색어 관리';
                            } elseif ( $sub_key == 'service_4' ) {
                                echo '고객센터';
                            } elseif ( $sub_key == 'auth_login' ) {
                                echo '로그인';                                
                            }
                            ?>
                        </a>
                    </div>
                </div>
            </div>    
        </nav>   
        <?
        };
        ?>
        
        <?
        if ( isset($shop_nav) ) {
            ?>
        <nav>
            <div class="nav-wrapper">
                <div class="container">
                    <div class="col s12">                
                        <ul class="left hide-on-med-and-down">
                            <li<? if ( $shop_key == 'info' ) { echo ' class="active"'; }; ?>>
                                <a href="/admin/shop/<? echo $shop_id; ?>/info">정보관리</a>
                            </li>
                            <li<? if ( $shop_key == 'product' ) { echo ' class="active"'; }; ?>>
                                <a href="/admin/shop/<? echo $shop_id; ?>/product">상품관리</a>
                            </li>
                            <li<? if ( $shop_key == 'sales' ) { echo ' class="active"'; }; ?>>
                                <a href="/admin/shop/<? echo $shop_id; ?>/sales">매출관리</a>
                            </li>
                            <li<? if ( $shop_key == 'event' ) { echo ' class="active"'; }; ?>>
                                <a href="/admin/shop/<? echo $shop_id; ?>/event">이벤트관리</a>
                            </li>                            
                            <!--
                            <li class="active">
                                <a href="collapsible.html">JavaScript</a>
                            </li>
                            -->
                        </ul>
                    </div>
                </div>
            </div>
        </nav>        
            <?
        }
        ?>
        <div class="container">
            <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
                <i class="material-icons">menu</i>
            </a>
        </div>
        <ul id="nav-mobile" class="side-nav fixed">
            <li class="bold">
                <a href="/admin" class="waves-effect waves-teal">
                    투잡다모아
                </a>
            </li>
            
            <?
            if ( isset($session['logged_in']) ) {
                if ( $session['logged_in'] ) {                    
                    ?>                        
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <?
                    if ( 8 <= $session['user_status'] ) {
                        ?>
                    <li class="bold <? if ( $key == 'user' ) { echo 'active'; }; ?>">
                        <a class="collapsible-header waves-effect waves-teal <? if ( $key == 'user' ) { echo 'active'; }; ?>">회원관리</a>
                        <div class="collapsible-body">
                            <ul>
                                <li<? if ( $sub_key == 'user_1' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/user/list/1">일반 회원관리</a>
                                </li>
                                <li<? if ( $sub_key == 'user_2' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/user/list/2">영업사원 회원관리</a>
                                </li>
                                <li<? if ( $sub_key == 'user_3' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/user/list/3">가맹점 회원관리</a>
                                </li>
                                <li<? if ( $sub_key == 'user_4' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/user/list/4">탈퇴 회원관리</a>
                                </li>                                
                            </ul>
                        </div>
                    </li>
                        <?
                    }
                    ?>
                    <li class="bold <? if ( $key == 'shop' ) { echo 'active'; }; ?>">
                        <a class="collapsible-header waves-effect waves-teal <? if ( $key == 'shop' ) { echo 'active'; }; ?>">가맹점 관리</a>
                        <div class="collapsible-body">
                            <ul>
                                <li<? if ( $sub_key == 'shop_1' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/shop/list/1">가맹점 관리</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?
                    if ( 8 <= $session['user_status'] ) {
                        ?>
                    <li class="bold <? if ( $key == 'post' ) { echo 'active'; }; ?>">
                        <a class="collapsible-header waves-effect waves-teal <? if ( $key == 'post' ) { echo ' active '; }; ?>">커뮤니티 관리</a>
                        <div class="collapsible-body">
                            <ul>
                                <li<? if ( $sub_key == 'post_1' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/post/list/1">공지사항 관리</a>
                                </li>
                                <li<? if ( $sub_key == 'post_2' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/post/list/2">이벤트 관리</a>
                                </li>
                                <li<? if ( $sub_key == 'post_3' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/post/list/3">인기 검색어 관리</a>
                                </li>                                
                            </ul>
                        </div>
                    </li>  
                    <li class="bold <? if ( $key == 'service' ) { echo 'active'; }; ?>">
                        <a class="collapsible-header waves-effect waves-teal <? if ( $key == 'service' ) { echo ' active '; }; ?>">고객센터</a>
                        <div class="collapsible-body">
                            <ul>
                                <li<? if ( $sub_key == 'service_4' ) { echo ' class="active"'; }; ?>>
                                    <a href="/admin/post/list/4">고객센터</a>
                                </li>
                            </ul>
                        </div>
                    </li>                    
                        <?
                    }
                    ?>                    
                </ul>
            </li>
                <?
                };
            };
            ?>            
            <li class="bold">
                <?
                if ( isset($session['logged_in']) ) {
                    if ( $session['logged_in'] ) {                    
                        ?>                        
                <a href="/admin/auth/logout" class="waves-effect waves-teal">로그아웃</a>                                
                        <?
                    } else {
                        ?>
                <a href="/admin/auth/login" class="waves-effect waves-teal">로그인</a>                
                        <?
                    }
                } else {
                    ?>
                <a href="/admin/auth/login" class="waves-effect waves-teal">로그인</a>                
                    <?
                }
                ?>
            </li>            
            <!--  
            <li class="bold"><a href="mobile.html" class="waves-effect waves-teal">Mobile</a></li>
            <li class="bold"><a href="showcase.html" class="waves-effect waves-teal">Showcase</a></li>
            <li class="bold"><a href="themes.html" class="waves-effect waves-teal">Themes<span class="new badge"></span></a></li>
            -->
        </ul>
    </header>
    <main>
        <div class="container">
            <? echo $container; ?>
        </div>
    </main>
<footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col l4 s12">
            <h5 class="white-text">관리자 메뉴얼</h5>
            <p class="grey-text text-lighten-4">관리자 메뉴얼 설명</p>
            <form id="paypal-donate" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<button class="btn waves-effect waves-light red lighten-3" type="submit" name="action" alt="PayPal - The safer, easier way to pay online!">관리자 메뉴얼보기</button>
</form>

          </div>
          <div class="col l4 s12">
            <h5 class="white-text">가맹점 메뉴얼</h5>
            <p class="grey-text text-lighten-4">가맹점 메뉴얼 설명</p>
            <a class="btn waves-effect waves-light red lighten-3" target="_blank" href="https://gitter.im/Dogfalo/materialize">가맹점 메뉴얼보기</a>
          </div>
          <div class="col l4 s12" style="overflow: hidden;">
            <h5 class="white-text">투잡다모아 홍보</h5>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">© 2017-2017 2job, All rights reserved.</div>
      </div>
    </footer>
</body>
</html>
