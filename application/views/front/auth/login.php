<!-- screen -->
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
                <h6><strong>로그인</strong></h6>
            </div>
        </div>
    </div>
    <div class="container" id="container">
        <div class="row login-logo">
            <div class="col s12 text-center">
                <img src="assets/images/login/logo_green.png">
            </div>
        </div>
        <form method="post" enctype="application/x-www-form-urlencoded">            
            <div class="row login-formarea">
                <div class="col s12 text-center">
                    <input class="form-element" type="email" placeholder="이메일 주소를 입력하세요" name="user_email" value="<? echo set_value('user_email'); ?>"> 
                    <?
                    // validation
                    if ( isset($response) ) {
                        if ( $response['status'] == 400 ) {
                            if ( isset($response['error']['validation']['user_email']) ) {
                                    echo $response['error']['validation']['user_email'];
                            };
                        };
                    };
                    ?>            
                </div>
                <div class="col s12 text-center">
                    <input class="form-element" type="password" placeholder="비밀번호를 입력하세요" name="user_pass"> 
                    <?
                    // validation
                    if ( isset($response) ) {
                        if ( $response['status'] == 400 ) {
                            if ( isset($response['error']['validation']['user_pass']) ) {
                                    echo $response['error']['validation']['user_pass'];
                            };
                        };
                    };
                    ?>             
                </div>
                <div class="col s12 text-center">
                    <button type="submit" class="btn primary-btn">로그인</a>
                </div>
            </div>
            <div class="row login-option">
                <div class="col s6">
                    <div class="form-check">
                      <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">자동로그인
                      </label>
                    </div>
                </div>
                <div class="col s6 text-right">
                    <a href="/recover">비밀번호 찾기</a>
                </div>
                <div class="col s12 text-center">
                    <p>아직 투잡다모아 회원이 아니세요?</p>
                    <a href="/register">회원가입</a>
                </div>
            </div>
        </form>    
    </div>
</div>
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>