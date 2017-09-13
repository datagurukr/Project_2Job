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
    <div class="row custom-detail">
        <div class="row">
            <div class="col s12 m6 l2 custom-label">
                <p>번호</p>
            </div>
            <div class="col s12 m6 l2">
                <p>
                    <?
                    if ( isset($row['post_id']) ) {
                        echo $row['post_id'];
                    } else {
                        echo '-';
                    }
                    ?>                
                </p>
            </div>
            <div class="col s12 m6 l2 custom-label">
                <p>작성일</p>
            </div>        
            <div class="col s12 m6 l2">
                <p>
                    <?
                    if ( isset($row['post_register_date']) ) {
                        echo date("Y-m-d", strtotime($row['post_register_date']));
                    } else {
                        echo '-';
                    }
                    ?>                
                </p>
            </div>        
            <div class="col s12 m6 l2 custom-label">
                <p>조회수</p>
            </div>     
            <div class="col s12 m6 l2">
                <p>
                    <?
                    if ( isset($row['post_hit_count']) ) {
                        echo number_format($row['post_hit_count']);
                    } else {
                        echo '-';
                    }
                    ?>                
                </p>
            </div>      
        </div>   
        <div class="row">
            <div class="col s12 m6 l2 custom-label">
                <p>구분</p>
            </div>
            <div class="col s12 m6 l2">
                <p>
                    진행중                
                </p>
            </div>
            <div class="col s12 m6 l2 custom-label">
                <p>진행기간</p>
            </div>        
            <div class="col s12 m6 l6">
                <p>
                    2017-05-12~2017-06-13              
                </p>
            </div>              
        </div>          
        <div class="row">
            <div class="col s12 m6 l2 custom-label">
                <p>제목</p>
            </div>
            <div class="col s12 m6 l10">
                <p>
                    <?
                    if ( isset($row['post_content_title']) ) {
                        echo $row['post_content_title'];
                    } else {
                        echo '-';
                    }
                    ?>                
                </p>
            </div>      
        </div>  

        <div class="row">
            <div class="col s12 m6 l12">
                <? if ( isset($row['post_content_article']) ) { echo $row['post_content_article']; }; ?>
            </div>
        </div>        
    </div>    
    
    <div class="row">        
        <div class="input-field col s6">
            <a href="/admin/post/<? if ( isset($row['post_id']) ) { echo $row['post_id']; }; ?>/2" class="waves-effect waves-light btn right">
                수정
            </a>
        </div>    
        <div class="input-field col s6">
            <?
            $referer = @$_SERVER['HTTP_REFERER'];
            if ( isset($_GET['referer']) ) {
                $referer = $_GET['referer'];
            };
            ?>            
            <button type="button" class="waves-effect waves-light btn left" onclick="location.replace('<? echo $referer; ?>');">목록</button>
        </div>          
    </div>       
</div>