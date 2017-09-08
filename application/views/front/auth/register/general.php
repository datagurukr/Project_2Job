<!-- screen -->
<div class="login-header">
    <div class="container">
        <div class="back">
            <a href="#!">
                <img src="/assets/images/login/back_button.png">
            </a>
            <h6><strong>회원가입</strong></h6>
        </div>
    </div>
</div>
<div class="container">
    <h5 class="form-hd-txt">일반회원 가입</h5>
    <form method="post" enctype="application/x-www-form-urlencoded">    
        <div class="row">
            <div class="col s4">
                <h6>가입자명:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="text" placeholder="가입자 명" name="user_name" value="<? echo set_value('user_name'); ?>"> 
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_name']) ) {
                            echo $response['error']['validation']['user_name'];
                    };
                };
            };
            ?>            
        </div>
        <div class="row">
            <div class="col s4">
                <h6>이메일:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="email" name="user_email" value="<? echo set_value('user_email'); ?>"> 
            </div>
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
        <div class="row">
            <div class="col s4">
                <h6>비밀번호:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="password" placeholder="6~16자 영문, 숫자, 특수문자 조합" name="user_pass"> 
            </div>
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
        <div class="row">
            <div class="col s4">
                <h6>비밀번호 확인:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="password" name="user_pass_re"> 
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_pass_re']) ) {
                            echo $response['error']['validation']['user_pass_re'];
                    };
                };
            };
            ?>             
        </div>
        <div class="row">
            <div class="col s4">
                <h6>전화번호:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="tel" name="user_tel" value="<? echo set_value('user_tel'); ?>"> 
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_tel']) ) {
                            echo $response['error']['validation']['user_tel'];
                    };
                };
            };
            ?>              
        </div>
        <h5 class="form-hd-txt">약관동의</h5>
        <div class="row row-provision">
            <div class="col s12">
                <div class="form-check form-check-frt">
                  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox"><strong>가입 전체약관 및 안내정보 수신에 동의 합니다.</strong>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">서비스 이용약관 동의(필수)
                      <a href="#!" class="text-right">내용보기▶︎</a>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">개인정보수집 및 이용 동의(필수)
                      <a href="#!">내용보기▶︎</a>
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">프로모션안내 이메일/SMS수신동의(선택)
                  </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 text-center">
                <button type="submit" class="btn primary-btn">가입하기</button>
            </div>
        </div>
    </form>
</div>