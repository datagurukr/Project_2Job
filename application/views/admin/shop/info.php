<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
       
<div class="section">
    <h5 class="header">정보관리</h5>    
    <div class="row">
        <form class="col s12" method="post" enctype="application/x-www-form-urlencoded">
            <p>가맹점의 기본 정보를 수정할 수 있습니다.</p>
            
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" class="text" name="user_business_entity_name" value="<? if ( isset($row['user_business_entity_name']) ) { echo $row['user_business_entity_name']; }; ?>">
                    <label for="course">상호명</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_business_entity_name']) ) {
                            echo $response['error']['validation']['user_business_entity_name'];
                        };
                        ?>                     
                    </p>                                        
                </div>                
                <div class="input-field col s4">
                    <input type="text" class="text" name="user_business_license_number" value="<? if ( isset($row['user_business_license_number']) ) { echo $row['user_business_license_number']; }; ?>">
                    <label for="course">사업자등록번호</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['post_content_open_date']) ) {
                            echo $response['error']['validation']['post_content_open_date'];
                        };
                        ?>                     
                    </p>                                        
                </div>
                <div class="input-field col s4">
                    <input type="text" class="text" disabled>
                    <label for="course">판매 인센티브 : <? if ( isset($row['user_incentive']) ) { echo $row['user_incentive'].'%'; }; ?></label>
                </div>                
            </div>                        
            
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="validate" name="user_short_introduction" value="<? if ( isset($row['user_short_introduction']) ) { echo $row['user_short_introduction']; }; ?>">
                    <label for="course">목록 소개글</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_short_introduction']) ) {
                            echo $response['error']['validation']['user_short_introduction'];
                        };
                        ?>                     
                    </p>                                        
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <textarea class="materialize-textarea" name="user_introduction"><? if ( isset($row['user_introduction']) ) { echo $row['user_introduction']; }; ?></textarea>
                    <label for="course">상세 소개글</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_introduction']) ) {
                            echo $response['error']['validation']['user_introduction'];
                        };
                        ?>                     
                    </p>                                        
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <input type="checkbox" id="checkbox1" name="user_shop_daily_open_state" value="1" <? if ( isset($row['user_shop_daily_open_state']) ) { if ( $row['user_shop_daily_open_state'] == 1 ) { echo 'checked'; }; }; ?>/>
                    <label for="checkbox1">매일</label>
                </div>    
                <div class="input-field col s2">
                    <input type="text" class="timepicker" placeholder="시작시간(00:00)" name="user_shop_daily_open_time" value="<? if ( isset($row['user_shop_daily_open_time']) ) { echo date_format(date_create('0000-00-00 '.$row['user_shop_daily_open_time']), 'H:i'); } ?>">
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_shop_daily_open_time']) ) {
                            echo $response['error']['validation']['user_shop_daily_open_time'];
                        };
                        ?>                     
                    </p>                                        
                </div>
                <div class="input-field col s2">
                    <input type="text" class="timepicker" placeholder="종료시간(00:00)" name="user_shop_daily_close_time" value="<? if ( isset($row['user_shop_daily_close_time']) ) { echo date_format(date_create('0000-00-00 '.$row['user_shop_daily_close_time']), 'H:i'); }; ?>">
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_shop_daily_close_time']) ) {
                            echo $response['error']['validation']['user_shop_daily_close_time'];
                        };
                        ?>                     
                    </p>                                        
                </div>  
                <div class="col s2">
                    <input type="checkbox" id="checkbox2" name="user_shop_holiday_open_state" value="1" <? if ( isset($row['user_shop_holiday_open_state']) ) { if ( $row['user_shop_holiday_open_state'] == 1 ) { echo 'checked'; }; }; ?>/>
                    <label for="checkbox2">휴일</label>
                </div>                 
                <div class="input-field col s2">
                    <input type="text" class="timepicker" placeholder="시작시간(00:00)" name="user_shop_holiday_open_time" value="<? if ( isset($row['user_shop_holiday_open_time']) ) { echo date_format(date_create('0000-00-00 '.$row['user_shop_holiday_open_time']), 'H:i'); }; ?>">
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_shop_holiday_open_time']) ) {
                            echo $response['error']['validation']['user_shop_holiday_open_time'];
                        };
                        ?>                     
                    </p>                                        
                </div>
                <div class="input-field col s2">
                    <input type="text" class="timepicker" placeholder="종료시간(00:00)" name="user_shop_holiday_close_time" value="<? if ( isset($row['user_shop_holiday_close_time']) ) { echo date_format(date_create('0000-00-00 '.$row['user_shop_holiday_close_time']), 'H:i'); }; ?>">
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_shop_holiday_close_time']) ) {
                            echo $response['error']['validation']['user_shop_holiday_close_time'];
                        };
                        ?>                     
                    </p>                                        
                </div>                
            </div>  
            -->
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="text" name="user_tel" value="<? if ( isset($row['user_tel']) ) { echo $row['user_tel']; }; ?>">
                    <label for="course">예약문의</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_tel']) ) {
                            echo $response['error']['validation']['user_tel'];
                        };
                        ?>                     
                    </p>                                        
                </div>  
            </div>     
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="text" name="user_kakaoid" value="<? if ( isset($row['user_kakaoid']) ) { echo $row['user_kakaoid']; }; ?>">
                    <label for="course">카카오톡 아이디</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['user_kakaoid']) ) {
                            echo $response['error']['validation']['user_kakaoid'];
                        };
                        ?>                     
                    </p>                                        
                </div>  
            </div>             
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
            
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" class="text" name="user_address_0" value="<? echo $user_address_0; ?>">
                    <label for="course">우편번호</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['post_content_open_date']) ) {
                                        echo $response['error']['validation']['post_content_open_date'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div> 
                <div class="input-field col s4">
                    <input type="text" class="text" name="user_address_1" value="<? echo $user_address_1; ?>">
                    <label for="course">우편번호</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['post_content_open_date']) ) {
                                        echo $response['error']['validation']['post_content_open_date'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div> 
                <div class="input-field col s4">
                    <button class="btn waves-effect waves-light" type="button">우편번호</button>                    
                </div>                 
            </div>            
            
            <div class="row">
                <div class="input-field col s8">
                    <input type="text" class="text" name="user_address_2" value="<? echo $user_address_2; ?>">
                    <label for="course">주소</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['post_content_open_date']) ) {
                                        echo $response['error']['validation']['post_content_open_date'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div>  
                <div class="input-field col s4">
                    <input type="text" class="text" name="user_address_3" value="<? echo $user_address_3; ?>">
                    <label for="course">나머지 주소</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['post_content_open_date']) ) {
                                        echo $response['error']['validation']['post_content_open_date'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div>                  
            </div>              
            
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="이미지">
                    </div>
                </div>
            </div>              
            
            <div class="row">
                <div class="input-field col s12">
                    
                    <!-- Modal Trigger -->
                    <a class="waves-effect waves-light btn modal-trigger right" href="#modal1">수정</a>

                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>알림</h4>
                            <p>가맹점 기본 정보를 수정 하시겠습니까?</p>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-close waves-effect waves-red btn-flat">취소</button>
                            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">확인</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>