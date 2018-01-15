<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<div class="section">
    <h5 class="header">공지사항 관리</h5>    
    <div class="row">
        <form class="col s12" method="post" enctype="application/x-www-form-urlencoded">
            <p>공지사항을 관리할 수 있습니다.</p>
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
            <div class="row">
                <div class="input-field col">
                    
                    <!-- Modal Trigger -->
                    <a class="waves-effect waves-light btn modal-trigger right" href="#modal1">등록</a>

                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>알림</h4>
                            <?
                            if ( $post_id == 0 ) {
                                ?>
                            <p>공지사항을 등록하시겠습니까?</p>                            
                                <?
                            } else {
                                ?>
                            <p>공지사항을 수정하시겠습니까?</p>                            
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