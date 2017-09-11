<!-- screen -->
<div class="wrap" id="hideMenu">
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/login/back_button.png">
                </a>
                <h6><strong>회원가입</strong></h6>
            </div>
        </div>
    </div>
    <div class="container" id="container">
        <h5 class="form-hd-txt">영엽사원 가입</h5>
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
            <div class="row" style="margin-bottom:10px">
                <div class="col s4">
                    <h6>전화번호:</h6>
                </div>
                <div class="col s5">
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
                <div class="col s3 text-center">
                    <a href="#!" class="btn default-btn truncate">인증번호</a>
                </div>
            </div>
            <div class="row">
                <div class="col s5 offset-s4">
                    <input class="form-element" type="text" name="user_authentication_number"> 
                </div>
                <?
                // validation
                if ( isset($response) ) {
                    if ( $response['status'] == 400 ) {
                        if ( isset($response['error']['validation']['user_authentication_number']) ) {
                                echo $response['error']['validation']['user_authentication_number'];
                        };
                    };
                };
                ?>        
                <div class="col s3 text-center">
                    <a href="#!" class="btn primary-btn truncate">확인</a>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>은행명:</h6>
                </div>
                <div class="col s8">
                    <select class="form-element" name="user_bank_name">
                        <option value="">은행명을 선택해 주세요</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <?
                // validation
                if ( isset($response) ) {
                    if ( $response['status'] == 400 ) {
                        if ( isset($response['error']['validation']['user_bank_name']) ) {
                                echo $response['error']['validation']['user_bank_name'];
                        };
                    };
                };
                ?>        
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>계좌번호:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="number" placeholder="-를 빼고 입력해주세요." name="user_bank_number" value="<? echo set_value('user_bank_number'); ?>"> 
                </div>
                <?
                // validation
                if ( isset($response) ) {
                    if ( $response['status'] == 400 ) {
                        if ( isset($response['error']['validation']['user_bank_number']) ) {
                                echo $response['error']['validation']['user_bank_number'];
                        };
                    };
                };
                ?>        
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>근로계약서:</h6>
                </div>
                <input class="form-element" type="hidden" value="서명" placeholder="근로계약서(서명)" name="user_employment_contract"> 
                <?
                // validation
                if ( isset($response) ) {
                    if ( $response['status'] == 400 ) {
                        if ( isset($response['error']['validation']['user_employment_contract']) ) {
                                echo $response['error']['validation']['user_employment_contract'];
                        };
                    };
                };
                ?>         
                <div class="col s8 text-center">
                    <a href="#!" class="btn default-btn">근로계약서 확인 후 서명하기</a>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>추천인:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="number" placeholder="추천인의 회원가입명을 입력해 주세요." name="user_recommender_name" value="<? echo set_value('user_recommender_name'); ?>"> 
                </div>
                <?
                // validation
                if ( isset($response) ) {
                    if ( $response['status'] == 400 ) {
                        if ( isset($response['error']['validation']['user_recommender_name']) ) {
                                echo $response['error']['validation']['user_recommender_name'];
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
</div>    
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>