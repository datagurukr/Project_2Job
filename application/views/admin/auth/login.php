<div class="section">
    <h5 class="header">로그인</h5>    
    <div class="row">
        <div class="col s12">
            <p>투잡다모아 관리자에 오신걸 환영합니다.</p>                    
        </div>
    </div>
    <div class="row">
        <form class="col s12" method="post" enctype="application/x-www-form-urlencoded">            
            
            <div class="row">
                <div class="input-field col s12">
                    <input type="email" class="validate" placeholder="이메일 주소를 입력하세요" name="user_email" value="<? echo set_value('user_email'); ?>"> 
                    <label for="course">이메일</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['user_email']) ) {
                                        echo $response['error']['validation']['user_email'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div>
            </div>   
            
            <div class="row">
                <div class="input-field col s12">
                    <input type="password" class="validate" placeholder="비밀번호를 입력하세요" name="user_pass">                     
                    <label for="course">비밀번호</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['user_pass']) ) {
                                        echo $response['error']['validation']['user_pass'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div>
            </div>            
            
            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" class="waves-effect waves-light btn right">로그인</button>                    
                </div>
            </div>            
            

        </form>         
    </div>    
</div>    