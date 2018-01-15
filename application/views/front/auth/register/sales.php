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
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_name']) ) {
                        ?>
            <p class="alert-msg">            
                <? echo $response['error']['validation']['user_name']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>        
            <div class="row">
                <div class="col s4">
                    <h6>이메일:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="email" name="user_email" value="<? echo set_value('user_email'); ?>"> 
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_email']) ) {
                        ?>
            <p class="alert-msg">
                <? echo $response['error']['validation']['user_email']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>        
            <div class="row">
                <div class="col s4">
                    <h6>비밀번호:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="password" placeholder="6~16자 영문, 숫자, 특수문자 조합" name="user_pass"> 
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_pass']) ) {
                        ?>
            <p class="alert-msg">
                <? echo $response['error']['validation']['user_pass']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>          
            <div class="row">
                <div class="col s4">
                    <h6>비밀번호 확인:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="password" name="user_pass_re"> 
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_pass_re']) ) {
                        ?>
            <p class="alert-msg">            
                <? echo $response['error']['validation']['user_pass_re']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>                     
            <div class="row" style="margin-bottom:10px">
                <div class="col s4">
                    <h6>전화번호:</h6>
                </div>
                <div class="col s5">
                    <input class="form-element" type="tel" name="user_tel" value="<? echo set_value('user_tel'); ?>"> 
                </div>
                <div class="col s3 text-center" style="display:none">
                    <a href="#!" class="btn default-btn truncate">인증번호</a>
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_tel']) ) {
                        ?>
            <p class="alert-msg">            
                <? echo $response['error']['validation']['user_tel']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>         
            <div class="row" style="display:none">
                <div class="col s5 offset-s4">
                    <input class="form-element" type="text" name="user_authentication_number" value="1"> 
                </div>
                <div class="col s3 text-center">
                    <a href="#!" class="btn primary-btn truncate">확인</a>
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_authentication_number']) ) {
                        ?>
            <p class="alert-msg">                        
                <? echo $response['error']['validation']['user_authentication_number']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>                    
            <div class="row">
                <div class="col s4">
                    <h6>은행명:</h6>
                </div>
                <div class="col s8">
                    <select class="form-element" name="user_bank_name">
                        <?
                        $bank = array(
                            array('국민은행(004)','004'),
                            array('신한은행(088)','088'),
                            array('우리은행(020)','020'),
                            array('KEB하나은행(081)','081'),
                            array('한국씨티은행(027, 외국계)','027'),
                            array('한국스탠다드차타드은행(023, 외국계)','023'),
                            array('케이뱅크(089)','089'),
                            array('카카오뱅크(090)','090'),
                            array('중소기업은행(003)','003'),
                            array('NH농협은행(011)','011'),
                            array('한국산업은행(002)','002'),
                            array('수협은행(007)','007'),                            
                            array('한국수출입은행(008)','008'),
                            array('경남은행(039)','039'),
                            array('광주은행(034)','034'),
                            array('대구은행(031)','031'),
                            array('부산은행(032)','032'),
                            array('전북은행(037)','037'),
                            array('제주은행(035)','035'),
                            array('우체국(071)','071')
                        );
                        foreach ( $bank as $row ) {
                            ?>
                        <option value="<? echo $row[1]; ?>"><? echo $row[0]; ?></option>                        
                            <?
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_bank_name']) ) {
                        ?>
            <p class="alert-msg">            
                <? echo $response['error']['validation']['user_bank_name']; ?>             
            </p>    
                        <?
                    };
                };
            };
            ?>        
            <div class="row">
                <div class="col s4">
                    <h6>계좌번호:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="number" placeholder="-를 빼고 입력해주세요." name="user_bank_number" value="<? echo set_value('user_bank_number'); ?>"> 
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_bank_number']) ) {
                        ?>
            <p class="alert-msg">
                <? echo $response['error']['validation']['user_bank_number']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>                    
            <div class="row" style="display:none">
                <div class="col s4">
                    <h6>근로계약서:</h6>
                </div>
                <input class="form-element" type="hidden" value="서명" placeholder="근로계약서(서명)" name="user_employment_contract" value="1"> 
                <div class="col s8 text-center">
                    <a href="#!" class="btn default-btn">근로계약서 확인 후 서명하기</a>
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_employment_contract']) ) {
                        ?>
            <p class="alert-msg">
                <? echo $response['error']['validation']['user_employment_contract']; ?>
            </p>    
                        <?
                    };
                };
            };
            ?>         
            <div class="row">
                <div class="col s4">
                    <h6>추천인:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="text" placeholder="추천인의 회원가입명을 입력해 주세요." name="user_recommender_name" value="<? echo set_value('user_recommender_name'); ?>"> 
                </div>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_recommender_name']) ) {
                        ?>
            <p class="alert-msg">
                <? echo $response['error']['validation']['user_recommender_name']; ?>
            </p>
                        <?
                    };
                };
            };
            ?>         
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
                          <a href="/terms" class="text-right">내용보기▶︎</a>
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">개인정보수집 및 이용 동의(필수)
                          <a href="/privacy" target="_blank">내용보기▶︎</a>
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