<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<div class="section">
    <h5 class="header">상품관리 관리</h5>    
    <div class="row">
        <form class="col s12" method="post" enctype="multipart/form-data">
            <p>신규상품 및 등록상품을 관리할 수 있습니다.</p>
            <?
            $product_state = 0;
            if ( isset($row['product_state']) ) {
                $product_state = $row['product_state'];
            };
            ?>
            <div class="row">
                <select class="browser-default col s6 offset-s6" name="product_state">
                    <option value="1" <? if ( $product_state == 1 ) { echo 'selected'; }; ?>>판매중</option>
                    <option value="0" <? if ( $product_state == 0 ) { echo 'selected'; }; ?>>판매중지</option>
                </select>                
            </div>    
            
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" class="validate" name="product_name" value="<? if ( isset($row['product_name']) ) { echo $row['product_name']; } else { echo set_value('product_name'); }; ?>">
                    <label for="course">상품명</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['product_name']) ) {
                                echo $response['error']['validation']['product_name'];
                        };
                        ?>                     
                    </p>                                        
                </div>
                <div class="input-field col s4">
                    <input type="text" class="validate" name="product_price" value="<? if ( isset($row['product_price']) ) { echo $row['product_price']; } else { echo set_value('product_price'); }; ?>">
                    <label for="course">가격</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['product_price']) ) {
                                echo $response['error']['validation']['product_price'];
                        };
                        ?>                     
                    </p>                                        
                </div>
                <div class="input-field col s4">
                    <input type="text" class="validate" name="product_incentive" value="<? if ( isset($row['product_incentive']) ) { echo $row['product_incentive']; } else { echo set_value('product_incentive'); }; ?>">
                    <label for="course">판매 인센티브</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['product_incentive']) ) {
                                echo $response['error']['validation']['product_incentive'];
                        };
                        ?>                     
                    </p>                                        
                </div>                
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" class="datepicker" name="product_life_open_date" value="<? if ( isset($row['product_life_open_date']) ) { echo $row['product_life_open_date']; }; ?>">
                    <label for="course">사용기한 시작날짜</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['product_life_open_date']) ) {
                                echo $response['error']['validation']['product_life_open_date'];
                        };
                        ?>                     
                    </p>                                        
                </div>
                <div class="input-field col s6">
                    <input type="text" class="datepicker" name="product_life_close_date" value="<? if ( isset($row['product_life_close_date']) ) { echo $row['product_life_close_date']; }; ?>">
                    <label for="course">사용기한 종료날짜</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response['error']['validation']['product_life_close_date']) ) {
                                echo $response['error']['validation']['product_life_close_date'];
                        };
                        ?>                     
                    </p>                                        
                </div>                
            </div>    
            
            <div class="row">
                <?
                for ( $i = 0; $i < 7; $i++ ) {
                    ?>
                <div>
                    <div class="input-field col s8">
                        <input type="text" class="validate" name="product_option_name[]" value="<? if ( isset($row['product_option'][$i]['name']) ) { echo $row['product_option'][$i]['name']; }; ?>">
                        <label for="course">옵션명</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" class="validate" name="product_option_price[]" value="<? if ( isset($row['product_option'][$i]['price']) ) { echo $row['product_option'][$i]['price']; }; ?>">
                        <label for="course">가격</label>
                    </div>
                </div>
                    <?
                };
                ?>
            </div>
            
            <div class="row">
                <div class="file-field input-field  col s8">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="product_pictrue">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="상품 이미지">
                    </div>
                </div>
                
                <div class="col s2">
                    <input type="checkbox" id="checkbox1" name="product_pictrue_remove" value="1"/>
                    <label for="checkbox1">이미지 삭제</label>
                </div>                    
                
                <?
                if ( isset($row['product_pictrue']) ) {
                    if ( 0 < strlen($row['product_pictrue']) ) {
                        ?>
                <img src="/upload/<? echo $row['product_pictrue']; ?>" class="responsive-img">
                        <?
                    }
                }
                ?>                
            </div>  
            
            <div class="row">
                <div class="input-field col s6">
                    
                    <!-- Modal Trigger -->
                    <a class="waves-effect waves-light btn modal-trigger right" href="#modal1">등록</a>

                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>알림</h4>
                            <?
                            if ( $product_id == 0 ) {
                                ?>
                            <p>상품을 등록하시겠습니까?</p>                            
                                <?
                            } else {
                                ?>
                            <p>상품을 수정하시겠습니까?</p>                            
                                <?                                
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="modal-close waves-effect waves-red btn-flat">취소</button>
                            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">확인</button>
                        </div>
                    </div>
                    
                </div>
                <div class="input-field col s6">
                    <?
                    $referer = @$_SERVER['HTTP_REFERER'];
                    if ( isset($_GET['referer']) ) {
                        $referer = $_GET['referer'];
                    };
                    ?>
                    <button type="button" class="waves-effect waves-light btn left" onclick="history.back()">취소</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>