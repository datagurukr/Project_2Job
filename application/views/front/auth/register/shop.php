<!-- screen -->
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
    <h5 class="form-hd-txt">가맹점 가입</h5>
    <form method="post" enctype="application/x-www-form-urlencoded">    
        <div class="row">
            <div class="col s4">
                <h6>상호:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="text" placeholder="사업자등록 상 상호명 기입" name="user_business_entity_name" value="<? echo set_value('user_business_entity_name'); ?>"> 
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_business_entity_name']) ) {
                            echo $response['error']['validation']['user_business_entity_name'];
                    };
                };
            };
            ?>            
        </div>
        <div class="row">
            <div class="col s4">
                <h6>업종:</h6>
            </div>
            <div class="col s8">
                <select class="form-element" name="user_business_industry">
                    <option value="">가맹점의 업종을 선택해 주세요.</option>
                    <option value="1">외식/음료</option>
                    <option value="2">유통/판매</option>
                    <option value="3">문화/여가/생활</option>
                    <option value="4">서비스</option>
                    <option value="5">IT/컴퓨터</option>
                    <option value="6">교육/강사</option>
                    <option value="7">디자인</option>
                    <option value="8">미디어</option>                        
                </select>
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_business_industry']) ) {
                            echo $response['error']['validation']['user_business_industry'];
                    };
                };
            };
            ?>             
        </div>
        <div class="row">
            <div class="col s4">
                <h6>사업자번호:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="number" placeholder="-를 빼고 입력해주세요" name="user_business_license_number" value="<? echo set_value('user_business_license_number'); ?>"> 
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_business_license_number']) ) {
                            echo $response['error']['validation']['user_business_license_number'];
                    };
                };
            };
            ?>            
        </div>
        <div class="row">
            <div class="col s4">
                <h6>대표자명:</h6>
            </div>
            <div class="col s8">
                <input class="form-element" type="number" placeholder="대표자명" name="user_business_representative" value="<? echo set_value('user_business_representative'); ?>"> 
            </div>
            <?
            // validation
            if ( isset($response) ) {
                if ( $response['status'] == 400 ) {
                    if ( isset($response['error']['validation']['user_business_representative']) ) {
                            echo $response['error']['validation']['user_business_representative'];
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
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>