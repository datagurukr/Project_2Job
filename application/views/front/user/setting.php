<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<div class="wrap" id="hideMenu">
    <div class="login-header" id="header">
        <div class="container">
            <div class="back">
                <a href="">
                    <img src="/assets/images/back_button.png">
                </a>
                <h6><strong>설정</strong></h6>
            </div>
        </div>
    </div>
    <div class="container" id="container">
        <form method="post" enctype="application/x-www-form-urlencoded">        
            <h5 class="form-hd-txt">로그인 설정</h5>
            <div class="row">
                <div class="col s10">
                    <h6>자동로그인</h6>
                </div>
                <div class="col s2 text-right">
                    <div class="form-check">
                      <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">
                      </label>
                    </div>
                </div>
            </div>
            <h5 class="form-hd-txt">회원정보 수정</h5>
            
            <!-- 가맹점 -->
            <?
            if ( $row['user_status'] == 3 ) {
                ?>
            <div class="row">
                <div class="col s4">
                    <h6>상호명:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="text" placeholder="스타벅스 여의도점" name="user_business_entity_name" value="<? if ( isset($row['user_business_entity_name']) ) { echo $row['user_business_entity_name']; }; ?>"> 
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_business_entity_name']) ) {
                    echo $response['error']['validation']['user_business_entity_name'];
                };
                ?>                
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>사업자번호:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="number" placeholder="123456" name="user_business_license_number" value="<? if ( isset($row['user_business_license_number']) ) { echo $row['user_business_license_number']; }; ?>"> 
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_business_license_number']) ) {
                    echo $response['error']['validation']['user_business_license_number'];
                };
                ?>                
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>대표자명:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="text" placeholder="홍길동" name="user_business_representative" value="<? if ( isset($row['user_business_representative']) ) { echo $row['user_business_representative']; }; ?>"> 
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_business_representative']) ) {
                    echo $response['error']['validation']['user_business_representative'];
                };
                ?>                 
            </div>            
                <?
            };
            ?>
            
            <!-- 일반 -->
            <?
            if ( $row['user_status'] != 3 ) {
                ?>
            <div class="row">
                <div class="col s4">
                    <h6>가입자명:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="text" placeholder="홍길동" name="user_name" value="<? if ( isset($row['user_name']) ) { echo $row['user_name']; }; ?>"> 
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_name']) ) {
                    echo $response['error']['validation']['user_name'];
                };
                ?>                
            </div>
                <?
            };
            ?>
            <div class="row">
                <div class="col s4">
                    <h6>이메일: </h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="email" name="user_email" value="<? if ( isset($row['user_email']) ) { echo $row['user_email']; }; ?>"> 
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_email']) ) {
                    echo $response['error']['validation']['user_email'];
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
                if ( isset($response['error']['validation']['user_pass']) ) {
                    echo $response['error']['validation']['user_pass'];
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
                if ( isset($response['error']['validation']['user_pass_re']) ) {
                    echo $response['error']['validation']['user_pass_re'];
                };
                ?>                
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>전화번호:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="tel" name="user_tel" value="<? if ( isset($row['user_tel']) ) { echo $row['user_tel']; }; ?>"> 
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_tel']) ) {
                    echo $response['error']['validation']['user_tel'];
                };
                ?>                 
            </div>
            
            <!-- 영업사원 -->
            <?
            if ( $row['user_status'] == 2 ) {
                ?>
            <div class="row">
                <div class="col s4">
                    <h6>은행명:</h6>
                </div>
                <div class="col s8">
                    <select class="form-element" name="user_bank_name">
                        <option>은행명을 선택해 주세요</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_bank_name']) ) {
                    echo $response['error']['validation']['user_bank_name'];
                };
                ?>                
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>계좌번호:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="number" placeholder="-를 빼고 입력해주세요." name="user_bank_number" value="<? if ( isset($row['user_bank_number']) ) { echo $row['user_bank_number']; }; ?>"> 
                </div>
                <?
                // validation
                if ( isset($response['error']['validation']['user_bank_number']) ) {
                    echo $response['error']['validation']['user_bank_number'];
                };
                ?>                
            </div>
            <div class="row">
                <div class="col s4">
                    <h6>근로계약서:</h6>
                </div>
                <input class="form-element" type="hidden" value="<? if ( isset($row['user_name']) ) { echo $row['user_name']; }; ?>" placeholder="근로계약서(서명)" name="user_employment_contract"> 
                <?
                // validation
                if ( isset($response['error']['validation']['user_employment_contract']) ) {
                    echo $response['error']['validation']['user_employment_contract'];
                };
                ?>                
                <div class="col s8 text-center">
                    <a href="#!" class="btn default-btn">근로계약서 확인 후 서명하기</a>
                </div>
            </div>            
                <?
            };
            ?>
            
            <h5 class="form-hd-txt">추가정보 등록</h5>
            <div class="row">
                <div class="col s4">
                    <h6>생년월일:</h6>
                </div>
                <div class="col s8">
                    <input class="form-element" type="text" placeholder="20000202" name="user_birthday" value="<? if ( isset($row['user_birthday']) ) { echo $row['user_birthday']; }; ?>"> 
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                
                <?
                $user_address_0 = '';
                $user_address_1 = '';
                $user_address_2 = '';
                $user_address_3 = '';
                
                $user_address = explode('|',$row['user_address']);
                if ( count($user_address) == 4 ) {
                    $user_address_0 = $user_address[0];
                    $user_address_1 = $user_address[1];
                    $user_address_2 = $user_address[2];
                    $user_address_3 = $user_address[3];
                };
                ?>
                
                <div class="col s4">
                    <h6>주소:</h6>
                </div>
                <div class="col s3">
                    <input class="form-element" type="number" name="user_address_0" value="<? echo $user_address_0; ?>"> 
                </div>
                <div class="col s3">
                    <input class="form-element" type="number" name="user_address_1" value="<? echo $user_address_1; ?>"> 
                </div>
                <div class="col s2 text-center">
                    <a href="#!" class="btn default-btn truncate">우편번호</a>
                </div>
            </div>
            <div class="row">
                <div class="col s6 offset-s4">
                    <input class="form-element" type="text" name="user_address_2" value="<? echo $user_address_2; ?>"> 
                </div>
                <div class="col s2 text-center">
                    <input class="form-element" type="text" name="user_address_3" value="<? echo $user_address_3; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col s12 text-center">
                    <a href="#!" class="btn black-btn">영업사원 회원으로 전환하기</a>
                </div>
            </div>
            <div class="row">
                <div class="col s12 text-center">
                    <button type="submit" class="btn primary-btn">정보수정</button>
                </div>
            </div>
            <div class="row">
                <div class="col s12 text-center">
                    <a href="#!" class="">회원탈퇴</a>
                </div>
            </div>
        </form>    
    </div>
</div>    
<script type="text/javascript">run_func( 'header', false );</script>
<script type="text/javascript">run_func( 'container', false );</script>