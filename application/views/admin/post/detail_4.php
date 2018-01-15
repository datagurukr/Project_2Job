<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<div class="section">
    <h5 class="header">고객센터</h5>    
    <div class="row">
        <div class="col s12">
            <p>고객센터에 문의 온 내용을 확인하실 수 있습니다.</p>                    
        </div>
    </div>    
    
    <div class="section">
        <table>
            <tbody>
                <tr>
                    <td>
                        <b>번호</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['post_id']) ) {
                            echo $row['post_id'];
                        } else {
                            echo '-';
                        }
                        ?>                                        
                    </td>
                    <td>
                        <b>작성일</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['post_register_date']) ) {
                            echo date("Y-m-d", strtotime($row['post_register_date']));
                        } else {
                            echo '-';
                        }
                        ?>                                        
                    </td>
                    <td>
                        <b>답변여부</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['post_content_reply_title']) ) {
                            if ( 0 < strlen($row['post_content_reply_title']) or 0 < strlen($row['post_content_reply_article']) ) {
                                echo '답변';
                            } else {
                                echo '미 답변';
                            }
                        } else {
                            echo '-';
                        }
                        ?>                                        
                    </td>                    
                </tr>
                <tr>
                    <td>
                        <b>이름</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['user_name']) ) {
                            echo $row['user_name'];
                        } else {
                            echo '-';
                        }
                        ?>                                        
                    </td>
                    <td>
                        <b>이메일</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['user_email']) ) {
                            echo $row['user_email'];
                        } else {
                            echo '-';
                        }
                        ?>                                        
                    </td>
                    <td>
                        <b>문의유형</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['post_type']) ) {
                            if ( $row['post_type'] == 1 ) {
                                echo '가입관련';
                            } elseif ( $row['post_type'] == 2 ) {
                                echo '구매관련';                                
                            } elseif ( $row['post_type'] == 3 ) {
                                echo '서비스 이용관련';                                
                            } elseif ( $row['post_type'] == 4 ) {
                                echo '제휴관련';                                
                            } elseif ( $row['post_type'] == 5 ) {
                                echo '기타';                                
                            } else {
                                echo '선택';
                            }
                        } else {
                            echo '-';
                        }
                        ?>                                        
                    </td>                    
                </tr>
                <tr>
                    <td>
                        <b>제목</b>
                    </td>
                    <td colspan="4">
                        <?
                        if ( isset($row['post_content_title']) ) {
                            echo $row['post_content_title'];
                        } else {
                            echo '-';
                        }
                        ?>                
                    </td>               
                </tr>         
                <tr>
                    <td colspan="6">
                        <? if ( isset($row['post_content_article']) ) { echo $row['post_content_article']; }; ?>
                    </td>               
                </tr>                  
            </tbody>
        </table>       
    </div>
    <div class="row">        
        <div class="input-field col">
            <a href="/admin/post/<? if ( isset($row['post_id']) ) { echo $row['post_id']; }; ?>/4" class="waves-effect waves-light btn right">
                수정 or 답변하기
            </a>
        </div>    
        <div class="input-field col">
            <?
            $referer = @$_SERVER['HTTP_REFERER'];
            if ( isset($_GET['referer']) ) {
                $referer = $_GET['referer'];
            };
            ?>            
            <button type="button" class="waves-effect waves-light btn left" onclick="history.back()">목록</button>
        </div>          
    </div>       
</div>