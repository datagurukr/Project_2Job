<?
$row = FALSE;
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $row = $response['data']['out'][0];
    };
};
?>
<div class="section">
    <h5 class="header">이벤트 관리</h5>    
    <div class="row">
        <div class="col s12">
            <p>이벤트를 관리할 수 있습니다.</p>                    
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
                        <b>조회수</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['post_hit_count']) ) {
                            echo number_format($row['post_hit_count']);
                        } else {
                            echo '-';
                        }
                        ?>                                        
                    </td>                    
                </tr>
                <tr>
                    <td>
                        <b>구분</b>
                    </td>
                    <td>
                        <?
                        if ( isset($row['post_content_close_date']) && isset($row['post_content_open_date']) ) {
                            if( strtotime(date('Y-m-d')) <= strtotime($row['post_content_close_date']) ){
                                echo '진행중';
                            } else {
                                echo '정지';
                            }                    
                        }
                        ?>
                    </td>
                    <td>
                        <b>진행기간</b>
                    </td>
                    <td colspan="4">
                        <?
                        if ( isset($row['post_content_close_date']) && isset($row['post_content_open_date']) ) {
                            echo $row['post_content_close_date'].'~'.$row['post_content_open_date'];
                        };
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
            <a href="/admin/post/<? if ( isset($row['post_id']) ) { echo $row['post_id']; }; ?>/2" class="waves-effect waves-light btn right">
                수정
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