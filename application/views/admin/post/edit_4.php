<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<div class="section">
    <h2 class="header">고객센터</h2>    
    <div class="row">
        <form class="col s12" method="post" enctype="application/x-www-form-urlencoded">
            <p>고객센터에 문의 온 내용을 확인하실 수 있습니다.</p>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="validate" name="post_content_title" value="<? if ( isset($row['post_content_title']) ) { echo $row['post_content_title']; } else { echo set_value('post_content_title'); }; ?>">
                    <label for="course">제목</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['post_content_title']) ) {
                                        echo $response['error']['validation']['post_content_title'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="post_type">
                        <option value="0" <? if ( $row['post_type'] == 0 ) { echo 'selected'; } ?> disabled selected>선택</option>
                        <option value="1" <? if ( $row['post_type'] == 1 ) { echo 'selected'; } ?>>가입관련</option>
                        <option value="2" <? if ( $row['post_type'] == 2 ) { echo 'selected'; } ?>>구매관련</option>
                        <option value="3" <? if ( $row['post_type'] == 3 ) { echo 'selected'; } ?>>서비스 이용관련</option>
                        <option value="4" <? if ( $row['post_type'] == 4 ) { echo 'selected'; } ?>>제휴관련</option>                        
                        <option value="5" <? if ( $row['post_type'] == 5 ) { echo 'selected'; } ?>>기타</option>
                    </select>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['post_type']) ) {
                                        echo $response['error']['validation']['post_type'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div>              
            </div>            
            <div class="row">
                <div class="input-field col s12">
                    <h6>내용</h6>
                    <textarea id="editor1" name="post_content_article"><? if ( isset($row['post_content_article']) ) { echo $row['post_content_article']; } else { echo set_value('post_content_article'); }; ?></textarea>
                    <script>
                        CKEDITOR.replace( 'editor1', {
                            extraPlugins: 'mathjax',
                            filebrowserUploadUrl: '/api/upload/ckupload',
                            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
                            height: 300
                        } );

                        if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
                            document.getElementById( 'ie8-warning' ).className = 'tip alert';
                        }
                    </script> 
                    <?
                    // validation
                    if ( isset($response) ) {
                        if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                            if ( isset($response['error']['validation']['post_content_article']) ) {
                                    echo $response['error']['validation']['post_content_article'];
                            };
                        };
                    };
                    ?>                      
                </div>
            </div>
            <h5 class="header">답변하기</h5>                
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="validate" name="post_content_reply_title" value="<? if ( isset($row['post_content_reply_title']) ) { echo $row['post_content_reply_title']; } else { echo set_value('post_content_reply_title'); }; ?>">
                    <label for="course">답변 제목</label>
                    <p class="light red-text">
                        <?
                        // validation
                        if ( isset($response) ) {
                            if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                                if ( isset($response['error']['validation']['post_content_reply_title']) ) {
                                        echo $response['error']['validation']['post_content_reply_title'];
                                };
                            };
                        };
                        ?>                     
                    </p>                                        
                </div>
            </div>            
            
            <div class="row">
                <div class="input-field col s12">
                    <h6>답변 내용</h6>
                    <textarea id="editor2" name="post_content_reply_article"><? if ( isset($row['post_content_reply_article']) ) { echo $row['post_content_reply_article']; } else { echo set_value('post_content_reply_article'); }; ?></textarea>
                    <script>
                        CKEDITOR.replace( 'editor2', {
                            extraPlugins: 'mathjax',
                            filebrowserUploadUrl: '/api/upload/ckupload',
                            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
                            height: 300
                        } );

                        if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
                            document.getElementById( 'ie8-warning' ).className = 'tip alert';
                        }
                    </script> 
                    <?
                    // validation
                    if ( isset($response) ) {
                        if ( $response['status'] == 400 || $response['status'] == 200 || $response['status'] == 401 ) {
                            if ( isset($response['error']['validation']['post_content_reply_article']) ) {
                                    echo $response['error']['validation']['post_content_reply_article'];
                            };
                        };
                    };
                    ?>                      
                </div>
            </div>            
            
            <div class="row">
                <div class="input-field col">
                    
                    <!-- Modal Trigger -->
                    <?
                    if ( $post_id == 0 ) {
                        ?>
                    <a class="waves-effect waves-light btn modal-trigger right" href="#modal1">등록</a>                    
                        <?
                    } else {
                        ?>
                    <a class="waves-effect waves-light btn modal-trigger right" href="#modal1">수정 or 답변</a>                    
                        <?                                
                    }
                    ?>                    

                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>알림</h4>
                            <?
                            if ( $post_id == 0 ) {
                                ?>
                            <p>고객센터를 등록하시겠습니까?</p>                            
                                <?
                            } else {
                                ?>
                            <p>고객센터를 수정 or 답변 하시겠습니까?</p>                            
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
                <div class="input-field col">
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